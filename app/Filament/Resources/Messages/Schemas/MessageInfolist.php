<?php

namespace App\Filament\Resources\Messages\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MessageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Pengirim')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('nama')
                                    ->label('Nama'),

                                TextEntry::make('nomor_telepon')
                                    ->label('Nomor Telepon')
                                    ->placeholder('—'),

                                TextEntry::make('email')
                                    ->label('Email')
                                    ->placeholder('—'),

                                TextEntry::make('created_at')
                                    ->label('Diterima pada')
                                    ->dateTime('d M Y, H:i'),
                            ]),
                    ]),

                Section::make('Pesan')
                    ->schema([
                        TextEntry::make('subjek')
                            ->label('Subjek')
                            ->columnSpanFull(),

                        TextEntry::make('isi_pesan')
                            ->label('Isi Pesan')
                            ->prose()
                            ->columnSpanFull(),
                    ]),

                Section::make('Status')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                IconEntry::make('is_read')
                                    ->label('Status Baca')
                                    ->boolean()
                                    ->trueIcon('heroicon-o-check-circle')
                                    ->falseIcon('heroicon-o-envelope')
                                    ->trueColor('success')
                                    ->falseColor('warning'),

                                TextEntry::make('read_at')
                                    ->label('Dibaca pada')
                                    ->dateTime('d M Y, H:i')
                                    ->placeholder('—'),
                            ]),
                    ]),

            ]);
    }
}
