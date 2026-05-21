<?php

namespace App\Filament\Resources\TextbookLoans\Schemas;

use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TextbookLoanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->columns(1)->components([

            Section::make('Informasi Distribusi')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('tahun_ajaran')
                            ->label('Tahun Ajaran')
                            ->placeholder('2025/2026')
                            ->helperText('Format: YYYY/YYYY')
                            ->required(),

                        Select::make('untuk_tingkat')
                            ->label('Untuk Tingkat')
                            ->options([
                                7 => 'Kelas 7',
                                8 => 'Kelas 8',
                                9 => 'Kelas 9',
                            ])
                            ->required(),

                        DatePicker::make('tgl_distribusi')
                            ->label('Tanggal Distribusi')
                            ->required(),

                        DatePicker::make('tgl_kembali')
                            ->label('Tanggal Kembali (Rencana)')
                            ->helperText('Biasanya akhir tahun ajaran')
                            ->required(),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'aktif'   => 'Aktif',
                                'selesai' => 'Selesai',
                            ])
                            ->default('aktif')
                            ->required(),
                    ]),
                ]),

            Hidden::make('petugas_id')
                ->default(fn () => Filament::auth()->user()?->id),

        ]);
    }
}
