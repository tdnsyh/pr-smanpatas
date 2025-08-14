<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nia')->unique();
            $table->string('nama_lengkap');
            $table->string('nama_panggilan')->nullable();
            $table->integer('tahun_kelulusan')->nullable();
            $table->string('email')->nullable();
            $table->string('no_wa')->nullable();
            $table->text('alamat_saat_ini')->nullable();
            $table->string('jenjang_pendidikan_terakhir')->nullable();
            $table->string('nama_institusi_pendidikan_terakhir')->nullable();
            $table->string('program_studi')->nullable();
            $table->string('pekerjaan_saat_ini')->nullable();
            $table->string('nama_instansi')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('lokasi_tempat_bekerja')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
