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
        // Item di-generate otomatis via Textbook::booted() created event
        Notification::make()
            ->title("{$this->record->total_eksemplar} eksemplar berhasil di-generate untuk \"{$this->record->judul}\"")
            ->success()
            ->send();
    }
}
