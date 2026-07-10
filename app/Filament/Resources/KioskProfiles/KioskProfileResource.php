<?php

namespace App\Filament\Resources\KioskProfiles;

use App\Enums\UserRole;
use App\Filament\Resources\KioskProfiles\Pages\EditKioskProfile;
use App\Filament\Resources\KioskProfiles\Schemas\KioskProfileForm;
use App\Models\KioskProfile;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KioskProfileResource extends Resource
{
    protected static ?string $model = KioskProfile::class;
    protected static ?string $slug  = 'beranda-perpustakaan';

    protected static ?string $navigationLabel               = 'Beranda Perpustakaan';
    protected static string|\UnitEnum|null $navigationGroup = 'Konten Perpustakaan';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;
    protected static ?int    $navigationSort               = 1;
    protected static ?string $modelLabel                   = 'Beranda Perpustakaan';
    protected static ?string $pluralModelLabel              = 'Konten Beranda Perpustakaan';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::PetugasPerpustakaan;
    }

    public static function canCreate(): bool { return false; }

    public static function form(Schema $schema): Schema
    {
        return KioskProfileForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => EditKioskProfile::route('/'),
        ];
    }
}
