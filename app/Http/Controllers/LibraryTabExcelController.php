<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Exports\LibraryTabExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LibraryTabExcelController extends Controller
{
    public function download(Request $request)
    {
        abort_unless(
            in_array(auth()->user()?->role, [UserRole::PetugasPerpustakaan, UserRole::KepalaSekolah]),
            403
        );

        $tab     = $request->input('tab', 'buku');
        $filters = $request->except('tab');
        $date    = now()->format('Ymd');
        $filename = "laporan-{$tab}-{$date}.xlsx";

        return Excel::download(new LibraryTabExport($tab, $filters), $filename);
    }
}
