<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('no_panggil')->nullable()->after('kode_buku');
            $table->string('edisi')->nullable()->after('isbn');
            $table->string('kota_terbit')->nullable()->after('penerbit');
            $table->string('deskripsi_fisik')->nullable()->after('tahun');
            $table->string('bahasa')->nullable()->default('Indonesia')->after('deskripsi_fisik');
            $table->enum('sumber', ['beli', 'hibah', 'sumbangan'])->nullable()->after('bahasa');
            $table->date('tgl_masuk')->nullable()->after('sumber');
            $table->unsignedInteger('harga')->nullable()->after('tgl_masuk');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn([
                'no_panggil', 'edisi', 'kota_terbit', 'deskripsi_fisik',
                'bahasa', 'sumber', 'tgl_masuk', 'harga',
            ]);
        });
    }
};
