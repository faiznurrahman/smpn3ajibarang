<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\IpUtils;
use Symfony\Component\HttpFoundation\Response;

class RestrictKioskToSchoolNetwork
{
    public function handle(Request $request, Closure $next): Response
    {
        $allowedCidrs = config('perpustakaan.kiosk.allowed_cidrs', []);

        // Kosong = pembatasan IP dinonaktifkan.
        if (empty($allowedCidrs)) {
            return $next($request);
        }

        if (! IpUtils::checkIp($request->ip(), $allowedCidrs)) {
            return redirect()->route('perpustakaan.layanan')
                ->with('kiosk_error', 'Fitur Daftar Hadir hanya dapat diakses dari jaringan sekolah.');
        }

        return $next($request);
    }
}
