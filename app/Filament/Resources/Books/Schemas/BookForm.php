<?php

namespace App\Filament\Resources\Books\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
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

class BookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->columns(1)->components([

            Section::make('Data Utama Buku')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('kode_buku')
                            ->label('Kode Buku')
                            ->placeholder('Auto-generate')
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('isbn')
                            ->label('ISBN')
                            ->placeholder('Contoh: 978-602-1234-56-7')
                            ->maxLength(20),
                    ]),

                    TextInput::make('judul')
                        ->label('Judul Buku')
                        ->required()
                        ->columnSpanFull(),

                    TextInput::make('anak_judul')
                        ->label('Anak Judul')
                        ->placeholder('Subjudul buku (opsional)')
                        ->columnSpanFull(),

                    Grid::make(2)->schema([
                        TextInput::make('penulis')
                            ->label('Penulis')
                            ->required(),

                        TextInput::make('pengarang_tambahan')
                            ->label('Pengarang Tambahan')
                            ->placeholder('Editor / Penerjemah / Ilustrator (opsional)')
                            ->hint('Opsional'),

                        TextInput::make('penerbit')
                            ->label('Penerbit'),

                        TextInput::make('tahun')
                            ->label('Tahun Terbit')
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue(date('Y')),

                        Select::make('kategori')
                            ->label('Kategori / Genre')
                            ->options([
                                'Fiksi'             => 'Fiksi',
                                'Non-Fiksi'         => 'Non-Fiksi',
                                'Pelajaran'         => 'Pelajaran',
                                'Referensi'         => 'Referensi',
                                'Ensiklopedi'       => 'Ensiklopedi',
                                'Biografi'          => 'Biografi',
                                'Sains & Teknologi' => 'Sains & Teknologi',
                                'Sosial & Budaya'   => 'Sosial & Budaya',
                                'Agama'             => 'Agama',
                                'Lainnya'           => 'Lainnya',
                            ])
                            ->searchable(),

                        TextInput::make('rak')
                            ->label('Rak / Lokasi Buku')
                            ->placeholder('Contoh: Rak A-1'),
                    ]),

                    FileUpload::make('cover')
                        ->label('Cover Buku')
                        ->image()
                        ->directory('buku')
                        ->imageEditor()
                        ->columnSpanFull(),

                    Textarea::make('deskripsi')
                        ->label('Deskripsi / Sinopsis')
                        ->rows(4)
                        ->columnSpanFull(),
                ]),

            Section::make('Informasi Katalog')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('no_panggil')
                            ->label('No. Panggil'),

                        TextInput::make('edisi')
                            ->label('Edisi / Cetakan'),

                        TextInput::make('kota_terbit')
                            ->label('Kota Terbit'),

                        Select::make('bahasa')
                            ->label('Bahasa')
                            ->searchable()
                            ->default('ind')
                            ->options([
                                'ind' => 'Indonesia',
                                'eng' => 'Inggris',
                                'ara' => 'Arab',
                                'chi' => 'Cina',
                                'dut' => 'Belanda',
                                'fre' => 'Perancis',
                                'ger' => 'Jerman',
                                'jpn' => 'Jepang',
                                'may' => 'Melayu',
                                'per' => 'Persian (Iran)',
                                'rsa' => 'Rusia',
                                'spa' => 'Spanyol',
                            ]),

                        TextInput::make('jumlah_halaman')
                            ->label('Jumlah Halaman')
                            ->numeric()
                            ->suffix('hal.'),

                        TextInput::make('dimensi')
                            ->label('Dimensi')
                            ->placeholder('contoh: 14.8 x 21 cm'),

                        Select::make('bentuk_karya')
                            ->label('Bentuk Karya Tulis')
                            ->searchable()
                            ->nullable()
                            ->placeholder('Pilih bentuk karya')
                            ->options([
                                '0' => 'Bukan Fiksi',
                                '1' => 'Fiksi Umum',
                                'f' => 'Novel',
                                'j' => 'Cerita Pendek',
                                'd' => 'Drama',
                                'p' => 'Puisi',
                                'e' => 'Esai',
                                '|' => 'Tidak Ada Kode yang Sesuai',
                            ]),

                        Select::make('sumber')
                            ->label('Sumber Pengadaan')
                            ->options([
                                'beli'      => 'Pembelian',
                                'hibah'     => 'Hibah',
                                'sumbangan' => 'Sumbangan',
                            ]),

                        DatePicker::make('tgl_masuk')
                            ->label('Tanggal Masuk Koleksi'),

                        TextInput::make('harga')
                            ->label('Harga Buku (Rp)')
                            ->numeric()
                            ->prefix('Rp')
                            ->hint('Digunakan sebagai referensi nominal sanksi'),
                    ]),
                ]),

            // ── CREATE: tentukan jumlah & kondisi eksemplar awal ──────────
            Section::make('Eksemplar')
                ->hidden(fn ($record) => $record !== null)
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('jumlah_eksemplar')
                            ->label('Jumlah Eksemplar')
                            ->numeric()
                            ->default(1)
                            ->minValue(1)
                            ->required()
                            ->hint('Eksemplar akan di-generate otomatis saat buku disimpan')
                            ->dehydrated(false),

                        Select::make('kondisi_eksemplar')
                            ->label('Kondisi Awal Eksemplar')
                            ->options(['baik' => 'Baik', 'rusak' => 'Rusak'])
                            ->default('baik')
                            ->dehydrated(false),
                    ]),
                ]),

            // ── EDIT: tampilkan daftar eksemplar yang sudah ada ───────────
            Section::make('Eksemplar')
                ->hidden(fn ($record) => $record === null)
                ->headerActions([
                    Action::make('tambah_eksemplar')
                        ->label('Tambah Eksemplar')
                        ->icon('heroicon-o-plus')
                        ->color('gray')
                        ->modalHeading('Tambah Eksemplar')
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

                            $items = $record->bookItems()->orderBy('kode_item')->get();

                            if ($items->isEmpty()) {
                                return new HtmlString(
                                    '<p style="color:#9ca3af;font-size:13px;padding:4px 0;">'
                                    . 'Belum ada eksemplar. Klik "Tambah Eksemplar" untuk menambahkan.'
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
                                : '<span style="display:inline-flex;align-items:center;padding:1px 8px;border-radius:999px;font-size:10.5px;font-weight:600;background:#fee2e2;color:#dc2626;">Dipinjam</span>';

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

            Section::make('Status')
                ->schema([
                    Toggle::make('is_active')
                        ->label('Aktif — buku dapat dipinjam')
                        ->default(true),
                ]),

        ]);
    }
}
