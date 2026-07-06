<?php

namespace App\Filament\Resources\PrincipalGreetings;

use App\Filament\Resources\PrincipalGreetings\Pages\CreatePrincipalGreeting;
use App\Filament\Resources\PrincipalGreetings\Pages\EditPrincipalGreeting;
use App\Filament\Resources\PrincipalGreetings\Pages\ListPrincipalGreetings;
use App\Filament\Resources\PrincipalGreetings\Schemas\PrincipalGreetingForm;
use App\Filament\Resources\PrincipalGreetings\Tables\PrincipalGreetingsTable;
use App\Enums\UserRole;
use App\Models\PrincipalGreeting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PrincipalGreetingResource extends Resource
{
    protected static ?string $model = PrincipalGreeting::class;
    protected static ?string $slug  = 'sambutan-kepala-sekolah';

    protected static ?string $navigationLabel  = 'Sambutan Kepala Sekolah';
    protected static string|\UnitEnum|null $navigationGroup = 'Konten Sekolah';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleBottomCenterText;
    protected static ?int    $navigationSort  = 5;
    protected static ?string $modelLabel     = 'Sambutan';
    protected static ?string $pluralModelLabel = 'Sambutan Kepala Sekolah';

    protected static ?string $recordTitleAttribute = 'nama_kepala_sekolah';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::Admin;
    }

    public static function form(Schema $schema): Schema
    {
        return PrincipalGreetingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PrincipalGreetingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
{
    return [
        'index' => EditPrincipalGreeting::route('/'),
    ];
}
}
