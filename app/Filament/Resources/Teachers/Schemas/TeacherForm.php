<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;

class TeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('nama')
                    ->label('Nama')
                    ->required(),

                FileUpload::make('foto')
                    ->label('Foto')
                    ->image()
                    ->directory('guru'),

                Select::make('jenis')
                    ->label('Jenis')
                    ->options([
                        'guru' => 'Guru',
                        'staff' => 'Staff',
                    ])
                    ->default('guru')
                    ->required()
                    ->live(),

                TextInput::make('mata_pelajaran')
                    ->label('Mata Pelajaran')
                    ->visible(fn ($get) => $get('jenis') === 'guru'),

                TextInput::make('jabatan')
                    ->label('Jabatan')
                    ->placeholder('Contoh: TU, Kepala Sekolah, dll'),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),

            ]);
    }
}