<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->smallInteger('tahun_masuk')->unsigned()->nullable()->after('jenis');
            $table->enum('status', ['aktif', 'lulus', 'pindah', 'keluar'])->default('aktif')->after('no_hp');
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn(['tahun_masuk', 'status']);
        });
    }
};
