<?php

namespace App\Filament\Resources\Users\Pages;

use App\Enums\UserRole;
use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Exceptions\Halt;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function beforeSave(): void
    {
        $data = $this->form->getState();

        if (! ($data['is_active'] ?? true) && $this->record->role === UserRole::Admin) {
            $otherActiveAdmins = User::where('role', UserRole::Admin)
                ->where('is_active', true)
                ->where('id', '!=', $this->record->id)
                ->count();

            if ($otherActiveAdmins === 0) {
                Notification::make()
                    ->title('Tidak dapat dinonaktifkan')
                    ->body('Tidak bisa menonaktifkan satu-satunya Admin aktif. Aktifkan Admin lain terlebih dahulu.')
                    ->danger()
                    ->send();

                throw new Halt();
            }
        }
    }
}
