<?php

namespace App\Filament\Resources\Returns\Tables;

use App\Models\Fine;
use App\Models\Loan;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
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

                TextColumn::make('kondisi_kembali')
                    ->label('Kondisi')
                    ->badge()
                    ->placeholder('—')
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

                TextColumn::make('status_sanksi')
                    ->label('Sanksi')
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
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'dipinjam'  => 'Dipinjam',
                        'terlambat' => 'Terlambat',
                    ]),

                SelectFilter::make('kondisi_kembali')
                    ->label('Kondisi Kembali')
                    ->options([
                        'baik'   => 'Baik',
                        'rusak'  => 'Rusak',
                        'hilang' => 'Hilang',
                    ]),

                SelectFilter::make('status_sanksi')
                    ->label('Status Sanksi')
                    ->options([
                        'tidak_ada'   => 'Tidak Ada',
                        'belum_lunas' => 'Belum Lunas',
                        'lunas'       => 'Lunas',
                    ]),
            ])
            ->recordActions([
                Action::make('kembalikan')
                    ->label('Kembalikan')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('success')
                    ->hidden(fn (Loan $record) => $record->tgl_kembali !== null)
                    ->form([
                        DatePicker::make('tgl_kembali')
                            ->label('Tanggal Dikembalikan')
                            ->default(today()->format('Y-m-d'))
                            ->required(),

                        Select::make('kondisi_kembali')
                            ->label('Kondisi Buku Saat Dikembalikan')
                            ->options([
                                'baik'   => 'Baik',
                                'rusak'  => 'Rusak',
                                'hilang' => 'Hilang',
                            ])
                            ->default('baik')
                            ->required()
                            ->live(),

                        Select::make('jenis_sanksi')
                            ->label('Jenis Sanksi')
                            ->options([
                                'ganti_buku'  => 'Ganti Buku yang Sama',
                                'bayar_harga' => 'Bayar Harga Buku',
                            ])
                            ->hidden(fn ($get) => $get('kondisi_kembali') === 'baik' || $get('kondisi_kembali') === null)
                            ->default(fn ($get) => match ($get('kondisi_kembali')) {
                                'rusak'  => 'bayar_harga',
                                'hilang' => 'ganti_buku',
                                default  => null,
                            }),

                        Textarea::make('catatan_sanksi')
                            ->label('Catatan Sanksi')
                            ->helperText('Contoh: harga buku, kondisi kerusakan')
                            ->hidden(fn ($get) => $get('kondisi_kembali') === 'baik' || $get('kondisi_kembali') === null)
                            ->rows(3),
                    ])
                    ->action(function (Loan $record, array $data) {
                        $tglKembali   = Carbon::parse($data['tgl_kembali']);
                        $isLate       = $tglKembali->gt($record->tgl_batas_kembali);
                        $kondisi      = $data['kondisi_kembali'];
                        $adaSanksi    = in_array($kondisi, ['rusak', 'hilang']);

                        $record->update([
                            'tgl_kembali'      => $tglKembali->toDateString(),
                            'status'           => $isLate ? 'terlambat' : 'dikembalikan',
                            'kondisi_kembali'  => $kondisi,
                            'jenis_sanksi'     => $adaSanksi ? ($data['jenis_sanksi'] ?? ($kondisi === 'hilang' ? 'ganti_buku' : 'bayar_harga')) : 'tidak_ada',
                            'status_sanksi'    => $adaSanksi ? 'belum_lunas' : 'tidak_ada',
                            'catatan_sanksi'   => $adaSanksi ? ($data['catatan_sanksi'] ?? null) : null,
                        ]);

                        if ($isLate && ! $record->fine) {
                            $jumlahHari = (int) $record->tgl_batas_kembali->diffInDays($tglKembali);
                            Fine::create([
                                'loan_id'      => $record->id,
                                'jumlah_hari'  => $jumlahHari,
                                'nominal'      => $jumlahHari * 1000,
                                'status_bayar' => 'belum_lunas',
                            ]);
                        }

                        $title = 'Buku berhasil dikembalikan';
                        $color = 'success';
                        if ($isLate && $adaSanksi) {
                            $title = 'Buku dikembalikan — ada denda keterlambatan & sanksi';
                            $color = 'danger';
                        } elseif ($isLate) {
                            $title = 'Buku dikembalikan — ada denda keterlambatan';
                            $color = 'warning';
                        } elseif ($adaSanksi) {
                            $title = 'Buku dikembalikan — ada sanksi kondisi buku';
                            $color = 'warning';
                        }

                        Notification::make()
                            ->title($title)
                            ->color($color)
                            ->send();
                    }),
            ])
            ->defaultSort('tgl_batas_kembali', 'asc');
    }
}
