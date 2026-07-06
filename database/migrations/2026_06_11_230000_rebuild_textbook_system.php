<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1a. Tambah kolom baru ke textbooks
        Schema::table('textbooks', function (Blueprint $table) {
            $table->string('anak_judul')->nullable()->after('judul');
            $table->string('kota_terbit')->nullable()->after('penerbit');
            $table->text('deskripsi')->nullable()->after('tahun_terbit');
            $table->unsignedInteger('harga')->nullable()->after('deskripsi');
            $table->string('cover')->nullable()->after('harga');
        });

        // 1e. Drop tabel lama (nonaktifkan FK sementara)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('textbook_loan_items');
        Schema::dropIfExists('textbook_loans');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1c. Tabel distribusi buku paket (satu per batch distribusi)
        Schema::create('textbook_distributions', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_ajaran', 9);
            $table->enum('untuk_tingkat', ['7', '8', '9']);
            $table->date('tgl_distribusi');
            $table->date('tgl_kembali_rencana')->nullable();
            $table->enum('status', ['aktif', 'selesai'])->default('aktif');
            $table->foreignId('petugas_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // 1d. Item distribusi (satu per siswa per eksemplar)
        Schema::create('textbook_distribution_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('distribution_id')
                ->constrained('textbook_distributions')
                ->cascadeOnDelete();
            $table->foreignId('member_id')
                ->constrained('members')
                ->cascadeOnDelete();
            $table->foreignId('textbook_item_id')
                ->constrained('textbook_items')
                ->cascadeOnDelete();
            $table->unsignedInteger('urutan_distribusi')->default(0);
            $table->enum('kondisi_kembali', ['baik', 'rusak_ringan', 'rusak_berat', 'hilang'])->nullable();
            $table->enum('jenis_sanksi', ['tidak_ada', 'bayar_harga', 'ganti_buku'])->default('tidak_ada');
            $table->unsignedInteger('nominal_sanksi')->nullable();
            $table->enum('status_sanksi', ['tidak_ada', 'belum_lunas', 'lunas'])->default('tidak_ada');
            $table->date('tgl_kembali_aktual')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('textbook_distribution_items');
        Schema::dropIfExists('textbook_distributions');

        Schema::table('textbooks', function (Blueprint $table) {
            $table->dropColumn(['anak_judul', 'kota_terbit', 'deskripsi', 'harga', 'cover']);
        });

        // Restore old tables (tanpa data)
        Schema::create('textbook_loans', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_ajaran');
            $table->enum('untuk_tingkat', ['7', '8', '9']);
            $table->date('tgl_distribusi');
            $table->date('tgl_kembali')->nullable();
            $table->enum('status', ['aktif', 'selesai'])->default('aktif');
            $table->foreignId('petugas_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('textbook_loan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->constrained('textbook_loans')->cascadeOnDelete();
            $table->foreignId('member_id')->constrained('members')->cascadeOnDelete();
            $table->foreignId('textbook_item_id')->constrained('textbook_items')->cascadeOnDelete();
            $table->enum('kondisi_pinjam', ['baik', 'rusak'])->default('baik');
            $table->enum('kondisi_kembali', ['baik', 'rusak', 'hilang'])->nullable();
            $table->enum('jenis_sanksi', ['tidak_ada', 'ganti_buku', 'bayar_harga'])->default('tidak_ada');
            $table->enum('status_sanksi', ['tidak_ada', 'belum_lunas', 'lunas'])->default('tidak_ada');
            $table->decimal('nominal_sanksi', 10, 2)->nullable();
            $table->date('tgl_selesai_sanksi')->nullable();
            $table->text('catatan_sanksi')->nullable();
            $table->date('tgl_kembali_aktual')->nullable();
            $table->timestamps();
        });
    }
};
