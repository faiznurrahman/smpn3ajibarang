# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Website Profil dan Sistem Informasi Perpustakaan SMP Negeri 3 Ajibarang — Laravel 13 + Filament v5 + Livewire v3 + Tailwind CSS v4.

- **Frontend publik**: blade views di `resources/views/pages/` untuk halaman sekolah (beranda, tentang, informasi, galeri, kontak)
- **Panel admin**: Filament v5 di `/admin`, dikustomisasi penuh (login, dashboard, tema, semua resource dengan label Indonesia)
- **Sistem perpustakaan**: modul di dalam panel admin untuk pengelolaan buku, anggota, peminjaman, pengembalian, denda, dan laporan

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
| Admin | Kelola seluruh konten website profil sekolah |
| Petugas Perpustakaan | Kelola data buku, anggota, peminjaman, pengembalian, denda, cetak laporan |
| Kepala Sekolah | Lihat laporan perpustakaan saja (read only) |
| Masyarakat Umum | Akses frontend publik tanpa login |

### Fitur Website Profil Sekolah (Frontend Publik)

Halaman yang tersedia:
- Beranda — informasi umum sekolah
- Tentang Kami — sejarah, visi misi, fasilitas sekolah
- Guru & Staf — data guru dan tenaga pendidik
- Prestasi — prestasi sekolah
- Galeri — dokumentasi foto kegiatan
- Berita & Pengumuman — informasi terbaru sekolah
- Kontak — form pesan dan informasi kontak

### Fitur Sistem Informasi Perpustakaan

- Manajemen data buku (tambah, edit, hapus, cari berdasarkan kategori)
- Manajemen data anggota perpustakaan (siswa dan guru)
- Transaksi peminjaman buku (catat tanggal pinjam dan batas kembali)
- Transaksi pengembalian buku (catat tanggal pengembalian aktual)
- Pengelolaan denda keterlambatan (hitung otomatis berdasarkan ketentuan)
- Laporan perpustakaan (data buku, anggota, transaksi — dapat dicetak)

### Batasan Sistem

- Siswa tidak bisa mencari buku atau mendaftar anggota secara mandiri
- Semua transaksi dilakukan melalui petugas perpustakaan
- Sistem tidak mencakup pengadaan atau pembelian buku baru
- Sistem hanya bisa diakses saat perangkat terhubung internet
- Pembagian hak akses dibatasi sesuai peran — setiap pengguna hanya akses fitur sesuai kewenangannya

## Commands

```bash
# Development (runs server + queue + logs + vite concurrently)
composer dev

# Setup awal
composer setup

# Build assets (wajib setelah ubah theme.css)
npm run build
npm run dev

# Jalankan test
composer test
php artisan test --filter=NamaTest

# Code style (Laravel Pint)
./vendor/bin/pint

# Cache management (wajib setelah ubah view/config)
php artisan view:clear
php artisan config:clear
php artisan cache:clear
```

## Architecture

### Admin Panel (Filament v5)

Panel dikonfigurasi di `app/Providers/Filament/AdminPanelProvider.php`:
- Primary color: `Color::Blue` (navy `#1e3a8a`)
- Dark mode: **dinonaktifkan** (`->darkMode(false)`) — panel selalu light mode
- Custom login: `App\Filament\Admin\Pages\Auth\Login`
- Custom dashboard: `App\Filament\Admin\Pages\Dashboard`
- Widgets: dikosongkan (`->widgets([])`) — dashboard sepenuhnya custom
- Resources: auto-discovered dari `app/Filament/Resources/`

**File kustomisasi utama:**

| File | Keterangan |
|---|---|
| `app/Filament/Admin/Pages/Auth/Login.php` | Custom login page, override `$layout` |
| `resources/views/filament/admin/auth/login-layout.blade.php` | Layout login: centered card di atas background `#f6f7f9`, logo mark S3 + nama sekolah, form Filament di `{{ $slot }}` |
| `app/Filament/Admin/Pages/Dashboard.php` | Custom dashboard, override `$view`, load stats + messages + posts + activities di `mount()` |
| `resources/views/filament/admin/pages/dashboard.blade.php` | Dashboard view: stats 4 cards, 2-col (pesan + aktivitas), 3-col (berita + agenda + aksi cepat) |
| `resources/css/filament/admin/theme.css` | Tema Filament: sidebar, topbar, tabel, form inputs, tombol — semua mengikuti design `Guru.html` |
| `resources/views/filament/admin/components/brand.blade.php` | Logo sidebar kustom: query `Setting::value('logo')`, fallback "S3" mark navy; dipasang via `PanelsRenderHook::SIDEBAR_LOGO_BEFORE` |
| `resources/views/filament/admin/components/notification-bell.blade.php` | Bell icon di topbar: red dot jika ada pesan/draft/agenda; dropdown Alpine.js 3 seksi; dipasang via `PanelsRenderHook::GLOBAL_SEARCH_BEFORE` |

**Cara override di Filament v5:**
- Login: override `protected static string $layout` (bukan `$view`) → layout menerima `$slot` berisi rendered form
- Page biasa: override `protected string $view` → view menerima data dari `$this`
- Livewire mensyaratkan **tepat 1 root HTML element** — selalu bungkus view dengan `<div>` terluar
- `navigationGroup` harus bertipe `string|\UnitEnum|null` (bukan `?string`) karena PHP strict property inheritance

**Catatan penting Filament v5:**
- Namespace login: `Filament\Auth\Pages\Login` (bukan `Filament\Pages\Auth\Login`)
- Tidak ada `filament()->getHeadTags()` — gunakan `<x-filament-panels::layout.base :livewire="$livewire">` sebagai wrapper di custom layouts
- Form sections: `Filament\Schemas\Components\Section` (bukan `Filament\Forms\Components\Section`)
- Grid 2-col di form: `Filament\Schemas\Components\Grid::make(2)`

### Design System (Admin)

Referensi desain ada di folder `design/` (Login.html, Dasbor Admin.html, Guru.html).

- Warna primary: Navy `#1e3a8a`, accent: Orange `#ef7c2a`
- Background halaman: `#f3f5fa` (dashboard) / `#f6f7f9` (login)
- Panel/card: `white`, border `#e5e7eb`, radius `12px`, shadow ringan
- Input: radius `7px`, focus ring `rgba(30,58,138,0.1)`
- Font: Plus Jakarta Sans (via Google Fonts di design) — Filament pakai system font secara default
- Custom CSS di dashboard/login menggunakan CSS vars di-scope ke `.db` / `.lc` — jangan pakai Tailwind class di dalam view custom Filament

**Kelas CSS Filament v5 yang penting (untuk override di theme.css):**
- Sidebar: `.fi-sidebar-item-button`, `.fi-sidebar-group-label`, `.fi-sidebar-item-badge`
- Tabel: `.fi-ta-main`, `.fi-ta-content-ctn` (container overflow), `.fi-ta-table`, `.fi-ta-header-cell`, `.fi-ta-cell`, `.fi-ta-row`, `.fi-ta-text-description` (teks deskripsi bawah nilai), `.fi-ta-image` (gambar avatar)
- Form section: `.fi-sc-section`, `.fi-sc-section-label`, `.fi-section-content`
- Input wrapper: `.fi-input-wrp`, `.fi-input`, `.fi-select-input`
- Field label: `.fi-fo-field-label-content`
- Tombol: `.fi-btn`, `.fi-btn-color-primary`, `.fi-btn-color-gray`, `.fi-btn-color-danger`
- Pagination: `.fi-pagination`, `.fi-pagination-btn`

**Catatan tabel:**
- Filament default `overflow-x: auto` pada `.fi-ta-content-ctn` — di-override jadi `hidden` untuk cegah scroll horizontal
- Jangan pakai `max-width: 0` pada sel tabel — menyebabkan cell tampak aneh; biarkan `table-layout: auto` yang mengatur lebar kolom
- Schema Settings (dan halaman single-record lain) wajib pakai `->columns(1)` agar section tidak disusun 2-kolom oleh Filament

### Navigation Groups & Labels

**Website Profil Sekolah — sudah selesai (12 resource):**

| Group | Resource | Label |
|---|---|---|
| *(dashboard)* | Dashboard | Dasbor |
| Konten Sekolah | Posts | Berita & Pengumuman |
| Konten Sekolah | Galleries | Galeri |
| Konten Sekolah | VideoProfiles | Video Profil |
| Konten Sekolah | Extracurriculars | Ekstrakurikuler |
| Konten Sekolah | PrincipalGreetings | Sambutan Kepala Sekolah |
| Profil & Organisasi | Profiles | Profil Sekolah |
| Profil & Organisasi | Teachers | Guru & Tenaga Pendidik |
| Profil & Organisasi | OrganizationalStructures | Struktur Organisasi |
| Komunikasi | Messages | Pesan Masuk |
| Komunikasi | ContactInfos | Informasi Kontak |
| Komunikasi | SocialMedia | Media Sosial |
| Sistem | Settings | Pengaturan |

Resource yang non-creatable/non-deletable: `ContactInfos`, `Messages`, `Settings` (lewat `canCreate()`/`canDelete()` override).

**Sistem Informasi Perpustakaan — belum dibuat:**

| Group | Resource | Label |
|---|---|---|
| Perpustakaan | Books | Data Buku |
| Perpustakaan | Members | Data Anggota |
| Perpustakaan | Loans | Peminjaman Buku |
| Perpustakaan | Returns | Pengembalian Buku |
| Perpustakaan | Fines | Denda Keterlambatan |
| Perpustakaan | LibraryReports | Laporan Perpustakaan |

### Resource Structure Pattern
app/Filament/Resources/NamaResource/
├── NamaResource.php      # navigationLabel, navigationGroup, navigationIcon, navigationSort
├── Pages/                # List, Create, Edit (+ View untuk Messages)
├── Schemas/              # Form schema — gunakan Section + Grid untuk layout 2-col
└── Tables/               # Table columns + filters

Form schema convention (mengikuti Guru.html):
- Gunakan `Section::make('Judul')` untuk mengelompokkan field
- Grid 2-col: `Grid::make(2)->schema([...])`
- Toggle aktif/nonaktif selalu di section "Pengaturan" paling bawah

### Dashboard Data (Dashboard.php)

`mount()` memuat:
- `$totalBerita` — Post published count
- `$pesanBelumDibaca` — Message unread count
- `$totalGuru` — Teacher active count
- `$siswaAktif` — dari `settings.jumlah_siswa`
- `$totalPesan` — Message total count
- `$recentMessages` — 5 unread messages terbaru
- `$recentPosts` — 4 published posts terbaru
- `$recentActivities` — feed dari updated_at Post + Teacher + Gallery, disort descending

### Dashboard Perpustakaan (tambahan)

Setelah modul perpustakaan selesai, tambahkan ke `mount()`:
- `$totalBuku` — Books count
- `$totalAnggota` — Members active count
- `$peminjamAktif` — Loans belum dikembalikan
- `$dendaBelumLunas` — Fines unpaid count

### Public Website

`PageController` = satu controller untuk semua halaman publik. Inject `getSharedData()` (settings, contactInfo, socialMedia) + data spesifik. Halaman "Tentang" juga inject `getAboutSidebar()`.

Tabel konten publik: `posts`, `teachers`, `galleries` + `gallery_images`, `extracurriculars`, `organizational_structures`, `principal_greetings`, `video_profiles`, `profiles`. Pesan dari form kontak → `messages`.

### Skema Database Perpustakaan

Tabel yang perlu dibuat untuk modul perpustakaan:
books           — id, kode_buku, judul, pengarang, penerbit, tahun, kategori, stok, cover, is_active
members         — id, kode_anggota, nama, kelas, jenis (siswa/guru), no_hp, is_active
loans           — id, book_id, member_id, tgl_pinjam, tgl_batas_kembali, tgl_kembali, status, petugas_id
fines           — id, loan_id, jumlah_hari, nominal, status_bayar, tgl_bayar

### Asset Pipeline

Vite + `@tailwindcss/vite`. Tiga entry point:
1. `resources/css/app.css` — frontend publik
2. `resources/js/app.js` — frontend publik
3. `resources/css/filament/admin/theme.css` — tema Filament (registered via `->viteTheme()`)

Setelah edit `theme.css` wajib jalankan `npm run build` / `npm run dev`.

## Remaining Work

- [ ] Frontend publik (halaman beranda, tentang, dll.) belum disentuh — masih menggunakan template lama
- [ ] Agenda mendatang di dashboard masih **hardcoded/static** — perlu tabel `agendas` di DB
- [ ] Topbar Filament (breadcrumb) belum disesuaikan desain
- [ ] Modul perpustakaan belum dibuat (Books, Members, Loans, Returns, Fines, LibraryReports)
- [ ] Hak akses role-based (Admin, Petugas Perpustakaan, Kepala Sekolah) belum diimplementasi

## Sudah Selesai

- [x] Semua form schema resource pakai `Section` + `Grid` (Posts, Galleries, Extracurriculars, Settings, OrganizationalStructures, PrincipalGreetings, SocialMedia, VideoProfiles, ContactInfos, Profiles, Messages/Infolist)
- [x] Semua tabel list disesuaikan desain Guru.html (padding, font, warna, badge, avatar circular, deskripsi sekunder)
- [x] Sidebar brand logo + notification bell (render hooks)
- [x] Global search dinonaktifkan (`->globalSearch(false)`)
- [x] 12 resource website profil sekolah selesai