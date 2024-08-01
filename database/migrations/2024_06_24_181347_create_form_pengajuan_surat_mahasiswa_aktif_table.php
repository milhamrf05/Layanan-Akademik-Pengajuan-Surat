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
        Schema::create('form_pengajuan_surat_mahasiswa_aktif', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_id');
            $table->string('nama_mahasiswa');
            $table->string('nim');
            $table->string('jurusan');
            $table->text('alamat');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('semester');
            $table->string('tahun_akademik');
            $table->string('nama_orang_tua');
            $table->string('pekerjaan_orang_tua');
            $table->text('alamat_orang_tua');
            $table->text('keperluan');
            $table->string('opsi_surat');
            $table->timestamps();

            $table->foreign('surat_id')->references('id')->on('surat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_pengajuan_surat_mahasiswa_aktif');
    }
};
