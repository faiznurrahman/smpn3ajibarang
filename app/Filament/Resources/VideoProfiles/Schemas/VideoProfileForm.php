<?php

namespace App\Filament\Resources\VideoProfiles\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VideoProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Info Video')
                    ->schema([
                        TextInput::make('judul')
                            ->label('Judul Video')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('link_video')
                            ->label('Link Video (YouTube)')
                            ->url()
                            ->required()
                            ->placeholder('https://youtube.com/watch?v=...')
                            ->helperText('Paste URL YouTube lengkap')
                            ->columnSpanFull(),

                        Grid::make(2)
                            ->schema([
                                Textarea::make('deskripsi')
                                    ->label('Deskripsi Singkat')
                                    ->rows(3),

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
