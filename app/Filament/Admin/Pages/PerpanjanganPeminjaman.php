<?php

namespace App\Filament\Admin\Pages;

use App\Enums\UserRole;
use App\Models\BookItem;
use App\Models\Fine;
use App\Models\Loan;
use Carbon\Carbon;
use Filament\Pages\Page;

class PerpanjanganPeminjaman extends Page
{
    protected static ?string $navigationLabel            = 'Perpanjangan';
    protected static string|\UnitEnum|null $navigationGroup = 'Sirkulasi';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrow-path';
    protected static ?int    $navigationSort             = 2;
    protected static ?string $slug                       = 'perpanjangan';
    protected static bool    $shouldRegisterNavigation  = true;

    protected string $view = 'filament.admin.pages.perpanjangan-peminjaman';

    // ── State ─────────────────────────────────────────────────────────
    public string  $kodeInput    = '';
    public ?Loan   $loan         = null;
    public int     $durasiDipilih = 3;
    public string  $error        = '';
    public bool    $sukses       = false;

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::PetugasPerpustakaan;
    }

    // ── Cek eksemplar ──────────────────────────────────────────────────
    public function cekEksemplar(): void
    {
        $this->loan   = null;
        $this->error  = '';
        $this->sukses = false;

        if (blank($this->kodeInput)) {
            $this->error = 'Masukkan kode eksemplar.';
            return;
        }

        $item = BookItem::where('kode_item', trim($this->kodeInput))->first();

        if (! $item) {
            $this->error = 'Eksemplar tidak ditemukan.';
            return;
        }

        // Cari berdasarkan book_item_id eksak terlebih dahulu
        $loan = Loan::with(['member', 'book', 'bookItem', 'fine'])
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->where('book_item_id', $item->id)
            ->latest('tgl_pinjam')
            ->first();

        // Fallback: loan lama yang tidak menyimpan book_item_id (sebelum fitur tracking eksemplar)
        if (! $loan) {
            $loan = Loan::with(['member', 'book', 'bookItem', 'fine'])
                ->whereIn('status', ['dipinjam', 'terlambat'])
                ->where('book_id', $item->book_id)
                ->whereNull('book_item_id')
                ->latest('tgl_pinjam')
                ->first();
        }

        if (! $loan) {
            $this->error = 'Tidak ada peminjaman aktif untuk eksemplar ini.';
            return;
        }

        if ($loan->jumlah_perpanjangan >= 2) {
            $this->error = 'Sudah mencapai batas maksimal perpanjangan (2x).';
            return;
        }

        $hasFine = Fine::where('loan_id', $loan->id)
            ->where('status_bayar', 'belum_lunas')
            ->exists();

        if ($hasFine) {
            $this->error = 'Masih ada denda belum lunas.';
            return;
        }

        $this->loan = $loan;
    }

    // ── Simpan perpanjangan ────────────────────────────────────────────
    public function simpanPerpanjangan(): void
    {
        if (! $this->loan) {
            return;
        }

        $tglBaru = $this->loan->tgl_batas_kembali->addDays($this->durasiDipilih);

        $this->loan->update([
            'tgl_batas_kembali'         => $tglBaru,
            'jumlah_perpanjangan'       => $this->loan->jumlah_perpanjangan + 1,
            'tgl_perpanjangan_terakhir' => Carbon::today(),
            'status'                    => 'dipinjam',
        ]);

        $this->sukses = true;
        $this->loan   = $this->loan->fresh(['member', 'book', 'bookItem', 'fine']);
    }

    // ── Reset form ─────────────────────────────────────────────────────
    public function resetForm(): void
    {
        $this->kodeInput    = '';
        $this->loan         = null;
        $this->durasiDipilih = 3;
        $this->error        = '';
        $this->sukses       = false;
    }
}
