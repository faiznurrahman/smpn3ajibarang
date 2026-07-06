<?php

namespace App\Filament\Resources\Members\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->columns(1)->components([

            Section::make('Data Anggota')
                ->schema([
                    Grid::make(2)->schema([

                        Select::make('jenis')
                            ->label('Jenis Anggota')
                            ->options(['siswa' => 'Siswa', 'guru' => 'Guru'])
                            ->default('siswa')
                            ->required()
                            ->live(),

                        TextInput::make('kode_anggota')
                            ->label(fn ($get) => $get('jenis') === 'guru' ? 'NIP' : 'NIS')
                            ->placeholder(fn ($get) => $get('jenis') === 'guru' ? 'Nomor Induk Pegawai' : 'Nomor Induk Siswa')
                            ->required()
                            ->unique(ignoreRecord: true),

                        TextInput::make('nama')
                            ->label('Nama Lengkap')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('tahun_masuk')
                            ->label('Angkatan (Tahun Masuk)')
                            ->numeric()
                            ->minValue(2010)
                            ->maxValue(now()->year + 2)
                            ->placeholder('Contoh: ' . now()->year)
                            ->helperText('Tahun pertama siswa masuk sekolah')
                            ->hidden(fn ($get) => $get('jenis') !== 'siswa')
                            ->required(fn ($get) => $get('jenis') === 'siswa'),

                        TextInput::make('kelas')
                            ->label('Kelas')
                            ->placeholder('Contoh: 7A, 8B, 9C')
                            ->maxLength(10)
                            ->hidden(fn ($get) => $get('jenis') !== 'siswa')
                            ->required(fn ($get) => $get('jenis') === 'siswa'),

                        Select::make('status')
                            ->label('Status Keanggotaan')
                            ->options([
                                'aktif'  => 'Aktif',
                                'lulus'  => 'Lulus',
                                'pindah' => 'Pindah',
                                'keluar' => 'Keluar',
                            ])
                            ->default('aktif')
                            ->required(),

                    ]),
                ]),

            Section::make('Pengaturan')
                ->schema([
                    Toggle::make('is_active')
                        ->label('Aktif — anggota dapat meminjam buku')
                        ->default(true),
                ]),

        ]);
    }
}
