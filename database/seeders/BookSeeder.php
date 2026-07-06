<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Book::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $books = [
            // Fiksi
            ['isbn' => '9786020312341', 'judul' => 'Laskar Pelangi',                          'penulis' => 'Andrea Hirata',         'penerbit' => 'Bentang Pustaka',            'tahun' => 2005, 'kategori' => 'Fiksi',        'rak' => 'A-1', 'stok' => 5,  'deskripsi' => 'Novel best-seller tentang perjuangan anak-anak Belitung dalam meraih mimpi.'],
            ['isbn' => '9786020456782', 'judul' => 'Sang Pemimpi',                             'penulis' => 'Andrea Hirata',         'penerbit' => 'Bentang Pustaka',            'tahun' => 2006, 'kategori' => 'Fiksi',        'rak' => 'A-1', 'stok' => 4,  'deskripsi' => 'Kisah persahabatan Ikal dan Arai dalam meraih impian ke Eropa.'],
            ['isbn' => '9786020690123', 'judul' => 'Dilan: Dia adalah Dilanku Tahun 1990',    'penulis' => 'Pidi Baiq',             'penerbit' => 'Pastel Books',               'tahun' => 2014, 'kategori' => 'Fiksi',        'rak' => 'A-2', 'stok' => 6,  'deskripsi' => 'Novel romantis remaja yang sangat populer di kalangan anak muda Indonesia.'],
            ['isbn' => '9786020734564', 'judul' => 'Bumi',                                    'penulis' => 'Tere Liye',             'penerbit' => 'Gramedia Pustaka Utama',     'tahun' => 2014, 'kategori' => 'Fiksi',        'rak' => 'A-2', 'stok' => 5,  'deskripsi' => 'Novel fantasi seri Bumi tentang petualangan di dunia paralel.'],
            ['isbn' => '9786020878905', 'judul' => 'Negeri 5 Menara',                         'penulis' => 'Ahmad Fuadi',           'penerbit' => 'Gramedia Pustaka Utama',     'tahun' => 2009, 'kategori' => 'Fiksi',        'rak' => 'A-3', 'stok' => 4,  'deskripsi' => 'Novel inspiratif tentang kehidupan santri di pesantren dan perjuangan meraih cita-cita.'],
            ['isbn' => '9786020912346', 'judul' => 'Si Anak Spesial',                         'penulis' => 'Tere Liye',             'penerbit' => 'Republika Penerbit',         'tahun' => 2018, 'kategori' => 'Fiksi',        'rak' => 'A-3', 'stok' => 4,  'deskripsi' => 'Kisah Elsa, si anak spesial yang memiliki kemampuan luar biasa.'],
            ['isbn' => '9786021056787', 'judul' => 'Harry Potter dan Batu Bertuah',           'penulis' => 'J.K. Rowling',          'penerbit' => 'Gramedia Pustaka Utama',     'tahun' => 2019, 'kategori' => 'Fiksi',        'rak' => 'A-4', 'stok' => 3,  'deskripsi' => 'Petualangan Harry Potter dalam dunia sihir yang penuh misteri.'],

            // Motivasi & Pengembangan Diri
            ['isbn' => '9786021234568', 'judul' => 'Atomic Habits',                           'penulis' => 'James Clear',           'penerbit' => 'Gramedia Pustaka Utama',     'tahun' => 2020, 'kategori' => 'Motivasi',     'rak' => 'B-1', 'stok' => 3,  'deskripsi' => 'Panduan praktis membangun kebiasaan baik dan menghilangkan kebiasaan buruk.'],
            ['isbn' => '9786021678909', 'judul' => 'Sebuah Seni untuk Bersikap Bodo Amat',   'penulis' => 'Mark Manson',           'penerbit' => 'Grasindo',                   'tahun' => 2018, 'kategori' => 'Motivasi',     'rak' => 'B-1', 'stok' => 3,  'deskripsi' => 'Pendekatan tidak konvensional untuk menjalani kehidupan yang lebih baik.'],
            ['isbn' => '9786022012340', 'judul' => 'Ikigai: Rahasia Hidup Bahagia',           'penulis' => 'Hector Garcia',         'penerbit' => 'Bhuana Ilmu Populer',        'tahun' => 2019, 'kategori' => 'Motivasi',     'rak' => 'B-2', 'stok' => 3,  'deskripsi' => 'Filosofi Jepang tentang menemukan makna dan tujuan hidup.'],

            // Sains & Teknologi
            ['isbn' => '9786022345671', 'judul' => 'Fisika Dasar untuk SMP',                  'penulis' => 'Tim Erlangga',          'penerbit' => 'Erlangga',                   'tahun' => 2022, 'kategori' => 'Sains',        'rak' => 'C-1', 'stok' => 8,  'deskripsi' => 'Buku referensi fisika dasar untuk pelajar SMP dengan penjelasan mudah dipahami.'],
            ['isbn' => '9786022689012', 'judul' => 'Biologi: Kehidupan di Bumi',              'penulis' => 'Sudjadi & Laila',       'penerbit' => 'Yudhistira',                 'tahun' => 2021, 'kategori' => 'Sains',        'rak' => 'C-1', 'stok' => 7,  'deskripsi' => 'Buku biologi yang membahas kehidupan dari tingkat sel hingga ekosistem.'],
            ['isbn' => '9786023012343', 'judul' => 'Kimia Seru untuk Remaja',                 'penulis' => 'David Blatner',         'penerbit' => 'Noura Books',                'tahun' => 2019, 'kategori' => 'Sains',        'rak' => 'C-2', 'stok' => 5,  'deskripsi' => 'Pengenalan dunia kimia yang menarik dan mudah dipahami untuk pelajar muda.'],
            ['isbn' => '9786023456784', 'judul' => 'Pengantar Pemrograman Python',            'penulis' => 'Budiman Setyono',       'penerbit' => 'Andi Publisher',             'tahun' => 2023, 'kategori' => 'Teknologi',    'rak' => 'C-3', 'stok' => 6,  'deskripsi' => 'Panduan belajar Python dari dasar untuk pemula, cocok untuk pelajar SMP dan SMA.'],
            ['isbn' => '9786023890125', 'judul' => 'Internet of Things untuk Pemula',         'penulis' => 'Rudi Hartono',          'penerbit' => 'Elex Media Komputindo',      'tahun' => 2022, 'kategori' => 'Teknologi',    'rak' => 'C-3', 'stok' => 4,  'deskripsi' => 'Konsep dan implementasi IoT untuk pelajar yang tertarik dengan teknologi.'],

            // Sejarah & Budaya
            ['isbn' => '9786024012346', 'judul' => 'Sejarah Indonesia Modern',                'penulis' => 'M.C. Ricklefs',         'penerbit' => 'Serambi Ilmu Semesta',       'tahun' => 2015, 'kategori' => 'Sejarah',      'rak' => 'D-1', 'stok' => 4,  'deskripsi' => 'Sejarah Indonesia dari era kolonial hingga era reformasi yang komprehensif.'],
            ['isbn' => '9786024456787', 'judul' => 'Budaya Banyumas: Sejarah dan Kearifan Lokal', 'penulis' => 'Ahmad Tohari',     'penerbit' => 'Unsoed Press',               'tahun' => 2018, 'kategori' => 'Budaya',       'rak' => 'D-2', 'stok' => 5,  'deskripsi' => 'Eksplorasi budaya dan kearifan lokal Banyumas yang kaya dan unik.'],

            // Agama & Budi Pekerti
            ['isbn' => '9786024890128', 'judul' => 'Pendidikan Agama Islam Kelas 7',          'penulis' => 'Kementerian Agama RI', 'penerbit' => 'Kementerian Agama RI',       'tahun' => 2022, 'kategori' => 'Agama',        'rak' => 'E-1', 'stok' => 10, 'deskripsi' => 'Buku teks PAI dan budi pekerti kelas 7 SMP sesuai Kurikulum Merdeka.'],
            ['isbn' => '9786025012349', 'judul' => 'Pendidikan Agama Islam Kelas 8',          'penulis' => 'Kementerian Agama RI', 'penerbit' => 'Kementerian Agama RI',       'tahun' => 2022, 'kategori' => 'Agama',        'rak' => 'E-1', 'stok' => 10, 'deskripsi' => 'Buku teks PAI dan budi pekerti kelas 8 SMP sesuai Kurikulum Merdeka.'],
            ['isbn' => '9786025456780', 'judul' => 'Pendidikan Agama Islam Kelas 9',          'penulis' => 'Kementerian Agama RI', 'penerbit' => 'Kementerian Agama RI',       'tahun' => 2022, 'kategori' => 'Agama',        'rak' => 'E-1', 'stok' => 10, 'deskripsi' => 'Buku teks PAI dan budi pekerti kelas 9 SMP sesuai Kurikulum Merdeka.'],

            // Referensi
            ['isbn' => '9786025890121', 'judul' => 'Kamus Besar Bahasa Indonesia Edisi V',   'penulis' => 'Tim Penyusun KBBI',     'penerbit' => 'Balai Pustaka',              'tahun' => 2020, 'kategori' => 'Referensi',    'rak' => 'F-1', 'stok' => 3,  'deskripsi' => 'Kamus resmi bahasa Indonesia edisi terbaru dari Badan Pengembangan Bahasa.'],
            ['isbn' => '9786026012342', 'judul' => 'Ensiklopedia Alam Indonesia',             'penulis' => 'Tim Redaksi',           'penerbit' => 'Bhuana Ilmu Populer',        'tahun' => 2019, 'kategori' => 'Referensi',    'rak' => 'F-2', 'stok' => 3,  'deskripsi' => 'Ensiklopedia lengkap tentang keanekaragaman hayati dan alam Indonesia.'],

            // Matematika
            ['isbn' => '9786026456783', 'judul' => 'Matematika Kelas 7 Kurikulum Merdeka',   'penulis' => 'Tim Kemendikbud',       'penerbit' => 'Pusat Perbukuan Kemendikbud','tahun' => 2022, 'kategori' => 'Matematika',   'rak' => 'G-1', 'stok' => 9,  'deskripsi' => 'Buku teks matematika kelas 7 SMP sesuai Kurikulum Merdeka.'],
            ['isbn' => '9786026890124', 'judul' => 'Matematika Kelas 8 Kurikulum Merdeka',   'penulis' => 'Tim Kemendikbud',       'penerbit' => 'Pusat Perbukuan Kemendikbud','tahun' => 2022, 'kategori' => 'Matematika',   'rak' => 'G-1', 'stok' => 9,  'deskripsi' => 'Buku teks matematika kelas 8 SMP sesuai Kurikulum Merdeka.'],
            ['isbn' => '9786027012345', 'judul' => 'Matematika Kelas 9 Kurikulum Merdeka',   'penulis' => 'Tim Kemendikbud',       'penerbit' => 'Pusat Perbukuan Kemendikbud','tahun' => 2022, 'kategori' => 'Matematika',   'rak' => 'G-1', 'stok' => 9,  'deskripsi' => 'Buku teks matematika kelas 9 SMP sesuai Kurikulum Merdeka.'],

            // Lingkungan
            ['isbn' => '9786027456786', 'judul' => 'Panduan Sekolah Adiwiyata',              'penulis' => 'Tim KLHK',              'penerbit' => 'KLHK Press',                 'tahun' => 2020, 'kategori' => 'Lingkungan',   'rak' => 'H-1', 'stok' => 4,  'deskripsi' => 'Panduan lengkap program Adiwiyata untuk sekolah peduli lingkungan hidup.'],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
