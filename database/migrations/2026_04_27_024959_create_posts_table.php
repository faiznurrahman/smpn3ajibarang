<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();

        $table->string('judul');
        $table->string('slug')->unique();

        $table->text('isi_konten')->nullable();
        $table->string('thumbnail')->nullable();

        $table->enum('type', ['berita', 'pengumuman', 'prestasi']);
        $table->enum('status', ['draft', 'published'])->default('draft');

        $table->date('tanggal_publish')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
