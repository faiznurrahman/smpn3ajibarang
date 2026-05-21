<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\UserRole;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                Section::make('Informasi Akun')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Lengkap')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('email')
                                    ->label('Alamat Email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true),

                                Select::make('role')
                                    ->label('Peran Pengguna')
                                    ->required()
                                    ->options([
                                        'admin'                 => 'Admin Website',
                                        'petugas_perpustakaan'  => 'Petugas Perpustakaan',
                                        'kepala_sekolah'        => 'Kepala Sekolah',
                                    ])
                                    ->disabled(fn ($record) => $record?->id === auth()->id()),

                                Toggle::make('is_active')
                                    ->label('Akun Aktif')
                                    ->default(true)
                                    ->disabled(function ($record) {
                                        if ($record?->id === auth()->id()) return true;
                                        if (! $record || $record->role !== UserRole::Admin || ! $record->is_active) return false;
                                        return User::where('role', UserRole::Admin)->where('is_active', true)->count() <= 1;
                                    })
                                    ->helperText(function ($record) {
                                        if (! $record) return null;
                                        if ($record->id === auth()->id()) return 'Tidak bisa mengubah status akun sendiri.';
                                        if ($record->role !== UserRole::Admin || ! $record->is_active) return null;
                                        if (User::where('role', UserRole::Admin)->where('is_active', true)->count() <= 1) {
                                            return 'Tidak bisa dinonaktifkan — satu-satunya Admin aktif.';
                                        }
                                        return null;
                                    }),
                            ]),
                    ]),

                Section::make('Kata Sandi')
                    ->description(fn ($context) => $context === 'edit'
                        ? 'Kosongkan jika tidak ingin mengubah kata sandi'
                        : null)
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('password')
                                    ->label('Kata Sandi')
                                    ->password()
                                    ->revealable()
                                    ->required(fn ($context) => $context === 'create')
                                    ->minLength(8)
                                    ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                                    ->dehydrated(fn ($state) => filled($state)),

                                TextInput::make('password_confirmation')
                                    ->label('Konfirmasi Kata Sandi')
                                    ->password()
                                    ->revealable()
                                    ->same('password')
                                    ->required(fn ($context) => $context === 'create')
                                    ->dehydrated(false),
                            ]),
                    ]),

            ]);
    }
}
