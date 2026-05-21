<?php

namespace App\Filament\Resources\LibraryReports;

use App\Enums\UserRole;
use App\Filament\Resources\LibraryReports\Pages\ListLibraryReports;
use App\Filament\Resources\LibraryReports\Tables\LibraryReportsTable;
use App\Models\Loan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LibraryReportResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static ?string $navigationLabel            = 'Laporan Perpustakaan';
    protected static string|\UnitEnum|null $navigationGroup = 'Perpustakaan';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;
    protected static ?int    $navigationSort             = 6;
    protected static ?string $modelLabel                = 'Laporan';
    protected static ?string $pluralModelLabel          = 'Laporan Perpustakaan';

    public static function canAccess(): bool
    {
        $role = auth()->user()?->role;
        return in_array($role, [UserRole::PetugasPerpustakaan, UserRole::KepalaSekolah]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return LibraryReportsTable::configure($table);
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
            'index' => ListLibraryReports::route('/'),
        ];
    }
}
