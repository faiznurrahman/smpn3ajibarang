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
        return $schema->components([

            Section::make('Data Anggota')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('kode_anggota')
                            ->label('Kode Anggota')
                            ->placeholder('Auto-generate jika kosong')
                            ->unique(ignoreRecord: true),

                        Select::make('jenis')
                            ->label('Jenis Anggota')
                            ->options([
                                'siswa' => 'Siswa',
                                'guru'  => 'Guru',
                            ])
                            ->default('siswa')
                            ->required()
                            ->live(),

                        TextInput::make('nama')
                            ->label('Nama Lengkap')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('kelas')
                            ->label('Kelas')
                            ->placeholder('contoh: 7A, 8B, 9C')
                            ->visible(fn ($get) => $get('jenis') === 'siswa'),

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
