<?php

namespace App\Filament\Resources\Books\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
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

            Section::make('Data Utama Buku')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('kode_buku')
                            ->label('Kode Buku')
                            ->placeholder('Auto-generate')
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('isbn')
                            ->label('ISBN')
                            ->placeholder('Contoh: 978-602-1234-56-7')
                            ->maxLength(20),
                    ]),

                    TextInput::make('judul')
                        ->label('Judul Buku')
                        ->required()
                        ->columnSpanFull(),

                    Grid::make(2)->schema([
                        TextInput::make('penulis')
                            ->label('Penulis')
                            ->required(),

                        TextInput::make('penerbit')
                            ->label('Penerbit'),

                        TextInput::make('tahun')
                            ->label('Tahun Terbit')
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue(date('Y')),

                        Select::make('kategori')
                            ->label('Kategori / Genre')
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

                        TextInput::make('rak')
                            ->label('Rak / Lokasi Buku')
                            ->placeholder('Contoh: Rak A-1'),
                    ]),

                    FileUpload::make('cover')
                        ->label('Cover Buku')
                        ->image()
                        ->directory('buku')
                        ->imageEditor()
                        ->columnSpanFull(),

                    Textarea::make('deskripsi')
                        ->label('Deskripsi / Sinopsis')
                        ->rows(4)
                        ->columnSpanFull(),
                ]),

            Section::make('Stok & Kondisi')
                ->schema([
                    Grid::make(3)->schema([
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
                            ->placeholder('—')
                            ->hint('Stok dikurangi pinjaman aktif'),

                        TextInput::make('stok_dipinjam')
                            ->label('Stok Dipinjam')
                            ->disabled()
                            ->dehydrated(false)
                            ->placeholder('—')
                            ->hint('Jumlah sedang dipinjam'),
                    ]),
                ]),

            Section::make('Status')
                ->schema([
                    Toggle::make('is_active')
                        ->label('Aktif — buku dapat dipinjam')
                        ->default(true),
                ]),

        ]);
    }
}
