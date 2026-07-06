<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('anak_judul')->nullable()->after('judul');
            $table->string('pengarang_tambahan')->nullable()->after('penulis');
            $table->unsignedInteger('jumlah_halaman')->nullable()->after('deskripsi_fisik');
            $table->string('dimensi')->nullable()->after('jumlah_halaman');
            $table->string('bentuk_karya')->nullable()->after('dimensi');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['anak_judul', 'pengarang_tambahan', 'jumlah_halaman', 'dimensi', 'bentuk_karya']);
        });
    }
};
