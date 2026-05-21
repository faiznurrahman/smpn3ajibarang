<?php

namespace App\Filament\Resources\OrganizationalStructures\Pages;

use App\Filament\Resources\OrganizationalStructures\OrganizationalStructureResource;
use Filament\Resources\Pages\EditRecord;

class EditOrganizationalStructure extends EditRecord
{
    protected static string $resource = OrganizationalStructureResource::class;

    public function mount(int|string $record = null): void
    {
        $record = \App\Models\OrganizationalStructure::firstOrCreate([]);
        parent::mount($record->id);
    }

    public function getTitle(): string
    {
        return 'Struktur Organisasi';
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
