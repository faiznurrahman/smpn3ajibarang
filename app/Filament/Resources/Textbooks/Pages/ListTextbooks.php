<?php

namespace App\Filament\Resources\Textbooks\Pages;

use App\Filament\Resources\Textbooks\TextbookResource;
use App\Models\Textbook;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListTextbooks extends Page
{
    protected static string $resource = TextbookResource::class;

    protected string $view = 'filament.admin.resources.textbooks.pages.list-textbooks';

    public function getTitle(): string
    {
        return 'Katalog buku paket';
    }

    // ── State ──────────────────────────────────────────────────────
    public string $activeTab = 'aktif';
    public string $search    = '';
    public int    $page      = 1;
    public int    $perPage   = 15;

    // ── Data ───────────────────────────────────────────────────────

    public function getData(): LengthAwarePaginator
    {
        $q = Textbook::query();

        match ($this->activeTab) {
            'aktif'    => $q->where('is_active', true),
            'nonaktif' => $q->where('is_active', false),
            default    => null,
        };

        if (trim($this->search) !== '') {
            $s = $this->search;
            $q->where(function ($q2) use ($s) {
                $q2->where('judul', 'like', "%{$s}%")
                    ->orWhere('kode_prefix', 'like', "%{$s}%")
                    ->orWhere('mata_pelajaran', 'like', "%{$s}%")
                    ->orWhere('penerbit', 'like', "%{$s}%");
            });
        }

        return $q->orderBy('untuk_tingkat')
            ->orderBy('judul')
            ->paginate($this->perPage, ['*'], 'txb_page', $this->page);
    }

    public function getCreateUrl(): string
    {
        return TextbookResource::getUrl('create');
    }

    public function getEditUrl(Textbook $textbook): string
    {
        return TextbookResource::getUrl('edit', ['record' => $textbook]);
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
