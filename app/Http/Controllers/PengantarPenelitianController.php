<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengantarPenelitian;
use App\Models\Surat;
use App\Services\FetchMahasiswaService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PengantarPenelitianController extends Controller
{
    public function index()
    {
        $kategoriSurat = DB::table('kategori_surat')->where('nama', 'surat pengantar penelitian')->first();

        if (!$kategoriSurat) {
            return redirect()->back()->with('error', 'Kategori surat tidak ditemukan.');
        }

        $riwayat = Surat::with('user', 'kategoriSurat')
                        ->where('user_id', Auth::id())
                        ->where('kategori_surat_id', $kategoriSurat->id)
                        ->get();
        return view('page.deskripsi.pengantar-penelitian', compact('riwayat'));
    }

    public function create()
    {
        $userId = Auth::id();

        // Mengecek apakah ada surat dengan status 'pending' untuk user ini
        $pendingSurat = Surat::where('user_id', $userId)
                             ->where('status', Surat::STATUS_PENDING)->where('kategori_surat_id', 3)
                             ->first();

        // Jika ada surat dengan status 'pending', alihkan ke halaman 'pending'
        if ($pendingSurat) {
            return redirect()->route('page.pending');
        }
        $fetchmahasiswa = new FetchMahasiswaService();
        $data_mahasiswa = $fetchmahasiswa->fetchDataMahasiswa(Auth::user()->email);
        return view('page.deskripsi.buat-pengantar-penelitian', compact('data_mahasiswa'));
    }

    public function store(Request $request)
    {
        $kategoriSurat = DB::table('kategori_surat')->where('nama', '=' ,'surat pengantar penelitian')->first();
        $surat = Surat::create([
            'user_id' => Auth::id(),
            'kategori_surat_id' => $kategoriSurat->id,
            'status' => 'pending',
            'file_surat' => $request->file_surat
        ]);
        // $data = $request->validate([
            //     'keperluan_surat' => 'required|string',
            //     'jurusan' => 'required|string',
            //     'surat_ditujukan_kepada' => 'required|string',
        //     'nama_perusahaan' => 'required|string',
        //     'alamat_perusahaan' => 'required|string',
        //     'kode_pos_perusahaan' => 'required|string',
        //     'dosen_pembimbing' => 'required|string',
        //     'waktu_kerja_praktik' => 'required|string',
        //     'tugas_mata_kuliah' => 'required|string',
        //     'topik_judul_yang_dibahas' => 'required|string',
        //     'melampirkan_proposal' => 'required|boolean',
        //     'lembar_pengesahan_dosen_pembimbing' => 'required|boolean',
        //     'opsi_surat' => 'required|string',
        //     'additional_fields' => 'nullable|array',
        // ]);

        $additionalFields = $request->except([
           '_token', 'user_id', 'keperluan_surat', 'jurusan', 'surat_ditujukan_kepada',
            'nama_perusahaan', 'alamat_perusahaan', 'kode_pos_perusahaan', 'dosen_pembimbing', 'jurusan', 'opsi_surat', 'topik_judul_yang_dibahas',
            'lembar_pengesahan_dosen_pembimbing', 'melampirkan_proposal', 'waktu_kerja_praktik',
        ]);

        $lembar_pengesahan_dosen_pembimbing = $request->file('lembar_pengesahan_dosen_pembimbing');
        $lembar_pengesahan_dosen_pembimbing->storeAs('public/pengantar-penelitian/lembar-pengesahan', $lembar_pengesahan_dosen_pembimbing->hashName());

        
        PengantarPenelitian::create([
            'surat_id' => $surat->id,
            'keperluan_surat' => $request->keperluan_surat,
            'jurusan' => $request->jurusan,
            'surat_ditujukan_kepada' => $request->surat_ditujukan_kepada,
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'kode_pos_perusahaan' => $request->kode_pos_perusahaan,
            'dosen_pembimbing' => $request->dosen_pembimbing,
            'waktu_kerja_praktik' => $request->waktu_kerja_praktik,
            'tugas_mata_kuliah' => $request->tugas_mata_kuliah,
            'topik_judul_yang_dibahas' => $request->topik_judul_yang_dibahas,
            'melampirkan_proposal' => $request->melampirkan_proposal,
            'lembar_pengesahan_dosen_pembimbing' => $lembar_pengesahan_dosen_pembimbing->hashName(),
            'opsi_surat' => $request->opsi_surat,
            'additional_fields' =>  $additionalFields
        ]);

        session()->flash('success', 'Surat berhasil diajukan.');

        return redirect()->route('deskripsi-pengantar-penelitian')->with('success', 'Data berhasil ditambahkan');
    }

    public function show($id)
    {
        $data = PengantarPenelitian::findOrFail($id);
        return view('pengantar_penelitian.show', compact('data'));
    }

    // public function edit($id)
    // {
    //     $data = PengantarPenelitian::findOrFail($id);
    //     return view('pengantar_penelitian.edit', compact('data'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $data = $request->validate([
    //         'keperluan_surat' => 'required|string',
    //         'jurusan' => 'required|string',
    //         'surat_ditujukan_kepada' => 'required|string',
    //         'nama_perusahaan' => 'required|string',
    //         'alamat_perusahaan' => 'required|string',
    //         'kode_pos_perusahaan' => 'required|string',
    //         'dosen_pembimbing' => 'required|string',
    //         'waktu_kerja_praktik' => 'required|string',
    //         'tugas_mata_kuliah' => 'required|string',
    //         'topik_judul_yang_dibahas' => 'required|string',
    //         'melampirkan_proposal' => 'required|boolean',
    //         'lembar_pengesahan_dosen_pembimbing' => 'required|boolean',
    //         'opsi_surat' => 'required|string',
    //         'additional_fields' => 'nullable|array',
    //     ]);

    //     $pengantarPenelitian = PengantarPenelitian::findOrFail($id);
    //     $pengantarPenelitian->update($data);

    //     return redirect()->route('pengantar_penelitian.index')->with('success', 'Data berhasil diperbarui');
    // }

    public function destroy($id)
    {
        $pengantarPenelitian = PengantarPenelitian::findOrFail($id);
        $pengantarPenelitian->delete();

        return redirect()->route('pengantar_penelitian.index')->with('success', 'Data berhasil dihapus');
    }

    public function showAlasanDiTolak($id){
        $surat = Surat::findOrFail($id);
        $alasan = $surat->alasan_ditolak;
        return view('page.tolak.pengantar-penelitian-tolak', compact('alasan'));
    }
}