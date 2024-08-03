<?php

namespace App\Http\Controllers;

use App\Models\PengunduranDiri;
use App\Models\Surat;
use App\Models\User;
use App\Services\FetchMahasiswaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengunduranDiriController extends Controller
{
    public function index(){
        $kategoriSurat = DB::table('kategori_surat')->where('nama', 'Surat Pengunduran Diri')->first();

        if (!$kategoriSurat) {
            return redirect()->back()->with('error', 'Kategori surat tidak ditemukan.');
        }

        $riwayat = Surat::with('user', 'kategoriSurat')
                        ->where('user_id', Auth::id())
                        ->where('kategori_surat_id', $kategoriSurat->id)
                        ->get();

        return view('page.deskripsi.pengunduran-diri', compact('riwayat'));
    }

    public function downloadFile(){
        return response()->download(storage_path('app/templates/Form Pengunduran diri.pdf'));
    }

    public function create(){
        $userId = Auth::id();

        // Mengecek apakah ada surat dengan status 'pending' untuk user ini
        $pendingSurat = Surat::where('user_id', $userId)
                             ->where('status', Surat::STATUS_PENDING)->where('kategori_surat_id', 5)
                             ->first();

                             if ($pendingSurat) {
                                return redirect()->route('page.pending');
                                
                            }

                            $user = User::findOrFail($userId);
                            $fetchMahasiswaService = new FetchMahasiswaService();
                            $mahasiswa = $fetchMahasiswaService->fetchDataMahasiswa($user->email);

        return view('page.deskripsi.buat-pengunduran-diri', compact('mahasiswa'));
    }

    public function store(Request $request){
        $request->validate([
            'file' => 'required|mimes:docx,pdf|max:10000', // max:2048 artinya ukuran maksimum adalah 2MB
        ]);

        if ($request->file('file')) {
            $file = $request->file('file');
            $file ->storeAs('public/surat-pengunduran-diri', $file->hashName());

            $kategoriSurat = DB::table('kategori_surat')->where('nama', '=' ,'Surat Pengunduran Diri')->first();
            $surat = Surat::create([
                'user_id' => Auth::id(),
                'kategori_surat_id' => $kategoriSurat->id,
                'status' => 'pending',
                'file_surat' => $request->file_surat
            ]);

            PengunduranDiri::create([
                'surat_id' => $surat->id,
                'file' => $file->hashName()
            ]);
            session()->flash('success', 'Surat berhasil diajukan.');

            return redirect()->route('pengunduranDiriIndex');
        }                          

        return back()->withErrors(['document' => 'No file uploaded']);
    }

    public function showAlasanDiTolak($id){
        $surat = Surat::findOrFail($id);
        $alasan = $surat->alasan_ditolak;
        return view('page.tolak.pengunduran-diri-tolak', compact('alasan'));
    }

    public function show($id)
    {
        // Ambil data cuti akademik berdasarkan surat_id
        $pengunduranDiri = PengunduranDiri::where('surat_id', $id)->first();
        // Pastikan bahwa data cuti akademik ditemukan
        if ($pengunduranDiri && $pengunduranDiri->file) {
            // Buat URL untuk file tersebut
            $url = Storage::url('surat-pengunduran-diri/' . $pengunduranDiri->file);

            // Redirect ke URL dalam tab baru
            return response()->make('<script>window.open("' . $url . '", "_blank");</script>', 200, ['Content-Type' => 'text/html']);
        }

        return response()->make('<script>alert("File not found");</script>', 404, ['Content-Type' => 'text/html']);
        return back();
    }

    public function setujui($id){
        $pengajuanSurat = Surat::find($id);
        $pengajuanSurat->update([
            'status' => 'disetujui',
            'alasan_ditolak' => null
        ]);
        return back();
    }


    public function downloadFileYangDisetujui($id){
        $surat = PengunduranDiri::where('surat_id', $id)->first();

        return response()->download(public_path('storage/surat-pengunduran-diri/'.$surat->file));
    }

}