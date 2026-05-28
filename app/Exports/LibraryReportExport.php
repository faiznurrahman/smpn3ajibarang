<?php

namespace App\Exports;

use App\Models\Fine;
use App\Models\Loan;
use App\Models\Visit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
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
            new LibraryDendaSheet($this->bulan, $this->tahun, $this->semua),
            new LibraryKunjunganSheet($this->bulan, $this->tahun, $this->semua),
        ];
    }
}

// ============================================================
//  Sheet 1 — Ringkasan
// ============================================================
class LibraryRingkasanSheet implements FromCollection, WithTitle, WithHeadings, WithStyles, WithColumnWidths
{
    public function __construct(
        private readonly ?int $bulan,
        private readonly ?int $tahun,
        private readonly bool $semua
    ) {}

    public function title(): string { return 'Ringkasan'; }

    public function headings(): array
    {
        return ['Kategori', 'Keterangan', 'Jumlah'];
    }

    public function collection(): Collection
    {
        $bulan = $this->bulan ?? now()->month;
        $tahun = $this->tahun ?? now()->year;
        $label = $this->semua ? 'Semua Periode' : \Carbon\Carbon::create($tahun, $bulan)->locale('id')->isoFormat('MMMM YYYY');

        $loanQ = Loan::query();
        $fineQ = Fine::query();
        $visitQ = Visit::query();

        if (! $this->semua) {
            $loanQ->whereMonth('tgl_pinjam', $bulan)->whereYear('tgl_pinjam', $tahun);
            $fineQ->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun);
            $visitQ->whereMonth('tgl_kunjungan', $bulan)->whereYear('tgl_kunjungan', $tahun);
        }

        return collect([
            ['Laporan', 'Periode', $label],
            ['Laporan', 'Tanggal Cetak', now()->locale('id')->isoFormat('D MMMM YYYY, HH:mm')],
            ['', '', ''],
            ['Peminjaman', 'Total Transaksi', $loanQ->count()],
            ['Peminjaman', 'Sedang Dipinjam', (clone $loanQ)->where('status', 'dipinjam')->count()],
            ['Peminjaman', 'Sudah Dikembalikan', (clone $loanQ)->where('status', 'dikembalikan')->count()],
            ['Peminjaman', 'Terlambat', (clone $loanQ)->where('status', 'terlambat')->count()],
            ['', '', ''],
            ['Denda', 'Total Kasus', $fineQ->count()],
            ['Denda', 'Nominal Total (Rp)', number_format((clone $fineQ)->sum('nominal'), 0, ',', '.')],
            ['Denda', 'Sudah Lunas (Rp)', number_format((clone $fineQ)->where('status_bayar', 'lunas')->sum('nominal'), 0, ',', '.')],
            ['Denda', 'Belum Lunas (Rp)', number_format((clone $fineQ)->where('status_bayar', 'belum_lunas')->sum('nominal'), 0, ',', '.')],
            ['', '', ''],
            ['Kunjungan', 'Total Kunjungan', $visitQ->count()],
            ['Kunjungan', 'Siswa', (clone $visitQ)->where('jenis_pengunjung', 'siswa')->count()],
            ['Kunjungan', 'Guru / Staf', (clone $visitQ)->where('jenis_pengunjung', 'guru')->count()],
            ['Kunjungan', 'Tamu Umum', (clone $visitQ)->where('jenis_pengunjung', 'umum')->count()],
        ]);
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1  => ['font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']], 'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF1E3A8A']]],
            4  => ['font' => ['bold' => true, 'color' => ['argb' => 'FF1E3A8A']]],
            9  => ['font' => ['bold' => true, 'color' => ['argb' => 'FF1E3A8A']]],
            14 => ['font' => ['bold' => true, 'color' => ['argb' => 'FF1E3A8A']]],
        ];
    }

    public function columnWidths(): array
    {
        return ['A' => 18, 'B' => 28, 'C' => 22];
    }
}

// ============================================================
//  Sheet 2 — Peminjaman
// ============================================================
class LibraryPeminjamanSheet implements FromCollection, WithTitle, WithHeadings, WithStyles, WithColumnWidths
{
    public function __construct(
        private readonly ?int $bulan,
        private readonly ?int $tahun,
        private readonly bool $semua
    ) {}

    public function title(): string { return 'Peminjaman'; }

    public function headings(): array
    {
        return ['No', 'Tgl Pinjam', 'Kode Anggota', 'Nama Anggota', 'Kode Buku', 'Judul Buku', 'Batas Kembali', 'Tgl Kembali', 'Status', 'Denda (Rp)', 'Status Denda'];
    }

    public function collection(): Collection
    {
        $bulan = $this->bulan ?? now()->month;
        $tahun = $this->tahun ?? now()->year;

        $loans = Loan::with(['book', 'member', 'fine'])
            ->when(! $this->semua, fn ($q) => $q->whereMonth('tgl_pinjam', $bulan)->whereYear('tgl_pinjam', $tahun))
            ->orderByDesc('tgl_pinjam')
            ->get();

        return $loans->map(fn ($l, $i) => [
            $i + 1,
            $l->tgl_pinjam?->format('d/m/Y') ?? '-',
            $l->member?->kode_anggota ?? '-',
            $l->member?->nama ?? '-',
            $l->book?->kode_buku ?? '-',
            $l->book?->judul ?? '-',
            $l->tgl_batas_kembali?->format('d/m/Y') ?? '-',
            $l->tgl_kembali?->format('d/m/Y') ?? '-',
            match ($l->status) { 'dipinjam' => 'Dipinjam', 'dikembalikan' => 'Dikembalikan', 'terlambat' => 'Terlambat', default => $l->status },
            $l->fine ? $l->fine->nominal : 0,
            $l->fine ? ($l->fine->status_bayar === 'lunas' ? 'Lunas' : 'Belum Lunas') : '-',
        ]);
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']], 'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF1E3A8A']]],
        ];
    }

    public function columnWidths(): array
    {
        return ['A' => 5, 'B' => 13, 'C' => 16, 'D' => 28, 'E' => 12, 'F' => 38, 'G' => 14, 'H' => 14, 'I' => 14, 'J' => 14, 'K' => 14];
    }
}

// ============================================================
//  Sheet 3 — Denda
// ============================================================
class LibraryDendaSheet implements FromCollection, WithTitle, WithHeadings, WithStyles, WithColumnWidths
{
    public function __construct(
        private readonly ?int $bulan,
        private readonly ?int $tahun,
        private readonly bool $semua
    ) {}

    public function title(): string { return 'Denda'; }

    public function headings(): array
    {
        return ['No', 'Kode Anggota', 'Nama Anggota', 'Judul Buku', 'Tgl Kembali', 'Hari Terlambat', 'Nominal (Rp)', 'Status Bayar', 'Tgl Lunas'];
    }

    public function collection(): Collection
    {
        $bulan = $this->bulan ?? now()->month;
        $tahun = $this->tahun ?? now()->year;

        $fines = Fine::with(['loan.book', 'loan.member'])
            ->when(! $this->semua, fn ($q) => $q->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun))
            ->orderByDesc('created_at')
            ->get();

        return $fines->map(fn ($f, $i) => [
            $i + 1,
            $f->loan?->member?->kode_anggota ?? '-',
            $f->loan?->member?->nama ?? '-',
            $f->loan?->book?->judul ?? '-',
            $f->loan?->tgl_kembali?->format('d/m/Y') ?? '-',
            $f->jumlah_hari,
            $f->nominal,
            $f->status_bayar === 'lunas' ? 'Lunas' : 'Belum Lunas',
            $f->tgl_bayar?->format('d/m/Y') ?? '-',
        ]);
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']], 'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF1E3A8A']]],
        ];
    }

    public function columnWidths(): array
    {
        return ['A' => 5, 'B' => 16, 'C' => 28, 'D' => 38, 'E' => 13, 'F' => 14, 'G' => 14, 'H' => 14, 'I' => 13];
    }
}

// ============================================================
//  Sheet 4 — Kunjungan
// ============================================================
class LibraryKunjunganSheet implements FromCollection, WithTitle, WithHeadings, WithStyles, WithColumnWidths
{
    public function __construct(
        private readonly ?int $bulan,
        private readonly ?int $tahun,
        private readonly bool $semua
    ) {}

    public function title(): string { return 'Kunjungan'; }

    public function headings(): array
    {
        return ['No', 'Tanggal', 'Jam', 'Nama', 'Jenis Pengunjung', 'Kelas', 'Keperluan'];
    }

    public function collection(): Collection
    {
        $bulan = $this->bulan ?? now()->month;
        $tahun = $this->tahun ?? now()->year;

        $visits = Visit::query()
            ->when(! $this->semua, fn ($q) => $q->whereMonth('tgl_kunjungan', $bulan)->whereYear('tgl_kunjungan', $tahun))
            ->orderByDesc('tgl_kunjungan')->orderByDesc('jam_kunjungan')
            ->get();

        return $visits->map(fn ($v, $i) => [
            $i + 1,
            $v->tgl_kunjungan?->format('d/m/Y') ?? '-',
            $v->jam_kunjungan ? substr($v->jam_kunjungan, 0, 5) : '-',
            $v->nama,
            match ($v->jenis_pengunjung) { 'siswa' => 'Siswa', 'guru' => 'Guru / Staf', 'umum' => 'Tamu Umum', default => $v->jenis_pengunjung },
            $v->kelas ?? '-',
            $v->keperluan ?? '-',
        ]);
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']], 'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF1E3A8A']]],
        ];
    }

    public function columnWidths(): array
    {
        return ['A' => 5, 'B' => 13, 'C' => 8, 'D' => 28, 'E' => 17, 'F' => 10, 'G' => 28];
    }
}
