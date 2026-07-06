<?php

namespace App\Filament\Resources\Visits\Pages;

use App\Filament\Resources\Visits\VisitResource;
use App\Filament\Widgets\VisitStatsWidget;
use App\Models\Visit;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListVisits extends ListRecords
{
    protected static string $resource = VisitResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            VisitStatsWidget::class,
        ];
    }

    public function getTabs(): array
    {
        $hariIni   = Visit::whereDate('tgl_kunjungan', today())->count();
        $mingguIni = Visit::whereBetween('tgl_kunjungan', [
            now()->startOfWeek()->toDateString(),
            now()->endOfWeek()->toDateString(),
        ])->count();
        $bulanIni = Visit::whereMonth('tgl_kunjungan', now()->month)
            ->whereYear('tgl_kunjungan', now()->year)
            ->count();
        $semua = Visit::count();

        return [
            'hari_ini' => Tab::make('Hari Ini')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereDate('tgl_kunjungan', today()))
                ->badge($hariIni ?: null)
                ->badgeColor('info'),

            'minggu_ini' => Tab::make('Minggu Ini')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereBetween('tgl_kunjungan', [
                    now()->startOfWeek()->toDateString(),
                    now()->endOfWeek()->toDateString(),
                ]))
                ->badge($mingguIni ?: null)
                ->badgeColor('success'),

            'bulan_ini' => Tab::make('Bulan Ini')
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->whereMonth('tgl_kunjungan', now()->month)
                    ->whereYear('tgl_kunjungan', now()->year))
                ->badge($bulanIni ?: null)
                ->badgeColor('warning'),

            'semua' => Tab::make('Semua')
                ->badge($semua ?: null)
                ->badgeColor('gray'),
        ];
    }
}
