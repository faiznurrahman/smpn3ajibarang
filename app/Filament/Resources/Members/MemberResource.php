<?php

namespace App\Filament\Resources\Members;

use App\Enums\UserRole;
use App\Filament\Resources\Members\Pages\CreateMember;
use App\Filament\Resources\Members\Pages\EditMember;
use App\Filament\Resources\Members\Pages\ListMembers;
use App\Filament\Resources\Members\Schemas\MemberForm;
use App\Filament\Resources\Members\Tables\MembersTable;
use App\Models\Member;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationLabel            = 'Data Anggota';
    protected static string|\UnitEnum|null $navigationGroup = 'Perpustakaan';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;
    protected static ?int    $navigationSort             = 2;
    protected static ?string $modelLabel                = 'Anggota';
    protected static ?string $pluralModelLabel          = 'Data Anggota';

    protected static ?string $recordTitleAttribute = 'nama';

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
        return MemberForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MembersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListMembers::route('/'),
            'create' => CreateMember::route('/create'),
            'edit'   => EditMember::route('/{record}/edit'),
        ];
    }
}
