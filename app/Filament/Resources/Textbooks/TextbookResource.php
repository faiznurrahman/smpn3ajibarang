<?php

namespace App\Filament\Resources\Textbooks;

use App\Enums\UserRole;
use App\Filament\Resources\Textbooks\Pages\CreateTextbook;
use App\Filament\Resources\Textbooks\Pages\EditTextbook;
use App\Filament\Resources\Textbooks\Pages\ListTextbooks;
use App\Filament\Resources\Textbooks\Schemas\TextbookForm;
use App\Filament\Resources\Textbooks\Tables\TextbooksTable;
use App\Models\Textbook;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TextbookResource extends Resource
{
    protected static ?string $model = Textbook::class;
    protected static ?string $slug  = 'buku-paket';

    protected static ?string $navigationLabel            = 'Katalog Buku Paket';
    protected static string|\UnitEnum|null $navigationGroup = 'Buku Paket';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;
    protected static ?int    $navigationSort             = 1;
    protected static ?string $modelLabel                = 'Buku Paket';
    protected static ?string $pluralModelLabel          = 'Katalog Buku Paket';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::PetugasPerpustakaan;
    }

    public static function canDelete($record): bool   { return false; }
    public static function canDeleteAny(): bool        { return false; }

    public static function form(Schema $schema): Schema
    {
        return TextbookForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TextbooksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListTextbooks::route('/'),
            'create' => CreateTextbook::route('/create'),
            'edit'   => EditTextbook::route('/{record}/edit'),
        ];
    }
}
