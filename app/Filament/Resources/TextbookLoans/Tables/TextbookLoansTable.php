<?php

namespace App\Filament\Resources\TextbookLoans\Tables;

use App\Filament\Resources\TextbookLoans\TextbookLoanResource;
use App\Models\Textbook;
use App\Models\TextbookLoan;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TextbookLoansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tahun_ajaran')
                    ->label('Tahun Ajaran')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->badge()
                    ->color('primary'),

                TextColumn::make('untuk_tingkat')
                    ->label('Tingkat')
                    ->formatStateUsing(fn ($state) => 'Kelas ' . $state)
                    ->badge()
                    ->color('info')
                    ->sortable(),

                TextColumn::make('tgl_distribusi')
                    ->label('Tgl Distribusi')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('tgl_kembali')
                    ->label('Tgl Kembali')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('total_siswa')
                    ->label('Siswa')
                    ->alignCenter()
                    ->getStateUsing(fn ($record) => $record->loanItems()->distinct('member_id')->count()),

                TextColumn::make('total_buku')
                    ->label('Total Buku')
                    ->alignCenter()
                    ->getStateUsing(fn ($record) => $record->loanItems()->count()),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'aktif' ? 'Aktif' : 'Selesai')
                    ->color(fn ($state) => $state === 'aktif' ? 'warning' : 'success'),

                TextColumn::make('petugas.name')
                    ->label('Petugas')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('untuk_tingkat')
                    ->label('Tingkat')
                    ->options([
                        '7' => 'Kelas 7',
                        '8' => 'Kelas 8',
                        '9' => 'Kelas 9',
                    ]),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'aktif'   => 'Aktif',
                        'selesai' => 'Selesai',
                    ]),
            ])
            ->recordActions([
                Action::make('distribusi_massal')
                    ->label('Distribusi Massal')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('warning')
                    ->visible(fn (TextbookLoan $record) => $record->status === 'aktif')
                    ->form([
                        CheckboxList::make('textbook_ids')
                            ->label('Pilih Buku Paket')
                            ->options(function (TextbookLoan $record) {
                                return Textbook::where('is_active', true)
                                    ->where('untuk_tingkat', $record->untuk_tingkat)
                                    ->get()
                                    ->mapWithKeys(fn ($t) => [
                                        $t->id => "[{$t->kode_prefix}] {$t->judul} — {$t->items()->where('is_available', true)->count()} tersedia",
                                    ]);
                            })
                            ->columns(2)
                            ->required()
                            ->helperText('Pilih satu atau lebih buku paket yang akan didistribusikan ke siswa'),
                    ])
                    ->action(function (TextbookLoan $record, array $data) {
                        $result = $record->distributeToMembers($data['textbook_ids']);

                        Notification::make()
                            ->title("Distribusi selesai — {$result['assigned']} buku didistribusikan ke {$result['siswa']} siswa.")
                            ->success()
                            ->send();
                    }),

                Action::make('lihat_detail')
                    ->label('Lihat Detail')
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->url(fn (TextbookLoan $record) => TextbookLoanResource::getUrl('view', ['record' => $record])),

                EditAction::make()->label('Edit'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
