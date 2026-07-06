<?php

namespace App\Filament\Resources\BookItems\Pages;

use App\Filament\Resources\BookItems\BookItemResource;
use Filament\Resources\Pages\ListRecords;

class ListBookItems extends ListRecords
{
    protected static string $resource = BookItemResource::class;
}
