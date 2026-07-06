<?php

namespace Database\Seeders;

use App\Models\OrganizationalStructure;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationalStructureSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        OrganizationalStructure::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        OrganizationalStructure::create([
            'title' => 'Struktur Organisasi SMP Negeri 3 Ajibarang Tahun Pelajaran 2025/2026',
            'image' => null,
            'order' => 1,
        ]);
    }
}
