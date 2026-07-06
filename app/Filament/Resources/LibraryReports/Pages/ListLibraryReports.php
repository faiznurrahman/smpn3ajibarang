<?php

namespace App\Filament\Resources\LibraryReports\Pages;

use App\Enums\UserRole;
use App\Filament\Resources\LibraryReports\LibraryReportResource;
use App\Models\Book;
use App\Models\Fine;
use App\Models\Loan;
use App\Models\Member;
use App\Models\Visit;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Str;

class ListLibraryReports extends Page
{
    protected static string $resource = LibraryReportResource::class;

    public function getView(): string
    {
        if (auth()->user()?->role === UserRole::KepalaSekolah) {
            return 'filament.admin.pages.library-reports-kepsek';
        }
        return 'filament.admin.pages.library-reports';
    }

    // ================================================================
    //  PETUGAS — properties
    // ================================================================

    public string $activeTab = 'buku';
    public bool   $showData  = false;
    public int    $perPage   = 10;

    // Modal laporan bulanan
    public bool   $showModalBulanan = false;
    public int    $bulanLaporan;
    public int    $tahunLaporan;

    public int $bukuPage      = 1;
    public int $anggotaPage   = 1;
    public int $pinjamPage    = 1;
    public int $kembaliPage   = 1;
    public int $dendaPage     = 1;
    public int $kunjunganPage = 1;

    public string $bukuKategori = '';
    public string $bukuStatus   = '';

    public string $anggotaJenis  = '';
    public string $anggotaStatus = '';
    public string $anggotaKelas  = '';

    public string $pinjamStatus = '';
    public string $pinjamDari   = '';
    public string $pinjamSampai = '';

    public string $kembaliDari    = '';
    public string $kembaliSampai  = '';
    public string $kembaliKondisi = '';

    public string $dendaStatus = '';
    public string $dendaDari   = '';
    public string $dendaSampai = '';

    public string $kunjunganDari   = '';
    public string $kunjunganSampai = '';
    public string $kunjunganJenis  = '';

    // ================================================================
    //  KEPSEK — properties
    // ================================================================

    public string $ksTab     = 'peminjaman';
    public int    $ksPerPage = 15;

    public string $ksPinjamStatus = '';
    public string $ksPinjamDari   = '';
    public string $ksPinjamSampai = '';
    public int    $ksPinjamPage   = 1;

    public string $ksDendaStatus = '';
    public string $ksDendaDari   = '';
    public string $ksDendaSampai = '';
    public int    $ksDendaPage   = 1;

    public string $ksSanksiJenis  = '';
    public string $ksSanksiStatus = '';
    public int    $ksSanksiPage   = 1;

    public string $ksKunjunganJenis     = '';
    public string $ksKunjunganKeperluan = '';
    public string $ksKunjunganDari      = '';
    public string $ksKunjunganSampai    = '';
    public int    $ksKunjunganPage      = 1;

    public function mount(): void
    {
        $this->bulanLaporan = (int) now()->month;
        $this->tahunLaporan = (int) now()->year;
    }

    // ================================================================
    //  PETUGAS — reactive updaters
    // ================================================================

    public function updatedBukuKategori():   void { $this->bukuPage      = 1; }
    public function updatedBukuStatus():     void { $this->bukuPage      = 1; }
    public function updatedAnggotaJenis():   void { $this->anggotaPage   = 1; }
    public function updatedAnggotaStatus():  void { $this->anggotaPage   = 1; }
    public function updatedAnggotaKelas():   void { $this->anggotaPage   = 1; }
    public function updatedPinjamStatus():   void { $this->pinjamPage    = 1; }
    public function updatedPinjamDari():     void { $this->pinjamPage    = 1; }
    public function updatedPinjamSampai():   void { $this->pinjamPage    = 1; }
    public function updatedKembaliDari():    void { $this->kembaliPage   = 1; }
    public function updatedKembaliSampai():  void { $this->kembaliPage   = 1; }
    public function updatedKembaliKondisi(): void { $this->kembaliPage   = 1; }
    public function updatedDendaStatus():    void { $this->dendaPage     = 1; }
    public function updatedDendaDari():      void { $this->dendaPage     = 1; }
    public function updatedDendaSampai():    void { $this->dendaPage     = 1; }
    public function updatedKunjunganJenis():  void { $this->kunjunganPage = 1; }
    public function updatedKunjunganDari():   void { $this->kunjunganPage = 1; }
    public function updatedKunjunganSampai(): void { $this->kunjunganPage = 1; }

    public function updatedPerPage(): void
    {
        $this->resetCurrentTabPage();
    }

    // ================================================================
    //  PETUGAS — actions
    // ================================================================

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->showData  = false;
        $this->resetCurrentTabPage();
    }

    public function tampilkanData(): void
    {
        $this->showData = true;
        $this->resetCurrentTabPage();
    }

    public function resetFilter(): void
    {
        if ($this->activeTab === 'buku') {
            $this->bukuKategori = $this->bukuStatus = '';
        } elseif ($this->activeTab === 'anggota') {
            $this->anggotaJenis = $this->anggotaKelas = $this->anggotaStatus = '';
        } elseif ($this->activeTab === 'peminjaman') {
            $this->pinjamStatus = $this->pinjamDari = $this->pinjamSampai = '';
        } elseif ($this->activeTab === 'pengembalian') {
            $this->kembaliDari = $this->kembaliSampai = $this->kembaliKondisi = '';
        } elseif ($this->activeTab === 'denda') {
            $this->dendaStatus = $this->dendaDari = $this->dendaSampai = '';
        } elseif ($this->activeTab === 'kunjungan') {
            $this->kunjunganDari = $this->kunjunganSampai = $this->kunjunganJenis = '';
        }
        $this->showData = false;
        $this->resetCurrentTabPage();
    }

    public function goPage(string $tab, int $page): void
    {
        $prop = $tab . 'Page';
        if (property_exists($this, $prop)) {
            $this->$prop = max(1, $page);
        }
    }

    public function downloadLaporan(): void
    {
        $this->showModalBulanan = false;
        $url = route('laporan.perpustakaan.excel') . '?' . http_build_query([
            'bulan' => $this->bulanLaporan,
            'tahun' => $this->tahunLaporan,
        ]);
        $this->js('window.location.href = ' . json_encode($url));
    }

    public function exportTab(string $tab): void
    {
        $filters = match ($tab) {
            'buku'         => ['kategori' => $this->bukuKategori, 'status' => $this->bukuStatus],
            'anggota'      => ['jenis' => $this->anggotaJenis, 'kelas' => $this->anggotaKelas, 'status_anggota' => $this->anggotaStatus],
            'peminjaman'   => ['dari' => $this->pinjamDari, 'sampai' => $this->pinjamSampai, 'status' => $this->pinjamStatus],
            'pengembalian' => ['dari' => $this->kembaliDari, 'sampai' => $this->kembaliSampai, 'kondisi' => $this->kembaliKondisi],
            'denda'        => ['dari' => $this->dendaDari, 'sampai' => $this->dendaSampai, 'status' => $this->dendaStatus],
            'kunjungan'    => ['dari' => $this->kunjunganDari, 'sampai' => $this->kunjunganSampai, 'jenis' => $this->kunjunganJenis],
            default        => [],
        };
        $params = array_filter(array_merge(['tab' => $tab], $filters));
        $url = route('laporan.perpustakaan.excel.tab') . '?' . http_build_query($params);
        $this->js('window.location.href = ' . json_encode($url));
    }

    private function resetCurrentTabPage(): void
    {
        match ($this->activeTab) {
            'buku'         => $this->bukuPage      = 1,
            'anggota'      => $this->anggotaPage   = 1,
            'peminjaman'   => $this->pinjamPage    = 1,
            'pengembalian' => $this->kembaliPage   = 1,
            'denda'        => $this->dendaPage     = 1,
            'kunjungan'    => $this->kunjunganPage = 1,
            default        => null,
        };
    }

    // ================================================================
    //  KEPSEK — reactive updaters
    // ================================================================

    public function updatedKsPinjamStatus(): void { $this->ksPinjamPage    = 1; }
    public function updatedKsPinjamDari():   void { $this->ksPinjamPage    = 1; }
    public function updatedKsPinjamSampai(): void { $this->ksPinjamPage    = 1; }
    public function updatedKsDendaStatus():  void { $this->ksDendaPage     = 1; }
    public function updatedKsDendaDari():    void { $this->ksDendaPage     = 1; }
    public function updatedKsDendaSampai():  void { $this->ksDendaPage     = 1; }
    public function updatedKsSanksiJenis():  void { $this->ksSanksiPage    = 1; }
    public function updatedKsSanksiStatus(): void { $this->ksSanksiPage    = 1; }
    public function updatedKsKunjunganJenis():     void { $this->ksKunjunganPage = 1; }
    public function updatedKsKunjunganKeperluan(): void { $this->ksKunjunganPage = 1; }
    public function updatedKsKunjunganDari():      void { $this->ksKunjunganPage = 1; }
    public function updatedKsKunjunganSampai():    void { $this->ksKunjunganPage = 1; }

    // ================================================================
    //  KEPSEK — actions
    // ================================================================

    public function setKsTab(string $tab): void
    {
        $this->ksTab = $tab;
    }

    // ================================================================
    //  Common
    // ================================================================

    public function getHeaderActions(): array
    {
        return [];
    }

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return 'Laporan Perpustakaan';
    }

    protected function getViewData(): array
    {
        if (auth()->user()?->role === UserRole::KepalaSekolah) {
            return $this->loadKepsekData();
        }

        $tanggal = now()->locale('id')->translatedFormat('l, d F Y');
        $base = [
            'tanggal'   => $tanggal,
            'activeTab' => $this->activeTab,
            'perPage'   => $this->perPage,
            'showData'  => $this->showData,
            'kelasList' => Member::distinct('kelas')
                ->whereNotNull('kelas')->where('kelas', '!=', '')
                ->orderBy('kelas')->pluck('kelas', 'kelas')->toArray(),
        ] + $this->loadChartData();

        if (!$this->showData) {
            return $base;
        }

        return $base + match ($this->activeTab) {
            'buku'         => $this->loadBuku(),
            'anggota'      => $this->loadAnggota(),
            'peminjaman'   => $this->loadPeminjaman(),
            'pengembalian' => $this->loadPengembalian(),
            'denda'        => $this->loadDenda(),
            'kunjungan'    => $this->loadKunjungan(),
            default        => [],
        };
    }

    // ================================================================
    //  KEPSEK — data loaders
    // ================================================================

    private function loadKepsekData(): array
    {
        $tanggal = now()->locale('id')->translatedFormat('l, d F Y');

        return ['tanggal' => $tanggal, 'perPage' => $this->perPage] + $this->loadChartData() + match ($this->ksTab) {
            'denda'     => $this->loadKsDenda(),
            'sanksi'    => $this->loadKsSanksi(),
            'kunjungan' => $this->loadKsKunjungan(),
            default     => $this->loadKsPeminjaman(),
        };
    }

    private function loadKsPeminjaman(): array
    {
        $query = Loan::with(['book', 'member'])
            ->when($this->ksPinjamStatus, fn ($q) => $q->where('status', $this->ksPinjamStatus))
            ->when($this->ksPinjamDari,   fn ($q) => $q->whereDate('tgl_pinjam', '>=', $this->ksPinjamDari))
            ->when($this->ksPinjamSampai, fn ($q) => $q->whereDate('tgl_pinjam', '<=', $this->ksPinjamSampai))
            ->orderByDesc('tgl_pinjam');

        $counts = (clone $query)->reorder()
            ->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');

        return [
            'records'      => $query->paginate($this->ksPerPage, ['*'], 'page', $this->ksPinjamPage),
            'jmlDipinjam'  => $counts->get('dipinjam',     0),
            'jmlKembali'   => $counts->get('dikembalikan', 0),
            'jmlTerlambat' => $counts->get('terlambat',    0),
            'currentPage'  => $this->ksPinjamPage,
        ];
    }

    private function loadKsDenda(): array
    {
        $query = Fine::with(['loan.book', 'loan.member'])
            ->when($this->ksDendaStatus, fn ($q) => $q->where('status_bayar', $this->ksDendaStatus))
            ->when($this->ksDendaDari,   fn ($q) => $q->whereDate('created_at', '>=', $this->ksDendaDari))
            ->when($this->ksDendaSampai, fn ($q) => $q->whereDate('created_at', '<=', $this->ksDendaSampai))
            ->orderByDesc('created_at');

        $totals = (clone $query)->selectRaw(
            'sum(nominal) as total, sum(case when status_bayar="lunas" then nominal else 0 end) as lunas, sum(case when status_bayar="belum_lunas" then nominal else 0 end) as belum'
        )->first();

        return [
            'records'      => $query->paginate($this->ksPerPage, ['*'], 'page', $this->ksDendaPage),
            'totalNominal' => $totals->total ?? 0,
            'totalLunas'   => $totals->lunas  ?? 0,
            'totalBelum'   => $totals->belum  ?? 0,
            'currentPage'  => $this->ksDendaPage,
        ];
    }

    private function loadKsSanksi(): array
    {
        $query = Loan::with(['book', 'member'])
            ->where(fn ($q) => $q->where('status_sanksi', '!=', 'tidak_ada')->whereNotNull('status_sanksi'))
            ->when($this->ksSanksiJenis,  fn ($q) => $q->where('jenis_sanksi',  $this->ksSanksiJenis))
            ->when($this->ksSanksiStatus, fn ($q) => $q->where('status_sanksi', $this->ksSanksiStatus))
            ->orderByDesc('updated_at');

        return [
            'records'     => $query->paginate($this->ksPerPage, ['*'], 'page', $this->ksSanksiPage),
            'currentPage' => $this->ksSanksiPage,
        ];
    }

    private function loadKsKunjungan(): array
    {
        $query = Visit::query()
            ->when($this->ksKunjunganJenis,     fn ($q) => $q->where('jenis_pengunjung', $this->ksKunjunganJenis))
            ->when($this->ksKunjunganKeperluan, fn ($q) => $q->where('keperluan', $this->ksKunjunganKeperluan))
            ->when($this->ksKunjunganDari,      fn ($q) => $q->whereDate('tgl_kunjungan', '>=', $this->ksKunjunganDari))
            ->when($this->ksKunjunganSampai,    fn ($q) => $q->whereDate('tgl_kunjungan', '<=', $this->ksKunjunganSampai))
            ->orderByDesc('tgl_kunjungan')->orderByDesc('jam_kunjungan');

        $counts = (clone $query)->reorder()
            ->selectRaw('jenis_pengunjung, count(*) as total')->groupBy('jenis_pengunjung')->pluck('total', 'jenis_pengunjung');

        return [
            'records'     => $query->paginate($this->ksPerPage, ['*'], 'page', $this->ksKunjunganPage),
            'jmlSiswa'    => $counts->get('siswa', 0),
            'jmlGuru'     => $counts->get('guru',  0),
            'jmlUmum'     => $counts->get('umum',  0),
            'currentPage' => $this->ksKunjunganPage,
        ];
    }

    // ================================================================
    //  PETUGAS — data loaders
    // ================================================================

    private function loadChartData(): array
    {
        $months = collect(range(5, 0))->map(fn ($i) => now()->subMonths($i)->startOfMonth());

        $rawLoans = Loan::selectRaw('DATE_FORMAT(tgl_pinjam, "%Y-%m") as ym, COUNT(*) as total')
            ->where('tgl_pinjam', '>=', $months->first())
            ->groupBy('ym')->pluck('total', 'ym');

        $rawVisits = Visit::selectRaw('DATE_FORMAT(tgl_kunjungan, "%Y-%m") as ym, COUNT(*) as total')
            ->where('tgl_kunjungan', '>=', $months->first())
            ->groupBy('ym')->pluck('total', 'ym');

        $chartLabels = $months->map(fn ($m) => $m->locale('id')->isoFormat('MMM YYYY'))->values()->toArray();
        $chartLoans  = $months->map(fn ($m) => (int) ($rawLoans->get($m->format('Y-m'), 0)))->values()->toArray();
        $chartVisits = $months->map(fn ($m) => (int) ($rawVisits->get($m->format('Y-m'), 0)))->values()->toArray();

        $topBuku = Loan::selectRaw('book_id, COUNT(*) as total')
            ->groupBy('book_id')->orderByDesc('total')->limit(5)
            ->with('book:id,judul')->get();

        $topBukuLabels = $topBuku->map(fn ($l) => Str::limit($l->book?->judul ?? '?', 30))->toArray();
        $topBukuData   = $topBuku->pluck('total')->map(fn ($v) => (int) $v)->toArray();

        $statTotalBuku      = Book::where('is_active', true)->count();
        $statAnggotaAktif   = Member::where('status', 'aktif')->count();
        $statPinjamAktif    = Loan::whereIn('status', ['dipinjam', 'terlambat'])->count();
        $statDendaBelum     = Fine::where('status_bayar', 'belum_lunas')->sum('nominal');
        $statKunjunganBulan = Visit::whereMonth('tgl_kunjungan', now()->month)
            ->whereYear('tgl_kunjungan', now()->year)->count();

        return compact(
            'chartLabels', 'chartLoans', 'chartVisits',
            'topBukuLabels', 'topBukuData',
            'statTotalBuku', 'statAnggotaAktif', 'statPinjamAktif',
            'statDendaBelum', 'statKunjunganBulan'
        );
    }

    private function effectivePerPage(): int
    {
        return $this->perPage ?: 99999;
    }

    private function loadBuku(): array
    {
        $query = Book::query()
            ->when($this->bukuKategori, fn ($q) => $q->where('kategori', $this->bukuKategori))
            ->when($this->bukuStatus === 'aktif',    fn ($q) => $q->where('is_active', true))
            ->when($this->bukuStatus === 'nonaktif', fn ($q) => $q->where('is_active', false))
            ->orderBy('kode_buku');

        $totalStok = (clone $query)->sum('stok');
        $page      = $this->perPage ? $this->bukuPage : 1;

        return [
            'records'     => $query->paginate($this->effectivePerPage(), ['*'], 'page', $page),
            'totalStok'   => $totalStok,
            'currentPage' => $this->bukuPage,
        ];
    }

    private function loadAnggota(): array
    {
        $query = Member::query()
            ->when($this->anggotaJenis,  fn ($q) => $q->where('jenis',  $this->anggotaJenis))
            ->when($this->anggotaStatus, fn ($q) => $q->where('status', $this->anggotaStatus))
            ->when($this->anggotaKelas,  fn ($q) => $q->where('kelas',  $this->anggotaKelas))
            ->orderBy('nama');

        $all      = (clone $query)->select('jenis')->get();
        $jmlSiswa = $all->where('jenis', 'siswa')->count();
        $jmlGuru  = $all->where('jenis', 'guru')->count();
        $page     = $this->perPage ? $this->anggotaPage : 1;

        return [
            'records'     => $query->paginate($this->effectivePerPage(), ['*'], 'page', $page),
            'jmlSiswa'    => $jmlSiswa,
            'jmlGuru'     => $jmlGuru,
            'currentPage' => $this->anggotaPage,
        ];
    }

    private function loadPeminjaman(): array
    {
        $query = Loan::with(['book', 'member', 'fine'])
            ->when($this->pinjamStatus, fn ($q) => $q->where('status', $this->pinjamStatus))
            ->when($this->pinjamDari,   fn ($q) => $q->whereDate('tgl_pinjam', '>=', $this->pinjamDari))
            ->when($this->pinjamSampai, fn ($q) => $q->whereDate('tgl_pinjam', '<=', $this->pinjamSampai))
            ->orderByDesc('tgl_pinjam');

        $counts = (clone $query)->reorder()
            ->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');

        $page = $this->perPage ? $this->pinjamPage : 1;

        return [
            'records'      => $query->paginate($this->effectivePerPage(), ['*'], 'page', $page),
            'jmlDipinjam'  => $counts->get('dipinjam',     0),
            'jmlKembali'   => $counts->get('dikembalikan', 0),
            'jmlTerlambat' => $counts->get('terlambat',    0),
            'currentPage'  => $this->pinjamPage,
        ];
    }

    private function loadPengembalian(): array
    {
        $query = Loan::with(['book', 'member', 'fine'])
            ->whereNotNull('tgl_kembali')
            ->when($this->kembaliDari,    fn ($q) => $q->whereDate('tgl_kembali', '>=', $this->kembaliDari))
            ->when($this->kembaliSampai,  fn ($q) => $q->whereDate('tgl_kembali', '<=', $this->kembaliSampai))
            ->when($this->kembaliKondisi, fn ($q) => $q->where('kondisi_kembali', $this->kembaliKondisi))
            ->orderByDesc('tgl_kembali');

        $counts = (clone $query)->reorder()
            ->selectRaw('kondisi_kembali, count(*) as total')->groupBy('kondisi_kembali')->pluck('total', 'kondisi_kembali');

        $page = $this->perPage ? $this->kembaliPage : 1;

        return [
            'records'     => $query->paginate($this->effectivePerPage(), ['*'], 'page', $page),
            'jmlBaik'     => $counts->get('baik',   0),
            'jmlRusak'    => $counts->get('rusak',  0),
            'jmlHilang'   => $counts->get('hilang', 0),
            'currentPage' => $this->kembaliPage,
        ];
    }

    private function loadDenda(): array
    {
        $query = Fine::with(['loan.book', 'loan.member'])
            ->when($this->dendaStatus, fn ($q) => $q->where('status_bayar', $this->dendaStatus))
            ->when($this->dendaDari,   fn ($q) => $q->whereDate('created_at', '>=', $this->dendaDari))
            ->when($this->dendaSampai, fn ($q) => $q->whereDate('created_at', '<=', $this->dendaSampai))
            ->orderByDesc('created_at');

        $totals = (clone $query)->selectRaw(
            'sum(nominal) as total, sum(case when status_bayar="lunas" then nominal else 0 end) as lunas, sum(case when status_bayar="belum_lunas" then nominal else 0 end) as belum'
        )->first();

        $page = $this->perPage ? $this->dendaPage : 1;

        return [
            'records'      => $query->paginate($this->effectivePerPage(), ['*'], 'page', $page),
            'totalNominal' => $totals->total ?? 0,
            'totalLunas'   => $totals->lunas  ?? 0,
            'totalBelum'   => $totals->belum  ?? 0,
            'currentPage'  => $this->dendaPage,
        ];
    }

    private function loadKunjungan(): array
    {
        $query = Visit::query()
            ->when($this->kunjunganJenis,  fn ($q) => $q->where('jenis_pengunjung', $this->kunjunganJenis))
            ->when($this->kunjunganDari,   fn ($q) => $q->whereDate('tgl_kunjungan', '>=', $this->kunjunganDari))
            ->when($this->kunjunganSampai, fn ($q) => $q->whereDate('tgl_kunjungan', '<=', $this->kunjunganSampai))
            ->orderByDesc('tgl_kunjungan')->orderByDesc('jam_kunjungan');

        $counts = (clone $query)->reorder()
            ->selectRaw('jenis_pengunjung, count(*) as total')->groupBy('jenis_pengunjung')->pluck('total', 'jenis_pengunjung');

        $page = $this->perPage ? $this->kunjunganPage : 1;

        return [
            'records'     => $query->paginate($this->effectivePerPage(), ['*'], 'page', $page),
            'jmlSiswa'    => $counts->get('siswa', 0),
            'jmlGuru'     => $counts->get('guru',  0),
            'jmlUmum'     => $counts->get('umum',  0),
            'currentPage' => $this->kunjunganPage,
        ];
    }
}
