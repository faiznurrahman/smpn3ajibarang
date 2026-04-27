<?php

namespace App\Filament\Resources\OrganizationalStructures\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class OrganizationalStructureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul / Keterangan')
                    ->required()
                    ->helperText('Contoh: Struktur Organisasi 2024/2025'),

                FileUpload::make('image')
                    ->label('Gambar Struktur Organisasi')
                    ->image()
                    ->directory('organizational-structures')
                    ->columnSpanFull(),

                TextInput::make('order')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
