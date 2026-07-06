<?php

namespace App\Filament\Resources\BookItems\Tables;

use App\Models\Book;
use App\Models\BookItem;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class BookItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_item')
                    ->label('Kode Eksemplar')
                    ->searchable()
                    ->sortable()
                    ->fontFamily('mono')
                    ->size('sm'),

                TextColumn::make('book.judul')
                    ->label('Judul Buku')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->grow()
                    ->description(fn ($record) => $record->book?->kode_buku),

                TextColumn::make('kondisi')
                    ->label('Kondisi')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'baik'   => 'success',
                        'rusak'  => 'warning',
                        'hilang' => 'danger',
                        default  => 'gray',
                    })
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'baik'   => 'Baik',
                        'rusak'  => 'Rusak',
                        'hilang' => 'Hilang',
                        default  => $state,
                    }),

                TextColumn::make('is_available')
                    ->label('Status')
                    ->badge()
                    ->color(fn (bool $state) => $state ? 'success' : 'warning')
                    ->formatStateUsing(fn (bool $state) => $state ? 'Tersedia' : 'Dipinjam'),
            ])
            ->filters([
                SelectFilter::make('kondisi')
                    ->label('Kondisi')
                    ->options([
                        'baik'   => 'Baik',
                        'rusak'  => 'Rusak',
                        'hilang' => 'Hilang',
                    ]),

                SelectFilter::make('is_available')
                    ->label('Status')
                    ->options([
                        '1' => 'Tersedia',
                        '0' => 'Dipinjam',
                    ]),

                SelectFilter::make('book_id')
                    ->label('Buku')
                    ->options(fn () => Book::where('is_active', true)->orderBy('judul')->pluck('judul', 'id')->toArray())
                    ->searchable(),
            ])
            ->recordActions([
                Action::make('editKondisi')
                    ->label('Edit Kondisi')
                    ->icon('heroicon-o-pencil-square')
                    ->color('warning')
                    ->fillForm(fn (BookItem $record) => [
                        'kondisi'      => $record->kondisi,
                        'is_available' => $record->is_available,
                        'catatan'      => $record->catatan,
                    ])
                    ->form([
                        Select::make('kondisi')
                            ->label('Kondisi')
                            ->options([
                                'baik'   => 'Baik',
                                'rusak'  => 'Rusak',
                                'hilang' => 'Hilang',
                            ])
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if (in_array($state, ['rusak', 'hilang'])) {
                                    $set('is_available', false);
                                }
                            }),

                        Toggle::make('is_available')
                            ->label('Tersedia untuk dipinjam')
                            ->disabled(fn ($get) => in_array($get('kondisi'), ['rusak', 'hilang'])),

                        Textarea::make('catatan')
                            ->label('Catatan')
                            ->placeholder('Contoh: ditemukan rusak di rak A-1')
                            ->rows(3),
                    ])
                    ->action(function (BookItem $record, array $data) {
                        $record->update([
                            'kondisi'      => $data['kondisi'],
                            'is_available' => in_array($data['kondisi'], ['rusak', 'hilang']) ? false : (bool) ($data['is_available'] ?? $record->is_available),
                            'catatan'      => $data['catatan'] ?? null,
                        ]);

                        Notification::make()
                            ->title('Kondisi eksemplar berhasil diperbarui')
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('cetakLabelTerpilih')
                        ->label('Cetak Label Terpilih')
                        ->icon(Heroicon::OutlinedPrinter)
                        ->color('gray')
                        ->action(fn (Collection $records) => redirect()->route('eksemplar.label.terpilih', [
                            'ids' => $records->pluck('id')->implode(','),
                        ]))
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->defaultSort('kode_item');
    }
}
