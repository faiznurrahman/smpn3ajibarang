<?php

namespace App\Filament\Resources\LibraryReports\Pages;

use App\Filament\Resources\LibraryReports\LibraryReportResource;
use App\Models\Book;
use App\Models\Fine;
use App\Models\Loan;
use App\Models\Member;
use Filament\Resources\Pages\ListRecords;

class ListLibraryReports extends ListRecords
{
    protected static string $resource = LibraryReportResource::class;

    public int $totalBuku       = 0;
    public int $totalAnggota    = 0;
    public int $peminjamAktif   = 0;
    public int $dendaBelumLunas = 0;
    public int $totalDenda      = 0;

    public function mount(): void
    {
        parent::mount();

        $this->totalBuku       = Book::where('is_active', true)->count();
        $this->totalAnggota    = Member::where('is_active', true)->count();
        $this->peminjamAktif   = Loan::where('status', 'dipinjam')->count();
        $this->dendaBelumLunas = Fine::where('status_bayar', 'belum_lunas')->count();
        $this->totalDenda      = Fine::where('status_bayar', 'belum_lunas')->sum('nominal');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }
}
