<?php

namespace App\Filament\Admin\Pages;

use App\Enums\UserRole;
use App\Models\BookItem;
use App\Models\Fine;
use App\Models\Loan;
use Carbon\Carbon;
use Filament\Pages\Page;

class ProsesKembaliBuku extends Page
{
    protected static ?string $slug                      = 'proses-pengembalian';
    protected static bool    $shouldRegisterNavigation  = false;

    protected string $view = 'filament.admin.pages.proses-kembali-buku';

    // ── State ─────────────────────────────────────────────────────────────
    public string  $kodeInput     = '';
    public ?Loan   $loan          = null;
    public string  $kondisi       = 'baik';
    public string  $jenisSanksi   = 'tidak_ada';
    public ?int    $nominalSanksi = null;
    public string  $catatanSanksi = '';
    public string  $error         = '';
    public bool    $showStruk     = false;
    public array   $successData   = [];

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::PetugasPerpustakaan;
    }

    public function mount(): void
    {
        $kode = request()->query('kode');

        if (filled($kode)) {
            $this->kodeInput = $kode;
            $this->cekEksemplar();
        }
    }

    // ── Cek eksemplar ──────────────────────────────────────────────────────
    public function cekEksemplar(): void
    {
        $this->loan  = null;
        $this->error = '';
        $this->resetKondisi();

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

        // Fallback: loan lama yang tidak menyimpan book_item_id
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

        $this->loan = $loan;
    }

    // ── Reaktif: update sanksi saat kondisi berubah ───────────────────────
    public function updatedKondisi($value): void
    {
        if (in_array($value, ['rusak', 'hilang'])) {
            $this->jenisSanksi   = $value === 'hilang' ? 'ganti_buku' : 'bayar_harga';
            $this->nominalSanksi = $this->loan?->book?->harga;
        } else {
            $this->jenisSanksi   = 'tidak_ada';
            $this->nominalSanksi = null;
            $this->catatanSanksi = '';
        }
    }

    // ── Simpan pengembalian ────────────────────────────────────────────────
    public function simpanPengembalian(): void
    {
        if (! $this->loan) {
            return;
        }

        $tglKembali = Carbon::today();
        $adaSanksi  = in_array($this->kondisi, ['rusak', 'hilang']);

        $this->loan->update([
            'tgl_kembali'     => $tglKembali,
            'kondisi_kembali' => $this->kondisi,
            'status'          => 'dikembalikan',
            'jenis_sanksi'    => $adaSanksi ? $this->jenisSanksi : 'tidak_ada',
            'nominal_sanksi'  => $adaSanksi ? $this->nominalSanksi : null,
            'catatan_sanksi'  => $adaSanksi ? ($this->catatanSanksi ?: null) : null,
            'status_sanksi'   => $adaSanksi ? 'belum_lunas' : 'tidak_ada',
        ]);

        // Update ketersediaan eksemplar
        if ($this->loan->bookItem) {
            $this->loan->bookItem->update([
                'is_available' => $this->kondisi !== 'hilang',
                'kondisi'      => $this->kondisi,
            ]);
        }

        // Buat denda jika terlambat
        $denda  = null;
        $isLate = $tglKembali->gt($this->loan->tgl_batas_kembali);

        if ($isLate && ! $this->loan->fine) {
            $jumlahHari = (int) $this->loan->tgl_batas_kembali->diffInDays($tglKembali);
            $nominal    = $jumlahHari * 1000;

            Fine::create([
                'loan_id'      => $this->loan->id,
                'jumlah_hari'  => $jumlahHari,
                'nominal'      => $nominal,
                'status_bayar' => 'belum_lunas',
            ]);

            $denda = ['jumlah_hari' => $jumlahHari, 'nominal' => $nominal];
        }

        // Simpan data untuk struk (loan akan di-clear)
        $this->successData = [
            'anggota'        => $this->loan->member?->nama,
            'kode_anggota'   => $this->loan->member?->kode_anggota,
            'kelas'          => $this->loan->member?->kelas,
            'buku'           => $this->loan->book?->judul,
            'kode_item'      => $this->loan->bookItem?->kode_item ?? $this->loan->book?->kode_buku,
            'tgl_pinjam'     => $this->loan->tgl_pinjam?->translatedFormat('d F Y'),
            'tgl_kembali'    => $tglKembali->translatedFormat('d F Y'),
            'kondisi'        => $this->kondisi,
            'ada_sanksi'     => $adaSanksi,
            'jenis_sanksi'   => $this->jenisSanksi,
            'nominal_sanksi' => $adaSanksi ? $this->nominalSanksi : null,
            'denda'          => $denda,
        ];

        $this->loan      = null;
        $this->showStruk = true;
    }

    // ── Tutup struk & reset form ───────────────────────────────────────────
    public function tutupStruk(): void
    {
        $this->kodeInput     = '';
        $this->loan          = null;
        $this->error         = '';
        $this->showStruk     = false;
        $this->successData   = [];
        $this->resetKondisi();
    }

    private function resetKondisi(): void
    {
        $this->kondisi       = 'baik';
        $this->jenisSanksi   = 'tidak_ada';
        $this->nominalSanksi = null;
        $this->catatanSanksi = '';
    }
}
