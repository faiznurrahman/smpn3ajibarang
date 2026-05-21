<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('textbook_loans', function (Blueprint $table) {
            $table->unsignedTinyInteger('untuk_tingkat')->default(7)->after('tahun_ajaran');
        });
    }

    public function down(): void
    {
        Schema::table('textbook_loans', function (Blueprint $table) {
            $table->dropColumn('untuk_tingkat');
        });
    }
};
