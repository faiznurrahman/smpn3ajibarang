<?php

namespace App\Filament\Widgets;

use App\Models\Fine;
use Filament\Widgets\Widget;

class RekapDendaStatsWidget extends Widget
{
    protected string $view = 'filament.admin.widgets.rekap-denda-stats';

    protected int|string|array $columnSpan = 'full';

    public function getViewData(): array
    {
        return [
            'total'        => Fine::count(),
            'belumLunas'   => Fine::where('status_bayar', 'belum_lunas')->count(),
            'lunas'        => Fine::where('status_bayar', 'lunas')->count(),
            'nominalBelumLunas' => Fine::where('status_bayar', 'belum_lunas')->sum('nominal'),
            'nominalTotal'      => Fine::sum('nominal'),
        ];
    }
}
