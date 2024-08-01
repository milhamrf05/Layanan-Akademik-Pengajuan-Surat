<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $table = 'surat';
    protected $fillable = [
        'user_id',
        'kategori_surat_id',
        'status',
        'file_surat',
         'alasan_ditolak'
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'disetujui';
    const STATUS_REJECTED = 'ditolak';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategoriSurat()
    {
        return $this->belongsTo(KategoriSurat::class);
    }

    public function formSurat()
    {
        return $this->hasOne(FormSurat::class);
    }

    public function formPengajuanSuratMahasiswaAktif()
    {
        return $this->hasOne(FormPengajuanSuratMahasiswaAktif::class);
    }

    public function pengantarPenelitian()
    {
        return $this->hasOne(PengantarPenelitian::class);
    }
    public function cutiAkademik()
    {
        return $this->hasOne(CutiAkademik::class);
    }
    public function pengunduranDiri()
    {
        return $this->hasOne(PengunduranDiri::class);
    }
}