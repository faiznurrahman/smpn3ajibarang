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
                // Kolom status: icon kecil, hanya penanda
                IconColumn::make('is_read')
                    ->label('')
                    ->boolean()
                    ->trueIcon('heroicon-o-envelope-open')
                    ->falseIcon('heroicon-s-envelope')
                    ->trueColor('gray')
                    ->falseColor('warning')
                    ->width('40px'),

                // Pengirim + email/no HP sebagai deskripsi (satu baris pendek)
                TextColumn::make('nama')
                    ->label('Pengirim')
                    ->searchable()
                    ->sortable()
                    ->weight(fn ($record) => $record->is_read ? null : 'bold')
                    ->description(fn ($record) => $record->email ?: ($record->nomor_telepon ?: '—')),

                // Subjek saja — tanpa cuplikan pesan supaya baris tidak bertumpuk
                TextColumn::make('subjek')
                    ->label('Subjek')
                    ->searchable()
                    ->grow()
                    ->weight(fn ($record) => $record->is_read ? null : 'semibold')
                    ->placeholder('(tanpa subjek)')
                    ->limit(60),

                // Tanggal ringkas
                TextColumn::make('created_at')
                    ->label('Dikirim')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->color('gray'),
            ])

            // Tandai baris unread/read untuk highlight CSS
            ->recordClasses(fn ($record) => ! $record->is_read ? 'msg-unread' : 'msg-read')

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
