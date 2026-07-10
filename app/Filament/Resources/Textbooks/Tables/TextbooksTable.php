<?php

namespace App\Filament\Resources\Textbooks\Tables;

use App\Models\Textbook;
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
            ->extraAttributes(['class' => 'tbl-textbooks'])
            ->columns([

                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex()
                    ->alignCenter()
                    ->width('50px')
                    ->visibleFrom('md'),

                TextColumn::make('kode_prefix')
                    ->label('Kode')
                    ->badge()
                    ->color('primary')
                    ->searchable()
                    ->sortable()
                    ->fontFamily('mono')
                    ->visibleFrom('md'),

                TextColumn::make('judul')
                    ->label('Judul Buku')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->grow()
                    ->wrap(false)
                    ->description(fn (Textbook $record) => $record->mata_pelajaran),

                TextColumn::make('untuk_tingkat')
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

                TextColumn::make('total_eksemplar')
                    ->label('Total')
                    ->alignCenter()
                    ->sortable()
                    ->visibleFrom('md'),

                TextColumn::make('eksemplar_tersedia')
                    ->label('Tersedia')
                    ->alignCenter()
                    ->getStateUsing(fn (Textbook $record) => $record->items()->where('is_available', true)->count())
                    ->badge()
                    ->color(fn ($state) => $state > 0 ? 'success' : 'danger'),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->visibleFrom('md'),

            ])
            ->filters([
                SelectFilter::make('untuk_tingkat')
                    ->label('Tingkat')
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
            ->toolbarActions([])
            ->defaultSort('untuk_tingkat');
    }
}
