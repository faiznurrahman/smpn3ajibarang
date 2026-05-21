<?php

namespace App\Filament\Resources\Textbooks\Pages;

use App\Filament\Resources\Textbooks\TextbookResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTextbooks extends ListRecords
{
    protected static string $resource = TextbookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Tambah Buku Paket'),
        ];
    }
}
