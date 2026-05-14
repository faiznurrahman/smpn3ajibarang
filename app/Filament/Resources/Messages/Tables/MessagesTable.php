<?php

namespace App\Filament\Resources\Messages\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('is_read')
                    ->label('')
                    ->boolean()
                    ->trueIcon('heroicon-o-envelope-open')
                    ->falseIcon('heroicon-o-envelope')
                    ->trueColor('gray')
                    ->falseColor('warning')
                    ->width('40px'),

                TextColumn::make('nama')
                    ->label('Pengirim')
                    ->searchable()
                    ->sortable()
                    ->weight(fn ($record) => $record->is_read ? null : 'semibold')
                    ->description(fn ($record) => $record->email ?: $record->nomor_telepon ?: '—'),

                TextColumn::make('subjek')
                    ->label('Subjek')
                    ->searchable()
                    ->limit(50)
                    ->grow()
                    ->placeholder('(tanpa subjek)'),

                TextColumn::make('created_at')
                    ->label('Dikirim')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('belum_dibaca')
                    ->label('Belum Dibaca')
                    ->query(fn (Builder $query) => $query->where('is_read', false)),
            ])
            ->recordActions([
                ViewAction::make()->label('Baca'),
            ])
            ->toolbarActions([])
            ->defaultSort('created_at', 'desc');
    }
}
