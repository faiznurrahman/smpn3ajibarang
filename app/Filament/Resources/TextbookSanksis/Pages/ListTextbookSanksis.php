<?php

namespace App\Filament\Resources\TextbookSanksis\Pages;

use App\Filament\Resources\TextbookSanksis\TextbookSanksiResource;
use App\Models\TextbookDistributionItem;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListTextbookSanksis extends Page
{
    protected static string $resource = TextbookSanksiResource::class;

    protected string $view = 'filament.admin.resources.textbook-sanksis.pages.list-textbook-sanksis';

    public function getTitle(): string
    {
        return 'Sanksi buku paket';
    }

    // ── State ──────────────────────────────────────────────────────
    public string $activeTab = 'belum_lunas';
    public string $search    = '';
    public int    $page      = 1;
    public int    $perPage   = 15;

    // ── Modal "Tandai Lunas" ──────────────────────────────────────
    public bool   $showModal          = false;
    public ?int   $modalItemId        = null;
    public string $modalPenyelesaian  = 'bayar_harga';
    public ?int   $modalNominal       = null;
    public string $modalCatatan       = '';

    // ── Data ───────────────────────────────────────────────────────

    public function getStats(): array
    {
        $base = TextbookDistributionItem::where('jenis_sanksi', '!=', 'tidak_ada');

        return [
            'total'      => (clone $base)->count(),
            'belumLunas' => (clone $base)->where('status_sanksi', 'belum_lunas')->count(),
            'lunas'      => (clone $base)->where('status_sanksi', 'lunas')->count(),
            'rusak'      => (clone $base)->whereIn('kondisi_kembali', ['rusak_ringan', 'rusak_berat'])->count(),
            'hilang'     => (clone $base)->where('kondisi_kembali', 'hilang')->count(),
        ];
    }

    public function getData(): LengthAwarePaginator
    {
        $q = TextbookDistributionItem::where('jenis_sanksi', '!=', 'tidak_ada')
            ->with(['member', 'textbookItem.textbook', 'distribution']);

        match ($this->activeTab) {
            'belum_lunas' => $q->where('status_sanksi', 'belum_lunas'),
            'riwayat'     => $q->where('status_sanksi', 'lunas'),
            default       => null,
        };

        if (trim($this->search) !== '') {
            $s = $this->search;
            $q->whereHas('member', fn ($m) => $m->where('nama', 'like', "%{$s}%"));
        }

        return $q->orderByDesc('tgl_kembali_aktual')
            ->paginate($this->perPage, ['*'], 'tsk_page', $this->page);
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

    // ── Modal "Tandai Lunas" ─────────────────────────────────────────

    public function bukaModal(int $itemId): void
    {
        $this->modalItemId       = $itemId;
        $this->modalPenyelesaian = 'bayar_harga';
        $this->modalNominal      = null;
        $this->modalCatatan      = '';
        $this->showModal         = true;
    }

    public function tutupModal(): void
    {
        $this->showModal   = false;
        $this->modalItemId = null;
    }

    public function simpanLunas(): void
    {
        $item = TextbookDistributionItem::find($this->modalItemId);
        if (! $item) {
            $this->showModal = false;
            return;
        }

        $item->update([
            'status_sanksi'  => 'lunas',
            'jenis_sanksi'   => $this->modalPenyelesaian,
            'nominal_sanksi' => $this->modalPenyelesaian === 'bayar_harga'
                ? ($this->modalNominal ?? $item->nominal_sanksi)
                : $item->nominal_sanksi,
            'catatan'        => $this->modalCatatan ?: $item->catatan,
        ]);

        $this->showModal   = false;
        $this->modalItemId = null;

        Notification::make()->title('Sanksi berhasil diselesaikan')->success()->send();
    }
}
