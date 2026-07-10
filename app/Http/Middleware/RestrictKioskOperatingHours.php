<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictKioskOperatingHours
{
    public function handle(Request $request, Closure $next): Response
    {
        $now = now();

        $allowedDays = config('perpustakaan.kiosk.operating_days', [1, 2, 3, 4, 5]);
        $start       = config('perpustakaan.kiosk.operating_start', '07:00');
        $end         = config('perpustakaan.kiosk.operating_end', '14:00');

        $withinDay  = in_array($now->dayOfWeekIso, $allowedDays, true);
        $withinTime = $now->format('H:i') >= $start && $now->format('H:i') <= $end;

        if (! $withinDay || ! $withinTime) {
            return redirect()->route('perpustakaan.layanan')
                ->with('kiosk_error', "Fitur Daftar Hadir hanya dapat diakses pada hari dan jam operasional perpustakaan ({$start}–{$end} WIB).");
        }

        return $next($request);
    }
}
