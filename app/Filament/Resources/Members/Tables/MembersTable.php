<?php

namespace App\Filament\Resources\Members\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class MembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_anggota')
                    ->label('Kode')
                    ->searchable()
                    ->sortable()
                    ->fontFamily('mono')
                    ->size('sm'),

                TextColumn::make('nama')
                    ->label('Nama Anggota')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->grow()
                    ->description(fn ($record) => $record->kelas ? $record->kelas : ($record->jenis === 'guru' ? 'Guru' : '—')),

                TextColumn::make('jenis')
                    ->label('Jenis')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'guru' ? 'Guru' : 'Siswa')
                    ->color(fn ($state) => $state === 'guru' ? 'warning' : 'primary'),

                TextColumn::make('no_hp')
                    ->label('No. HP')
                    ->placeholder('—')
                    ->searchable(),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),
            ])
            ->filters([
                SelectFilter::make('jenis')
                    ->label('Jenis')
                    ->options([
                        'siswa' => 'Siswa',
                        'guru'  => 'Guru',
                    ]),

                TernaryFilter::make('is_active')
                    ->label('Status')
                    ->trueLabel('Aktif')
                    ->falseLabel('Nonaktif'),
            ])
            ->recordActions([
                EditAction::make()->label('Edit'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('nama');
    }
}
