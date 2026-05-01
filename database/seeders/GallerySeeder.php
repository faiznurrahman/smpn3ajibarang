<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Database\Seeder;
\Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
\App\Models\GalleryImage::truncate();
\App\Models\Gallery::truncate();
\Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');
class GallerySeeder extends Seeder
{
    public function run(): void
    {
        // ── Album 1: Kegiatan Sekolah ──
        $album1 = Gallery::create([
            'judul'   => 'Kegiatan Sekolah',
            'deskripsi' => 'Dokumentasi berbagai kegiatan sekolah SMPN 3 Ajibarang',
            'order'   => 1,
        ]);

        $foto1 = [
            ['file' => 'foto-01.jpg', 'caption' => 'Kegiatan upacara bendera'],
            ['file' => 'foto-02.jpg', 'caption' => 'Kegiatan pembelajaran di kelas'],
            ['file' => 'foto-03.jpg', 'caption' => 'Diskusi kelompok siswa'],
            ['file' => 'foto-04.jpg', 'caption' => 'Kegiatan praktikum IPA'],
            ['file' => 'foto-05.jpg', 'caption' => 'Kunjungan edukatif siswa'],
            ['file' => 'foto-06.jpg', 'caption' => 'Kegiatan olahraga bersama'],
            ['file' => 'foto-07.jpg', 'caption' => 'Pembinaan siswa berprestasi'],
            ['file' => 'foto-08.jpg', 'caption' => 'Workshop kurikulum merdeka'],
            ['file' => 'foto-09.jpg', 'caption' => 'Rapat orang tua dan guru'],
            ['file' => 'foto-10.jpg', 'caption' => 'Kegiatan literasi pagi'],
        ];

        foreach ($foto1 as $i => $foto) {
            GalleryImage::create([
                'gallery_id' => $album1->id,
                'gambar'     => 'galleries/' . $foto['file'],
                'caption'    => $foto['caption'],
                'alt_text'   => $foto['caption'],
                'order'      => $i + 1,
            ]);
        }

        // ── Album 2: Ekstrakurikuler ──
        $album2 = Gallery::create([
            'judul'   => 'Ekstrakurikuler',
            'deskripsi' => 'Dokumentasi kegiatan ekstrakurikuler siswa',
            'order'   => 2,
        ]);

        $foto2 = [
            ['file' => 'foto-11.jpg', 'caption' => 'Latihan pramuka'],
            ['file' => 'foto-12.jpg', 'caption' => 'Kegiatan futsal siswa'],
            ['file' => 'foto-13.jpg', 'caption' => 'Latihan tari kreasi'],
            ['file' => 'foto-14.jpg', 'caption' => 'Kegiatan PMR'],
            ['file' => 'foto-15.jpg', 'caption' => 'Latihan paduan suara'],
            ['file' => 'foto-16.jpg', 'caption' => 'Kegiatan pencak silat'],
            ['file' => 'foto-17.jpg', 'caption' => 'Latihan basket'],
            ['file' => 'foto-18.jpg', 'caption' => 'Kegiatan karawitan'],
        ];

        foreach ($foto2 as $i => $foto) {
            GalleryImage::create([
                'gallery_id' => $album2->id,
                'gambar'     => 'galleries/' . $foto['file'],
                'caption'    => $foto['caption'],
                'alt_text'   => $foto['caption'],
                'order'      => $i + 1,
            ]);
        }

        // ── Album 3: Prestasi & Penghargaan ──
        $album3 = Gallery::create([
            'judul'   => 'Prestasi & Penghargaan',
            'deskripsi' => 'Dokumentasi prestasi dan penghargaan siswa SMPN 3 Ajibarang',
            'order'   => 3,
        ]);

        $foto3 = [
            ['file' => 'foto-19.jpg', 'caption' => 'Penerimaan piala lomba futsal'],
            ['file' => 'foto-20.jpg', 'caption' => 'Juara olimpiade IPA kabupaten'],
            ['file' => 'foto-21.jpg', 'caption' => 'Penghargaan sekolah adiwiyata'],
            ['file' => 'foto-22.jpg', 'caption' => 'Lomba baca puisi tingkat provinsi'],
            ['file' => 'foto-23.jpg', 'caption' => 'Kejuaraan tari kreasi daerah'],
            ['file' => 'foto-24.jpg', 'caption' => 'Penghargaan kebersihan lingkungan'],
            ['file' => 'foto-25.jpg', 'caption' => 'Lomba FL2SN tingkat kabupaten'],
            ['file' => 'foto-26.jpg', 'caption' => 'Penerimaan sertifikat adiwiyata mandiri'],
            ['file' => 'foto-27.jpg', 'caption' => 'Lomba cerdas cermat antar sekolah'],
            ['file' => 'foto-28.jpg', 'caption' => 'Wisuda dan pelepasan siswa kelas 9'],
        ];

        foreach ($foto3 as $i => $foto) {
            GalleryImage::create([
                'gallery_id' => $album3->id,
                'gambar'     => 'galleries/' . $foto['file'],
                'caption'    => $foto['caption'],
                'alt_text'   => $foto['caption'],
                'order'      => $i + 1,
            ]);
        }

        // ── File upload langsung (avif & jpeg) masuk album Kegiatan ──
        $extraFiles = [
            ['file' => '01KQCMD2JK6GMFKT84X78TGZW3.avif', 'caption' => 'Dokumentasi kegiatan sekolah'],
            ['file' => '01KQCMEC771KP4DCBHT7N1VVZF.jpeg', 'caption' => 'Dokumentasi kegiatan sekolah'],
        ];

        foreach ($extraFiles as $i => $foto) {
            GalleryImage::create([
                'gallery_id' => $album1->id,
                'gambar'     => 'galleries/' . $foto['file'],
                'caption'    => $foto['caption'],
                'alt_text'   => $foto['caption'],
                'order'      => 11 + $i,
            ]);
        }
    }
}