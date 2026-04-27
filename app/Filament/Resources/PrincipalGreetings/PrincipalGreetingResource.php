<?php

namespace App\Filament\Resources\PrincipalGreetings;

use App\Filament\Resources\PrincipalGreetings\Pages\CreatePrincipalGreeting;
use App\Filament\Resources\PrincipalGreetings\Pages\EditPrincipalGreeting;
use App\Filament\Resources\PrincipalGreetings\Pages\ListPrincipalGreetings;
use App\Filament\Resources\PrincipalGreetings\Schemas\PrincipalGreetingForm;
use App\Filament\Resources\PrincipalGreetings\Tables\PrincipalGreetingsTable;
use App\Models\PrincipalGreeting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PrincipalGreetingResource extends Resource
{
    protected static ?string $model = PrincipalGreeting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama_kepala_sekolah';

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
