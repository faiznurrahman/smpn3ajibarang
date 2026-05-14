<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Info Album')
                    ->schema([
                        TextInput::make('judul')
                            ->label('Judul Album')
                            ->required()
                            ->columnSpanFull(),

                        Grid::make(2)
                            ->schema([
                                Textarea::make('deskripsi')
                                    ->label('Deskripsi')
                                    ->rows(3),

                                TextInput::make('order')
                                    ->label('Urutan Tampil')
                                    ->numeric()
                                    ->default(0),
                            ]),
                    ]),

                Section::make('Foto-foto')
                    ->schema([
                        Repeater::make('images')
                            ->label('')
                            ->relationship('images')
                            ->schema([
                                FileUpload::make('gambar')
                                    ->label('Foto')
                                    ->image()
                                    ->directory('galleries')
                                    ->required()
                                    ->columnSpanFull(),

                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('caption')
                                            ->label('Keterangan')
                                            ->placeholder('Opsional'),

                                        TextInput::make('alt_text')
                                            ->label('Alt Text')
                                            ->placeholder('Deskripsi singkat untuk aksesibilitas'),

                                        TextInput::make('order')
                                            ->label('Urutan')
                                            ->numeric()
                                            ->default(0),
                                    ]),
                            ])
                            ->addActionLabel('Tambah Foto')
                            ->orderColumn('order')
                            ->columnSpanFull(),
                    ]),

            ]);
    }
}
