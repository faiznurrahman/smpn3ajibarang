<?php

namespace App\Filament\Resources\TextbookSanksis;

use App\Enums\UserRole;
use App\Filament\Resources\TextbookSanksis\Pages\ListTextbookSanksis;
use App\Filament\Resources\TextbookSanksis\Tables\TextbookSanksiTable;
use App\Models\TextbookLoanItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TextbookSanksiResource extends Resource
{
    protected static ?string $model = TextbookLoanItem::class;

    protected static ?string $navigationLabel               = 'Sanksi Buku Paket';
    protected static string|\UnitEnum|null $navigationGroup = 'Buku Paket';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedExclamationTriangle;
    protected static ?int    $navigationSort                = 4;
    protected static ?string $modelLabel                   = 'Sanksi Buku Paket';
    protected static ?string $pluralModelLabel             = 'Sanksi Buku Paket';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::PetugasPerpustakaan;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status_sanksi', 'belum_lunas')->count();
        return $count ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): string
    {
        return 'danger';
    }

    public static function table(Table $table): Table
    {
        return TextbookSanksiTable::configure($table);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema;
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTextbookSanksis::route('/'),
        ];
    }
}
