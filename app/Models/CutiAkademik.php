<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CutiAkademik extends Model
{
    use HasFactory;
    protected $fillable = [
        'file',
        'surat_id',
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }
}