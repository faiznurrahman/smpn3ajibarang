<?php

namespace App\Filament\Resources\Profiles\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Sejarah Sekolah')
                    ->schema([
                        RichEditor::make('sejarah')
                            ->label('')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline',
                                'bulletList', 'orderedList',
                                'h2', 'h3',
                                'attachFiles',
                                'undo', 'redo',
                            ])
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('sejarah')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Visi')
                    ->schema([
                        RichEditor::make('visi')
                            ->label('')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline',
                                'bulletList', 'orderedList',
                                'h2', 'h3',
                                'undo', 'redo',
                            ])
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Misi')
                    ->schema([
                        RichEditor::make('misi')
                            ->label('')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline',
                                'bulletList', 'orderedList',
                                'h2', 'h3',
                                'undo', 'redo',
                            ])
                            ->required()
                            ->columnSpanFull(),
                    ]),

            ]);
    }
}
