<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengunduranDiri extends Model
{
    use HasFactory;

    protected $fillable = [
        'surat_id',
        'file'
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }
}
