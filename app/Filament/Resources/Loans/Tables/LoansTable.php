<?php

namespace App\Filament\Resources\Loans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LoansTable
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
                    ->description(fn ($record) => $record->member?->kelas ?? $record->member?->jenis),

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

                TextColumn::make('tgl_batas_kembali')
                    ->label('Batas Kembali')
                    ->date('d M Y')
                    ->sortable(),

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
            ->recordActions([
                EditAction::make()->label('Edit'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
