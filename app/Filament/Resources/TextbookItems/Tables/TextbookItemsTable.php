<?php

namespace App\Filament\Resources\TextbookItems\Tables;

use App\Models\Textbook;
use App\Models\TextbookItem;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TextbookItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex()
                    ->alignCenter()
                    ->width('50px'),

                TextColumn::make('kode_item')
                    ->label('Kode Eksemplar')
                    ->searchable()
                    ->sortable()
                    ->fontFamily('mono')
                    ->size('sm'),

                TextColumn::make('textbook.judul')
                    ->label('Judul Buku Paket')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->grow()
                    ->description(fn (TextbookItem $record) => $record->textbook?->mata_pelajaran),

                TextColumn::make('textbook.untuk_tingkat')
                    ->label('Tingkat')
                    ->badge()
                    ->formatStateUsing(fn ($state) => 'Kelas ' . $state)
                    ->color(fn ($state) => match ((int) $state) {
                        7 => 'info',
                        8 => 'success',
                        9 => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),

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

                SelectFilter::make('textbook_id')
                    ->label('Buku Paket')
                    ->options(fn () => Textbook::orderBy('judul')->pluck('judul', 'id')->toArray())
                    ->searchable(),

                SelectFilter::make('untuk_tingkat')
                    ->label('Tingkat Kelas')
                    ->options([
                        '7' => 'Kelas 7',
                        '8' => 'Kelas 8',
                        '9' => 'Kelas 9',
                    ])
                    ->query(fn (Builder $query, array $data) => filled($data['value'])
                        ? $query->whereHas('textbook', fn ($q) => $q->where('untuk_tingkat', $data['value']))
                        : $query
                    ),
            ])
            ->recordActions([
                Action::make('editKondisi')
                    ->label('Edit Kondisi')
                    ->icon('heroicon-o-pencil-square')
                    ->color('warning')
                    ->fillForm(fn (TextbookItem $record) => [
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
                                if ($state === 'hilang') {
                                    $set('is_available', false);
                                }
                            }),

                        Toggle::make('is_available')
                            ->label('Tersedia untuk dipinjam')
                            ->disabled(fn ($get) => $get('kondisi') === 'hilang'),

                        Textarea::make('catatan')
                            ->label('Catatan')
                            ->placeholder('Contoh: ditemukan rusak di rak B-2')
                            ->rows(3),
                    ])
                    ->action(function (TextbookItem $record, array $data) {
                        $record->update([
                            'kondisi'      => $data['kondisi'],
                            'is_available' => $data['kondisi'] === 'hilang'
                                ? false
                                : (bool) ($data['is_available'] ?? $record->is_available),
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
                        ->action(fn (Collection $records) => redirect()->route('eksemplar-paket.label.terpilih', [
                            'ids' => $records->pluck('id')->implode(','),
                        ]))
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->defaultSort('kode_item');
    }
}
