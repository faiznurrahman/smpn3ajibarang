<?php

namespace App\Filament\Resources\PrincipalGreetings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PrincipalGreetingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->label('')
                    ->circular()
                    ->width(36)
                    ->height(36),

                TextColumn::make('nama_kepala_sekolah')
                    ->label('Nama Kepala Sekolah')
                    ->searchable()
                    ->grow(),

                TextColumn::make('updated_at')
                    ->label('Terakhir diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make()->label('Edit'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
