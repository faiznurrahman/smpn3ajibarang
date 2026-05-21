<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('textbooks', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('mata_pelajaran');
            $table->enum('kelas', ['7', '8', '9']);
            $table->string('kode_prefix', 10);
            $table->string('penerbit')->nullable();
            $table->string('tahun_terbit', 4)->nullable();
            $table->integer('total_eksemplar');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('textbooks');
    }
};
