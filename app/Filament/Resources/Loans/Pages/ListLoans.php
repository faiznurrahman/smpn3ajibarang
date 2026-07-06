<?php

namespace App\Filament\Resources\Loans\Pages;

use App\Filament\Resources\Loans\LoanResource;
use App\Models\Loan;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListLoans extends ListRecords
{
    protected static string $resource = LoanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('catat_peminjaman')
                ->label('+ Catat Peminjaman')
                ->color('primary')
                ->url('/admin/catat-peminjaman'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'semua' => Tab::make('Semua')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', '!=', 'dikembalikan')),

            'aktif' => Tab::make('Aktif')
                ->badge(Loan::where('status', 'dipinjam')->count())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'dipinjam')),

            'terlambat' => Tab::make('Terlambat')
                ->badge(Loan::where('status', 'terlambat')->count())
                ->badgeColor('danger')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'terlambat')),
        ];
    }
}
