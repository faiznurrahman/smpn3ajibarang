<?php

namespace App\Filament\Resources\Textbooks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TextbookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->columns(1)->components([

            Section::make('Informasi Buku Paket')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('judul')
                            ->label('Judul Buku')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('mata_pelajaran')
                            ->label('Mata Pelajaran')
                            ->required(),

                        Select::make('untuk_tingkat')
                            ->label('Untuk Tingkat')
                            ->options([
                                7 => 'Kelas 7',
                                8 => 'Kelas 8',
                                9 => 'Kelas 9',
                            ])
                            ->required(),

                        TextInput::make('kode_prefix')
                            ->label('Kode Prefix')
                            ->required()
                            ->maxLength(10)
                            ->helperText('Awalan kode buku. Contoh: BI7, MTK8, IPA9'),

                        TextInput::make('penerbit')
                            ->label('Penerbit'),

                        TextInput::make('tahun_terbit')
                            ->label('Tahun Terbit')
                            ->maxLength(4),
                    ]),
                ]),

            Section::make('Stok & Status')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('total_eksemplar')
                            ->label('Total Eksemplar')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->helperText('Kode item akan di-generate otomatis setelah disimpan'),

                        Toggle::make('is_active')
                            ->label('Buku Paket Aktif')
                            ->default(true),
                    ]),
                ]),

        ]);
    }
}
