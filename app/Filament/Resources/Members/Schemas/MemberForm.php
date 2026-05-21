<?php

namespace App\Filament\Resources\Members\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Collection;

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
                            ->options([
                                'siswa' => 'Siswa',
                                'guru'  => 'Guru',
                            ])
                            ->default('siswa')
                            ->required()
                            ->live(),

                        TextInput::make('kode_anggota')
                            ->label(fn ($get) => $get('jenis') === 'guru' ? 'NIP' : 'NIS')
                            ->helperText(fn ($get) => $get('jenis') === 'guru' ? 'Nomor Induk Pegawai' : 'Nomor Induk Siswa')
                            ->required()
                            ->unique(ignoreRecord: true),

                        TextInput::make('nama')
                            ->label('Nama Lengkap')
                            ->required()
                            ->columnSpanFull(),

                        Select::make('tahun_masuk')
                            ->label('Tahun Masuk (Angkatan)')
                            ->options(
                                Collection::times(4, fn ($i) => now()->year - $i + 1)
                                    ->mapWithKeys(fn ($y) => [$y => 'Angkatan ' . $y])
                                    ->toArray()
                            )
                            ->placeholder('Pilih tahun masuk')
                            ->hidden(fn ($get) => $get('jenis') !== 'siswa')
                            ->required(fn ($get) => $get('jenis') === 'siswa')
                            ->helperText('Tahun pertama siswa masuk sekolah ini'),

                        TextInput::make('kelas')
                            ->label('Kelas')
                            ->placeholder('Contoh: 7A, 8B, 9C')
                            ->hidden(fn ($get) => $get('jenis') !== 'siswa')
                            ->required(fn ($get) => $get('jenis') === 'siswa')
                            ->maxLength(10),

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

                        TextInput::make('no_hp')
                            ->label('No. HP / WhatsApp')
                            ->tel()
                            ->placeholder('contoh: 081234567890'),
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
