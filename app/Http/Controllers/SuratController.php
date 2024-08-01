<?php

namespace App\Http\Controllers;

use App\Models\FormSurat;
use App\Models\Surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function store(Request $request)
    {
          // Cari surat berdasarkan user_id dan kategori_surat_id
          $surat = Surat::where('user_id', $request->user_id)
          ->where('kategori_surat_id', $request->kategori_surat_id)
          ->first();
          dd($surat);

            // Jika surat ditemukan dan statusnya pending, kembalikan respons error
            if ($surat && $surat->status === Surat::STATUS_PENDING) {
                return view('page.pending');
            }

        $surat = Surat::create([
            'user_id' => $request->user_id,
            'kategori_surat_id' => $request->kategori_surat_id,
            'disetujui' => $request->disetujui,
            'file_surat' => $request->file_surat
        ]);

        $additionalFields = $request->except([
            'user_id', 'kategori_surat_id', 'disetujui', 'file_surat',
            'nama_mahasiswa_1', 'nim_1', 'no_hp', 'email_mahasiswa', 'jurusan', 'opsi_surat'
        ]);

        FormSurat::create([
            'surat_id' => $surat->id,
            'nama_mahasiswa_1' => $request->nama_mahasiswa_1,
            'nim_1' => $request->nim_1,
            'no_hp' => $request->no_hp,
            'email_mahasiswa' => $request->email_mahasiswa,
            'jurusan' => $request->jurusan,
            'opsi_surat' => $request->opsi_surat,
            'additional_fields' => $additionalFields
        ]);

        return response()->json(['message' => 'Form surat berhasil disimpan']);
    }

    
}