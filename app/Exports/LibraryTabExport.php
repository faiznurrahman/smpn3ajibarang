<?php

namespace App\Exports;

use App\Models\Book;
use App\Models\Fine;
use App\Models\Loan;
use App\Models\Member;
use App\Models\Visit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LibraryTabExport implements WithMultipleSheets
{
    public function __construct(
        private readonly string $tab,
        private readonly array  $filters,
    ) {}

    public function sheets(): array
    {
        return match ($this->tab) {
            'buku'         => [new LibraryTabBukuSheet($this->filters)],
            'anggota'      => [new LibraryTabAnggotaSheet($this->filters)],
            'peminjaman'   => [new LibraryTabPeminjamanSheet($this->filters)],
            'pengembalian' => [new LibraryTabPengembalianSheet($this->filters)],
            'denda'        => [new LibraryTabDendaSheet($this->filters)],
            'kunjungan'    => [new LibraryTabKunjunganSheet($this->filters)],
            default        => [],
        };
    }
}

// -------------------------------------------------------
//  Helper trait — shared header + alternating row style
// -------------------------------------------------------
trait WithTabStyles
{
    public function styles(Worksheet $sheet): array
    {
        $lastCol = $sheet->getHighestColumn();
        $sheet->getStyle("A1:{$lastCol}1")->applyFromArray([
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF1E3A8A']],
        ]);
        $highestRow = $sheet->getHighestRow();
        for ($row = 2; $row <= $highestRow; $row++) {
            if ($row % 2 === 0) {
                $sheet->getStyle("A{$row}:{$lastCol}{$row}")->applyFromArray([
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFEFF2F9']],
                ]);
            }
        }
        return [];
    }
}

// -------------------------------------------------------
//  Tab: Buku
// -------------------------------------------------------
class LibraryTabBukuSheet implements FromCollection, WithTitle, WithHeadings, WithStyles, ShouldAutoSize
{
    use WithTabStyles;

    public function __construct(private readonly array $filters) {}

    public function title(): string { return 'Data Buku'; }

    public function headings(): array
    {
        return [
            'No', 'Kode Buku', 'Judul', 'Anak Judul', 'Pengarang', 'Pengarang Tambahan',
            'Penerbit', 'Kota Terbit', 'Tahun', 'Kategori', 'No. Panggil', 'Edisi',
            'Bahasa', 'Jumlah Halaman', 'Dimensi', 'Sumber', 'Tgl Masuk', 'Harga (Rp)',
            'Stok', 'Eksemplar Tersedia', 'Status',
        ];
    }

    public function collection(): Collection
    {
        $q = Book::query();

        if (!empty($this->filters['kategori'])) {
            $q->where('kategori', $this->filters['kategori']);
        }
        if (!empty($this->filters['status'])) {
            $q->where('is_active', $this->filters['status'] === 'aktif');
        }

        return $q->orderBy('kode_buku')->get()->map(fn ($b, $i) => [
            $i + 1,
            $b->kode_buku,
            $b->judul,
            $b->anak_judul ?? '-',
            $b->penulis ?? '-',
            $b->pengarang_tambahan ?? '-',
            $b->penerbit ?? '-',
            $b->kota_terbit ?? '-',
            $b->tahun ?? '-',
            $b->kategori ?? '-',
            $b->no_panggil ?? '-',
            $b->edisi ?? '-',
            $b->bahasa ?? '-',
            $b->jumlah_halaman ?? '-',
            $b->dimensi ?? '-',
            $b->sumber ?? '-',
            $b->tgl_masuk?->format('d/m/Y') ?? '-',
            $b->harga ?? 0,
            $b->stok,
            $b->eksemplar_tersedia,
            $b->is_active ? 'Aktif' : 'Nonaktif',
        ]);
    }
}

// -------------------------------------------------------
//  Tab: Anggota
// -------------------------------------------------------
class LibraryTabAnggotaSheet implements FromCollection, WithTitle, WithHeadings, WithStyles, ShouldAutoSize
{
    use WithTabStyles;

    public function __construct(private readonly array $filters) {}

    public function title(): string { return 'Data Anggota'; }

    public function headings(): array
    {
        return ['No', 'Kode Anggota', 'Nama', 'Jenis', 'Kelas', 'Angkatan', 'Status'];
    }

    public function collection(): Collection
    {
        $q = Member::query();

        if (!empty($this->filters['jenis'])) {
            $q->where('jenis', $this->filters['jenis']);
        }
        if (!empty($this->filters['kelas'])) {
            $q->where('kelas', $this->filters['kelas']);
        }
        if (!empty($this->filters['status_anggota'])) {
            $q->where('status', $this->filters['status_anggota']);
        }

        return $q->orderBy('nama')->get()->map(fn ($m, $i) => [
            $i + 1,
            $m->kode_anggota,
            $m->nama,
            $m->jenis === 'guru' ? 'Guru' : 'Siswa',
            $m->kelas ?? '-',
            $m->tahun_masuk ?? '-',
            match ($m->status) {
                'aktif'  => 'Aktif',  'alumni' => 'Alumni',
                'keluar' => 'Keluar', 'lulus'  => 'Lulus',
                default  => $m->status,
            },
        ]);
    }
}

// -------------------------------------------------------
//  Tab: Peminjaman
// -------------------------------------------------------
class LibraryTabPeminjamanSheet implements FromCollection, WithTitle, WithHeadings, WithStyles, ShouldAutoSize
{
    use WithTabStyles;

    public function __construct(private readonly array $filters) {}

    public function title(): string { return 'Peminjaman'; }

    public function headings(): array
    {
        return [
            'No', 'Nama Anggota', 'Kode Anggota', 'Kelas',
            'Judul Buku', 'Kode Buku', 'Kode Eksemplar',
            'Tgl Pinjam', 'Batas Kembali', 'Tgl Kembali',
            'Hari Terlambat', 'Status', 'Kondisi Kembali', 'Petugas',
        ];
    }

    public function collection(): Collection
    {
        $q = Loan::with(['book', 'member', 'bookItem', 'petugas']);

        if (!empty($this->filters['dari'])) {
            $q->whereDate('tgl_pinjam', '>=', $this->filters['dari']);
        }
        if (!empty($this->filters['sampai'])) {
            $q->whereDate('tgl_pinjam', '<=', $this->filters['sampai']);
        }
        if (!empty($this->filters['status'])) {
            $q->where('status', $this->filters['status']);
        }

        return $q->orderByDesc('tgl_pinjam')->get()->map(fn ($l, $i) => [
            $i + 1,
            $l->member?->nama ?? '-',
            $l->member?->kode_anggota ?? '-',
            $l->member?->kelas ?? '-',
            $l->book?->judul ?? '-',
            $l->book?->kode_buku ?? '-',
            $l->bookItem?->kode_item ?? '-',
            $l->tgl_pinjam?->format('d/m/Y') ?? '-',
            $l->tgl_batas_kembali?->format('d/m/Y') ?? '-',
            $l->tgl_kembali?->format('d/m/Y') ?? '-',
            $l->jumlahHariTerlambat(),
            match ($l->status) {
                'dipinjam'    => 'Dipinjam',
                'dikembalikan' => 'Dikembalikan',
                'terlambat'   => 'Terlambat',
                default       => $l->status,
            },
            match ($l->kondisi_kembali) {
                'baik'   => 'Baik',
                'rusak'  => 'Rusak',
                'hilang' => 'Hilang',
                default  => '-',
            },
            $l->petugas?->name ?? '-',
        ]);
    }
}

// -------------------------------------------------------
//  Tab: Pengembalian
// -------------------------------------------------------
class LibraryTabPengembalianSheet implements FromCollection, WithTitle, WithHeadings, WithStyles, ShouldAutoSize
{
    use WithTabStyles;

    public function __construct(private readonly array $filters) {}

    public function title(): string { return 'Pengembalian'; }

    public function headings(): array
    {
        return [
            'No', 'Nama Anggota', 'Kode Anggota', 'Kelas',
            'Judul Buku', 'Kode Buku',
            'Tgl Pinjam', 'Tgl Kembali', 'Kondisi',
            'Denda (Rp)', 'Status Denda', 'Jenis Sanksi', 'Nominal Sanksi (Rp)',
        ];
    }

    public function collection(): Collection
    {
        $q = Loan::with(['book', 'member', 'fine'])
            ->whereNotNull('tgl_kembali');

        if (!empty($this->filters['dari'])) {
            $q->whereDate('tgl_kembali', '>=', $this->filters['dari']);
        }
        if (!empty($this->filters['sampai'])) {
            $q->whereDate('tgl_kembali', '<=', $this->filters['sampai']);
        }
        if (!empty($this->filters['kondisi'])) {
            $q->where('kondisi_kembali', $this->filters['kondisi']);
        }

        return $q->orderByDesc('tgl_kembali')->get()->map(fn ($l, $i) => [
            $i + 1,
            $l->member?->nama ?? '-',
            $l->member?->kode_anggota ?? '-',
            $l->member?->kelas ?? '-',
            $l->book?->judul ?? '-',
            $l->book?->kode_buku ?? '-',
            $l->tgl_pinjam?->format('d/m/Y') ?? '-',
            $l->tgl_kembali?->format('d/m/Y') ?? '-',
            match ($l->kondisi_kembali) { 'baik' => 'Baik', 'rusak' => 'Rusak', 'hilang' => 'Hilang', default => '-' },
            $l->fine?->nominal ?? 0,
            $l->fine ? ($l->fine->status_bayar === 'lunas' ? 'Lunas' : 'Belum Lunas') : '-',
            match ($l->jenis_sanksi) {
                'ganti_buku'  => 'Ganti Buku',
                'bayar_harga' => 'Bayar Harga',
                default       => '-',
            },
            $l->nominal_sanksi ?? 0,
        ]);
    }
}

// -------------------------------------------------------
//  Tab: Denda
// -------------------------------------------------------
class LibraryTabDendaSheet implements FromCollection, WithTitle, WithHeadings, WithStyles, ShouldAutoSize
{
    use WithTabStyles;

    public function __construct(private readonly array $filters) {}

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
        $q = Fine::with(['loan.book', 'loan.member']);

        if (!empty($this->filters['dari'])) {
            $q->whereDate('created_at', '>=', $this->filters['dari']);
        }
        if (!empty($this->filters['sampai'])) {
            $q->whereDate('created_at', '<=', $this->filters['sampai']);
        }
        if (!empty($this->filters['status'])) {
            $q->where('status_bayar', $this->filters['status']);
        }

        return $q->orderByDesc('created_at')->get()->map(fn ($f, $i) => [
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
}

// -------------------------------------------------------
//  Tab: Kunjungan
// -------------------------------------------------------
class LibraryTabKunjunganSheet implements FromCollection, WithTitle, WithHeadings, WithStyles, ShouldAutoSize
{
    use WithTabStyles;

    public function __construct(private readonly array $filters) {}

    public function title(): string { return 'Kunjungan'; }

    public function headings(): array
    {
        return ['No', 'Nama', 'Jenis', 'Kelas', 'Keperluan', 'Tanggal', 'Jam'];
    }

    public function collection(): Collection
    {
        $q = Visit::query();

        if (!empty($this->filters['dari'])) {
            $q->whereDate('tgl_kunjungan', '>=', $this->filters['dari']);
        }
        if (!empty($this->filters['sampai'])) {
            $q->whereDate('tgl_kunjungan', '<=', $this->filters['sampai']);
        }
        if (!empty($this->filters['jenis'])) {
            $q->where('jenis_pengunjung', $this->filters['jenis']);
        }

        return $q->orderByDesc('tgl_kunjungan')->get()->map(fn ($v, $i) => [
            $i + 1,
            $v->nama,
            match ($v->jenis_pengunjung) { 'siswa' => 'Siswa', 'guru' => 'Guru / Staf', 'umum' => 'Tamu Umum', default => $v->jenis_pengunjung },
            $v->kelas ?? '-',
            $v->keperluan ?? '-',
            $v->tgl_kunjungan?->format('d/m/Y') ?? '-',
            $v->jam_kunjungan ? substr($v->jam_kunjungan, 0, 5) : '-',
        ]);
    }
}
