<?php

namespace App\Filament\Resources\PrincipalGreetings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PrincipalGreetingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                Section::make('Foto Profil')
                    ->schema([
                        FileUpload::make('foto')
                            ->label('Foto Kepala Sekolah')
                            ->image()
                            ->imageEditor()
                            ->directory('principal')
                            ->columnSpanFull(),
                    ]),

                Section::make('Data Kepala Sekolah')
                    ->schema([
                        TextInput::make('nama_kepala_sekolah')
                            ->label('Nama Kepala Sekolah')
                            ->placeholder('contoh: Drs. Budi Santoso, M.Pd.')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Sambutan')
                    ->schema([
                        RichEditor::make('deskripsi')
                            ->label('Isi Sambutan')
                            ->required()
                            ->columnSpanFull(),
                    ]),

            ]);
    }
}
