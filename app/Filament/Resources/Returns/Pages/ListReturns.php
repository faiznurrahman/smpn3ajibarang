<?php

namespace App\Filament\Resources\Returns\Pages;

use App\Filament\Resources\Returns\ReturnResource;
use App\Models\Loan;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListReturns extends ListRecords
{
    protected static string $resource = ReturnResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTabs(): array
    {
        $lateCount = Loan::where('status', 'terlambat')->whereNull('tgl_kembali')->count();

        return [
            'aktif' => Tab::make('Perlu Dikembalikan')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereIn('status', ['dipinjam', 'terlambat'])->whereNull('tgl_kembali'))
                ->badge($lateCount ?: null)
                ->badgeColor('danger'),

            'riwayat' => Tab::make('Riwayat Pengembalian')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNotNull('tgl_kembali')),
        ];
    }
}
