<?php

namespace App\Filament\Resources\OrganizationalStructures;

use App\Filament\Resources\OrganizationalStructures\Pages\EditOrganizationalStructure;
use App\Filament\Resources\OrganizationalStructures\Schemas\OrganizationalStructureForm;
use App\Filament\Resources\OrganizationalStructures\Tables\OrganizationalStructuresTable;
use App\Enums\UserRole;
use App\Models\OrganizationalStructure;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OrganizationalStructureResource extends Resource
{
    protected static ?string $model = OrganizationalStructure::class;
    protected static ?string $slug  = 'struktur-organisasi';

    protected static ?string $navigationLabel  = 'Struktur Organisasi';
    protected static string|\UnitEnum|null $navigationGroup = 'Profil & Organisasi';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;
    protected static ?int    $navigationSort  = 3;
    protected static ?string $modelLabel     = 'Struktur Organisasi';
    protected static ?string $pluralModelLabel = 'Struktur Organisasi';

    protected static ?string $recordTitleAttribute = 'title';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::Admin;
    }

    public static function form(Schema $schema): Schema
    {
        return OrganizationalStructureForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrganizationalStructuresTable::configure($table);
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
            'index' => EditOrganizationalStructure::route('/'),
        ];
    }
}
