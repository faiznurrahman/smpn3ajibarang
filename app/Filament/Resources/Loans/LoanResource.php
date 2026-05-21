<?php

namespace App\Filament\Resources\Loans;

use App\Enums\UserRole;
use App\Filament\Resources\Loans\Pages\CreateLoan;
use App\Filament\Resources\Loans\Pages\EditLoan;
use App\Filament\Resources\Loans\Pages\ListLoans;
use App\Filament\Resources\Loans\Schemas\LoanForm;
use App\Filament\Resources\Loans\Tables\LoansTable;
use App\Models\Loan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LoanResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static ?string $navigationLabel            = 'Peminjaman Buku';
    protected static string|\UnitEnum|null $navigationGroup = 'Perpustakaan';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowRightOnRectangle;
    protected static ?int    $navigationSort             = 3;
    protected static ?string $modelLabel                = 'Peminjaman';
    protected static ?string $pluralModelLabel          = 'Peminjaman Buku';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::PetugasPerpustakaan;
    }

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status', 'dipinjam')->count();
        return $count ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): string
    {
        return 'primary';
    }

    public static function form(Schema $schema): Schema
    {
        return LoanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LoansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListLoans::route('/'),
            'create' => CreateLoan::route('/create'),
            'edit'   => EditLoan::route('/{record}/edit'),
        ];
    }
}
