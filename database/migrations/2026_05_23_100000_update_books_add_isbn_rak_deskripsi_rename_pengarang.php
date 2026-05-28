<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('isbn')->nullable()->after('kode_buku');
            $table->renameColumn('pengarang', 'penulis');
            $table->string('rak')->nullable()->after('kategori');
            $table->text('deskripsi')->nullable()->after('cover');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['isbn', 'rak', 'deskripsi']);
            $table->renameColumn('penulis', 'pengarang');
        });
    }
};
