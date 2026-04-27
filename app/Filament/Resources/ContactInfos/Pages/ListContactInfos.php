<?php

namespace App\Filament\Resources\ContactInfos\Pages;

use App\Filament\Resources\ContactInfos\ContactInfoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Models\ContactInfo;


class ListContactInfos extends ListRecords
{
    protected static string $resource = ContactInfoResource::class;

     public function mount(): void
    {
        $record = ContactInfo::firstOrCreate([]);
        $this->redirect(ContactInfoResource::getUrl('edit', ['record' => $record->id]));
    }
}
