<?php

namespace App\Http\Controllers;

use App\Models\KategoriSurat;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;
use NcJoes\OfficeConverter\OfficeConverter;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $kategoriName = $request->input('kategori_name');
        $status = $request->input('status');
        $perPage = 10; // Jumlah item per halaman
    
        $query = Surat::with('user', 'kategoriSurat');
    
        if ($kategoriName) {
            $query->whereHas('kategoriSurat', function ($query) use ($kategoriName) {
                $query->where('nama', $kategoriName);
            });
        }
    
        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }
    
        $pengajuanSurat = $query->latest()->paginate($perPage);
        $kategoriSurat = KategoriSurat::all();
    
        return view('page.staff.main', compact('pengajuanSurat', 'kategoriSurat'));
    }
    
    


    public function downloadFile($id)
    {
        $outputDirectory = storage_path('app/documents');
        if (!File::isDirectory($outputDirectory)) {
            File::makeDirectory($outputDirectory, 0755, true);
        }
        // Cari pengajuan surat berdasarkan id
        $pengajuanSurat = Surat::find($id);

        if (!$pengajuanSurat) {
            return redirect()->back()->with('error', 'Pengajuan surat tidak valid.');
        }

        // Dapatkan path file surat dan pastikan hanya bagian relatif yang diambil
        $filePath = str_replace('C:\skripsi\storage\app/', '', $pengajuanSurat->file_surat);

        // Pastikan path benar untuk penyimpanan di Laravel
        $fullPath = storage_path('app/' . $filePath);

        if (!File::exists($fullPath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        $uuid = Uuid::uuid4()->toString();
        $randomFileName = $uuid . '.pdf';
        $converter = new OfficeConverter($fullPath, null, 'soffice', false);
        $converter->convertTo('../pdf/'.$randomFileName);
        $outputPath = storage_path('app/pdf/') . $randomFileName;
        return response()->download($outputPath);
    }


}