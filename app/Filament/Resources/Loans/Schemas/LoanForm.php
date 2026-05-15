<?php

namespace App\Filament\Resources\Loans\Schemas;

use App\Models\Book;
use App\Models\Member;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LoanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Data Peminjaman')
                ->schema([
                    Grid::make(2)->schema([
                        Select::make('member_id')
                            ->label('Anggota')
                            ->options(
                                Member::where('is_active', true)
                                    ->orderBy('nama')
                                    ->get()
                                    ->mapWithKeys(fn ($m) => [$m->id => "[{$m->kode_anggota}] {$m->nama}"])
                            )
                            ->searchable()
                            ->required()
                            ->columnSpanFull(),

                        Select::make('book_id')
                            ->label('Buku')
                            ->options(
                                Book::where('is_active', true)
                                    ->orderBy('judul')
                                    ->get()
                                    ->mapWithKeys(fn ($b) => [$b->id => "[{$b->kode_buku}] {$b->judul} (Tersedia: {$b->stok_tersedia})"])
                            )
                            ->searchable()
                            ->required()
                            ->columnSpanFull(),

                        DatePicker::make('tgl_pinjam')
                            ->label('Tanggal Pinjam')
                            ->default(today()->format('Y-m-d'))
                            ->required(),

                        DatePicker::make('tgl_batas_kembali')
                            ->label('Batas Kembali')
                            ->default(today()->addDays(7)->format('Y-m-d'))
                            ->required(),
                    ]),
                ]),

            Hidden::make('petugas_id')
                ->default(fn () => Filament::auth()->user()?->id),

        ]);
    }
}
