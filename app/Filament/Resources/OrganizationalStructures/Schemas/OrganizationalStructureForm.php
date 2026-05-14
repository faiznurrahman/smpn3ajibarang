<?php

namespace App\Filament\Resources\OrganizationalStructures\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrganizationalStructureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Dokumen Struktur')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Judul / Keterangan')
                                    ->required()
                                    ->placeholder('contoh: Struktur Organisasi 2024/2025'),

                                TextInput::make('order')
                                    ->label('Urutan Tampil')
                                    ->numeric()
                                    ->default(0),
                            ]),

                        FileUpload::make('image')
                            ->label('Gambar Struktur Organisasi')
                            ->image()
                            ->imageEditor()
                            ->directory('organizational-structures')
                            ->columnSpanFull(),
                    ]),

            ]);
    }
}
