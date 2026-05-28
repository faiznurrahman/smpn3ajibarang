<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom fleksibel — ambil sisa ruang
                TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(55)
                    ->grow()
                    ->description(fn ($record) => match ($record->type) {
                        'berita'     => 'Berita',
                        'pengumuman' => 'Pengumuman',
                        'prestasi'   => 'Prestasi',
                        default      => $record->type,
                    }),

                // Status badge — lebar tetap
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->width('100px')
                    ->color(fn (string $state): string => match ($state) {
                        'draft'     => 'gray',
                        'published' => 'success',
                        default     => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft'     => 'Draft',
                        'published' => 'Tayang',
                        default     => $state,
                    }),

                // Pin icon — lebar tetap, center
                IconColumn::make('is_pinned')
                    ->label('Pin')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-minus')
                    ->trueColor('warning')
                    ->falseColor('gray')
                    ->alignCenter()
                    ->width('60px'),

                // Tanggal — lebar tetap
                TextColumn::make('tanggal_publish')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable()
                    ->placeholder('—')
                    ->width('110px'),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Tipe')
                    ->options([
                        'berita'     => 'Berita',
                        'pengumuman' => 'Pengumuman',
                        'prestasi'   => 'Prestasi',
                    ]),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft'     => 'Draft',
                        'published' => 'Tayang',
                    ]),
            ])
            ->recordActions([
                EditAction::make()->label('Edit'),
                DeleteAction::make()->label('Hapus'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('tanggal_publish', 'desc');
    }
}
