<div style="overflow-x:hidden;width:100%;">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<style>
.ks {
  --pri:#1e3a8a; --pri-50:#eef2ff; --pri-100:#dbe3ff;
  --ok:#16a34a;  --ok-50:#e6f7ed;
  --warn:#f59e0b; --warn-50:#fffbeb;
  --red:#dc2626;  --red-50:#fee2e2;
  --inf:#2563eb;  --inf-50:#e8efff;
  --vio:#7c3aed;  --vio-50:#f1ebff;
  --line:#e6eaf2;
  --t1:#0f172a; --t2:#5a6478; --t3:#8b94a6;
  --panel:#fff; --bg:#f3f5fa;
  --r:12px; --sh:0 1px 3px rgba(15,23,42,.06);
}
/* Layout */
.ks-head { display:flex; align-items:flex-start; justify-content:space-between; gap:20px; margin-bottom:22px; }
.ks-head h1 { font-size:22px; font-weight:700; margin:0 0 3px; color:var(--t1); }
.ks-head p  { margin:0; color:var(--t2); font-size:13px; }
.ks-badge { display:inline-flex; align-items:center; height:20px; padding:0 9px; border-radius:999px; background:var(--pri-50); color:var(--pri); font-size:11px; font-weight:700; letter-spacing:.04em; margin-left:6px; vertical-align:middle; }
/* Tab bar */
.ks-tabs { display:flex; gap:3px; background:#fff; border:1px solid var(--line); border-radius:12px; padding:4px; margin-bottom:20px; box-shadow:var(--sh); flex-wrap:wrap; }
.ks-tab  { flex:1; min-width:100px; padding:7px 10px; border-radius:9px; border:none; background:none; font-size:12.5px; font-weight:500; color:var(--t2); cursor:pointer; transition:background 100ms, color 100ms; white-space:nowrap; text-align:center; }
.ks-tab:hover  { background:#f5f7fc; color:var(--t1); }
.ks-tab.active { background:var(--pri); color:#fff; font-weight:600; box-shadow:0 1px 3px rgba(30,58,138,.25); }
/* Stat cards */
.ks-stats { display:grid; gap:14px; margin-bottom:18px; }
.ks-stats-5 { grid-template-columns:repeat(5,1fr); }
.ks-stats-3 { grid-template-columns:repeat(3,1fr); }
.ks-stats-4 { grid-template-columns:repeat(4,1fr); }
.ks-stat  { background:var(--panel); border:1px solid var(--line); border-radius:var(--r); padding:16px 16px 14px; box-shadow:var(--sh); min-width:0; }
.ks-stat-lbl { font-size:10.5px; font-weight:700; text-transform:uppercase; letter-spacing:.07em; color:var(--t3); margin-bottom:8px; }
.ks-stat-val { font-size:26px; font-weight:700; letter-spacing:-.02em; color:var(--t1); margin-bottom:2px; overflow-wrap:break-word; word-break:break-word; }
.ks-stat-sub { font-size:11.5px; color:var(--t2); }
/* Card */
.ks-card { background:var(--panel); border:1px solid var(--line); border-radius:var(--r); box-shadow:var(--sh); overflow:hidden; margin-bottom:16px; }
.ks-card-head { padding:12px 18px 10px; border-bottom:1px solid var(--line); display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap; }
.ks-card-head h3 { margin:0; font-size:13.5px; font-weight:700; color:var(--t1); }
.ks-card-body { padding:0; }
/* Filters */
.ks-filters { display:flex; gap:8px; padding:12px 16px; background:#f8f9fc; border-bottom:1px solid var(--line); flex-wrap:wrap; align-items:center; }
.ks-filter-lbl { font-size:11.5px; color:var(--t2); font-weight:600; flex-shrink:0; }
.ks-select, .ks-input { height:32px; padding:0 10px; border:1px solid var(--line); border-radius:7px; font-size:12.5px; color:var(--t1); background:#fff; outline:none; }
.ks-select:focus, .ks-input:focus { border-color:var(--pri); box-shadow:0 0 0 3px rgba(30,58,138,.08); }
/* Summary chips */
.ks-chips { display:flex; gap:8px; padding:10px 16px; border-bottom:1px solid var(--line); flex-wrap:wrap; }
.ks-chip { display:inline-flex; align-items:center; gap:5px; padding:4px 10px; border-radius:20px; font-size:12px; font-weight:600; }
/* Table */
.ks-table-wrap { overflow-x:auto; }
table.ks-tbl { width:100%; border-collapse:collapse; font-size:13px; }
table.ks-tbl thead tr { background:#f8f9fc; border-bottom:2px solid var(--line); }
table.ks-tbl th { padding:10px 14px; text-align:left; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.06em; color:var(--t3); white-space:nowrap; }
table.ks-tbl td { padding:10px 14px; border-bottom:1px solid #f1f3f8; color:var(--t1); vertical-align:middle; }
table.ks-tbl tbody tr:last-child td { border-bottom:none; }
table.ks-tbl tbody tr:hover td { background:#f8f9fc; }
.ks-tbl-name { font-weight:600; color:var(--t1); }
.ks-tbl-sub  { font-size:11.5px; color:var(--t3); margin-top:1px; }
/* Status badges */
.ks-pill { display:inline-flex; align-items:center; padding:2px 9px; border-radius:999px; font-size:11px; font-weight:600; }
.ks-pill-ok   { background:var(--ok-50);   color:var(--ok); }
.ks-pill-warn { background:var(--warn-50); color:var(--warn); }
.ks-pill-red  { background:var(--red-50);  color:var(--red); }
.ks-pill-pri  { background:var(--pri-50);  color:var(--pri); }
.ks-pill-gray { background:#f1f3f8; color:var(--t2); }
/* Pagination */
.ks-pagi { display:flex; align-items:center; justify-content:flex-end; gap:6px; padding:10px 16px; border-top:1px solid var(--line); }
.ks-pagi-btn { height:28px; min-width:28px; padding:0 8px; border:1px solid var(--line); border-radius:6px; background:#fff; font-size:12px; color:var(--t2); cursor:pointer; display:inline-flex; align-items:center; justify-content:center; }
.ks-pagi-btn:hover:not(:disabled) { background:var(--pri-50); color:var(--pri); border-color:var(--pri-100); }
.ks-pagi-btn:disabled { opacity:.4; cursor:default; }
.ks-pagi-info { font-size:12px; color:var(--t3); padding:0 4px; }
/* 7-day chart */
.ks-chart-wrap { padding:16px 18px 12px; }
.ks-chart { display:flex; gap:6px; height:90px; align-items:flex-end; }
.ks-chart-col { flex:1; display:flex; flex-direction:column; align-items:center; gap:3px; height:100%; }
.ks-chart-val { font-size:9px; color:var(--t3); line-height:1; }
.ks-chart-bar-wrap { flex:1; width:100%; display:flex; align-items:flex-end; }
.ks-chart-bar { width:100%; background:var(--pri); border-radius:3px 3px 0 0; opacity:.8; transition:opacity 100ms; min-height:3px; }
.ks-chart-bar:hover { opacity:1; }
.ks-chart-lbl { font-size:9px; color:var(--t3); white-space:nowrap; line-height:1; }
/* Periode buttons */
.ks-periode-btns { display:flex; gap:4px; }
.ks-periode-btn { padding:4px 10px; border:1px solid var(--line); border-radius:6px; background:#fff; font-size:12px; color:var(--t2); cursor:pointer; }
.ks-periode-btn.active { background:var(--pri); color:#fff; border-color:var(--pri); font-weight:600; }
/* Website stats grid */
.ks-web-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; padding:16px; }
.ks-web-card { background:#f8f9fc; border:1px solid var(--line); border-radius:10px; padding:16px; }
.ks-web-card h4 { margin:0 0 12px; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.06em; color:var(--t3); }
.ks-web-row { display:flex; justify-content:space-between; align-items:center; padding:6px 0; border-bottom:1px solid var(--line); }
.ks-web-row:last-child { border-bottom:none; }
.ks-web-row-lbl { font-size:13px; color:var(--t2); }
.ks-web-row-val { font-size:15px; font-weight:700; color:var(--t1); }
/* Pagination — dipakai oleh partial _rp_pagination.blade.php */
.rp-pagination { display:flex; align-items:center; justify-content:space-between; padding:12px 16px; border-top:1px solid var(--line); flex-wrap:wrap; gap:8px; }
.rp-pagination-info { font-size:12.5px; color:var(--t3); }
.rp-pagination-nav  { display:flex; gap:4px; align-items:center; }
.rp-pg-btn { height:30px; min-width:30px; padding:0 8px; border-radius:7px; border:1px solid var(--line); background:#fff; color:var(--t1); font:inherit; font-size:12px; font-weight:500; cursor:pointer; display:inline-flex; align-items:center; justify-content:center; gap:4px; transition:background 100ms; }
.rp-pg-btn:hover:not(:disabled) { background:#f5f7fc; border-color:var(--line-2); }
.rp-pg-btn.active { background:var(--pri); color:#fff; border-color:var(--pri); font-weight:600; }
.rp-pg-btn:disabled { opacity:.4; cursor:not-allowed; }
/* Charts */
.ks-chart-row { display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:18px; }
.ks-chart-card { background:var(--panel); border:1px solid var(--line); border-radius:var(--r); box-shadow:var(--sh); overflow:hidden; min-width:0; }
.ks-chart-card-head { padding:12px 18px 10px; border-bottom:1px solid var(--line); }
.ks-chart-card-head h3 { margin:0; font-size:13px; font-weight:700; color:var(--t1); }
.ks-chart-card-head p  { margin:3px 0 0; font-size:11.5px; color:var(--t3); }
.ks-chart-card-body { padding:12px 16px; position:relative; height:200px; }
/* Content wrapper */
.ks-wrap { padding:24px 24px 60px; width:100%; box-sizing:border-box; }
/* ── Responsive ─────────────────────────────────────────── */
@media (max-width:1100px) {
  .ks-stats-5 { grid-template-columns:repeat(3,1fr); }
  .ks-chart-row { grid-template-columns:1fr; }
}
@media (max-width:900px) {
  .ks-stats-5,.ks-stats-3,.ks-stats-4 { grid-template-columns:repeat(2,1fr); }
}
/* Tablet / large phone */
@media (max-width:640px) {
  .ks-wrap { padding:14px 12px 40px; }
  .ks-head { flex-direction:column; gap:4px; margin-bottom:14px; }
  .ks-head h1 { font-size:16px; }
  .ks-head p  { font-size:11.5px; }
  /* Tabs → 2×2 grid agar tidak overflow */
  .ks-tabs { display:grid; grid-template-columns:1fr 1fr; gap:4px; border-radius:10px; padding:4px; margin-bottom:14px; }
  .ks-tab  { flex:none; min-width:0; font-size:11.5px; padding:8px 6px; white-space:normal; line-height:1.3; }
  /* Stat cards */
  .ks-stats { gap:8px; margin-bottom:12px; }
  .ks-stats-5,.ks-stats-3,.ks-stats-4 { grid-template-columns:1fr 1fr; }
  .ks-stat { padding:10px 10px 8px; }
  .ks-stat-lbl { font-size:9px; letter-spacing:.03em; margin-bottom:4px; }
  .ks-stat-val { font-size:17px !important; letter-spacing:0; }
  .ks-stat-sub { font-size:10px; }
  /* Chart */
  .ks-chart-row { grid-template-columns:1fr; gap:10px; margin-bottom:12px; }
  .ks-chart-card-body { height:170px; padding:10px 12px; }
  .ks-chart-card-head { padding:10px 14px 8px; }
  .ks-chart-card-head h3 { font-size:12px; }
  /* Card head */
  .ks-card-head { padding:10px 14px; }
  .ks-card-head h3 { font-size:12.5px; }
  /* Chips */
  .ks-chips { padding:8px 12px; gap:5px; margin-bottom:8px !important; }
  .ks-chip  { font-size:10.5px; padding:3px 7px; }
  /* Filters — stack vertikal */
  .ks-filters { flex-direction:column; align-items:stretch; padding:10px 12px; gap:6px; margin-bottom:10px !important; }
  .ks-filter-lbl { margin-bottom:0; }
  .ks-select,.ks-input { width:100%; box-sizing:border-box; height:34px; font-size:13px; }
  /* Table */
  table.ks-tbl { font-size:11.5px; }
  table.ks-tbl th { padding:7px 10px; font-size:9.5px; }
  table.ks-tbl td { padding:7px 10px; }
  .ks-tbl-sub { font-size:10px; }
  /* Pagination */
  .rp-pagination { padding:8px 12px; gap:6px; }
  .rp-pagination-info { font-size:11px; }
  .rp-pg-btn { height:26px; min-width:26px; font-size:11px; padding:0 6px; }
}
/* Small phone (≤400px) */
@media (max-width:400px) {
  .ks-wrap { padding:12px 10px 36px; }
  .ks-stats-5,.ks-stats-3,.ks-stats-4 { grid-template-columns:1fr 1fr; gap:6px; }
  .ks-stat { padding:8px 8px 6px; }
  .ks-stat-val { font-size:15px !important; }
  .ks-stat-lbl { font-size:8.5px; }
  .ks-chip { font-size:10px; padding:2px 6px; }
  .ks-chart-card-body { height:150px; }
}
</style>

<div class="ks ks-wrap fi-page-content">

  {{-- Header --}}
  <div class="ks-head">
    <div>
      <h1>Laporan Perpustakaan <span class="ks-badge">Kepala Sekolah</span></h1>
      <p>SMP Negeri 3 Ajibarang &middot; {{ $tanggal }}</p>
    </div>
  </div>

  {{-- Stat cards --}}
  <div class="ks-stats ks-stats-5" style="margin-bottom:16px;">
    <div class="ks-stat">
      <div class="ks-stat-lbl">Total Buku</div>
      <div class="ks-stat-val">{{ number_format($statTotalBuku) }}</div>
      <div class="ks-stat-sub">buku aktif</div>
    </div>
    <div class="ks-stat">
      <div class="ks-stat-lbl">Anggota Aktif</div>
      <div class="ks-stat-val">{{ number_format($statAnggotaAktif) }}</div>
      <div class="ks-stat-sub">anggota terdaftar</div>
    </div>
    <div class="ks-stat">
      <div class="ks-stat-lbl">Sedang Dipinjam</div>
      <div class="ks-stat-val" style="color:var(--warn);">{{ number_format($statPinjamAktif) }}</div>
      <div class="ks-stat-sub">buku belum kembali</div>
    </div>
    <div class="ks-stat">
      <div class="ks-stat-lbl">Denda Belum Lunas</div>
      <div class="ks-stat-val" style="color:var(--red);font-size:clamp(13px,3.5vw,22px);">Rp {{ number_format($statDendaBelum, 0, ',', '.') }}</div>
      <div class="ks-stat-sub">total outstanding</div>
    </div>
    <div class="ks-stat">
      <div class="ks-stat-lbl">Kunjungan Bulan Ini</div>
      <div class="ks-stat-val" style="color:var(--ok);">{{ number_format($statKunjunganBulan) }}</div>
      <div class="ks-stat-sub">pengunjung bulan ini</div>
    </div>
  </div>

  {{-- Charts --}}
  <div class="ks-chart-row">
    <div class="ks-chart-card">
      <div class="ks-chart-card-head">
        <h3>Peminjaman per Bulan</h3>
        <p>6 bulan terakhir</p>
      </div>
      <div class="ks-chart-card-body" wire:ignore>
        <canvas id="ksChartLoans" height="130"></canvas>
      </div>
    </div>
    <div class="ks-chart-card">
      <div class="ks-chart-card-head">
        <h3>Kunjungan per Bulan</h3>
        <p>6 bulan terakhir</p>
      </div>
      <div class="ks-chart-card-body" wire:ignore>
        <canvas id="ksChartVisits" height="130"></canvas>
      </div>
    </div>
  </div>

  {{-- Tab bar --}}
  <div class="ks-tabs">
    <button wire:click="setKsTab('peminjaman')"  class="ks-tab {{ $ksTab === 'peminjaman'  ? 'active' : '' }}">Rekap Peminjaman</button>
    <button wire:click="setKsTab('denda')"       class="ks-tab {{ $ksTab === 'denda'       ? 'active' : '' }}">Rekap Denda</button>
    <button wire:click="setKsTab('sanksi')"      class="ks-tab {{ $ksTab === 'sanksi'      ? 'active' : '' }}">Rekap Sanksi</button>
    <button wire:click="setKsTab('kunjungan')"   class="ks-tab {{ $ksTab === 'kunjungan'   ? 'active' : '' }}">Rekap Kunjungan</button>
  </div>

  {{-- =============================================================== --}}
  {{-- TAB: REKAP PEMINJAMAN                                           --}}
  {{-- =============================================================== --}}
  @if($ksTab === 'peminjaman')

    {{-- Summary chips --}}
    <div class="ks-chips" style="margin-bottom:12px;">
      <span class="ks-chip" style="background:#f1f3f8;color:var(--t2);">Total: {{ $records->total() }}</span>
      <span class="ks-chip" style="background:var(--warn-50);color:var(--warn);">Dipinjam: {{ $jmlDipinjam }}</span>
      <span class="ks-chip" style="background:var(--red-50);color:var(--red);">Terlambat: {{ $jmlTerlambat }}</span>
      <span class="ks-chip" style="background:var(--ok-50);color:var(--ok);">Dikembalikan: {{ $jmlKembali }}</span>
    </div>

    {{-- Filters --}}
    <div class="ks-filters" style="margin-bottom:14px;">
      <span class="ks-filter-lbl">Filter:</span>
      <select class="ks-select" wire:model.live="ksPinjamStatus">
        <option value="">Semua Status</option>
        <option value="dipinjam">Dipinjam</option>
        <option value="terlambat">Terlambat</option>
        <option value="dikembalikan">Dikembalikan</option>
      </select>
      <input type="date" class="ks-input" wire:model.live="ksPinjamDari" placeholder="Dari">
      <input type="date" class="ks-input" wire:model.live="ksPinjamSampai" placeholder="Sampai">
    </div>

    {{-- Table --}}
    <div class="ks-card">
      <div class="ks-card-head"><h3>Data Peminjaman</h3></div>
      <div class="ks-card-body">
        @if($records->isEmpty())
          <div style="padding:40px;text-align:center;color:var(--t3);font-size:13px;">Tidak ada data peminjaman</div>
        @else
        <div class="ks-table-wrap">
          <table class="ks-tbl">
            <thead>
              <tr>
                <th>Anggota</th>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Batas Kembali</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($records as $row)
              <tr>
                <td>
                  <div class="ks-tbl-name">{{ $row->member?->nama ?? '—' }}</div>
                  <div class="ks-tbl-sub">{{ $row->member?->kode_anggota }}</div>
                </td>
                <td>
                  <div>{{ $row->book?->judul ?? '—' }}</div>
                  <div class="ks-tbl-sub">{{ $row->book?->kode_buku }}</div>
                </td>
                <td>{{ $row->tgl_pinjam?->format('d M Y') ?? '—' }}</td>
                <td>{{ $row->tgl_batas_kembali?->format('d M Y') ?? '—' }}</td>
                <td>{{ $row->tgl_kembali?->format('d M Y') ?? '—' }}</td>
                <td>
                  @php $st = $row->status; @endphp
                  <span class="ks-pill {{ $st === 'dikembalikan' ? 'ks-pill-ok' : ($st === 'terlambat' ? 'ks-pill-red' : 'ks-pill-warn') }}">
                    {{ $st === 'dikembalikan' ? 'Dikembalikan' : ($st === 'terlambat' ? 'Terlambat' : 'Dipinjam') }}
                  </span>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @include('filament.admin.pages._rp_pagination', ['records' => $records, 'tabKey' => 'ksPinjam'])
        @endif
      </div>
    </div>

  {{-- =============================================================== --}}
  {{-- TAB: REKAP DENDA                                                --}}
  {{-- =============================================================== --}}
  @elseif($ksTab === 'denda')

    {{-- Summary chips --}}
    <div class="ks-chips" style="margin-bottom:12px;">
      <span class="ks-chip" style="background:#f1f3f8;color:var(--t2);">Total: Rp {{ number_format($totalNominal, 0, ',', '.') }}</span>
      <span class="ks-chip" style="background:var(--ok-50);color:var(--ok);">Lunas: Rp {{ number_format($totalLunas, 0, ',', '.') }}</span>
      <span class="ks-chip" style="background:var(--red-50);color:var(--red);">Belum Lunas: Rp {{ number_format($totalBelum, 0, ',', '.') }}</span>
    </div>

    {{-- Filters --}}
    <div class="ks-filters" style="margin-bottom:14px;">
      <span class="ks-filter-lbl">Filter:</span>
      <select class="ks-select" wire:model.live="ksDendaStatus">
        <option value="">Semua Status</option>
        <option value="belum_lunas">Belum Lunas</option>
        <option value="lunas">Lunas</option>
      </select>
      <input type="date" class="ks-input" wire:model.live="ksDendaDari" placeholder="Dari">
      <input type="date" class="ks-input" wire:model.live="ksDendaSampai" placeholder="Sampai">
    </div>

    {{-- Table --}}
    <div class="ks-card">
      <div class="ks-card-head"><h3>Data Denda Keterlambatan</h3></div>
      <div class="ks-card-body">
        @if($records->isEmpty())
          <div style="padding:40px;text-align:center;color:var(--t3);font-size:13px;">Tidak ada data denda</div>
        @else
        <div class="ks-table-wrap">
          <table class="ks-tbl">
            <thead>
              <tr>
                <th>Anggota</th>
                <th>Buku</th>
                <th>Keterlambatan</th>
                <th>Nominal</th>
                <th>Status</th>
                <th>Tgl Bayar</th>
              </tr>
            </thead>
            <tbody>
              @foreach($records as $row)
              <tr>
                <td>
                  <div class="ks-tbl-name">{{ $row->loan?->member?->nama ?? '—' }}</div>
                  <div class="ks-tbl-sub">{{ $row->loan?->member?->kode_anggota }}</div>
                </td>
                <td>
                  <div>{{ $row->loan?->book?->judul ?? '—' }}</div>
                  <div class="ks-tbl-sub">Batas: {{ $row->loan?->tgl_batas_kembali?->format('d M Y') }}</div>
                </td>
                <td>{{ $row->jumlah_hari }} hari</td>
                <td style="font-weight:600;">Rp {{ number_format($row->nominal, 0, ',', '.') }}</td>
                <td>
                  <span class="ks-pill {{ $row->status_bayar === 'lunas' ? 'ks-pill-ok' : 'ks-pill-red' }}">
                    {{ $row->status_bayar === 'lunas' ? 'Lunas' : 'Belum Lunas' }}
                  </span>
                </td>
                <td>{{ $row->tgl_bayar?->format('d M Y') ?? '—' }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @include('filament.admin.pages._rp_pagination', ['records' => $records, 'tabKey' => 'ksDenda'])
        @endif
      </div>
    </div>

  {{-- =============================================================== --}}
  {{-- TAB: REKAP SANKSI                                               --}}
  {{-- =============================================================== --}}
  @elseif($ksTab === 'sanksi')

    {{-- Filters --}}
    <div class="ks-filters" style="margin-bottom:14px;">
      <span class="ks-filter-lbl">Filter:</span>
      <select class="ks-select" wire:model.live="ksSanksiJenis">
        <option value="">Semua Jenis</option>
        <option value="denda_kerusakan">Denda Kerusakan</option>
        <option value="ganti_buku">Ganti Buku</option>
        <option value="lainnya">Lainnya</option>
      </select>
      <select class="ks-select" wire:model.live="ksSanksiStatus">
        <option value="">Semua Status</option>
        <option value="belum_lunas">Belum Lunas</option>
        <option value="lunas">Lunas</option>
      </select>
    </div>

    {{-- Table --}}
    <div class="ks-card">
      <div class="ks-card-head"><h3>Data Sanksi Buku</h3></div>
      <div class="ks-card-body">
        @if($records->isEmpty())
          <div style="padding:40px;text-align:center;color:var(--t3);font-size:13px;">Tidak ada data sanksi</div>
        @else
        <div class="ks-table-wrap">
          <table class="ks-tbl">
            <thead>
              <tr>
                <th>Anggota</th>
                <th>Buku</th>
                <th>Kondisi Kembali</th>
                <th>Jenis Sanksi</th>
                <th>Status Sanksi</th>
                <th>Tgl Selesai</th>
              </tr>
            </thead>
            <tbody>
              @foreach($records as $row)
              <tr>
                <td>
                  <div class="ks-tbl-name">{{ $row->member?->nama ?? '—' }}</div>
                  <div class="ks-tbl-sub">{{ $row->member?->kode_anggota }}</div>
                </td>
                <td>
                  <div>{{ $row->book?->judul ?? '—' }}</div>
                  <div class="ks-tbl-sub">{{ $row->book?->kode_buku }}</div>
                </td>
                <td>
                  @php $kond = $row->kondisi_kembali; @endphp
                  <span class="ks-pill {{ $kond === 'baik' ? 'ks-pill-ok' : ($kond === 'rusak' ? 'ks-pill-warn' : 'ks-pill-red') }}">
                    {{ $kond === 'baik' ? 'Baik' : ($kond === 'rusak' ? 'Rusak' : ($kond === 'hilang' ? 'Hilang' : ($kond ?? '—'))) }}
                  </span>
                </td>
                <td>
                  @php $js = $row->jenis_sanksi; @endphp
                  <span class="ks-pill {{ $js === 'ganti_buku' ? 'ks-pill-red' : ($js === 'denda_kerusakan' ? 'ks-pill-warn' : 'ks-pill-gray') }}">
                    {{ $js === 'denda_kerusakan' ? 'Denda Kerusakan' : ($js === 'ganti_buku' ? 'Ganti Buku' : ucfirst($js ?? '—')) }}
                  </span>
                </td>
                <td>
                  @php $ss = $row->status_sanksi; @endphp
                  <span class="ks-pill {{ $ss === 'lunas' ? 'ks-pill-ok' : 'ks-pill-red' }}">
                    {{ $ss === 'lunas' ? 'Lunas' : 'Belum Lunas' }}
                  </span>
                </td>
                <td>{{ $row->tgl_selesai_sanksi?->format('d M Y') ?? '—' }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @include('filament.admin.pages._rp_pagination', ['records' => $records, 'tabKey' => 'ksSanksi'])
        @endif
      </div>
    </div>

  {{-- =============================================================== --}}
  {{-- TAB: REKAP KUNJUNGAN                                            --}}
  {{-- =============================================================== --}}
  @elseif($ksTab === 'kunjungan')

    {{-- Summary chips --}}
    <div class="ks-chips" style="margin-bottom:12px;">
      <span class="ks-chip" style="background:#f1f3f8;color:var(--t2);">Total: {{ $records->total() }}</span>
      <span class="ks-chip" style="background:var(--inf-50);color:var(--inf);">Siswa: {{ $jmlSiswa }}</span>
      <span class="ks-chip" style="background:var(--pri-50);color:var(--pri);">Guru: {{ $jmlGuru }}</span>
      <span class="ks-chip" style="background:var(--ok-50);color:var(--ok);">Tamu: {{ $jmlUmum }}</span>
    </div>

    {{-- Filters --}}
    <div class="ks-filters" style="margin-bottom:14px;">
      <span class="ks-filter-lbl">Filter:</span>
      <select class="ks-select" wire:model.live="ksKunjunganJenis">
        <option value="">Semua Pengunjung</option>
        <option value="siswa">Siswa</option>
        <option value="guru">Guru / Staf</option>
        <option value="umum">Tamu</option>
      </select>
      <select class="ks-select" wire:model.live="ksKunjunganKeperluan">
        <option value="">Semua Keperluan</option>
        <option value="Membaca">Membaca Buku</option>
        <option value="Meminjam Buku">Meminjam Buku</option>
        <option value="Mengembalikan Buku">Mengembalikan Buku</option>
        <option value="Belajar / Mengerjakan Tugas">Belajar / Tugas</option>
        <option value="Mencari Referensi">Mencari Referensi</option>
        <option value="Lainnya">Lainnya</option>
      </select>
      <input type="date" class="ks-input" wire:model.live="ksKunjunganDari" placeholder="Dari">
      <input type="date" class="ks-input" wire:model.live="ksKunjunganSampai" placeholder="Sampai">
    </div>

    {{-- Table --}}
    <div class="ks-card">
      <div class="ks-card-head"><h3>Data Kunjungan Perpustakaan</h3></div>
      <div class="ks-card-body">
        @if($records->isEmpty())
          <div style="padding:40px;text-align:center;color:var(--t3);font-size:13px;">Tidak ada data kunjungan</div>
        @else
        <div class="ks-table-wrap">
          <table class="ks-tbl">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Keperluan</th>
                <th>Tanggal</th>
                <th>Jam</th>
              </tr>
            </thead>
            <tbody>
              @foreach($records as $row)
              <tr>
                <td>
                  <div class="ks-tbl-name">{{ $row->nama ?? '—' }}</div>
                  @if($row->kelas)
                    <div class="ks-tbl-sub">Kelas {{ $row->kelas }}</div>
                  @endif
                </td>
                <td>
                  @php $jp = $row->jenis_pengunjung; @endphp
                  <span class="ks-pill {{ $jp === 'siswa' ? 'ks-pill-pri' : ($jp === 'guru' ? 'ks-pill-ok' : 'ks-pill-gray') }}">
                    {{ $jp === 'siswa' ? 'Siswa' : ($jp === 'guru' ? 'Guru/Staf' : 'Tamu') }}
                  </span>
                </td>
                <td>{{ $row->keperluan ?? '—' }}</td>
                <td>{{ $row->tgl_kunjungan?->format('d M Y') ?? '—' }}</td>
                <td>{{ $row->jam_kunjungan ? substr($row->jam_kunjungan, 0, 5) : '—' }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @include('filament.admin.pages._rp_pagination', ['records' => $records, 'tabKey' => 'ksKunjungan'])
        @endif
      </div>
    </div>

  @endif

</div>

<script>
(function () {
  var labels  = @json($chartLabels);
  var loans   = @json($chartLoans);
  var visits  = @json($chartVisits);

  var loansChart, visitsChart;

  function initKsCharts() {
    var ctxL = document.getElementById('ksChartLoans');
    var ctxV = document.getElementById('ksChartVisits');
    if (!ctxL || !ctxV) return;

    if (loansChart)  { loansChart.destroy();  loansChart  = null; }
    if (visitsChart) { visitsChart.destroy(); visitsChart = null; }

    var gridColor = 'rgba(226,232,240,.7)';
    var baseFont  = { family: 'inherit', size: 11 };

    loansChart = new Chart(ctxL, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Peminjaman',
          data: loans,
          backgroundColor: 'rgba(30,58,138,.75)',
          borderRadius: 5,
          borderSkipped: false,
        }]
      },
      options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          x: { grid: { display: false }, ticks: { font: baseFont, color: '#8b94a6' } },
          y: { grid: { color: gridColor }, ticks: { font: baseFont, color: '#8b94a6', precision: 0 }, beginAtZero: true }
        }
      }
    });

    visitsChart = new Chart(ctxV, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'Kunjungan',
          data: visits,
          borderColor: '#16a34a',
          backgroundColor: 'rgba(22,163,74,.10)',
          borderWidth: 2,
          pointBackgroundColor: '#16a34a',
          pointRadius: 4,
          tension: 0.35,
          fill: true,
        }]
      },
      options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          x: { grid: { display: false }, ticks: { font: baseFont, color: '#8b94a6' } },
          y: { grid: { color: gridColor }, ticks: { font: baseFont, color: '#8b94a6', precision: 0 }, beginAtZero: true }
        }
      }
    });
  }

  document.addEventListener('DOMContentLoaded', initKsCharts);
  document.addEventListener('livewire:navigated', initKsCharts);
})();
</script>
</div>
