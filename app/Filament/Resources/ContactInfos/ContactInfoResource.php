<?php

namespace App\Filament\Resources\ContactInfos;

use App\Filament\Resources\ContactInfos\Pages\CreateContactInfo;
use App\Filament\Resources\ContactInfos\Pages\EditContactInfo;
use App\Filament\Resources\ContactInfos\Pages\ListContactInfos;
use App\Filament\Resources\ContactInfos\Schemas\ContactInfoForm;
use App\Filament\Resources\ContactInfos\Tables\ContactInfosTable;
use App\Enums\UserRole;
use App\Models\ContactInfo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ContactInfoResource extends Resource
{
    protected static ?string $model = ContactInfo::class;
    protected static ?string $slug  = 'informasi-kontak';

    protected static ?string $navigationLabel  = 'Informasi Kontak';
    protected static string|\UnitEnum|null $navigationGroup = 'Komunikasi';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhone;
    protected static ?int    $navigationSort  = 2;
    protected static ?string $modelLabel     = 'Info Kontak';
    protected static ?string $pluralModelLabel = 'Informasi Kontak';

    protected static ?string $recordTitleAttribute = 'alamat';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::Admin;
    }

    public static function canCreate(): bool { return false; }
public static function canDelete(Model $model): bool { return false; }
public static function canDeleteAny(): bool { return false; }

    public static function form(Schema $schema): Schema
    {
        return ContactInfoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactInfosTable::configure($table);
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
        'index' => Pages\ListContactInfos::route('/'),
        'edit'  => Pages\EditContactInfo::route('/{record}/edit'),
    ];
}


}
