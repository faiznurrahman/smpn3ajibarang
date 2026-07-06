<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::updateOrCreate(['id' => 1], [
            'sejarah'          => '<p>SMP Negeri 3 Ajibarang berdiri pada tahun 1985 berdasarkan Surat Keputusan Menteri Pendidikan dan Kebudayaan. Sekolah yang berlokasi di Jl. Raya Ajibarang Timur No. 53 Ajibarang, Kabupaten Banyumas ini dibangun untuk memenuhi kebutuhan pendidikan tingkat menengah pertama bagi masyarakat Kecamatan Ajibarang dan sekitarnya.</p><p>Sejak berdiri, SMP Negeri 3 Ajibarang terus berkembang dan meningkatkan kualitas pendidikannya. Berbagai prestasi telah diraih baik di tingkat kabupaten, provinsi, maupun nasional, khususnya di bidang lingkungan hidup, olahraga, dan seni budaya.</p><p>Pada tahun 2018, sekolah ini berhasil meraih penghargaan Sekolah Adiwiyata Mandiri dari Kementerian Lingkungan Hidup dan Kehutanan sebagai bukti komitmen seluruh warga sekolah dalam menjaga kelestarian lingkungan hidup.</p>',
            'foto_sejarah'     => null,
            'foto_sejarah_alt' => 'Gedung SMP Negeri 3 Ajibarang',
            'visi'             => 'Terwujudnya Peserta Didik yang Beriman, Bertaqwa, Berakhlak Mulia, Berprestasi, Berbudaya, dan Berwawasan Lingkungan.',
            'misi'             => '<ul><li>Menumbuhkan penghayatan dan pengamalan ajaran agama serta budi pekerti luhur.</li><li>Melaksanakan pembelajaran yang aktif, inovatif, kreatif, efektif, dan menyenangkan.</li><li>Mengembangkan potensi peserta didik secara optimal melalui kegiatan intra dan ekstrakurikuler.</li><li>Membangun budaya sekolah yang kondusif, bersih, indah, dan rindang.</li><li>Menjalin kerja sama yang harmonis antara sekolah, orang tua, dan masyarakat.</li><li>Mewujudkan sekolah berwawasan lingkungan yang berkelanjutan.</li></ul>',
        ]);
    }
}
