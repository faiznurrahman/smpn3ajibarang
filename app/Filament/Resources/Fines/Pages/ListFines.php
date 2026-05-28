<?php

namespace App\Filament\Resources\Fines\Pages;

use App\Filament\Resources\Fines\FineResource;
use App\Models\Fine;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListFines extends ListRecords
{
    protected static string $resource = FineResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTabs(): array
    {
        $belumLunasCount = Fine::where('status_bayar', 'belum_lunas')->count();

        return [
            'belum_lunas' => Tab::make('Belum Lunas')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_bayar', 'belum_lunas'))
                ->badge($belumLunasCount ?: null)
                ->badgeColor('danger'),

            'riwayat' => Tab::make('Riwayat / Lunas')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_bayar', 'lunas')),
        ];
    }
}
