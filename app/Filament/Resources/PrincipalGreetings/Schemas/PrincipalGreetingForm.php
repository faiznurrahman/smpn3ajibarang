<?php

namespace App\Filament\Resources\PrincipalGreetings\Schemas;

use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class PrincipalGreetingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Grid::make(2)->schema([

                    TextInput::make('nama_kepala_sekolah')
                        ->label('Nama Kepala Sekolah')
                        ->required(),

                    FileUpload::make('foto')
                        ->label('Foto Kepala Sekolah')
                        ->image()
                        ->directory('principal'),

                ]),

                RichEditor::make('deskripsi')
                    ->label('Deskripsi Sambutan')
                    ->required(),

            ]);
    }
}