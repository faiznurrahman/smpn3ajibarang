<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Post::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $userId = User::first()?->id ?? 1;

        // ── BERITA (12 post, foto post-01 s.d. post-12) ──
        $berita = [
            [
                'judul'           => 'SMPN 3 Ajibarang Raih Penghargaan Sekolah Adiwiyata Mandiri',
                'isi_konten'      => '<p>SMPN 3 Ajibarang kembali menorehkan prestasi membanggakan dengan berhasil meraih penghargaan Sekolah Adiwiyata Mandiri dari Kementerian Lingkungan Hidup dan Kehutanan. Penghargaan ini merupakan bukti nyata komitmen seluruh warga sekolah dalam menjaga kelestarian lingkungan.</p><p>Kepala sekolah menyampaikan rasa syukur dan terima kasih kepada seluruh siswa, guru, dan orang tua yang telah bersama-sama mewujudkan sekolah berwawasan lingkungan.</p>',
                'thumbnail'       => 'posts/post-01.jpg',
                'tanggal_publish' => '2026-04-01',
            ],
            [
                'judul'           => 'Workshop Kurikulum Merdeka Bersama Seluruh Guru dan Tendik',
                'isi_konten'      => '<p>Dalam rangka peningkatan kualitas pembelajaran, SMPN 3 Ajibarang mengadakan workshop Kurikulum Merdeka yang diikuti oleh seluruh guru dan tenaga kependidikan. Kegiatan ini bertujuan untuk memperdalam pemahaman tentang implementasi Kurikulum Merdeka di kelas.</p><p>Narasumber dari Dinas Pendidikan Kabupaten Banyumas hadir langsung memberikan materi dan pendampingan kepada para peserta.</p>',
                'thumbnail'       => 'posts/post-02.jpg',
                'tanggal_publish' => '2026-03-25',
            ],
            [
                'judul'           => 'Kegiatan P5 Bertema Kearifan Lokal Sukses Digelar',
                'isi_konten'      => '<p>Proyek Penguatan Profil Pelajar Pancasila (P5) dengan tema Kearifan Lokal sukses digelar oleh seluruh siswa kelas 7 dan 8 SMPN 3 Ajibarang. Berbagai karya autentik ditampilkan mulai dari kerajinan batik, kuliner tradisional, hingga pertunjukan seni budaya lokal.</p>',
                'thumbnail'       => 'posts/post-03.jpg',
                'tanggal_publish' => '2026-03-15',
            ],
            [
                'judul'           => 'SMPN 3 Ajibarang Gelar Upacara Peringatan Hari Pendidikan Nasional',
                'isi_konten'      => '<p>Seluruh warga SMPN 3 Ajibarang mengikuti upacara bendera dalam rangka memperingati Hari Pendidikan Nasional. Upacara berlangsung khidmat dengan pembacaan pidato dan penyerahan penghargaan kepada siswa berprestasi.</p>',
                'thumbnail'       => 'posts/post-04.jpg',
                'tanggal_publish' => '2026-03-10',
            ],
            [
                'judul'           => 'Kunjungan Edukatif Siswa Kelas 8 ke Museum Wayang Banyumas',
                'isi_konten'      => '<p>Sebanyak 120 siswa kelas 8 SMPN 3 Ajibarang melakukan kunjungan edukatif ke Museum Wayang Banyumas. Kegiatan ini merupakan bagian dari pembelajaran luar kelas untuk mengenal lebih dekat budaya dan seni tradisional Banyumas.</p>',
                'thumbnail'       => 'posts/post-05.jpg',
                'tanggal_publish' => '2026-03-05',
            ],
            [
                'judul'           => 'Pelatihan Literasi Digital untuk Siswa Kelas 9',
                'isi_konten'      => '<p>SMPN 3 Ajibarang bekerja sama dengan Kominfo Kabupaten Banyumas mengadakan pelatihan literasi digital bagi siswa kelas 9. Pelatihan mencakup materi keamanan berinternet, bijak bermedia sosial, dan pengenalan dasar coding.</p>',
                'thumbnail'       => 'posts/post-06.jpg',
                'tanggal_publish' => '2026-02-20',
            ],
            [
                'judul'           => 'Lomba Futsal Antar Kelas SMP N 3 Ajibarang Berlangsung Meriah',
                'isi_konten'      => '<p>Lomba futsal antar kelas yang diselenggarakan dalam rangka memperingati HUT sekolah berlangsung sangat meriah. Seluruh kelas dari kelas 7 hingga 9 turut berpartisipasi dengan penuh semangat dan sportivitas tinggi.</p>',
                'thumbnail'       => 'posts/post-07.jpg',
                'tanggal_publish' => '2026-02-15',
            ],
            [
                'judul'           => 'Pelantikan Pengurus OSIS Periode 2026/2027',
                'isi_konten'      => '<p>Pengurus OSIS SMPN 3 Ajibarang periode 2026/2027 resmi dilantik oleh Kepala Sekolah dalam upacara pelantikan yang berlangsung khidmat. Sebanyak 20 siswa terpilih siap menjalankan program kerja yang telah disusun.</p>',
                'thumbnail'       => 'posts/post-08.jpg',
                'tanggal_publish' => '2026-02-10',
            ],
            [
                'judul'           => 'Pentas Seni Akhir Tahun SMPN 3 Ajibarang 2026',
                'isi_konten'      => '<p>Pentas seni akhir tahun SMPN 3 Ajibarang berlangsung spektakuler dengan menampilkan berbagai pertunjukan seni dari seluruh kelas. Mulai dari tari tradisional, band musik, drama, hingga fashion show busana daerah.</p>',
                'thumbnail'       => 'posts/post-09.jpg',
                'tanggal_publish' => '2026-01-28',
            ],
            [
                'judul'           => 'Kegiatan Bakti Sosial di Desa Sekitar Ajibarang',
                'isi_konten'      => '<p>Siswa-siswi SMPN 3 Ajibarang bersama guru dan staf mengadakan kegiatan bakti sosial di desa sekitar. Kegiatan meliputi pembersihan lingkungan, pembagian sembako kepada warga kurang mampu, dan penanaman pohon.</p>',
                'thumbnail'       => 'posts/post-10.jpg',
                'tanggal_publish' => '2026-01-20',
            ],
            [
                'judul'           => 'Penerimaan Kunjungan Studi Banding dari SMPN 1 Cilacap',
                'isi_konten'      => '<p>SMPN 3 Ajibarang menerima kunjungan studi banding dari SMPN 1 Cilacap. Kunjungan ini difokuskan pada program Adiwiyata dan pengelolaan lingkungan sekolah yang telah berhasil diterapkan di SMPN 3 Ajibarang.</p>',
                'thumbnail'       => 'posts/post-11.jpg',
                'tanggal_publish' => '2026-01-15',
            ],
            [
                'judul'           => 'Senam Pagi Bersama dalam Rangka Hari Kesehatan Nasional',
                'isi_konten'      => '<p>Dalam rangka memperingati Hari Kesehatan Nasional, SMPN 3 Ajibarang mengadakan senam pagi bersama yang diikuti oleh seluruh warga sekolah. Kegiatan ini juga disertai dengan pemeriksaan kesehatan gratis dari Puskesmas Ajibarang.</p>',
                'thumbnail'       => 'posts/post-12.jpg',
                'tanggal_publish' => '2026-01-10',
            ],
        ];

        foreach ($berita as $item) {
            Post::create(array_merge($item, [
                'type'       => 'berita',
                'status'     => 'published',
                'slug'       => Str::slug($item['judul']),
                'user_id'    => $userId,
                'is_pinned'  => false,
                'start_date' => null,
                'end_date'   => null,
            ]));
        }

        // ── PENGUMUMAN (8 post, tanpa thumbnail) ──
        $pengumuman = [
            [
                'judul'           => 'Libur Akhir Semester Genap Tahun Ajaran 2025/2026',
                'isi_konten'      => '<p>Diberitahukan kepada seluruh siswa, orang tua/wali murid bahwa libur akhir semester genap Tahun Ajaran 2025/2026 akan dilaksanakan mulai tanggal 20 Juni s.d. 13 Juli 2026. Siswa masuk kembali pada tanggal 14 Juli 2026.</p>',
                'tanggal_publish' => '2026-05-01',
                'start_date'      => '2026-05-01',
                'end_date'        => '2026-06-20',
                'is_pinned'       => true,
            ],
            [
                'judul'           => 'Jadwal Penilaian Akhir Tahun (PAT) 2025/2026',
                'isi_konten'      => '<p>Penilaian Akhir Tahun (PAT) Semester Genap Tahun Ajaran 2025/2026 akan dilaksanakan mulai tanggal 2 s.d. 10 Juni 2026. Siswa diwajibkan hadir tepat waktu dan membawa perlengkapan ujian yang telah ditentukan.</p>',
                'tanggal_publish' => '2026-04-15',
                'start_date'      => '2026-04-15',
                'end_date'        => '2026-06-10',
                'is_pinned'       => true,
            ],
            [
                'judul'           => 'Pengumuman Pendaftaran Peserta Didik Baru (PPDB) 2026/2027',
                'isi_konten'      => '<p>SMPN 3 Ajibarang membuka pendaftaran Peserta Didik Baru (PPDB) Tahun Ajaran 2026/2027. Pendaftaran dilakukan secara online melalui website resmi Dinas Pendidikan Kabupaten Banyumas. Kuota yang tersedia sebanyak 8 rombongan belajar.</p>',
                'tanggal_publish' => '2026-04-01',
                'start_date'      => '2026-04-01',
                'end_date'        => '2026-06-30',
                'is_pinned'       => false,
            ],
            [
                'judul'           => 'Imunisasi Siswa Kelas 7 oleh Puskesmas Ajibarang',
                'isi_konten'      => '<p>Diberitahukan kepada orang tua/wali murid kelas 7 bahwa akan dilaksanakan kegiatan imunisasi dari Puskesmas Ajibarang pada hari Rabu, 20 Mei 2026. Siswa diwajibkan hadir dan membawa surat izin orang tua.</p>',
                'tanggal_publish' => '2026-03-20',
                'start_date'      => '2026-03-20',
                'end_date'        => '2026-05-20',
                'is_pinned'       => false,
            ],
            [
                'judul'           => 'Rapat Orang Tua Siswa Kelas 9 Persiapan Kelulusan',
                'isi_konten'      => '<p>Diundang kepada seluruh orang tua/wali murid kelas 9 untuk hadir dalam rapat persiapan kelulusan yang akan dilaksanakan pada Sabtu, 10 Mei 2026 pukul 08.00 WIB di Aula SMPN 3 Ajibarang.</p>',
                'tanggal_publish' => '2026-03-01',
                'start_date'      => '2026-03-01',
                'end_date'        => '2026-05-10',
                'is_pinned'       => false,
            ],
            [
                'judul'           => 'Perubahan Jadwal Kegiatan Ekstrakurikuler Semester Genap',
                'isi_konten'      => '<p>Diberitahukan bahwa jadwal kegiatan ekstrakurikuler semester genap mengalami perubahan. Jadwal baru dapat dilihat di papan pengumuman sekolah atau menghubungi wali kelas masing-masing.</p>',
                'tanggal_publish' => '2026-02-15',
                'start_date'      => '2026-02-15',
                'end_date'        => '2026-06-30',
                'is_pinned'       => false,
            ],
            [
                'judul'           => 'Pengumuman Hasil Seleksi Paskibra Sekolah 2026',
                'isi_konten'      => '<p>Hasil seleksi Paskibra SMPN 3 Ajibarang tahun 2026 telah ditetapkan. Siswa yang lolos seleksi dimohon untuk hadir pada pertemuan perdana pada hari Senin, 1 Maret 2026 pukul 14.00 WIB di lapangan sekolah.</p>',
                'tanggal_publish' => '2026-02-10',
                'start_date'      => '2026-02-10',
                'end_date'        => '2026-03-01',
                'is_pinned'       => false,
            ],
            [
                'judul'           => 'Jadwal Ujian Praktik Kelas 9 Semester Genap 2026',
                'isi_konten'      => '<p>Jadwal ujian praktik untuk siswa kelas 9 semester genap tahun ajaran 2025/2026 telah ditetapkan. Ujian praktik akan berlangsung mulai tanggal 10 s.d. 20 Mei 2026 sesuai mata pelajaran masing-masing.</p>',
                'tanggal_publish' => '2026-01-25',
                'start_date'      => '2026-01-25',
                'end_date'        => '2026-05-20',
                'is_pinned'       => false,
            ],
        ];

        foreach ($pengumuman as $item) {
            Post::create(array_merge($item, [
                'type'      => 'pengumuman',
                'status'    => 'published',
                'slug'      => Str::slug($item['judul']),
                'user_id'   => $userId,
                'thumbnail' => null,
            ]));
        }

        // ── PRESTASI (8 post, foto post-13 s.d. post-20) ──
        $prestasi = [
            [
                'judul'           => 'Juara 1 Lomba Futsal Tingkat Kabupaten Banyumas 2026',
                'isi_konten'      => '<p>Tim futsal SMPN 3 Ajibarang berhasil meraih Juara 1 dalam Lomba Futsal Antar SMP Tingkat Kabupaten Banyumas 2026. Tim berhasil mengalahkan 16 sekolah peserta dengan skor akhir 3-1 di babak final.</p>',
                'thumbnail'       => 'posts/post-13.jpg',
                'tanggal_publish' => '2026-04-10',
            ],
            [
                'judul'           => 'Juara 2 Olimpiade IPA Tingkat Kabupaten 2026',
                'isi_konten'      => '<p>Siswa SMPN 3 Ajibarang berhasil meraih Juara 2 dalam Olimpiade IPA Tingkat Kabupaten Banyumas 2026. Prestasi ini merupakan hasil kerja keras siswa dan bimbingan intensif dari guru pembina selama tiga bulan terakhir.</p>',
                'thumbnail'       => 'posts/post-14.jpg',
                'tanggal_publish' => '2026-03-28',
            ],
            [
                'judul'           => 'Juara 1 Lomba Baca Puisi Tingkat Provinsi Jawa Tengah',
                'isi_konten'      => '<p>Kebanggaan kembali diraih oleh SMPN 3 Ajibarang melalui prestasi siswa di bidang seni sastra. Salah satu siswa kelas 8 berhasil meraih Juara 1 Lomba Baca Puisi Tingkat Provinsi Jawa Tengah yang diselenggarakan di Semarang.</p>',
                'thumbnail'       => 'posts/post-15.jpg',
                'tanggal_publish' => '2026-03-15',
            ],
            [
                'judul'           => 'Juara 3 Lomba Tari Kreasi Tingkat Kabupaten 2026',
                'isi_konten'      => '<p>Kelompok tari SMPN 3 Ajibarang berhasil meraih Juara 3 dalam Lomba Tari Kreasi Tingkat Kabupaten Banyumas 2026. Penampilan yang memukau dengan koreografi yang memadukan unsur budaya lokal Banyumas mendapat pujian dari dewan juri.</p>',
                'thumbnail'       => 'posts/post-16.jpg',
                'tanggal_publish' => '2026-02-25',
            ],
            [
                'judul'           => 'Siswa SMPN 3 Ajibarang Lolos Seleksi OSN Tingkat Provinsi',
                'isi_konten'      => '<p>Dua siswa SMPN 3 Ajibarang berhasil lolos seleksi Olimpiade Sains Nasional (OSN) Tingkat Provinsi Jawa Tengah bidang Matematika dan IPA. Keduanya akan mewakili Kabupaten Banyumas dalam ajang bergengsi tersebut.</p>',
                'thumbnail'       => 'posts/post-17.jpg',
                'tanggal_publish' => '2026-02-10',
            ],
            [
                'judul'           => 'Juara 1 Lomba Debat Bahasa Indonesia Tingkat Kabupaten',
                'isi_konten'      => '<p>Tim debat SMPN 3 Ajibarang berhasil meraih Juara 1 dalam Lomba Debat Bahasa Indonesia Tingkat Kabupaten Banyumas 2026. Tim yang terdiri dari 3 siswa kelas 9 ini tampil percaya diri dan memenangkan semua babak perdebatan.</p>',
                'thumbnail'       => 'posts/post-18.jpg',
                'tanggal_publish' => '2026-01-30',
            ],
            [
                'judul'           => 'Medali Perak Karate Tingkat Provinsi Jawa Tengah 2026',
                'isi_konten'      => '<p>Atlet karate SMPN 3 Ajibarang berhasil meraih medali perak dalam Kejuaraan Karate Tingkat Provinsi Jawa Tengah 2026 kategori kumite kelas 45 kg putra. Prestasi ini semakin mengharumkan nama sekolah di tingkat provinsi.</p>',
                'thumbnail'       => 'posts/post-19.jpg',
                'tanggal_publish' => '2026-01-20',
            ],
            [
                'judul'           => 'Juara Harapan 1 FLS2N Bidang Seni Lukis Tingkat Kabupaten',
                'isi_konten'      => '<p>Siswa SMPN 3 Ajibarang berhasil meraih Juara Harapan 1 dalam Festival dan Lomba Seni Siswa Nasional (FLS2N) bidang Seni Lukis Tingkat Kabupaten Banyumas 2026. Karya yang ditampilkan menggambarkan keindahan alam dan budaya Banyumas.</p>',
                'thumbnail'       => 'posts/post-20.jpg',
                'tanggal_publish' => '2026-01-10',
            ],
        ];

        foreach ($prestasi as $item) {
            Post::create(array_merge($item, [
                'type'       => 'prestasi',
                'status'     => 'published',
                'slug'       => Str::slug($item['judul']),
                'user_id'    => $userId,
                'is_pinned'  => false,
                'start_date' => null,
                'end_date'   => null,
            ]));
        }
    }
}