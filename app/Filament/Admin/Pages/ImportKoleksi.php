<?php

namespace App\Filament\Admin\Pages;

use App\Enums\UserRole;
use App\Imports\BooksImport;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ImportKoleksi extends Page
{
    use WithFileUploads;

    protected static ?string $navigationLabel             = 'Import Koleksi';
    protected static string|\UnitEnum|null $navigationGroup  = 'Koleksi';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrow-up-tray';
    protected static ?int    $navigationSort              = 3;
    protected static ?string $slug                        = 'import-koleksi';

    protected string $view = 'filament.admin.pages.import-koleksi';

    public $file            = null;
    public bool $isProcessing  = false;
    public ?int  $importedCount = null;
    public ?int  $skippedCount  = null;
    public ?int  $failureCount  = null;
    public bool  $importDone    = false;
    public bool  $importError   = false;
    public string $errorMessage = '';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::PetugasPerpustakaan;
    }

    public function mount(): void
    {
        $this->file          = null;
        $this->isProcessing  = false;
        $this->importDone    = false;
        $this->importError   = false;
        $this->importedCount = null;
        $this->skippedCount  = null;
        $this->failureCount  = null;
        $this->errorMessage  = '';
        $this->resetErrorBag();
    }

    public function import(): void
    {
        $this->resetErrorBag();

        $this->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls', 'max:2048'],
        ], [
            'file.required' => 'Pilih file Excel terlebih dahulu.',
            'file.mimes'    => 'File harus berformat .xlsx atau .xls.',
            'file.max'      => 'Ukuran file tidak boleh lebih dari 2 MB.',
        ]);

        $this->isProcessing = true;

        try {
            $path   = $this->file->getRealPath();
            $import = new BooksImport;

            Excel::import($import, $path);

            $this->importedCount = $import->getImported();
            $this->failureCount  = $import->getFailureCount();
            $this->skippedCount  = $import->getSkipped();
            $this->importDone    = true;
            $this->importError   = false;
            $this->file          = null;

            Notification::make()
                ->title('Import selesai')
                ->body("Berhasil mengimpor {$this->importedCount} buku.")
                ->success()
                ->send();
        } catch (\Throwable $e) {
            $this->importError  = true;
            $this->importDone   = false;
            $this->errorMessage = $e->getMessage();

            Notification::make()
                ->title('Import gagal')
                ->body($e->getMessage())
                ->danger()
                ->send();
        } finally {
            $this->isProcessing = false;
        }
    }

    public function resetForm(): void
    {
        $this->file          = null;
        $this->isProcessing  = false;
        $this->importDone    = false;
        $this->importError   = false;
        $this->importedCount = null;
        $this->skippedCount  = null;
        $this->failureCount  = null;
        $this->errorMessage  = '';
        $this->resetErrorBag();
    }
}
