<?php

namespace Database\Seeders;

use App\Models\VideoProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoProfileSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        VideoProfile::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $items = [
            [
                'judul'      => 'Profil SMP Negeri 3 Ajibarang',
                'link_video' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'deskripsi'  => 'Video profil resmi SMP Negeri 3 Ajibarang yang menampilkan fasilitas, kegiatan, dan prestasi sekolah.',
                'is_active'  => true,
                'order'      => 1,
            ],
            [
                'judul'      => 'Kegiatan P5 Kearifan Lokal 2026',
                'link_video' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'deskripsi'  => 'Dokumentasi kegiatan Proyek Penguatan Profil Pelajar Pancasila bertema Kearifan Lokal tahun 2026.',
                'is_active'  => true,
                'order'      => 2,
            ],
            [
                'judul'      => 'Pentas Seni Akhir Tahun 2025',
                'link_video' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'deskripsi'  => 'Momen berharga pentas seni akhir tahun yang menampilkan bakat-bakat terbaik siswa SMPN 3 Ajibarang.',
                'is_active'  => true,
                'order'      => 3,
            ],
        ];

        foreach ($items as $data) {
            VideoProfile::create($data);
        }
    }
}
