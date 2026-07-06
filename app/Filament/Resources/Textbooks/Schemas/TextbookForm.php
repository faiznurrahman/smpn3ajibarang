<?php

namespace App\Filament\Resources\Textbooks\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class TextbookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->columns(1)->components([

            Section::make('Data Utama')
                ->schema([
                    Grid::make(2)->schema([

                        TextInput::make('judul')
                            ->label('Judul Buku')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('anak_judul')
                            ->label('Anak Judul')
                            ->maxLength(255)
                            ->placeholder('Opsional')
                            ->columnSpanFull(),

                        TextInput::make('mata_pelajaran')
                            ->label('Mata Pelajaran')
                            ->required()
                            ->maxLength(100),

                        Select::make('untuk_tingkat')
                            ->label('Untuk Tingkat')
                            ->options([
                                7 => 'Kelas 7',
                                8 => 'Kelas 8',
                                9 => 'Kelas 9',
                            ])
                            ->required(),

                        TextInput::make('kode_prefix')
                            ->label('Kode Prefix')
                            ->required()
                            ->maxLength(20)
                            ->extraInputAttributes(['style' => 'text-transform:uppercase; letter-spacing:.04em; font-family:monospace'])
                            ->dehydrateStateUsing(fn ($state) => strtoupper($state ?? ''))
                            ->helperText('Dipakai sebagai awalan kode eksemplar. Contoh: BP7-BI, BP8-MT'),

                        TextInput::make('penerbit')
                            ->label('Penerbit')
                            ->maxLength(100)
                            ->placeholder('Opsional'),

                        TextInput::make('kota_terbit')
                            ->label('Kota Terbit')
                            ->maxLength(50)
                            ->placeholder('Opsional'),

                        TextInput::make('tahun_terbit')
                            ->label('Tahun Terbit')
                            ->maxLength(4)
                            ->placeholder('Contoh: 2023'),

                        Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->placeholder('Opsional')
                            ->columnSpanFull(),

                        FileUpload::make('cover')
                            ->label('Cover Buku')
                            ->image()
                            ->disk('public')
                            ->directory('textbook-covers')
                            ->imagePreviewHeight('120')
                            ->columnSpanFull(),

                    ]),
                ]),

            // ── CREATE: tentukan jumlah & kondisi eksemplar awal ──────────
            Section::make('Eksemplar')
                ->hidden(fn ($record) => $record !== null)
                ->schema([
                    Grid::make(2)->schema([

                        TextInput::make('total_eksemplar')
                            ->label('Total Eksemplar')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->helperText('Eksemplar akan di-generate otomatis saat data disimpan'),

                        TextInput::make('harga')
                            ->label('Harga Buku')
                            ->numeric()
                            ->prefix('Rp')
                            ->placeholder('Opsional')
                            ->helperText('Referensi nominal sanksi jika eksemplar hilang atau rusak'),

                    ]),
                ]),

            // ── EDIT: tampilkan daftar eksemplar yang sudah ada ───────────
            Section::make('Eksemplar')
                ->hidden(fn ($record) => $record === null)
                ->headerActions([
                    Action::make('tambah_eksemplar')
                        ->label('+ Tambah Eksemplar')
                        ->icon('heroicon-o-plus')
                        ->color('gray')
                        ->modalHeading('Tambah Eksemplar Buku Paket')
                        ->form([
                            TextInput::make('jumlah')
                                ->label('Jumlah')
                                ->numeric()
                                ->default(1)
                                ->minValue(1)
                                ->required(),
                            Select::make('kondisi')
                                ->label('Kondisi')
                                ->options(['baik' => 'Baik', 'rusak' => 'Rusak'])
                                ->default('baik')
                                ->required(),
                        ])
                        ->action(function (array $data, $record): void {
                            $jumlah = max(1, (int) $data['jumlah']);
                            $record->generateItems($jumlah, $data['kondisi']);
                            Notification::make()
                                ->title("{$jumlah} eksemplar berhasil ditambahkan")
                                ->success()
                                ->send();
                        }),
                ])
                ->schema([
                    Placeholder::make('daftar_eksemplar')
                        ->label('')
                        ->content(function ($record): HtmlString {
                            if (!$record) {
                                return new HtmlString('');
                            }

                            $items = $record->items()->orderBy('kode_item')->get();

                            if ($items->isEmpty()) {
                                return new HtmlString(
                                    '<p style="color:#9ca3af;font-size:13px;padding:4px 0;">'
                                    . 'Belum ada eksemplar. Klik "+ Tambah Eksemplar" untuk menambahkan.'
                                    . '</p>'
                                );
                            }

                            $thStyle = 'padding:6px 12px;font-size:10.5px;font-weight:700;'
                                . 'text-transform:uppercase;letter-spacing:.07em;color:#8b94a6;'
                                . 'text-align:left;white-space:nowrap;';
                            $tdBase  = 'padding:7px 12px;color:#0f172a;font-size:12.5px;'
                                . 'border-bottom:1px solid #f1f3f8;vertical-align:middle;';

                            $kondisiBadge = fn (string $k): string => match ($k) {
                                'baik'   => '<span style="display:inline-flex;align-items:center;padding:1px 8px;border-radius:999px;font-size:10.5px;font-weight:600;background:#dcfce7;color:#16a34a;">Baik</span>',
                                'rusak'  => '<span style="display:inline-flex;align-items:center;padding:1px 8px;border-radius:999px;font-size:10.5px;font-weight:600;background:#fef9c3;color:#ca8a04;">Rusak</span>',
                                'hilang' => '<span style="display:inline-flex;align-items:center;padding:1px 8px;border-radius:999px;font-size:10.5px;font-weight:600;background:#fee2e2;color:#dc2626;">Hilang</span>',
                                default  => htmlspecialchars($k),
                            };

                            $availBadge = fn (bool $a): string => $a
                                ? '<span style="display:inline-flex;align-items:center;padding:1px 8px;border-radius:999px;font-size:10.5px;font-weight:600;background:#dcfce7;color:#16a34a;">Tersedia</span>'
                                : '<span style="display:inline-flex;align-items:center;padding:1px 8px;border-radius:999px;font-size:10.5px;font-weight:600;background:#fef9c3;color:#ca8a04;">Dipinjam</span>';

                            $rows = $items->map(function ($item) use ($tdBase, $kondisiBadge, $availBadge): string {
                                $kode = htmlspecialchars($item->kode_item);
                                return "<tr>
                                    <td style=\"{$tdBase}font-family:monospace;font-size:12px;\">{$kode}</td>
                                    <td style=\"{$tdBase}\">{$kondisiBadge($item->kondisi)}</td>
                                    <td style=\"{$tdBase}\">{$availBadge((bool) $item->is_available)}</td>
                                </tr>";
                            })->implode('');

                            return new HtmlString("
                                <div style=\"overflow:hidden;border:1px solid #e6eaf2;border-radius:8px;\">
                                    <table style=\"width:100%;border-collapse:collapse;\">
                                        <thead>
                                            <tr style=\"background:#f8f9fc;border-bottom:1px solid #e6eaf2;\">
                                                <th style=\"{$thStyle}\">Kode Item</th>
                                                <th style=\"{$thStyle}\">Kondisi</th>
                                                <th style=\"{$thStyle}\">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>{$rows}</tbody>
                                    </table>
                                </div>
                            ");
                        }),
                ]),

            Section::make('Pengaturan')
                ->schema([
                    Toggle::make('is_active')
                        ->label('Buku Paket Aktif')
                        ->default(true),
                ]),

        ]);
    }
}
