<?php

namespace App\Exports;

use App\Models\Book;
use App\Models\Fine;
use App\Models\Loan;
use App\Models\Member;
use App\Models\TextbookDistribution;
use App\Models\TextbookDistributionItem;
use App\Models\Visit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LibraryReportExport implements WithMultipleSheets
{
    public function __construct(
        public readonly ?int $bulan,
        public readonly ?int $tahun,
        public readonly bool $semua
    ) {}

    public function sheets(): array
    {
        return [
            new LibraryRingkasanSheet($this->bulan, $this->tahun, $this->semua),
            new LibraryPeminjamanSheet($this->bulan, $this->tahun, $this->semua),
            new LibraryPengembalianSheet($this->bulan, $this->tahun, $this->semua),
            new LibraryDendaSheet($this->bulan, $this->tahun, $this->semua),
            new LibraryKunjunganSheet($this->bulan, $this->tahun, $this->semua),
        ];
    }
}

// ============================================================
//  Sheet 1 — Rekap
// ============================================================
class LibraryRingkasanSheet implements FromArray, WithTitle, WithColumnWidths, WithEvents
{
    private string $periodeLabel;

    public function __construct(
        private readonly ?int $bulan,
        private readonly ?int $tahun,
        private readonly bool $semua
    ) {
        $b = $this->bulan ?? now()->month;
        $t = $this->tahun ?? now()->year;
        $this->periodeLabel = $this->semua
            ? 'Semua Periode'
            : \Carbon\Carbon::create($t, $b)->locale('id')->isoFormat('MMMM YYYY');
    }

    public function title(): string { return 'Rekap'; }

    public function array(): array
    {
        $b = $this->bulan ?? now()->month;
        $t = $this->tahun ?? now()->year;

        $loanQ  = Loan::query();
        $fineQ  = Fine::query();
        $visitQ = Visit::query();

        if (!$this->semua) {
            $loanQ->whereMonth('tgl_pinjam', $b)->whereYear('tgl_pinjam', $t);
            $fineQ->whereMonth('created_at', $b)->whereYear('created_at', $t);
            $visitQ->whereMonth('tgl_kunjungan', $b)->whereYear('tgl_kunjungan', $t);
        }

        $totalBuku      = Book::count();
        $totalEksemplar = Book::sum('stok');
        $bukuAktif      = Book::where('is_active', true)->count();

        $anggotaAktif = Member::where('status', 'aktif')->count();
        $siswaAktif   = Member::where('status', 'aktif')->where('jenis', 'siswa')->count();
        $guruAktif    = Member::where('status', 'aktif')->where('jenis', 'guru')->count();

        $totalLoan      = $loanQ->count();
        $dipinjam       = (clone $loanQ)->where('status', 'dipinjam')->count();
        $dikembalikan   = (clone $loanQ)->where('status', 'dikembalikan')->count();
        $terlambat      = (clone $loanQ)->where('status', 'terlambat')->count();

        $totalDenda  = $fineQ->count();
        $totalNominal = (clone $fineQ)->sum('nominal');
        $totalLunas  = (clone $fineQ)->where('status_bayar', 'lunas')->sum('nominal');
        $totalBelum  = (clone $fineQ)->where('status_bayar', 'belum_lunas')->sum('nominal');

        $totalVisit  = $visitQ->count();
        $visitSiswa  = (clone $visitQ)->where('jenis_pengunjung', 'siswa')->count();
        $visitGuru   = (clone $visitQ)->where('jenis_pengunjung', 'guru')->count();
        $visitUmum   = (clone $visitQ)->where('jenis_pengunjung', 'umum')->count();

        $distribusiAktif  = TextbookDistribution::where('status', 'aktif')->count();
        $sanksiBelumLunas = TextbookDistributionItem::where('status_sanksi', 'belum_lunas')->count();

        return [
            ['LAPORAN PERPUSTAKAAN SMP NEGERI 3 AJIBARANG', ''],
            ['Periode', $this->periodeLabel],
            ['Tanggal Cetak', now()->locale('id')->isoFormat('D MMMM YYYY, HH:mm')],
            ['', ''],
            ['KOLEKSI', ''],
            ['Total Judul Buku', $totalBuku],
            ['Total Eksemplar (Stok)', $totalEksemplar],
            ['Buku Aktif', $bukuAktif],
            ['', ''],
            ['KEANGGOTAAN', ''],
            ['Total Anggota Aktif', $anggotaAktif],
            ['Siswa', $siswaAktif],
            ['Guru', $guruAktif],
            ['', ''],
            ['PEMINJAMAN (' . $this->periodeLabel . ')', ''],
            ['Total Transaksi', $totalLoan],
            ['Sedang Dipinjam', $dipinjam],
            ['Sudah Dikembalikan', $dikembalikan],
            ['Terlambat', $terlambat],
            ['', ''],
            ['DENDA (' . $this->periodeLabel . ')', ''],
            ['Total Kasus', $totalDenda],
            ['Nominal Total (Rp)', 'Rp ' . number_format($totalNominal, 0, ',', '.')],
            ['Sudah Lunas (Rp)', 'Rp ' . number_format($totalLunas, 0, ',', '.')],
            ['Belum Lunas (Rp)', 'Rp ' . number_format($totalBelum, 0, ',', '.')],
            ['', ''],
            ['KUNJUNGAN (' . $this->periodeLabel . ')', ''],
            ['Total Kunjungan', $totalVisit],
            ['Siswa', $visitSiswa],
            ['Guru / Staf', $visitGuru],
            ['Tamu Umum', $visitUmum],
            ['', ''],
            ['BUKU PAKET', ''],
            ['Distribusi Aktif', $distribusiAktif],
            ['Sanksi Belum Lunas', $sanksiBelumLunas],
        ];
    }

    public function columnWidths(): array
    {
        return ['A' => 36, 'B' => 26];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Title row
                $sheet->mergeCells('A1:B1');
                $sheet->getStyle('A1')->applyFromArray([
                    'font'      => ['bold' => true, 'size' => 14, 'color' => ['argb' => 'FF1E3A8A']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                // Info rows 2–3
                $sheet->getStyle('A2:A3')->applyFromArray(['font' => ['bold' => true, 'color' => ['argb' => 'FF5A6478']]]);

                // Section header rows (navy bg, white bold text, merged)
                foreach ([5, 10, 15, 21, 27, 33] as $row) {
                    $sheet->mergeCells("A{$row}:B{$row}");
                    $sheet->getStyle("A{$row}:B{$row}")->applyFromArray([
                        'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF'], 'size' => 11],
                        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF1E3A8A']],
                        'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT],
                    ]);
                }

                // Value column B: right-align, light gray alternating
                $highestRow = $sheet->getHighestRow();
                for ($row = 1; $row <= $highestRow; $row++) {
                    $sheet->getStyle("B{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
                }

                // Alternating data rows (skip section headers and spacers)
                $dataRows   = [6,7,8, 11,12,13, 16,17,18,19, 22,23,24,25, 28,29,30,31, 34,35];
                $altColor   = 'FFEFF2F9';
                foreach ($dataRows as $idx => $row) {
                    if ($idx % 2 === 1) {
                        $sheet->getStyle("A{$row}:B{$row}")->applyFromArray([
                            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => $altColor]],
                        ]);
                    }
                }

                // Wrap text for long cells
                $sheet->getStyle('A1:B' . $highestRow)->getAlignment()->setWrapText(false);
            },
        ];
    }
}

// ============================================================
//  Sheet 2 — Peminjaman
// ============================================================
class LibraryPeminjamanSheet implements FromCollection, WithTitle, WithHeadings, WithStyles, ShouldAutoSize
{
    public function __construct(
        private readonly ?int $bulan,
        private readonly ?int $tahun,
        private readonly bool $semua
    ) {}

    public function title(): string { return 'Peminjaman'; }

    public function headings(): array
    {
        return [
            'No', 'Nama Anggota', 'Kode Anggota', 'Kelas',
            'Judul Buku', 'Kode Buku',
            'Tgl Pinjam', 'Batas Kembali', 'Tgl Kembali',
            'Hari Terlambat', 'Status',
        ];
    }

    public function collection(): Collection
    {
        $b = $this->bulan ?? now()->month;
        $t = $this->tahun ?? now()->year;

        $loans = Loan::with(['book', 'member'])
            ->when(!$this->semua, fn ($q) => $q->whereMonth('tgl_pinjam', $b)->whereYear('tgl_pinjam', $t))
            ->orderByDesc('tgl_pinjam')
            ->get();

        return $loans->map(fn ($l, $i) => [
            $i + 1,
            $l->member?->nama ?? '-',
            $l->member?->kode_anggota ?? '-',
            $l->member?->kelas ?? '-',
            $l->book?->judul ?? '-',
            $l->book?->kode_buku ?? '-',
            $l->tgl_pinjam?->format('d/m/Y') ?? '-',
            $l->tgl_batas_kembali?->format('d/m/Y') ?? '-',
            $l->tgl_kembali?->format('d/m/Y') ?? '-',
            $l->tgl_kembali && $l->tgl_batas_kembali && $l->tgl_kembali->gt($l->tgl_batas_kembali)
                ? $l->tgl_batas_kembali->diffInDays($l->tgl_kembali) : 0,
            match ($l->status) {
                'dipinjam' => 'Dipinjam', 'dikembalikan' => 'Dikembalikan',
                'terlambat' => 'Terlambat', default => $l->status,
            },
        ]);
    }

    public function styles(Worksheet $sheet): array
    {
        $sheet->getStyle('A1:K1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF1E3A8A']],
        ]);
        $highestRow = $sheet->getHighestRow();
        for ($row = 2; $row <= $highestRow; $row++) {
            if ($row % 2 === 0) {
                $sheet->getStyle("A{$row}:K{$row}")->applyFromArray([
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFEFF2F9']],
                ]);
            }
        }
        return [];
    }
}

// ============================================================
//  Sheet 3 — Pengembalian
// ============================================================
class LibraryPengembalianSheet implements FromCollection, WithTitle, WithHeadings, WithStyles, ShouldAutoSize
{
    public function __construct(
        private readonly ?int $bulan,
        private readonly ?int $tahun,
        private readonly bool $semua
    ) {}

    public function title(): string { return 'Pengembalian'; }

    public function headings(): array
    {
        return [
            'No', 'Nama Anggota', 'Kode Anggota', 'Kelas',
            'Judul Buku', 'Kode Buku',
            'Tgl Pinjam', 'Tgl Kembali', 'Kondisi',
            'Denda (Rp)', 'Jenis Sanksi', 'Nominal Sanksi (Rp)',
        ];
    }

    public function collection(): Collection
    {
        $b = $this->bulan ?? now()->month;
        $t = $this->tahun ?? now()->year;

        $loans = Loan::with(['book', 'member', 'fine'])
            ->whereNotNull('tgl_kembali')
            ->when(!$this->semua, fn ($q) => $q->whereMonth('tgl_kembali', $b)->whereYear('tgl_kembali', $t))
            ->orderByDesc('tgl_kembali')
            ->get();

        return $loans->map(fn ($l, $i) => [
            $i + 1,
            $l->member?->nama ?? '-',
            $l->member?->kode_anggota ?? '-',
            $l->member?->kelas ?? '-',
            $l->book?->judul ?? '-',
            $l->book?->kode_buku ?? '-',
            $l->tgl_pinjam?->format('d/m/Y') ?? '-',
            $l->tgl_kembali?->format('d/m/Y') ?? '-',
            match ($l->kondisi_kembali) { 'baik' => 'Baik', 'rusak' => 'Rusak', 'hilang' => 'Hilang', default => '-' },
            $l->fine ? $l->fine->nominal : 0,
            match ($l->jenis_sanksi) {
                'ganti_buku'  => 'Ganti Buku',
                'bayar_harga' => 'Bayar Harga',
                'tidak_ada'   => '-',
                default       => $l->jenis_sanksi ?? '-',
            },
            $l->nominal_sanksi ?? 0,
        ]);
    }

    public function styles(Worksheet $sheet): array
    {
        $sheet->getStyle('A1:L1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF1E3A8A']],
        ]);
        $highestRow = $sheet->getHighestRow();
        for ($row = 2; $row <= $highestRow; $row++) {
            if ($row % 2 === 0) {
                $sheet->getStyle("A{$row}:L{$row}")->applyFromArray([
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFEFF2F9']],
                ]);
            }
        }
        return [];
    }
}

// ============================================================
//  Sheet 4 — Denda
// ============================================================
class LibraryDendaSheet implements FromCollection, WithTitle, WithHeadings, WithStyles, ShouldAutoSize
{
    public function __construct(
        private readonly ?int $bulan,
        private readonly ?int $tahun,
        private readonly bool $semua
    ) {}

    public function title(): string { return 'Denda'; }

    public function headings(): array
    {
        return [
            'No', 'Nama Anggota', 'Kode Anggota', 'Kelas',
            'Judul Buku', 'Tgl Pinjam', 'Tgl Kembali',
            'Jumlah Hari', 'Nominal (Rp)', 'Status', 'Tgl Bayar',
        ];
    }

    public function collection(): Collection
    {
        $b = $this->bulan ?? now()->month;
        $t = $this->tahun ?? now()->year;

        $fines = Fine::with(['loan.book', 'loan.member'])
            ->when(!$this->semua, fn ($q) => $q->whereMonth('created_at', $b)->whereYear('created_at', $t))
            ->orderByDesc('created_at')
            ->get();

        return $fines->map(fn ($f, $i) => [
            $i + 1,
            $f->loan?->member?->nama ?? '-',
            $f->loan?->member?->kode_anggota ?? '-',
            $f->loan?->member?->kelas ?? '-',
            $f->loan?->book?->judul ?? '-',
            $f->loan?->tgl_pinjam?->format('d/m/Y') ?? '-',
            $f->loan?->tgl_kembali?->format('d/m/Y') ?? '-',
            $f->jumlah_hari,
            $f->nominal,
            $f->status_bayar === 'lunas' ? 'Lunas' : 'Belum Lunas',
            $f->tgl_bayar?->format('d/m/Y') ?? '-',
        ]);
    }

    public function styles(Worksheet $sheet): array
    {
        $sheet->getStyle('A1:K1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF1E3A8A']],
        ]);
        $highestRow = $sheet->getHighestRow();
        for ($row = 2; $row <= $highestRow; $row++) {
            if ($row % 2 === 0) {
                $sheet->getStyle("A{$row}:K{$row}")->applyFromArray([
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFEFF2F9']],
                ]);
            }
        }
        return [];
    }
}

// ============================================================
//  Sheet 5 — Kunjungan
// ============================================================
class LibraryKunjunganSheet implements FromCollection, WithTitle, WithHeadings, WithStyles, ShouldAutoSize
{
    public function __construct(
        private readonly ?int $bulan,
        private readonly ?int $tahun,
        private readonly bool $semua
    ) {}

    public function title(): string { return 'Kunjungan'; }

    public function headings(): array
    {
        return ['No', 'Nama', 'Jenis Pengunjung', 'Kelas', 'Keperluan', 'Tanggal', 'Jam'];
    }

    public function collection(): Collection
    {
        $b = $this->bulan ?? now()->month;
        $t = $this->tahun ?? now()->year;

        $visits = Visit::query()
            ->when(!$this->semua, fn ($q) => $q->whereMonth('tgl_kunjungan', $b)->whereYear('tgl_kunjungan', $t))
            ->orderByDesc('tgl_kunjungan')->orderByDesc('jam_kunjungan')
            ->get();

        return $visits->map(fn ($v, $i) => [
            $i + 1,
            $v->nama,
            match ($v->jenis_pengunjung) { 'siswa' => 'Siswa', 'guru' => 'Guru / Staf', 'umum' => 'Tamu Umum', default => $v->jenis_pengunjung },
            $v->kelas ?? '-',
            $v->keperluan ?? '-',
            $v->tgl_kunjungan?->format('d/m/Y') ?? '-',
            $v->jam_kunjungan ? substr($v->jam_kunjungan, 0, 5) : '-',
        ]);
    }

    public function styles(Worksheet $sheet): array
    {
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF1E3A8A']],
        ]);
        $highestRow = $sheet->getHighestRow();
        for ($row = 2; $row <= $highestRow; $row++) {
            if ($row % 2 === 0) {
                $sheet->getStyle("A{$row}:G{$row}")->applyFromArray([
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFEFF2F9']],
                ]);
            }
        }
        return [];
    }
}
