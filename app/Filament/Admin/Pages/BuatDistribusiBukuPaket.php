<?php

namespace App\Filament\Admin\Pages;

use App\Enums\UserRole;
use App\Models\Member;
use App\Models\Textbook;
use App\Models\TextbookDistribution;
use App\Models\TextbookItem;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class BuatDistribusiBukuPaket extends Page
{
    protected static bool    $shouldRegisterNavigation = false;
    protected static ?string $slug                     = 'distribusi-baru';
    protected string         $view = 'filament.admin.pages.buat-distribusi-buku-paket';

    public int    $step              = 1;
    public string $tahunAjaran       = '';
    public string $untukTingkat      = '7';
    public string $tglDistribusi     = '';
    public string $tglKembaliRencana = '';
    public int    $jumlahSiswa       = 0;
    public string $formatError       = '';
    public array  $availableTextbooks = [];
    public array  $selectedTextbooks  = [];
    public string $error             = '';
    public array  $warnings          = [];

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::PetugasPerpustakaan;
    }

    public function mount(): void
    {
        $this->tglDistribusi = today()->format('Y-m-d');
        $this->hitungSiswa();
    }

    public function updatedUntukTingkat(): void { $this->hitungSiswa(); }

    private function hitungSiswa(): void
    {
        $this->jumlahSiswa = 0;
        $this->formatError = '';

        if (! $this->untukTingkat || empty($this->tahunAjaran)) {
            return;
        }

        if (! preg_match('/^\d{4}\/\d{4}$/', $this->tahunAjaran)) {
            $this->formatError = 'Format tahun ajaran tidak valid. Gunakan format YYYY/YYYY, contoh: 2026/2027';
            return;
        }

        $this->jumlahSiswa = Member::where('jenis', 'siswa')
            ->where('status', 'aktif')
            ->where('is_active', true)
            ->where('kelas', 'LIKE', $this->untukTingkat . '%')
            ->count();
    }

    public function lanjut(): void
    {
        $this->validate([
            'tahunAjaran'   => 'required|regex:/^\d{4}\/\d{4}$/',
            'untukTingkat'  => 'required|in:7,8,9',
            'tglDistribusi' => 'required|date',
        ], [
            'tahunAjaran.required'   => 'Tahun ajaran wajib diisi.',
            'tahunAjaran.regex'      => 'Format tahun ajaran: 2026/2027',
            'untukTingkat.required'  => 'Pilih tingkat kelas.',
            'tglDistribusi.required' => 'Tanggal distribusi wajib diisi.',
        ]);

        $this->hitungSiswa();

        $this->availableTextbooks = Textbook::where('is_active', true)
            ->where('untuk_tingkat', (int) $this->untukTingkat)
            ->orderBy('mata_pelajaran')
            ->get()
            ->map(fn ($t) => [
                'id'             => $t->id,
                'kode_prefix'    => $t->kode_prefix,
                'judul'          => $t->judul,
                'mata_pelajaran' => $t->mata_pelajaran,
                'tersedia'       => $t->items()->where('is_available', true)->count(),
            ])
            ->toArray();

        $this->selectedTextbooks = array_column($this->availableTextbooks, 'id');
        $this->warnings = [];

        foreach ($this->availableTextbooks as $tb) {
            if ($tb['tersedia'] < $this->jumlahSiswa) {
                $this->warnings[] = "⚠ {$tb['judul']}: hanya {$tb['tersedia']} eksemplar tersedia (siswa: {$this->jumlahSiswa})";
            }
        }

        $this->step  = 2;
        $this->error = '';
    }

    public function kembali(): void
    {
        $this->step  = 1;
        $this->error = '';
    }

    public function toggleTextbook(int $id): void
    {
        if (in_array($id, $this->selectedTextbooks)) {
            $this->selectedTextbooks = array_values(array_filter($this->selectedTextbooks, fn ($v) => $v !== $id));
        } else {
            $this->selectedTextbooks[] = $id;
        }
    }

    public function distribusikan(): void
    {
        if (empty($this->selectedTextbooks)) {
            $this->error = 'Pilih minimal satu buku paket untuk didistribusikan.';
            return;
        }

        $members = Member::where('jenis', 'siswa')
            ->where('status', 'aktif')
            ->where('is_active', true)
            ->where('kelas', 'LIKE', $this->untukTingkat . '%')
            ->orderBy('kelas')
            ->orderBy('nama')
            ->get();

        if ($members->isEmpty()) {
            $this->error = "Tidak ada siswa aktif untuk Kelas {$this->untukTingkat}. Pastikan data anggota sudah diimport.";
            return;
        }

        $distribution = TextbookDistribution::create([
            'tahun_ajaran'        => $this->tahunAjaran,
            'untuk_tingkat'       => (string) $this->untukTingkat,
            'tgl_distribusi'      => $this->tglDistribusi,
            'tgl_kembali_rencana' => $this->tglKembaliRencana ?: null,
            'status'              => 'aktif',
            'petugas_id'          => auth()->id(),
        ]);

        foreach ($this->selectedTextbooks as $textbookId) {
            $items = TextbookItem::where('textbook_id', $textbookId)
                ->where('is_available', true)
                ->orderBy('kode_item')
                ->get();

            foreach ($members as $index => $member) {
                $item = $items[$index] ?? null;
                if (! $item) break;

                $distribution->distributionItems()->create([
                    'member_id'         => $member->id,
                    'textbook_item_id'  => $item->id,
                    'urutan_distribusi' => $index + 1,
                ]);

                $item->update(['is_available' => false]);
            }
        }

        Notification::make()
            ->title('Distribusi berhasil dibuat')
            ->success()
            ->send();

        $this->redirect(route('filament.admin.resources.distribusi-buku-paket.index'));
    }
}
