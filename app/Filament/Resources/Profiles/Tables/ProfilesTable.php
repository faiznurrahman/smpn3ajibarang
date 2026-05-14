<?php

namespace App\Filament\Resources\Profiles\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->width('40px'),

                TextColumn::make('updated_at')
                    ->label('Terakhir diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->grow(),
            ])
            ->recordActions([
                EditAction::make()->label('Edit'),
            ])
            ->toolbarActions([]);
    }
}
