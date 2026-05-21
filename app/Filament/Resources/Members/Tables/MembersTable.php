<?php

namespace App\Filament\Resources\Members\Tables;

use App\Models\Member;
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
                    ->label('NIS/NIP')
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
                    ->description(fn ($record) => $record->jenis === 'guru'
                        ? 'Guru'
                        : (collect(array_filter([$record->kelas, $record->angkatan_label]))->implode(' · ') ?: '—')),

                TextColumn::make('jenis')
                    ->label('Jenis')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'guru' ? 'Guru' : 'Siswa')
                    ->color(fn ($state) => $state === 'guru' ? 'warning' : 'primary'),

                TextColumn::make('tingkat')
                    ->label('Tingkat')
                    ->badge()
                    ->getStateUsing(fn ($record) => $record->tingkat ? 'Kelas ' . $record->tingkat : '—'),

                TextColumn::make('kelas')
                    ->label('Kelas')
                    ->searchable()
                    ->sortable()
                    ->placeholder('—'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'aktif'  => 'Aktif',
                        'lulus'  => 'Lulus',
                        'pindah' => 'Pindah',
                        'keluar' => 'Keluar',
                        default  => $state,
                    })
                    ->color(fn ($state) => match ($state) {
                        'aktif'  => 'success',
                        'lulus'  => 'gray',
                        'pindah' => 'warning',
                        'keluar' => 'danger',
                        default  => 'gray',
                    }),

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
                SelectFilter::make('tahun_masuk')
                    ->label('Angkatan')
                    ->options(
                        Member::distinct('tahun_masuk')
                            ->whereNotNull('tahun_masuk')
                            ->orderByDesc('tahun_masuk')
                            ->pluck('tahun_masuk', 'tahun_masuk')
                            ->map(fn ($y) => 'Angkatan ' . $y)
                            ->toArray()
                    ),

                SelectFilter::make('kelas')
                    ->label('Kelas')
                    ->options(
                        Member::distinct('kelas')
                            ->whereNotNull('kelas')
                            ->orderBy('kelas')
                            ->pluck('kelas', 'kelas')
                            ->toArray()
                    ),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'aktif'  => 'Aktif',
                        'lulus'  => 'Lulus',
                        'pindah' => 'Pindah',
                        'keluar' => 'Keluar',
                    ]),

                SelectFilter::make('jenis')
                    ->label('Jenis Anggota')
                    ->options([
                        'siswa' => 'Siswa',
                        'guru'  => 'Guru',
                    ]),

                TernaryFilter::make('is_active')
                    ->label('Aktif')
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
