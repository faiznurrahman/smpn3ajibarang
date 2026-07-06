<?php

namespace App\Filament\Resources\Books\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class BooksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->extraAttributes(['class' => 'tbl-katalog'])
            ->columns([
                TextColumn::make('index')
                    ->label('No')
                    ->rowIndex()
                    ->width('50px'),

                TextColumn::make('kode_buku')
                    ->label('Kode')
                    ->searchable()
                    ->sortable()
                    ->fontFamily('mono')
                    ->size('sm')
                    ->width('100px'),

                TextColumn::make('judul')
                    ->label('Judul Buku')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->grow()
                    ->wrap()
                    ->description(fn ($record) => $record->penulis . ($record->tahun ? ' · ' . $record->tahun : '')),

                TextColumn::make('no_panggil')
                    ->label('No. Panggil')
                    ->placeholder('—')
                    ->size('sm')
                    ->width('120px'),

                TextColumn::make('jumlah_eksemplar')
                    ->label('Eksemplar')
                    ->getStateUsing(fn ($record) => $record->bookItems()->count())
                    ->alignCenter()
                    ->size('sm')
                    ->width('90px'),

                TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Aktif' : 'Nonaktif')
                    ->color(fn ($state) => $state ? 'success' : 'danger')
                    ->alignCenter()
                    ->width('80px'),
            ])
            ->filters([
                SelectFilter::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'Fiksi'             => 'Fiksi',
                        'Non-Fiksi'         => 'Non-Fiksi',
                        'Pelajaran'         => 'Pelajaran',
                        'Referensi'         => 'Referensi',
                        'Ensiklopedi'       => 'Ensiklopedi',
                        'Biografi'          => 'Biografi',
                        'Sains & Teknologi' => 'Sains & Teknologi',
                        'Sosial & Budaya'   => 'Sosial & Budaya',
                        'Agama'             => 'Agama',
                        'Lainnya'           => 'Lainnya',
                    ]),

                TernaryFilter::make('is_active')
                    ->label('Status')
                    ->trueLabel('Aktif')
                    ->falseLabel('Nonaktif'),
            ])
            ->recordActions([
                EditAction::make()->label('Edit'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('judul');
    }
}
