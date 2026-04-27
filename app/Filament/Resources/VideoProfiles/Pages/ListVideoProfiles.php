<?php

namespace App\Filament\Resources\VideoProfiles\Pages;

use App\Filament\Resources\VideoProfiles\VideoProfileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVideoProfiles extends ListRecords
{
    protected static string $resource = VideoProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
