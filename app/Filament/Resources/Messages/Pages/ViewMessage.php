<?php

namespace App\Filament\Resources\Messages\Pages;

use App\Filament\Resources\Messages\MessageResource;
use App\Models\Message;
use Filament\Resources\Pages\Page;

class ViewMessage extends Page
{
    protected static string $resource = MessageResource::class;

    protected string $view = 'filament.admin.pages.messages.view-message';

    // Gunakan $message (bukan $record) untuk menghindari konflik dengan
    // properti internal Filament v5 Page class yang juga bernama $record.
    public ?Message $message = null;

    public function getTitle(): string
    {
        return $this->message?->subjek ?: 'Detail Pesan';
    }

    public function mount(int|string $record): void
    {
        $this->message = Message::findOrFail((int) $record);

        // Auto-tandai sebagai sudah dibaca saat halaman dibuka
        if (! $this->message->is_read) {
            $this->message->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
            $this->message->refresh();
        }
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
