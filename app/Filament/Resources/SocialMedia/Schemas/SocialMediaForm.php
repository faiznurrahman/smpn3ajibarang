<?php

namespace App\Filament\Resources\SocialMedia\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SocialMediaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Detail Platform')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('icon')
                                    ->label('Platform')
                                    ->options([
                                        'facebook'  => 'Facebook',
                                        'instagram' => 'Instagram',
                                        'youtube'   => 'YouTube',
                                        'twitter'   => 'Twitter / X',
                                        'tiktok'    => 'TikTok',
                                        'whatsapp'  => 'WhatsApp',
                                    ])
                                    ->live()
                                    ->afterStateUpdated(fn ($state, callable $set) =>
                                        $set('nama', ucfirst($state))
                                    )
                                    ->required(),

                                TextInput::make('nama')
                                    ->label('Nama Tampil')
                                    ->required(),

                                TextInput::make('url')
                                    ->label('URL / Link')
                                    ->url()
                                    ->required(),

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
