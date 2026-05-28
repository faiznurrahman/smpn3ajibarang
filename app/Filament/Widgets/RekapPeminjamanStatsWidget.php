<?php

namespace App\Filament\Widgets;

use App\Models\Fine;
use App\Models\Loan;
use Filament\Widgets\Widget;

class RekapPeminjamanStatsWidget extends Widget
{
    protected string $view = 'filament.admin.widgets.rekap-peminjaman-stats';

    protected int|string|array $columnSpan = 'full';

    public function getViewData(): array
    {
        return [
            'total'          => Loan::count(),
            'dipinjam'       => Loan::where('status', 'dipinjam')->count(),
            'dikembalikan'   => Loan::where('status', 'dikembalikan')->count(),
            'terlambat'      => Loan::where('status', 'terlambat')->count(),
            'bulanIni'       => Loan::whereMonth('tgl_pinjam', now()->month)->whereYear('tgl_pinjam', now()->year)->count(),
            'totalDendaNominal' => Fine::sum('nominal'),
        ];
    }
}
