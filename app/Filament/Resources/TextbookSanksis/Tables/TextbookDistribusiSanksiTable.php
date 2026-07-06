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
use Illuminate\Database\Eloquent\Builder;

class TextbookDistribusiSanksiTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->where('jenis_sanksi', '!=', 'tidak_ada'))
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex()
                    ->alignCenter()
                    ->width('50px'),

                TextColumn::make('member.nama')
                    ->label('Siswa')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->grow()
                    ->description(fn ($record) => $record->member?->kelas ? 'Kelas ' . $record->member->kelas : null),

                TextColumn::make('textbookItem.textbook.judul')
                    ->label('Buku Paket')
                    ->searchable()
                    ->description(fn ($record) => $record->textbookItem?->kode_item),

                TextColumn::make('distribution.tahun_ajaran')
                    ->label('Tahun Ajaran')
                    ->description(fn ($record) => 'Kelas ' . $record->distribution?->untuk_tingkat)
                    ->visibleFrom('md'),

                TextColumn::make('kondisi_kembali')
                    ->label('Kondisi')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'baik'        => 'Baik',
                        'rusak_ringan'=> 'Rusak Ringan',
                        'rusak_berat' => 'Rusak Berat',
                        'hilang'      => 'Hilang',
                        default       => '—',
                    })
                    ->color(fn ($state) => match ($state) {
                        'baik'        => 'success',
                        'rusak_ringan'=> 'warning',
                        'rusak_berat' => 'danger',
                        'hilang'      => 'danger',
                        default       => 'gray',
                    }),

                TextColumn::make('jenis_sanksi')
                    ->label('Jenis Sanksi')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'bayar_harga' => 'Bayar Harga',
                        'ganti_buku'  => 'Ganti Buku',
                        default       => '—',
                    })
                    ->color(fn ($state) => match ($state) {
                        'bayar_harga' => 'danger',
                        'ganti_buku'  => 'warning',
                        default       => 'gray',
                    }),

                TextColumn::make('nominal_sanksi')
                    ->label('Nominal')
                    ->formatStateUsing(fn ($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : '—')
                    ->color('danger')
                    ->sortable(),

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
                        'belum_lunas' => 'danger',
                        'lunas'       => 'success',
                        default       => 'gray',
                    }),
            ])
            ->filters([
                SelectFilter::make('status_sanksi')
                    ->label('Status Sanksi')
                    ->options([
                        'belum_lunas' => 'Belum Lunas',
                        'lunas'       => 'Lunas',
                    ]),

                SelectFilter::make('jenis_sanksi')
                    ->label('Jenis Sanksi')
                    ->options([
                        'bayar_harga' => 'Bayar Harga Buku',
                        'ganti_buku'  => 'Ganti Buku',
                    ]),

                SelectFilter::make('kondisi_kembali')
                    ->label('Kondisi Kembali')
                    ->options([
                        'rusak_ringan'=> 'Rusak Ringan',
                        'rusak_berat' => 'Rusak Berat',
                        'hilang'      => 'Hilang',
                    ]),
            ])
            ->recordActions([
                Action::make('tandai_lunas')
                    ->label('Tandai Lunas')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->hidden(fn ($record) => $record->status_sanksi !== 'belum_lunas')
                    ->form([
                        Select::make('jenis_penyelesaian')
                            ->label('Diselesaikan dengan')
                            ->options([
                                'bayar_harga' => 'Sudah Bayar Harga Buku',
                                'ganti_buku'  => 'Sudah Ganti Buku',
                            ])
                            ->required()
                            ->live(),

                        TextInput::make('nominal_aktual')
                            ->label('Nominal Dibayar (Rp)')
                            ->numeric()
                            ->hidden(fn ($get) => $get('jenis_penyelesaian') !== 'bayar_harga')
                            ->placeholder('Contoh: 75000'),

                        Textarea::make('catatan')
                            ->label('Catatan Penyelesaian')
                            ->rows(2),
                    ])
                    ->action(function (TextbookDistributionItem $record, array $data) {
                        $record->update([
                            'status_sanksi'  => 'lunas',
                            'jenis_sanksi'   => $data['jenis_penyelesaian'],
                            'nominal_sanksi' => $data['jenis_penyelesaian'] === 'bayar_harga'
                                ? ($data['nominal_aktual'] ?? $record->nominal_sanksi)
                                : $record->nominal_sanksi,
                            'catatan'        => $data['catatan'] ?? $record->catatan,
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
