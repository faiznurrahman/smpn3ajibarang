<?php

namespace App\Filament\Resources\Settings\Pages;

use App\Filament\Resources\Settings\SettingResource;
use App\Models\Setting;
use Filament\Resources\Pages\ListRecords;

class ListSettings extends ListRecords
{
    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount(): void
    {
        parent::mount();

        $record = Setting::first();

        if ($record) {
            redirect()->to(
                SettingResource::getUrl('edit', ['record' => $record])
            );
        } else {
            redirect()->to(
                SettingResource::getUrl('create')
            );
        }
    }
}