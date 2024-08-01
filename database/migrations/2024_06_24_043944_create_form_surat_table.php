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
        Schema::create('form_pengantar_magang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_id')->constrained('surat')->onDelete('cascade');
            $table->string('nama_mahasiswa_1');
            $table->string('nim_1');
            $table->string('lembar_pengesahan');
            $table->string('no_hp');
            $table->string('email_mahasiswa');
            $table->string('jurusan');
            $table->enum('opsi_surat', ['hardfile', 'softfile']);
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
        Schema::dropIfExists('form_pengantar_magang');
    }
};