<?php

namespace App\Filament\Admin\Pages;

use App\Enums\UserRole;
use App\Models\Extracurricular;
use App\Models\Gallery;
use App\Models\Message;
use App\Models\Post;
use App\Models\Teacher;
use App\Models\VideoProfile;
use App\Models\WebsiteVisit;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class StatistikWebsite extends Page
{
    protected static ?string $navigationLabel            = 'Statistik Website';
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedChartPie;
    protected static ?int    $navigationSort             = 10;
    protected string $view = 'filament.admin.pages.statistik-website';

    public int $totalBerita       = 0;
    public int $draftBerita       = 0;
    public int $beritaBulanIni    = 0;
    public int $pengumumanAktif   = 0;
    public int $pengumumanDraft   = 0;
    public int $totalGuru         = 0;
    public int $totalGaleri       = 0;
    public int $totalEkskul       = 0;
    public int $totalVideo        = 0;
    public int $totalPesan        = 0;
    public int $pesanBelumDibaca  = 0;
    public int $totalKunjungan    = 0;
    public int $kunjunganBulanIni = 0;
    public int $kunjunganHariIni  = 0;
    public $recentPosts;

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::KepalaSekolah;
    }

    public function mount(): void
    {
        $this->totalBerita      = Post::where('type', 'berita')->where('status', 'published')->count();
        $this->draftBerita      = Post::where('type', 'berita')->where('status', '!=', 'published')->count();
        $this->beritaBulanIni   = Post::where('type', 'berita')->where('status', 'published')
            ->whereMonth('tanggal_publish', now()->month)->whereYear('tanggal_publish', now()->year)->count();
        $this->pengumumanAktif  = Post::where('type', 'pengumuman')->where('status', 'published')->count();
        $this->pengumumanDraft  = Post::where('type', 'pengumuman')->where('status', '!=', 'published')->count();
        $this->totalGuru        = Teacher::where('is_active', true)->count();
        $this->totalGaleri      = Gallery::count();
        $this->totalEkskul      = Extracurricular::where('is_active', true)->count();
        $this->totalVideo       = VideoProfile::count();
        $this->totalPesan       = Message::count();
        $this->pesanBelumDibaca = Message::where('is_read', false)->count();
        $this->totalKunjungan    = WebsiteVisit::count();
        $this->kunjunganBulanIni = WebsiteVisit::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)->count();
        $this->kunjunganHariIni  = WebsiteVisit::whereDate('created_at', today())->count();

        $this->recentPosts = Post::where('status', 'published')
            ->latest('tanggal_publish')
            ->take(6)
            ->get();
    }
}
