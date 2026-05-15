<?php

namespace App\Filament\Resources\Fines\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class FinesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('loan.member.nama')
                    ->label('Anggota')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->description(fn ($record) => $record->loan?->member?->kode_anggota),

                TextColumn::make('loan.book.judul')
                    ->label('Buku')
                    ->searchable()
                    ->sortable()
                    ->grow()
                    ->description(fn ($record) => 'Batas: ' . $record->loan?->tgl_batas_kembali?->format('d M Y')),

                TextColumn::make('jumlah_hari')
                    ->label('Keterlambatan')
                    ->formatStateUsing(fn ($state) => $state . ' hari')
                    ->sortable(),

                TextColumn::make('nominal')
                    ->label('Nominal')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),

                TextColumn::make('status_bayar')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'lunas' ? 'Lunas' : 'Belum Lunas')
                    ->color(fn ($state) => $state === 'lunas' ? 'success' : 'danger'),

                TextColumn::make('tgl_bayar')
                    ->label('Tgl Bayar')
                    ->date('d M Y')
                    ->placeholder('—'),
            ])
            ->filters([
                SelectFilter::make('status_bayar')
                    ->label('Status')
                    ->options([
                        'belum_lunas' => 'Belum Lunas',
                        'lunas'       => 'Lunas',
                    ]),
            ])
            ->recordActions([
                EditAction::make()->label('Bayar / Edit'),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
