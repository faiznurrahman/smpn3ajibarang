<?php

namespace App\Filament\Resources\TextbookLoans\Pages;

use App\Filament\Resources\TextbookLoans\TextbookLoanResource;
use App\Models\Member;
use App\Models\TextbookLoan;
use App\Models\TextbookLoanItem;
use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
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
    public ?TextbookLoan $loan = null;

    public function mount(int|string $record): void
    {
        $this->recordId = (int) $record;
        $this->loan     = TextbookLoan::findOrFail($this->recordId);
    }

    public function getTitle(): string
    {
        return 'Detail Distribusi — ' . $this->loan->tahun_ajaran . ' (Kelas ' . $this->loan->untuk_tingkat . ')';
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('tambah_buku_paket')
                ->label('Tambah Buku Paket')
                ->icon('heroicon-o-plus-circle')
                ->color('primary')
                ->visible(fn () => $this->loan->status === 'aktif')
                ->form([
                    CheckboxList::make('buku_ids')
                        ->label('Pilih Buku Paket untuk Ditambahkan')
                        ->options(function () {
                            return \App\Models\Textbook::where('is_active', true)
                                ->where('untuk_tingkat', $this->loan->untuk_tingkat)
                                ->get()
                                ->mapWithKeys(fn ($t) => [
                                    $t->id => "[{$t->kode_prefix}] {$t->judul} — {$t->items()->where('is_available', true)->count()} eksemplar tersedia",
                                ]);
                        })
                        ->columns(2)
                        ->required(),
                ])
                ->action(function (array $data) {
                    $result = $this->loan->distributeToMembers($data['buku_ids']);

                    Notification::make()
                        ->title('Buku paket berhasil ditambahkan')
                        ->body("{$result['assigned']} buku didistribusikan ke {$result['siswa']} siswa.")
                        ->success()
                        ->send();
                }),
        ];
    }

    public function table(Table $table): Table
    {
        $loanId = $this->recordId;

        return $table
            ->query(
                Member::query()
                    ->whereIn('id',
                        TextbookLoanItem::where('loan_id', $loanId)
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
                    ->getStateUsing(fn (Member $record) => TextbookLoanItem::where('loan_id', $loanId)
                        ->where('member_id', $record->id)
                        ->count()),

                TextColumn::make('sudah_kembali')
                    ->label('Sudah Kembali')
                    ->alignCenter()
                    ->getStateUsing(fn (Member $record) => TextbookLoanItem::where('loan_id', $loanId)
                        ->where('member_id', $record->id)
                        ->whereNotNull('tgl_kembali_aktual')
                        ->count()),

                TextColumn::make('status_pengembalian')
                    ->label('Status')
                    ->badge()
                    ->getStateUsing(function (Member $record) use ($loanId) {
                        $total    = TextbookLoanItem::where('loan_id', $loanId)->where('member_id', $record->id)->count();
                        $returned = TextbookLoanItem::where('loan_id', $loanId)->where('member_id', $record->id)->whereNotNull('tgl_kembali_aktual')->count();
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
                    ->visible(function (Member $record) use ($loanId) {
                        return TextbookLoanItem::where('loan_id', $loanId)
                            ->where('member_id', $record->id)
                            ->whereNull('tgl_kembali_aktual')
                            ->exists();
                    })
                    ->fillForm(function (Member $record) use ($loanId) {
                        $items = TextbookLoanItem::where('loan_id', $loanId)
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
                                        $state ? 'baik' : 'ganti_buku'
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
                                            'baik'         => 'Baik',
                                            'rusak_ringan' => 'Rusak Ringan',
                                            'rusak_berat'  => 'Rusak Berat',
                                            'hilang'       => 'Hilang',
                                        ]
                                        : [
                                            'ganti_buku'  => 'Ganti Buku',
                                            'bayar_harga' => 'Bayar Harga Buku',
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
                    ->action(function (Member $record, array $data) use ($loanId) {
                        foreach ($data['items'] as $itemData) {
                            $item = TextbookLoanItem::find($itemData['id']);
                            if (! $item) {
                                continue;
                            }

                            if ($itemData['dikembalikan']) {
                                $item->update([
                                    'kondisi_kembali'    => $itemData['kondisi_atau_sanksi'],
                                    'status_sanksi'      => 'tidak_ada',
                                    'tgl_kembali_aktual' => today(),
                                ]);

                                $item->textbookItem->update([
                                    'kondisi'      => $itemData['kondisi_atau_sanksi'],
                                    'is_available' => $itemData['kondisi_atau_sanksi'] !== 'hilang',
                                ]);
                            } else {
                                $item->update([
                                    'status_sanksi' => $itemData['kondisi_atau_sanksi'],
                                ]);
                            }
                        }

                        $allReturned = TextbookLoanItem::where('loan_id', $loanId)
                            ->whereNull('tgl_kembali_aktual')
                            ->doesntExist();

                        if ($allReturned) {
                            TextbookLoan::find($loanId)?->update(['status' => 'selesai']);
                            $this->loan->refresh();
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
