<?php

namespace App\Filament\Resources\DistribusiBukuPakets\Pages;

use App\Filament\Resources\DistribusiBukuPakets\DistribusiBukuPaketResource;
use App\Models\TextbookDistribution;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListDistribusiBukuPaket extends Page
{
    protected static string $resource = DistribusiBukuPaketResource::class;

    protected string $view = 'filament.admin.resources.distribusi-buku-paket.pages.list-distribusi';

    public function getTitle(): string
    {
        return 'Distribusi buku paket';
    }

    // ── State ──────────────────────────────────────────────────────
    public string $activeTab = 'semua';
    public string $search    = '';
    public int    $page      = 1;
    public int    $perPage   = 15;

    // ── Data ───────────────────────────────────────────────────────

    public function getData(): LengthAwarePaginator
    {
        $q = TextbookDistribution::query();

        match ($this->activeTab) {
            'aktif'   => $q->where('status', 'aktif'),
            'selesai' => $q->where('status', 'selesai'),
            default   => null,
        };

        if (trim($this->search) !== '') {
            $s = $this->search;
            $q->where('tahun_ajaran', 'like', "%{$s}%");
        }

        return $q->orderByDesc('created_at')
            ->paginate($this->perPage, ['*'], 'dbp_page', $this->page);
    }

    public function getCreateUrl(): string
    {
        return route('filament.admin.pages.distribusi-baru');
    }

    public function getDetailUrl(TextbookDistribution $distribution): string
    {
        return DistribusiBukuPaketResource::getUrl('view', ['record' => $distribution]);
    }

    public function getPengembalianUrl(TextbookDistribution $distribution): string
    {
        return route('filament.admin.pages.pengembalian-buku-paket') . '?distribusi=' . $distribution->id;
    }

    // ── Lifecycle ──────────────────────────────────────────────────

    public function updatedSearch(): void
    {
        $this->page = 1;
    }

    public function updatedActiveTab(): void
    {
        $this->page = 1;
    }

    // ── Pagination ─────────────────────────────────────────────────

    public function nextPage(): void
    {
        $this->page++;
    }

    public function prevPage(): void
    {
        if ($this->page > 1) {
            $this->page--;
        }
    }
}
