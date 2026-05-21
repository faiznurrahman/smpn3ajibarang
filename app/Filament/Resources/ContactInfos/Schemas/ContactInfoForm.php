<?php

namespace App\Filament\Resources\ContactInfos\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactInfoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                Section::make('Informasi Kontak')
                    ->schema([
                        Textarea::make('alamat')
                            ->label('Alamat Lengkap')
                            ->rows(3)
                            ->columnSpanFull(),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('nomor_telepon')
                                    ->label('Nomor Telepon'),

                                TextInput::make('email')
                                    ->label('Email')
                                    ->email(),

                                TextInput::make('website')
                                    ->label('Website')
                                    ->url(),
                            ]),
                    ]),

                Section::make('Peta Lokasi')
                    ->schema([
                        Textarea::make('embed_maps')
                            ->label('Embed Google Maps (iframe)')
                            ->rows(5)
                            ->helperText('Paste kode iframe dari Google Maps → Share → Embed a map')
                            ->columnSpanFull(),
                    ]),

            ]);
    }
}
