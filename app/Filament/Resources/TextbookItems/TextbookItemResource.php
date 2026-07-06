<?php

namespace App\Filament\Resources\TextbookItems;

use App\Enums\UserRole;
use App\Filament\Resources\TextbookItems\Pages\ListTextbookItems;
use App\Filament\Resources\TextbookItems\Tables\TextbookItemsTable;
use App\Models\TextbookItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TextbookItemResource extends Resource
{
    protected static ?string $model = TextbookItem::class;
    protected static ?string $slug  = 'eksemplar-buku-paket';

    protected static ?string $navigationLabel               = 'Eksemplar Buku Paket';
    protected static string|\UnitEnum|null $navigationGroup = 'Buku Paket';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQrCode;
    protected static ?int    $navigationSort                = 2;
    protected static ?string $modelLabel                   = 'Eksemplar Buku Paket';
    protected static ?string $pluralModelLabel             = 'Eksemplar Buku Paket';

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
        return TextbookItemsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTextbookItems::route('/'),
        ];
    }
}
