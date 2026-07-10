<?php

namespace App\Filament\Resources\Books\Pages;

use App\Filament\Resources\Books\BookResource;
use App\Models\Book;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListBooks extends Page
{
    protected static string $resource = BookResource::class;

    protected string $view = 'filament.admin.resources.books.pages.list-books';

    public function getTitle(): string
    {
        return 'Katalog buku';
    }

    // ── State ──────────────────────────────────────────────────────
    public string $activeTab      = 'aktif';
    public string $search         = '';
    public string $filterKategori = '';
    public int    $page           = 1;
    public int    $perPage        = 15;

    // ── Data ───────────────────────────────────────────────────────

    public function getData(): LengthAwarePaginator
    {
        $q = Book::query();

        match ($this->activeTab) {
            'aktif'    => $q->where('is_active', true),
            'nonaktif' => $q->where('is_active', false),
            default    => null,
        };

        if ($this->filterKategori !== '') {
            $q->where('kategori', $this->filterKategori);
        }

        if (trim($this->search) !== '') {
            $s = $this->search;
            $q->where(function ($q2) use ($s) {
                $q2->where('judul', 'like', "%{$s}%")
                    ->orWhere('kode_buku', 'like', "%{$s}%")
                    ->orWhere('penulis', 'like', "%{$s}%")
                    ->orWhere('no_panggil', 'like', "%{$s}%");
            });
        }

        return $q->orderBy('judul')
            ->paginate($this->perPage, ['*'], 'bks_page', $this->page);
    }

    public function getCreateUrl(): string
    {
        return BookResource::getUrl('create');
    }

    public function getEditUrl(Book $book): string
    {
        return BookResource::getUrl('edit', ['record' => $book]);
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

    public function updatedFilterKategori(): void
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
