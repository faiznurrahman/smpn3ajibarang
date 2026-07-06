<?php

namespace Database\Seeders;

use App\Models\Textbook;
use App\Models\TextbookItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TextbookSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        TextbookItem::truncate();
        Textbook::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $textbooks = [
            // ── Kelas 7 ──────────────────────────────────────────────────────
            ['judul' => 'Bahasa Indonesia Kelas 7',       'mata_pelajaran' => 'Bahasa Indonesia', 'untuk_tingkat' => 7, 'kode_prefix' => 'BP7-BI', 'penerbit' => 'Kemendikbud', 'tahun_terbit' => '2023', 'total_eksemplar' => 22],
            ['judul' => 'Matematika Kelas 7',             'mata_pelajaran' => 'Matematika',       'untuk_tingkat' => 7, 'kode_prefix' => 'BP7-MT', 'penerbit' => 'Kemendikbud', 'tahun_terbit' => '2023', 'total_eksemplar' => 22],
            ['judul' => 'Ilmu Pengetahuan Alam Kelas 7',  'mata_pelajaran' => 'IPA',              'untuk_tingkat' => 7, 'kode_prefix' => 'BP7-IP', 'penerbit' => 'Kemendikbud', 'tahun_terbit' => '2023', 'total_eksemplar' => 22],

            // ── Kelas 8 ──────────────────────────────────────────────────────
            ['judul' => 'Bahasa Indonesia Kelas 8',       'mata_pelajaran' => 'Bahasa Indonesia', 'untuk_tingkat' => 8, 'kode_prefix' => 'BP8-BI', 'penerbit' => 'Kemendikbud', 'tahun_terbit' => '2022', 'total_eksemplar' => 22],
            ['judul' => 'Matematika Kelas 8',             'mata_pelajaran' => 'Matematika',       'untuk_tingkat' => 8, 'kode_prefix' => 'BP8-MT', 'penerbit' => 'Kemendikbud', 'tahun_terbit' => '2022', 'total_eksemplar' => 22],
            ['judul' => 'Ilmu Pengetahuan Alam Kelas 8',  'mata_pelajaran' => 'IPA',              'untuk_tingkat' => 8, 'kode_prefix' => 'BP8-IP', 'penerbit' => 'Kemendikbud', 'tahun_terbit' => '2022', 'total_eksemplar' => 22],

            // ── Kelas 9 ──────────────────────────────────────────────────────
            ['judul' => 'Bahasa Indonesia Kelas 9',       'mata_pelajaran' => 'Bahasa Indonesia', 'untuk_tingkat' => 9, 'kode_prefix' => 'BP9-BI', 'penerbit' => 'Kemendikbud', 'tahun_terbit' => '2021', 'total_eksemplar' => 22],
            ['judul' => 'Matematika Kelas 9',             'mata_pelajaran' => 'Matematika',       'untuk_tingkat' => 9, 'kode_prefix' => 'BP9-MT', 'penerbit' => 'Kemendikbud', 'tahun_terbit' => '2021', 'total_eksemplar' => 22],
            ['judul' => 'Ilmu Pengetahuan Alam Kelas 9',  'mata_pelajaran' => 'IPA',              'untuk_tingkat' => 9, 'kode_prefix' => 'BP9-IP', 'penerbit' => 'Kemendikbud', 'tahun_terbit' => '2021', 'total_eksemplar' => 22],
        ];

        foreach ($textbooks as $data) {
            // Item di-generate otomatis via Textbook::booted() created event
            Textbook::create(array_merge($data, ['is_active' => true]));
        }
    }
}
