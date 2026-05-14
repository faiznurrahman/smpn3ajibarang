<?php

namespace App\Filament\Resources\Teachers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class TeachersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->label('')
                    ->circular()
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->nama) . '&background=eef1f6&color=5a6478&bold=true&size=64')
                    ->width(36)
                    ->height(36),

                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->grow()
                    ->description(fn ($record) => collect(array_filter([
                        $record->jabatan,
                        $record->mata_pelajaran,
                    ]))->implode(' · ') ?: ($record->jenis === 'staff' ? 'Tenaga Kependidikan' : 'Tenaga Pendidik')),

                TextColumn::make('jenis')
                    ->label('Jenis')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'kepsek'  => 'Kepala Sekolah',
                        'wakasek' => 'Wakasek',
                        'staff'   => 'Staf',
                        default   => 'Guru',
                    })
                    ->color(fn ($state) => match ($state) {
                        'kepsek'  => 'warning',
                        'wakasek' => 'info',
                        'staff'   => 'gray',
                        default   => 'primary',
                    }),

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
                        'guru'    => 'Guru',
                        'wakasek' => 'Wakasek',
                        'kepsek'  => 'Kepala Sekolah',
                        'staff'   => 'Staf',
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
