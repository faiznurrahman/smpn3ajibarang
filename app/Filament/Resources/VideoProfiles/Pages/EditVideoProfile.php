<?php

namespace App\Filament\Resources\VideoProfiles\Pages;

use App\Filament\Resources\VideoProfiles\VideoProfileResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVideoProfile extends EditRecord
{
    protected static string $resource = VideoProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
