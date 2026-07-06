<?php

namespace Database\Seeders;

use App\Models\PrincipalGreeting;
use Illuminate\Database\Seeder;

class PrincipalGreetingSeeder extends Seeder
{
    public function run(): void
    {
        PrincipalGreeting::updateOrCreate(['id' => 1], [
            'nama_kepala_sekolah' => 'Suhriyanto, S.Pd., M.Pd.',
            'foto'                => null,
            'deskripsi'           => '<p>Assalamu\'alaikum Warahmatullahi Wabarakatuh.</p><p>Puji syukur kehadirat Allah SWT atas segala limpahan rahmat dan karunia-Nya sehingga SMP Negeri 3 Ajibarang terus dapat memberikan pelayanan pendidikan terbaik bagi peserta didik dan masyarakat.</p><p>Sebagai kepala sekolah, saya menyambut baik kehadiran website profil SMP Negeri 3 Ajibarang ini sebagai media informasi dan komunikasi antara sekolah dengan masyarakat luas. Melalui website ini, kami berharap dapat menyampaikan berbagai informasi tentang kegiatan, prestasi, dan program-program unggulan sekolah kami.</p><p>SMP Negeri 3 Ajibarang berkomitmen untuk terus meningkatkan mutu pendidikan dengan menghadirkan pembelajaran yang inovatif, menyenangkan, dan bermakna bagi seluruh peserta didik. Kami juga senantiasa mendorong pengembangan karakter dan potensi setiap siswa agar menjadi generasi yang unggul, beriman, dan berdaya saing.</p><p>Kami mengundang seluruh orang tua, masyarakat, dan pemangku kepentingan untuk bersama-sama memajukan dunia pendidikan demi masa depan bangsa yang lebih cerah.</p><p>Wassalamu\'alaikum Warahmatullahi Wabarakatuh.</p>',
        ]);
    }
}
