<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(['id' => 1], [
            'nama_sekolah'         => 'SMP Negeri 3 Ajibarang',
            'tagline'              => 'Berkarakter, Berprestasi, dan Berwawasan Lingkungan',
            'logo'                 => null,
            'judul_hero'           => 'Selamat Datang di SMP Negeri 3 Ajibarang',
            'deskripsi_hero'       => 'Sekolah unggulan berwawasan lingkungan yang mencetak generasi berkarakter, berprestasi, dan berakhlak mulia di Kabupaten Banyumas.',
            'background_hero'      => null,
            'jumlah_siswa'         => 360,
            'jumlah_guru_karyawan' => 30,
            'jumlah_prestasi'      => 120,
            'tahun_berdiri'        => 1985,
        ]);
    }
}
