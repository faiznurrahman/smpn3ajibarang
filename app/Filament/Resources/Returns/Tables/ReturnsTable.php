<?php

namespace App\Filament\Resources\Returns\Tables;

use App\Models\Fine;
use App\Models\Loan;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ReturnsTable
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

                TextColumn::make('tgl_batas_kembali')
                    ->label('Batas Kembali')
                    ->date('d M Y')
                    ->sortable()
                    ->description(fn ($record) => $record->isLate()
                        ? 'Terlambat ' . $record->jumlahHariTerlambat() . ' hari'
                        : null)
                    ->color(fn ($record) => $record->isLate() ? 'danger' : null),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'terlambat' ? 'Terlambat' : 'Dipinjam')
                    ->color(fn ($state) => $state === 'terlambat' ? 'danger' : 'warning'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'dipinjam'  => 'Dipinjam',
                        'terlambat' => 'Terlambat',
                    ]),
            ])
            ->recordActions([
                Action::make('kembalikan')
                    ->label('Kembalikan')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('success')
                    ->form([
                        DatePicker::make('tgl_kembali')
                            ->label('Tanggal Dikembalikan')
                            ->default(today()->format('Y-m-d'))
                            ->required(),
                    ])
                    ->action(function (Loan $record, array $data) {
                        $tglKembali = Carbon::parse($data['tgl_kembali']);
                        $isLate     = $tglKembali->gt($record->tgl_batas_kembali);

                        $record->update([
                            'tgl_kembali' => $tglKembali->toDateString(),
                            'status'      => $isLate ? 'terlambat' : 'dikembalikan',
                        ]);

                        if ($isLate && ! $record->fine) {
                            $jumlahHari = (int) $record->tgl_batas_kembali->diffInDays($tglKembali);
                            Fine::create([
                                'loan_id'     => $record->id,
                                'jumlah_hari' => $jumlahHari,
                                'nominal'     => $jumlahHari * 1000,
                                'status_bayar' => 'belum_lunas',
                            ]);
                        }

                        Notification::make()
                            ->title($isLate ? 'Buku dikembalikan — ada denda keterlambatan' : 'Buku berhasil dikembalikan')
                            ->color($isLate ? 'warning' : 'success')
                            ->send();
                    }),
            ])
            ->defaultSort('tgl_batas_kembali', 'asc');
    }
}
