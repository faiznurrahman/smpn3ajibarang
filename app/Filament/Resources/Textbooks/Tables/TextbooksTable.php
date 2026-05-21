<?php

namespace App\Filament\Resources\Textbooks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class TextbooksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_prefix')
                    ->label('Kode')
                    ->badge()
                    ->color('primary')
                    ->searchable()
                    ->sortable()
                    ->fontFamily('mono'),

                TextColumn::make('judul')
                    ->label('Judul Buku')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->grow()
                    ->description(fn ($record) => $record->mata_pelajaran),

                TextColumn::make('untuk_tingkat')
                    ->label('Kelas')
                    ->badge()
                    ->formatStateUsing(fn ($state) => 'Kelas ' . $state)
                    ->color('info')
                    ->sortable(),

                TextColumn::make('total_eksemplar')
                    ->label('Total')
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('stok_tersedia')
                    ->label('Tersedia')
                    ->alignCenter()
                    ->getStateUsing(fn ($record) => $record->items()->where('is_available', true)->count())
                    ->badge()
                    ->color(fn ($state) => $state > 0 ? 'success' : 'danger'),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),
            ])
            ->filters([
                SelectFilter::make('untuk_tingkat')
                    ->label('Kelas')
                    ->options([
                        '7' => 'Kelas 7',
                        '8' => 'Kelas 8',
                        '9' => 'Kelas 9',
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
            ->defaultSort('untuk_tingkat');
    }
}
