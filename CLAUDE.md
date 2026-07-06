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

**Koleksi Buku:**
- Katalog buku (`/admin/katalog`): CRUD buku; field: kode_buku, isbn, judul, penulis, penerbit, tahun, kategori, rak, stok, cover, deskripsi
- Daftar eksemplar (`/admin/eksemplar`): tiap buku bisa punya banyak eksemplar fisik (BookItem) dengan kode unik `{kode_buku}-001` dst.
- Import koleksi massal (`/admin/import-koleksi`): upload Excel, kode_buku yang sudah ada dilewati

**Keanggotaan:**
- Daftar anggota (`/admin/anggota`): siswa + guru; field: kode_anggota, nama, jenis, kelas, tahun_masuk, status
- Kelola anggota (`/admin/kelola-anggota`): import siswa massal + update kelas massal via Excel dalam satu halaman

**Sirkulasi (Livewire custom pages):**
- Peminjaman (`/admin/peminjaman`): list transaksi aktif/terlambat dengan tab + search + pagination; tombol "Catat Peminjaman" → stepper
- Catat Peminjaman (`/admin/catat-peminjaman`): stepper 3-langkah (cari anggota → pilih buku/eksemplar → konfirmasi); `shouldRegisterNavigation=false`
- Perpanjangan (`/admin/perpanjangan`): scan/input kode pinjam → pilih durasi perpanjangan → update batas kembali
- Pengembalian (`/admin/pengembalian`): list peminjaman perlu kembali / sudah selesai dengan tab + search; tombol "Proses" → halaman proses
- Proses Pengembalian (`/admin/proses-pengembalian`): scan kode pinjam → pilih kondisi → auto-hitung denda Rp 1.000/hari + catat sanksi → cetak struk; `shouldRegisterNavigation=false`
- Pelanggaran (`/admin/pelanggaran`): tab Denda (filter belum_lunas/lunas, tandai bayar) + tab Sanksi (filter belum_lunas/lunas, tandai lunas)

**Buku Paket:**
- Katalog buku paket (`/admin/buku-paket`): CRUD; auto-generate eksemplar `TextbookItem` dengan kode `{prefix}-001` dst.
- Distribusi buku paket (`/admin/distribusi-buku-paket`): list semua distribusi; tombol "Buat Distribusi" → wizard
- Buat Distribusi (`/admin/distribusi-baru`): wizard pilih tahun ajaran + tingkat + buku paket → auto-assign ke siswa aktif; `shouldRegisterNavigation=false`
- Pengembalian buku paket (`/admin/pengembalian-buku-paket`): pilih distribusi + kelas → proses kembali per siswa + catat kondisi/sanksi
- Sanksi buku paket (`/admin/sanksi-buku-paket`): read-only; daftar item dengan status_sanksi = belum_lunas; action tandai lunas

**Kunjungan & Laporan:**
- Kunjungan (`/admin/kunjungan`): data dari kiosk `/perpustakaan/hadir`; filter tanggal; read-only
- Laporan perpustakaan (`/admin/laporan-perpustakaan`): rekap statistik dengan 4 widget (peminjaman, denda, sanksi, kunjungan); cetak PDF + Excel

### Batasan Sistem

- Siswa tidak bisa mencari buku atau mendaftar anggota secara mandiri (kecuali melalui kiosk absensi)
- Semua transaksi peminjaman dilakukan melalui petugas perpustakaan
- Sistem tidak mencakup pengadaan atau pembelian buku baru
- Sistem hanya bisa diakses saat perangkat terhubung internet
- Pembagian hak akses dibatasi sesuai peran

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

# Cache management (wajib setelah ubah view/config/route)
php artisan view:clear
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# Seed database lengkap (hapus semua data lama)
php artisan migrate:fresh --seed

# Seed ulang user roles saja
php artisan db:seed --class=UserRoleSeeder
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
| `app/Filament/Admin/Pages/Dashboard.php` | Dashboard router berdasarkan role: Admin → `dashboard.blade.php`, Petugas/Kepala → `library-dashboard.blade.php` |
| `resources/views/filament/admin/pages/dashboard.blade.php` | Dashboard Admin: stats 4 cards, 2-col (pesan + aktivitas), 3-col (berita + agenda + aksi cepat) |
| `resources/views/filament/admin/pages/library-dashboard.blade.php` | Dashboard Perpustakaan: stats cards (buku/anggota/dipinjam/denda/buku paket/kunjungan), peminjaman aktif + denda belum lunas |
| `app/Filament/Admin/Pages/StatistikWebsite.php` | Halaman statistik website untuk KepalaSekolah (read-only: berita, guru, galeri, ekskul, video, pesan) |
| `resources/css/filament/admin/theme.css` | Tema Filament: sidebar, topbar, tabel, form inputs, tombol, layout viewport-locked |
| `resources/views/filament/admin/components/brand.blade.php` | Logo sidebar kustom: query `Setting::value('logo')`, fallback "S3" mark navy; dipasang via `PanelsRenderHook::SIDEBAR_LOGO_BEFORE` |
| `resources/views/filament/admin/components/notification-bell.blade.php` | Bell icon di topbar: red dot jika ada pesan/draft/agenda; dropdown Alpine.js 3 seksi; dipasang via `PanelsRenderHook::GLOBAL_SEARCH_BEFORE` |
| `resources/views/filament/admin/pages/library-reports.blade.php` | Halaman laporan perpustakaan untuk Petugas (rekap + PDF + Excel) |
| `resources/views/filament/admin/pages/library-reports-kepsek.blade.php` | Halaman laporan perpustakaan untuk KepalaSekolah (read-only view) |

**Cara override di Filament v5:**
- Login: override `protected static string $layout` (bukan `$view`) → layout menerima `$slot` berisi rendered form
- Page biasa: override `protected string $view` → view menerima data dari `$this`
- Dashboard multi-role: override `getView()` untuk return view berbeda per role
- Livewire mensyaratkan **tepat 1 root HTML element** — selalu bungkus view dengan `<div>` terluar
- `navigationGroup` harus bertipe `string|\UnitEnum|null` (bukan `?string`) karena PHP strict property inheritance

**Catatan penting Filament v5:**
- Namespace login: `Filament\Auth\Pages\Login` (bukan `Filament\Pages\Auth\Login`)
- Tidak ada `filament()->getHeadTags()` — gunakan `<x-filament-panels::layout.base :livewire="$livewire">` sebagai wrapper di custom layouts
- Form sections: `Filament\Schemas\Components\Section` (bukan `Filament\Forms\Components\Section`)
- Grid 2-col di form: `Filament\Schemas\Components\Grid::make(2)`
- URL slug resource ditentukan via `protected static ?string $slug` — semua resource sudah menggunakan slug bahasa Indonesia

### Layout Admin (Viewport-Locked)

Layout desktop admin menggunakan pendekatan "viewport-locked" di `resources/css/filament/admin/theme.css`:

```
html/body/fi-layout  →  height:100dvh; overflow:hidden  (kontainer tidak scroll)
├── .fi-sidebar      →  height:100dvh; flex-column; overflow:hidden
│   ├── .fi-sidebar-header  →  flex-shrink:0  (logo, tidak scroll)
│   ├── .fi-sidebar-nav     →  flex:1; overflow-y:auto  (menu, scroll mandiri)
│   └── .fi-sidebar-footer  →  flex-shrink:0  (user menu, tidak scroll)
└── .fi-main-ctn     →  flex:1; height:100dvh; flex-column
    ├── .fi-topbar-ctn      →  flex-shrink:0  (topbar, selalu terlihat)
    └── .fi-main            →  flex:1; overflow-y:auto  (konten, scroll mandiri)
```

- Sidebar dan topbar **tidak ikut scroll** bersama konten utama
- `.fi-main-ctn` tidak pakai `overflow:hidden` agar dropdown topbar tidak terpotong
- `.fi-topbar-ctn` pakai `position:relative` (bukan `sticky`) karena sudah di flex layout
- `padding-bottom:64px` pada `.fi-sidebar-nav` dan `.fi-main` (min-width:768px) agar konten terbawah tidak tertutup taskbar Windows 11 (taskbar 48px + 16px buffer)
- Hanya berlaku desktop (≥1024px); mobile punya section terpisah `@media (max-width:1023px)`

### Role-Based Access Control

Enum: `App\Enums\UserRole` — nilai: `admin`, `petugas_perpustakaan`, `kepala_sekolah`

Setiap resource override `canAccess(): bool`. Pola:
- Resource website profil sekolah (12 resource) + Users: `return auth()->user()?->role === UserRole::Admin;`
- Resource/Page perpustakaan (Books, BookItems, Members, Visits, Fines, Textbooks, TextbookSanksis, DistribusiBukuPakets + semua halaman Sirkulasi/Koleksi/Keanggotaan/BukuPaket): `return auth()->user()?->role === UserRole::PetugasPerpustakaan;`
- LibraryReportResource: `return in_array($role, [UserRole::PetugasPerpustakaan, UserRole::KepalaSekolah]);`
- StatistikWebsite page: `return auth()->user()?->role === UserRole::KepalaSekolah;`

Dashboard routing di `Dashboard::getView()`:
- `UserRole::Admin` → `filament.admin.pages.dashboard`
- `UserRole::PetugasPerpustakaan` / `UserRole::KepalaSekolah` → `filament.admin.pages.library-dashboard`

**User accounts (dev/testing) — semua password: `password`:**

| Email | Role | Akses |
|---|---|---|
| `admin@smpn3ajibarang.sch.id` | Admin | Konten sekolah, pengaturan, manajemen pengguna |
| `petugas@smpn3ajibarang.sch.id` | Petugas Perpustakaan | CRUD buku, anggota, peminjaman, pengembalian, denda, sanksi, buku paket, kunjungan |
| `kepala@smpn3ajibarang.sch.id` | Kepala Sekolah | Dashboard perpustakaan + laporan + statistik website (read only) |

**Catatan password seeder:** Jangan pakai `Hash::make()` di seeder jika User model sudah punya cast `'password' => 'hashed'` — akan double-hash dan login gagal. Cukup tulis string plain: `'password' => 'password'`.

### Design System (Admin)

Referensi desain ada di folder `design/` (Login.html, Dasbor Admin.html, Guru.html).

- Warna primary: Navy `#1e3a8a`, accent: Orange `#ef7c2a`
- Background halaman: `#f3f5fa` (dashboard) / `#f6f7f9` (login)
- Panel/card: `white`, border `#e5e7eb`, radius `12px`, shadow ringan
- Input: radius `7px`, focus ring `rgba(30,58,138,0.1)`
- Font: Plus Jakarta Sans (via Google Fonts di design) — Filament pakai system font secara default
- Custom CSS di dashboard/login menggunakan CSS vars di-scope ke `.db` / `.lc` / `.ldb` — jangan pakai Tailwind class di dalam view custom Filament

**Kelas CSS Filament v5 yang penting (untuk override di theme.css):**
- Sidebar: `.fi-sidebar-item-button`, `.fi-sidebar-group-label`, `.fi-sidebar-item-badge`
- Tabel: `.fi-ta-main`, `.fi-ta-content-ctn` (container overflow), `.fi-ta-table`, `.fi-ta-header-cell`, `.fi-ta-cell`, `.fi-ta-row`, `.fi-ta-text-description` (teks deskripsi bawah nilai), `.fi-ta-image` (gambar avatar)
- Form section: `.fi-sc-section`, `.fi-sc-section-label`, `.fi-section-content`
- Input wrapper: `.fi-input-wrp`, `.fi-input`, `.fi-select-input`
- Field label: `.fi-fo-field-label-content`
- Tombol: `.fi-btn`, `.fi-btn-color-primary`, `.fi-btn-color-gray`, `.fi-btn-color-danger`
- Pagination: `.fi-pagination`, `.fi-pagination-btn`
- Layout: `.fi-layout`, `.fi-sidebar`, `.fi-sidebar-header`, `.fi-sidebar-nav`, `.fi-sidebar-footer`, `.fi-main-ctn`, `.fi-topbar-ctn`, `.fi-main`

**Catatan tabel:**
- Filament default `overflow-x: auto` pada `.fi-ta-content-ctn` — di-override jadi `hidden` untuk cegah scroll horizontal
- Jangan pakai `max-width: 0` pada sel tabel — menyebabkan cell tampak aneh; biarkan `table-layout: auto` yang mengatur lebar kolom
- Schema Settings (dan halaman single-record lain) wajib pakai `->columns(1)` agar section tidak disusun 2-kolom oleh Filament

### URL Slug Bahasa Indonesia

Semua resource menggunakan `protected static ?string $slug` di file `*Resource.php`. Route name Filament mengikuti slug, format: `filament.admin.resources.{slug}.{action}`.

**Resources** (slug via `protected static ?string $slug`; route name: `filament.admin.resources.{slug}.{action}`):

| Resource Class | URL Slug | Contoh URL | Nav |
|---|---|---|---|
| `PostResource` | `berita` | `/admin/berita` | ✓ |
| `GalleryResource` | `galeri` | `/admin/galeri` | ✓ |
| `VideoProfileResource` | `video-profil` | `/admin/video-profil` | ✓ |
| `ExtracurricularResource` | `ekstrakurikuler` | `/admin/ekstrakurikuler` | ✓ |
| `PrincipalGreetingResource` | `sambutan-kepala-sekolah` | `/admin/sambutan-kepala-sekolah` | ✓ |
| `ProfileResource` | `profil-sekolah` | `/admin/profil-sekolah` | ✓ |
| `TeacherResource` | `guru` | `/admin/guru` | ✓ |
| `OrganizationalStructureResource` | `struktur-organisasi` | `/admin/struktur-organisasi` | ✓ |
| `MessageResource` | `pesan` | `/admin/pesan` | ✓ |
| `ContactInfoResource` | `informasi-kontak` | `/admin/informasi-kontak` | ✓ |
| `SocialMediaResource` | `media-sosial` | `/admin/media-sosial` | ✓ |
| `SettingResource` | `pengaturan` | `/admin/pengaturan` | ✓ |
| `UserResource` | `pengguna` | `/admin/pengguna` | ✓ |
| `BookResource` | `katalog` | `/admin/katalog` | ✓ |
| `BookItemResource` | `eksemplar` | `/admin/eksemplar` | ✓ |
| `MemberResource` | `anggota` | `/admin/anggota` | ✓ |
| `VisitResource` | `kunjungan` | `/admin/kunjungan` | ✓ |
| `FineResource` | `denda` | `/admin/denda` | ✓ |
| `LibraryReportResource` | `laporan-perpustakaan` | `/admin/laporan-perpustakaan` | ✓ |
| `TextbookResource` | `buku-paket` | `/admin/buku-paket` | ✓ |
| `DistribusiBukuPaketResource` | `distribusi-buku-paket` | `/admin/distribusi-buku-paket` | ✓ |
| `TextbookSanksiResource` | `sanksi-buku-paket` | `/admin/sanksi-buku-paket` | ✓ |
| `LoanResource` | `peminjaman-data` | `/admin/peminjaman-data` | hidden |
| `ReturnResource` | `pengembalian-data` | `/admin/pengembalian-data` | hidden |
| `SanksiResource` | `sanksi-buku` | `/admin/sanksi-buku` | hidden |
| `TextbookLoanResource` | `distribusi-lama` | `/admin/distribusi-lama` | hidden |

**Halaman Livewire Kustom** (slug via `protected static ?string $slug`):

| Page Class | URL Slug | Contoh URL | Nav |
|---|---|---|---|
| `HalamanPeminjaman` | `peminjaman` | `/admin/peminjaman` | ✓ (Sirkulasi) |
| `PerpanjanganPeminjaman` | `perpanjangan` | `/admin/perpanjangan` | ✓ (Sirkulasi) |
| `HalamanPengembalian` | `pengembalian` | `/admin/pengembalian` | ✓ (Sirkulasi) |
| `Pelanggaran` | `pelanggaran` | `/admin/pelanggaran` | ✓ (Sirkulasi) |
| `KelolaAnggota` | `kelola-anggota` | `/admin/kelola-anggota` | ✓ (Keanggotaan) |
| `ImportKoleksi` | `import-koleksi` | `/admin/import-koleksi` | ✓ (Koleksi) |
| `PengembalianBukuPaket` | `pengembalian-buku-paket` | `/admin/pengembalian-buku-paket` | ✓ (Buku Paket) |
| `CatatPeminjaman` | `catat-peminjaman` | `/admin/catat-peminjaman` | hidden |
| `ProsesKembaliBuku` | `proses-pengembalian` | `/admin/proses-pengembalian` | hidden |
| `BuatDistribusiBukuPaket` | `distribusi-baru` | `/admin/distribusi-baru` | hidden |
| `StatistikWebsite` | *(auto)* | `/admin/statistik-website` | ✓ (Kepala) |

### Navigation Groups & Labels

**Website Profil Sekolah — selesai (13 resource, hanya Admin):**

| Group | Resource | Label | Slug URL |
|---|---|---|---|
| *(dashboard)* | Dashboard | Dasbor | `/admin` |
| Konten Sekolah | Posts | Berita & Pengumuman | `/admin/berita` |
| Konten Sekolah | Galleries | Galeri | `/admin/galeri` |
| Konten Sekolah | VideoProfiles | Video Profil | `/admin/video-profil` |
| Konten Sekolah | Extracurriculars | Ekstrakurikuler | `/admin/ekstrakurikuler` |
| Konten Sekolah | PrincipalGreetings | Sambutan Kepala Sekolah | `/admin/sambutan-kepala-sekolah` |
| Profil & Organisasi | Profiles | Profil Sekolah | `/admin/profil-sekolah` |
| Profil & Organisasi | Teachers | Guru & Tenaga Pendidik | `/admin/guru` |
| Profil & Organisasi | OrganizationalStructures | Struktur Organisasi | `/admin/struktur-organisasi` |
| Komunikasi | Messages | Pesan Masuk | `/admin/pesan` |
| Komunikasi | ContactInfos | Informasi Kontak | `/admin/informasi-kontak` |
| Komunikasi | SocialMedia | Media Sosial | `/admin/media-sosial` |
| Sistem | Settings | Pengaturan | `/admin/pengaturan` |
| Sistem | Users | Manajemen Pengguna | `/admin/pengguna` |

Resource yang non-creatable/non-deletable: `ContactInfos`, `Messages`, `Settings`.

**Sistem Informasi Perpustakaan — navigation groups aktif (Petugas Perpustakaan):**

| Group | Item | Tipe | Label | URL |
|---|---|---|---|---|
| Koleksi | BookResource | Resource | Daftar Katalog | `/admin/katalog` |
| Koleksi | BookItemResource | Resource | Daftar Eksemplar | `/admin/eksemplar` |
| Koleksi | ImportKoleksi | Page | Import Koleksi | `/admin/import-koleksi` |
| Keanggotaan | MemberResource | Resource | Daftar Anggota | `/admin/anggota` |
| Keanggotaan | KelolaAnggota | Page | Kelola Anggota | `/admin/kelola-anggota` |
| Keanggotaan | VisitResource | Resource | Kunjungan | `/admin/kunjungan` |
| Sirkulasi | HalamanPeminjaman | Page | Peminjaman | `/admin/peminjaman` |
| Sirkulasi | PerpanjanganPeminjaman | Page | Perpanjangan | `/admin/perpanjangan` |
| Sirkulasi | HalamanPengembalian | Page | Pengembalian | `/admin/pengembalian` |
| Sirkulasi | Pelanggaran | Page | Pelanggaran | `/admin/pelanggaran` |
| Buku Paket | TextbookResource | Resource | Katalog Buku Paket | `/admin/buku-paket` |
| Buku Paket | DistribusiBukuPaketResource | Resource | Distribusi Buku Paket | `/admin/distribusi-buku-paket` |
| Buku Paket | PengembalianBukuPaket | Page | Pengembalian Buku Paket | `/admin/pengembalian-buku-paket` |
| Buku Paket | TextbookSanksiResource | Resource | Sanksi Buku Paket | `/admin/sanksi-buku-paket` |
| *(laporan)* | LibraryReportResource | Resource | Laporan Perpustakaan | `/admin/laporan-perpustakaan` |

**Halaman tambahan KepalaSekolah:**

| Group | Page | Label | Akses |
|---|---|---|---|
| *(tanpa group)* | StatistikWebsite | Statistik Website | Kepala Sekolah |

**Catatan penting:**
- `LoanResource`, `ReturnResource`, `SanksiResource` — masih ada tapi `shouldRegisterNavigation=false`; digantikan halaman Livewire kustom
- `BookItemResource` — model `BookItem`; kode_item auto-generate `{kode_buku}-001` dst. via `BookItem::booted()`
- `DistribusiBukuPaketResource` — model `TextbookDistribution`; tombol "Buat Distribusi" → `BuatDistribusiBukuPaket` page
- `LibraryReportResource` — read-only; tampilkan 4 widget (RekapPeminjaman, RekapDenda, RekapSanksi, RekapKunjungan) + VisitStatsWidget
- `TextbookResource` — auto-generate `TextbookItem` via `generateItems()` saat create/edit
- `TextbookSanksiResource` — model `TextbookDistributionItem`, filter `status_sanksi = belum_lunas`
- Kode buku auto-generate `BK-XXXX` via `Book::booted()`
- Kode anggota siswa: NIS dari import Excel, atau `ANK-XXXX` input manual
- Kode anggota guru: `GRU-XXXX` auto-generate di `Teacher::booted()`

### Resource Structure Pattern
```
app/Filament/Resources/NamaResource/
├── NamaResource.php      # navigationLabel, navigationGroup, navigationIcon, navigationSort, slug, canAccess()
├── Pages/                # List, Create, Edit (+ View untuk Messages/TextbookLoans)
├── Schemas/              # Form schema — gunakan Section + Grid untuk layout 2-col
└── Tables/               # Table columns + filters
```

Form schema convention (mengikuti Guru.html):
- Gunakan `Section::make('Judul')` untuk mengelompokkan field
- Grid 2-col: `Grid::make(2)->schema([...])`
- Toggle aktif/nonaktif selalu di section "Pengaturan" paling bawah

### Dashboard Data (Dashboard.php)

`mount()` load data berbeda berdasarkan role:

**Admin (loadSchoolData):**
- `$totalBerita`, `$draftBerita`, `$pesanBelumDibaca`, `$totalGuru`, `$siswaAktif` (dari `settings.jumlah_siswa`)
- `$totalPesan`, `$totalGaleri`, `$totalEkskul`
- `$recentMessages` — 5 unread messages terbaru
- `$recentPosts` — 4 published posts terbaru
- `$recentActivities` — feed dari updated_at Post + Teacher + Gallery

**Petugas / Kepala (loadLibraryData):**
- `$totalBuku`, `$totalAnggota`, `$peminjamAktif`, `$dendaBelumLunas`, `$totalDenda`
- `$bukuPaketAktif` — jumlah `TextbookLoan` dengan status aktif
- `$kunjunganHariIni`, `$kunjunganMingguIni`, `$kunjunganBulanIni`
- `$recentLoans` — 6 peminjaman aktif/terlambat, diurutkan batas kembali terdekat
- `$recentFines` — 5 denda belum lunas terbaru

### Database Schema

**Tabel perpustakaan:**
```
books               — id, kode_buku, isbn, judul, penulis, penerbit, tahun, kategori, rak, stok, cover, deskripsi, is_active
book_items          — id, book_id(FK), kode_item, kondisi(baik/rusak/hilang), is_available, catatan
                      [kode_item auto-generate: {kode_buku}-001 dst. via BookItem::booted()]
members             — id, teacher_id(FK), kode_anggota, nama, jenis(siswa/guru), kelas, tahun_masuk,
                      status(aktif/alumni/keluar/lulus), no_hp, is_active
loans               — id, book_id, member_id, tgl_pinjam, tgl_batas_kembali, tgl_kembali,
                      status(dipinjam/dikembalikan/terlambat),
                      kondisi_kembali(baik/rusak/hilang), jenis_sanksi(tidak_ada/ganti_buku/bayar_harga),
                      nominal_sanksi, status_sanksi(tidak_ada/belum_lunas/lunas),
                      tgl_selesai_sanksi, catatan_sanksi, petugas_id
fines               — id, loan_id, jumlah_hari, nominal, status_bayar(belum_lunas/lunas), tgl_bayar
textbooks           — id, judul, mata_pelajaran, untuk_tingkat(7/8/9), kode_prefix, penerbit, tahun_terbit,
                      total_eksemplar, is_active
textbook_items      — id, textbook_id, kode_item, kondisi(baik/rusak/hilang), is_available
textbook_distributions — id, tahun_ajaran, untuk_tingkat, tgl_distribusi, tgl_kembali_rencana,
                         status(aktif/selesai), petugas_id
                         [model: TextbookDistribution]
textbook_distribution_items — id, distribution_id(FK), member_id, textbook_item_id, kondisi_pinjam,
                              kondisi_kembali, jenis_sanksi, status_sanksi(belum_lunas/lunas),
                              nominal_sanksi, tgl_selesai_sanksi, catatan_sanksi, tgl_kembali_aktual
                              [model: TextbookDistributionItem]
visits              — id, nama, jenis_pengunjung(siswa/guru/umum), kelas, keperluan, tgl_kunjungan, jam_kunjungan
website_visits      — id, halaman, ip_address, created_at  [model: WebsiteVisit; untuk statistik website]
users               — ... + role(admin/petugas_perpustakaan/kepala_sekolah), is_active [default role: admin]
```

**Member — computed attributes:**
- `tingkat` — dihitung otomatis dari `tahun_masuk` + tahun berjalan (kembali 7/8/9 atau null)
- `angkatan_label` — "Angkatan {tahun_masuk}"
- scope `aktif()` — filter `status = aktif`
- scope `siswa()` — filter `jenis = siswa`
- scope `tingkat($tahunAjaran, $tingkat)` — filter by `tahun_masuk` yang sesuai tingkat di tahun ajaran tertentu

**Book — computed attributes:**
- `stok_tersedia` — `stok - activeLoans().count()`
- `stok_dipinjam` — `activeLoans().count()`

**Teacher — model events (`booted()`):**
- `created` → auto-create Member record dengan `kode_anggota = GRU-XXXX`, `jenis = guru`
- `updated` → sync nama + status ke Member terkait
- `deleted` → nonaktifkan Member terkait

**Book — model events (`booted()`):**
- `creating` → auto-generate `kode_buku = BK-XXXX` (format 4 digit, increment dari max)

**BookItem — model events (`booted()`):**
- `creating` → auto-generate `kode_item = {kode_buku}-001` dst. (increment per book_id)

### Database Seeders

Semua seeder ada di `database/seeders/`, dijalankan berurutan via `DatabaseSeeder.php`. **Jangan pakai `WithoutModelEvents`** pada `DatabaseSeeder` — trait itu akan suppress semua Eloquent model events (termasuk auto-generate kode buku dan auto-create member guru).

| Seeder | Isi | Catatan |
|---|---|---|
| `UserRoleSeeder` | 3 user (admin, petugas, kepala) | Password: `password` (plain, bukan Hash::make) |
| `SettingSeeder` | 1 record setting sekolah | Nama sekolah, alamat, logo, dll. |
| `ProfileSeeder` | Profil sekolah + sejarah + visi misi | |
| `ContactInfoSeeder` | Nomor telepon, email, alamat | |
| `SocialMediaSeeder` | 4 media sosial (Instagram, Facebook, dll.) | |
| `VideoProfileSeeder` | 2 video YouTube profil sekolah | |
| `ExtracurricularSeeder` | 8 ekstrakurikuler | |
| `OrganizationalStructureSeeder` | Struktur organisasi sekolah | |
| `PrincipalGreetingSeeder` | Sambutan kepala sekolah | |
| `TeacherSeeder` | 12 guru + staf | Auto-creates 12 guru Member via `Teacher::booted()` |
| `PostSeeder` | 10 berita + 5 pengumuman | |
| `GallerySeeder` | 6 album galeri dengan foto | |
| `MessageSeeder` | 8 pesan masuk dari publik | |
| `BookSeeder` | 26 buku (berbagai kategori) | `Book::create()` trigger auto-generate kode_buku |
| `MemberSeeder` | 60 siswa (10/kelas × 6 kelas) | Hanya siswa; guru di-seed via TeacherSeeder |
| `TextbookSeeder` | 9 buku paket (3 per tingkat) | Masing-masing 22 eksemplar via `generateItems()` |
| `LoanSeeder` | 29 transaksi peminjaman | 10 aktif, 3 terlambat, 8 normal, 5 denda, 3 sanksi |
| `TextbookLoanSeeder` | 3 distribusi buku paket | Kelas 7 & 8 aktif, kelas 9 selesai |
| `VisitSeeder` | 95 kunjungan | Tersebar di 22 hari kerja dalam 30 hari terakhir |

**Catatan MemberSeeder:** Hanya buat siswa (`jenis = siswa`). Data member guru otomatis dibuat oleh `TeacherSeeder` melalui Eloquent `created` event di `Teacher::booted()`. Penghapusan awal hanya hapus `jenis = siswa` agar tidak menghapus guru.

**Tahun masuk siswa (berdasarkan tanggal 2026-06-10):**
- Kelas 9 → `tahun_masuk = 2023`
- Kelas 8 → `tahun_masuk = 2024`
- Kelas 7 → `tahun_masuk = 2025`

### Public Website

`PageController` = satu controller untuk semua halaman publik. Inject `getSharedData()` (settings, contactInfo, socialMedia) + data spesifik. Halaman "Tentang" juga inject `getAboutSidebar()`.

Tabel konten publik: `posts`, `teachers`, `galleries` + `gallery_images`, `extracurriculars`, `organizational_structures`, `principal_greetings`, `video_profiles`, `profiles`. Pesan dari form kontak → `messages`.

### Import / Export

| File | Keterangan |
|---|---|
| `app/Imports/BooksImport.php` | Import buku dari Excel (kode_buku yang sudah ada dilewati) |
| `app/Imports/MembersImport.php` | Import anggota siswa dari Excel (kolom: nis, nama, kelas, angkatan, no_hp) |
| `app/Imports/MembersUpdateKelasImport.php` | Update kelas massal anggota dari Excel |
| `app/Exports/BooksTemplateExport.php` | Template Excel kosong untuk import buku |
| `app/Exports/MembersTemplateExport.php` | Template Excel kosong untuk import anggota |
| `app/Exports/MembersUpdateKelasTemplateExport.php` | Template Excel kosong untuk update kelas |

Route download template (auth required, role Petugas):
- `GET /admin/buku/template` — template import buku → route name `buku.template`
- `GET /admin/anggota/template/import` — template import anggota → route name `anggota.template.import`
- `GET /admin/anggota/template/update-kelas` — template update kelas → route name `anggota.template.update-kelas`

### PDF & Excel Laporan

- `LibraryPdfController::download()` — route `GET /admin/laporan-perpustakaan/pdf` (auth, Petugas + Kepala). Render view `pdf/laporan-perpustakaan.blade.php`
- `LibraryExcelController::download()` — route `GET /admin/laporan-perpustakaan/excel` (auth, Petugas + Kepala)

Kedua route ini **tidak bertabrakan** dengan `LibraryReportResource` (slug `laporan-perpustakaan`) karena resource hanya mendaftarkan route index (`/admin/laporan-perpustakaan`), sedangkan `/pdf` dan `/excel` adalah path eksplisit di `web.php` yang didaftarkan lebih dulu.

### Asset Pipeline

Vite + `@tailwindcss/vite`. Tiga entry point:
1. `resources/css/app.css` — frontend publik
2. `resources/js/app.js` — frontend publik
3. `resources/css/filament/admin/theme.css` — tema Filament (registered via `->viteTheme()`)

Setelah edit `theme.css` wajib jalankan `npm run build` / `npm run dev`.

## Remaining Work

- [ ] Agenda mendatang di dashboard Admin masih **hardcoded/static** — perlu tabel `agendas` di DB
- [ ] Topbar Filament (breadcrumb) belum disesuaikan desain

## Sudah Selesai

**Core System:**
- [x] 13 resource website profil sekolah selesai (termasuk Users/Manajemen Pengguna)
- [x] Resource sistem perpustakaan: BookResource, BookItemResource, MemberResource, VisitResource, FineResource, LibraryReportResource, TextbookResource, DistribusiBukuPaketResource, TextbookSanksiResource
- [x] Halaman Livewire kustom sirkulasi: HalamanPeminjaman, CatatPeminjaman (stepper), PerpanjanganPeminjaman, HalamanPengembalian, ProsesKembaliBuku, Pelanggaran
- [x] Halaman Livewire kustom lain: KelolaAnggota, ImportKoleksi, BuatDistribusiBukuPaket (wizard), PengembalianBukuPaket
- [x] Role-based access control (Admin / Petugas / Kepala) dengan `canAccess()` per resource/page
- [x] Dashboard berbeda per role (sekolah vs perpustakaan)
- [x] Sidebar brand logo + notification bell (render hooks)
- [x] Global search dinonaktifkan (`->globalSearch(false)`)

**Perpustakaan:**
- [x] Eksemplar buku (BookItem): kode unik per eksemplar, tracking kondisi & ketersediaan
- [x] Alur peminjaman berbasis Livewire stepper (cari anggota → pilih buku → konfirmasi)
- [x] Perpanjangan masa pinjam via scan kode
- [x] Proses pengembalian via scan kode + auto-hitung denda Rp 1.000/hari + cetak struk
- [x] Halaman Pelanggaran: kelola denda + sanksi dalam satu tab view
- [x] Modul buku paket lengkap: Katalog → Distribusi (wizard) → Pengembalian per siswa → Sanksi
- [x] Model TextbookDistribution + TextbookDistributionItem (menggantikan TextbookLoan lama)
- [x] 5 widget laporan: RekapPeminjaman, RekapDenda, RekapSanksi, RekapKunjungan, VisitStats
- [x] Kiosk perpustakaan publik (absensi pengunjung + katalog buku)
- [x] Import koleksi massal + template Excel (`/admin/import-koleksi`)
- [x] Import anggota massal + update kelas via halaman Kelola Anggota
- [x] Laporan perpustakaan cetak PDF + Excel (`/admin/laporan-perpustakaan/pdf|excel`)
- [x] Halaman StatistikWebsite untuk KepalaSekolah
- [x] Auto-generate kode buku (BK-XXXX) dan kode eksemplar ({kode_buku}-001 dst.)
- [x] Auto-create Member guru saat Teacher dibuat (`Teacher::booted()`)

**Database & Seeding:**
- [x] Seed data lengkap semua tabel (19 seeder, ~300+ record dummy)
- [x] `DatabaseSeeder` tanpa `WithoutModelEvents` agar Eloquent events tetap berjalan

**Layout & UI:**
- [x] Layout viewport-locked: navbar sticky, sidebar fixed + scroll mandiri, konten scroll mandiri
- [x] `padding-bottom: 64px` pada sidebar nav dan konten utama (min-width:768px) untuk Windows taskbar
- [x] Custom scrollbar tipis pada `.fi-main` dan `.fi-sidebar-nav`
- [x] Frontend publik mobile-responsive: hero stats 2×2, guru 2×2 grid, footer 2-kolom

**URL & Routing:**
- [x] Semua slug resource/page menggunakan bahasa Indonesia
- [x] Navigation groups dirombak: Koleksi, Keanggotaan, Sirkulasi, Buku Paket
- [x] Route template download: `/admin/buku/template`, `/admin/anggota/template/*`

