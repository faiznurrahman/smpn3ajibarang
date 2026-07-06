<?php

namespace App\Filament\Resources\TextbookSanksis\Tables;

use App\Models\TextbookDistributionItem;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TextbookSanksiTable
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

                TextColumn::make('textbookItem.textbook.judul')
                    ->label('Buku Paket')
                    ->searchable()
                    ->sortable()
                    ->grow()
                    ->description(fn ($record) => implode(' · ', array_filter([
                        $record->textbookItem?->kode_item,
                        $record->loan?->tahun_ajaran ? 'TA ' . $record->loan->tahun_ajaran : null,
                        match ($record->kondisi_kembali) {
                            'rusak'  => 'Rusak',
                            'hilang' => 'Hilang',
                            default  => null,
                        },
                    ]))),

                TextColumn::make('loan.tahun_ajaran')
                    ->label('Tahun Ajaran')
                    ->description(fn ($record) => 'Kelas ' . $record->loan?->untuk_tingkat)
                    ->visibleFrom('md'),

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
                    })
                    ->visibleFrom('sm'),

                TextColumn::make('jenis_sanksi')
                    ->label('Jenis Sanksi')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'ganti_buku'  => 'Ganti Buku',
                        'bayar_harga' => 'Bayar Harga',
                        default       => '—',
                    })
                    ->color(fn ($state) => match ($state) {
                        'ganti_buku'  => 'warning',
                        'bayar_harga' => 'danger',
                        default       => 'gray',
                    })
                    ->visibleFrom('sm'),

                TextColumn::make('nominal_sanksi')
                    ->label('Nominal')
                    ->formatStateUsing(fn ($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : '—')
                    ->color('danger')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('status_sanksi')
                    ->label('Status')
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

                TextColumn::make('tgl_kembali_aktual')
                    ->label('Tgl Kembali')
                    ->date('d M Y')
                    ->sortable()
                    ->placeholder('—')
                    ->visibleFrom('sm'),

                TextColumn::make('tgl_selesai_sanksi')
                    ->label('Tgl Selesai')
                    ->date('d M Y')
                    ->sortable()
                    ->placeholder('—')
                    ->description(fn ($record) => $record->catatan_sanksi ?: null)
                    ->visibleFrom('md'),

            ])
            ->filters([
                SelectFilter::make('status_sanksi')
                    ->label('Status Sanksi')
                    ->options([
                        'belum_lunas' => 'Belum Lunas',
                        'lunas'       => 'Lunas',
                        'tidak_ada'   => 'Tidak Ada Sanksi',
                    ]),

                SelectFilter::make('kondisi_kembali')
                    ->label('Kondisi Buku')
                    ->options([
                        'rusak'  => 'Rusak',
                        'hilang' => 'Hilang',
                        'baik'   => 'Baik',
                    ]),

                SelectFilter::make('jenis_sanksi')
                    ->label('Jenis Sanksi')
                    ->options([
                        'ganti_buku'  => 'Ganti Buku',
                        'bayar_harga' => 'Bayar Harga Buku',
                    ]),
            ])
            ->recordActions([
                Action::make('selesaikan')
                    ->label('Selesaikan')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->hidden(fn ($record) => $record->status_sanksi !== 'belum_lunas')
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
                            ->hidden(fn ($get) => $get('penyelesaian') !== 'bayar_harga')
                            ->placeholder('Contoh: 75000'),

                        Textarea::make('catatan')
                            ->label('Catatan Penyelesaian')
                            ->rows(2),
                    ])
                    ->action(function (TextbookDistributionItem $record, array $data) {
                        $record->update([
                            'status_sanksi'      => 'lunas',
                            'jenis_sanksi'       => $data['penyelesaian'],
                            'nominal_sanksi'     => $data['penyelesaian'] === 'bayar_harga' ? ($data['nominal_sanksi'] ?? null) : null,
                            'tgl_selesai_sanksi' => Carbon::today()->toDateString(),
                            'catatan_sanksi'     => $data['catatan'] ?? null,
                        ]);

                        Notification::make()
                            ->title('Sanksi berhasil diselesaikan')
                            ->success()
                            ->send();
                    }),
            ])
            ->defaultSort('tgl_kembali_aktual', 'desc');
    }
}
