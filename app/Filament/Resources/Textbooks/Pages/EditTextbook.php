<?php

namespace App\Filament\Resources\Textbooks\Pages;

use App\Filament\Resources\Textbooks\TextbookResource;
use Filament\Resources\Pages\EditRecord;

class EditTextbook extends EditRecord
{
    protected static string $resource = TextbookResource::class;
}
