<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('textbook_loans', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_ajaran', 9);
            $table->date('tgl_distribusi');
            $table->date('tgl_kembali');
            $table->enum('status', ['aktif', 'selesai'])->default('aktif');
            $table->foreignId('petugas_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('textbook_loans');
    }
};
