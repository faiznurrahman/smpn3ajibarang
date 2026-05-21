<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('textbook_loan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->constrained('textbook_loans')->cascadeOnDelete();
            $table->foreignId('member_id')->constrained('members');
            $table->foreignId('textbook_item_id')->constrained('textbook_items');
            $table->enum('kondisi_pinjam', ['baik', 'rusak_ringan', 'rusak_berat'])->default('baik');
            $table->enum('kondisi_kembali', ['baik', 'rusak_ringan', 'rusak_berat', 'hilang'])->nullable();
            $table->enum('status_sanksi', ['tidak_ada', 'ganti_buku', 'bayar_harga'])->default('tidak_ada');
            $table->date('tgl_kembali_aktual')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('textbook_loan_items');
    }
};
