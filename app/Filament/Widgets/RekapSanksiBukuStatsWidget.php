<?php

namespace App\Filament\Widgets;

use App\Models\Loan;
use Filament\Widgets\Widget;

class RekapSanksiBukuStatsWidget extends Widget
{
    protected string $view = 'filament.admin.widgets.rekap-sanksi-buku-stats';

    protected int|string|array $columnSpan = 'full';

    public function getViewData(): array
    {
        $base = Loan::where('status_sanksi', '!=', 'tidak_ada');

        return [
            'total'      => (clone $base)->count(),
            'belumLunas' => (clone $base)->where('status_sanksi', 'belum_lunas')->count(),
            'lunas'      => (clone $base)->where('status_sanksi', 'lunas')->count(),
            'rusak'      => (clone $base)->where('kondisi_kembali', 'rusak')->count(),
            'hilang'     => (clone $base)->where('kondisi_kembali', 'hilang')->count(),
        ];
    }
}
