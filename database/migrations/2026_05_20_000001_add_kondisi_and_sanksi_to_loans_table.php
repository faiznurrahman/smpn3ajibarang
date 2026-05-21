<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->enum('kondisi_kembali', ['baik', 'rusak', 'hilang'])->nullable()->after('tgl_kembali');
            $table->enum('jenis_sanksi', ['tidak_ada', 'ganti_buku', 'bayar_harga'])->default('tidak_ada')->after('kondisi_kembali');
            $table->decimal('nominal_sanksi', 10, 2)->nullable()->after('jenis_sanksi');
            $table->enum('status_sanksi', ['tidak_ada', 'belum_lunas', 'lunas'])->default('tidak_ada')->after('nominal_sanksi');
            $table->date('tgl_selesai_sanksi')->nullable()->after('status_sanksi');
            $table->text('catatan_sanksi')->nullable()->after('tgl_selesai_sanksi');
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn([
                'kondisi_kembali',
                'jenis_sanksi',
                'nominal_sanksi',
                'status_sanksi',
                'tgl_selesai_sanksi',
                'catatan_sanksi',
            ]);
        });
    }
};
