<?php

namespace App\Filament\Resources\KioskProfiles\Pages;

use App\Filament\Resources\KioskProfiles\KioskProfileResource;
use App\Models\KioskProfile;
use Filament\Resources\Pages\EditRecord;

class EditKioskProfile extends EditRecord
{
    protected static string $resource = KioskProfileResource::class;

    public function mount(int|string $record = null): void
    {
        $record = KioskProfile::firstOrCreate([]);
        parent::mount($record->id);
    }

    public function getTitle(): string
    {
        return 'Beranda Perpustakaan';
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
