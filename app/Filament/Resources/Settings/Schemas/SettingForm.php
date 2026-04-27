<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([

                        TextInput::make('nama_sekolah')
                            ->label('Nama Sekolah')
                            ->required()
                            ->columnSpan(2),

                        TextInput::make('tagline')
                            ->label('Tagline')
                            ->hint('Ditampilkan sebagai badge di hero, contoh: Sekolah Adiwiyata Nasional')
                            ->columnSpan(2),

                        TextInput::make('judul_hero')
                            ->label('Judul Hero')
                            ->hint('Baris pertama hero (putih). Contoh: SMPN 3 — baris "AJIBARANG" sudah otomatis muncul di bawahnya.')
                            ->columnSpan(2),

                        Textarea::make('deskripsi_hero')
                            ->label('Deskripsi Hero')
                            ->rows(3)
                            ->columnSpan(2),

                        FileUpload::make('logo')
                            ->label('Logo Sekolah')
                            ->image()
                            ->directory('settings')
                            ->hint('PNG transparan, ukuran 512×512px, maks. 500KB')
                            ->columnSpan(1),

                        FileUpload::make('background_hero')
                            ->label('Background Hero')
                            ->image()
                            ->directory('settings')
                            ->hint('JPG/WebP, ukuran minimal 1920×1080px, maks. 1MB')
                            ->columnSpan(1),

                        TextInput::make('jumlah_siswa')
                            ->numeric()
                            ->label('Jumlah Siswa'),

                        TextInput::make('jumlah_guru_karyawan')
                            ->numeric()
                            ->label('Jumlah Guru & Karyawan'),

                        TextInput::make('jumlah_prestasi')
                            ->numeric()
                            ->label('Jumlah Prestasi'),

                        TextInput::make('tahun_berdiri')
                            ->numeric()
                            ->label('Tahun Berdiri')
                            ->hint('Contoh: 1999 — otomatis dihitung jadi "25+ Tahun Berdiri"'),

                    ]),
            ]);
    }
}