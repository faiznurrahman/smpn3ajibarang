<?php

namespace App\Filament\Resources\Visits\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class VisitTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->grow()
                    ->description(fn ($record) => implode(' · ', array_filter([
                        match ($record->jenis_pengunjung) {
                            'siswa' => $record->kelas ? 'Siswa · Kelas ' . $record->kelas : 'Siswa',
                            'guru'  => 'Guru / Staf',
                            default => 'Tamu',
                        },
                        $record->keperluan ?: null,
                        $record->jam_kunjungan ? substr($record->jam_kunjungan, 0, 5) : null,
                    ]))),

                TextColumn::make('jenis_pengunjung')
                    ->label('Jenis')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'siswa' => 'Siswa',
                        'guru'  => 'Guru',
                        'umum'  => 'Tamu',
                        default => $state,
                    })
                    ->color(fn ($state) => match ($state) {
                        'siswa' => 'primary',
                        'guru'  => 'warning',
                        default => 'gray',
                    })
                    ->visibleFrom('md'),

                TextColumn::make('keperluan')
                    ->label('Keperluan')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'Membaca'                     => 'info',
                        'Meminjam Buku'               => 'success',
                        'Mengembalikan Buku'          => 'warning',
                        'Belajar / Mengerjakan Tugas' => 'primary',
                        default                       => 'gray',
                    })
                    ->placeholder('—')
                    ->visibleFrom('sm'),

                TextColumn::make('tgl_kunjungan')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable()
                    ->placeholder('—'),

                TextColumn::make('jam_kunjungan')
                    ->label('Jam')
                    ->formatStateUsing(fn ($state) => $state ? substr($state, 0, 5) : '—')
                    ->placeholder('—')
                    ->visibleFrom('md'),
            ])
            ->filters([
                Filter::make('tgl_kunjungan')
                    ->label('Rentang Tanggal')
                    ->form([
                        DatePicker::make('dari')->label('Dari'),
                        DatePicker::make('sampai')->label('Sampai'),
                    ])
                    ->query(fn (Builder $query, array $data) => $query
                        ->when($data['dari'],   fn ($q, $v) => $q->whereDate('tgl_kunjungan', '>=', $v))
                        ->when($data['sampai'], fn ($q, $v) => $q->whereDate('tgl_kunjungan', '<=', $v))
                    ),

                SelectFilter::make('jenis_pengunjung')
                    ->label('Jenis Pengunjung')
                    ->options([
                        'siswa' => 'Siswa',
                        'guru'  => 'Guru / Staf',
                        'umum'  => 'Tamu',
                    ]),

                SelectFilter::make('keperluan')
                    ->label('Keperluan')
                    ->options([
                        'Membaca'                     => 'Membaca Buku',
                        'Meminjam Buku'               => 'Meminjam Buku',
                        'Mengembalikan Buku'          => 'Mengembalikan Buku',
                        'Belajar / Mengerjakan Tugas' => 'Belajar / Tugas',
                        'Mencari Referensi'           => 'Mencari Referensi',
                        'Lainnya'                     => 'Lainnya',
                    ]),
            ])
            ->recordActions([
                DeleteAction::make()->label('Hapus'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('tgl_kunjungan', 'desc');
    }
}
