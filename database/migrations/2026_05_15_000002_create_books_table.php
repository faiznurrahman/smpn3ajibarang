<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('kode_buku')->unique();
            $table->string('judul');
            $table->string('pengarang');
            $table->string('penerbit')->nullable();
            $table->unsignedSmallInteger('tahun')->nullable();
            $table->string('kategori')->nullable();
            $table->unsignedInteger('stok')->default(1);
            $table->string('cover')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
