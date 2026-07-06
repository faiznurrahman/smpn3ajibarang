<?php

namespace App\Filament\Resources\BookItems\Pages;

use App\Filament\Resources\BookItems\BookItemResource;
use App\Models\Book;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ListRecords;

class ListBookItems extends ListRecords
{
    protected static string $resource = BookItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('cetakSemuaLabel')
                ->label('Cetak Semua Label')
                ->icon('heroicon-o-printer')
                ->color('gray')
                ->requiresConfirmation()
                ->modalHeading('Cetak Semua Label Eksemplar')
                ->modalDescription('PDF akan berisi label untuk SEMUA eksemplar dari SEMUA buku dalam koleksi. Lanjutkan?')
                ->action(fn () => redirect()->route('eksemplar.label.semua')),

            Action::make('cetakLabelPerBuku')
                ->label('Cetak Label per Buku')
                ->icon('heroicon-o-book-open')
                ->color('gray')
                ->form([
                    Select::make('book_ids')
                        ->label('Pilih Buku')
                        ->options(fn () => Book::where('is_active', true)->orderBy('judul')->pluck('judul', 'id')->toArray())
                        ->searchable()
                        ->multiple()
                        ->required(),
                ])
                ->action(fn (array $data) => redirect()->route('eksemplar.label.buku', [
                    'book_ids' => implode(',', $data['book_ids']),
                ])),
        ];
    }
}
