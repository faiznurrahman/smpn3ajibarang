<?php

namespace App\Filament\Resources\DistribusiBukuPakets;

use App\Enums\UserRole;
use App\Filament\Resources\DistribusiBukuPakets\Pages\ListDistribusiBukuPaket;
use App\Filament\Resources\DistribusiBukuPakets\Pages\ViewDistribusiBukuPaket;
use App\Filament\Resources\DistribusiBukuPakets\Tables\DistribusiBukuPaketTable;
use App\Models\TextbookDistribution;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DistribusiBukuPaketResource extends Resource
{
    protected static ?string $model = TextbookDistribution::class;
    protected static ?string $slug  = 'distribusi-buku-paket';

    protected static ?string $navigationLabel               = 'Distribusi Buku Paket';
    protected static string|\UnitEnum|null $navigationGroup = 'Buku Paket';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;
    protected static ?int    $navigationSort                = 3;
    protected static ?string $modelLabel                   = 'Distribusi';
    protected static ?string $pluralModelLabel             = 'Distribusi Buku Paket';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::PetugasPerpustakaan;
    }

    public static function canCreate(): bool  { return false; }
    public static function canEdit($record): bool { return false; }
    public static function canDelete($record): bool { return false; }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return DistribusiBukuPaketTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDistribusiBukuPaket::route('/'),
            'view'  => ViewDistribusiBukuPaket::route('/{record}/detail'),
        ];
    }
}
