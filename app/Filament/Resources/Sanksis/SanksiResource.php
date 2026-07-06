<?php

namespace App\Filament\Resources\Sanksis;

use App\Enums\UserRole;
use App\Filament\Resources\Sanksis\Pages\ListSanksis;
use App\Filament\Resources\Sanksis\Tables\SanksiTable;
use App\Models\Loan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
class SanksiResource extends Resource
{
    protected static ?string $model = Loan::class;
    protected static ?string $slug  = 'sanksi-buku';

    protected static ?string $navigationLabel            = 'Sanksi Buku';
    protected static string|\UnitEnum|null $navigationGroup = 'Sirkulasi';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedExclamationTriangle;
    protected static ?int    $navigationSort             = 4;
    protected static bool    $shouldRegisterNavigation   = false;
    protected static ?string $modelLabel                = 'Sanksi';
    protected static ?string $pluralModelLabel          = 'Sanksi Buku';

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
        return SanksiTable::configure($table);
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
            'index' => ListSanksis::route('/'),
        ];
    }
}
