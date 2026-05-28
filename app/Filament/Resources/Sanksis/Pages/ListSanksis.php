<?php

namespace App\Filament\Resources\Sanksis\Pages;

use App\Filament\Resources\Sanksis\SanksiResource;
use App\Models\Loan;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListSanksis extends ListRecords
{
    protected static string $resource = SanksiResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTabs(): array
    {
        $belumLunasCount = Loan::where('status_sanksi', 'belum_lunas')->count();

        return [
            'belum_lunas' => Tab::make('Belum Lunas')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_sanksi', 'belum_lunas'))
                ->badge($belumLunasCount ?: null)
                ->badgeColor('danger'),

            'riwayat' => Tab::make('Riwayat / Lunas')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_sanksi', 'lunas')),
        ];
    }
}
