<?php

namespace App\Filament\Resources\DistribusiBukuPakets\Tables;

use App\Filament\Resources\DistribusiBukuPakets\DistribusiBukuPaketResource;
use App\Models\TextbookDistribution;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DistribusiBukuPaketTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex()
                    ->alignCenter()
                    ->width('50px')
                    ->visibleFrom('md'),

                TextColumn::make('tahun_ajaran')
                    ->label('Tahun Ajaran')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->badge()
                    ->color('primary')
                    ->description(fn (TextbookDistribution $record) => 'Kelas ' . $record->untuk_tingkat),

                TextColumn::make('untuk_tingkat')
                    ->label('Tingkat')
                    ->badge()
                    ->formatStateUsing(fn ($state) => 'Kelas ' . $state)
                    ->color(fn ($state) => match ((int) $state) {
                        7 => 'info',
                        8 => 'success',
                        9 => 'warning',
                        default => 'gray',
                    })
                    ->sortable()
                    ->visibleFrom('md'),

                TextColumn::make('tgl_distribusi')
                    ->label('Tgl Distribusi')
                    ->date('d M Y')
                    ->sortable()
                    ->placeholder('—')
                    ->visibleFrom('md'),

                TextColumn::make('tgl_kembali_rencana')
                    ->label('Tgl Kembali')
                    ->date('d M Y')
                    ->sortable()
                    ->placeholder('—')
                    ->visibleFrom('md'),

                TextColumn::make('progres_kembali')
                    ->label('Siswa Kembali')
                    ->alignCenter()
                    ->getStateUsing(fn (TextbookDistribution $record) => $record->jumlah_kembali . '/' . $record->jumlah_siswa)
                    ->weight('semibold'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'aktif' ? 'Aktif' : 'Selesai')
                    ->color(fn ($state) => $state === 'aktif' ? 'warning' : 'success'),
            ])
            ->filters([
                SelectFilter::make('untuk_tingkat')
                    ->label('Tingkat')
                    ->options(['7' => 'Kelas 7', '8' => 'Kelas 8', '9' => 'Kelas 9']),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options(['aktif' => 'Aktif', 'selesai' => 'Selesai']),
            ])
            ->recordActions([
                Action::make('detail')
                    ->label('Detail')
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->url(fn (TextbookDistribution $record) => DistribusiBukuPaketResource::getUrl('view', ['record' => $record])),

                Action::make('pengembalian')
                    ->label('Proses Pengembalian')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('success')
                    ->visible(fn (TextbookDistribution $record) => $record->status === 'aktif')
                    ->url(fn (TextbookDistribution $record) => route('filament.admin.pages.pengembalian-buku-paket') . '?distribusi=' . $record->id),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
