<?php

namespace App\Filament\Resources\TextbookLoans\Pages;

use App\Filament\Resources\TextbookLoans\TextbookLoanResource;
use App\Models\Member;
use App\Models\TextbookDistribution;
use App\Models\TextbookDistributionItem;
use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class ViewTextbookLoan extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = TextbookLoanResource::class;

    protected string $view = 'filament.admin.resources.textbook-loans.pages.view-textbook-loan';

    public int $recordId;
    public ?TextbookDistribution $distribution = null;

    public function mount(int|string $record): void
    {
        $this->recordId     = (int) $record;
        $this->distribution = TextbookDistribution::findOrFail($this->recordId);
    }

    public function getTitle(): string
    {
        return 'Detail Distribusi — ' . $this->distribution->tahun_ajaran
            . ' (Kelas ' . $this->distribution->untuk_tingkat . ')';
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function table(Table $table): Table
    {
        $distributionId = $this->recordId;

        return $table
            ->query(
                Member::query()
                    ->whereIn('id',
                        TextbookDistributionItem::where('distribution_id', $distributionId)
                            ->distinct()
                            ->pluck('member_id')
                    )
                    ->orderBy('kode_anggota')
            )
            ->columns([
                TextColumn::make('kode_anggota')
                    ->label('NIS')
                    ->searchable()
                    ->fontFamily('mono')
                    ->size('sm')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('nama')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->weight('semibold')
                    ->grow()
                    ->description(fn (Member $record) => $record->kelas ? 'Kelas ' . $record->kelas : null),

                TextColumn::make('total_buku')
                    ->label('Total Buku')
                    ->alignCenter()
                    ->getStateUsing(fn (Member $record) => TextbookDistributionItem::where('distribution_id', $distributionId)
                        ->where('member_id', $record->id)
                        ->count()),

                TextColumn::make('sudah_kembali')
                    ->label('Sudah Kembali')
                    ->alignCenter()
                    ->getStateUsing(fn (Member $record) => TextbookDistributionItem::where('distribution_id', $distributionId)
                        ->where('member_id', $record->id)
                        ->whereNotNull('tgl_kembali_aktual')
                        ->count()),

                TextColumn::make('status_pengembalian')
                    ->label('Status')
                    ->badge()
                    ->getStateUsing(function (Member $record) use ($distributionId) {
                        $total    = TextbookDistributionItem::where('distribution_id', $distributionId)->where('member_id', $record->id)->count();
                        $returned = TextbookDistributionItem::where('distribution_id', $distributionId)->where('member_id', $record->id)->whereNotNull('tgl_kembali_aktual')->count();
                        return $total > 0 && $total === $returned ? 'selesai' : 'belum_selesai';
                    })
                    ->formatStateUsing(fn ($state) => $state === 'selesai' ? 'Selesai' : 'Belum Selesai')
                    ->color(fn ($state) => $state === 'selesai' ? 'success' : 'warning'),
            ])
            ->recordActions([
                \Filament\Actions\Action::make('kembalikan')
                    ->label('Kembalikan')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('success')
                    ->modalHeading(fn (Member $record) => 'Pengembalian Buku — ' . $record->nama)
                    ->modalDescription('Centang buku yang dikembalikan. Buku tidak dicentang → wajib pilih sanksi.')
                    ->modalWidth('4xl')
                    ->visible(function (Member $record) use ($distributionId) {
                        return TextbookDistributionItem::where('distribution_id', $distributionId)
                            ->where('member_id', $record->id)
                            ->whereNull('tgl_kembali_aktual')
                            ->exists();
                    })
                    ->fillForm(function (Member $record) use ($distributionId) {
                        $items = TextbookDistributionItem::where('distribution_id', $distributionId)
                            ->where('member_id', $record->id)
                            ->whereNull('tgl_kembali_aktual')
                            ->with('textbookItem.textbook')
                            ->get()
                            ->map(fn ($item) => [
                                'id'                  => $item->id,
                                'kode_item'           => $item->textbookItem->kode_item,
                                'judul'               => $item->textbookItem->textbook->judul,
                                'dikembalikan'        => true,
                                'kondisi_atau_sanksi' => 'baik',
                            ])
                            ->values()
                            ->toArray();

                        return ['items' => $items];
                    })
                    ->form([
                        Repeater::make('items')
                            ->hiddenLabel()
                            ->schema([
                                Hidden::make('id'),

                                Checkbox::make('dikembalikan')
                                    ->label('Kembali?')
                                    ->default(true)
                                    ->live()
                                    ->afterStateUpdated(fn ($state, $set) => $set(
                                        'kondisi_atau_sanksi',
                                        $state ? 'baik' : 'bayar_harga'
                                    )),

                                TextInput::make('kode_item')
                                    ->label('Kode Eksemplar')
                                    ->disabled()
                                    ->dehydrated(false),

                                TextInput::make('judul')
                                    ->label('Judul Buku')
                                    ->disabled()
                                    ->dehydrated(false),

                                Select::make('kondisi_atau_sanksi')
                                    ->label('Kondisi / Sanksi')
                                    ->options(fn ($get) => (bool) $get('dikembalikan')
                                        ? [
                                            'baik'        => 'Baik',
                                            'rusak_ringan'=> 'Rusak Ringan',
                                            'rusak_berat' => 'Rusak Berat',
                                            'hilang'      => 'Hilang',
                                        ]
                                        : [
                                            'bayar_harga' => 'Bayar Harga Buku',
                                            'ganti_buku'  => 'Ganti Buku',
                                        ]
                                    )
                                    ->required()
                                    ->live(),
                            ])
                            ->table([
                                TableColumn::make('Kembali?')->width('80px'),
                                TableColumn::make('Kode Eksemplar')->width('130px'),
                                TableColumn::make('Judul Buku'),
                                TableColumn::make('Kondisi / Sanksi')->width('190px'),
                            ])
                            ->addable(false)
                            ->deletable(false)
                            ->reorderable(false)
                            ->extraAttributes(['style' => 'max-height: 380px; overflow-y: auto;']),
                    ])
                    ->action(function (Member $record, array $data) use ($distributionId) {
                        foreach ($data['items'] as $itemData) {
                            $item = TextbookDistributionItem::find($itemData['id']);
                            if (! $item) {
                                continue;
                            }

                            if ($itemData['dikembalikan']) {
                                $kondisi = $itemData['kondisi_atau_sanksi'];
                                $jenisSanksi  = match ($kondisi) {
                                    'rusak_ringan', 'rusak_berat' => 'bayar_harga',
                                    'hilang'                      => 'ganti_buku',
                                    default                       => 'tidak_ada',
                                };
                                $statusSanksi = $jenisSanksi !== 'tidak_ada' ? 'belum_lunas' : 'tidak_ada';

                                $item->update([
                                    'kondisi_kembali'    => $kondisi,
                                    'jenis_sanksi'       => $jenisSanksi,
                                    'status_sanksi'      => $statusSanksi,
                                    'tgl_kembali_aktual' => today(),
                                ]);

                                $item->textbookItem->update([
                                    'kondisi'      => in_array($kondisi, ['rusak_ringan', 'rusak_berat']) ? 'rusak' : $kondisi,
                                    'is_available' => $kondisi !== 'hilang',
                                ]);
                            } else {
                                $item->update([
                                    'jenis_sanksi'  => $itemData['kondisi_atau_sanksi'],
                                    'status_sanksi' => 'belum_lunas',
                                ]);
                            }
                        }

                        $allReturned = TextbookDistributionItem::where('distribution_id', $distributionId)
                            ->whereNull('tgl_kembali_aktual')
                            ->doesntExist();

                        if ($allReturned) {
                            TextbookDistribution::find($distributionId)?->update(['status' => 'selesai']);
                            $this->distribution->refresh();
                        }

                        Notification::make()
                            ->title('Pengembalian berhasil dicatat')
                            ->success()
                            ->send();
                    }),
            ])
            ->defaultSort('kode_anggota');
    }
}
