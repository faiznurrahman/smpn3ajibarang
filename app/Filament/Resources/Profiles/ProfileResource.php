<?php

namespace App\Filament\Resources\Profiles;

use App\Filament\Resources\Profiles\Pages\EditProfile;
use App\Filament\Resources\Profiles\Schemas\ProfileForm;
use App\Filament\Resources\Profiles\Tables\ProfilesTable;
use App\Enums\UserRole;
use App\Models\Profile;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;

    protected static ?string $navigationLabel  = 'Profil Sekolah';
    protected static string|\UnitEnum|null $navigationGroup = 'Profil & Organisasi';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;
    protected static ?int    $navigationSort  = 1;
    protected static ?string $modelLabel     = 'Profil Sekolah';
    protected static ?string $pluralModelLabel = 'Profil Sekolah';

    protected static ?string $recordTitleAttribute = 'sejarah';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::Admin;
    }

    public static function form(Schema $schema): Schema
    {
        return ProfileForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProfilesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canCreate(): bool { return false; }

    public static function getPages(): array
    {
        return [
            'index' => EditProfile::route('/'),
        ];
    }
}
