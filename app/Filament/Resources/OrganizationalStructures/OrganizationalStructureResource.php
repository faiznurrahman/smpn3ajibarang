<?php

namespace App\Filament\Resources\OrganizationalStructures;

use App\Filament\Resources\OrganizationalStructures\Pages\CreateOrganizationalStructure;
use App\Filament\Resources\OrganizationalStructures\Pages\EditOrganizationalStructure;
use App\Filament\Resources\OrganizationalStructures\Pages\ListOrganizationalStructures;
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

    protected static ?string $navigationLabel  = 'Struktur Organisasi';
    protected static string|\UnitEnum|null $navigationGroup = 'Profil & Organisasi';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;
    protected static ?int    $navigationSort  = 3;

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

    public static function getPages(): array
    {
        return [
            'index' => ListOrganizationalStructures::route('/'),
            'create' => CreateOrganizationalStructure::route('/create'),
            'edit' => EditOrganizationalStructure::route('/{record}/edit'),
        ];
    }
}
