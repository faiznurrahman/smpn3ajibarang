<?php

namespace App\Filament\Resources\Profiles\Pages;

use App\Filament\Resources\Profiles\ProfileResource;
use Filament\Resources\Pages\EditRecord;

class EditProfile extends EditRecord
{
    protected static string $resource = ProfileResource::class;

    public function mount(int|string $record = null): void
    {
        $record = \App\Models\Profile::firstOrCreate([]);
        parent::mount($record->id);
    }

    public function getTitle(): string
    {
        return 'Profil Sekolah';
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
