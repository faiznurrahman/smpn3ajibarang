<?php

namespace App\Filament\Resources\PrincipalGreetings\Pages;

use App\Filament\Resources\PrincipalGreetings\PrincipalGreetingResource;
use Filament\Resources\Pages\EditRecord;

class EditPrincipalGreeting extends EditRecord
{
    protected static string $resource = PrincipalGreetingResource::class;

    public function mount(int | string $record = null): void
    {
        $record = \App\Models\PrincipalGreeting::firstOrCreate([]);
        parent::mount($record->id);
    }

    public function getTitle(): string
{
    return 'Sambutan Kepala Sekolah';
}

public function getBreadcrumbs(): array
{
    return [
        'Sambutan Kepala Sekolah',
    ];
}

    protected function getHeaderActions(): array
    {
        return [];
    }
}