<?php

namespace App\Filament\Resources\SocialMedia\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput as NumberInput;
use Filament\Forms\Components\Select;

class SocialMediaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
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

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }
}
