<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengantarPenelitian extends Model
{
    use HasFactory;

    protected $table = 'pengantar_penelitian';

    protected $fillable = [
        'surat_id',
        'keperluan_surat',
        'jurusan',
        'surat_ditujukan_kepada',
        'nama_perusahaan',
        'alamat_perusahaan',
        'kode_pos_perusahaan',
        'dosen_pembimbing',
        'waktu_kerja_praktik',
        'tugas_mata_kuliah',
        'topik_judul_yang_dibahas',
        'melampirkan_proposal',
        'lembar_pengesahan_dosen_pembimbing',
        'opsi_surat',
        'additional_fields',
    ];

    protected $casts = [
        'additional_fields' => 'array',
        'melampirkan_proposal' => 'boolean',
        'opsi_surat'=> 'array'
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }
}
