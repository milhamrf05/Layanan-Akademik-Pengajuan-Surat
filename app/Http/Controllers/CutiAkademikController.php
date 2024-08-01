<?php

namespace App\Http\Controllers;

use App\Models\CutiAkademik;
use App\Models\Surat;
use App\Models\User;
use App\Services\FetchMahasiswaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CutiAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoriSurat = DB::table('kategori_surat')->where('nama', 'Surat Cuti Akademik')->first();

        if (!$kategoriSurat) {
            return redirect()->back()->with('error', 'Kategori surat tidak ditemukan.');
        }

        $riwayat = Surat::with('user', 'kategoriSurat')
                        ->where('user_id', Auth::id())
                        ->where('kategori_surat_id', $kategoriSurat->id)
                        ->get();



        return view('page.deskripsi.cuti-akademik', compact('riwayat'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::id();

        // Mengecek apakah ada surat dengan status 'pending' untuk user ini
        $pendingSurat = Surat::where('user_id', $userId)
                             ->where('status', Surat::STATUS_PENDING)->where('kategori_surat_id', 4)
                             ->first();

                             if ($pendingSurat) {
                                return redirect()->route('page.pending');
                                
                            }

                            $user = User::findOrFail($userId);
                            $fetchMahasiswaService = new FetchMahasiswaService();
                            $mahasiswa = $fetchMahasiswaService->fetchDataMahasiswa($user->email);

        return view('page.deskripsi.buat-cuti-akademik', compact('mahasiswa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi file yang diunggah
        $request->validate([
            'file' => 'required|mimes:docx,pdf|max:10000', // max:2048 artinya ukuran maksimum adalah 2MB
        ]);


        // Jika validasi lolos, lanjutkan dengan proses penyimpanan file
        if ($request->file('file')) {
            $file = $request->file('file');
            $file ->storeAs('public/cuti-akademik', $file->hashName());

            $kategoriSurat = DB::table('kategori_surat')->where('nama', '=' ,'Surat Cuti Akademik')->first();
            $surat = Surat::create([
                'user_id' => Auth::id(),
                'kategori_surat_id' => $kategoriSurat->id,
                'status' => 'pending',
                'file_surat' => $request->file_surat
            ]);

            CutiAkademik::create([
                'surat_id' => $surat->id,
                'file' => $file->hashName()
                
            ]);
            session()->flash('success', 'Surat  berhasil diajukan.');
            return redirect()->route('cuti-akademik-deskripsi');
        }

        return back()->withErrors(['document' => 'No file uploaded']);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Ambil data cuti akademik berdasarkan surat_id
        $cutiAkademik = CutiAkademik::where('surat_id', $id)->first();

        // Pastikan bahwa data cuti akademik ditemukan
        if ($cutiAkademik && $cutiAkademik->file) {
            // Buat URL untuk file tersebut
            $url = Storage::url('cuti-akademik/' . $cutiAkademik->file);

            // Redirect ke URL dalam tab baru
            return response()->make('<script>window.open("' . $url . '", "_blank");</script>', 200, ['Content-Type' => 'text/html']);
        }

        return response()->make('<script>alert("File not found");</script>', 404, ['Content-Type' => 'text/html']);
    }

    public function setujui($id){
        $pengajuanSurat = Surat::find($id);
        $pengajuanSurat->update([
            'status' => 'disetujui',
            'alasan_ditolak' => null
        ]);
        return back();
    }

    public function showAlasanDiTolak($id){
        $surat = Surat::findOrFail($id);
        $alasan = $surat->alasan_ditolak;
        return view('page.tolak.cuti-akademik-tolak', compact('alasan'));
    }

    public function downloadFile(){
        return response()->download(storage_path('app/templates/FORMULIR CUTI AKADEMIK.pdf'));
    }
    
    public function detail($id){
        $surat = Surat::findOrFail($id);
        $surat_id = $id;
        $user = User::where('id', $surat->user_id)->first();
        $fetchMahasiswaService = new FetchMahasiswaService();
        $mahasiswa = $fetchMahasiswaService->fetchDataMahasiswa($user->email);
        $cutiAkademik = CutiAkademik::where('surat_id', $id)->first();
        return view('page.staff.cuti-akademik.detail', compact('mahasiswa', 'surat_id'));
    }

}