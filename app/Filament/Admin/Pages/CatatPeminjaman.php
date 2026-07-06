<?php

namespace App\Filament\Admin\Pages;

use App\Enums\UserRole;
use App\Models\BookItem;
use App\Models\Fine;
use App\Models\Loan;
use App\Models\Member;
use Carbon\Carbon;
use Filament\Pages\Page;

class CatatPeminjaman extends Page
{
    protected static ?string $navigationLabel             = 'Catat Peminjaman';
    protected static string|\UnitEnum|null $navigationGroup  = 'Sirkulasi';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-plus';
    protected static ?int    $navigationSort              = 1;
    protected static ?string $slug                        = 'catat-peminjaman';
    protected static bool    $shouldRegisterNavigation   = false;

    protected string $view = 'filament.admin.pages.catat-peminjaman';

    // ── Stepper state ──────────────────────────────────────────────
    public int $step = 1;

    // Step 1 — Anggota
    public string $memberInput = '';
    public ?Member $member     = null;
    public string $memberError = '';

    /** @var array<int, Member> */
    public array $memberResults = [];

    // Step 2 — Eksemplar
    public string $bookInput  = '';
    public ?BookItem $bookItem = null;
    public string $bookError  = '';

    // Result / struk
    public bool  $showStruk    = false;
    public ?Loan $successLoan  = null;

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::PetugasPerpustakaan;
    }

    // ── Step 1: cari anggota ───────────────────────────────────────

    public function updatedMemberInput(): void
    {
        $this->member      = null;
        $this->memberError = '';

        $keyword = trim($this->memberInput);

        if (mb_strlen($keyword) < 3) {
            $this->memberResults = [];
            return;
        }

        $this->memberResults = Member::query()
            ->where(function ($q) use ($keyword) {
                $q->where('kode_anggota', 'like', '%' . $keyword . '%')
                    ->orWhere('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->limit(8)
            ->get()
            ->all();
    }

    public function cariAnggota(): void
    {
        $this->memberError = '';

        if (blank($this->memberInput)) {
            $this->memberError = 'Masukkan NIS/NIP atau nama anggota.';
            return;
        }

        $member = Member::where('kode_anggota', 'like', '%' . $this->memberInput . '%')
            ->orWhere('nama', 'like', '%' . $this->memberInput . '%')
            ->first();

        if (! $member) {
            $this->memberError = 'Anggota tidak ditemukan.';
            return;
        }

        $this->pilihAnggota($member->id);
    }

    public function pilihAnggota(int $memberId): void
    {
        $this->member        = null;
        $this->memberError   = '';
        $this->memberResults = [];

        $member = Member::find($memberId);

        if (! $member) {
            $this->memberError = 'Anggota tidak ditemukan.';
            return;
        }

        $this->memberInput = $member->nama;

        if ($member->status !== 'aktif') {
            $this->memberError = 'Anggota tidak aktif.';
            return;
        }

        $hasFine = Fine::whereHas('loan', fn ($q) => $q->where('member_id', $member->id))
            ->where('status_bayar', 'belum_lunas')
            ->exists();

        if ($hasFine) {
            $this->memberError = 'Masih ada denda yang belum lunas.';
            return;
        }

        $hasSanksi = Loan::where('member_id', $member->id)
            ->where('status_sanksi', 'belum_lunas')
            ->exists();

        if ($hasSanksi) {
            $this->memberError = 'Masih ada sanksi yang belum diselesaikan.';
            return;
        }

        $hasActiveLoan = Loan::where('member_id', $member->id)
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->exists();

        if ($hasActiveLoan) {
            $this->memberError = 'Anggota masih memiliki peminjaman aktif.';
            return;
        }

        $this->member = $member;
    }

    public function goToStep2(): void
    {
        if ($this->member) {
            $this->step = 2;
        }
    }

    // ── Step 2: cari eksemplar ────────────────────────────────────

    public function cariEksemplar(): void
    {
        $this->bookItem  = null;
        $this->bookError = '';

        if (blank($this->bookInput)) {
            $this->bookError = 'Masukkan kode eksemplar.';
            return;
        }

        $item = BookItem::with('book')->where('kode_item', trim($this->bookInput))->first();

        if (! $item) {
            $this->bookError = 'Eksemplar tidak ditemukan.';
            return;
        }

        if (! $item->is_available) {
            $this->bookError = 'Eksemplar sedang dipinjam.';
            return;
        }

        if ($item->kondisi === 'hilang') {
            $this->bookError = 'Eksemplar tidak tersedia.';
            return;
        }

        $this->bookItem = $item;
    }

    public function goToStep3(): void
    {
        if ($this->bookItem) {
            $this->step = 3;
        }
    }

    public function backStep(): void
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    // ── Step 3: simpan peminjaman ─────────────────────────────────

    public function simpanPeminjaman(): void
    {
        if (! $this->member || ! $this->bookItem) {
            return;
        }

        $loan = Loan::create([
            'book_id'           => $this->bookItem->book_id,
            'book_item_id'      => $this->bookItem->id,
            'member_id'         => $this->member->id,
            'tgl_pinjam'        => Carbon::today(),
            'tgl_batas_kembali' => Carbon::today()->addDays(3),
            'status'            => 'dipinjam',
            'petugas_id'        => auth()->id(),
        ]);

        $this->bookItem->update(['is_available' => false]);

        $this->successLoan = $loan->fresh(['book', 'member', 'bookItem']);
        $this->showStruk   = true;

        $this->resetStepper();
    }

    public function tutupStruk(): void
    {
        $this->showStruk   = false;
        $this->successLoan = null;
    }

    // ── Helpers ───────────────────────────────────────────────────

    protected function resetStepper(): void
    {
        $this->step         = 1;
        $this->memberInput  = '';
        $this->member       = null;
        $this->memberError  = '';
        $this->memberResults = [];
        $this->bookInput   = '';
        $this->bookItem    = null;
        $this->bookError   = '';
    }
}
