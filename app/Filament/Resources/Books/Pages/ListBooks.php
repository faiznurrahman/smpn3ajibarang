<?php

namespace App\Filament\Resources\Books\Pages;

use App\Filament\Resources\Books\BookResource;
use App\Imports\BooksImport;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ListBooks extends ListRecords
{
    protected static string $resource = BookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('downloadTemplate')
                ->label('Template Excel')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('gray')
                ->url(fn () => route('books.template'))
                ->openUrlInNewTab(),

            Action::make('import')
                ->label('Import Buku')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('gray')
                ->modalHeading('Import Data Buku dari Excel')
                ->modalDescription('Upload file Excel (.xlsx) sesuai format template. Kolom judul dan penulis wajib diisi. Buku dengan kode_buku yang sudah ada akan dilewati.')
                ->modalSubmitActionLabel('Mulai Import')
                ->form([
                    FileUpload::make('file')
                        ->label('File Excel (.xlsx)')
                        ->disk('local')
                        ->directory('tmp/book-imports')
                        ->acceptedFileTypes([
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'application/vnd.ms-excel',
                            'text/csv',
                        ])
                        ->required(),
                ])
                ->action(function (array $data) {
                    try {
                        $path   = Storage::disk('local')->path($data['file']);
                        $import = new BooksImport;

                        Excel::import($import, $path);

                        Storage::disk('local')->delete($data['file']);

                        $imported = $import->getImported();
                        $failures = $import->getFailureCount();

                        $msg = "Berhasil mengimpor {$imported} buku.";
                        if ($failures > 0) {
                            $msg .= " {$failures} baris dilewati karena validasi gagal.";
                        }

                        Notification::make()
                            ->title('Import selesai')
                            ->body($msg)
                            ->success()
                            ->send();
                    } catch (\Throwable $e) {
                        Notification::make()
                            ->title('Import gagal')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),

            CreateAction::make(),
        ];
    }
}
