<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use App\Models\FormSurat;
use App\Models\Surat;
use App\Models\User;
use App\Services\FetchMahasiswaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectToRightViewController extends Controller
{
    public function redirectToLihat($id){
        $surat = Surat::findOrFail($id);
        if($surat->kategoriSurat->nama === 'surat pengantar magang'){
            return redirect()->route('pengantar-magang-staff-show', ['id' => $surat->id]);
        }elseif($surat->kategoriSurat->nama === 'surat pengantar penelitian'){

            return redirect()->route('staff-pengantar-penelitian-show', ['id' => $surat->id]);
        }elseif($surat->kategoriSurat->nama === 'Surat Cuti Akademik'){
            return redirect()->route('show-surat', ['id' => $surat->id]);
        }elseif($surat->kategoriSurat->nama === 'Surat Pengunduran Diri'){
            return redirect()->route('show-surat-pengunduran-diri', ['id' => $surat->id]);
        }
        elseif($surat->kategoriSurat->nama === 'surat keterangan mahasiswa aktif'){
            return redirect()->route('mahasiswa-aktif-edit', ['id' => $surat->id]);
        }
    }

    public function handleDiffrentSetujui($id){
        $surat = Surat::findOrFail($id);
        if($surat->kategoriSurat->nama === 'surat pengantar magang'){
            return redirect()->route('staff_page.setujui.surat', ['id' => $surat->id]);
        }elseif($surat->kategoriSurat->nama === 'surat pengantar penelitian'){
            return redirect()->route('staff-pengantar-penelitian-setujui', ['id' => $surat->id]);
        }elseif($surat->kategoriSurat->nama === 'Surat Cuti Akademik'){
            return redirect()->route('cuti-akademik-setujui', ['id' => $surat->id]);
        }
    }
}