<?php

namespace App\Filament\Resources\Sanksis\Tables;

use App\Models\Loan;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SanksiTable
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

                TextColumn::make('kondisi_kembali')
                    ->label('Kondisi')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'baik'   => 'Baik',
                        'rusak'  => 'Rusak',
                        'hilang' => 'Hilang',
                        default  => '—',
                    })
                    ->color(fn ($state) => match ($state) {
                        'baik'   => 'success',
                        'rusak'  => 'warning',
                        'hilang' => 'danger',
                        default  => 'gray',
                    }),

                TextColumn::make('jenis_sanksi')
                    ->label('Jenis Sanksi')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'ganti_buku'  => 'Ganti Buku',
                        'bayar_harga' => 'Bayar Harga Buku',
                        default       => '—',
                    })
                    ->color(fn ($state) => match ($state) {
                        'ganti_buku'  => 'warning',
                        'bayar_harga' => 'danger',
                        default       => 'gray',
                    }),

                TextColumn::make('catatan_sanksi')
                    ->label('Catatan')
                    ->limit(60)
                    ->placeholder('—'),

                TextColumn::make('tgl_kembali')
                    ->label('Tgl Dikembalikan')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('status_sanksi')
                    ->label('Status Sanksi')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'tidak_ada'   => 'Tidak Ada',
                        'belum_lunas' => 'Belum Lunas',
                        'lunas'       => 'Lunas',
                        default       => '—',
                    })
                    ->color(fn ($state) => match ($state) {
                        'tidak_ada'   => 'gray',
                        'belum_lunas' => 'danger',
                        'lunas'       => 'success',
                        default       => 'gray',
                    }),
            ])
            ->recordActions([
                Action::make('selesaikan')
                    ->label('Selesaikan Sanksi')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->form([
                        Select::make('penyelesaian')
                            ->label('Diselesaikan dengan')
                            ->options([
                                'ganti_buku'  => 'Sudah Ganti Buku',
                                'bayar_harga' => 'Sudah Bayar Harga Buku',
                            ])
                            ->required()
                            ->live(),

                        TextInput::make('nominal_sanksi')
                            ->label('Nominal yang Dibayar (Rp)')
                            ->numeric()
                            ->hidden(fn ($get) => $get('penyelesaian') === 'ganti_buku')
                            ->placeholder('Contoh: 75000'),

                        Textarea::make('catatan')
                            ->label('Catatan Penyelesaian')
                            ->rows(3),
                    ])
                    ->action(function (Loan $record, array $data) {
                        $record->update([
                            'status_sanksi'      => 'lunas',
                            'jenis_sanksi'        => $data['penyelesaian'],
                            'nominal_sanksi'      => $data['penyelesaian'] === 'bayar_harga' ? ($data['nominal_sanksi'] ?? null) : null,
                            'tgl_selesai_sanksi'  => Carbon::today()->toDateString(),
                            'catatan_sanksi'      => $data['catatan'] ?? null,
                        ]);

                        Notification::make()
                            ->title('Sanksi berhasil diselesaikan')
                            ->color('success')
                            ->send();
                    }),
            ])
            ->defaultSort('tgl_kembali', 'desc');
    }
}
