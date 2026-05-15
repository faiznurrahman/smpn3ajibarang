<?php

namespace App\Filament\Resources\Fines\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FineForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Detail Denda')
                ->schema([
                    Placeholder::make('anggota')
                        ->label('Anggota')
                        ->content(fn ($record) => $record?->loan?->member?->nama ?? '—'),

                    Placeholder::make('buku')
                        ->label('Buku')
                        ->content(fn ($record) => $record?->loan?->book?->judul ?? '—'),

                    Placeholder::make('jumlah_hari')
                        ->label('Jumlah Hari Terlambat')
                        ->content(fn ($record) => $record ? $record->jumlah_hari . ' hari' : '—'),

                    Placeholder::make('nominal_display')
                        ->label('Nominal Denda')
                        ->content(fn ($record) => $record ? 'Rp ' . number_format($record->nominal, 0, ',', '.') : '—'),
                ]),

            Section::make('Pembayaran')
                ->schema([
                    Select::make('status_bayar')
                        ->label('Status Pembayaran')
                        ->options([
                            'belum_lunas' => 'Belum Lunas',
                            'lunas'       => 'Lunas',
                        ])
                        ->required()
                        ->live(),

                    DatePicker::make('tgl_bayar')
                        ->label('Tanggal Bayar')
                        ->default(today()->format('Y-m-d'))
                        ->visible(fn ($get) => $get('status_bayar') === 'lunas'),
                ]),

        ]);
    }
}
