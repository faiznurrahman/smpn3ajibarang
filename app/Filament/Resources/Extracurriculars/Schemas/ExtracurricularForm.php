<?php

namespace App\Filament\Resources\Extracurriculars\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ExtracurricularForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Gambar')
                    ->schema([
                        FileUpload::make('gambar')
                            ->label('Gambar Ekstrakurikuler')
                            ->image()
                            ->imageEditor()
                            ->directory('extracurriculars')
                            ->columnSpanFull(),
                    ]),

                Section::make('Informasi')
                    ->schema([
                        TextInput::make('nama')
                            ->label('Nama Ekstrakurikuler')
                            ->required()
                            ->columnSpanFull(),

                        Grid::make(2)
                            ->schema([
                                Textarea::make('deskripsi')
                                    ->label('Deskripsi')
                                    ->rows(4),

                                TextInput::make('order')
                                    ->label('Urutan Tampil')
                                    ->numeric()
                                    ->default(0),
                            ]),
                    ]),

                Section::make('Pengaturan')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Aktif — tampilkan di situs publik sekolah')
                            ->default(true),
                    ]),

            ]);
    }
}
