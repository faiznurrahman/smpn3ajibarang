<?php

namespace App\Filament\Admin\Pages;

use App\Enums\UserRole;
use App\Models\Loan;
use Filament\Pages\Page;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class HalamanPeminjaman extends Page
{
    protected static ?string $navigationLabel            = 'Peminjaman';
    protected static string|\UnitEnum|null $navigationGroup = 'Sirkulasi';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrow-right-on-rectangle';
    protected static ?int    $navigationSort             = 1;
    protected static ?string $slug                       = 'peminjaman';

    protected string $view = 'filament.admin.pages.halaman-peminjaman';

    // ── State ──────────────────────────────────────────────────────
    public string $activeTab      = 'aktif';
    public string $search         = '';
    public int    $page           = 1;
    public int    $perPage        = 10;
    public int    $aktifCount     = 0;
    public int    $terlambatCount = 0;

    // ── Modal detail ───────────────────────────────────────────────
    public bool $showModalDetail = false;
    public ?int $modalLoanId     = null;

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::PetugasPerpustakaan;
    }

    public static function getNavigationBadge(): ?string
    {
        $count = Loan::where('status', 'dipinjam')->count();
        return $count ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): string
    {
        return 'primary';
    }

    public function mount(): void
    {
        $this->aktifCount     = Loan::where('status', 'dipinjam')->count();
        $this->terlambatCount = Loan::where('status', 'terlambat')->count();
    }

    // ── Data ────────────────────────────────────────────────────────

    public function getData(): LengthAwarePaginator
    {
        $q = Loan::with(['member', 'book'])->latest('created_at');

        match ($this->activeTab) {
            'aktif'     => $q->where('status', 'dipinjam'),
            'terlambat' => $q->where('status', 'terlambat'),
            default     => $q->where('status', '!=', 'dikembalikan'),
        };

        if (trim($this->search) !== '') {
            $s = $this->search;
            $q->where(fn ($q2) => $q2
                ->whereHas('member', fn ($m) => $m->where('nama', 'like', "%{$s}%"))
                ->orWhereHas('book', fn ($b) => $b->where('judul', 'like', "%{$s}%"))
            );
        }

        return $q->paginate($this->perPage, ['*'], 'pmj_page', $this->page);
    }

    public function getLoanDetail(): ?Loan
    {
        if (! $this->modalLoanId) {
            return null;
        }
        return Loan::with(['member', 'book', 'bookItem', 'fine', 'petugas'])
            ->find($this->modalLoanId);
    }

    // ── Lifecycle ───────────────────────────────────────────────────

    public function updatedSearch(): void
    {
        $this->page = 1;
    }

    public function updatedActiveTab(): void
    {
        $this->page = 1;
    }

    // ── Pagination ──────────────────────────────────────────────────

    public function nextPage(): void
    {
        $this->page++;
    }

    public function prevPage(): void
    {
        if ($this->page > 1) {
            $this->page--;
        }
    }

    // ── Modal actions ────────────────────────────────────────────────

    public function bukaDetail(int $loanId): void
    {
        $this->modalLoanId     = $loanId;
        $this->showModalDetail = true;
    }

    public function tutupDetail(): void
    {
        $this->showModalDetail = false;
        $this->modalLoanId     = null;
    }
}
