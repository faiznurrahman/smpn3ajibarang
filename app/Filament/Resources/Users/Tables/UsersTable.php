<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->grow(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->color('gray'),

                TextColumn::make('role')
                    ->label('Peran')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state?->value ?? $state) {
                        'admin'                => 'Admin Website',
                        'petugas_perpustakaan' => 'Petugas Perpustakaan',
                        'kepala_sekolah'       => 'Kepala Sekolah',
                        default                => $state,
                    })
                    ->color(fn ($state) => match ($state?->value ?? $state) {
                        'admin'                => 'primary',
                        'petugas_perpustakaan' => 'warning',
                        'kepala_sekolah'       => 'success',
                        default                => 'gray',
                    }),

                TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Aktif' : 'Nonaktif')
                    ->color(fn ($state) => $state ? 'success' : 'danger')
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Peran')
                    ->options([
                        'admin'                => 'Admin Website',
                        'petugas_perpustakaan' => 'Petugas Perpustakaan',
                        'kepala_sekolah'       => 'Kepala Sekolah',
                    ]),

                TernaryFilter::make('is_active')
                    ->label('Status')
                    ->trueLabel('Aktif')
                    ->falseLabel('Nonaktif'),
            ])
            ->recordActions([
                EditAction::make()->label('Edit'),

                Action::make('reset_password')
                    ->label('Reset Kata Sandi')
                    ->icon('heroicon-o-key')
                    ->color('warning')
                    ->form([
                        TextInput::make('password_baru')
                            ->label('Kata Sandi Baru')
                            ->password()
                            ->revealable()
                            ->required()
                            ->minLength(8),
                    ])
                    ->action(function ($record, array $data): void {
                        $record->update(['password' => $data['password_baru']]);

                        Notification::make()
                            ->title('Kata sandi berhasil direset')
                            ->success()
                            ->send();
                    }),
            ])
            ->defaultSort('name');
    }
}
