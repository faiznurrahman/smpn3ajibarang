<?php

namespace App\Filament\Resources\Textbooks\Pages;

use App\Filament\Resources\Textbooks\TextbookResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateTextbook extends CreateRecord
{
    protected static string $resource = TextbookResource::class;

    protected function afterCreate(): void
    {
        $this->record->generateItems();

        Notification::make()
            ->title("{$this->record->total_eksemplar} item berhasil di-generate untuk \"{$this->record->judul}\"")
            ->success()
            ->send();
    }
}
