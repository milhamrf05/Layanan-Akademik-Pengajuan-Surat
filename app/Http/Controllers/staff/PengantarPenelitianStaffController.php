<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use App\Models\FormSurat;
use App\Models\PengantarPenelitian;
use App\Models\Surat;
use App\Models\User;
use App\Services\FetchMahasiswaService;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;
use Ramsey\Uuid\Uuid;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PengantarPenelitianStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengajuanSurat = Surat::findOrFail($id);
        $jenisFile = $pengajuanSurat->jenis_file;
        $user = User::findOrFail($pengajuanSurat->user_id);
        $formSurat = PengantarPenelitian::where('surat_id', $pengajuanSurat->id)->first();
        $fetchmahasiswa = new FetchMahasiswaService();
        $data_mahasiswa = $fetchmahasiswa->fetchDataMahasiswa(Auth::user()->email);

        if (is_string($formSurat->additional_fields)) {
            $additionalFields = json_decode($formSurat->additional_fields, true);
        } else {
            $additionalFields = $formSurat->additional_fields;
        }

        // Hapus _token dari additional_fields jika ada
        if (isset($additionalFields['_token'])) {
            unset($additionalFields['_token']);
        }
        if (isset($additionalFields['ttd'])) {
            unset($additionalFields['ttd']);
        }

        return view('page.staff.pengantar-penelitian.show',  compact('id', 'pengajuanSurat', 'user', 'jenisFile', 'formSurat', 'additionalFields', 'data_mahasiswa'));
    }

    public function setujui($id)
    {

        $pengajuanSurat = Surat::find($id);
        $formSurat = PengantarPenelitian::where('surat_id', $id)->first();

        $qrDirectory = storage_path('app/qr_codes');
        if (!File::isDirectory($qrDirectory)) {
            File::makeDirectory($qrDirectory, 0755, true);
        }

        // Generate QR Code
        $encryptedId = Crypt::encryptString($id);
        $qrCodeUrl = route('qrcode-page', ['id' => $encryptedId]); // URL tujuan dari QR Code
        $qrCodePath = $qrDirectory . '/' . Uuid::uuid4()->toString() . '.png';
        QrCode::format('png')->generate($qrCodeUrl, $qrCodePath);

        // Ambil nilai additional_fields sebagai array
        if (is_string($formSurat->additional_fields)) {
            $additionalFields = json_decode($formSurat->additional_fields, true);
            $formSurat->update([
                $additionalFields->ttd => $qrCodePath,
                $additionalFields['nomor_surat'] =$id,
                $additionalFields->nomor_surat => $this->formatTanggal(now()),
            ]);
        } else {
            $additionalFields = $formSurat->additional_fields;
            $additionalFields['ttd'] = $qrCodePath;
            $additionalFields['nomor_surat'] = $id;
            $additionalFields['tanggal_surat'] = $this->formatTanggal(now());
        }

        $formSurat->additional_fields = $additionalFields;
        // Set nilai yang telah dimodifikasi kembali ke properti additional_fields
        $formSurat->save();

        $pengajuanSurat->update([
            'status' => 'disetujui',
            'alasan_di_tolak' => null
        ]);
        $this->templating($formSurat, $qrCodePath, $pengajuanSurat);
        return back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function templating($formSurat, $qrCodePath, $surat){
        // Direktori output untuk menyimpan dokumen
        $additionalFields = $formSurat->additional_fields;

        $outputDirectory = storage_path('app/documents');
        if (!File::isDirectory($outputDirectory)) {
            File::makeDirectory($outputDirectory, 0755, true);
        }


        // Template path selection based on the number of mahasiswa
        if( $formSurat->keperluan_surat === 'Skripsi'){
            $templatePath = storage_path('app/templates/Template Surat Pengantar Penelitian(Skripsi).docx');
        }else{
            $templatePath = storage_path('app/templates/Template Surat Pengantar Penelitian.docx');
        }

        if (!file_exists($templatePath)) {
            return back()->with('error', 'Template not found.');
        }

        $qrDirectory = storage_path('app/qr_codes');
        if (!File::isDirectory($qrDirectory)) {
            File::makeDirectory($qrDirectory, 0755, true);
        }
        

       $templateProcessor = new TemplateProcessor($templatePath);

       $mahasiswa = [];
   
       // Menambahkan data mahasiswa dan NIM ke array baru
       if (isset($additionalFields['nama_mahasiswa']) && isset($additionalFields['nim'])) {
           $mahasiswa[] = [
               'nama_mahasiswa' => $additionalFields['nama_mahasiswa'],
               'nim' => $additionalFields['nim'],
           ];
       }
       if (isset($additionalFields['nama_mahasiswa_2']) && isset($additionalFields['nim_2'])) {
           $mahasiswa[] = [
               'nama_mahasiswa' => $additionalFields['nama_mahasiswa_2'],
               'nim' => $additionalFields['nim_2'],
           ];
       }
       if (isset($additionalFields['nama_mahasiswa_3']) && isset($additionalFields['nim_3'])) {
           $mahasiswa[] = [
               'nama_mahasiswa' => $additionalFields['nama_mahasiswa_3'],
               'nim' => $additionalFields['nim_3'],
           ];
       }
       if (isset($additionalFields['nama_mahasiswa_4']) && isset($additionalFields['nim_4'])) {
           $mahasiswa[] = [
               'nama_mahasiswa' => $additionalFields['nama_mahasiswa_4'],
               'nim' => $additionalFields['nim_4'],
           ];
       }
       $templateProcessor->cloneRow('nama_mahasiswa', count($mahasiswa));
       foreach ($mahasiswa as $index => $m) {
           $rowIndex = $index + 1;
           $templateProcessor->setValue("no#{$rowIndex}", $rowIndex);
           $templateProcessor->setValue("nim#{$rowIndex}", $m['nim']);
           $templateProcessor->setValue("nama_mahasiswa#{$rowIndex}", $m['nama_mahasiswa']);
           $templateProcessor->setValue("jurusan#{$rowIndex}", $formSurat->jurusan);
       }

       $templateProcessor->setValue('nomor_surat', $surat->id);
       $templateProcessor->setValue('tanggal_surat', $this->formatTanggal(now())); // Menggunakan tanggal saat ini
       $templateProcessor->setValue('keperluan_surat', $formSurat->keperluan_surat);
       $templateProcessor->setValue('surat_ditujukan_kepada', $formSurat->surat_ditujukan_kepada);
       $templateProcessor->setValue('nama_perusahaan', $formSurat->nama_perusahaan);
       $templateProcessor->setValue('alamat_perusahaan', $formSurat->alamat_perusahaan);
       $templateProcessor->setValue('kode_pos_perusahaan', $formSurat->kode_pos_perusahaan);
       $templateProcessor->setValue('jurusan', $formSurat->jurusan);
       $templateProcessor->setValue('dosen_pembimbing', $formSurat->dosen_pembimbing);
       $templateProcessor->setValue('waktu_kerja_praktik', $formSurat->waktu_kerja_praktik);
       $templateProcessor->setValue('tugas_mata_kuliah', $formSurat->tugas_mata_kuliah);
       $templateProcessor->setValue('topik_judul_yang_dibahas', $formSurat->topik_judul_yang_dibahas);
       if($formSurat->melampirkan_proposal){
           $templateProcessor->setValue('melampirkan_proposal', 'melampirkan 1 berkas');
       }
       $templateProcessor->setImageValue('ttd', $qrCodePath);

       foreach ($additionalFields as $key => $value) {
           $templateProcessor->setValue($key, $value);
       }

       // Simpan dokumen baru dengan UUID sebagai nama file
       $newFileName = Uuid::uuid4()->toString() . '.docx';
       $newFilePath = 'documents/' . $newFileName;
       $templateProcessor->saveAs(storage_path('app/' . $newFilePath));

       // Update surat data with the new file path
       $surat->file_surat = $newFilePath;
       $surat->save();
   }

   private function formatTanggal($tanggal) {
    $date = new DateTime($tanggal);
    $bulan = array(
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );
    $formattedTanggal = $date->format('d') . ' ' . $bulan[(int)$date->format('m')] . ' ' . $date->format('Y');
    return $formattedTanggal;
}


}