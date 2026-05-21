<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('textbooks', function (Blueprint $table) {
            $table->unsignedTinyInteger('untuk_tingkat')->default(7)->after('mata_pelajaran');
        });

        foreach (DB::table('textbooks')->get() as $row) {
            DB::table('textbooks')
                ->where('id', $row->id)
                ->update(['untuk_tingkat' => (int) $row->kelas]);
        }

        Schema::table('textbooks', function (Blueprint $table) {
            $table->dropColumn('kelas');
        });
    }

    public function down(): void
    {
        Schema::table('textbooks', function (Blueprint $table) {
            $table->enum('kelas', ['7', '8', '9'])->default('7')->after('mata_pelajaran');
            $table->dropColumn('untuk_tingkat');
        });
    }
};
