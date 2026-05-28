<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Expand enums to include 'rusak', then migrate data, then shrink
        DB::statement("ALTER TABLE textbook_items MODIFY kondisi ENUM('baik', 'rusak_ringan', 'rusak_berat', 'rusak', 'hilang') NOT NULL DEFAULT 'baik'");
        DB::statement("UPDATE textbook_items SET kondisi = 'rusak' WHERE kondisi IN ('rusak_ringan', 'rusak_berat')");
        DB::statement("ALTER TABLE textbook_items MODIFY kondisi ENUM('baik', 'rusak', 'hilang') NOT NULL DEFAULT 'baik'");

        // 2. Update textbook_loan_items kondisi_pinjam
        DB::statement("ALTER TABLE textbook_loan_items MODIFY kondisi_pinjam ENUM('baik', 'rusak_ringan', 'rusak_berat', 'rusak') NOT NULL DEFAULT 'baik'");
        DB::statement("UPDATE textbook_loan_items SET kondisi_pinjam = 'rusak' WHERE kondisi_pinjam IN ('rusak_ringan', 'rusak_berat')");
        DB::statement("ALTER TABLE textbook_loan_items MODIFY kondisi_pinjam ENUM('baik', 'rusak') NOT NULL DEFAULT 'baik'");

        // 3. Update textbook_loan_items kondisi_kembali
        DB::statement("ALTER TABLE textbook_loan_items MODIFY kondisi_kembali ENUM('baik', 'rusak_ringan', 'rusak_berat', 'rusak', 'hilang') NULL");
        DB::statement("UPDATE textbook_loan_items SET kondisi_kembali = 'rusak' WHERE kondisi_kembali IN ('rusak_ringan', 'rusak_berat')");
        DB::statement("ALTER TABLE textbook_loan_items MODIFY kondisi_kembali ENUM('baik', 'rusak', 'hilang') NULL");

        // 3. Rename status_sanksi -> jenis_sanksi (was storing sanction type)
        Schema::table('textbook_loan_items', function (Blueprint $table) {
            $table->renameColumn('status_sanksi', 'jenis_sanksi');
        });

        // 4. Add proper status_sanksi + supporting sanksi fields
        Schema::table('textbook_loan_items', function (Blueprint $table) {
            $table->enum('status_sanksi', ['tidak_ada', 'belum_lunas', 'lunas'])->default('tidak_ada')->after('jenis_sanksi');
            $table->decimal('nominal_sanksi', 10, 2)->nullable()->after('status_sanksi');
            $table->date('tgl_selesai_sanksi')->nullable()->after('nominal_sanksi');
            $table->text('catatan_sanksi')->nullable()->after('tgl_selesai_sanksi');
        });
    }

    public function down(): void
    {
        Schema::table('textbook_loan_items', function (Blueprint $table) {
            $table->dropColumn(['status_sanksi', 'nominal_sanksi', 'tgl_selesai_sanksi', 'catatan_sanksi']);
        });

        Schema::table('textbook_loan_items', function (Blueprint $table) {
            $table->renameColumn('jenis_sanksi', 'status_sanksi');
        });

        DB::statement("ALTER TABLE textbook_loan_items MODIFY kondisi_kembali ENUM('baik', 'rusak_ringan', 'rusak_berat', 'hilang') NULL");
        DB::statement("ALTER TABLE textbook_loan_items MODIFY kondisi_pinjam ENUM('baik', 'rusak_ringan', 'rusak_berat') NOT NULL DEFAULT 'baik'");
        DB::statement("ALTER TABLE textbook_items MODIFY kondisi ENUM('baik', 'rusak_ringan', 'rusak_berat', 'hilang') NOT NULL DEFAULT 'baik'");
    }
};
