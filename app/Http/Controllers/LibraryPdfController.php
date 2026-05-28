<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Fine;
use App\Models\Loan;
use App\Models\Member;
use App\Models\Setting;
use App\Models\TextbookLoanItem;
use App\Models\Visit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LibraryPdfController extends Controller
{
    public function download(Request $request)
    {
        $role = auth()->user()?->role;
        if (!in_array($role, [UserRole::PetugasPerpustakaan, UserRole::KepalaSekolah])) {
            abort(403);
        }

        $bulan  = $request->integer('bulan', now()->month);
        $tahun  = $request->integer('tahun', now()->year);
        $semua  = $request->boolean('semua', false);

        $setting = Setting::first();

        // Logo: embed as base64 so DomPDF doesn't need remote access
        $logoBase64 = null;
        if ($setting?->logo) {
            $logoPath = storage_path('app/public/' . $setting->logo);
            if (file_exists($logoPath)) {
                $mime        = mime_content_type($logoPath);
                $logoBase64  = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($logoPath));
            }
        }

        // Peminjaman
        $loanQuery = Loan::with(['book', 'member', 'fine']);
        if (!$semua) {
            $loanQuery->whereMonth('tgl_pinjam', $bulan)->whereYear('tgl_pinjam', $tahun);
        }
        $loans = $loanQuery->orderByDesc('tgl_pinjam')->get();

        // Denda
        $fineQuery = Fine::with(['loan.book', 'loan.member']);
        if (!$semua) {
            $fineQuery->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun);
        }
        $fines = $fineQuery->orderByDesc('created_at')->get();

        // Sanksi Buku Paket
        $sanksiQuery = TextbookLoanItem::with(['member', 'textbookItem.textbook', 'loan'])
            ->whereIn('status_sanksi', ['belum_lunas', 'lunas']);
        if (!$semua) {
            $sanksiQuery->whereMonth('tgl_kembali_aktual', $bulan)->whereYear('tgl_kembali_aktual', $tahun);
        }
        $sanksis = $sanksiQuery->orderByDesc('tgl_kembali_aktual')->get();

        // Kunjungan
        $visitQuery = Visit::query();
        if (!$semua) {
            $visitQuery->whereMonth('tgl_kunjungan', $bulan)->whereYear('tgl_kunjungan', $tahun);
        }
        $visits = $visitQuery->orderByDesc('tgl_kunjungan')->get();

        $periode = $semua
            ? 'Semua Periode'
            : \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->locale('id')->translatedFormat('F Y');

        $data = compact(
            'setting', 'logoBase64', 'loans', 'fines', 'sanksis', 'visits',
            'bulan', 'tahun', 'semua', 'periode'
        );

        $pdf = Pdf::loadView('pdf.laporan-perpustakaan', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled'      => false,
                'defaultFont'          => 'DejaVu Sans',
            ]);

        $filename = 'Laporan-Perpustakaan-' . str_replace(' ', '-', $periode) . '.pdf';

        return $pdf->download($filename);
    }
}
