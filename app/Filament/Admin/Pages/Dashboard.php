<?php

namespace App\Filament\Admin\Pages;

use App\Models\Gallery;
use App\Models\Message;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Teacher;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;

class Dashboard extends BaseDashboard
{
    protected string $view = 'filament.admin.pages.dashboard';

    protected static ?string $navigationLabel = 'Dasbor';
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;
    protected static ?int $navigationSort = -2;

    public int $totalBerita        = 0;
    public int $pesanBelumDibaca   = 0;
    public int $totalGuru          = 0;
    public int $siswaAktif         = 0;
    public int $totalPesan         = 0;

    public $recentMessages;
    public $recentPosts;
    public $recentActivities;
    public $settings;

    public function mount(): void
    {
        $this->settings         = Setting::first();
        $this->totalBerita      = Post::where('status', 'published')->count();
        $this->pesanBelumDibaca = Message::where('is_read', false)->count();
        $this->totalGuru        = Teacher::where('is_active', true)->count();
        $this->totalPesan       = Message::count();
        $this->siswaAktif       = (int) ($this->settings?->jumlah_siswa ?? 0);

        $this->recentMessages = Message::where('is_read', false)
            ->latest()->take(5)->get();

        $this->recentPosts = Post::where('status', 'published')
            ->latest('tanggal_publish')->take(4)->get();

        // Build activity feed from recently updated models
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
}
