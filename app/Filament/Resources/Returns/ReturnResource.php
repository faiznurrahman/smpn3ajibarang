<?php

namespace App\Filament\Resources\Returns;

use App\Enums\UserRole;
use App\Models\Loan;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class ReturnResource extends Resource
{
    protected static ?string $model = Loan::class;
    protected static ?string $slug  = 'pengembalian-data';

    protected static bool    $shouldRegisterNavigation = false;
    protected static ?string $modelLabel               = 'Pengembalian';
    protected static ?string $pluralModelLabel         = 'Pengembalian Buku';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::PetugasPerpustakaan;
    }

    public static function canCreate(): bool             { return false; }
    public static function canEdit($record): bool        { return false; }
    public static function canDelete($record): bool      { return false; }
    public static function canDeleteAny(): bool          { return false; }

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
        return [];
    }
}
