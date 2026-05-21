<?php

namespace App\Filament\Resources\TextbookLoans\Pages;

use App\Filament\Resources\TextbookLoans\TextbookLoanResource;
use App\Models\Member;
use App\Models\Textbook;
use Filament\Facades\Filament;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Wizard\Step;

class CreateTextbookLoan extends CreateRecord
{
    use HasWizard;

    protected static string $resource = TextbookLoanResource::class;

    protected array $bukuIds = [];

    public function getSteps(): array
    {
        return [
            Step::make('Informasi Distribusi')
                ->icon('heroicon-o-clipboard-document-list')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('tahun_ajaran')
                            ->label('Tahun Ajaran')
                            ->placeholder('2025/2026')
                            ->helperText('Format: YYYY/YYYY')
                            ->required()
                            ->live(debounce: 500),

                        Select::make('untuk_tingkat')
                            ->label('Untuk Tingkat')
                            ->options([
                                7 => 'Kelas 7',
                                8 => 'Kelas 8',
                                9 => 'Kelas 9',
                            ])
                            ->required()
                            ->live(),

                        DatePicker::make('tgl_distribusi')
                            ->label('Tanggal Distribusi')
                            ->default(today()->format('Y-m-d'))
                            ->required(),

                        DatePicker::make('tgl_kembali')
                            ->label('Tanggal Kembali (Rencana)')
                            ->helperText('Biasanya akhir tahun ajaran')
                            ->required(),
                    ]),

                    Placeholder::make('siswa_info')
                        ->label('Jumlah Siswa')
                        ->content(function (Get $get): string {
                            $tahunAjaran = $get('tahun_ajaran');
                            $tingkat     = $get('untuk_tingkat');
                            if (! $tahunAjaran || ! $tingkat) {
                                return 'Isi tahun ajaran dan tingkat kelas untuk melihat jumlah siswa.';
                            }
                            $count = Member::aktif()->siswa()
                                ->tingkat($tahunAjaran, (int) $tingkat)
                                ->count();
                            return "{$count} siswa aktif di kelas {$tingkat} akan menerima buku paket.";
                        }),

                    Hidden::make('petugas_id')
                        ->default(fn () => Filament::auth()->user()?->id),

                    Hidden::make('status')
                        ->default('aktif'),
                ]),

            Step::make('Pilih Buku Paket')
                ->icon('heroicon-o-book-open')
                ->schema([
                    Placeholder::make('stok_info')
                        ->label('Info Stok')
                        ->content(function (Get $get): string {
                            $tingkat = (int) $get('untuk_tingkat');
                            if (! $tingkat) {
                                return 'Pilih tingkat kelas di langkah sebelumnya.';
                            }
                            $count = Textbook::where('is_active', true)
                                ->where('untuk_tingkat', $tingkat)
                                ->count();
                            return "Terdapat {$count} judul buku paket aktif untuk Kelas {$tingkat}.";
                        }),

                    CheckboxList::make('buku_ids')
                        ->label('Pilih Buku Paket yang Akan Didistribusikan')
                        ->options(function (Get $get) {
                            $tingkat = (int) $get('untuk_tingkat');
                            return Textbook::where('is_active', true)
                                ->when($tingkat, fn ($q) => $q->where('untuk_tingkat', $tingkat))
                                ->get()
                                ->mapWithKeys(fn ($t) => [
                                    $t->id => "[{$t->kode_prefix}] {$t->judul} — {$t->items()->where('is_available', true)->count()} eksemplar tersedia",
                                ]);
                        })
                        ->columns(2)
                        ->required(),
                ]),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->bukuIds = $data['buku_ids'] ?? [];
        unset($data['buku_ids']);
        return $data;
    }

    protected function afterCreate(): void
    {
        if (empty($this->bukuIds)) {
            return;
        }

        $result = $this->record->distributeToMembers($this->bukuIds);

        Notification::make()
            ->title('Distribusi buku paket berhasil')
            ->body("{$result['assigned']} buku didistribusikan ke {$result['siswa']} siswa.")
            ->success()
            ->send();
    }
}
