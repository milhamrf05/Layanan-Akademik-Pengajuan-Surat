<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use App\Models\FormSurat;
use App\Models\Surat;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpWord\TemplateProcessor;
use Ramsey\Uuid\Uuid;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PengantarMagangStaffController extends Controller
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
    public function show($id)
    {
        $pengajuanSurat = Surat::findOrFail($id);
        $jenisFile = $pengajuanSurat->jenis_file;
        $user = User::findOrFail($pengajuanSurat->user_id);
        $formSurat = FormSurat::where('surat_id', $id)->first();

        // Periksa apakah additional_fields adalah string sebelum melakukan json_decode
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


        return view('page.staff.pengantar-magang.show', compact('id', 'pengajuanSurat', 'user', 'jenisFile', 'formSurat', 'additionalFields'));
    }

    public function setujui($id)
    {

        $pengajuanSurat = Surat::find($id);
        $formSurat = FormSurat::where('surat_id', $id)->first();

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

    public function showTolak($id){
        $pengajuanSurat = Surat::findOrFail($id);
        return view('page.staff.pengantar-magang.ditolak', compact('pengajuanSurat'));
    }
   public function tolak(Request $request, $id)
{
    $surat = Surat::find($id);
    $surat->update([
        'status' => 'ditolak',
        'alasan_ditolak' => $request->input('alasan_ditolak') // Set alasan ditolak
    ]);

    session()->flash('success', 'Berhasil Menolak dokumen.');

    return redirect()->route('staff_page');
}


    public function editPengantarMagang($id)
    {
        $pengajuanSurat = Surat::findOrFail($id);
        $jenisFile = $pengajuanSurat->jenis_file;
        $user = User::findOrFail($pengajuanSurat->user_id);
        $formSurat = FormSurat::where('surat_id', $id)->first();

        // Periksa apakah additional_fields adalah string sebelum melakukan json_decode
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


        return view('page.staff.edit-surat-pengantar-magang', compact('id', 'pengajuanSurat', 'user', 'jenisFile', 'formSurat', 'additionalFields'));
    }


    public function updatePengantarMagang(Request $request, $id)
    {
        // Direktori output untuk menyimpan dokumen
        $outputDirectory = storage_path('app/documents');
        if (!File::isDirectory($outputDirectory)) {
            File::makeDirectory($outputDirectory, 0755, true);
        }

        // Template path selection based on the number of mahasiswa
        $additionalFields = $request->input('additional_fields', []);
        $templatePath = storage_path('app/templates/Contoh Surat Keterangan Magang-1.docx');
        if (isset($additionalFields['nama_mahasiswa_2']) && $additionalFields['nama_mahasiswa_2']) {
            $templatePath = storage_path('app/templates/Contoh Surat Keterangan Magang-2.docx');
            if (isset($additionalFields['nama_mahasiswa_3']) && $additionalFields['nama_mahasiswa_3']) {
                $templatePath = storage_path('app/templates/Contoh Surat Keterangan Magang-3.docx');
                if (isset($additionalFields['nama_mahasiswa_4']) && $additionalFields['nama_mahasiswa_4']) {
                    $templatePath = storage_path('app/templates/Contoh Surat Keterangan Magang-4.docx');
                }
            }
        }

        if (!file_exists($templatePath)) {
            return back()->with('error', 'Template not found.');
        }

        $qrDirectory = storage_path('app/qr_codes');
        if (!File::isDirectory($qrDirectory)) {
            File::makeDirectory($qrDirectory, 0755, true);
        }

        // Generate QR Code
        $encryptedId = Crypt::encryptString($id);
        $qrCodeUrl = route('qrcode-page', ['id' => $encryptedId]); // URL tujuan dari QR Code
        $qrCodePath = $qrDirectory . '/' . Uuid::uuid4()->toString() . '.png';
        QrCode::format('png')->generate($qrCodeUrl, $qrCodePath);

        // Update formSurat data
        $formSurat = FormSurat::where('surat_id', $id)->first();
        $formSurat->nim_1 = $request->nim_1;
        $formSurat->no_hp = $request->no_hp;
        $formSurat->email_mahasiswa = $request->email_mahasiswa;
        $formSurat->jurusan = $request->jurusan;

        if ($request->has('additional_fields')) {
            $additionalFields = $request->input('additional_fields');
            if (isset($additionalFields['_token'])) {
                unset($additionalFields['_token']);
            }

            $additionalFields['ttd'] = $qrCodePath;
            $additionalFields['nomor_surat'] = $request->nomor_surat;
            $additionalFields['tanggal_surat'] = $this->formatTanggal(now()); // Menggunakan tanggal saat ini
            $formSurat->additional_fields = $additionalFields;
        }
        $formSurat->save();

        // Create document from template
        $templateProcessor = new TemplateProcessor($templatePath);
        $templateProcessor->setValue('nama_mahasiswa_2', $request->nama_mahasiswa_2);
        $templateProcessor->setValue('nama_mahasiswa_1', $request->nama_mahasiswa_1);
        $templateProcessor->setValue('nim_1', $request->nim_1);
        $templateProcessor->setValue('no_hp', $request->no_hp);
        $templateProcessor->setValue('email_mahasiswa', $request->email_mahasiswa);
        $templateProcessor->setValue('nomor_surat', $request->nomor_surat);
        $templateProcessor->setValue('tanggal_surat', $this->formatTanggal(now())); // Menggunakan tanggal saat ini
        $templateProcessor->setValue('jurusan', $request->jurusan);
        $templateProcessor->setValue('berkas_proposal', $request->berkas_proposal);
        $templateProcessor->setImageValue('ttd', $qrCodePath);

        // foreach ($request->additional_fields as $key => $value) {
        //     $templateProcessor->setValue($key, $value);
        // }

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

    private function templating($formSurat, $qrCodePath, $surat){
         // Direktori output untuk menyimpan dokumen
         $additionalFields = $formSurat->additional_fields;

         $outputDirectory = storage_path('app/documents');
         if (!File::isDirectory($outputDirectory)) {
             File::makeDirectory($outputDirectory, 0755, true);
         }


         // Template path selection based on the number of mahasiswa
         $templatePath = storage_path('app/templates/Template Surat Pengantar Magang.docx');
        //  if (isset($additionalFields['nama_mahasiswa_2']) && $additionalFields['nama_mahasiswa_2']) {
        //      $templatePath = storage_path('app/templates/Contoh Surat Keterangan Magang-2.docx');
        //      if (isset($additionalFields['nama_mahasiswa_3']) && $additionalFields['nama_mahasiswa_3']) {
        //          $templatePath = storage_path('app/templates/Contoh Surat Keterangan Magang-3.docx');
        //          if (isset($additionalFields['nama_mahasiswa_4']) && $additionalFields['nama_mahasiswa_4']) {
        //              $templatePath = storage_path('app/templates/Contoh Surat Keterangan Magang-4.docx');
        //          }
        //      }
        //  }

         if (!file_exists($templatePath)) {
             return back()->with('error', 'Template not found.');
         }

         $qrDirectory = storage_path('app/qr_codes');
         if (!File::isDirectory($qrDirectory)) {
             File::makeDirectory($qrDirectory, 0755, true);
         }
         
        $templateProcessor = new TemplateProcessor($templatePath);
        $templateProcessor->setValue('no_hp', $formSurat->no_hp);
        $templateProcessor->setValue('email_mahasiswa', $formSurat->email_mahasiswa);
        $templateProcessor->setValue('tanggal_surat', $this->formatTanggal(now())); // Menggunakan tanggal saat ini
        $templateProcessor->setValue('jurusan', $formSurat->jurusan);
        $templateProcessor->setImageValue('ttd', $qrCodePath);
        $mahasiswa = [];
        $mahasiswa[] = [
            'nama_mahasiswa' => $formSurat->nama_mahasiswa_1,
            'nim' => $formSurat->nim_1
        ];
        
    
        // Menambahkan data mahasiswa dan NIM ke array baru
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
        $templateProcessor->cloneRow('nim_1', count($mahasiswa));
        foreach ($mahasiswa as $index => $m) {
            $rowIndex = $index + 1;
            $templateProcessor->setValue("no#{$rowIndex}", $rowIndex);
            $templateProcessor->setValue("nim_1#{$rowIndex}", $m['nim']);
            $templateProcessor->setValue("nama_mahasiswa_1#{$rowIndex}", $m['nama_mahasiswa']);
        }
        foreach ($additionalFields as $key => $value) {
            if($key === "tanggal_mulai_magang"){
                $templateProcessor->setValue($key, $this->formatTanggal($value));
            }elseif($key === "tanggal_akhir_magang"){
                $templateProcessor->setValue($key, $this->formatTanggal($value));
            }elseif($key === "nama_mahasiswa_2"){
            }elseif($key === "nama_mahasiswa_3"){
            }elseif($key === "nama_mahasiswa_4"){
                
            }else{
                $templateProcessor->setValue($key, $value);
            }
        }
        
        $templateProcessor->setValue('nama_mahasiswa_1', $formSurat->nama_mahasiswa_1);
        // Simpan dokumen baru dengan UUID sebagai nama file
        $newFileName = Uuid::uuid4()->toString() . '.docx';
        $newFilePath = 'documents/' . $newFileName;
        $templateProcessor->saveAs(storage_path('app/' . $newFilePath));

        // Update surat data with the new file path
        $surat->file_surat = $newFilePath;
        $surat->save();
    }

    public function getTotalApprovedSuratCount()
    {
        $totalApprovedSuratCount = Surat::where('status', Surat::STATUS_APPROVED)
                                        ->count();

        return $totalApprovedSuratCount;
    }
}