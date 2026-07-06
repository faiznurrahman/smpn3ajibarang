<?php

namespace App\Filament\Resources\TextbookSanksis\Pages;

use App\Filament\Resources\TextbookSanksis\TextbookSanksiResource;
use App\Filament\Widgets\RekapSanksiBukuStatsWidget;
use App\Models\TextbookDistributionItem;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListTextbookSanksis extends ListRecords
{
    protected static string $resource = TextbookSanksiResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            RekapSanksiBukuStatsWidget::class,
        ];
    }

    public function getTabs(): array
    {
        $belumLunasCount = TextbookDistributionItem::where('status_sanksi', 'belum_lunas')->count();

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
