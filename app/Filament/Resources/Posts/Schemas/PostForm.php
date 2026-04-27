<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Facades\Filament;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('judul')
                    ->label('Judul')
                    ->required(),

                TextInput::make('slug')
                    ->label('Slug')
                    ->disabled()
                    ->dehydrated()
                    ->placeholder('Auto-generate dari judul'),

                Select::make('type')
                    ->label('Tipe Post')
                    ->options([
                        'berita'      => 'Berita',
                        'pengumuman'  => 'Pengumuman',
                        'prestasi'    => 'Prestasi',
                    ])
                    ->live()
                    ->required(),

                RichEditor::make('isi_konten')
                    ->label('Isi Konten')
                    ->columnSpanFull(),

                FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->image()
                    ->directory('posts')
                    ->visible(fn (Get $get) => in_array($get('type'), ['berita', 'prestasi'])),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'draft'     => 'Draft',
                        'published' => 'Published',
                    ])
                    ->default('draft')
                    ->required(),

                DatePicker::make('tanggal_publish')
                    ->label('Tanggal Publish'),

                DatePicker::make('start_date')
                    ->label('Tanggal Mulai Tampil')
                    ->visible(fn (Get $get) => $get('type') === 'pengumuman'),

                DatePicker::make('end_date')
                    ->label('Tanggal Berakhir')
                    ->visible(fn (Get $get) => $get('type') === 'pengumuman'),

                Toggle::make('is_pinned')
                    ->label('Pin Pengumuman')
                    ->visible(fn (Get $get) => $get('type') === 'pengumuman'),

                Hidden::make('user_id')
                    ->default(fn () => Filament::auth()->user()?->id),

            ]);
    }
}