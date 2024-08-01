<?php

namespace App\Http\Controllers;

use App\Models\FormPengajuanSuratMahasiswaAktif;
use App\Models\Surat;
use App\Models\User;
use App\Services\FetchMahasiswaService;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use PhpOffice\PhpWord\TemplateProcessor;
use Ramsey\Uuid\Uuid;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FormPengajuanSuratMahasiswaAktifController extends Controller
{
    private function formatTanggal($tanggal) {
        $date = new DateTime($tanggal);
        $bulan = array(
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );
        $formattedTanggal = $date->format('d') . ' ' . $bulan[(int)$date->format('m')] . ' ' . $date->format('Y');
        return $formattedTanggal;

        
    }
    public function index()
    {
        $kategoriSurat = DB::table('kategori_surat')->where('nama', 'Surat Keterangan Mahasiswa Aktif')->first();

        if (!$kategoriSurat) {
            return redirect()->back()->with('error', 'Kategori surat tidak ditemukan.');
        }

        $riwayat = Surat::with('user', 'kategoriSurat')
                        ->where('user_id', Auth::id())
                        ->where('kategori_surat_id', $kategoriSurat->id)
                        ->get();

        return view('page.deskripsi.mahasiswa-aktif', compact('riwayat'));
    }
    public function create()
    {
        $userId = Auth::id();

        // Mengecek apakah ada surat dengan status 'pending' untuk user ini
        $pendingSurat = Surat::where('user_id', $userId)
                             ->where('status', Surat::STATUS_PENDING)->where('kategori_surat_id', 2)
                             ->first();

                             if ($pendingSurat) {
                                return redirect()->route('page.pending');
                            }

        $fetchmahasiswa = new FetchMahasiswaService();
        $data_mahasiswa = $fetchmahasiswa->fetchDataMahasiswa(Auth::user()->email);
        $nim = $data_mahasiswa['mhs_nim'];   
        $apiUrl = "https://testing.uisi.ac.id/siakad/api/get_data_transkrip?mhs_nim=" . $nim ."&lang=id&token=" . env('API_TOKEN');        

        $response = Http::get($apiUrl);
        $data = $response->json();
        $data_mahasiswa = $data['data'];
        $tanggal_lahir_api = $data_mahasiswa['mhs_tgllahir'];
        $data_mahasiswa['mhs_tgllahir'] = Carbon::createFromFormat('j F Y', $tanggal_lahir_api)->format('Y-m-d');
        return view('page.deskripsi.buat-mahasiswa-aktif', compact('data_mahasiswa'));
        
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'jurusan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'tahun_akademik' => 'required|string|max:100',
            'nama_orang_tua' => 'required|string|max:255',
            'pekerjaan_orang_tua' => 'required|string|max:255',
            'alamat_orang_tua' => 'required|string',
            'keperluan' => 'required|string',
            'opsi_surat' => 'required|string|max:20',
        ]);

        // Cari kategori surat "surat keterangan mahasiswa aktif"
        $kategoriSurat = DB::table('kategori_surat')->where('nama', 'surat keterangan mahasiswa aktif')->first();
        if (!$kategoriSurat) {
            return back()->with('error', 'Kategori surat tidak ditemukan.');
        }

        // Buat entri baru di tabel surat
        $surat = Surat::create([
            'user_id' => Auth::id(),
            'kategori_surat_id' => $kategoriSurat->id,
            'status' => 'pending',
            'file_surat' => $request->file_surat
        ]);

        // Tambahkan surat_id ke data yang divalidasi
        $validated['surat_id'] = $surat->id;

        // Simpan data ke tabel FormPengajuanSuratMahasiswaAktif
        FormPengajuanSuratMahasiswaAktif::create($validated);

        // Redirect dengan pesan sukses
        session()->flash('success', 'Surat berhasil diajukan.');

        return redirect()->route('mahasiswa-aktif-index');
    }

    public function edit($id){
        $pengajuanSurat = Surat::findOrFail($id);
        $user = User::findOrFail($pengajuanSurat->user_id);
        $formSurat = FormPengajuanSuratMahasiswaAktif::where('surat_id', $id)->first();


        if (is_string($formSurat->additional_fields)) {
            $additionalFields = json_decode($formSurat->additional_fields, true);
        } else {
            $additionalFields = $formSurat->additional_fields;
        }

        if (isset($additionalFields['ttd'])) {
            unset($additionalFields['ttd']);
        }

        return view('page.staff.edit-surat-mahasiswa-aktif', compact('id', 'pengajuanSurat', 'user', 'formSurat', 'additionalFields'));
    }

    public function getTotalApprovedSuratCount()
    {
        $totalApprovedSuratCount = Surat::where('status', Surat::STATUS_APPROVED)
                                        ->count();

        return $totalApprovedSuratCount;
    }

    public function update(Request $request, $id)
    {
        function formatTanggal($tanggal) {
            $date = new DateTime($tanggal);
            $bulan = array(
                1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            );
            $formattedTanggal = $date->format('d') . ' ' . $bulan[(int)$date->format('m')] . ' ' . $date->format('Y');
            return $formattedTanggal;
        }

        // Direktori output untuk menyimpan dokumen
        $outputDirectory = storage_path('app/documents');
        if (!File::isDirectory($outputDirectory)) {
            File::makeDirectory($outputDirectory, 0755, true);
        }

        // Direktori untuk menyimpan QR code
        $qrDirectory = storage_path('app/qr_codes');
        if (!File::isDirectory($qrDirectory)) {
            File::makeDirectory($qrDirectory, 0755, true);
        }

        // Generate QR Code
        $encryptedId = Crypt::encryptString($id);
        $qrCodeUrl = route('qrcode-page', ['id' => $encryptedId]); // URL tujuan dari QR Code
        $qrCodePath = $qrDirectory . '/' . Uuid::uuid4()->toString() . '.png';
        QrCode::format('png')->generate($qrCodeUrl, $qrCodePath);
        
        // Template path selection based on the number of mahasiswa
        $additionalFields = $request->input('additional_fields', []);
        $templatePath = storage_path('app/templates/Template Surat Keterangan Mahasiswa Aktif.docx');

        if (!file_exists($templatePath)) {
            return back()->with('error', 'Template not found.');
        }

        // Update formSurat data
        $formSurat = FormPengajuanSuratMahasiswaAktif::where('surat_id', $id)->first();
        $formSurat->nama_mahasiswa = $request->nama_mahasiswa;
        $formSurat->nim = $request->nim;
        $formSurat->jurusan = $request->jurusan;
        $formSurat->alamat = $request->alamat;
        $formSurat->tempat_lahir = $request->tempat_lahir;
        $formSurat->tanggal_lahir = $request->tanggal_lahir;
        $formSurat->tahun_akademik = $request->tahun_akademik;
        $formSurat->nama_orang_tua = $request->nama_orang_tua;
        $formSurat->pekerjaan_orang_tua = $request->pekerjaan_orang_tua;
        $formSurat->alamat_orang_tua = $request->alamat_orang_tua;
        $formSurat->keperluan = $request->keperluan;
        $formSurat->opsi_surat = $request->opsi_surat;

        $additionalFields = $formSurat->additional_fields ?? [];
        $additionalFields['ttd'] = $qrCodePath;
        $additionalFields['nomor_surat'] = $id;
        $additionalFields['tanggal_surat'] = $request->tanggal_surat;
        $formSurat->additional_fields = $additionalFields;

        $formSurat->save();

        // Create document from template
        $templateProcessor = new TemplateProcessor($templatePath);
        $templateProcessor->setValue('nama-mahasiswa', $request->nama_mahasiswa);
        $templateProcessor->setValue('nim', $request->nim);
        $templateProcessor->setValue('jurusan', $request->jurusan);
        $templateProcessor->setValue('alamat', $request->alamat);
        $templateProcessor->setValue('tempat-lahir', $request->tempat_lahir);
        $templateProcessor->setValue('tanggal-lahir', $request->tanggal_lahir);
        $templateProcessor->setValue('tahun-akademik', $request->tahun_akademik);
        $templateProcessor->setValue('nama-orang-tua', $request->nama_orang_tua);
        $templateProcessor->setValue('pekerjaan', $request->pekerjaan_orang_tua);
        $templateProcessor->setValue('alamat-orang-tua', $request->alamat_orang_tua);
        $templateProcessor->setValue('keperluan', $request->keperluan);
        $templateProcessor->setValue('opsi_surat', $request->opsi_surat);
        $templateProcessor->setValue('tanggal_surat', $request->tanggal_surat);
        $templateProcessor->setValue('nomor_surat', $request->nomor_surat);

        $templateProcessor->setImageValue('ttd', $qrCodePath);

        // Simpan dokumen baru dengan UUID sebagai nama file
        $newFileName = Uuid::uuid4()->toString() . '.docx';
        $newFilePath = 'documents/' . $newFileName;
        $templateProcessor->saveAs(storage_path('app/' . $newFilePath));

        // Update surat data with the new file path
        $surat = Surat::findOrFail($id);
        $surat->file_surat = $newFilePath;
        $surat->save();

        return redirect()->route('staff_page')->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function showAlasanDiTolak($id){
        $surat = Surat::findOrFail($id);
        $alasan = $surat->alasan_ditolak;
        return view('page.tolak.mahasiswa-aktif-tolak', compact('alasan'));
    }

    public function setujui($id)
    {

        $pengajuanSurat = Surat::find($id);
        $formSurat = FormPengajuanSuratMahasiswaAktif::where('surat_id', $id)->first();

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
                $additionalFields['nomor_surat'] = $id,
                $additionalFields->tanggal_surat => $this->formatTanggal(now()),
            ]);
        } else {
            $additionalFields = $formSurat->additional_fields;
            $additionalFields['ttd'] = $qrCodePath;
            $additionalFields['nomor_surat'] =$id;
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

    private function templating($formSurat, $qrCodePath, $surat){
        // Direktori output untuk menyimpan dokumen
        $additionalFields = $formSurat->additional_fields;

        $outputDirectory = storage_path('app/documents');
        if (!File::isDirectory($outputDirectory)) {
            File::makeDirectory($outputDirectory, 0755, true);
        }


        // Template path selection based on the number of mahasiswa
        $templatePath = storage_path('app/templates/Template Surat Keterangan Mahasiswa Aktif.docx');
        // if (isset($additionalFields['nama_mahasiswa_2']) && $additionalFields['nama_mahasiswa_2']) {
        //     $templatePath = storage_path('app/templates/Contoh Surat Keterangan Magang-2.docx');
        //     if (isset($additionalFields['nama_mahasiswa_3']) && $additionalFields['nama_mahasiswa_3']) {
        //         $templatePath = storage_path('app/templates/Contoh Surat Keterangan Magang-3.docx');
        //         if (isset($additionalFields['nama_mahasiswa_4']) && $additionalFields['nama_mahasiswa_4']) {
        //             $templatePath = storage_path('app/templates/Contoh Surat Keterangan Magang-4.docx');
        //         }
        //     }
        // }

        if (!file_exists($templatePath)) {
            return back()->with('error', 'Template not found.');
        }

        $qrDirectory = storage_path('app/qr_codes');
        if (!File::isDirectory($qrDirectory)) {
            File::makeDirectory($qrDirectory, 0755, true);
        }
        
       $templateProcessor = new TemplateProcessor($templatePath);
       $templateProcessor->setValue('nama_mahasiswa', $formSurat->nama_mahasiswa);
       $templateProcessor->setValue('nim', $formSurat->nim);
       $templateProcessor->setValue('jurusan', $formSurat->jurusan);
       $templateProcessor->setValue('alamat', $formSurat->alamat);
       $templateProcessor->setValue('tempat_lahir', $formSurat->tempat_lahir);
       // $templateProcessor->setValue('nomor_surat', $formSurat->nomor_surat);
       $templateProcessor->setValue('tanggal_lahir', Carbon::parse($formSurat->tanggal_lahir)->format('d M Y'));
       $templateProcessor->setValue('tahun_akademik', $formSurat->tahun_akademik);
       $templateProcessor->setValue('nama_orang_tua', $formSurat->nama_orang_tua);
       $templateProcessor->setValue('pekerjaan_orang_tua', $formSurat->pekerjaan_orang_tua);
       $templateProcessor->setValue('alamat_orang_tua', $formSurat->alamat_orang_tua);
       $templateProcessor->setValue('keperluan', $formSurat->keperluan);
    //    $templateProcessor->setValue('opsi_surat', $formSurat->opsi_surat);
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

}