<?php

namespace App\Filament\Resources\VideoProfiles\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class VideoProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->label('Judul Video')
                    ->required(),

                TextInput::make('link_video')
                    ->label('Link Video (YouTube)')
                    ->url()
                    ->required()
                    ->helperText('Paste URL YouTube, contoh: https://youtube.com/watch?v=xxx'),

                Textarea::make('deskripsi')
                    ->label('Deskripsi Singkat')
                    ->rows(3)
                    ->columnSpanFull(),

                TextInput::make('order')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0),

                Toggle::make('is_active')
                    ->label('Aktif (tampil di website)')
                    ->default(true),
            ]);
    }
}
