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
    Schema::table('posts', function (Blueprint $table) {
        $table->date('start_date')->nullable()->after('tanggal_publish');
        $table->date('end_date')->nullable()->after('start_date');
        $table->boolean('is_pinned')->default(false)->after('end_date');
        $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete()->after('user_id');
    });
}

public function down(): void
{
    Schema::table('posts', function (Blueprint $table) {
        $table->dropColumn(['start_date', 'end_date', 'is_pinned', 'updated_by']);
    });
}
};
