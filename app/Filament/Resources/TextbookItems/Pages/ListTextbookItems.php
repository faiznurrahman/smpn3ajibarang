<?php

namespace App\Filament\Resources\TextbookItems\Pages;

use App\Filament\Resources\TextbookItems\TextbookItemResource;
use App\Models\Textbook;
use App\Models\TextbookItem;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;

class ListTextbookItems extends Page
{
    protected static string $resource = TextbookItemResource::class;

    protected string $view = 'filament.admin.resources.textbook-items.pages.list-textbook-items';

    public function getTitle(): string
    {
        return 'Eksemplar buku paket';
    }

    // ── State ──────────────────────────────────────────────────────
    public string $activeTab      = 'semua';
    public string $search         = '';
    public string $filterTextbook = '';
    public string $filterKondisi  = '';
    public int    $page           = 1;
    public int    $perPage        = 20;

    // ── Bulk select ────────────────────────────────────────────────
    public array $selected = [];

    // ── Modal "Edit Kondisi" ──────────────────────────────────────
    public bool   $showEditModal   = false;
    public ?int   $modalItemId     = null;
    public string $modalKondisi    = 'baik';
    public bool   $modalIsAvailable = true;
    public string $modalCatatan    = '';

    // ── Modal "Cetak Semua Label" ──────────────────────────────────
    public bool $showCetakSemuaModal = false;

    // ── Modal "Cetak Label per Buku Paket" ─────────────────────────
    public bool  $showCetakBukuModal = false;
    public array $modalTextbookIds   = [];

    // ── Data ───────────────────────────────────────────────────────

    public function getTextbookOptions(): Collection
    {
        return Textbook::orderBy('judul')->get(['id', 'judul']);
    }

    public function getData(): LengthAwarePaginator
    {
        $q = TextbookItem::with('textbook');

        match ($this->activeTab) {
            'tersedia' => $q->where('is_available', true),
            'dipinjam' => $q->where('is_available', false),
            default    => null,
        };

        if ($this->filterTextbook !== '') {
            $q->where('textbook_id', $this->filterTextbook);
        }

        if ($this->filterKondisi !== '') {
            $q->where('kondisi', $this->filterKondisi);
        }

        if (trim($this->search) !== '') {
            $s = $this->search;
            $q->where(function ($q2) use ($s) {
                $q2->where('kode_item', 'like', "%{$s}%")
                    ->orWhereHas('textbook', fn ($t) => $t->where('judul', 'like', "%{$s}%"));
            });
        }

        return $q->orderBy('kode_item')
            ->paginate($this->perPage, ['*'], 'txi_page', $this->page);
    }

    // ── Lifecycle ──────────────────────────────────────────────────

    public function updatedSearch(): void
    {
        $this->page = 1;
    }

    public function updatedActiveTab(): void
    {
        $this->page = 1;
        $this->selected = [];
    }

    public function updatedFilterTextbook(): void
    {
        $this->page = 1;
    }

    public function updatedFilterKondisi(): void
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

    // ── Bulk select ────────────────────────────────────────────────

    public function toggleSelectAllPage(): void
    {
        $idsOnPage = $this->getData()->pluck('id')->map(fn ($id) => (string) $id)->toArray();
        $allSelected = empty(array_diff($idsOnPage, $this->selected));

        if ($allSelected) {
            $this->selected = array_values(array_diff($this->selected, $idsOnPage));
        } else {
            $this->selected = array_values(array_unique(array_merge($this->selected, $idsOnPage)));
        }
    }

    public function clearSelection(): void
    {
        $this->selected = [];
    }

    public function cetakTerpilih(): ?RedirectResponse
    {
        if (empty($this->selected)) {
            return null;
        }

        return redirect()->route('eksemplar-paket.label.terpilih', [
            'ids' => implode(',', $this->selected),
        ]);
    }

    // ── Modal "Edit Kondisi" ─────────────────────────────────────────

    public function bukaEditModal(int $itemId): void
    {
        $item = TextbookItem::find($itemId);
        if (! $item) {
            return;
        }

        $this->modalItemId       = $item->id;
        $this->modalKondisi      = $item->kondisi;
        $this->modalIsAvailable  = $item->is_available;
        $this->modalCatatan      = $item->catatan ?? '';
        $this->showEditModal     = true;
    }

    public function updatedModalKondisi(): void
    {
        if ($this->modalKondisi === 'hilang') {
            $this->modalIsAvailable = false;
        }
    }

    public function tutupEditModal(): void
    {
        $this->showEditModal = false;
        $this->modalItemId   = null;
    }

    public function simpanKondisi(): void
    {
        $item = TextbookItem::find($this->modalItemId);
        if (! $item) {
            $this->showEditModal = false;
            return;
        }

        $item->update([
            'kondisi'      => $this->modalKondisi,
            'is_available' => $this->modalKondisi === 'hilang' ? false : $this->modalIsAvailable,
            'catatan'      => $this->modalCatatan ?: null,
        ]);

        $this->showEditModal = false;
        $this->modalItemId   = null;

        Notification::make()->title('Kondisi eksemplar berhasil diperbarui')->success()->send();
    }

    // ── Modal "Cetak Semua Label" ───────────────────────────────────

    public function konfirmasiCetakSemua(): RedirectResponse
    {
        $this->showCetakSemuaModal = false;

        return redirect()->route('eksemplar-paket.label.semua');
    }

    // ── Modal "Cetak Label per Buku Paket" ──────────────────────────

    public function bukaCetakBukuModal(): void
    {
        $this->modalTextbookIds  = [];
        $this->showCetakBukuModal = true;
    }

    public function cetakPerBuku(): ?RedirectResponse
    {
        if (empty($this->modalTextbookIds)) {
            return null;
        }

        return redirect()->route('eksemplar-paket.label.buku', [
            'textbook_ids' => implode(',', $this->modalTextbookIds),
        ]);
    }
}
