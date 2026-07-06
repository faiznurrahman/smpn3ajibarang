# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Website Profil dan Sistem Informasi Perpustakaan SMP Negeri 3 Ajibarang — Laravel 13 + Filament v5 + Livewire v3 + Tailwind CSS v4.

- **Frontend publik**: blade views di `resources/views/pages/` untuk halaman sekolah (beranda, tentang, informasi, galeri, kontak)
- **Kiosk perpustakaan**: halaman publik di `/perpustakaan` untuk absensi pengunjung + katalog buku
- **Panel admin**: Filament v5 di `/admin`, dikustomisasi penuh (login, dashboard, tema, semua resource dengan label dan URL bahasa Indonesia)
- **Sistem perpustakaan**: modul di dalam panel admin untuk pengelolaan buku, anggota, peminjaman, pengembalian, denda, buku paket, sanksi, kunjungan, dan laporan

## Informasi Proyek

- **Judul**: Website Profil dan Sistem Informasi Perpustakaan pada SMP Negeri 3 Ajibarang
- **Mahasiswa**: Faiz Nur Rahman (NIM: 2303040107)
- **Dosen pembimbing**: Achmad Fauzan, S.Kom., M.Cs.
- **Program studi**: Teknik Informatika, Universitas Muhammadiyah Purwokerto
- **Instansi mitra**: SMP Negeri 3 Ajibarang
- **Kepala sekolah**: Suhriyanto, S.Pd., M.Pd. (NIP. 196812211995121003)
- **Alamat**: Jl. Raya Ajibarang Timur No. 53 Ajibarang

## Ruang Lingkup Sistem

### Hak Akses Pengguna

| Role | Akses |
|---|---|
| Admin | Kelola seluruh konten website profil sekolah + manajemen pengguna |
| Petugas Perpustakaan | Kelola data buku, anggota, peminjaman, pengembalian, denda, sanksi, buku paket, kunjungan, cetak laporan |
| Kepala Sekolah | Lihat dashboard perpustakaan + laporan + statistik website (semua read only) |
| Masyarakat Umum | Akses frontend publik + kiosk perpustakaan tanpa login |

### Fitur Website Profil Sekolah (Frontend Publik)

Halaman yang tersedia:
- Beranda — informasi umum sekolah
- Tentang Kami — sejarah, visi misi, struktur organisasi, guru, ekstrakurikuler
- Informasi — berita & pengumuman (list + detail)
- Galeri — dokumentasi foto kegiatan
- Kontak — form pesan dan informasi kontak

### Fitur Kiosk Perpustakaan (Publik, tanpa login)

Route prefix `/perpustakaan`, controller `LibraryKioskController`:
- `/perpustakaan` — landing page kiosk
- `/perpustakaan/hadir` — form absensi pengunjung (simpan ke tabel `visits`)
- `/perpustakaan/katalog` — katalog buku (search judul/penulis/penerbit/kode, filter kategori)
- `/perpustakaan/anggota/cari` — JSON API pencarian anggota (untuk form absensi)

### Fitur Sistem Informasi Perpustakaan (Admin Panel)

