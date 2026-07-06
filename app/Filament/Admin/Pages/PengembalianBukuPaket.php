<?php

namespace App\Filament\Admin\Pages;

use App\Enums\UserRole;
use App\Models\Member;
use App\Models\TextbookDistribution;
use App\Models\TextbookDistributionItem;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Collection;

class PengembalianBukuPaket extends Page
{
    protected static ?string $navigationLabel                = 'Pengembalian Buku Paket';
    protected static string|\UnitEnum|null $navigationGroup  = 'Buku Paket';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrow-uturn-left';
    protected static ?int    $navigationSort                 = 4;
    protected static ?string $slug                          = 'pengembalian-buku-paket';
    protected string         $view = 'filament.admin.pages.pengembalian-buku-paket';

    public ?int   $distributionId = null;
    public string $selectedKelas  = '';
    public array  $kelasOptions   = [];
    public array  $items          = [];   // grouped by member

    // Books list modal
    public bool $showBooksModal = false;
    public ?int $modalMemberId  = null;

    // Return modal (opened from inside books modal)
    public bool    $showReturnModal  = false;
    public ?int    $modalItemId      = null;
    public string  $modalKondisi     = 'baik';
    public string  $modalJenisSanksi = 'bayar_harga';
    public ?int    $modalNominal     = null;
    public string  $modalCatatan     = '';

    // Bulk modal
    public bool $showBulkModal = false;

    public string $error = '';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::PetugasPerpustakaan;
    }

    public function mount(): void
    {
        $id = request()->query('distribusi');
        if ($id) {
            $this->distributionId = (int) $id;
            $this->muatKelasOptions();
        }
    }

    public function getActiveDistributions(): Collection
    {
        return TextbookDistribution::where('status', 'aktif')
            ->orderBy('untuk_tingkat')
            ->orderByDesc('tgl_distribusi')
            ->get();
    }

    public function updatedDistributionId(): void
    {
        $this->selectedKelas = '';
        $this->items         = [];
        $this->error         = '';
        $this->muatKelasOptions();
    }

    private function muatKelasOptions(): void
    {
        if (! $this->distributionId) {
            $this->kelasOptions = [];
            return;
        }

        $memberIds = TextbookDistributionItem::where('distribution_id', $this->distributionId)
            ->distinct()
            ->pluck('member_id');

        $this->kelasOptions = Member::whereIn('id', $memberIds)
            ->whereNotNull('kelas')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas')
            ->toArray();
    }

    public function tampilkan(): void
    {
        if (! $this->distributionId || ! $this->selectedKelas) {
            $this->error = 'Pilih distribusi dan kelas terlebih dahulu.';
            return;
        }
        $this->error = '';
        $this->muatItems();
    }

    private function muatItems(): void
    {
        $memberIds = Member::where('kelas', $this->selectedKelas)->pluck('id');

        $rawItems = TextbookDistributionItem::where('distribution_id', $this->distributionId)
            ->whereIn('member_id', $memberIds)
            ->with(['member', 'textbookItem.textbook'])
            ->orderBy('urutan_distribusi')
            ->get();

        $this->items = $rawItems
            ->groupBy('member_id')
            ->map(function ($memberItems, $memberId) {
                $member = $memberItems->first()->member;

                $books = $memberItems->map(fn ($item) => [
                    'id'                 => $item->id,
                    'judul_buku'         => $item->textbookItem?->textbook?->judul ?? '—',
                    'kode_item'          => $item->textbookItem?->kode_item ?? '—',
                    'harga'              => $item->textbookItem?->textbook?->harga,
                    'kondisi_kembali'    => $item->kondisi_kembali,
                    'tgl_kembali_aktual' => $item->tgl_kembali_aktual?->format('d/m/Y'),
                    'jenis_sanksi'       => $item->jenis_sanksi,
                    'status_sanksi'      => $item->status_sanksi,
                ])->values()->toArray();

                $total      = count($books);
                $kembali    = collect($books)->whereNotNull('tgl_kembali_aktual')->count();
                $adaMasalah = collect($books)->filter(
                    fn ($b) => in_array($b['kondisi_kembali'], ['rusak_ringan', 'rusak_berat', 'hilang'])
                )->count();

                if ($adaMasalah > 0) {
                    $status = 'ada_masalah';
                } elseif ($kembali === 0) {
                    $status = 'belum_kembali';
                } elseif ($kembali === $total) {
                    $status = 'semua_kembali';
                } else {
                    $status = 'sebagian_kembali';
                }

                return [
                    'member_id'   => (int) $memberId,
                    'nama'        => $member?->nama ?? '—',
                    'kelas'       => $member?->kelas ?? '—',
                    'jumlah_buku' => $total,
                    'kembali'     => $kembali,
                    'status'      => $status,
                    'books'       => $books,
                ];
            })
            ->sortBy('nama')
            ->values()
            ->toArray();
    }

    // ── Books modal ──────────────────────────────────────────

    public function lihatBuku(int $memberId): void
    {
        $this->modalMemberId  = $memberId;
        $this->showBooksModal = true;
    }

    public function getModalMemberData(): ?array
    {
        if (! $this->modalMemberId) return null;
        foreach ($this->items as $item) {
            if ($item['member_id'] === $this->modalMemberId) {
                return $item;
            }
        }
        return null;
    }

    public function tutupBooksModal(): void
    {
        $this->showBooksModal = false;
        $this->modalMemberId  = null;
    }

    // ── Return modal ─────────────────────────────────────────

    public function bukaModalKembalikan(int $itemId): void
    {
        $harga = null;
        foreach ($this->items as $member) {
            foreach ($member['books'] as $book) {
                if ($book['id'] === $itemId) {
                    $harga = $book['harga'];
                    break 2;
                }
            }
        }

        $this->modalItemId      = $itemId;
        $this->modalKondisi     = 'baik';
        $this->modalJenisSanksi = 'bayar_harga';
        $this->modalNominal     = $harga;
        $this->modalCatatan     = '';
        $this->showReturnModal  = true;
        // $showBooksModal stays open — return modal layers on top
    }

    public function updatedModalKondisi(): void
    {
        if (in_array($this->modalKondisi, ['rusak_ringan', 'rusak_berat', 'hilang'])) {
            $this->modalJenisSanksi = $this->modalKondisi === 'hilang' ? 'ganti_buku' : 'bayar_harga';
        } else {
            $this->modalJenisSanksi = 'tidak_ada';
            $this->modalNominal     = null;
        }
    }

    public function simpanPengembalian(): void
    {
        $item = TextbookDistributionItem::find($this->modalItemId);
        if (! $item) { $this->showReturnModal = false; return; }

        $adaSanksi = in_array($this->modalKondisi, ['rusak_ringan', 'rusak_berat', 'hilang']);

        $item->update([
            'kondisi_kembali'    => $this->modalKondisi,
            'tgl_kembali_aktual' => today(),
            'jenis_sanksi'       => $adaSanksi ? $this->modalJenisSanksi : 'tidak_ada',
            'nominal_sanksi'     => $adaSanksi ? $this->modalNominal : null,
            'status_sanksi'      => $adaSanksi ? 'belum_lunas' : 'tidak_ada',
            'catatan'            => $this->modalCatatan ?: null,
        ]);

        $kondisiItem = match ($this->modalKondisi) {
            'rusak_ringan', 'rusak_berat' => 'rusak',
            'hilang'                      => 'hilang',
            default                       => 'baik',
        };
        $item->textbookItem?->update([
            'kondisi'      => $kondisiItem,
            'is_available' => $this->modalKondisi !== 'hilang',
        ]);

        $this->showReturnModal = false;
        // $showBooksModal stays open with refreshed data
        $this->cekDistribusiSelesai();
        $this->muatItems();

        Notification::make()->title('Pengembalian berhasil dicatat')->success()->send();
    }

    public function tutupReturnModal(): void
    {
        $this->showReturnModal = false;
    }

    // ── Bulk return ──────────────────────────────────────────

    public function kembalikanSemua(): void
    {
        $memberIds = Member::where('kelas', $this->selectedKelas)->pluck('id');

        $unret = TextbookDistributionItem::where('distribution_id', $this->distributionId)
            ->whereIn('member_id', $memberIds)
            ->whereNull('tgl_kembali_aktual')
            ->with('textbookItem')
            ->get();

        foreach ($unret as $item) {
            $item->update([
                'kondisi_kembali'    => 'baik',
                'tgl_kembali_aktual' => today(),
                'jenis_sanksi'       => 'tidak_ada',
                'status_sanksi'      => 'tidak_ada',
            ]);
            $item->textbookItem?->update(['kondisi' => 'baik', 'is_available' => true]);
        }

        $jumlahSiswa = $unret->pluck('member_id')->unique()->count();

        $this->showBulkModal  = false;
        $this->showBooksModal = false;
        $this->modalMemberId  = null;

        $this->cekDistribusiSelesai();
        $this->muatItems();

        Notification::make()
            ->title("{$unret->count()} buku dari {$jumlahSiswa} siswa berhasil dikembalikan")
            ->success()
            ->send();
    }

    // ── Helpers ──────────────────────────────────────────────

    private function cekDistribusiSelesai(): void
    {
        if (! $this->distributionId) return;
        $semua = TextbookDistributionItem::where('distribution_id', $this->distributionId)
            ->whereNull('tgl_kembali_aktual')
            ->doesntExist();
        if ($semua) {
            TextbookDistribution::find($this->distributionId)?->update(['status' => 'selesai']);
        }
    }

    public function tutupModal(): void
    {
        $this->showReturnModal = false;
        $this->showBulkModal   = false;
        $this->showBooksModal  = false;
        $this->modalMemberId   = null;
    }
}
