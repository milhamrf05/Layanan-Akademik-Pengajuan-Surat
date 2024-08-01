<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori_surat')->insert([
            ['nama' => 'surat pengantar magang'],
            ['nama' => 'surat keterangan mahasiswa aktif'],
            ['nama' => 'surat pengantar penelitian'],
            ['nama' => 'Surat Cuti Akademik'],
            ['nama' => 'Surat Pengunduran Diri'],
        ]);
    }
}