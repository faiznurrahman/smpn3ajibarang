<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // Sistem & Pengguna
            UserRoleSeeder::class,

            // Konten Website Profil Sekolah
            SettingSeeder::class,
            ProfileSeeder::class,
            ContactInfoSeeder::class,
            SocialMediaSeeder::class,
            VideoProfileSeeder::class,
            ExtracurricularSeeder::class,
            OrganizationalStructureSeeder::class,
            PrincipalGreetingSeeder::class,

            // Guru & Staf (auto-creates Member records untuk guru)
            TeacherSeeder::class,

            // Konten Berita, Galeri, Pesan
            PostSeeder::class,
            GallerySeeder::class,
            MessageSeeder::class,

            // Perpustakaan: data master
            BookSeeder::class,
            BookItemSeeder::class,
            MemberSeeder::class,
            TextbookSeeder::class,

            // Perpustakaan: transaksi
            LoanSeeder::class,
            // TextbookLoanSeeder::class, -- dihapus: sistem distribusi buku paket dibangun ulang

            // Kunjungan
            VisitSeeder::class,
        ]);
    }
}

