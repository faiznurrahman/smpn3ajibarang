<?php

namespace App\Filament\Resources\Books\Pages;

use App\Filament\Resources\Books\BookResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateBook extends CreateRecord
{
    protected static string $resource = BookResource::class;

    protected function afterCreate(): void
    {
        $jumlah  = max(1, (int) ($this->data['jumlah_eksemplar'] ?? 1));
        $kondisi = $this->data['kondisi_eksemplar'] ?? 'baik';

        $this->record->generateItems($jumlah, $kondisi);

        Notification::make()
            ->title("{$jumlah} eksemplar berhasil di-generate untuk \"{$this->record->judul}\"")
            ->success()
            ->send();
    }
}
