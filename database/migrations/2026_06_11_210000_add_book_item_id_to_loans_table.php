<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->foreignId('book_item_id')
                ->nullable()
                ->after('book_id')
                ->constrained('book_items')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\BookItem::class);
            $table->dropColumn('book_item_id');
        });
    }
};
