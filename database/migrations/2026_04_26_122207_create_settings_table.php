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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            $table->string('tagline')->nullable();
            $table->string('logo')->nullable();
            $table->string('judul_hero')->nullable();      // ← ini ada?
            $table->text('deskripsi_hero')->nullable(); 
            $table->string('background_hero')->nullable();
            $table->integer('jumlah_siswa')->nullable();
            $table->integer('jumlah_guru_karyawan')->nullable();
            $table->integer('jumlah_prestasi')->nullable();
            $table->integer('tahun_berdiri')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
