<?php

namespace App\Filament\Resources\TextbookItems\Pages;

use App\Filament\Resources\TextbookItems\TextbookItemResource;
use Filament\Resources\Pages\ListRecords;

class ListTextbookItems extends ListRecords
{
    protected static string $resource = TextbookItemResource::class;
}
