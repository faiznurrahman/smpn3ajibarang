<?php

namespace App\Filament\Resources\ContactInfos\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class ContactInfoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('alamat')
                    ->label('Alamat')
                    ->rows(3)
                    ->columnSpanFull(),

                TextInput::make('nomor_telepon')
                    ->label('Nomor Telepon'),

                TextInput::make('email')
                    ->label('Email')
                    ->email(),

                TextInput::make('website')
                    ->label('Website')
                    ->url(),

                Textarea::make('embed_maps')
                    ->label('Embed Google Maps (iframe)')
                    ->rows(4)
                    ->columnSpanFull()
                    ->helperText('Paste kode iframe dari Google Maps'),
            ]);
    }
}