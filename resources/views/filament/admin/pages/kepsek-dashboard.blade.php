<div>
@php
    $tanggal = now()->locale('id')->translatedFormat('l, d F Y');
@endphp

<style>
.kdb {
  --pri:#1e3a8a; --pri-2:#2746a4; --pri-50:#eef2ff; --pri-100:#dbe3ff;
  --teal:#0d7377; --teal-2:#0a5c60; --teal-50:#e6f4f4;
  --ok:#16a34a;  --ok-50:#e6f7ed;
  --inf:#2563eb; --inf-50:#e8efff;
  --vio:#7c3aed; --vio-50:#f1ebff;
  --warn:#f59e0b; --warn-50:#fffbeb;
  --red:#dc2626;  --red-50:#fee2e2;
  --acc:#ef7c2a; --acc-50:#fff4ea;
  --line:#e6eaf2; --line-2:#d4dae6;
  --t1:#0f172a; --t2:#5a6478; --t3:#8b94a6;
  --panel:#fff; --bg:#f3f5fa;
  --r:14px; --sh-sm:0 1px 2px rgba(15,23,42,.04);
}
/* Page head */
.kdb-head { display:flex; align-items:flex-end; justify-content:space-between; gap:20px; margin-bottom:24px; }
.kdb-head h1 { font-size:28px; font-weight:700; margin:0 0 4px; letter-spacing:-.015em; color:var(--t1); }
.kdb-head p  { margin:0; color:var(--t2); font-size:14px; }
/* Section header */
.kdb-sec { display:flex; align-items:center; gap:12px; margin-bottom:13px; margin-top:6px; }
.kdb-sec span { font-size:10.5px; font-weight:700; text-transform:uppercase; letter-spacing:.09em; white-space:nowrap; }
.kdb-sec-line { flex:1; height:1px; background:var(--line); }
/* Stats 3-col */
.kdb-stats { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-bottom:10px; }
.kdb-stat  { background:var(--panel); border:1px solid var(--line); border-radius:var(--r); padding:18px 18px 15px; position:relative; overflow:hidden; box-shadow:var(--sh-sm); }
.kdb-stat-head { display:flex; align-items:center; justify-content:space-between; }
.kdb-stat-lbl  { font-size:11.5px; color:var(--t3); letter-spacing:.06em; text-transform:uppercase; font-weight:700; }
.kdb-stat-ico  { width:34px; height:34px; border-radius:9px; display:grid; place-items:center; flex-shrink:0; }
.kdb-stat-val  { font-size:30px; font-weight:700; letter-spacing:-.02em; margin:13px 0 3px; color:var(--t1); }
.kdb-stat-sub  { font-size:12px; color:var(--t2); }
/* Cards */
.kdb-card { background:var(--panel); border:1px solid var(--line); border-radius:var(--r); box-shadow:var(--sh-sm); }
.kdb-card-head { padding:16px 20px 13px; display:flex; align-items:flex-start; justify-content:space-between; border-bottom:1px solid var(--line); }
.kdb-card-head h3 { margin:0; font-size:14.5px; font-weight:700; color:var(--t1); letter-spacing:-.005em; }
.kdb-card-head .sub { font-size:11.5px; color:var(--t3); margin-top:2px; }
.kdb-card-head .lnk { color:var(--pri); font-size:12px; text-decoration:none; font-weight:600; white-space:nowrap; margin-top:2px; }
.kdb-card-head .lnk:hover { color:var(--pri-2); }
.kdb-card-body { padding:6px 8px 10px; }
/* Charts 2-col */
.kdb-g2 { display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px; }
/* Chart */
.kdb-chart-wrap { padding:14px 16px 10px; }
.kdb-chart { display:flex; gap:6px; height:100px; align-items:flex-end; }
.kdb-chart-col { flex:1; display:flex; flex-direction:column; align-items:center; gap:3px; height:100%; }
.kdb-chart-val { font-size:9px; color:var(--t3); line-height:1; }
.kdb-chart-bar-wrap { flex:1; width:100%; display:flex; align-items:flex-end; }
.kdb-chart-bar { width:100%; border-radius:3px 3px 0 0; min-height:3px; transition:opacity 100ms; }
.kdb-chart-bar:hover { opacity:.8; }
.kdb-chart-lbl { font-size:9px; color:var(--t3); white-space:nowrap; line-height:1; }
/* 2-col summary */
.kdb-g2b { display:grid; grid-template-columns:1.5fr 1fr; gap:14px; margin-bottom:14px; }
/* Loan row */
.kdb-row { display:grid; grid-template-columns:36px 1fr auto; gap:12px; padding:10px 12px; border-radius:9px; align-items:center; }
.kdb-row-av { width:36px; height:36px; border-radius:9px; display:grid; place-items:center; font-weight:600; font-size:12px; flex-shrink:0; }
.kdb-row-title { font-size:13px; font-weight:600; color:var(--t1); overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
.kdb-row-sub { font-size:11.5px; color:var(--t3); margin-top:2px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
.kdb-row-badge { font-size:10px; padding:2px 7px; border-radius:999px; font-weight:600; white-space:nowrap; }
/* Post row */
.kdb-post { display:flex; gap:10px; padding:10px 14px; border-radius:9px; align-items:flex-start; }
.kdb-post:hover { background:#f5f7fc; }
.kdb-post-dot { width:6px; height:6px; border-radius:50%; margin-top:5px; flex-shrink:0; }
.kdb-post-title { font-size:13px; font-weight:600; color:var(--t1); line-height:1.4; overflow:hidden; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; }
.kdb-post-date { font-size:11px; color:var(--t3); margin-top:3px; }
/* Divider */
.kdb-div { height:1px; background:var(--line); margin:2px 12px; }
/* Empty */
.kdb-empty { padding:24px; text-align:center; color:var(--t3); font-size:13px; }
/* Quick links */
.kdb-links { display:grid; grid-template-columns:repeat(3,1fr); gap:12px; margin-bottom:4px; }
.kdb-link { border:1px solid var(--line); border-radius:12px; padding:16px 18px; display:flex; align-items:center; gap:14px; text-decoration:none; background:white; transition:border-color 110ms, background 110ms; }
.kdb-link:hover { border-color:var(--line-2); background:#f5f7fc; }
.kdb-link-ico { width:38px; height:38px; border-radius:10px; display:grid; place-items:center; flex-shrink:0; }
.kdb-link b   { font-size:13px; font-weight:600; color:var(--t1); display:block; }
.kdb-link span { font-size:11.5px; color:var(--t3); line-height:1.4; }
/* Fine footer */
.kdb-fine-foot { display:flex; align-items:center; justify-content:space-between; padding:9px 16px; background:var(--red-50); border-top:1px solid #fecaca; border-radius:0 0 var(--r) var(--r); font-size:12px; color:var(--red); font-weight:600; }
@media (max-width:1200px) {
  .kdb-stats { grid-template-columns:repeat(2,1fr); }
  .kdb-g2, .kdb-g2b, .kdb-links { grid-template-columns:1fr; }
}
</style>

<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <defs>
    <symbol id="ki-book"     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></symbol>
    <symbol id="ki-users"    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></symbol>
    <symbol id="ki-money"    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></symbol>
    <symbol id="ki-pkg"      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/><line x1="12" y1="8" x2="12" y2="12"/><polyline points="8 12 12 16 16 12"/></symbol>
    <symbol id="ki-foot"     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></symbol>
    <symbol id="ki-news"     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h16a2 2 0 002-2V4a2 2 0 00-2-2H8a2 2 0 00-2 2v16a4 4 0 01-4-4V6"/><path d="M16 2v4"/><line x1="8" y1="10" x2="16" y2="10"/><line x1="8" y1="14" x2="16" y2="14"/><line x1="8" y1="18" x2="12" y2="18"/></symbol>
    <symbol id="ki-image"    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></symbol>
    <symbol id="ki-mail"     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></symbol>
    <symbol id="ki-teacher"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M12 3L6 7"/><path d="M12 3l6 4"/><path d="M8 21v-4"/><path d="M16 21v-4"/></symbol>
    <symbol id="ki-star"     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></symbol>
    <symbol id="ki-globe"    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></symbol>
    <symbol id="ki-check"    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 17H5a2 2 0 01-2-2V5a2 2 0 012-2h11a2 2 0 012 2v5"/><polyline points="9 11 12 14 22 4"/></symbol>
    <symbol id="ki-report"   viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></symbol>
    <symbol id="ki-bar"      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/><line x1="2" y1="20" x2="22" y2="20"/></symbol>
    <symbol id="ki-clock"    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></symbol>
  </defs>
</svg>

<div class="kdb fi-page-content" style="padding:28px 28px 60px;">

  {{-- Page head --}}
  <div class="kdb-head">
    <div>
      <h1>Dashboard Kepala Sekolah</h1>
      <p>
        Ringkasan website &amp; perpustakaan &middot; {{ $tanggal }}
        &nbsp;&middot;&nbsp;
        <span style="color:var(--teal);font-weight:600;">Kepala Sekolah</span>
      </p>
    </div>
    <div style="display:flex;gap:10px;">
      <a href="{{ \App\Filament\Admin\Pages\StatistikWebsite::getUrl() }}"
         style="height:36px;padding:0 14px;border-radius:9px;border:1px solid var(--line);background:white;color:var(--t1);font:inherit;font-size:13px;font-weight:500;cursor:pointer;display:inline-flex;align-items:center;gap:7px;text-decoration:none;">
        <svg width="14" height="14"><use href="#ki-bar"/></svg>Statistik Website
      </a>
      <a href="{{ \App\Filament\Resources\LibraryReports\LibraryReportResource::getUrl('index') }}"
         style="height:36px;padding:0 14px;border-radius:9px;border:none;background:var(--teal);color:white;font:inherit;font-size:13px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:7px;text-decoration:none;">
        <svg width="14" height="14"><use href="#ki-report"/></svg>Laporan Perpustakaan
      </a>
    </div>
  </div>

  {{-- ─── SECTION: Website Sekolah ─── --}}
  <div class="kdb-sec">
    <span style="color:var(--teal);">Statistik Website Sekolah</span>
    <div class="kdb-sec-line"></div>
  </div>

  <div class="kdb-stats" style="margin-bottom:20px;">

    <div class="kdb-stat">
      <div class="kdb-stat-head">
        <span class="kdb-stat-lbl">Berita Terbit</span>
        <div class="kdb-stat-ico" style="background:var(--teal-50);color:var(--teal)"><svg width="17" height="17"><use href="#ki-news"/></svg></div>
      </div>
      <div class="kdb-stat-val">{{ number_format($totalBerita) }}</div>
      <div class="kdb-stat-sub">Artikel dipublikasi</div>
    </div>

    <div class="kdb-stat">
      <div class="kdb-stat-head">
        <span class="kdb-stat-lbl">Galeri Foto</span>
        <div class="kdb-stat-ico" style="background:var(--ok-50);color:var(--ok)"><svg width="17" height="17"><use href="#ki-image"/></svg></div>
      </div>
      <div class="kdb-stat-val">{{ number_format($totalGaleri) }}</div>
      <div class="kdb-stat-sub">Album dokumentasi</div>
    </div>

    <div class="kdb-stat">
      <div class="kdb-stat-head">
        <span class="kdb-stat-lbl">Pesan Belum Dibaca</span>
        <div class="kdb-stat-ico" style="background:var(--warn-50);color:var(--warn)"><svg width="17" height="17"><use href="#ki-mail"/></svg></div>
      </div>
      <div class="kdb-stat-val">{{ number_format($pesanBelumDibaca) }}</div>
      <div class="kdb-stat-sub">Dari form kontak</div>
    </div>

    <div class="kdb-stat">
      <div class="kdb-stat-head">
        <span class="kdb-stat-lbl">Guru &amp; Staf Aktif</span>
        <div class="kdb-stat-ico" style="background:var(--inf-50);color:var(--inf)"><svg width="17" height="17"><use href="#ki-teacher"/></svg></div>
      </div>
      <div class="kdb-stat-val">{{ number_format($totalGuru) }}</div>
      <div class="kdb-stat-sub">Tenaga pendidik</div>
    </div>

    <div class="kdb-stat">
      <div class="kdb-stat-head">
        <span class="kdb-stat-lbl">Ekstrakurikuler</span>
        <div class="kdb-stat-ico" style="background:var(--vio-50);color:var(--vio)"><svg width="17" height="17"><use href="#ki-star"/></svg></div>
      </div>
      <div class="kdb-stat-val">{{ number_format($totalEkskul) }}</div>
      <div class="kdb-stat-sub">Program aktif</div>
    </div>

    <div class="kdb-stat">
      <div class="kdb-stat-head">
        <span class="kdb-stat-lbl">Pengunjung Website</span>
        <div class="kdb-stat-ico" style="background:var(--acc-50);color:var(--acc)"><svg width="17" height="17"><use href="#ki-globe"/></svg></div>
      </div>
      <div class="kdb-stat-val">{{ number_format($pengunjungBulanIni) }}</div>
      <div class="kdb-stat-sub">Bulan {{ now()->locale('id')->translatedFormat('F Y') }}</div>
    </div>

  </div>

  {{-- ─── SECTION: Perpustakaan ─── --}}
  <div class="kdb-sec">
    <span style="color:var(--pri);">Statistik Perpustakaan</span>
    <div class="kdb-sec-line"></div>
  </div>

  <div class="kdb-stats" style="margin-bottom:20px;">

    <div class="kdb-stat">
      <div class="kdb-stat-head">
        <span class="kdb-stat-lbl">Total Koleksi Buku</span>
        <div class="kdb-stat-ico" style="background:var(--pri-50);color:var(--pri)"><svg width="17" height="17"><use href="#ki-book"/></svg></div>
      </div>
      <div class="kdb-stat-val">{{ number_format($totalBuku) }}</div>
      <div class="kdb-stat-sub">Koleksi aktif</div>
    </div>

    <div class="kdb-stat">
      <div class="kdb-stat-head">
        <span class="kdb-stat-lbl">Anggota Perpustakaan</span>
        <div class="kdb-stat-ico" style="background:var(--ok-50);color:var(--ok)"><svg width="17" height="17"><use href="#ki-users"/></svg></div>
      </div>
      <div class="kdb-stat-val">{{ number_format($totalAnggota) }}</div>
      <div class="kdb-stat-sub">Siswa &amp; guru aktif</div>
    </div>

    <div class="kdb-stat">
      <div class="kdb-stat-head">
        <span class="kdb-stat-lbl">Sedang Dipinjam</span>
        <div class="kdb-stat-ico" style="background:var(--warn-50);color:var(--warn)"><svg width="17" height="17"><use href="#ki-check"/></svg></div>
      </div>
      <div class="kdb-stat-val">{{ number_format($peminjamAktif) }}</div>
      <div class="kdb-stat-sub">Transaksi aktif</div>
    </div>

    <div class="kdb-stat">
      <div class="kdb-stat-head">
        <span class="kdb-stat-lbl">Denda Belum Lunas</span>
        <div class="kdb-stat-ico" style="background:var(--red-50);color:var(--red)"><svg width="17" height="17"><use href="#ki-money"/></svg></div>
      </div>
      <div class="kdb-stat-val">{{ number_format($dendaBelumLunas) }}<span style="font-size:16px;color:var(--t3);font-weight:500"> kasus</span></div>
      <div class="kdb-stat-sub" style="color:var(--red);font-weight:600;">Rp {{ number_format($totalDenda, 0, ',', '.') }}</div>
    </div>

    <div class="kdb-stat">
      <div class="kdb-stat-head">
        <span class="kdb-stat-lbl">Distribusi Buku Paket</span>
        <div class="kdb-stat-ico" style="background:var(--vio-50);color:var(--vio)"><svg width="17" height="17"><use href="#ki-pkg"/></svg></div>
      </div>
      <div class="kdb-stat-val">{{ number_format($bukuPaketAktif) }}</div>
      <div class="kdb-stat-sub">Distribusi aktif</div>
    </div>

    <div class="kdb-stat">
      <div class="kdb-stat-head">
        <span class="kdb-stat-lbl">Kunjungan Perpustakaan</span>
        <div class="kdb-stat-ico" style="background:var(--inf-50);color:var(--inf)"><svg width="17" height="17"><use href="#ki-foot"/></svg></div>
      </div>
      <div class="kdb-stat-val">{{ number_format($kunjunganBulanIni) }}</div>
      <div class="kdb-stat-sub">Bulan {{ now()->locale('id')->translatedFormat('F Y') }}</div>
    </div>

  </div>

  {{-- ─── Charts 2-col ─── --}}
  <div class="kdb-sec">
    <span style="color:var(--t3);">Tren 6 Bulan Terakhir</span>
    <div class="kdb-sec-line"></div>
  </div>

  <div class="kdb-g2" style="margin-bottom:20px;">

    {{-- Chart: Peminjaman per bulan --}}
    <div class="kdb-card">
      <div class="kdb-card-head">
        <div>
          <h3>Peminjaman Buku</h3>
          <div class="sub">6 bulan terakhir · total transaksi per bulan</div>
        </div>
        <div style="background:var(--pri-50);color:var(--pri);width:32px;height:32px;border-radius:8px;display:grid;place-items:center;flex-shrink:0;">
          <svg width="15" height="15"><use href="#ki-bar"/></svg>
        </div>
      </div>
      <div class="kdb-chart-wrap">
        <div class="kdb-chart">
          @foreach($peminjamanPerBulan as $m)
          <div class="kdb-chart-col">
            <div class="kdb-chart-val">{{ $m['total'] ?: '' }}</div>
            <div class="kdb-chart-bar-wrap">
              <div class="kdb-chart-bar" style="height:{{ $maxPeminjaman > 0 ? max(3, round($m['total'] / $maxPeminjaman * 100)) : 3 }}%;background:var(--pri);opacity:.75;"></div>
            </div>
            <div class="kdb-chart-lbl">{{ $m['short'] }}</div>
          </div>
          @endforeach
        </div>
        <div style="margin-top:10px;display:flex;justify-content:space-between;font-size:11px;color:var(--t3);">
          <span>{{ $peminjamanPerBulan[0]['label'] ?? '' }}</span>
          <span style="font-weight:600;color:var(--t1);">Total: {{ number_format(array_sum(array_column($peminjamanPerBulan, 'total'))) }}</span>
          <span>{{ end($peminjamanPerBulan)['label'] ?? '' }}</span>
        </div>
      </div>
    </div>

    {{-- Chart: Kunjungan per bulan --}}
    <div class="kdb-card">
      <div class="kdb-card-head">
        <div>
          <h3>Kunjungan Perpustakaan</h3>
          <div class="sub">6 bulan terakhir · total kunjungan per bulan</div>
        </div>
        <div style="background:var(--inf-50);color:var(--inf);width:32px;height:32px;border-radius:8px;display:grid;place-items:center;flex-shrink:0;">
          <svg width="15" height="15"><use href="#ki-foot"/></svg>
        </div>
      </div>
      <div class="kdb-chart-wrap">
        <div class="kdb-chart">
          @foreach($kunjunganPerBulan as $m)
          <div class="kdb-chart-col">
            <div class="kdb-chart-val">{{ $m['total'] ?: '' }}</div>
            <div class="kdb-chart-bar-wrap">
              <div class="kdb-chart-bar" style="height:{{ $maxKunjunganBulan > 0 ? max(3, round($m['total'] / $maxKunjunganBulan * 100)) : 3 }}%;background:var(--inf);opacity:.75;"></div>
            </div>
            <div class="kdb-chart-lbl">{{ $m['short'] }}</div>
          </div>
          @endforeach
        </div>
        <div style="margin-top:10px;display:flex;justify-content:space-between;font-size:11px;color:var(--t3);">
          <span>{{ $kunjunganPerBulan[0]['label'] ?? '' }}</span>
          <span style="font-weight:600;color:var(--t1);">Total: {{ number_format(array_sum(array_column($kunjunganPerBulan, 'total'))) }}</span>
          <span>{{ end($kunjunganPerBulan)['label'] ?? '' }}</span>
        </div>
      </div>
    </div>

  </div>

  {{-- ─── Summary 2-col ─── --}}
  <div class="kdb-sec">
    <span style="color:var(--t3);">Ringkasan Terkini</span>
    <div class="kdb-sec-line"></div>
  </div>

  <div class="kdb-g2b" style="margin-bottom:20px;">

    {{-- Peminjaman aktif --}}
    <div class="kdb-card" style="display:flex;flex-direction:column;">
      <div class="kdb-card-head">
        <div>
          <h3>Peminjaman Aktif</h3>
          <div class="sub">{{ $peminjamAktif }} transaksi, diurutkan batas kembali terdekat</div>
        </div>
        <a href="{{ \App\Filament\Resources\LibraryReports\LibraryReportResource::getUrl('index') }}" class="lnk">Laporan →</a>
      </div>
      <div class="kdb-card-body" style="flex:1;">
        @forelse($recentLoans as $loan)
          @php $isLate = $loan->status === 'terlambat'; @endphp
          @if(!$loop->first)<div class="kdb-div"></div>@endif
          <div class="kdb-row">
            <div class="kdb-row-av" style="{{ $isLate ? 'background:var(--red-50);color:var(--red)' : 'background:var(--warn-50);color:#b45309' }}">
              {{ strtoupper(substr($loan->member?->nama ?? '?', 0, 2)) }}
            </div>
            <div style="min-width:0;">
              <div class="kdb-row-title">{{ \Illuminate\Support\Str::limit($loan->book?->judul, 40) }}</div>
              <div class="kdb-row-sub">{{ $loan->member?->nama }} &middot; Batas: {{ $loan->tgl_batas_kembali?->format('d M Y') }}</div>
            </div>
            <div>
              @if($isLate)
                <span class="kdb-row-badge" style="background:var(--red-50);color:var(--red);">+{{ $loan->jumlahHariTerlambat() }}h</span>
              @else
                <span class="kdb-row-badge" style="background:var(--warn-50);color:#b45309;">Aktif</span>
              @endif
            </div>
          </div>
        @empty
          <div class="kdb-empty">Tidak ada peminjaman aktif.</div>
        @endforelse
      </div>
      @if($dendaBelumLunas > 0)
      <div class="kdb-fine-foot">
        <span>{{ $dendaBelumLunas }} denda belum lunas</span>
        <span>Rp {{ number_format($totalDenda, 0, ',', '.') }}</span>
      </div>
      @endif
    </div>

    {{-- Berita terbaru --}}
    <div class="kdb-card">
      <div class="kdb-card-head">
        <div>
          <h3>Berita Terbaru</h3>
          <div class="sub">Artikel terpublikasi terakhir</div>
        </div>
        <a href="{{ \App\Filament\Admin\Pages\StatistikWebsite::getUrl() }}" class="lnk">Statistik →</a>
      </div>
      <div class="kdb-card-body">
        @forelse($recentPosts as $post)
          @if(!$loop->first)<div class="kdb-div"></div>@endif
          <div class="kdb-post">
            <div class="kdb-post-dot" style="background:var(--teal);margin-top:6px;"></div>
            <div style="min-width:0;">
              <div class="kdb-post-title">{{ $post->judul }}</div>
              <div class="kdb-post-date">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                {{ $post->tanggal_publish ? \Carbon\Carbon::parse($post->tanggal_publish)->locale('id')->translatedFormat('d M Y') : '-' }}
                &middot; {{ ucfirst($post->kategori ?? 'Berita') }}
              </div>
            </div>
          </div>
        @empty
          <div class="kdb-empty">Belum ada berita terpublikasi.</div>
        @endforelse
      </div>
    </div>

  </div>

  {{-- ─── Quick Access ─── --}}
  <div class="kdb-sec">
    <span style="color:var(--t3);">Akses Cepat</span>
    <div class="kdb-sec-line"></div>
  </div>

  <div class="kdb-links">

    <a href="{{ \App\Filament\Resources\LibraryReports\LibraryReportResource::getUrl('index') }}" class="kdb-link">
      <div class="kdb-link-ico" style="background:var(--pri-50);color:var(--pri)"><svg width="18" height="18"><use href="#ki-report"/></svg></div>
      <div>
        <b>Laporan Perpustakaan</b>
        <span>Cetak PDF &amp; Excel rekap perpustakaan</span>
      </div>
    </a>

    <a href="{{ \App\Filament\Admin\Pages\StatistikWebsite::getUrl() }}" class="kdb-link">
      <div class="kdb-link-ico" style="background:var(--teal-50);color:var(--teal)"><svg width="18" height="18"><use href="#ki-bar"/></svg></div>
      <div>
        <b>Statistik Website</b>
        <span>Berita, guru, galeri, pesan, pengunjung</span>
      </div>
    </a>

    <a href="/admin/laporan-perpustakaan/pdf" target="_blank" class="kdb-link">
      <div class="kdb-link-ico" style="background:var(--red-50);color:var(--red)"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M9 13h6M9 17h4"/></svg></div>
      <div>
        <b>Unduh Laporan PDF</b>
        <span>Download rekap perpustakaan bulan ini</span>
      </div>
    </a>

  </div>

</div>
</div>{{-- /livewire root --}}
