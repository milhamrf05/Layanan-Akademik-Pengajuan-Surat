<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengantar_penelitian', function (Blueprint $table) {
            $table->id();
            $table->string('keperluan_surat');
            $table->string('jurusan');
            $table->string('surat_ditujukan_kepada');
            $table->string('nama_perusahaan');
            $table->string('alamat_perusahaan');
            $table->string('kode_pos_perusahaan');
            $table->string('dosen_pembimbing');
            $table->string('waktu_kerja_praktik');
            $table->string('tugas_mata_kuliah');
            $table->string('topik_judul_yang_dibahas');
            $table->boolean('melampirkan_proposal');
            $table->string('lembar_pengesahan_dosen_pembimbing');
            $table->string('opsi_surat');
            $table->json('additional_fields')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengantar_penelitian');
    }
};
