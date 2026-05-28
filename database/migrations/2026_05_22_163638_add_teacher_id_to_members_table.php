<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->nullOnDelete()->after('id');
        });

        // Sync guru yang sudah ada ke tabel members
        $teachers = DB::table('teachers')->get();
        foreach ($teachers as $teacher) {
            $existing = DB::table('members')->where('teacher_id', $teacher->id)->first();
            if ($existing) continue;

            $next       = (DB::table('members')->max('id') ?? 0) + 1;
            $kode       = 'GRU-' . str_pad($next, 4, '0', STR_PAD_LEFT);

            DB::table('members')->insert([
                'teacher_id'   => $teacher->id,
                'kode_anggota' => $kode,
                'nama'         => $teacher->nama,
                'jenis'        => 'guru',
                'is_active'    => $teacher->is_active,
                'status'       => $teacher->is_active ? 'aktif' : 'keluar',
                'kelas'        => null,
                'no_hp'        => null,
                'tahun_masuk'  => null,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }

    public function down(): void
    {
        // Hapus anggota yang berasal dari guru
        DB::table('members')->whereNotNull('teacher_id')->delete();

        Schema::table('members', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
            $table->dropColumn('teacher_id');
        });
    }
};
