<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPengajuanSuratMahasiswaAktif extends Model
{
    use HasFactory;

    protected $table = 'form_pengajuan_surat_mahasiswa_aktif';

    protected $fillable = [
        'surat_id',
        'nama_mahasiswa',
        'nim',
        'jurusan',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'tahun_akademik',
        'nama_orang_tua',
        'pekerjaan_orang_tua',
        'alamat_orang_tua',
        'keperluan',
        'opsi_surat',
        'additional_fields',
    ];


    protected $casts = [
        'additional_fields' => 'array',
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }
}