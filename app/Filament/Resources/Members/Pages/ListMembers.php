<?php

namespace App\Filament\Resources\Members\Pages;

use App\Exports\MembersTemplateExport;
use App\Exports\MembersUpdateKelasTemplateExport;
use App\Filament\Resources\Members\MemberResource;
use App\Imports\MembersImport;
use App\Imports\MembersUpdateKelasImport;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ListMembers extends ListRecords
{
    protected static string $resource = MemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),

            Action::make('importAnggota')
                ->label('Import Anggota Baru')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('success')
                ->form([
                    FileUpload::make('file')
                        ->label('File Excel')
                        ->acceptedFileTypes([
                            'application/vnd.ms-excel',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        ])
                        ->required(),
                ])
                ->action(function (array $data): void {
                    $import = new MembersImport();
                    Excel::import($import, Storage::disk('public')->path($data['file']));

                    Notification::make()
                        ->title('Import Selesai')
                        ->body("{$import->imported} anggota berhasil ditambahkan, {$import->skipped} dilewati (sudah ada).")
                        ->success()
                        ->send();
                }),

            Action::make('updateKelas')
                ->label('Update Kelas (Naik Kelas)')
                ->icon('heroicon-o-academic-cap')
                ->color('warning')
                ->form([
                    FileUpload::make('file')
                        ->label('File Excel Update Kelas')
                        ->acceptedFileTypes([
                            'application/vnd.ms-excel',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        ])
                        ->required(),
                ])
                ->action(function (array $data): void {
                    $import = new MembersUpdateKelasImport();
                    Excel::import($import, Storage::disk('public')->path($data['file']));

                    $msg = "{$import->updated} data berhasil diupdate.";
                    if ($import->notFound > 0) {
                        $msg .= " {$import->notFound} NIS tidak ditemukan: "
                            . implode(', ', $import->notFoundList);
                    }

                    Notification::make()
                        ->title('Update Kelas Selesai')
                        ->body($msg)
                        ->success()
                        ->send();
                }),

            Action::make('downloadTemplate')
                ->label('Unduh Template')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('gray')
                ->form([
                    Select::make('jenis_template')
                        ->label('Pilih Template')
                        ->options([
                            'import' => 'Template Import Anggota Baru',
                            'update' => 'Template Update Kelas',
                        ])
                        ->required(),
                ])
                ->action(function (array $data) {
                    if ($data['jenis_template'] === 'import') {
                        return Excel::download(
                            new MembersTemplateExport(),
                            'template-import-anggota.xlsx'
                        );
                    }

                    return Excel::download(
                        new MembersUpdateKelasTemplateExport(),
                        'template-update-kelas.xlsx'
                    );
                }),
        ];
    }
}
