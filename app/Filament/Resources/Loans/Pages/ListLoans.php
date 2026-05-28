<?php

namespace App\Filament\Resources\Loans\Pages;

use App\Filament\Resources\Loans\LoanResource;
use App\Models\Loan;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListLoans extends ListRecords
{
    protected static string $resource = LoanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Catat Peminjaman'),
        ];
    }

    public function getTabs(): array
    {
        $aktifCount = Loan::whereIn('status', ['dipinjam', 'terlambat'])->count();

        return [
            'aktif' => Tab::make('Aktif')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereIn('status', ['dipinjam', 'terlambat']))
                ->badge($aktifCount ?: null)
                ->badgeColor('warning'),

            'riwayat' => Tab::make('Riwayat')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'dikembalikan')),
        ];
    }
}
