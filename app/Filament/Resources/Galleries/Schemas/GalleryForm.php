<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;


class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->label('Judul Gallery')
                    ->required(),

                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->rows(2)
                    ->columnSpanFull(),

                TextInput::make('order')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0),

                Repeater::make('images')
                    ->label('Foto-foto')
                    ->relationship('images')
                    ->schema([
                        FileUpload::make('gambar')
                            ->label('Foto')
                            ->image()
                            ->directory('galleries')
                            ->required(),

                        TextInput::make('caption')
                            ->label('Keterangan Foto')
                            ->placeholder('Opsional'),

                        TextInput::make('alt_text')
                            ->label('Alt Text')
                            ->placeholder('Deskripsi singkat foto untuk aksesibilitas'),

                        TextInput::make('order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columnSpanFull()
                    ->addActionLabel('Tambah Foto')
                    ->orderColumn('order'),
            ]);
    }
}
