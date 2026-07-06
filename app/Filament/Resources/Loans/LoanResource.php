<?php

namespace App\Filament\Resources\Loans;

use App\Enums\UserRole;
use App\Filament\Resources\Loans\Schemas\LoanForm;
use App\Models\Loan;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class LoanResource extends Resource
{
    protected static ?string $model = Loan::class;
    protected static ?string $slug  = 'peminjaman-data';

    protected static bool    $shouldRegisterNavigation = false;
    protected static ?string $modelLabel               = 'Peminjaman';
    protected static ?string $pluralModelLabel         = 'Peminjaman Buku';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::PetugasPerpustakaan;
    }

    public static function canCreate(): bool               { return false; }
    public static function canEdit(Model $record): bool    { return false; }
    public static function canDelete(Model $record): bool  { return false; }
    public static function canDeleteAny(): bool            { return false; }

    public static function form(Schema $schema): Schema
    {
        return LoanForm::configure($schema);
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
