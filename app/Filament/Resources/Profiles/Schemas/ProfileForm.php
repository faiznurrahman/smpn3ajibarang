<?php

namespace App\Filament\Resources\Profiles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                Section::make('Sejarah Sekolah')
                    ->description('Unggah foto dan tuliskan isi sejarah sekolah.')
                    ->schema([
                        Grid::make(2)->schema([
                            FileUpload::make('foto_sejarah')
                                ->label('Foto Sejarah Sekolah')
                                ->helperText('Foto gedung, suasana sekolah, atau dokumentasi lama.')
                                ->image()
                                ->imageEditor()
                                ->directory('profil/sejarah')
                                ->nullable(),

                            TextInput::make('foto_sejarah_alt')
                                ->label('Teks Alternatif (Alt Text)')
                                ->helperText('Deskripsi singkat foto untuk aksesibilitas & jika gambar tidak tampil. Contoh: "Gedung SMPN 3 Ajibarang tahun 1995"')
                                ->placeholder('Contoh: Gedung SMPN 3 Ajibarang tahun 1995')
                                ->maxLength(255)
                                ->nullable(),
                        ]),

                        RichEditor::make('sejarah')
                            ->label('Isi Sejarah Sekolah')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline',
                                'bulletList', 'orderedList',
                                'h2', 'h3',
                                'undo', 'redo',
                            ])
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
