<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function index()
    {
        // Mendapatkan semua file yang ada di folder 'templates'
        $surat = Storage::files('templates');

        // Mengembalikan tampilan dengan daftar file
        return view('page.admin.main', compact('surat'));
    }

    public function store(Request $request)
    {
        // Memastikan ada file yang diunggah dalam permintaan
        if (!$request->hasFile('file')) {
            return redirect()->back()->with('error', 'Tidak ada file yang diunggah.');
        }

        // Validasi bahwa template telah dipilih
        if (!$request->has('template')) {
            return redirect()->back()->with('error', 'Tidak ada template yang dipilih.');
        }

        $file = $request->file('file');
        $templateToReplace = $request->input('template'); // Template yang dipilih pengguna

        // Periksa apakah file template yang ingin diganti ada
        if (Storage::exists('templates/' . $templateToReplace)) {
            // Hapus file template yang sudah ada
            Storage::delete('templates/' . $templateToReplace);
        }

        // Simpan file baru dengan nama template yang ada
        $file->storeAs('templates', $templateToReplace);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'File berhasil diunggah dan diganti.');
    }

    public function show($filename)
    {
        // Dekode nama file yang diberikan
        $decodedFilename = urldecode($filename);

        // Unduh file dari storage
        return Storage::download('templates/' . $decodedFilename);
    }
}