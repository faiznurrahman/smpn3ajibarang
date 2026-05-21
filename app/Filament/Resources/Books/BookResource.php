<?php

namespace App\Filament\Resources\Books;

use App\Enums\UserRole;
use App\Filament\Resources\Books\Pages\CreateBook;
use App\Filament\Resources\Books\Pages\EditBook;
use App\Filament\Resources\Books\Pages\ListBooks;
use App\Filament\Resources\Books\Schemas\BookForm;
use App\Filament\Resources\Books\Tables\BooksTable;
use App\Models\Book;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationLabel            = 'Data Buku';
    protected static string|\UnitEnum|null $navigationGroup = 'Perpustakaan';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;
    protected static ?int    $navigationSort             = 1;
    protected static ?string $modelLabel                = 'Buku';
    protected static ?string $pluralModelLabel          = 'Data Buku';

    protected static ?string $recordTitleAttribute = 'judul';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::PetugasPerpustakaan;
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::where('is_active', true)->count() ?: null;
    }

    public static function form(Schema $schema): Schema
    {
        return BookForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BooksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListBooks::route('/'),
            'create' => CreateBook::route('/create'),
            'edit'   => EditBook::route('/{record}/edit'),
        ];
    }
}
