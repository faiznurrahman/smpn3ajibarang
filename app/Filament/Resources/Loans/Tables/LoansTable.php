<?php

namespace App\Filament\Resources\Loans\Tables;

use App\Models\Loan;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LoansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->extraAttributes(['class' => 'tbl-loans'])
            ->columns([

                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex()
                    ->alignCenter()
                    ->width('50px')
                    ->visibleFrom('md'),

                TextColumn::make('member.nama')
                    ->label('Anggota')
                    ->searchable(query: function (Builder $query, string $search) {
                        $query->whereHas('member', fn ($q) => $q
                            ->where('nama', 'like', "%{$search}%")
                            ->orWhere('kode_anggota', 'like', "%{$search}%")
                        );
                    })
                    ->sortable()
                    ->weight('semibold')
                    ->description(fn (Loan $record) => collect([
                        $record->member?->kode_anggota,
                        $record->member?->kelas ? 'Kelas ' . $record->member->kelas : null,
                    ])->filter()->implode(' · ')),

                TextColumn::make('book.judul')
                    ->label('Buku')
                    ->searchable()
                    ->sortable()
                    ->grow()
                    ->wrap(false)
                    ->description(fn (Loan $record) => $record->book?->kode_buku),

                TextColumn::make('tgl_pinjam')
                    ->label('Tgl Pinjam')
                    ->date('d M Y')
                    ->sortable()
                    ->visibleFrom('lg'),

                TextColumn::make('tgl_batas_kembali')
                    ->label('Batas Kembali')
                    ->date('d M Y')
                    ->sortable()
                    ->color(fn (Loan $record) =>
                        $record->tgl_batas_kembali?->lt(Carbon::today()) && $record->status !== 'dikembalikan'
                            ? 'danger'
                            : null
                    ),

                TextColumn::make('jumlah_perpanjangan')
                    ->label('Perpanjangan')
                    ->formatStateUsing(fn ($state): string => ((int) $state) . 'x / 2x')
                    ->badge()
                    ->color(fn ($state): string => match (true) {
                        (int) $state >= 2 => 'danger',
                        (int) $state === 1 => 'warning',
                        default           => 'gray',
                    })
                    ->tooltip(fn ($state): ?string =>
                        (int) $state >= 2 ? 'Tidak bisa diperpanjang lagi' : null
                    )
                    ->sortable()
                    ->visibleFrom('lg'),

                TextColumn::make('hari_terlambat')
                    ->label('Terlambat')
                    ->getStateUsing(function (Loan $record): ?int {
                        if ($record->status === 'dikembalikan') {
                            return null;
                        }
                        $hari = $record->jumlahHariTerlambat();
                        return $hari > 0 ? $hari : null;
                    })
                    ->formatStateUsing(fn ($state) => $state ? '+' . $state . ' hari' : '—')
                    ->color(fn ($state) => $state ? 'danger' : null)
                    ->weight(fn ($state) => $state ? 'bold' : null),

                TextColumn::make('tgl_kembali')
                    ->label('Tgl Kembali')
                    ->date('d M Y')
                    ->placeholder('—')
                    ->sortable()
                    ->visibleFrom('lg'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'dipinjam'     => 'Dipinjam',
                        'dikembalikan' => 'Dikembalikan',
                        'terlambat'    => 'Terlambat',
                        default        => $state,
                    })
                    ->color(fn ($state) => match ($state) {
                        'dipinjam'     => 'warning',
                        'dikembalikan' => 'success',
                        'terlambat'    => 'danger',
                        default        => 'gray',
                    }),

            ])
            ->filters([])
            ->recordActions([
                Action::make('detail')
                    ->label('Detail')
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->modalHeading('Detail Peminjaman')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup')
                    ->modalContent(fn (Loan $record) => view(
                        'filament.admin.partials.loan-detail',
                        ['record' => $record->load(['member', 'book', 'bookItem', 'fine', 'petugas'])]
                    )),
            ])
            ->toolbarActions([])
            ->defaultSort('created_at', 'desc');
    }
}
