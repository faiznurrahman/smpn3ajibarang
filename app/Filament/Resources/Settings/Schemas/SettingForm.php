<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                Section::make('Identitas Sekolah')
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Logo Sekolah')
                            ->image()
                            ->imageEditor()
                            ->directory('settings')
                            ->hint('PNG transparan, 512×512px, maks. 500KB')
                            ->columnSpanFull(),

                        TextInput::make('nama_sekolah')
                            ->label('Nama Sekolah')
                            ->placeholder('contoh: SMP Negeri 3 Ajibarang')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('tagline')
                            ->label('Tagline / Motto')
                            ->placeholder('contoh: Sekolah Adiwiyata Nasional')
                            ->hint('Ditampilkan sebagai badge di halaman hero')
                            ->columnSpanFull(),
                    ]),

                Section::make('Hero Beranda')
                    ->schema([
                        TextInput::make('judul_hero')
                            ->label('Judul Hero')
                            ->placeholder('contoh: SMPN 3')
                            ->hint('"AJIBARANG" otomatis tampil sebagai baris kedua')
                            ->columnSpanFull(),

                        Textarea::make('deskripsi_hero')
                            ->label('Deskripsi Hero')
                            ->placeholder('Tulis deskripsi singkat sekolah yang tampil di halaman beranda...')
                            ->rows(4)
                            ->columnSpanFull(),

                        FileUpload::make('background_hero')
                            ->label('Foto Latar Hero')
                            ->image()
                            ->directory('settings')
                            ->hint('JPG/WebP, ukuran minimal 1920×1080px, maks. 1MB')
                            ->columnSpanFull(),
                    ]),

                Section::make('Statistik Sekolah')
                    ->description('Jumlah siswa dan guru/karyawan diambil otomatis dari data anggota perpustakaan.')
                    ->schema([
                        TextInput::make('jumlah_prestasi')
                            ->label('Jumlah Prestasi')
                            ->numeric()
                            ->suffix('prestasi')
                            ->placeholder('0')
                            ->columnSpanFull(),

                        TextInput::make('tahun_berdiri')
                            ->label('Tahun Berdiri')
                            ->numeric()
                            ->placeholder('1999')
                            ->hint('Dihitung otomatis jadi "X+ Tahun"')
                            ->columnSpanFull(),
                    ]),

            ]);
    }
}
