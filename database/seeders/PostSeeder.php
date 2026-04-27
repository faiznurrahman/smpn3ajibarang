<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $userId = User::first()->id;

        // ── BERITA (10) ──────────────────────────────────────────
        $berita = [
            [
                'judul'          => 'SMPN 3 Ajibarang Raih Penghargaan Sekolah Adiwiyata Mandiri',
                'isi_konten'     => '<p>SMPN 3 Ajibarang berhasil meraih penghargaan bergengsi Sekolah Adiwiyata Mandiri dari Kementerian Lingkungan Hidup dan Kehutanan. Penghargaan ini diberikan atas komitmen sekolah dalam menjaga kelestarian lingkungan hidup.</p><p>Kepala Sekolah menyampaikan rasa syukur dan terima kasih kepada seluruh warga sekolah yang telah bersama-sama mewujudkan lingkungan sekolah yang bersih, sehat, dan ramah lingkungan.</p>',
                'thumbnail'      => null,
                'tanggal_publish' => '2026-04-01',
            ],
            [
                'judul'          => 'Workshop Kurikulum Merdeka Bersama Seluruh Guru dan Tendik',
                'isi_konten'     => '<p>Dalam rangka meningkatkan kompetensi tenaga pendidik, SMPN 3 Ajibarang menggelar Workshop Kurikulum Merdeka yang diikuti oleh seluruh guru dan tenaga kependidikan.</p><p>Workshop ini menghadirkan narasumber dari Dinas Pendidikan Kabupaten Banyumas yang memberikan pemaparan mengenai implementasi Kurikulum Merdeka di tingkat SMP.</p>',
                'thumbnail'      => null,
                'tanggal_publish' => '2026-03-25',
            ],
            [
                'judul'          => 'Kegiatan P5 Bertema Kearifan Lokal Sukses Digelar',
                'isi_konten'     => '<p>Siswa-siswi SMPN 3 Ajibarang menggelar pameran hasil kegiatan Projek Penguatan Profil Pelajar Pancasila (P5) dengan tema Kearifan Lokal Banyumas.</p><p>Berbagai karya ditampilkan mulai dari kerajinan tangan, pertunjukan seni tradisional, hingga kuliner khas Banyumas yang dibuat langsung oleh para siswa.</p>',
                'thumbnail'      => null,
                'tanggal_publish' => '2026-03-15',
            ],
            [
                'judul'          => 'SMPN 3 Ajibarang Gelar Upacara Peringatan Hari Pendidikan Nasional',
                'isi_konten'     => '<p>Seluruh warga SMPN 3 Ajibarang mengikuti upacara bendera dalam rangka memperingati Hari Pendidikan Nasional yang jatuh pada tanggal 2 Mei.</p><p>Dalam amanatnya, Kepala Sekolah mengajak seluruh siswa untuk terus semangat belajar dan memanfaatkan teknologi secara bijak demi masa depan yang lebih cerah.</p>',
                'thumbnail'      => null,
                'tanggal_publish' => '2026-03-10',
            ],
            [
                'judul'          => 'Kunjungan Edukatif Siswa Kelas 8 ke Museum Wayang Banyumas',
                'isi_konten'     => '<p>Siswa kelas 8 SMPN 3 Ajibarang melaksanakan kunjungan edukatif ke Museum Wayang Banyumas sebagai bagian dari pembelajaran IPS dan Seni Budaya.</p><p>Para siswa antusias mempelajari sejarah dan filosofi wayang kulit khas Banyumasan yang berbeda dengan wayang dari daerah lain di Jawa.</p>',
                'thumbnail'      => null,
                'tanggal_publish' => '2026-03-05',
            ],
            [
                'judul'          => 'Tim Futsal SMPN 3 Ajibarang Juara 1 Tingkat Kabupaten',
                'isi_konten'     => '<p>Tim futsal SMPN 3 Ajibarang berhasil meraih juara pertama dalam turnamen futsal antar SMP se-Kabupaten Banyumas yang diselenggarakan di GOR Satria Purwokerto.</p><p>Tim berhasil mengalahkan juara bertahan dari SMPN 1 Purwokerto dengan skor 3-1 di babak final yang berlangsung sengit.</p>',
                'thumbnail'      => null,
                'tanggal_publish' => '2026-02-28',
            ],
            [
                'judul'          => 'Pelantikan Pengurus OSIS Periode 2026/2027',
                'isi_konten'     => '<p>SMPN 3 Ajibarang resmi melantik pengurus OSIS periode 2026/2027 dalam sebuah upacara khidmat yang disaksikan oleh seluruh siswa, guru, dan orang tua.</p><p>Ketua OSIS terpilih, Daffa Rizky Pratama dari kelas 8B, menyampaikan program kerja unggulan yang akan dilaksanakan selama satu tahun ke depan.</p>',
                'thumbnail'      => null,
                'tanggal_publish' => '2026-02-20',
            ],
            [
                'judul'          => 'Kegiatan Literasi Digital untuk Siswa Kelas 7',
                'isi_konten'     => '<p>Dalam rangka meningkatkan kecakapan digital siswa, SMPN 3 Ajibarang mengadakan pelatihan literasi digital khusus untuk siswa kelas 7.</p><p>Materi yang diberikan meliputi keamanan berinternet, cara mengenali hoaks, serta etika bermedia sosial yang baik dan bertanggung jawab.</p>',
                'thumbnail'      => null,
                'tanggal_publish' => '2026-02-15',
            ],
            [
                'judul'          => 'Bakti Sosial dan Bersih Lingkungan Bersama Warga Sekitar',
                'isi_konten'     => '<p>Warga SMPN 3 Ajibarang bersama siswa kelas 9 menggelar kegiatan bakti sosial dan bersih lingkungan di sekitar sekolah sebagai wujud kepedulian terhadap masyarakat.</p><p>Kegiatan ini meliputi pembersihan saluran air, penanaman pohon, dan pembagian sembako kepada warga kurang mampu di sekitar lingkungan sekolah.</p>',
                'thumbnail'      => null,
                'tanggal_publish' => '2026-02-10',
            ],
            [
                'judul'          => 'Penerimaan Kunjungan Studi Banding dari SMPN 2 Purwokerto',
                'isi_konten'     => '<p>SMPN 3 Ajibarang menerima kunjungan studi banding dari SMPN 2 Purwokerto dalam rangka berbagi pengalaman terkait implementasi program Adiwiyata dan Kurikulum Merdeka.</p><p>Delegasi dari SMPN 2 Purwokerto yang berjumlah 20 orang disambut hangat dan diajak berkeliling melihat fasilitas dan program unggulan sekolah.</p>',
                'thumbnail'      => null,
                'tanggal_publish' => '2026-02-05',
            ],
        ];

        // ── PENGUMUMAN (10) ──────────────────────────────────────
        $pengumuman = [
            [
                'judul'      => 'Libur Akhir Semester Genap Tahun Ajaran 2025/2026',
                'isi_konten' => '<p>Diberitahukan kepada seluruh siswa, orang tua, dan wali murid bahwa libur akhir semester genap tahun ajaran 2025/2026 akan dilaksanakan mulai tanggal 20 Juni hingga 13 Juli 2026.</p>',
                'start_date' => '2026-06-10',
                'end_date'   => '2026-06-20',
                'is_pinned'  => true,
                'tanggal_publish' => '2026-06-01',
            ],
            [
                'judul'      => 'Jadwal Penilaian Akhir Tahun (PAT) 2025/2026',
                'isi_konten' => '<p>Penilaian Akhir Tahun (PAT) semester genap tahun ajaran 2025/2026 akan dilaksanakan mulai tanggal 2 Juni sampai dengan 7 Juni 2026. Siswa diharapkan mempersiapkan diri dengan baik.</p>',
                'start_date' => '2026-05-20',
                'end_date'   => '2026-06-07',
                'is_pinned'  => true,
                'tanggal_publish' => '2026-05-15',
            ],
            [
                'judul'      => 'Pembagian Rapor Semester Genap',
                'isi_konten' => '<p>Pembagian rapor semester genap tahun ajaran 2025/2026 akan dilaksanakan pada hari Sabtu, 18 Juni 2026. Orang tua/wali murid diharap hadir langsung ke sekolah.</p>',
                'start_date' => '2026-06-10',
                'end_date'   => '2026-06-18',
                'is_pinned'  => false,
                'tanggal_publish' => '2026-06-05',
            ],
            [
                'judul'      => 'Pengumpulan Tugas Projek P5 Semester Genap',
                'isi_konten' => '<p>Seluruh siswa diwajibkan mengumpulkan laporan projek P5 semester genap paling lambat tanggal 25 Mei 2026 kepada guru pembimbing masing-masing kelompok.</p>',
                'start_date' => '2026-05-10',
                'end_date'   => '2026-05-25',
                'is_pinned'  => false,
                'tanggal_publish' => '2026-05-08',
            ],
            [
                'judul'      => 'Kegiatan Classmeeting Pasca PAT',
                'isi_konten' => '<p>Setelah pelaksanaan PAT, akan diadakan kegiatan classmeeting yang meliputi berbagai lomba antar kelas. Kegiatan ini akan dilaksanakan pada tanggal 9-11 Juni 2026.</p>',
                'start_date' => '2026-06-01',
                'end_date'   => '2026-06-11',
                'is_pinned'  => false,
                'tanggal_publish' => '2026-05-28',
            ],
            [
                'judul'      => 'Pendaftaran Ekstrakurikuler Tahun Ajaran Baru 2026/2027',
                'isi_konten' => '<p>Pendaftaran ekstrakurikuler untuk tahun ajaran baru 2026/2027 dibuka mulai tanggal 14 Juli 2026. Formulir pendaftaran dapat diambil di ruang TU atau diunduh melalui website sekolah.</p>',
                'start_date' => '2026-07-14',
                'end_date'   => '2026-07-25',
                'is_pinned'  => false,
                'tanggal_publish' => '2026-07-10',
            ],
            [
                'judul'      => 'Pertemuan Orang Tua Siswa Kelas 9',
                'isi_konten' => '<p>Akan diadakan pertemuan orang tua siswa kelas 9 pada hari Sabtu, 10 Mei 2026 pukul 08.00 WIB di Aula SMPN 3 Ajibarang. Kehadiran orang tua/wali murid sangat diharapkan.</p>',
                'start_date' => '2026-05-05',
                'end_date'   => '2026-05-10',
                'is_pinned'  => false,
                'tanggal_publish' => '2026-05-03',
            ],
            [
                'judul'      => 'Imunisasi Siswa Kelas 7 oleh Puskesmas Ajibarang',
                'isi_konten' => '<p>Akan dilaksanakan program imunisasi bagi siswa kelas 7 yang bekerja sama dengan Puskesmas Ajibarang pada tanggal 15 Mei 2026. Siswa diharapkan membawa kartu kesehatan.</p>',
                'start_date' => '2026-05-12',
                'end_date'   => '2026-05-15',
                'is_pinned'  => false,
                'tanggal_publish' => '2026-05-10',
            ],
            [
                'judul'      => 'Larangan Penggunaan Ponsel Selama Jam Pelajaran',
                'isi_konten' => '<p>Diberitahukan kepada seluruh siswa bahwa penggunaan ponsel selama jam pelajaran berlangsung dilarang keras. Ponsel yang ditemukan akan disita dan dikembalikan kepada orang tua.</p>',
                'start_date' => '2026-04-01',
                'end_date'   => null,
                'is_pinned'  => false,
                'tanggal_publish' => '2026-04-01',
            ],
            [
                'judul'      => 'Peringatan Batas Pembayaran SPP Bulan Mei 2026',
                'isi_konten' => '<p>Diingatkan kepada seluruh orang tua/wali murid bahwa batas akhir pembayaran SPP bulan Mei 2026 adalah tanggal 15 Mei 2026. Pembayaran dapat dilakukan di loket TU pada jam kerja.</p>',
                'start_date' => '2026-05-01',
                'end_date'   => '2026-05-15',
                'is_pinned'  => false,
                'tanggal_publish' => '2026-05-01',
            ],
        ];

        // ── PRESTASI (10) ────────────────────────────────────────
        $prestasi = [
            [
                'judul'          => 'Juara 1 Lomba Futsal Tingkat Kabupaten Banyumas 2026',
                'isi_konten'     => '<p>Tim futsal SMPN 3 Ajibarang berhasil meraih juara pertama dalam turnamen futsal antar SMP se-Kabupaten Banyumas. Ini merupakan prestasi membanggakan yang diraih atas kerja keras dan latihan yang konsisten.</p>',
                'thumbnail'      => null,
                'tanggal_publish' => '2026-03-01',
            ],
            [
                'judul'          => 'Juara 2 Olimpiade IPA Tingkat Kabupaten 2026',
                'isi_konten'     => '<p>Siswa kelas 9 SMPN 3 Ajibarang berhasil meraih juara kedua dalam Olimpiade IPA tingkat Kabupaten Banyumas. Prestasi ini menjadi bukti nyata kualitas pembelajaran sains di sekolah.</p>',
                'thumbnail'      => null,
                'tanggal_publish' => '2026-02-25',
            ],
            [
                'judul'          => 'Juara 1 Lomba Baca Puisi Tingkat Provinsi Jawa Tengah',
                'isi_konten'     => '<p>Salah satu siswa kelas 8 SMPN 3 Ajibarang berhasil meraih juara pertama dalam lomba baca puisi tingkat Provinsi Jawa Tengah yang diselenggarakan di Semarang.</p>',
                'thumbnail'      => null,
                'tanggal_publish' => '2026-02-20',
            ],
            [
                'judul'          => 'Juara 3 Lomba Tari Kreasi FL2SN Tingkat Kabupaten',
                'isi_konten'     => '<p>Tim tari kreasi SMPN 3 Ajibarang berhasil meraih juara ketiga dalam Festival dan Lomba Seni Siswa Nasional (FL2SN) tingkat Kabupaten Banyumas cabang tari kreasi.</p>',
                'thumbnail'      => null,
                'tanggal_publish' => '2026-02-15',
            ],
            [
                'judul'          => 'Juara 2 Lomba Matematika Tingkat Kabupaten 2026',
                'isi_konten'     => '<p>Siswa kelas 9 atas nama Rafi Ardian berhasil meraih juara kedua dalam lomba matematika tingkat SMP se-Kabupaten Banyumas yang diselenggarakan oleh Dinas Pendidikan.</p>',
                'thumbnail'      => null,
                'tanggal_publish' => '2026-02-10',
            ],
            [
                'judul'          => 'Juara 1 Lomba Pidato Bahasa Indonesia Tingkat Kabupaten',
                'isi_konten'     => '<p>Siswa kelas 8 SMPN 3 Ajibarang berhasil meraih juara pertama dalam lomba pidato bahasa Indonesia tingkat SMP se-Kabupaten Banyumas dengan tema Pendidikan Karakter Generasi Muda.</p>',
                'thumbnail'      => null,
                'tanggal_publish' => '2026-01-30',
            ],
            [
                'judul'          => 'Penghargaan Sekolah Sehat Tingkat Kabupaten Banyumas',
                'isi_konten'     => '<p>SMPN 3 Ajibarang meraih penghargaan Sekolah Sehat tingkat Kabupaten Banyumas dari Dinas Kesehatan. Penghargaan ini diberikan atas keberhasilan sekolah dalam menerapkan program Perilaku Hidup Bersih dan Sehat (PHBS).</p>',
                'thumbnail'      => null,
                'tanggal_publish' => '2026-01-25',
            ],
            [
                'judul'          => 'Juara 2 Lomba Karya Ilmiah Remaja Tingkat Karesidenan',
                'isi_konten'     => '<p>Tim KIR SMPN 3 Ajibarang berhasil meraih juara kedua dalam lomba Karya Ilmiah Remaja tingkat Karesidenan Banyumas dengan penelitian berjudul Pemanfaatan Limbah Organik sebagai Pupuk Kompos.</p>',
                'thumbnail'      => null,
                'tanggal_publish' => '2026-01-20',
            ],
            [
                'judul'          => 'Juara 1 Lomba Desain Poster Digital Tingkat Kabupaten',
                'isi_konten'     => '<p>Siswa kelas 9 SMPN 3 Ajibarang berhasil meraih juara pertama dalam lomba desain poster digital tingkat SMP se-Kabupaten Banyumas yang diselenggarakan dalam rangka Hari Sumpah Pemuda.</p>',
                'thumbnail'      => null,
                'tanggal_publish' => '2026-01-15',
            ],
            [
                'judul'          => 'Juara 3 Lomba Catur Tingkat Kabupaten 2026',
                'isi_konten'     => '<p>Atlet catur SMPN 3 Ajibarang berhasil meraih juara ketiga dalam kejuaraan catur pelajar tingkat SMP se-Kabupaten Banyumas yang diselenggarakan oleh PERCASI Kabupaten Banyumas.</p>',
                'thumbnail'      => null,
                'tanggal_publish' => '2026-01-10',
            ],
        ];

        // Insert berita
        foreach ($berita as $item) {
            Post::create(array_merge($item, [
                'type'       => 'berita',
                'status'     => 'published',
                'user_id'    => $userId,
                'slug'       => \Illuminate\Support\Str::slug($item['judul']),
            ]));
        }

        // Insert pengumuman
        foreach ($pengumuman as $item) {
            Post::create(array_merge($item, [
                'type'    => 'pengumuman',
                'status'  => 'published',
                'user_id' => $userId,
                'slug'    => \Illuminate\Support\Str::slug($item['judul']),
            ]));
        }

        // Insert prestasi
        foreach ($prestasi as $item) {
            Post::create(array_merge($item, [
                'type'    => 'prestasi',
                'status'  => 'published',
                'user_id' => $userId,
                'slug'    => \Illuminate\Support\Str::slug($item['judul']),
            ]));
        }
    }
}