<?php

namespace App\Filament\Resources\PrincipalGreetings\Pages;

use App\Filament\Resources\PrincipalGreetings\PrincipalGreetingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPrincipalGreetings extends ListRecords
{
    protected static string $resource = PrincipalGreetingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
