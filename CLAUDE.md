# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Website Profil dan Sistem Informasi Perpustakaan SMP Negeri 3 Ajibarang — Laravel 13 + Filament v5 + Livewire v3 + Tailwind CSS v4.

- **Frontend publik**: blade views di `resources/views/pages/` untuk halaman sekolah (beranda, tentang, informasi, galeri, kontak)
- **Kiosk perpustakaan**: halaman publik di `/perpustakaan` untuk absensi pengunjung + katalog buku
- **Panel admin**: Filament v5 di `/admin`, dikustomisasi penuh (login, dashboard, tema, semua resource dengan label Indonesia)
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

**Buku & Peminjaman Reguler:**
- Manajemen data buku (tambah, edit, hapus; field: kode_buku, isbn, judul, penulis, penerbit, tahun, kategori, rak, stok, cover, deskripsi)
- Import buku massal via Excel (template download `/admin/books/template`)
- Manajemen data anggota (siswa + guru; field: kode_anggota, nama, jenis, kelas, tahun_masuk, status, teacher_id)
- Import anggota massal + update kelas massal via Excel
- Transaksi peminjaman buku (catat tanggal pinjam dan batas kembali)
- Transaksi pengembalian buku (modal tanggal kembali, kondisi, auto-hitung denda Rp 1.000/hari)
- Pengelolaan denda keterlambatan (update status bayar + tanggal bayar)
- Sanksi buku (kerusakan/hilang saat pengembalian: ganti_buku / bayar_harga)
- Laporan perpustakaan (data buku, anggota, transaksi — cetak PDF)

**Buku Paket:**
- Manajemen data buku paket (judul, mata_pelajaran, untuk_tingkat, total_eksemplar; auto-generate item dengan kode unik)
- Distribusi buku paket ke siswa per tahun ajaran & tingkat (auto-assign eksemplar ke anggota aktif)
- Sanksi buku paket (kondisi kembali: rusak/hilang; status: belum_lunas/lunas)

**Kunjungan & Laporan:**
- Data kunjungan perpustakaan (dari kiosk `/perpustakaan/hadir`; filter tanggal)
- Laporan perpustakaan dengan rekap statistik (peminjaman, denda, kunjungan, sanksi)

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

# Cache management (wajib setelah ubah view/config)
php artisan view:clear
php artisan config:clear
php artisan cache:clear

# Seed ulang user roles (untuk dev/testing)
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
| `resources/css/filament/admin/theme.css` | Tema Filament: sidebar, topbar, tabel, form inputs, tombol — semua mengikuti design `Guru.html` |
| `resources/views/filament/admin/components/brand.blade.php` | Logo sidebar kustom: query `Setting::value('logo')`, fallback "S3" mark navy; dipasang via `PanelsRenderHook::SIDEBAR_LOGO_BEFORE` |
| `resources/views/filament/admin/components/notification-bell.blade.php` | Bell icon di topbar: red dot jika ada pesan/draft/agenda; dropdown Alpine.js 3 seksi; dipasang via `PanelsRenderHook::GLOBAL_SEARCH_BEFORE` |
| `resources/views/filament/admin/pages/library-reports.blade.php` | Halaman laporan perpustakaan untuk Petugas (rekap + PDF) |
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

### Role-Based Access Control

Enum: `App\Enums\UserRole` — nilai: `admin`, `petugas_perpustakaan`, `kepala_sekolah`

Setiap resource override `canAccess(): bool`. Pola:
- Resource website profil sekolah (12 resource) + Users: `return auth()->user()?->role === UserRole::Admin;`
- Resource perpustakaan (Books, Members, Loans, Returns, Fines, Sanksis, Textbooks, TextbookLoans, TextbookSanksis, Visits): `return auth()->user()?->role === UserRole::PetugasPerpustakaan;`
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

**Catatan tabel:**
- Filament default `overflow-x: auto` pada `.fi-ta-content-ctn` — di-override jadi `hidden` untuk cegah scroll horizontal
- Jangan pakai `max-width: 0` pada sel tabel — menyebabkan cell tampak aneh; biarkan `table-layout: auto` yang mengatur lebar kolom
- Schema Settings (dan halaman single-record lain) wajib pakai `->columns(1)` agar section tidak disusun 2-kolom oleh Filament

### Navigation Groups & Labels

**Website Profil Sekolah — selesai (13 resource, hanya Admin):**

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
| Sistem | Users | Manajemen Pengguna |

Resource yang non-creatable/non-deletable: `ContactInfos`, `Messages`, `Settings`.

**Sistem Informasi Perpustakaan — selesai (11 resource):**

| Group | Resource | Label | Akses | Catatan |
|---|---|---|---|---|
| Perpustakaan | Books | Data Buku | Petugas | Import Excel + template download |
| Perpustakaan | Members | Data Anggota | Petugas | Import + update kelas massal via Excel |
| Perpustakaan | Loans | Peminjaman Buku | Petugas | |
| Perpustakaan | Returns | Pengembalian Buku | Petugas | Hanya List + action Kembalikan |
| Perpustakaan | Fines | Denda Keterlambatan | Petugas | Hanya Edit (status bayar) |
| Perpustakaan | Sanksis | Sanksi Buku | Petugas | Read-only; badge merah jumlah belum_lunas |
| Perpustakaan | Visits | Kunjungan | Petugas | Read-only; data dari kiosk; badge hari ini |
| Perpustakaan | LibraryReports | Laporan Perpustakaan | Petugas + Kepala | Read-only, cetak PDF |
| Buku Paket | Textbooks | Data Buku Paket | Petugas | Auto-generate item eksemplar |
| Buku Paket | TextbookLoans | Distribusi Buku Paket | Petugas | Auto-assign ke siswa per tingkat |
| Buku Paket | TextbookSanksis | Sanksi Buku Paket | Petugas | Read-only; badge merah jumlah belum_lunas |

**Halaman tambahan KepalaSekolah:**

| Group | Page | Label | Akses |
|---|---|---|---|
| *(tanpa group)* | StatistikWebsite | Statistik Website | Kepala Sekolah |

**Catatan resource perpustakaan:**
- `Returns` — tidak punya halaman Create/Edit; hanya List dengan action **Kembalikan** (modal tanggal kembali + kondisi, auto-hitung denda Rp 1.000/hari + catat sanksi jika kondisi rusak/hilang)
- `Fines` — tidak punya Create; hanya Edit untuk update status bayar + tanggal bayar
- `Sanksis` — model `Loan`, filter `status_sanksi != tidak_ada`; action untuk tandai lunas
- `LibraryReports` — read-only untuk semua role; `canCreate/Edit/Delete` semuanya false
- `Textbooks` — saat create/edit, `generateItems()` auto-buat eksemplar dengan kode `{kode_prefix}-001` dst.
- `TextbookLoans` — action **Distribusikan** memanggil `distributeToMembers()` yang auto-assign eksemplar available ke siswa aktif berdasarkan `tahun_masuk` + `untuk_tingkat`
- `TextbookSanksis` — model `TextbookLoanItem`, filter `status_sanksi = belum_lunas`
- Kode buku auto-generate `BK-XXXX` via model `booted()`
- Kode anggota siswa: `ANK-XXXX` (lama) atau NIS langsung dari import Excel

### Resource Structure Pattern
```
app/Filament/Resources/NamaResource/
├── NamaResource.php      # navigationLabel, navigationGroup, navigationIcon, navigationSort, canAccess()
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
books          — id, kode_buku, isbn, judul, penulis, penerbit, tahun, kategori, rak, stok, cover, deskripsi, is_active
members        — id, teacher_id(FK), kode_anggota, nama, jenis(siswa/guru), kelas, tahun_masuk, status(aktif/alumni/keluar), no_hp, is_active
loans          — id, book_id, member_id, tgl_pinjam, tgl_batas_kembali, tgl_kembali, status(dipinjam/dikembalikan/terlambat),
                 kondisi_kembali(baik/rusak/hilang), jenis_sanksi(tidak_ada/ganti_buku/bayar_harga),
                 nominal_sanksi, status_sanksi(tidak_ada/belum_lunas/lunas), tgl_selesai_sanksi, catatan_sanksi, petugas_id
fines          — id, loan_id, jumlah_hari, nominal, status_bayar(belum_lunas/lunas), tgl_bayar
textbooks      — id, judul, mata_pelajaran, untuk_tingkat(7/8/9), kode_prefix, penerbit, tahun_terbit, total_eksemplar, is_active
textbook_items — id, textbook_id, kode_item, kondisi(baik/rusak/hilang), is_available
textbook_loans — id, tahun_ajaran, untuk_tingkat, tgl_distribusi, tgl_kembali, status(aktif/selesai), petugas_id
textbook_loan_items — id, loan_id, member_id, textbook_item_id, kondisi_pinjam, kondisi_kembali,
                      jenis_sanksi, status_sanksi(belum_lunas/lunas), nominal_sanksi, tgl_selesai_sanksi, catatan_sanksi, tgl_kembali_aktual
visits         — id, nama, jenis_pengunjung(siswa/guru/umum), kelas, keperluan, tgl_kunjungan, jam_kunjungan
users          — ... + role(admin/petugas_perpustakaan/kepala_sekolah), is_active [default role: admin]
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

### Public Website

`PageController` = satu controller untuk semua halaman publik. Inject `getSharedData()` (settings, contactInfo, socialMedia) + data spesifik. Halaman "Tentang" juga inject `getAboutSidebar()`.

Tabel konten publik: `posts`, `teachers`, `galleries` + `gallery_images`, `extracurriculars`, `organizational_structures`, `principal_greetings`, `video_profiles`, `profiles`. Pesan dari form kontak → `messages`.

### Import / Export

| File | Keterangan |
|---|---|
| `app/Imports/MembersImport.php` | Import anggota siswa dari Excel (kolom: nis, nama, kelas, angkatan, no_hp) |
| `app/Imports/MembersUpdateKelasImport.php` | Update kelas massal anggota dari Excel |
| `app/Exports/BooksTemplateExport.php` | Template Excel kosong untuk import buku |
| `app/Exports/MembersTemplateExport.php` | Template Excel kosong untuk import anggota |
| `app/Exports/MembersUpdateKelasTemplateExport.php` | Template Excel kosong untuk update kelas |

Route download template (auth required, role Petugas):
- `GET /admin/books/template` — template import buku
- `GET /admin/members/template/import` — template import anggota
- `GET /admin/members/template/update-kelas` — template update kelas

### PDF Laporan

`LibraryPdfController::download()` — route `GET /admin/laporan-perpustakaan/pdf` (auth, Petugas + Kepala). Render view `pdf/laporan-perpustakaan.blade.php` dengan data filter (tanggal, jenis laporan).

### Asset Pipeline

Vite + `@tailwindcss/vite`. Tiga entry point:
1. `resources/css/app.css` — frontend publik
2. `resources/js/app.js` — frontend publik
3. `resources/css/filament/admin/theme.css` — tema Filament (registered via `->viteTheme()`)

Setelah edit `theme.css` wajib jalankan `npm run build` / `npm run dev`.

## Remaining Work

- [ ] Frontend publik (halaman beranda, tentang, dll.) perlu penyempurnaan — blade views sudah ada tapi mungkin belum optimal
- [ ] Agenda mendatang di dashboard Admin masih **hardcoded/static** — perlu tabel `agendas` di DB
- [ ] Topbar Filament (breadcrumb) belum disesuaikan desain

## Sudah Selesai

- [x] Semua form schema resource pakai `Section` + `Grid` (Posts, Galleries, Extracurriculars, Settings, OrganizationalStructures, PrincipalGreetings, SocialMedia, VideoProfiles, ContactInfos, Profiles, Messages/Infolist)
- [x] Semua tabel list disesuaikan desain Guru.html (padding, font, warna, badge, avatar circular, deskripsi sekunder)
- [x] Sidebar brand logo + notification bell (render hooks)
- [x] Global search dinonaktifkan (`->globalSearch(false)`)
- [x] 13 resource website profil sekolah selesai (termasuk Users/Manajemen Pengguna)
- [x] Role-based access control (Admin / Petugas / Kepala) dengan `canAccess()` per resource
- [x] 11 resource sistem perpustakaan selesai (Books, Members, Loans, Returns, Fines, Sanksis, Visits, LibraryReports, Textbooks, TextbookLoans, TextbookSanksis)
- [x] Dashboard berbeda per role (sekolah vs perpustakaan)
- [x] Denda otomatis Rp 1.000/hari saat pengembalian terlambat
- [x] Sistem sanksi buku (kondisi rusak/hilang → ganti_buku / bayar_harga)
- [x] Modul buku paket lengkap (Data, Distribusi per tingkat, Sanksi)
- [x] Kiosk perpustakaan publik (absensi pengunjung + katalog buku)
- [x] Data kunjungan dari kiosk masuk ke resource Visits di admin
- [x] Import anggota massal + update kelas via Excel
- [x] Import/export template Excel (buku, anggota, update kelas)
- [x] Laporan perpustakaan cetak PDF (`/admin/laporan-perpustakaan/pdf`)
- [x] Halaman StatistikWebsite untuk KepalaSekolah
- [x] Auto-generate kode buku (BK-XXXX) dan item buku paket ({prefix}-001 dst.)
- [x] Member: field tahun_masuk + computed `tingkat` (7/8/9) untuk distribusi buku paket
