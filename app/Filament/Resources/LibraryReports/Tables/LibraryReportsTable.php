<?php

namespace App\Filament\Resources\LibraryReports\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LibraryReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('member.nama')
                    ->label('Anggota')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->description(fn ($record) => $record->member?->kode_anggota),

                TextColumn::make('book.judul')
                    ->label('Buku')
                    ->searchable()
                    ->sortable()
                    ->grow()
                    ->description(fn ($record) => $record->book?->kode_buku),

                TextColumn::make('tgl_pinjam')
                    ->label('Tgl Pinjam')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('tgl_kembali')
                    ->label('Tgl Kembali')
                    ->date('d M Y')
                    ->placeholder('—'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'dipinjam'    => 'Dipinjam',
                        'dikembalikan' => 'Dikembalikan',
                        'terlambat'   => 'Terlambat',
                        default       => $state,
                    })
                    ->color(fn ($state) => match ($state) {
                        'dipinjam'    => 'warning',
                        'dikembalikan' => 'success',
                        'terlambat'   => 'danger',
                        default       => 'gray',
                    }),

                TextColumn::make('fine.nominal')
                    ->label('Denda')
                    ->formatStateUsing(fn ($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : '—')
                    ->placeholder('—'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'dipinjam'    => 'Dipinjam',
                        'dikembalikan' => 'Dikembalikan',
                        'terlambat'   => 'Terlambat',
                    ]),
            ])
            ->defaultSort('tgl_pinjam', 'desc');
    }
}
