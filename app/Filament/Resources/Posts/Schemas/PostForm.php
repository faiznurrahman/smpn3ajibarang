<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Konten')
                    ->schema([
                        TextInput::make('judul')
                            ->label('Judul')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->disabled()
                            ->dehydrated()
                            ->placeholder('Auto-generate dari judul')
                            ->columnSpanFull(),

                        Select::make('type')
                            ->label('Tipe Post')
                            ->options([
                                'berita'     => 'Berita',
                                'pengumuman' => 'Pengumuman',
                                'prestasi'   => 'Prestasi',
                            ])
                            ->live()
                            ->required(),

                        RichEditor::make('isi_konten')
                            ->label('Isi Konten')
                            ->columnSpanFull(),
                    ]),

                Section::make('Media')
                    ->schema([
                        FileUpload::make('thumbnail')
                            ->label('Thumbnail')
                            ->image()
                            ->directory('posts')
                            ->imageEditor()
                            ->columnSpanFull()
                            ->visible(fn (Get $get) => in_array($get('type'), ['berita', 'prestasi'])),
                    ])
                    ->visible(fn (Get $get) => in_array($get('type'), ['berita', 'prestasi'])),

                Section::make('Publikasi')
                    ->schema([
                        Grid::make(2)
                            ->schema([
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
                            ]),

                        Toggle::make('is_pinned')
                            ->label('Pin Pengumuman — tampilkan di bagian atas daftar')
                            ->visible(fn (Get $get) => $get('type') === 'pengumuman'),
                    ]),

                Hidden::make('user_id')
                    ->default(fn () => Filament::auth()->user()?->id),

            ]);
    }
}
