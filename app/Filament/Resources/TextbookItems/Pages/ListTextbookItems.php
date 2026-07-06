<?php

namespace App\Filament\Resources\TextbookItems\Pages;

use App\Filament\Resources\TextbookItems\TextbookItemResource;
use App\Models\Textbook;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ListRecords;

class ListTextbookItems extends ListRecords
{
    protected static string $resource = TextbookItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('cetakSemuaLabel')
                ->label('Cetak Semua Label')
                ->icon('heroicon-o-printer')
                ->color('gray')
                ->requiresConfirmation()
                ->modalHeading('Cetak Semua Label Eksemplar')
                ->modalDescription('PDF akan berisi label untuk SEMUA eksemplar dari SEMUA buku paket dalam koleksi. Lanjutkan?')
                ->action(fn () => redirect()->route('eksemplar-paket.label.semua')),

            Action::make('cetakLabelPerBuku')
                ->label('Cetak Label per Buku Paket')
                ->icon('heroicon-o-book-open')
                ->color('gray')
                ->form([
                    Select::make('textbook_ids')
                        ->label('Pilih Buku Paket')
                        ->options(fn () => Textbook::orderBy('judul')->pluck('judul', 'id')->toArray())
                        ->searchable()
                        ->multiple()
                        ->required(),
                ])
                ->action(fn (array $data) => redirect()->route('eksemplar-paket.label.buku', [
                    'textbook_ids' => implode(',', $data['textbook_ids']),
                ])),
        ];
    }
}
