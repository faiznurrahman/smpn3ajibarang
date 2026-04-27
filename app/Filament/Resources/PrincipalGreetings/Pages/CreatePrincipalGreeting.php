<?php

namespace App\Filament\Resources\PrincipalGreetings\Pages;

use App\Filament\Resources\PrincipalGreetings\PrincipalGreetingResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePrincipalGreeting extends CreateRecord
{
    protected static string $resource = PrincipalGreetingResource::class;
}
