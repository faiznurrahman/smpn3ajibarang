<?php

namespace App\Filament\Resources\SocialMedia\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class SocialMediaTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom fleksibel: ambil sisa ruang setelah kolom lain terpenuhi
                TextColumn::make('nama')
                    ->label('Platform')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->grow()
                    ->description(fn ($record) => Str::limit($record->url, 40)),

                // Jenis icon — badge, lebar tetap
                TextColumn::make('icon')
                    ->label('Jenis')
                    ->badge()
                    ->color('gray')
                    ->width('120px'),

                // Urutan — angka kecil, lebar tetap
                TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable()
                    ->alignCenter()
                    ->width('80px'),

                // Toggle aktif — lebar tetap
                ToggleColumn::make('is_active')
                    ->label('Aktif')
                    ->width('70px'),
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
            ->defaultSort('order');
    }
}
