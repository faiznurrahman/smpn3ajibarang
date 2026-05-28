<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('foto_gedung');
            $table->string('foto_sejarah_alt')->nullable()->after('foto_sejarah');
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('foto_gedung')->nullable();
            $table->dropColumn('foto_sejarah_alt');
        });
    }
};
