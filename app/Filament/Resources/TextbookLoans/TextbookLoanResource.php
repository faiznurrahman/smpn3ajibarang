<?php

namespace App\Filament\Resources\TextbookLoans;

use App\Enums\UserRole;
use App\Filament\Resources\TextbookLoans\Pages\CreateTextbookLoan;
use App\Filament\Resources\TextbookLoans\Pages\EditTextbookLoan;
use App\Filament\Resources\TextbookLoans\Pages\ListTextbookLoans;
use App\Filament\Resources\TextbookLoans\Pages\ViewTextbookLoan;
use App\Filament\Resources\TextbookLoans\Schemas\TextbookLoanForm;
use App\Filament\Resources\TextbookLoans\Tables\TextbookLoansTable;
use App\Models\TextbookLoan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TextbookLoanResource extends Resource
{
    protected static ?string $model = TextbookLoan::class;

    protected static ?string $navigationLabel            = 'Distribusi Buku Paket';
    protected static string|\UnitEnum|null $navigationGroup = 'Buku Paket';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;
    protected static ?int    $navigationSort             = 2;
    protected static ?string $modelLabel                = 'Distribusi';
    protected static ?string $pluralModelLabel          = 'Distribusi Buku Paket';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::PetugasPerpustakaan;
    }

    public static function form(Schema $schema): Schema
    {
        return TextbookLoanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TextbookLoansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListTextbookLoans::route('/'),
            'create' => CreateTextbookLoan::route('/create'),
            'edit'   => EditTextbookLoan::route('/{record}/edit'),
            'view'   => ViewTextbookLoan::route('/{record}/view'),
        ];
    }
}
