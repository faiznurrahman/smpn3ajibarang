<?php

namespace App\Filament\Resources\KioskProfiles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class KioskProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                Section::make('Hero Beranda')
                    ->description('Gambar latar dan tagline singkat yang tampil pada halaman utama perpustakaan (/perpustakaan).')
                    ->schema([
                        FileUpload::make('hero_image')
                            ->label('Gambar Latar Hero')
                            ->image()
                            ->imageEditor()
                            ->directory('perpustakaan/kiosk/hero')
                            ->helperText('Opsional. Jika kosong, hero akan memakai warna latar polos.')
                            ->columnSpanFull(),

                        TextInput::make('tagline')
                            ->label('Tagline')
                            ->maxLength(150)
                            ->placeholder('Pusat literasi dan sumber belajar bagi seluruh warga sekolah')
                            ->columnSpanFull(),
                    ]),

                Section::make('Sejarah Perpustakaan')
                    ->description('Teks singkat sejarah perpustakaan yang tampil di halaman utama perpustakaan.')
                    ->schema([
                        Textarea::make('sejarah')
                            ->label('Sejarah Singkat')
                            ->rows(6)
                            ->placeholder('Tuliskan sejarah singkat perpustakaan...')
                            ->columnSpanFull(),
                    ]),

                Section::make('Struktur Pengelola')
                    ->description('Kepala sekolah dan petugas perpustakaan yang ditampilkan sebagai kartu foto.')
                    ->schema([
                        Repeater::make('pengelola')
                            ->label('')
                            ->schema([
                                FileUpload::make('foto')
                                    ->label('Foto')
                                    ->image()
                                    ->imageEditor()
                                    ->directory('perpustakaan/kiosk/pengelola')
                                    ->columnSpanFull(),

                                Grid::make(2)->schema([
                                    TextInput::make('nama')
                                        ->label('Nama')
                                        ->required()
                                        ->maxLength(100),

                                    TextInput::make('jabatan')
                                        ->label('Jabatan')
                                        ->required()
                                        ->maxLength(100)
                                        ->placeholder('Contoh: Kepala Sekolah, Petugas Perpustakaan'),
                                ]),
                            ])
                            ->itemLabel(fn (array $state): ?string => $state['nama'] ?? null)
                            ->addActionLabel('+ Tambah Pengelola')
                            ->reorderable()
                            ->collapsible()
                            ->collapsed()
                            ->grid(2)
                            ->defaultItems(0),
                    ]),

                Section::make('Galeri Foto Perpustakaan')
                    ->description('Beberapa foto singkat untuk halaman utama perpustakaan (maksimal 8 foto, bukan album penuh).')
                    ->schema([
                        Repeater::make('galeri')
                            ->label('')
                            ->schema([
                                FileUpload::make('gambar')
                                    ->label('Foto')
                                    ->image()
                                    ->imageEditor()
                                    ->directory('perpustakaan/kiosk/galeri')
                                    ->columnSpanFull(),

                                TextInput::make('keterangan')
                                    ->label('Keterangan')
                                    ->maxLength(150)
                                    ->placeholder('Opsional')
                                    ->columnSpanFull(),
                            ])
                            ->itemLabel(fn (array $state): ?string => $state['keterangan'] ?? null)
                            ->addActionLabel('+ Tambah Foto')
                            ->reorderable()
                            ->collapsible()
                            ->collapsed()
                            ->grid(2)
                            ->maxItems(8)
                            ->defaultItems(0),
                    ]),

                Section::make('Kontak Perpustakaan')
                    ->description('Kontak yang tampil di footer halaman perpustakaan. Kosongkan untuk memakai kontak sekolah utama.')
                    ->schema([
                        TextInput::make('kontak_alamat')
                            ->label('Alamat')
                            ->maxLength(191)
                            ->placeholder('Jl. Raya Ajibarang Timur No. 53, Ajibarang')
                            ->columnSpanFull(),

                        Grid::make(2)->schema([
                            TextInput::make('kontak_telepon')
                                ->label('Nomor Telepon')
                                ->tel()
                                ->maxLength(30),

                            TextInput::make('kontak_email')
                                ->label('Email')
                                ->email()
                                ->maxLength(100),
                        ]),
                    ]),

            ]);
    }
}
