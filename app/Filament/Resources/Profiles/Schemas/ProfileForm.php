<?php

namespace App\Filament\Resources\Profiles\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('sejarah')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('visi')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('misi')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
