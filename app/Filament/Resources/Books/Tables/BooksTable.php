<?php

namespace App\Filament\Resources\Books\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class BooksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover')
                    ->label('')
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->judul) . '&background=eef1f6&color=5a6478&bold=true&size=64')
                    ->width(36)
                    ->height(48),

                TextColumn::make('kode_buku')
                    ->label('Kode')
                    ->searchable()
                    ->sortable()
                    ->fontFamily('mono')
                    ->size('sm'),

                TextColumn::make('judul')
                    ->label('Judul Buku')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->grow()
                    ->description(fn ($record) => $record->pengarang . ($record->tahun ? ' · ' . $record->tahun : '')),

                TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color('primary')
                    ->placeholder('—'),

                TextColumn::make('stok')
                    ->label('Stok')
                    ->sortable()
                    ->description(fn ($record) => 'Tersedia: ' . $record->stok_tersedia),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),
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
