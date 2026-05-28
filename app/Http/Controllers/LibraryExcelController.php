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

        $filename = $semua
            ? 'laporan-perpustakaan-semua.xlsx'
            : sprintf('laporan-perpustakaan-%04d-%02d.xlsx', $tahun, $bulan);

        return Excel::download(new LibraryReportExport($bulan, $tahun, $semua), $filename);
    }
}
