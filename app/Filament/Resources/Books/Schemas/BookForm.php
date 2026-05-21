<?php

namespace App\Filament\Resources\Books\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->columns(1)->components([

            Section::make('Informasi Buku')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('kode_buku')
                            ->label('Kode Buku')
                            ->placeholder('Auto-generate')
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('judul')
                            ->label('Judul Buku')
                            ->required(),

                        TextInput::make('pengarang')
                            ->label('Pengarang')
                            ->required(),

                        TextInput::make('penerbit')
                            ->label('Penerbit'),

                        TextInput::make('tahun')
                            ->label('Tahun Terbit')
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue(date('Y')),

                        Select::make('kategori')
                            ->label('Kategori')
                            ->options([
                                'Fiksi'             => 'Fiksi',
                                'Non-Fiksi'         => 'Non-Fiksi',
                                'Pelajaran'         => 'Pelajaran',
                                'Referensi'         => 'Referensi',
                                'Ensiklopedi'       => 'Ensiklopedi',
                                'Biografi'          => 'Biografi',
                                'Sains & Teknologi' => 'Sains & Teknologi',
                                'Sosial & Budaya'   => 'Sosial & Budaya',
                                'Agama'             => 'Agama',
                                'Lainnya'           => 'Lainnya',
                            ])
                            ->searchable(),
                    ]),
                ]),

            Section::make('Stok & Ketersediaan')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('stok')
                            ->label('Jumlah Stok')
                            ->numeric()
                            ->minValue(0)
                            ->default(1)
                            ->required(),

                        TextInput::make('stok_tersedia')
                            ->label('Stok Tersedia')
                            ->disabled()
                            ->dehydrated(false)
                            ->placeholder('Dihitung otomatis')
                            ->hint('Stok dikurangi jumlah pinjaman aktif'),
                    ]),
                ]),

            Section::make('Sampul & Status')
                ->schema([
                    Grid::make(2)->schema([
                        FileUpload::make('cover')
                            ->label('Sampul Buku')
                            ->image()
                            ->directory('buku')
                            ->imageEditor(),

                        Toggle::make('is_active')
                            ->label('Aktif — buku dapat dipinjam')
                            ->default(true),
                    ]),
                ]),

        ]);
    }
}
