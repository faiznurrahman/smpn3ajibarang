<?php

namespace App\Filament\Resources\DistribusiBukuPakets\Pages;

use App\Filament\Resources\DistribusiBukuPakets\DistribusiBukuPaketResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListDistribusiBukuPaket extends ListRecords
{
    protected static string $resource = DistribusiBukuPaketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('buat_distribusi')
                ->label('Buat Distribusi')
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->url(fn () => route('filament.admin.pages.distribusi-baru')),
        ];
    }

    public function getTabs(): array
    {
        return [
            'semua' => Tab::make('Semua'),

            'aktif' => Tab::make('Aktif')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'aktif')),

            'selesai' => Tab::make('Selesai')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'selesai')),
        ];
    }
}
