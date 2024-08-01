<?php

namespace App\Http\Controllers;

use App\Services\FetchMahasiswaService;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use NcJoes\OfficeConverter\OfficeConverter;
use PhpOffice\PhpWord\TemplateProcessor;
use Ramsey\Uuid\Uuid;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TranskripAkademikSementaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.deskripsi.transkrip-akademik-sementara');
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

    private function formatTanggal($tanggal) {
        $date = new DateTime($tanggal);
        $bulan = array(
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );
        $formattedTanggal = $date->format('d') . ' ' . $bulan[(int)$date->format('m')] . ' ' . $date->format('Y');
        return $formattedTanggal;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fetchmahasiswa = new FetchMahasiswaService();
        $data_mahasiswa = $fetchmahasiswa->fetchDataMahasiswa(Auth::user()->email);
        $nim = $data_mahasiswa['mhs_nim'];
        $apiUrl = "https://testing.uisi.ac.id/siakad/api/get_data_transkrip?mhs_nim=" . $nim . '&lang=' . $request->lang . '&token=' .  env('API_TOKEN');

        $response = Http::get($apiUrl);
        $data = $response->json();

        $outputDirectory = storage_path('app/documents');
        if (!File::isDirectory($outputDirectory)) {
            File::makeDirectory($outputDirectory, 0755, true);
        }

        $qrDirectory = storage_path('app/qr_codes');
        if (!File::isDirectory($qrDirectory)) {
            File::makeDirectory($qrDirectory, 0755, true);
        }

        $templatePath = storage_path('app/templates/Transkrip Akademik v2.docx');

        $templateProcessor = new TemplateProcessor($templatePath);

        $newFileName = Uuid::uuid4()->toString() . '.docx';
        $newFilePath = 'documents/transkrip/'.$newFileName;

        $qrCodeUrl = route('qrcode-page-transkrip', ['id' => $newFileName]); // URL tujuan dari QR Code
        $qrCodePath = $qrDirectory . '/' . Uuid::uuid4()->toString() . '.png';
        QrCode::format('png')->generate($qrCodeUrl, $qrCodePath);

        $templateProcessor->setValue('jurusan', $data['data']['mhs_prodi']);
        $templateProcessor->setValue('nama_mahasiswa', $data['data']['mhs_nama']);
        $templateProcessor->setValue('nim', $data['data']['mhs_nim']);
        $templateProcessor->setValue('ipk', $data['data']['mhs_ipk']);
        $templateProcessor->setValue('knv_indeksangka', $data['data']['mhs_ipk']);
        $templateProcessor->setValue('tahun_masuk', $data['data']['mhs_tahunmasuk']);
        $templateProcessor->setValue('tanggal_surat', $this->formatTanggal(now()));
        $templateProcessor->setImageValue('ttd', $qrCodePath);

        $templateProcessor->cloneRow('mku_kode', count($data['data']['transkrip']));
        $total_sks = 0;
        $total_poin = 0;
        foreach ($data['data']['transkrip'] as $index => $transkrip) {
            $rowIndex = $index + 1;
            $templateProcessor->setValue("no#{$rowIndex}", $rowIndex);
            $templateProcessor->setValue("mku_kode#{$rowIndex}", $transkrip['mku_kode']);
            $templateProcessor->setValue("mkl_nama#{$rowIndex}", $transkrip['mkl_nama']);
            $templateProcessor->setValue("mku_sks#{$rowIndex}", $transkrip['mku_sks']);
            $templateProcessor->setValue("khs_nilai_huruf#{$rowIndex}", $transkrip['khs_nilaihuruf']);
            $templateProcessor->setValue("poin#{$rowIndex}", $transkrip['knv_indeksangka']);
            $total_sks += (int)$transkrip['mku_sks'];
            $total_poin += (float)$transkrip['knv_indeksangka'];
        }
        $templateProcessor->setValue('total_sks', $total_sks);
        $templateProcessor->setValue('total_poin', $total_poin);
        $templateProcessor->saveAs(storage_path('app/' . $newFilePath));

        $uuid = Uuid::uuid4()->toString();
        $randomFileName = $uuid . '.pdf';
        $converter = new OfficeConverter(storage_path('app/' . $newFilePath), null, 'soffice', false);
        $converter->convertTo($randomFileName);
        $outputPath = storage_path('app/documents/transkrip/') . $randomFileName;
        return response()->download($outputPath);
    }

    // public function downloadFile($id)
    // {
    //     $outputDirectory = storage_path('app/documents');
    //     if (!File::isDirectory($outputDirectory)) {
    //         File::makeDirectory($outputDirectory, 0755, true);
    //     }
    //     // Cari pengajuan surat berdasarkan id
    //     $pengajuanSurat = Surat::find($id);

    //     if (!$pengajuanSurat) {
    //         return redirect()->back()->with('error', 'Pengajuan surat tidak valid.');
    //     }

    //     // Dapatkan path file surat dan pastikan hanya bagian relatif yang diambil
    //     $filePath = str_replace('C:\skripsi\storage\app/', '', $pengajuanSurat->file_surat);

    //     // Pastikan path benar untuk penyimpanan di Laravel
    //     $fullPath = storage_path('app/' . $filePath);

    //     if (!File::exists($fullPath)) {
    //         return redirect()->back()->with('error', 'File tidak ditemukan.');
    //     }

    //     $uuid = Uuid::uuid4()->toString();
    //     $randomFileName = $uuid . '.pdf';
    //     $converter = new OfficeConverter($fullPath, null, 'soffice', false);
    //     $converter->convertTo('../pdf/'.$randomFileName);
    //     $outputPath = storage_path('app/pdf/') . $randomFileName;
    //     return response()->download($outputPath);
    // }

}