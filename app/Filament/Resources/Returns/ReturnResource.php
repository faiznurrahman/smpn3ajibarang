<?php

namespace App\Filament\Resources\Returns;

use App\Enums\UserRole;
use App\Filament\Resources\Returns\Pages\ListReturns;
use App\Filament\Resources\Returns\Tables\ReturnsTable;
use App\Models\Loan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ReturnResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static ?string $navigationLabel            = 'Pengembalian Buku';
    protected static string|\UnitEnum|null $navigationGroup = 'Perpustakaan';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowLeftOnRectangle;
    protected static ?int    $navigationSort             = 4;
    protected static ?string $modelLabel                = 'Pengembalian';
    protected static ?string $pluralModelLabel          = 'Pengembalian Buku';

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
        $late = static::getModel()::where('status', 'terlambat')
            ->whereNull('tgl_kembali')
            ->count();
        return $late ? (string) $late : null;
    }

    public static function getNavigationBadgeColor(): string
    {
        return 'danger';
    }

    public static function table(Table $table): Table
    {
        return ReturnsTable::configure($table);
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
            'index' => ListReturns::route('/'),
        ];
    }
}
