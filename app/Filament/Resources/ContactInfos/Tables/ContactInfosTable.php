<?php

namespace App\Filament\Resources\ContactInfos\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactInfosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_telepon')
                    ->label('Telepon')
                    ->placeholder('—'),

                TextColumn::make('email')
                    ->label('Email')
                    ->grow()
                    ->placeholder('—'),

                TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(60)
                    ->grow()
                    ->placeholder('—'),
            ])
            ->recordActions([
                EditAction::make()->label('Edit'),
            ])
            ->toolbarActions([]);
    }
}
