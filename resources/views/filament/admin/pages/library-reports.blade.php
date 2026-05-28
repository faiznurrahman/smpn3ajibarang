<div>
@php
    $tabs = [
        'buku'         => ['icon' => '#rpi-book',   'label' => 'Data Buku'],
        'anggota'      => ['icon' => '#rpi-user',   'label' => 'Data Anggota'],
        'peminjaman'   => ['icon' => '#rpi-loan',   'label' => 'Peminjaman'],
        'pengembalian' => ['icon' => '#rpi-return', 'label' => 'Pengembalian'],
        'denda'        => ['icon' => '#rpi-money',  'label' => 'Denda'],
        'kunjungan'    => ['icon' => '#rpi-visit',  'label' => 'Kunjungan'],
    ];
    $printTitle = $tabs[$activeTab]['label'] ?? 'Laporan';
@endphp

<style>
.rp {
  --pri:#1e3a8a; --pri-2:#2746a4; --pri-50:#eef2ff; --pri-100:#dbe3ff;
  --ok:#16a34a;  --ok-50:#e6f7ed;
  --warn:#f59e0b; --warn-50:#fffbeb;
  --red:#dc2626;  --red-50:#fee2e2;
  --inf:#2563eb;  --inf-50:#e8efff;
  --vio:#7c3aed;  --vio-50:#f1ebff;
  --line:#e6eaf2; --line-2:#d4dae6;
  --t1:#0f172a; --t2:#5a6478; --t3:#8b94a6;
  --panel:#fff; --bg:#f3f5fa;
  --r:14px; --sh-sm:0 1px 2px rgba(15,23,42,.04);
}
/* Header */
.rp-head { display:flex; align-items:flex-end; justify-content:space-between; gap:20px; margin-bottom:22px; }
.rp-head h1 { font-size:26px; font-weight:700; margin:0 0 4px; letter-spacing:-.015em; color:var(--t1); }
.rp-head p  { margin:0; color:var(--t2); font-size:14px; }
/* Tabs */
.rp-tabs { display:flex; gap:4px; background:#fff; border:1px solid var(--line); border-radius:12px; padding:4px; margin-bottom:20px; box-shadow:var(--sh-sm); flex-wrap:wrap; }
.rp-tab  { flex:1; min-width:110px; padding:8px 10px; border-radius:9px; border:none; background:none; font:inherit; font-size:12.5px; font-weight:500; color:var(--t2); cursor:pointer; transition:background 100ms, color 100ms; display:inline-flex; align-items:center; justify-content:center; gap:5px; white-space:nowrap; }
.rp-tab:hover  { background:#f5f7fc; color:var(--t1); }
.rp-tab.active { background:var(--pri); color:#fff; font-weight:600; box-shadow:0 1px 3px rgba(30,58,138,.25); }
/* Filter bar */
.rp-filters { background:#fff; border:1px solid var(--line); border-radius:12px; padding:12px 16px; margin-bottom:16px; display:flex; gap:10px; flex-wrap:wrap; align-items:flex-end; box-shadow:var(--sh-sm); }
.rp-fg { display:flex; flex-direction:column; gap:4px; }
.rp-fg label { font-size:10.5px; font-weight:700; color:var(--t3); text-transform:uppercase; letter-spacing:.07em; }
.rp-fg input, .rp-fg select {
  height:34px; padding:0 10px; border:1px solid var(--line-2); border-radius:7px;
  font:inherit; font-size:13px; color:var(--t1); background:#fff; outline:none;
  transition:border-color 100ms, box-shadow 100ms; min-width:0;
}
.rp-fg input:focus, .rp-fg select:focus { border-color:var(--pri); box-shadow:0 0 0 3px rgba(30,58,138,.1); }
.rp-fg input[type=search] { width:200px; padding-left:32px; background:#fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='none' stroke='%238b94a6' stroke-width='2' stroke-linecap='round'%3E%3Ccircle cx='6' cy='6' r='5'/%3E%3Cpath d='M10 10l3 3'/%3E%3C/svg%3E") 10px center no-repeat; }
.rp-fg input[type=date] { width:145px; }
.rp-fg select { min-width:130px; padding-right:28px; }
/* Period buttons */
.rp-period { display:flex; gap:3px; }
.rp-pbtn { height:34px; padding:0 12px; border-radius:7px; border:1px solid var(--line-2); background:#fff; font:inherit; font-size:12.5px; font-weight:500; color:var(--t2); cursor:pointer; transition:all 100ms; }
.rp-pbtn:hover { border-color:var(--pri-100); color:var(--pri); background:var(--pri-50); }
.rp-pbtn.active { border-color:var(--pri); color:var(--pri); background:var(--pri-50); font-weight:600; }
/* Card */
.rp-card { background:#fff; border:1px solid var(--line); border-radius:var(--r); box-shadow:var(--sh-sm); overflow:hidden; }
.rp-card-head { padding:14px 20px 12px; border-bottom:1px solid var(--line); display:flex; align-items:center; justify-content:space-between; gap:12px; }
.rp-card-head h3 { margin:0; font-size:14.5px; font-weight:700; color:var(--t1); }
.rp-card-stats { display:flex; gap:8px; align-items:center; flex-wrap:wrap; }
.rp-chip { display:inline-flex; align-items:center; height:22px; padding:0 9px; border-radius:999px; font-size:11px; font-weight:600; gap:4px; }
.rp-chip.tot  { background:#f1f3f8; color:var(--t2); }
.rp-chip.ok   { background:var(--ok-50); color:var(--ok); }
.rp-chip.warn { background:var(--warn-50); color:#b45309; }
.rp-chip.red  { background:var(--red-50); color:var(--red); }
.rp-chip.inf  { background:var(--inf-50); color:var(--inf); }
.rp-chip.vio  { background:var(--vio-50); color:var(--vio); }
.rp-chip.pri  { background:var(--pri-50); color:var(--pri); }
/* Table */
.rp-table-wrap { overflow-x:auto; }
.rp-table { width:100%; border-collapse:collapse; min-width:600px; }
.rp-table thead th { padding:9px 14px; background:#f8f9fc; font-size:10.5px; font-weight:700; text-transform:uppercase; letter-spacing:.07em; color:var(--t3); text-align:left; border-bottom:1px solid var(--line); white-space:nowrap; }
.rp-table tbody td { padding:9px 14px; font-size:13px; color:var(--t1); border-bottom:1px solid #f1f3f8; vertical-align:middle; }
.rp-table tbody tr:last-child td { border-bottom:none; }
.rp-table tbody tr:hover td { background:#fafbfd; }
.rp-table tfoot td { padding:10px 14px; font-size:12px; font-weight:600; color:var(--t2); background:#f8f9fc; border-top:1px solid var(--line); }
.rp-name { font-weight:600; color:var(--t1); }
.rp-sub  { font-size:11.5px; color:var(--t3); margin-top:2px; }
.rp-mono { font-family:ui-monospace,monospace; font-size:12px; color:var(--t2); }
/* Badge */
.rp-badge { display:inline-flex; align-items:center; height:20px; padding:0 8px; border-radius:999px; font-size:11px; font-weight:600; }
.rp-badge.ok   { background:var(--ok-50); color:var(--ok); }
.rp-badge.warn { background:var(--warn-50); color:#b45309; }
.rp-badge.red  { background:var(--red-50); color:var(--red); }
.rp-badge.gray { background:#f1f3f8; color:var(--t2); }
.rp-badge.inf  { background:var(--inf-50); color:var(--inf); }
.rp-badge.pri  { background:var(--pri-50); color:var(--pri); }
.rp-badge.vio  { background:var(--vio-50); color:var(--vio); }
/* Buttons */
.rp-btn { height:36px; padding:0 14px; border-radius:9px; border:1px solid var(--line); background:white; color:var(--t1); font:inherit; font-size:13px; font-weight:500; cursor:pointer; display:inline-flex; align-items:center; gap:7px; text-decoration:none; transition:background 100ms; }
.rp-btn:hover { background:#f5f7fc; border-color:var(--line-2); }
.rp-btn.pri { background:var(--pri); color:#fff; border-color:transparent; font-weight:600; }
.rp-btn.pri:hover { background:var(--pri-2); }
/* Empty */
.rp-empty { padding:52px 20px; text-align:center; color:var(--t3); font-size:13.5px; }
.rp-empty svg { display:block; margin:0 auto 10px; opacity:.4; }
/* Separator */
.rp-sep { height:1px; background:var(--line); margin:0 16px; }
/* Stat cards row */
.rp-stat-row { display:grid; grid-template-columns:repeat(5,1fr); gap:12px; margin-bottom:20px; }
.rp-stat-card { background:#fff; border:1px solid var(--line); border-radius:12px; padding:14px 16px; box-shadow:var(--sh-sm); }
.rp-stat-card .rp-sc-val { font-size:24px; font-weight:700; color:var(--t1); line-height:1.1; }
.rp-stat-card .rp-sc-label { font-size:11px; font-weight:600; color:var(--t3); text-transform:uppercase; letter-spacing:.06em; margin-top:4px; }
.rp-stat-card .rp-sc-icon { width:36px; height:36px; border-radius:9px; display:flex; align-items:center; justify-content:center; margin-bottom:10px; }
/* Charts row */
.rp-chart-row { display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:20px; }
.rp-chart-card { background:#fff; border:1px solid var(--line); border-radius:14px; box-shadow:var(--sh-sm); overflow:hidden; }
.rp-chart-card .rp-card-head { padding:13px 18px 11px; }
.rp-chart-body { padding:16px 18px 18px; position:relative; height:220px; }
/* Pagination */
.rp-pagination { display:flex; align-items:center; justify-content:space-between; padding:12px 16px; border-top:1px solid var(--line); }
.rp-pagination-info { font-size:12.5px; color:var(--t3); }
.rp-pagination-nav  { display:flex; gap:4px; align-items:center; }
.rp-pg-btn { height:30px; min-width:30px; padding:0 8px; border-radius:7px; border:1px solid var(--line); background:#fff; color:var(--t1); font:inherit; font-size:12px; font-weight:500; cursor:pointer; display:inline-flex; align-items:center; justify-content:center; gap:4px; transition:background 100ms; }
.rp-pg-btn:hover:not(:disabled) { background:#f5f7fc; border-color:var(--line-2); }
.rp-pg-btn.active { background:var(--pri); color:#fff; border-color:var(--pri); font-weight:600; }
.rp-pg-btn:disabled { opacity:.4; cursor:not-allowed; }

/* ============================================================
   RESPONSIVE — MOBILE
   ============================================================ */
@media (max-width: 900px) {
  .rp-stat-row   { grid-template-columns:repeat(3,1fr); }
  .rp-chart-row  { grid-template-columns:1fr; }
}
@media (max-width: 640px) {
  /* Wrapper */
  .rp.fi-page-content { padding:14px 12px 40px !important; }

  /* Header */
  .rp-head { flex-direction:column; align-items:flex-start; gap:10px; margin-bottom:14px; }
  .rp-head h1 { font-size:20px; }
  .rp-head p  { font-size:12.5px; }
  .rp-head .rp-btn { width:100%; justify-content:center; height:38px; }

  /* Stat cards — 2 cols */
  .rp-stat-row { grid-template-columns:repeat(2,1fr); gap:8px; margin-bottom:14px; }
  .rp-stat-card { padding:10px 12px 10px; }
  .rp-stat-card .rp-sc-icon { width:30px; height:30px; border-radius:8px; margin-bottom:8px; }
  .rp-stat-card .rp-sc-icon svg { width:15px; height:15px; }
  .rp-stat-card .rp-sc-val   { font-size:clamp(15px,4vw,22px); }
  .rp-stat-card .rp-sc-label { font-size:10px; }

  /* Charts */
  .rp-chart-row { gap:10px; margin-bottom:14px; }
  .rp-chart-body { height:170px; padding:10px 12px; }
  .rp-chart-card .rp-card-head { padding:10px 14px 9px; }
  .rp-chart-card .rp-card-head h3 { font-size:13px; }

  /* Tabs — 2×3 grid */
  .rp-tabs { display:grid; grid-template-columns:repeat(2,1fr); gap:4px; padding:4px; margin-bottom:12px; }
  .rp-tab  { flex:none; min-width:0; font-size:11.5px; padding:8px 6px; white-space:normal; line-height:1.3; }

  /* Filters — stack vertically */
  .rp-filters { flex-direction:column; align-items:stretch; padding:10px 12px; gap:8px; margin-bottom:10px; }
  .rp-fg { width:100%; }
  .rp-fg input,
  .rp-fg select { width:100% !important; min-width:0 !important; box-sizing:border-box; }
  .rp-fg input[type=search] { width:100% !important; }
  .rp-fg input[type=date]   { width:100% !important; }
  .rp-period { flex-wrap:wrap; gap:4px; }
  .rp-pbtn { flex:1; min-width:0; font-size:12px; padding:0 8px; }

  /* Card head */
  .rp-card-head { flex-direction:column; align-items:flex-start; gap:8px; padding:12px 14px 10px; }
  .rp-card-head h3 { font-size:13.5px; }
  .rp-card-stats { gap:4px; }
  .rp-chip { font-size:10.5px; padding:0 7px; }

  /* Pagination */
  .rp-pagination { flex-direction:column; align-items:center; gap:8px; padding:10px 12px; }
  .rp-pagination-info { font-size:12px; }
}
@media (max-width: 400px) {
  .rp-stat-row { grid-template-columns:repeat(2,1fr); gap:6px; }
  .rp-stat-card .rp-sc-val { font-size:14px; }
  .rp-chart-body { height:150px; }
}
</style>

<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <defs>
    <symbol id="rpi-book"   viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></symbol>
    <symbol id="rpi-user"   viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></symbol>
    <symbol id="rpi-loan"   viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="9" y1="13" x2="15" y2="13"/><line x1="9" y1="17" x2="13" y2="17"/></symbol>
    <symbol id="rpi-return" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 102.13-9.36L1 10"/></symbol>
    <symbol id="rpi-money"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></symbol>
    <symbol id="rpi-visit"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></symbol>
    <symbol id="rpi-print"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></symbol>
    <symbol id="rpi-search" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></symbol>
    <symbol id="rpi-excel"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="16" y2="17"/><line x1="10" y1="9" x2="14" y2="9"/></symbol>
  </defs>
</svg>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>

<div class="rp fi-page-content" style="padding:28px 28px 60px;width:100%;box-sizing:border-box;overflow-x:hidden;">

  {{-- Header --}}
  <div class="rp-head">
    <div>
      <h1>Laporan Perpustakaan</h1>
      <p>SMP Negeri 3 Ajibarang &middot; {{ $tanggal }}</p>
    </div>
    <button onclick="document.getElementById('excel-modal').style.display='flex'" class="rp-btn" style="border-color:#16a34a;color:#16a34a;">
      <svg width="15" height="15"><use href="#rpi-excel"/></svg>
      Unduh Excel
    </button>
  </div>

  {{-- Modal Excel --}}
  <div id="excel-modal" style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(15,23,42,.5);align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;padding:24px;width:min(380px,calc(100vw - 32px));box-shadow:0 20px 60px rgba(0,0,0,.2);">
      <h3 style="font-size:16px;font-weight:700;color:#0f172a;margin-bottom:6px;">Unduh Laporan Excel</h3>
      <p style="font-size:13px;color:#5a6478;margin-bottom:20px;">File Excel berisi 4 sheet: Ringkasan, Peminjaman, Denda, dan Kunjungan.</p>
      <form id="excel-form" action="{{ route('laporan.perpustakaan.excel') }}" method="GET">
        <div style="margin-bottom:14px;">
          <label style="font-size:11px;font-weight:700;color:#8b94a6;text-transform:uppercase;letter-spacing:.06em;display:block;margin-bottom:5px;">Periode</label>
          <div style="display:flex;gap:8px;">
            <select name="bulan" id="xl-bulan" style="flex:1;height:36px;border:1px solid #d4dae6;border-radius:8px;padding:0 10px;font-size:13px;color:#0f172a;">
              @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $idx => $nm)
              <option value="{{ $idx+1 }}" {{ ($idx+1)==now()->month ? 'selected' : '' }}>{{ $nm }}</option>
              @endforeach
            </select>
            <select name="tahun" id="xl-tahun" style="width:90px;height:36px;border:1px solid #d4dae6;border-radius:8px;padding:0 10px;font-size:13px;color:#0f172a;">
              @for($y = now()->year; $y >= now()->year - 4; $y--)
              <option value="{{ $y }}" {{ $y==now()->year ? 'selected' : '' }}>{{ $y }}</option>
              @endfor
            </select>
          </div>
        </div>
        <div style="margin-bottom:20px;">
          <label style="display:flex;align-items:center;gap:8px;font-size:13px;color:#0f172a;cursor:pointer;">
            <input type="checkbox" name="semua" value="1" id="xl-semua" style="width:16px;height:16px;"
              onchange="document.getElementById('xl-bulan').disabled=this.checked;document.getElementById('xl-tahun').disabled=this.checked;">
            Semua periode (tanpa filter bulan/tahun)
          </label>
        </div>
        <div style="display:flex;gap:8px;">
          <button type="button" onclick="document.getElementById('excel-modal').style.display='none'"
            style="flex:1;height:38px;border:1px solid #e6eaf2;border-radius:9px;background:#fff;font-size:13px;font-weight:500;cursor:pointer;color:#0f172a;">
            Batal
          </button>
          <button type="submit"
            style="flex:1;height:38px;border:none;border-radius:9px;background:#16a34a;color:#fff;font-size:13px;font-weight:600;cursor:pointer;">
            Unduh Excel
          </button>
        </div>
      </form>
    </div>
  </div>

  {{-- ============================================================
       STAT CARDS + GRAFIK (selalu tampil di semua tab)
  ============================================================ --}}
  <div class="rp-stat-row">
    <div class="rp-stat-card">
      <div class="rp-sc-icon" style="background:#eef2ff;">
        <svg width="18" height="18" fill="none" stroke="#1e3a8a" stroke-width="2" viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
      </div>
      <div class="rp-sc-val">{{ number_format($statTotalBuku) }}</div>
      <div class="rp-sc-label">Buku Aktif</div>
    </div>
    <div class="rp-stat-card">
      <div class="rp-sc-icon" style="background:#e6f7ed;">
        <svg width="18" height="18" fill="none" stroke="#16a34a" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
      </div>
      <div class="rp-sc-val">{{ number_format($statAnggotaAktif) }}</div>
      <div class="rp-sc-label">Anggota Aktif</div>
    </div>
    <div class="rp-stat-card">
      <div class="rp-sc-icon" style="background:#fffbeb;">
        <svg width="18" height="18" fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
      </div>
      <div class="rp-sc-val">{{ number_format($statPinjamAktif) }}</div>
      <div class="rp-sc-label">Sedang Dipinjam</div>
    </div>
    <div class="rp-stat-card">
      <div class="rp-sc-icon" style="background:#fee2e2;">
        <svg width="18" height="18" fill="none" stroke="#dc2626" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
      </div>
      <div class="rp-sc-val" style="font-size:18px;">Rp {{ number_format($statDendaBelum, 0, ',', '.') }}</div>
      <div class="rp-sc-label">Denda Belum Lunas</div>
    </div>
    <div class="rp-stat-card">
      <div class="rp-sc-icon" style="background:#e8efff;">
        <svg width="18" height="18" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
      </div>
      <div class="rp-sc-val">{{ number_format($statKunjunganBulan) }}</div>
      <div class="rp-sc-label">Kunjungan Bulan Ini</div>
    </div>
  </div>

  {{-- Grafik --}}
  <div class="rp-chart-row">
    <div class="rp-chart-card">
      <div class="rp-card-head">
        <h3>Peminjaman per Bulan</h3>
        <span class="rp-chip inf">6 bulan terakhir</span>
      </div>
      <div class="rp-chart-body" wire:ignore>
        <canvas id="chart-loans"></canvas>
      </div>
    </div>
    <div class="rp-chart-card">
      <div class="rp-card-head">
        <h3>Kunjungan per Bulan</h3>
        <span class="rp-chip pri">6 bulan terakhir</span>
      </div>
      <div class="rp-chart-body" wire:ignore>
        <canvas id="chart-visits"></canvas>
      </div>
    </div>
  </div>

  <script>
  (function () {
    const LABELS  = @json($chartLabels);
    const LOANS   = @json($chartLoans);
    const VISITS  = @json($chartVisits);

    function initCharts() {
      // hancurkan instance lama jika ada
      ['chart-loans', 'chart-visits'].forEach(id => {
        const existing = Chart.getChart(id);
        if (existing) existing.destroy();
      });

      const baseOpts = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          x: { grid: { display: false }, ticks: { font: { size: 11 }, color: '#8b94a6' } },
          y: { grid: { color: '#f1f3f8' }, ticks: { font: { size: 11 }, color: '#8b94a6', stepSize: 1, precision: 0 }, beginAtZero: true },
        },
      };

      new Chart(document.getElementById('chart-loans'), {
        type: 'bar',
        data: {
          labels: LABELS,
          datasets: [{ data: LOANS, backgroundColor: 'rgba(30,58,138,0.80)', borderRadius: 6, borderSkipped: false }],
        },
        options: baseOpts,
      });

      new Chart(document.getElementById('chart-visits'), {
        type: 'line',
        data: {
          labels: LABELS,
          datasets: [{
            data: VISITS,
            borderColor: '#2563eb',
            backgroundColor: 'rgba(37,99,235,0.10)',
            borderWidth: 2.5,
            pointBackgroundColor: '#2563eb',
            pointRadius: 4,
            tension: 0.35,
            fill: true,
          }],
        },
        options: baseOpts,
      });
    }

    // Init saat DOM siap dan setelah setiap navigasi Livewire
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initCharts);
    } else {
      initCharts();
    }
    document.addEventListener('livewire:navigated', initCharts);
  })();
  </script>

  {{-- Tab navigation --}}
  <div class="rp-tabs" role="tablist">
    @foreach($tabs as $key => $tab)
    <button wire:click="setTab('{{ $key }}')"
            class="rp-tab {{ $activeTab === $key ? 'active' : '' }}"
            role="tab" aria-selected="{{ $activeTab === $key ? 'true' : 'false' }}">
      <svg width="14" height="14"><use href="{{ $tab['icon'] }}"/></svg>
      {{ $tab['label'] }}
    </button>
    @endforeach
  </div>

  {{-- ============================================================
       TAB: DATA BUKU
  ============================================================ --}}
  @if($activeTab === 'buku')

  <div class="rp-filters">
    <div class="rp-fg">
      <label>Cari</label>
      <input type="search" wire:model.live.debounce.400ms="bukuSearch" placeholder="Judul, penulis, kode…">
    </div>
    <div class="rp-fg">
      <label>Kategori</label>
      <select wire:model.live="bukuKategori">
        <option value="">Semua Kategori</option>
        @foreach(['Fiksi','Non-Fiksi','Pelajaran','Referensi','Ensiklopedi','Biografi','Sains & Teknologi','Sosial & Budaya','Agama','Lainnya'] as $kat)
        <option value="{{ $kat }}">{{ $kat }}</option>
        @endforeach
      </select>
    </div>
    <div class="rp-fg">
      <label>Status</label>
      <select wire:model.live="bukuStatus">
        <option value="">Semua Status</option>
        <option value="aktif">Aktif</option>
        <option value="nonaktif">Nonaktif</option>
      </select>
    </div>
  </div>

  <div class="rp-card">
    <div class="rp-card-head">
      <h3>Data Koleksi Buku</h3>
      <div class="rp-card-stats">
        <span class="rp-chip tot">{{ $records->total() }} buku</span>
        <span class="rp-chip inf">Total stok: {{ number_format($totalStok) }}</span>
      </div>
    </div>
    <div class="rp-table-wrap">
      <table class="rp-table">
        <thead>
          <tr>
            <th style="width:40px">No</th>
            <th>Kode Buku</th>
            <th>Judul Buku</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Kategori</th>
            <th style="text-align:center">Stok</th>
            <th style="text-align:center">Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($records as $i => $buku)
          <tr>
            <td style="color:var(--t3);font-size:12px">{{ $records->firstItem() + $loop->index }}</td>
            <td><span class="rp-mono">{{ $buku->kode_buku }}</span></td>
            <td>
              <div class="rp-name">{{ $buku->judul }}</div>
            </td>
            <td style="color:var(--t2);font-size:12.5px">{{ $buku->penulis ?: '—' }}</td>
            <td style="color:var(--t2);font-size:12.5px">{{ $buku->penerbit ?: '—' }}</td>
            <td style="color:var(--t2);font-size:12.5px">{{ $buku->tahun ?: '—' }}</td>
            <td>
              @if($buku->kategori)
              <span class="rp-badge pri">{{ $buku->kategori }}</span>
              @else
              <span style="color:var(--t3)">—</span>
              @endif
            </td>
            <td style="text-align:center;font-weight:600;">{{ $buku->stok }}</td>
            <td style="text-align:center">
              @if($buku->is_active)
              <span class="rp-badge ok">Aktif</span>
              @else
              <span class="rp-badge gray">Nonaktif</span>
              @endif
            </td>
          </tr>
          @empty
          <tr><td colspan="9" class="rp-empty">
            <svg width="32" height="32"><use href="#rpi-book"/></svg>
            Tidak ada data buku ditemukan.
          </td></tr>
          @endforelse
        </tbody>
        @if($records->isNotEmpty())
        <tfoot>
          <tr>
            <td colspan="7" style="font-weight:700;color:var(--t1)">Total</td>
            <td style="text-align:center;font-weight:700;color:var(--t1)">{{ number_format($totalStok) }}</td>
            <td></td>
          </tr>
        </tfoot>
        @endif
      </table>
    </div>
    @include('filament.admin.pages._rp_pagination', ['tabKey' => 'buku'])
  </div>

  {{-- ============================================================
       TAB: DATA ANGGOTA
  ============================================================ --}}
  @elseif($activeTab === 'anggota')

  <div class="rp-filters">
    <div class="rp-fg">
      <label>Cari</label>
      <input type="search" wire:model.live.debounce.400ms="anggotaSearch" placeholder="Nama atau kode anggota…">
    </div>
    <div class="rp-fg">
      <label>Jenis</label>
      <select wire:model.live="anggotaJenis">
        <option value="">Semua</option>
        <option value="siswa">Siswa</option>
        <option value="guru">Guru</option>
      </select>
    </div>
    <div class="rp-fg">
      <label>Kelas</label>
      <select wire:model.live="anggotaKelas">
        <option value="">Semua Kelas</option>
        @foreach($kelasList as $kls)
        <option value="{{ $kls }}">{{ $kls }}</option>
        @endforeach
      </select>
    </div>
    <div class="rp-fg">
      <label>Status</label>
      <select wire:model.live="anggotaStatus">
        <option value="">Semua Status</option>
        <option value="aktif">Aktif</option>
        <option value="lulus">Lulus</option>
        <option value="pindah">Pindah</option>
        <option value="keluar">Keluar</option>
      </select>
    </div>
  </div>

  <div class="rp-card">
    <div class="rp-card-head">
      <h3>Data Anggota Perpustakaan</h3>
      <div class="rp-card-stats">
        <span class="rp-chip tot">{{ $records->total() }} anggota</span>
        <span class="rp-chip pri">{{ $jmlSiswa }} siswa</span>
        <span class="rp-chip warn">{{ $jmlGuru }} guru</span>
        <span class="rp-chip ok">{{ $records->getCollection()->where('status', 'aktif')->count() }} aktif (hal ini)</span>
      </div>
    </div>
    <div class="rp-table-wrap">
      <table class="rp-table">
        <thead>
          <tr>
            <th style="width:40px">No</th>
            <th>Kode Anggota</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Kelas</th>
            <th>No. HP</th>
            <th style="text-align:center">Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($records as $i => $anggota)
          <tr>
            <td style="color:var(--t3);font-size:12px">{{ $records->firstItem() + $loop->index }}</td>
            <td><span class="rp-mono">{{ $anggota->kode_anggota }}</span></td>
            <td>
              <div class="rp-name">{{ $anggota->nama }}</div>
              @if($anggota->jenis === 'siswa' && $anggota->tahun_masuk)
              <div class="rp-sub">Angkatan {{ $anggota->tahun_masuk }}</div>
              @endif
            </td>
            <td>
              @if($anggota->jenis === 'guru')
              <span class="rp-badge warn">Guru</span>
              @else
              <span class="rp-badge pri">Siswa</span>
              @endif
            </td>
            <td style="color:var(--t2);font-size:12.5px">{{ $anggota->kelas ?: '—' }}</td>
            <td style="color:var(--t2);font-size:12.5px">{{ $anggota->no_hp ?: '—' }}</td>
            <td style="text-align:center">
              @php $st = $anggota->status; @endphp
              <span class="rp-badge {{ match($st) { 'aktif' => 'ok', 'lulus' => 'gray', 'pindah' => 'warn', 'keluar' => 'red', default => 'gray' } }}">
                {{ match($st) { 'aktif' => 'Aktif', 'lulus' => 'Lulus', 'pindah' => 'Pindah', 'keluar' => 'Keluar', default => $st } }}
              </span>
            </td>
          </tr>
          @empty
          <tr><td colspan="7" class="rp-empty">
            <svg width="32" height="32"><use href="#rpi-user"/></svg>
            Tidak ada data anggota ditemukan.
          </td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @include('filament.admin.pages._rp_pagination', ['tabKey' => 'anggota'])
  </div>

  {{-- ============================================================
       TAB: PEMINJAMAN
  ============================================================ --}}
  @elseif($activeTab === 'peminjaman')

  <div class="rp-filters">
    <div class="rp-fg">
      <label>Cari</label>
      <input type="search" wire:model.live.debounce.400ms="pinjamSearch" placeholder="Nama anggota atau judul buku…">
    </div>
    <div class="rp-fg">
      <label>Status</label>
      <select wire:model.live="pinjamStatus">
        <option value="">Semua Status</option>
        <option value="dipinjam">Dipinjam</option>
        <option value="dikembalikan">Dikembalikan</option>
        <option value="terlambat">Terlambat</option>
      </select>
    </div>
    <div class="rp-fg">
      <label>Tgl Pinjam Dari</label>
      <input type="date" wire:model.live="pinjamDari">
    </div>
    <div class="rp-fg">
      <label>Sampai</label>
      <input type="date" wire:model.live="pinjamSampai">
    </div>
  </div>

  <div class="rp-card">
    <div class="rp-card-head">
      <h3>Laporan Peminjaman Buku</h3>
      <div class="rp-card-stats">
        <span class="rp-chip tot">{{ $records->total() }} transaksi</span>
        <span class="rp-chip warn">{{ $jmlDipinjam }} dipinjam</span>
        <span class="rp-chip ok">{{ $jmlKembali }} dikembalikan</span>
        <span class="rp-chip red">{{ $jmlTerlambat }} terlambat</span>
      </div>
    </div>
    <div class="rp-table-wrap">
      <table class="rp-table">
        <thead>
          <tr>
            <th style="width:40px">No</th>
            <th>Anggota</th>
            <th>Judul Buku</th>
            <th>Tgl Pinjam</th>
            <th>Batas Kembali</th>
            <th>Tgl Dikembalikan</th>
            <th style="text-align:center">Status</th>
            <th>Denda</th>
          </tr>
        </thead>
        <tbody>
          @forelse($records as $i => $loan)
          @php
            $isLate = in_array($loan->status, ['terlambat']);
            $isDue  = $loan->status === 'dipinjam' && $loan->tgl_batas_kembali?->isPast();
          @endphp
          <tr>
            <td style="color:var(--t3);font-size:12px">{{ $records->firstItem() + $loop->index }}</td>
            <td>
              <div class="rp-name">{{ $loan->member?->nama ?? '—' }}</div>
              <div class="rp-sub">{{ $loan->member?->kode_anggota }}</div>
            </td>
            <td>
              <div style="font-size:13px;color:var(--t1);">{{ \Illuminate\Support\Str::limit($loan->book?->judul, 40) ?? '—' }}</div>
              <div class="rp-sub">{{ $loan->book?->kode_buku }}</div>
            </td>
            <td style="font-size:12.5px;color:var(--t2)">{{ $loan->tgl_pinjam?->format('d M Y') ?? '—' }}</td>
            <td style="font-size:12.5px;{{ ($isLate || $isDue) ? 'color:var(--red);font-weight:600' : 'color:var(--t2)' }}">
              {{ $loan->tgl_batas_kembali?->format('d M Y') ?? '—' }}
            </td>
            <td style="font-size:12.5px;color:var(--t2)">{{ $loan->tgl_kembali?->format('d M Y') ?? '—' }}</td>
            <td style="text-align:center">
              <span class="rp-badge {{ match($loan->status) { 'dipinjam' => 'warn', 'dikembalikan' => 'ok', 'terlambat' => 'red', default => 'gray' } }}">
                {{ match($loan->status) { 'dipinjam' => 'Dipinjam', 'dikembalikan' => 'Dikembalikan', 'terlambat' => 'Terlambat', default => $loan->status } }}
              </span>
            </td>
            <td style="font-size:12.5px">
              @if($loan->fine)
                <span style="{{ $loan->fine->status_bayar === 'belum_lunas' ? 'color:var(--red);font-weight:600' : 'color:var(--ok);font-weight:600' }}">
                  Rp {{ number_format($loan->fine->nominal, 0, ',', '.') }}
                </span>
              @else
                <span style="color:var(--t3)">—</span>
              @endif
            </td>
          </tr>
          @empty
          <tr><td colspan="8" class="rp-empty">
            <svg width="32" height="32"><use href="#rpi-loan"/></svg>
            Tidak ada data peminjaman ditemukan.
          </td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @include('filament.admin.pages._rp_pagination', ['tabKey' => 'pinjam'])
  </div>

  {{-- ============================================================
       TAB: PENGEMBALIAN
  ============================================================ --}}
  @elseif($activeTab === 'pengembalian')

  <div class="rp-filters">
    <div class="rp-fg">
      <label>Cari</label>
      <input type="search" wire:model.live.debounce.400ms="kembaliSearch" placeholder="Nama anggota…">
    </div>
    <div class="rp-fg">
      <label>Kondisi Buku</label>
      <select wire:model.live="kembaliKondisi">
        <option value="">Semua Kondisi</option>
        <option value="baik">Baik</option>
        <option value="rusak">Rusak</option>
        <option value="hilang">Hilang</option>
      </select>
    </div>
    <div class="rp-fg">
      <label>Tgl Kembali Dari</label>
      <input type="date" wire:model.live="kembaliDari">
    </div>
    <div class="rp-fg">
      <label>Sampai</label>
      <input type="date" wire:model.live="kembaliSampai">
    </div>
  </div>

  <div class="rp-card">
    <div class="rp-card-head">
      <h3>Laporan Pengembalian Buku</h3>
      <div class="rp-card-stats">
        <span class="rp-chip tot">{{ $records->total() }} transaksi</span>
        <span class="rp-chip ok">{{ $jmlBaik }} baik</span>
        <span class="rp-chip warn">{{ $jmlRusak }} rusak</span>
        <span class="rp-chip red">{{ $jmlHilang }} hilang</span>
      </div>
    </div>
    <div class="rp-table-wrap">
      <table class="rp-table">
        <thead>
          <tr>
            <th style="width:40px">No</th>
            <th>Anggota</th>
            <th>Judul Buku</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Keterlambatan</th>
            <th style="text-align:center">Kondisi</th>
            <th style="text-align:center">Sanksi</th>
            <th>Denda</th>
          </tr>
        </thead>
        <tbody>
          @forelse($records as $i => $loan)
          @php
            $hari = $loan->jumlahHariTerlambat();
          @endphp
          <tr>
            <td style="color:var(--t3);font-size:12px">{{ $records->firstItem() + $loop->index }}</td>
            <td>
              <div class="rp-name">{{ $loan->member?->nama ?? '—' }}</div>
              <div class="rp-sub">{{ $loan->member?->kode_anggota }}</div>
            </td>
            <td>
              <div style="font-size:13px;color:var(--t1);">{{ \Illuminate\Support\Str::limit($loan->book?->judul, 38) ?? '—' }}</div>
              <div class="rp-sub">{{ $loan->book?->kode_buku }}</div>
            </td>
            <td style="font-size:12.5px;color:var(--t2)">{{ $loan->tgl_pinjam?->format('d M Y') ?? '—' }}</td>
            <td style="font-size:12.5px;color:var(--t2)">{{ $loan->tgl_kembali?->format('d M Y') ?? '—' }}</td>
            <td style="font-size:12.5px">
              @if($hari > 0)
              <span style="color:var(--red);font-weight:600;">+{{ $hari }} hari</span>
              @else
              <span style="color:var(--ok)">Tepat waktu</span>
              @endif
            </td>
            <td style="text-align:center">
              @php $k = $loan->kondisi_kembali; @endphp
              @if($k)
              <span class="rp-badge {{ match($k) { 'baik' => 'ok', 'rusak' => 'warn', 'hilang' => 'red', default => 'gray' } }}">
                {{ match($k) { 'baik' => 'Baik', 'rusak' => 'Rusak', 'hilang' => 'Hilang', default => '—' } }}
              </span>
              @else
              <span style="color:var(--t3)">—</span>
              @endif
            </td>
            <td style="text-align:center">
              @php $sk = $loan->status_sanksi; @endphp
              @if($sk && $sk !== 'tidak_ada')
              <span class="rp-badge {{ $sk === 'belum_lunas' ? 'red' : 'ok' }}">
                {{ $sk === 'belum_lunas' ? 'Belum Lunas' : 'Lunas' }}
              </span>
              @else
              <span class="rp-badge gray">Tidak Ada</span>
              @endif
            </td>
            <td style="font-size:12.5px">
              @if($loan->fine)
              <span style="{{ $loan->fine->status_bayar === 'belum_lunas' ? 'color:var(--red);font-weight:600' : 'color:var(--ok);font-weight:600' }}">
                Rp {{ number_format($loan->fine->nominal, 0, ',', '.') }}
              </span>
              @else
              <span style="color:var(--t3)">—</span>
              @endif
            </td>
          </tr>
          @empty
          <tr><td colspan="9" class="rp-empty">
            <svg width="32" height="32"><use href="#rpi-return"/></svg>
            Tidak ada data pengembalian ditemukan.
          </td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @include('filament.admin.pages._rp_pagination', ['tabKey' => 'kembali'])
  </div>

  {{-- ============================================================
       TAB: DENDA
  ============================================================ --}}
  @elseif($activeTab === 'denda')

  <div class="rp-filters">
    <div class="rp-fg">
      <label>Cari</label>
      <input type="search" wire:model.live.debounce.400ms="dendaSearch" placeholder="Nama anggota…">
    </div>
    <div class="rp-fg">
      <label>Status Bayar</label>
      <select wire:model.live="dendaStatus">
        <option value="">Semua Status</option>
        <option value="belum_lunas">Belum Lunas</option>
        <option value="lunas">Lunas</option>
      </select>
    </div>
  </div>

  <div class="rp-card">
    <div class="rp-card-head">
      <h3>Laporan Denda Keterlambatan</h3>
      <div class="rp-card-stats">
        <span class="rp-chip tot">{{ $records->total() }} kasus</span>
        <span class="rp-chip red">Belum Lunas: Rp {{ number_format($totalBelum, 0, ',', '.') }}</span>
        <span class="rp-chip ok">Lunas: Rp {{ number_format($totalLunas, 0, ',', '.') }}</span>
        <span class="rp-chip inf">Total: Rp {{ number_format($totalNominal, 0, ',', '.') }}</span>
      </div>
    </div>
    <div class="rp-table-wrap">
      <table class="rp-table">
        <thead>
          <tr>
            <th style="width:40px">No</th>
            <th>Anggota</th>
            <th>Judul Buku</th>
            <th>Tgl Kembali</th>
            <th style="text-align:center">Hari Terlambat</th>
            <th style="text-align:right">Nominal Denda</th>
            <th style="text-align:center">Status Bayar</th>
            <th>Tgl Lunas</th>
          </tr>
        </thead>
        <tbody>
          @forelse($records as $i => $fine)
          <tr>
            <td style="color:var(--t3);font-size:12px">{{ $records->firstItem() + $loop->index }}</td>
            <td>
              <div class="rp-name">{{ $fine->loan?->member?->nama ?? '—' }}</div>
              <div class="rp-sub">{{ $fine->loan?->member?->kode_anggota }}</div>
            </td>
            <td>
              <div style="font-size:13px;color:var(--t1);">{{ \Illuminate\Support\Str::limit($fine->loan?->book?->judul, 38) ?? '—' }}</div>
            </td>
            <td style="font-size:12.5px;color:var(--t2)">{{ $fine->loan?->tgl_kembali?->format('d M Y') ?? '—' }}</td>
            <td style="text-align:center;font-weight:600;color:var(--red)">{{ $fine->jumlah_hari }} hari</td>
            <td style="text-align:right;font-weight:600;font-size:13px">Rp {{ number_format($fine->nominal, 0, ',', '.') }}</td>
            <td style="text-align:center">
              @if($fine->status_bayar === 'lunas')
              <span class="rp-badge ok">Lunas</span>
              @else
              <span class="rp-badge red">Belum Lunas</span>
              @endif
            </td>
            <td style="font-size:12.5px;color:var(--t2)">{{ $fine->tgl_bayar?->format('d M Y') ?? '—' }}</td>
          </tr>
          @empty
          <tr><td colspan="8" class="rp-empty">
            <svg width="32" height="32"><use href="#rpi-money"/></svg>
            Tidak ada data denda ditemukan.
          </td></tr>
          @endforelse
        </tbody>
        @if($records->isNotEmpty())
        <tfoot>
          <tr>
            <td colspan="5" style="font-weight:700;color:var(--t1)">Total</td>
            <td style="text-align:right;font-weight:700;color:var(--t1)">Rp {{ number_format($totalNominal, 0, ',', '.') }}</td>
            <td colspan="2"></td>
          </tr>
        </tfoot>
        @endif
      </table>
    </div>
    @include('filament.admin.pages._rp_pagination', ['tabKey' => 'denda'])
  </div>

  {{-- ============================================================
       TAB: KUNJUNGAN
  ============================================================ --}}
  @elseif($activeTab === 'kunjungan')

  <div class="rp-filters">
    <div class="rp-fg">
      <label>Periode Cepat</label>
      <div class="rp-period">
        <button wire:click="setPeriode('hari')"   class="rp-pbtn {{ $kunjunganPeriode === 'hari'   ? 'active' : '' }}">Hari Ini</button>
        <button wire:click="setPeriode('minggu')" class="rp-pbtn {{ $kunjunganPeriode === 'minggu' ? 'active' : '' }}">Minggu Ini</button>
        <button wire:click="setPeriode('bulan')"  class="rp-pbtn {{ $kunjunganPeriode === 'bulan'  ? 'active' : '' }}">Bulan Ini</button>
      </div>
    </div>
    @if(!$kunjunganPeriode)
    <div class="rp-fg">
      <label>Dari Tanggal</label>
      <input type="date" wire:model.live="kunjunganDari">
    </div>
    <div class="rp-fg">
      <label>Sampai</label>
      <input type="date" wire:model.live="kunjunganSampai">
    </div>
    @endif
    <div class="rp-fg">
      <label>Jenis Pengunjung</label>
      <select wire:model.live="kunjunganJenis">
        <option value="">Semua</option>
        <option value="siswa">Siswa</option>
        <option value="guru">Guru / Staf</option>
        <option value="umum">Tamu</option>
      </select>
    </div>
  </div>

  <div class="rp-card">
    <div class="rp-card-head">
      <h3>Laporan Kunjungan Perpustakaan</h3>
      <div class="rp-card-stats">
        <span class="rp-chip tot">{{ $records->total() }} kunjungan</span>
        <span class="rp-chip pri">{{ $jmlSiswa }} siswa</span>
        <span class="rp-chip warn">{{ $jmlGuru }} guru</span>
        <span class="rp-chip gray">{{ $jmlUmum }} tamu</span>
      </div>
    </div>
    <div class="rp-table-wrap">
      <table class="rp-table">
        <thead>
          <tr>
            <th style="width:40px">No</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Kelas</th>
            <th>Keperluan</th>
            <th>Tanggal</th>
            <th>Jam</th>
          </tr>
        </thead>
        <tbody>
          @forelse($records as $i => $visit)
          <tr>
            <td style="color:var(--t3);font-size:12px">{{ $records->firstItem() + $loop->index }}</td>
            <td><div class="rp-name">{{ $visit->nama }}</div></td>
            <td>
              @php $jp = $visit->jenis_pengunjung; @endphp
              <span class="rp-badge {{ match($jp) { 'siswa' => 'pri', 'guru' => 'warn', default => 'gray' } }}">
                {{ match($jp) { 'siswa' => 'Siswa', 'guru' => 'Guru', 'umum' => 'Tamu', default => $jp } }}
              </span>
            </td>
            <td style="font-size:12.5px;color:var(--t2)">{{ ($jp === 'siswa' && $visit->kelas) ? $visit->kelas : '—' }}</td>
            <td>
              @php
                $kpBadge = match($visit->keperluan) {
                  'Membaca'                     => 'inf',
                  'Meminjam Buku'               => 'ok',
                  'Mengembalikan Buku'          => 'warn',
                  'Belajar / Mengerjakan Tugas' => 'pri',
                  default                       => 'gray',
                };
              @endphp
              <span class="rp-badge {{ $kpBadge }}">{{ $visit->keperluan ?? '—' }}</span>
            </td>
            <td style="font-size:12.5px;color:var(--t2)">{{ $visit->tgl_kunjungan?->format('d M Y') ?? '—' }}</td>
            <td style="font-size:12.5px;color:var(--t2)">{{ $visit->jam_kunjungan ? substr($visit->jam_kunjungan, 0, 5) : '—' }}</td>
          </tr>
          @empty
          <tr><td colspan="7" class="rp-empty">
            <svg width="32" height="32"><use href="#rpi-visit"/></svg>
            Tidak ada data kunjungan ditemukan.
          </td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @include('filament.admin.pages._rp_pagination', ['tabKey' => 'kunjungan'])
  </div>

  @endif

</div>
</div>{{-- /livewire root --}}
