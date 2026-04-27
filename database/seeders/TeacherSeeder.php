<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [
            // Guru
            ['nama' => 'Drs. Ahmad Fauzi, M.Pd.',     'jenis' => 'guru',  'jabatan' => 'Guru Senior',        'mata_pelajaran' => 'Matematika',          'order' => 1],
            ['nama' => 'Siti Nurhaliza, S.Pd.',        'jenis' => 'guru',  'jabatan' => 'Wali Kelas 7A',      'mata_pelajaran' => 'Bahasa Indonesia',    'order' => 2],
            ['nama' => 'Budi Santoso, S.Pd.',          'jenis' => 'guru',  'jabatan' => 'Wali Kelas 7B',      'mata_pelajaran' => 'IPA',                 'order' => 3],
            ['nama' => 'Dewi Rahayu, S.Pd.',           'jenis' => 'guru',  'jabatan' => 'Wali Kelas 8A',      'mata_pelajaran' => 'IPS',                 'order' => 4],
            ['nama' => 'Hendra Wijaya, S.Pd.',         'jenis' => 'guru',  'jabatan' => 'Wali Kelas 8B',      'mata_pelajaran' => 'Bahasa Inggris',      'order' => 5],
            ['nama' => 'Rini Kusumawati, S.Pd.',       'jenis' => 'guru',  'jabatan' => 'Wali Kelas 9A',      'mata_pelajaran' => 'PKn',                 'order' => 6],
            ['nama' => 'Agus Priyanto, S.Pd.',         'jenis' => 'guru',  'jabatan' => 'Wali Kelas 9B',      'mata_pelajaran' => 'Pendidikan Agama',    'order' => 7],
            ['nama' => 'Lia Ambarwati, S.Pd.',         'jenis' => 'guru',  'jabatan' => 'Guru Mapel',         'mata_pelajaran' => 'Seni Budaya',         'order' => 8],
            ['nama' => 'Teguh Prasetyo, S.Pd.',        'jenis' => 'guru',  'jabatan' => 'Guru Mapel',         'mata_pelajaran' => 'PJOK',                'order' => 9],
            ['nama' => 'Nurul Hidayah, S.Kom.',        'jenis' => 'guru',  'jabatan' => 'Guru Mapel',         'mata_pelajaran' => 'Informatika',         'order' => 10],
            ['nama' => 'Wahyu Setiawan, S.Pd.',        'jenis' => 'guru',  'jabatan' => 'Guru Mapel',         'mata_pelajaran' => 'Prakarya',            'order' => 11],

            // Staff
            ['nama' => 'Suparman',              'jenis' => 'staff', 'jabatan' => 'Kepala Tata Usaha', 'mata_pelajaran' => null, 'order' => 12],
            ['nama' => 'Endang Sulistyowati',   'jenis' => 'staff', 'jabatan' => 'Staff TU',          'mata_pelajaran' => null, 'order' => 13],
            ['nama' => 'Bambang Riyanto',       'jenis' => 'staff', 'jabatan' => 'Operator Sekolah',  'mata_pelajaran' => null, 'order' => 14],
            ['nama' => 'Sri Wahyuni',           'jenis' => 'staff', 'jabatan' => 'Pustakawan',        'mata_pelajaran' => null, 'order' => 15],
        ];

        foreach ($teachers as $teacher) {
            Teacher::create(array_merge($teacher, [
                'is_active' => true,
                'foto'      => null,
            ]));
        }
    }
}