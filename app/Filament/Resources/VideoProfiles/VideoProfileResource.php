<?php

namespace App\Filament\Resources\VideoProfiles;

use App\Filament\Resources\VideoProfiles\Pages\CreateVideoProfile;
use App\Filament\Resources\VideoProfiles\Pages\EditVideoProfile;
use App\Filament\Resources\VideoProfiles\Pages\ListVideoProfiles;
use App\Filament\Resources\VideoProfiles\Schemas\VideoProfileForm;
use App\Filament\Resources\VideoProfiles\Tables\VideoProfilesTable;
use App\Enums\UserRole;
use App\Models\VideoProfile;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VideoProfileResource extends Resource
{
    protected static ?string $model = VideoProfile::class;
    protected static ?string $slug  = 'video-profil';

    protected static ?string $navigationLabel  = 'Video Profil';
    protected static string|\UnitEnum|null $navigationGroup = 'Konten Sekolah';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedVideoCamera;
    protected static ?int    $navigationSort  = 3;
    protected static ?string $modelLabel     = 'Video Profil';
    protected static ?string $pluralModelLabel = 'Video Profil';

    protected static ?string $recordTitleAttribute = 'judul';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === UserRole::Admin;
    }

    public static function form(Schema $schema): Schema
    {
        return VideoProfileForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VideoProfilesTable::configure($table);
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
            'index' => ListVideoProfiles::route('/'),
            'create' => CreateVideoProfile::route('/create'),
            'edit' => EditVideoProfile::route('/{record}/edit'),
        ];
    }
}
