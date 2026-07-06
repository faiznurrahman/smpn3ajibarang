<?php

namespace App\Filament\Resources\DistribusiBukuPakets\Pages;

use App\Filament\Resources\DistribusiBukuPakets\DistribusiBukuPaketResource;
use App\Models\TextbookDistribution;
use App\Models\TextbookDistributionItem;
use Filament\Actions\Action;
use Filament\Resources\Pages\Page;

class ViewDistribusiBukuPaket extends Page
{
    protected static string $resource = DistribusiBukuPaketResource::class;

    protected string $view = 'filament.admin.resources.distribusi-buku-paket.pages.view-distribusi';

    public int $recordId;
    public ?TextbookDistribution $distribution = null;
    public string $activeTab = '';
    public array $tabs = [];

    public function mount(int|string $record): void
    {
        $this->recordId     = (int) $record;
        $this->distribution = TextbookDistribution::findOrFail($this->recordId);
        $this->loadTabs();
    }

    public function getTitle(): string
    {
        return 'Detail Distribusi — ' . $this->distribution->tahun_ajaran
            . ' (Kelas ' . $this->distribution->untuk_tingkat . ')';
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('pengembalian')
                ->label('Proses Pengembalian')
                ->icon('heroicon-o-arrow-uturn-left')
                ->color('success')
                ->visible(fn () => $this->distribution?->status === 'aktif')
                ->url(fn () => route('filament.admin.pages.pengembalian-buku-paket') . '?distribusi=' . $this->recordId),

            Action::make('kembali')
                ->label('Kembali ke Daftar')
                ->icon('heroicon-o-arrow-left')
                ->color('gray')
                ->url(DistribusiBukuPaketResource::getUrl('index')),
        ];
    }

    private function loadTabs(): void
    {
        $itemIds     = TextbookDistributionItem::where('distribution_id', $this->recordId)->pluck('textbook_item_id');
        $textbookIds = \App\Models\TextbookItem::whereIn('id', $itemIds)->distinct()->pluck('textbook_id');

        $this->tabs = \App\Models\Textbook::whereIn('id', $textbookIds)
            ->orderBy('mata_pelajaran')
            ->get()
            ->map(fn ($t) => ['id' => $t->id, 'judul' => $t->judul, 'mata_pelajaran' => $t->mata_pelajaran])
            ->toArray();

        if (! empty($this->tabs)) {
            $this->activeTab = (string) $this->tabs[0]['id'];
        }
    }

    public function setActiveTab(string $tabId): void
    {
        $this->activeTab = $tabId;
    }

    public function getActiveItems(): array
    {
        if (! $this->activeTab) return [];

        $tbItemIds = \App\Models\TextbookItem::where('textbook_id', (int) $this->activeTab)->pluck('id');

        return TextbookDistributionItem::where('distribution_id', $this->recordId)
            ->whereIn('textbook_item_id', $tbItemIds)
            ->with(['member', 'textbookItem'])
            ->orderBy('urutan_distribusi')
            ->get()
            ->values()
            ->map(fn ($item, $i) => [
                'no'              => $i + 1,
                'nama'            => $item->member?->nama ?? '—',
                'kelas'           => $item->member?->kelas ?? '—',
                'kode_item'       => $item->textbookItem?->kode_item ?? '—',
                'kondisi_kembali' => $item->kondisi_kembali,
                'tgl_kembali'     => $item->tgl_kembali_aktual?->format('d/m/Y'),
                'status_sanksi'   => $item->status_sanksi,
                'jenis_sanksi'    => $item->jenis_sanksi,
            ])
            ->toArray();
    }
}
