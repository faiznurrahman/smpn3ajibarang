<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Foto Profil')
                    ->schema([
                        FileUpload::make('foto')
                            ->label('Foto')
                            ->image()
                            ->directory('guru')
                            ->imageEditor()
                            ->columnSpanFull(),
                    ]),

                Section::make('Data Diri')
                    ->schema([
                        TextInput::make('nama')
                            ->label('Nama lengkap')
                            ->placeholder('contoh: Drs. Ahmad Fauzi, M.Pd.')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Penugasan')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('jenis')
                                    ->label('Jenis')
                                    ->options([
                                        'guru'    => 'Guru',
                                        'wakasek' => 'Wakil Kepala Sekolah',
                                        'kepsek'  => 'Kepala Sekolah',
                                        'staff'   => 'Staf / Tata Usaha',
                                    ])
                                    ->default('guru')
                                    ->required()
                                    ->live(),

                                TextInput::make('jabatan')
                                    ->label('Jabatan')
                                    ->placeholder('contoh: Wali Kelas 7A'),

                                TextInput::make('mata_pelajaran')
                                    ->label('Mata Pelajaran')
                                    ->placeholder('contoh: Matematika')
                                    ->visible(fn ($get) => in_array($get('jenis'), ['guru', 'wakasek', 'kepsek'])),
                            ]),
                    ]),

                Section::make('Pengaturan')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Aktif — tampilkan profil di situs publik sekolah')
                            ->default(true),
                    ]),

            ]);
    }
}
