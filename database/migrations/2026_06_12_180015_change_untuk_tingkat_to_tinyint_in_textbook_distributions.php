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
        Schema::table('textbook_distributions', function (Blueprint $table) {
            $table->unsignedTinyInteger('untuk_tingkat')->change();
        });
    }

    public function down(): void
    {
        Schema::table('textbook_distributions', function (Blueprint $table) {
            $table->enum('untuk_tingkat', ['7', '8', '9'])->change();
        });
    }
};
