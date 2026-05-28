<?php

namespace App\Filament\Admin\Pages;

use App\Enums\UserRole;
use App\Models\Book;
use App\Models\Fine;
use App\Models\Gallery;
use App\Models\Loan;
use App\Models\Member;
use App\Models\Message;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Teacher;
use App\Models\TextbookLoan;
use App\Models\Visit;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Dashboard';
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;
    protected static ?int $navigationSort = -2;

    // School dashboard data
    public int $totalBerita        = 0;
    public int $draftBerita        = 0;
    public int $pesanBelumDibaca   = 0;
    public int $totalGuru          = 0;
    public int $siswaAktif         = 0;
    public int $totalPesan         = 0;
    public int $totalGaleri        = 0;
    public int $totalEkskul        = 0;
    public $recentMessages;
    public $recentPosts;
    public $recentActivities;
    public $settings;

    // Library dashboard data
    public int $totalBuku        = 0;
    public int $totalAnggota     = 0;
    public int $peminjamAktif    = 0;
    public int $dendaBelumLunas  = 0;
    public int $totalDenda       = 0;
    public int $bukuPaketAktif   = 0;
    public int $kunjunganHariIni   = 0;
    public int $kunjunganMingguIni = 0;
    public int $kunjunganBulanIni  = 0;
    public array $kunjungan7Hari    = [];
    public int   $maxKunjungan7Hari = 1;
    public $recentLoans;
    public $recentFines;

    public function getView(): string
    {
        $role = auth()->user()?->role;

        if ($role === UserRole::PetugasPerpustakaan || $role === UserRole::KepalaSekolah) {
            return 'filament.admin.pages.library-dashboard';
        }

        return 'filament.admin.pages.dashboard';
    }

    public function mount(): void
    {
        $role = auth()->user()?->role;

        if ($role === UserRole::PetugasPerpustakaan || $role === UserRole::KepalaSekolah) {
            $this->loadLibraryData();
        } else {
            $this->loadSchoolData();
        }
    }

    private function loadSchoolData(): void
    {
        $this->settings         = Setting::first();
        $this->totalBerita      = Post::where('status', 'published')->count();
        $this->draftBerita      = Post::where('status', 'draft')->count();
        $this->pesanBelumDibaca = Message::where('is_read', false)->count();
        $this->totalGuru        = Teacher::where('is_active', true)->count();
        $this->totalPesan       = Message::count();
        $this->siswaAktif       = (int) ($this->settings?->jumlah_siswa ?? 0);
        $this->totalGaleri      = Gallery::count();
        $this->totalEkskul      = \App\Models\Extracurricular::where('is_active', true)->count();

        $this->recentMessages = Message::where('is_read', false)->latest()->take(5)->get();
        $this->recentPosts    = Post::where('status', 'published')->latest('tanggal_publish')->take(4)->get();

        $activities = collect();

        Post::latest('updated_at')->take(3)->get()->each(function ($p) use (&$activities) {
            $activities->push([
                'icon'  => 'news',
                'color' => 'orange',
                'title' => 'Berita "' . Str::limit($p->judul, 38) . '" ' . ($p->status === 'published' ? 'dipublikasi' : 'disimpan draf'),
                'sub'   => 'oleh Admin',
                'time'  => $p->updated_at,
            ]);
        });

        Teacher::latest('updated_at')->take(2)->get()->each(function ($t) use (&$activities) {
            $activities->push([
                'icon'  => 'cap',
                'color' => 'green',
                'title' => 'Profil guru "' . Str::limit($t->nama, 30) . '" diperbarui',
                'sub'   => 'oleh Admin',
                'time'  => $t->updated_at,
            ]);
        });

        Gallery::latest('updated_at')->take(2)->get()->each(function ($g) use (&$activities) {
            $activities->push([
                'icon'  => 'img',
                'color' => 'blue',
                'title' => 'Galeri "' . Str::limit($g->judul, 35) . '" diperbarui',
                'sub'   => 'oleh Tim Humas',
                'time'  => $g->updated_at,
            ]);
        });

        $this->recentActivities = $activities->sortByDesc('time')->take(6)->values();
    }

    private function loadLibraryData(): void
    {
        $this->totalBuku       = Book::where('is_active', true)->count();
        $this->totalAnggota    = Member::where('is_active', true)->count();
        $this->peminjamAktif   = Loan::where('status', 'dipinjam')->count();
        $this->dendaBelumLunas = Fine::where('status_bayar', 'belum_lunas')->count();
        $this->totalDenda      = Fine::where('status_bayar', 'belum_lunas')->sum('nominal');
        $this->bukuPaketAktif    = TextbookLoan::where('status', 'aktif')->count();
        $this->kunjunganHariIni   = Visit::whereDate('tgl_kunjungan', today())->count();
        $this->kunjunganMingguIni = Visit::whereBetween('tgl_kunjungan', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $this->kunjunganBulanIni  = Visit::whereMonth('tgl_kunjungan', now()->month)->whereYear('tgl_kunjungan', now()->year)->count();

        $this->kunjungan7Hari = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = today()->subDays($i);
            $this->kunjungan7Hari[] = [
                'label' => $date->locale('id')->translatedFormat('d M'),
                'total' => Visit::whereDate('tgl_kunjungan', $date)->count(),
            ];
        }
        $this->maxKunjungan7Hari = max(array_column($this->kunjungan7Hari, 'total') ?: [1]);

        $this->recentLoans = Loan::with(['book', 'member'])
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->orderBy('tgl_batas_kembali', 'asc')
            ->take(6)
            ->get();

        $this->recentFines = Fine::with(['loan.book', 'loan.member'])
            ->where('status_bayar', 'belum_lunas')
            ->latest()
            ->take(5)
            ->get();
    }
}
