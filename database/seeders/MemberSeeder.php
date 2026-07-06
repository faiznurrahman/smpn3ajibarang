<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        // Guru members auto-created by TeacherSeeder via Teacher::booted().
        // This seeder only creates siswa (student) members.
        DB::table('members')->where('jenis', 'siswa')->delete();

        $defaults = ['jenis' => 'siswa', 'status' => 'aktif', 'is_active' => true];

        foreach ($this->students() as $data) {
            Member::create(array_merge($defaults, $data));
        }
    }

    private function students(): array
    {
        return [
            // ── Kelas 9A — tahun_masuk 2023 ──────────────────────────────────────
            ['kode_anggota' => '20230001', 'nama' => 'Ahmad Saputra',        'kelas' => '9A', 'tahun_masuk' => 2023, 'no_hp' => '081234560001'],
            ['kode_anggota' => '20230002', 'nama' => 'Bella Lestari',        'kelas' => '9A', 'tahun_masuk' => 2023, 'no_hp' => '081234560002'],
            ['kode_anggota' => '20230003', 'nama' => 'Cahyo Nugroho',        'kelas' => '9A', 'tahun_masuk' => 2023, 'no_hp' => '081234560003'],
            ['kode_anggota' => '20230004', 'nama' => 'Dini Rahayu',          'kelas' => '9A', 'tahun_masuk' => 2023, 'no_hp' => '081234560004'],
            ['kode_anggota' => '20230005', 'nama' => 'Eko Pratama',          'kelas' => '9A', 'tahun_masuk' => 2023, 'no_hp' => '081234560005'],
            ['kode_anggota' => '20230006', 'nama' => 'Fina Dewi',            'kelas' => '9A', 'tahun_masuk' => 2023, 'no_hp' => '081234560006'],
            ['kode_anggota' => '20230007', 'nama' => 'Gilang Wibowo',        'kelas' => '9A', 'tahun_masuk' => 2023, 'no_hp' => '081234560007'],
            ['kode_anggota' => '20230008', 'nama' => 'Hani Kusuma',          'kelas' => '9A', 'tahun_masuk' => 2023, 'no_hp' => '081234560008'],
            ['kode_anggota' => '20230009', 'nama' => 'Ivan Kurniawan',       'kelas' => '9A', 'tahun_masuk' => 2023, 'no_hp' => '081234560009'],
            ['kode_anggota' => '20230010', 'nama' => 'Julia Putri',          'kelas' => '9A', 'tahun_masuk' => 2023, 'no_hp' => '081234560010'],

            // ── Kelas 9B — tahun_masuk 2023 ──────────────────────────────────────
            ['kode_anggota' => '20230011', 'nama' => 'Kevin Santoso',        'kelas' => '9B', 'tahun_masuk' => 2023, 'no_hp' => '081234560011'],
            ['kode_anggota' => '20230012', 'nama' => 'Laila Maharani',       'kelas' => '9B', 'tahun_masuk' => 2023, 'no_hp' => '081234560012'],
            ['kode_anggota' => '20230013', 'nama' => 'Mahendra Ardianto',    'kelas' => '9B', 'tahun_masuk' => 2023, 'no_hp' => '081234560013'],
            ['kode_anggota' => '20230014', 'nama' => 'Maya Puspitasari',     'kelas' => '9B', 'tahun_masuk' => 2023, 'no_hp' => '081234560014'],
            ['kode_anggota' => '20230015', 'nama' => 'Nando Setiawan',       'kelas' => '9B', 'tahun_masuk' => 2023, 'no_hp' => '081234560015'],
            ['kode_anggota' => '20230016', 'nama' => 'Nita Andriani',        'kelas' => '9B', 'tahun_masuk' => 2023, 'no_hp' => '081234560016'],
            ['kode_anggota' => '20230017', 'nama' => 'Oscar Prabowo',        'kelas' => '9B', 'tahun_masuk' => 2023, 'no_hp' => '081234560017'],
            ['kode_anggota' => '20230018', 'nama' => 'Olivia Handayani',     'kelas' => '9B', 'tahun_masuk' => 2023, 'no_hp' => '081234560018'],
            ['kode_anggota' => '20230019', 'nama' => 'Reza Firmansyah',      'kelas' => '9B', 'tahun_masuk' => 2023, 'no_hp' => '081234560019'],
            ['kode_anggota' => '20230020', 'nama' => 'Rita Kusumawati',      'kelas' => '9B', 'tahun_masuk' => 2023, 'no_hp' => '081234560020'],

            // ── Kelas 8A — tahun_masuk 2024 ──────────────────────────────────────
            ['kode_anggota' => '20240021', 'nama' => 'Arif Rahman',          'kelas' => '8A', 'tahun_masuk' => 2024, 'no_hp' => '081234560021'],
            ['kode_anggota' => '20240022', 'nama' => 'Bunga Melati',         'kelas' => '8A', 'tahun_masuk' => 2024, 'no_hp' => '081234560022'],
            ['kode_anggota' => '20240023', 'nama' => 'Candra Permana',       'kelas' => '8A', 'tahun_masuk' => 2024, 'no_hp' => '081234560023'],
            ['kode_anggota' => '20240024', 'nama' => 'Dwi Anggraini',        'kelas' => '8A', 'tahun_masuk' => 2024, 'no_hp' => '081234560024'],
            ['kode_anggota' => '20240025', 'nama' => 'Fahmi Hidayat',        'kelas' => '8A', 'tahun_masuk' => 2024, 'no_hp' => '081234560025'],
            ['kode_anggota' => '20240026', 'nama' => 'Galuh Pertiwi',        'kelas' => '8A', 'tahun_masuk' => 2024, 'no_hp' => '081234560026'],
            ['kode_anggota' => '20240027', 'nama' => 'Hamid Rosyid',         'kelas' => '8A', 'tahun_masuk' => 2024, 'no_hp' => '081234560027'],
            ['kode_anggota' => '20240028', 'nama' => 'Intan Nuraini',        'kelas' => '8A', 'tahun_masuk' => 2024, 'no_hp' => '081234560028'],
            ['kode_anggota' => '20240029', 'nama' => 'Jefri Susanto',        'kelas' => '8A', 'tahun_masuk' => 2024, 'no_hp' => '081234560029'],
            ['kode_anggota' => '20240030', 'nama' => 'Kartika Sari',         'kelas' => '8A', 'tahun_masuk' => 2024, 'no_hp' => '081234560030'],

            // ── Kelas 8B — tahun_masuk 2024 ──────────────────────────────────────
            ['kode_anggota' => '20240031', 'nama' => 'Luthfi Anwar',         'kelas' => '8B', 'tahun_masuk' => 2024, 'no_hp' => '081234560031'],
            ['kode_anggota' => '20240032', 'nama' => 'Maulida Zahra',        'kelas' => '8B', 'tahun_masuk' => 2024, 'no_hp' => '081234560032'],
            ['kode_anggota' => '20240033', 'nama' => 'Naufal Izzuddin',      'kelas' => '8B', 'tahun_masuk' => 2024, 'no_hp' => '081234560033'],
            ['kode_anggota' => '20240034', 'nama' => 'Nurul Amalia',         'kelas' => '8B', 'tahun_masuk' => 2024, 'no_hp' => '081234560034'],
            ['kode_anggota' => '20240035', 'nama' => 'Pandu Yudistira',      'kelas' => '8B', 'tahun_masuk' => 2024, 'no_hp' => '081234560035'],
            ['kode_anggota' => '20240036', 'nama' => 'Putri Rahmawati',      'kelas' => '8B', 'tahun_masuk' => 2024, 'no_hp' => '081234560036'],
            ['kode_anggota' => '20240037', 'nama' => 'Qori Hidayati',        'kelas' => '8B', 'tahun_masuk' => 2024, 'no_hp' => '081234560037'],
            ['kode_anggota' => '20240038', 'nama' => 'Rizky Aditya',         'kelas' => '8B', 'tahun_masuk' => 2024, 'no_hp' => '081234560038'],
            ['kode_anggota' => '20240039', 'nama' => 'Salsabila Fitri',      'kelas' => '8B', 'tahun_masuk' => 2024, 'no_hp' => '081234560039'],
            ['kode_anggota' => '20240040', 'nama' => 'Trio Saputro',         'kelas' => '8B', 'tahun_masuk' => 2024, 'no_hp' => '081234560040'],

            // ── Kelas 7A — tahun_masuk 2025 ──────────────────────────────────────
            ['kode_anggota' => '20250041', 'nama' => 'Udin Hasanuddin',      'kelas' => '7A', 'tahun_masuk' => 2025, 'no_hp' => '081234560041'],
            ['kode_anggota' => '20250042', 'nama' => 'Vina Septiani',        'kelas' => '7A', 'tahun_masuk' => 2025, 'no_hp' => '081234560042'],
            ['kode_anggota' => '20250043', 'nama' => 'Wahyu Prasetyo',       'kelas' => '7A', 'tahun_masuk' => 2025, 'no_hp' => '081234560043'],
            ['kode_anggota' => '20250044', 'nama' => 'Wulan Sari',           'kelas' => '7A', 'tahun_masuk' => 2025, 'no_hp' => '081234560044'],
            ['kode_anggota' => '20250045', 'nama' => 'Xandra Wijaya',        'kelas' => '7A', 'tahun_masuk' => 2025, 'no_hp' => '081234560045'],
            ['kode_anggota' => '20250046', 'nama' => 'Yeni Pujiastuti',      'kelas' => '7A', 'tahun_masuk' => 2025, 'no_hp' => '081234560046'],
            ['kode_anggota' => '20250047', 'nama' => 'Zainal Arifin',        'kelas' => '7A', 'tahun_masuk' => 2025, 'no_hp' => '081234560047'],
            ['kode_anggota' => '20250048', 'nama' => 'Zara Amelia',          'kelas' => '7A', 'tahun_masuk' => 2025, 'no_hp' => '081234560048'],
            ['kode_anggota' => '20250049', 'nama' => 'Andi Firmansyah',      'kelas' => '7A', 'tahun_masuk' => 2025, 'no_hp' => '081234560049'],
            ['kode_anggota' => '20250050', 'nama' => 'Anisa Oktaviani',      'kelas' => '7A', 'tahun_masuk' => 2025, 'no_hp' => '081234560050'],

            // ── Kelas 7B — tahun_masuk 2025 ──────────────────────────────────────
            ['kode_anggota' => '20250051', 'nama' => 'Bintang Ramadan',      'kelas' => '7B', 'tahun_masuk' => 2025, 'no_hp' => '081234560051'],
            ['kode_anggota' => '20250052', 'nama' => 'Caca Ramdani',         'kelas' => '7B', 'tahun_masuk' => 2025, 'no_hp' => '081234560052'],
            ['kode_anggota' => '20250053', 'nama' => 'Dicky Prasetyo',       'kelas' => '7B', 'tahun_masuk' => 2025, 'no_hp' => '081234560053'],
            ['kode_anggota' => '20250054', 'nama' => 'Dini Nurhaliza',       'kelas' => '7B', 'tahun_masuk' => 2025, 'no_hp' => '081234560054'],
            ['kode_anggota' => '20250055', 'nama' => 'Erlangga Putra',       'kelas' => '7B', 'tahun_masuk' => 2025, 'no_hp' => '081234560055'],
            ['kode_anggota' => '20250056', 'nama' => 'Erika Safitri',        'kelas' => '7B', 'tahun_masuk' => 2025, 'no_hp' => '081234560056'],
            ['kode_anggota' => '20250057', 'nama' => 'Faris Maulana',        'kelas' => '7B', 'tahun_masuk' => 2025, 'no_hp' => '081234560057'],
            ['kode_anggota' => '20250058', 'nama' => 'Fauzia Rahman',        'kelas' => '7B', 'tahun_masuk' => 2025, 'no_hp' => '081234560058'],
            ['kode_anggota' => '20250059', 'nama' => 'Galang Satria',        'kelas' => '7B', 'tahun_masuk' => 2025, 'no_hp' => '081234560059'],
            ['kode_anggota' => '20250060', 'nama' => 'Ghea Wulandari',       'kelas' => '7B', 'tahun_masuk' => 2025, 'no_hp' => '081234560060'],
        ];
    }
}
