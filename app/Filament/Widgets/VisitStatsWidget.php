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
        $hariIniQ = Visit::whereDate('tgl_kunjungan', today());

        $hariIniTotal = (clone $hariIniQ)->count();
        $hariIniSiswa = (clone $hariIniQ)->where('jenis_pengunjung', 'siswa')->count();
        $hariIniGuru  = (clone $hariIniQ)->where('jenis_pengunjung', 'guru')->count();
        $hariIniTamu  = (clone $hariIniQ)->where('jenis_pengunjung', 'umum')->count();

        $startWeek = now()->startOfWeek();
        $endWeek   = now()->endOfWeek();

        $mingguIniTotal = Visit::whereBetween('tgl_kunjungan', [
            $startWeek->toDateString(),
            $endWeek->toDateString(),
        ])->count();

        $startStr = $startWeek->locale('id')->isoFormat('DD');
        $endStr   = $endWeek->locale('id')->isoFormat('DD MMM YYYY');
        if ($startWeek->month !== $endWeek->month) {
            $startStr = $startWeek->locale('id')->isoFormat('DD MMM');
        }
        $mingguIniRange = $startStr . ' – ' . $endStr;

        $bulanIniTotal = Visit::whereMonth('tgl_kunjungan', now()->month)
            ->whereYear('tgl_kunjungan', now()->year)
            ->count();
        $bulanIniLabel = now()->locale('id')->isoFormat('MMMM YYYY');

        return [
            'hariIniTotal'   => $hariIniTotal,
            'hariIniSiswa'   => $hariIniSiswa,
            'hariIniGuru'    => $hariIniGuru,
            'hariIniTamu'    => $hariIniTamu,
            'mingguIniTotal' => $mingguIniTotal,
            'mingguIniRange' => $mingguIniRange,
            'bulanIniTotal'  => $bulanIniTotal,
            'bulanIniLabel'  => $bulanIniLabel,
        ];
    }
}
