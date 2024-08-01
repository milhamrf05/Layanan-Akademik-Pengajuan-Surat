<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSurat extends Model
{
    use HasFactory;
    protected $table = 'form_pengantar_magang';
    protected $fillable = [
        'surat_id',
        'nama_mahasiswa_1',
        'nim_1',
        'no_hp',
        'email_mahasiswa',
        'jurusan',
        'opsi_surat',
        'lembar_pengesahan',
        'additional_fields'
    ];

    protected $casts = [
        'additional_fields' => 'array'
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }
}