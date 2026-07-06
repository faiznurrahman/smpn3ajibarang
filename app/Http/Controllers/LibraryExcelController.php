<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Exports\LibraryReportExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LibraryExcelController extends Controller
{
    public function download(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        abort_unless(
            in_array(auth()->user()?->role, [UserRole::PetugasPerpustakaan, UserRole::KepalaSekolah]),
            403
        );

        $semua = (bool) $request->input('semua');
        $bulan = $semua ? null : (int) ($request->input('bulan') ?? now()->month);
        $tahun = $semua ? null : (int) ($request->input('tahun') ?? now()->year);

        $bulanLabel = $bulan ? str_pad($bulan, 2, '0', STR_PAD_LEFT) : 'semua';
        $filename = $semua
            ? 'laporan-bulanan-semua.xlsx'
            : sprintf('laporan-bulanan-%s-%04d.xlsx', $bulanLabel, $tahun);

        return Excel::download(new LibraryReportExport($bulan, $tahun, $semua), $filename);
    }
}
