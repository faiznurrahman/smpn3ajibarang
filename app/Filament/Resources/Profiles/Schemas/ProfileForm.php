<?php

namespace App\Filament\Resources\Profiles\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                RichEditor::make('sejarah')
    ->toolbarButtons([
        'bold', 'italic', 'underline',
        'bulletList', 'orderedList',
        'h2', 'h3',
        'attachFiles', // ← ini untuk upload gambar
        'undo', 'redo',
    ])
    ->fileAttachmentsDisk('public')
    ->fileAttachmentsDirectory('sejarah')
    ->required()
    ->columnSpanFull(),
                RichEditor::make('visi')
                    ->toolbarButtons([
                        'bold', 'italic', 'underline',
                        'bulletList', 'orderedList',
                        'h2', 'h3',
                        'undo', 'redo',
                    ])
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('misi')
                    ->toolbarButtons([
                        'bold', 'italic', 'underline',
                        'bulletList', 'orderedList',
                        'h2', 'h3',
                        'undo', 'redo',
                    ])
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}