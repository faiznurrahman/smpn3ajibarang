<?php

namespace App\Filament\Admin\Pages;

use App\Enums\UserRole;
use App\Imports\MembersImport;
use App\Imports\MembersUpdateKelasImport;
use App\Models\Member;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class KelolaAnggota extends Page
{
    use WithFileUploads;

    protected static ?string $navigationLabel                = 'Kelola Anggota';
    protected static string|\UnitEnum|null $navigationGroup  = 'Keanggotaan';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-group';
    protected static ?int    $navigationSort                 = 2;
    protected static ?string $slug                          = 'kelola-anggota';

    protected string $view = 'filament.admin.pages.kelola-anggota';

    // Section 1 — Import Siswa
    public $importFile            = null;
    public bool $importProcessing = false;
    public bool $importDone       = false;
    public bool $importError      = false;
    public ?int  $importedCount   = null;
    public ?int  $skippedCount    = null;
    public string $importErrMsg   = '';

    // Section 2 — Update Kelas
    public $updateFile            = null;
    public bool $updateProcessing = false;
    public bool $updateDone       = false;
    public bool $updateError      = false;
    public ?int  $updatedCount    = null;
    public ?int  $notFoundCount   = null;
    public array $notFoundList    = [];
    public string $updateErrMsg   = '';

    // Section 3 — Kelulusan
    public string $selectedAngkatan   = '';
    public ?int   $angkatanSiswaCount = null;
    public array  $angkatanOptions    = [];

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::PetugasPerpustakaan;
    }

    public function mount(): void
    {
        $this->importFile      = null;
        $this->importProcessing = false;
        $this->importDone      = false;
        $this->importError     = false;
        $this->importedCount   = null;
        $this->skippedCount    = null;
        $this->importErrMsg    = '';

        $this->updateFile      = null;
        $this->updateProcessing = false;
        $this->updateDone      = false;
        $this->updateError     = false;
        $this->updatedCount    = null;
        $this->notFoundCount   = null;
        $this->notFoundList    = [];
        $this->updateErrMsg    = '';

        $this->selectedAngkatan   = '';
        $this->angkatanSiswaCount = null;

        $this->resetErrorBag();
        $this->loadAngkatanOptions();
    }

    private function loadAngkatanOptions(): void
    {
        $this->angkatanOptions = Member::query()
            ->where('jenis', 'siswa')
            ->where('status', 'aktif')
            ->whereNotNull('tahun_masuk')
            ->select('tahun_masuk', DB::raw('count(*) as total'))
            ->groupBy('tahun_masuk')
            ->orderByDesc('tahun_masuk')
            ->get()
            ->mapWithKeys(fn ($r) => [
                (string) $r->tahun_masuk => "Angkatan {$r->tahun_masuk} — {$r->total} siswa aktif",
            ])
            ->toArray();
    }

    // ─── Section 1 ───────────────────────────────────────────

    public function importSiswa(): void
    {
        $this->resetErrorBag();
        $this->validate([
            'importFile' => ['required', 'file', 'mimes:xlsx,xls', 'max:2048'],
        ], [
            'importFile.required' => 'Pilih file Excel terlebih dahulu.',
            'importFile.mimes'    => 'File harus berformat .xlsx atau .xls.',
            'importFile.max'      => 'Ukuran file tidak boleh lebih dari 2 MB.',
        ]);

        $this->importProcessing = true;

        try {
            $path   = $this->importFile->getRealPath();
            $import = new MembersImport;
            Excel::import($import, $path);

            $this->importedCount = $import->imported;
            $this->skippedCount  = $import->skipped;
            $this->importDone    = true;
            $this->importError   = false;
            $this->importFile    = null;

            Notification::make()
                ->title('Import Selesai')
                ->body("{$this->importedCount} siswa ditambahkan, {$this->skippedCount} dilewati.")
                ->success()
                ->send();
        } catch (\Throwable $e) {
            $this->importError  = true;
            $this->importDone   = false;
            $this->importErrMsg = $e->getMessage();

            Notification::make()
                ->title('Import Gagal')
                ->body($e->getMessage())
                ->danger()
                ->send();
        } finally {
            $this->importProcessing = false;
        }
    }

    public function resetImportForm(): void
    {
        $this->importFile      = null;
        $this->importProcessing = false;
        $this->importDone      = false;
        $this->importError     = false;
        $this->importedCount   = null;
        $this->skippedCount    = null;
        $this->importErrMsg    = '';
        $this->resetErrorBag();
    }

    // ─── Section 2 ───────────────────────────────────────────

    public function updateKelas(): void
    {
        $this->resetErrorBag();
        $this->validate([
            'updateFile' => ['required', 'file', 'mimes:xlsx,xls', 'max:2048'],
        ], [
            'updateFile.required' => 'Pilih file Excel terlebih dahulu.',
            'updateFile.mimes'    => 'File harus berformat .xlsx atau .xls.',
            'updateFile.max'      => 'Ukuran file tidak boleh lebih dari 2 MB.',
        ]);

        $this->updateProcessing = true;

        try {
            $path   = $this->updateFile->getRealPath();
            $import = new MembersUpdateKelasImport;
            Excel::import($import, $path);

            $this->updatedCount  = $import->updated;
            $this->notFoundCount = $import->notFound;
            $this->notFoundList  = $import->notFoundList;
            $this->updateDone    = true;
            $this->updateError   = false;
            $this->updateFile    = null;

            Notification::make()
                ->title('Update Kelas Selesai')
                ->body("{$this->updatedCount} data kelas berhasil diperbarui.")
                ->success()
                ->send();
        } catch (\Throwable $e) {
            $this->updateError  = true;
            $this->updateDone   = false;
            $this->updateErrMsg = $e->getMessage();

            Notification::make()
                ->title('Update Kelas Gagal')
                ->body($e->getMessage())
                ->danger()
                ->send();
        } finally {
            $this->updateProcessing = false;
        }
    }

    public function resetUpdateForm(): void
    {
        $this->updateFile      = null;
        $this->updateProcessing = false;
        $this->updateDone      = false;
        $this->updateError     = false;
        $this->updatedCount    = null;
        $this->notFoundCount   = null;
        $this->notFoundList    = [];
        $this->updateErrMsg    = '';
        $this->resetErrorBag();
    }

    // ─── Section 3 ───────────────────────────────────────────

    public function updatedSelectedAngkatan(string $value): void
    {
        if ($value !== '') {
            $this->angkatanSiswaCount = Member::where('jenis', 'siswa')
                ->where('tahun_masuk', $value)
                ->where('status', 'aktif')
                ->count();
        } else {
            $this->angkatanSiswaCount = null;
        }
    }

    public function luluskanAngkatan(): void
    {
        if ($this->selectedAngkatan === '') return;

        $angkatan = $this->selectedAngkatan;

        $count = Member::where('jenis', 'siswa')
            ->where('tahun_masuk', $angkatan)
            ->where('status', 'aktif')
            ->update(['status' => 'lulus', 'is_active' => false]);

        $this->selectedAngkatan   = '';
        $this->angkatanSiswaCount = null;
        $this->loadAngkatanOptions();

        Notification::make()
            ->title('Angkatan Diluluskan')
            ->body("{$count} siswa angkatan {$angkatan} berhasil diluluskan.")
            ->success()
            ->send();
    }
}
