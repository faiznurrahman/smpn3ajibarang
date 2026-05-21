<?php

namespace App\Filament\Resources\TextbookLoans\Pages;

use App\Filament\Resources\TextbookLoans\TextbookLoanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTextbookLoans extends ListRecords
{
    protected static string $resource = TextbookLoanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Buat Distribusi Baru'),
        ];
    }
}
