<?php

namespace App\Filament\Admin\Pages;

use App\Enums\UserRole;
use App\Models\Fine;
use App\Models\Loan;
use Filament\Pages\Page;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Pelanggaran extends Page
{
    protected static ?string $navigationLabel            = 'Pelanggaran';
    protected static string|\UnitEnum|null $navigationGroup = 'Sirkulasi';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-exclamation-triangle';
    protected static ?int    $navigationSort             = 4;
    protected static ?string $slug                       = 'pelanggaran';

    protected string $view = 'filament.admin.pages.pelanggaran';

    // ── Tab & filter state ─────────────────────────────────────────────
    public string $activeTab    = 'denda';
    public string $filterDenda  = 'belum_lunas';
    public string $filterSanksi = 'belum_lunas';
    public string $searchDenda  = '';
    public string $searchSanksi = '';

    // ── Pagination state ───────────────────────────────────────────────
    public int $pageDenda  = 1;
    public int $pageSanksi = 1;
    public int $perPage    = 10;

    // ── Badge counts ───────────────────────────────────────────────────
    public int $dendaBelumLunas  = 0;
    public int $sanksiBelumLunas = 0;

    // ── Denda modal state ──────────────────────────────────────────────
    public bool   $showModalDenda = false;
    public ?int   $modalFineId    = null;
    public string $tglBayar       = '';

    // ── Sanksi modal state ─────────────────────────────────────────────
    public bool   $showModalSanksi = false;
    public ?int   $modalLoanId     = null;
    public string $tglSelesai      = '';
    public string $catatanSelesai  = '';

    public static function canAccess(): bool
    {
        $role = auth()->user()?->role;
        return $role === UserRole::PetugasPerpustakaan;
    }

    public static function getNavigationBadge(): ?string
    {
        $total = Fine::where('status_bayar', 'belum_lunas')->count()
               + Loan::where('status_sanksi', 'belum_lunas')->count();
        return $total ? (string) $total : null;
    }

    public static function getNavigationBadgeColor(): string
    {
        return 'danger';
    }

    public function mount(): void
    {
        $today = now()->format('Y-m-d');
        $this->tglBayar   = $today;
        $this->tglSelesai = $today;
        $this->refreshCounts();
    }

    public function isReadOnly(): bool
    {
        return auth()->user()?->role === UserRole::KepalaSekolah;
    }

    // ── Data getters ───────────────────────────────────────────────────

    public function getDendaData(): LengthAwarePaginator
    {
        $q = Fine::with(['loan.member', 'loan.book'])->latest();
        $q->where('status_bayar', $this->filterDenda);

        if ($this->searchDenda !== '') {
            $search = $this->searchDenda;
            $q->whereHas('loan.member', fn ($m) => $m->where('nama', 'like', '%' . $search . '%'));
        }

        return $q->paginate($this->perPage, ['*'], 'denda_page', $this->pageDenda);
    }

    public function getSanksiData(): LengthAwarePaginator
    {
        $q = Loan::with(['member', 'book'])
            ->whereIn('jenis_sanksi', ['ganti_buku', 'bayar_harga'])
            ->latest('tgl_kembali');

        $q->where('status_sanksi', $this->filterSanksi);

        if ($this->searchSanksi !== '') {
            $search = $this->searchSanksi;
            $q->whereHas('member', fn ($m) => $m->where('nama', 'like', '%' . $search . '%'));
        }

        return $q->paginate($this->perPage, ['*'], 'sanksi_page', $this->pageSanksi);
    }

    // ── Lifecycle hooks ────────────────────────────────────────────────

    public function updatedFilterDenda(): void  { $this->pageDenda = 1; }
    public function updatedSearchDenda(): void  { $this->pageDenda = 1; }
    public function updatedFilterSanksi(): void { $this->pageSanksi = 1; }
    public function updatedSearchSanksi(): void { $this->pageSanksi = 1; }
    public function updatedActiveTab(): void    { $this->pageDenda = 1; $this->pageSanksi = 1; }

    // ── Pagination ──────────────────────────────────────────────────────

    public function nextPageDenda(): void  { $this->pageDenda++; }
    public function prevPageDenda(): void  { if ($this->pageDenda > 1) $this->pageDenda--; }
    public function nextPageSanksi(): void { $this->pageSanksi++; }
    public function prevPageSanksi(): void { if ($this->pageSanksi > 1) $this->pageSanksi--; }

    // ── Denda actions ──────────────────────────────────────────────────

    public function bukaModalDenda(int $fineId): void
    {
        $this->modalFineId    = $fineId;
        $this->tglBayar       = now()->format('Y-m-d');
        $this->showModalDenda = true;
    }

    public function simpanLunasDenda(): void
    {
        $fine = Fine::find($this->modalFineId);
        if ($fine) {
            $fine->update(['status_bayar' => 'lunas', 'tgl_bayar' => $this->tglBayar]);
        }
        $this->showModalDenda = false;
        $this->modalFineId    = null;
        $this->refreshCounts();
    }

    // ── Sanksi actions ─────────────────────────────────────────────────

    public function bukaModalSanksi(int $loanId): void
    {
        $this->modalLoanId     = $loanId;
        $this->tglSelesai      = now()->format('Y-m-d');
        $this->catatanSelesai  = '';
        $this->showModalSanksi = true;
    }

    public function simpanLunasSanksi(): void
    {
        $loan = Loan::find($this->modalLoanId);
        if ($loan) {
            $loan->update([
                'status_sanksi'      => 'lunas',
                'tgl_selesai_sanksi' => $this->tglSelesai,
                'catatan_sanksi'     => $this->catatanSelesai ?: null,
            ]);
        }
        $this->showModalSanksi = false;
        $this->modalLoanId     = null;
        $this->catatanSelesai  = '';
        $this->refreshCounts();
    }

    // ── Helpers ────────────────────────────────────────────────────────

    private function refreshCounts(): void
    {
        $this->dendaBelumLunas  = Fine::where('status_bayar', 'belum_lunas')->count();
        $this->sanksiBelumLunas = Loan::where('status_sanksi', 'belum_lunas')->count();
    }
}
