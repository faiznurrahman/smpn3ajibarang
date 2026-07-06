<?php

namespace App\Filament\Resources\BookItems;

use App\Enums\UserRole;
use App\Filament\Resources\BookItems\Pages\ListBookItems;
use App\Filament\Resources\BookItems\Tables\BookItemsTable;
use App\Models\BookItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BookItemResource extends Resource
{
    protected static ?string $model = BookItem::class;
    protected static ?string $slug  = 'eksemplar';

    protected static ?string $navigationLabel            = 'Daftar Eksemplar';
    protected static string|\UnitEnum|null $navigationGroup = 'Koleksi';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQrCode;
    protected static ?int    $navigationSort             = 2;
    protected static ?string $modelLabel                = 'Eksemplar';
    protected static ?string $pluralModelLabel          = 'Daftar Eksemplar';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::PetugasPerpustakaan;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return BookItemsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBookItems::route('/'),
        ];
    }
}
