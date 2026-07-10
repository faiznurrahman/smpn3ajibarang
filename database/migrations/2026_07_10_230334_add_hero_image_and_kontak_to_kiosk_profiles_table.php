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
        Schema::table('kiosk_profiles', function (Blueprint $table) {
            $table->string('hero_image')->nullable()->after('tagline');
            $table->string('kontak_alamat')->nullable()->after('galeri');
            $table->string('kontak_telepon')->nullable()->after('kontak_alamat');
            $table->string('kontak_email')->nullable()->after('kontak_telepon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kiosk_profiles', function (Blueprint $table) {
            $table->dropColumn(['hero_image', 'kontak_alamat', 'kontak_telepon', 'kontak_email']);
        });
    }
};
