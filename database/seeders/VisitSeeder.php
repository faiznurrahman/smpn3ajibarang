<?php

namespace Database\Seeders;

use App\Models\Visit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisitSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Visit::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $keperluan = ['Meminjam Buku', 'Mengembalikan Buku', 'Membaca di Tempat', 'Mengerjakan Tugas', 'Mengakses Internet', 'Mencari Referensi'];
        $kelasOptions = ['7A', '7B', '8A', '8B', '9A', '9B'];
        $jamOptions = ['07:30', '08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '13:00', '13:30', '14:00'];

        $namaSiswa = [
            'Ahmad Saputra', 'Bella Lestari', 'Cahyo Nugroho', 'Dini Rahayu', 'Eko Pratama',
            'Fina Dewi', 'Gilang Wibowo', 'Hani Kusuma', 'Ivan Kurniawan', 'Julia Putri',
            'Kevin Santoso', 'Laila Maharani', 'Mahendra Ardianto', 'Maya Puspitasari', 'Nando Setiawan',
            'Arif Rahman', 'Bunga Melati', 'Candra Permana', 'Dwi Anggraini', 'Fahmi Hidayat',
            'Galuh Pertiwi', 'Hamid Rosyid', 'Intan Nuraini', 'Jefri Susanto', 'Kartika Sari',
            'Udin Hasanuddin', 'Vina Septiani', 'Wahyu Prasetyo', 'Wulan Sari', 'Xandra Wijaya',
        ];

        $namaGuru = [
            'Drs. Ahmad Fauzi, M.Pd.', 'Siti Nurhaliza, S.Pd.', 'Budi Santoso, S.Pd.',
            'Dewi Rahayu, S.Pd.', 'Hendra Wijaya, S.Pd.', 'Nurul Hidayah, S.Kom.',
        ];

        $namaUmum = [
            'Slamet Riyadi', 'Tri Wahyuni', 'Agus Budiman', 'Erna Susanti', 'Bambang Supriyadi',
        ];

        // Generate visits for the last 30 days
        // Weekdays only, 3-8 visitors per day
        $visitData = [];

        // Fixed daily visitor data for 30 days
        $dailySchedule = [
            // [tanggal, [visitor records]]
            ['2026-05-12', [
                ['siswa', 0, 0, 0], ['siswa', 1, 1, 1], ['siswa', 2, 2, 2],
                ['guru', 0, null, 3], ['siswa', 3, 3, 4],
            ]],
            ['2026-05-13', [
                ['siswa', 4, 0, 0], ['siswa', 5, 1, 1], ['siswa', 6, 2, 2],
            ]],
            ['2026-05-14', [
                ['siswa', 7, 3, 0], ['siswa', 8, 4, 1], ['guru', 1, null, 2],
                ['siswa', 9, 5, 3], ['umum', 0, null, 4],
            ]],
            ['2026-05-15', [
                ['siswa', 10, 0, 0], ['siswa', 11, 1, 1], ['siswa', 12, 2, 2], ['siswa', 13, 3, 3],
            ]],
            ['2026-05-16', [
                ['siswa', 14, 4, 0], ['siswa', 15, 5, 1], ['guru', 2, null, 2], ['siswa', 16, 0, 3],
            ]],
            ['2026-05-19', [
                ['siswa', 17, 1, 0], ['siswa', 18, 2, 1], ['siswa', 19, 3, 2],
                ['siswa', 20, 4, 3], ['siswa', 21, 5, 4],
            ]],
            ['2026-05-20', [
                ['siswa', 22, 0, 0], ['siswa', 23, 1, 1], ['guru', 3, null, 2],
            ]],
            ['2026-05-21', [
                ['siswa', 24, 2, 0], ['siswa', 25, 3, 1], ['siswa', 26, 4, 2],
                ['umum', 1, null, 3], ['siswa', 27, 5, 4],
            ]],
            ['2026-05-22', [
                ['siswa', 28, 0, 0], ['siswa', 29, 1, 1], ['siswa', 0, 2, 2],
            ]],
            ['2026-05-23', [
                ['siswa', 1, 3, 0], ['guru', 4, null, 1], ['siswa', 2, 4, 2],
                ['siswa', 3, 5, 3], ['siswa', 4, 0, 4],
            ]],
            ['2026-05-26', [
                ['siswa', 5, 1, 0], ['siswa', 6, 2, 1], ['siswa', 7, 3, 2],
                ['guru', 5, null, 3],
            ]],
            ['2026-05-27', [
                ['siswa', 8, 4, 0], ['siswa', 9, 5, 1], ['umum', 2, null, 2], ['siswa', 10, 0, 3],
            ]],
            ['2026-05-28', [
                ['siswa', 11, 1, 0], ['siswa', 12, 2, 1], ['siswa', 13, 3, 2],
                ['siswa', 14, 4, 3], ['siswa', 15, 5, 4],
            ]],
            ['2026-05-29', [
                ['siswa', 16, 0, 0], ['siswa', 17, 1, 1], ['guru', 0, null, 2],
            ]],
            ['2026-05-30', [
                ['siswa', 18, 2, 0], ['siswa', 19, 3, 1], ['siswa', 20, 4, 2],
                ['umum', 3, null, 3], ['siswa', 21, 5, 4],
            ]],
            ['2026-06-02', [
                ['siswa', 22, 0, 0], ['siswa', 23, 1, 1], ['siswa', 24, 2, 2],
                ['siswa', 25, 3, 3], ['guru', 1, null, 4], ['siswa', 26, 4, 5],
            ]],
            ['2026-06-03', [
                ['siswa', 27, 5, 0], ['siswa', 28, 0, 1], ['siswa', 29, 1, 2],
            ]],
            ['2026-06-04', [
                ['siswa', 0, 2, 0], ['siswa', 1, 3, 1], ['guru', 2, null, 2],
                ['siswa', 2, 4, 3], ['umum', 4, null, 4],
            ]],
            ['2026-06-05', [
                ['siswa', 3, 5, 0], ['siswa', 4, 0, 1], ['siswa', 5, 1, 2],
                ['siswa', 6, 2, 3], ['siswa', 7, 3, 4], ['guru', 3, null, 5],
            ]],
            ['2026-06-06', [
                ['siswa', 8, 4, 0], ['siswa', 9, 5, 1], ['siswa', 10, 0, 2],
            ]],
            ['2026-06-09', [
                ['siswa', 11, 1, 0], ['siswa', 12, 2, 1], ['siswa', 13, 3, 2],
                ['guru', 4, null, 3], ['siswa', 14, 4, 4],
            ]],
            ['2026-06-10', [
                ['siswa', 15, 5, 0], ['siswa', 16, 0, 1], ['umum', 0, null, 2],
                ['siswa', 17, 1, 3],
            ]],
        ];

        foreach ($dailySchedule as [$tanggal, $visitors]) {
            foreach ($visitors as [$jenis, $idx, $kelasIdx, $jamIdx]) {
                if ($jenis === 'siswa') {
                    $nama  = $namaSiswa[$idx % count($namaSiswa)];
                    $kelas = $kelasOptions[$kelasIdx % count($kelasOptions)];
                } elseif ($jenis === 'guru') {
                    $nama  = $namaGuru[$idx % count($namaGuru)];
                    $kelas = null;
                } else {
                    $nama  = $namaUmum[$idx % count($namaUmum)];
                    $kelas = null;
                }

                Visit::create([
                    'nama'             => $nama,
                    'jenis_pengunjung' => $jenis,
                    'kelas'            => $kelas,
                    'keperluan'        => $keperluan[$jamIdx % count($keperluan)],
                    'tgl_kunjungan'    => $tanggal,
                    'jam_kunjungan'    => $jamOptions[$jamIdx % count($jamOptions)],
                ]);
            }
        }
    }
}
