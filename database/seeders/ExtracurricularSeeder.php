<?php

namespace Database\Seeders;

use App\Models\Extracurricular;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExtracurricularSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Extracurricular::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $items = [
            ['nama' => 'Pramuka',                     'deskripsi' => 'Ekstrakurikuler wajib pramuka untuk membentuk karakter mandiri, disiplin, dan berjiwa kepemimpinan tinggi.',       'order' => 1],
            ['nama' => 'Futsal',                      'deskripsi' => 'Tim futsal yang telah meraih berbagai prestasi di tingkat kabupaten dan provinsi Jawa Tengah.',                    'order' => 2],
            ['nama' => 'Karate',                      'deskripsi' => 'Latihan bela diri karate untuk membentuk fisik kuat, mental tangguh, dan jiwa sportivitas.',                      'order' => 3],
            ['nama' => 'Seni Tari',                   'deskripsi' => 'Pengembangan bakat seni tari tradisional dan modern untuk melestarikan budaya bangsa.',                          'order' => 4],
            ['nama' => 'Band Sekolah',                'deskripsi' => 'Grup band sekolah untuk mengembangkan bakat musik dan seni pertunjukan siswa.',                                   'order' => 5],
            ['nama' => 'KIR (Karya Ilmiah Remaja)',   'deskripsi' => 'Wadah penelitian dan penulisan ilmiah bagi siswa yang tertarik dengan sains dan teknologi.',                     'order' => 6],
            ['nama' => 'PMR (Palang Merah Remaja)',   'deskripsi' => 'Kegiatan kepalangmerahan untuk melatih jiwa sosial, pertolongan pertama, dan kemanusiaan.',                      'order' => 7],
            ['nama' => 'English Club',                'deskripsi' => 'Klub bahasa Inggris untuk meningkatkan kemampuan berbahasa Inggris aktif dan pasif.',                            'order' => 8],
            ['nama' => 'Bola Voli',                   'deskripsi' => 'Tim bola voli putra dan putri yang aktif mengikuti kompetisi antar sekolah se-Kabupaten Banyumas.',             'order' => 9],
            ['nama' => 'Desain Grafis',               'deskripsi' => 'Pelatihan desain grafis digital menggunakan komputer untuk mengembangkan kreativitas dan keterampilan siswa.',   'order' => 10],
        ];

        foreach ($items as $data) {
            Extracurricular::create(array_merge($data, ['gambar' => null, 'is_active' => true]));
        }
    }
}
