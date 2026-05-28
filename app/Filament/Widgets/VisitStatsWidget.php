<?php

namespace App\Filament\Widgets;

use App\Models\Visit;
use Filament\Widgets\Widget;

class VisitStatsWidget extends Widget
{
    protected string $view = 'filament.admin.widgets.visit-stats';

    protected int|string|array $columnSpan = 'full';

    public function getViewData(): array
    {
        return [
            'hariIni'   => Visit::whereDate('tgl_kunjungan', today())->count(),
            'mingguIni' => Visit::whereBetween('tgl_kunjungan', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'bulanIni'  => Visit::whereMonth('tgl_kunjungan', now()->month)
                               ->whereYear('tgl_kunjungan', now()->year)
                               ->count(),
        ];
    }
}
