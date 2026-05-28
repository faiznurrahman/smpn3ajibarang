<div>
@php
    use App\Enums\UserRole;
    $tanggal   = now()->locale('id')->translatedFormat('l, d F Y');
    $role      = auth()->user()?->role;
    $isPetugas = $role === UserRole::PetugasPerpustakaan;
@endphp

<style>
.db {
  --pri:#1e3a8a; --pri-2:#2746a4; --pri-50:#eef2ff; --pri-100:#dbe3ff;
  --acc:#ef7c2a; --acc-2:#d96815; --acc-50:#fff4ea;
  --ok:#16a34a;  --ok-50:#e6f7ed;
  --inf:#2563eb; --inf-50:#e8efff;
  --vio:#7c3aed; --vio-50:#f1ebff;
  --warn:#f59e0b; --warn-50:#fffbeb;
  --red:#dc2626;  --red-50:#fee2e2;
  --line:#e6eaf2; --line-2:#d4dae6;
  --t1:#0f172a; --t2:#5a6478; --t3:#8b94a6;
  --panel:#fff; --bg:#f3f5fa;
  --r:14px; --sh-sm:0 1px 2px rgba(15,23,42,.04);
}
/* Page head */
.db-head { display:flex; align-items:flex-end; justify-content:space-between; gap:20px; margin-bottom:22px; }
.db-head h1 { font-size:28px; font-weight:700; margin:0 0 4px; letter-spacing:-.015em; color:var(--t1); }
.db-head p  { margin:0; color:var(--t2); font-size:14px; }
.db-btn {
  height:38px; padding:0 16px; border-radius:10px; border:1px solid var(--line);
  background:white; color:var(--t1); font:inherit; font-size:13px; font-weight:500;
  cursor:pointer; display:inline-flex; align-items:center; gap:8px; text-decoration:none;
  transition:background 100ms, border-color 100ms;
}
.db-btn:hover { border-color:var(--line-2); background:#f5f7fc; }
.db-btn.pri  { background:var(--pri); color:white; border-color:transparent; font-weight:600; box-shadow:0 1px 2px rgba(30,58,138,.2); }
.db-btn.pri:hover { background:var(--pri-2); }
/* Stats */
.db-stats { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:22px; }
.db-stat  { background:var(--panel); border:1px solid var(--line); border-radius:var(--r); padding:18px 18px 16px; position:relative; overflow:hidden; box-shadow:var(--sh-sm); }
.db-stat-head { display:flex; align-items:center; justify-content:space-between; }
.db-stat-lbl  { font-size:12px; color:var(--t3); letter-spacing:.06em; text-transform:uppercase; font-weight:700; }
.db-stat-ico  { width:36px; height:36px; border-radius:10px; display:grid; place-items:center; }
.db-stat-val  { font-size:32px; font-weight:700; letter-spacing:-.02em; margin:14px 0 4px; color:var(--t1); }
.db-stat-sub  { font-size:12px; color:var(--t2); display:flex; align-items:center; gap:5px; }
.db-stat-spark { position:absolute; right:-10px; bottom:-2px; opacity:.7; pointer-events:none; }
/* 2-col */
.db-g2 { display:grid; grid-template-columns:1.55fr 1fr; gap:16px; margin-bottom:16px; }
/* 3-col */
.db-g3 { display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px; }
/* Card */
.db-card { background:var(--panel); border:1px solid var(--line); border-radius:var(--r); box-shadow:var(--sh-sm); }
.db-card-head { padding:18px 20px 14px; display:flex; align-items:flex-start; justify-content:space-between; border-bottom:1px solid var(--line); }
.db-card-head h3 { margin:0; font-size:15px; font-weight:700; color:var(--t1); letter-spacing:-.005em; }
.db-card-head .sub { font-size:12px; color:var(--t3); margin-top:3px; }
.db-card-head .lnk { color:var(--pri); font-size:12px; text-decoration:none; font-weight:600; white-space:nowrap; margin-top:2px; }
.db-card-head .lnk:hover { color:var(--pri-2); }
.db-card-body { padding:8px 8px 12px; }
/* Messages — used for active loans */
.db-msg { display:grid; grid-template-columns:38px 1fr auto; gap:14px; padding:12px 14px; border-radius:10px; color:inherit; }
.db-msg-av { width:38px; height:38px; border-radius:10px; display:grid; place-items:center; font-weight:600; font-size:13px; }
.db-msg-top { display:flex; align-items:center; gap:8px; flex-wrap:wrap; }
.db-msg-top b { font-size:13.5px; font-weight:600; color:var(--t1); }
.db-tag { font-size:10.5px; padding:2px 7px; border-radius:999px; font-weight:600; background:#f1f3f8; color:var(--t2); }
.db-tag.late { background:var(--red-50); color:var(--red); }
.db-tag.due  { background:var(--warn-50); color:#b45309; }
.db-msg-snip { color:var(--t2); font-size:12.5px; margin-top:3px; line-height:1.45; overflow:hidden; text-overflow:ellipsis; display:-webkit-box; -webkit-line-clamp:1; -webkit-box-orient:vertical; }
.db-msg-time { color:var(--t3); font-size:11.5px; white-space:nowrap; font-weight:500; }
/* Activity — used for fines */
.db-act { display:grid; grid-template-columns:32px 1fr auto; gap:12px; padding:10px 14px; align-items:flex-start; }
.db-act-dot { width:32px; height:32px; border-radius:9px; display:grid; place-items:center; flex:0 0 32px; }
.db-act-body p { margin:0; font-size:13px; color:var(--t1); }
.db-act-body p b { font-weight:600; }
.db-act-body span { color:var(--t3); font-size:11.5px; }
.db-act-time { color:var(--t3); font-size:11.5px; white-space:nowrap; padding-top:2px; font-weight:500; }
/* Posts — used for late loans */
.db-post { display:grid; grid-template-columns:48px 1fr; gap:12px; padding:12px 14px; border-radius:10px; align-items:center; }
.db-post:hover { background:#f5f7fc; }
.db-post-thumb { width:48px; height:48px; border-radius:8px; display:grid; place-items:center; font-size:12px; font-weight:800; color:white; letter-spacing:.02em; }
.db-post-thumb.r1 { background:linear-gradient(135deg,#dc2626,#f87171); }
.db-post-thumb.r2 { background:linear-gradient(135deg,#c2410c,#ef7c2a); }
.db-post-thumb.r3 { background:linear-gradient(135deg,#b45309,#f59e0b); }
.db-post-thumb.r4 { background:linear-gradient(135deg,#991b1b,#dc2626); }
.db-post-body b { font-size:13.5px; font-weight:600; display:block; color:var(--t1); overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
.db-post-meta { color:var(--t3); font-size:11.5px; display:flex; gap:8px; margin-top:4px; flex-wrap:wrap; }
.db-post-meta b { font-weight:600; color:var(--red); display:inline; }
/* Agenda — used for visit stats */
.db-agenda { display:grid; grid-template-columns:54px 1fr; gap:14px; padding:12px 14px; align-items:center; border-radius:10px; }
.db-agenda-date { width:54px; height:54px; border-radius:10px; background:var(--bg); border:1px solid var(--line); display:flex; flex-direction:column; align-items:center; justify-content:center; line-height:1; flex:0 0 54px; }
.db-agenda-date b { font-size:20px; font-weight:700; color:var(--t1); }
.db-agenda-date span { font-size:9px; color:var(--t3); margin-top:3px; text-transform:uppercase; letter-spacing:.08em; font-weight:700; }
.db-agenda-date.today { background:var(--inf-50); border-color:transparent; }
.db-agenda-date.today b, .db-agenda-date.today span { color:var(--inf); }
.db-agenda-date.week  { background:var(--ok-50); border-color:transparent; }
.db-agenda-date.week b, .db-agenda-date.week span   { color:var(--ok); }
.db-agenda-date.month { background:var(--vio-50); border-color:transparent; }
.db-agenda-date.month b, .db-agenda-date.month span { color:var(--vio); }
.db-agenda-body b { font-size:13.5px; font-weight:600; display:block; color:var(--t1); }
.db-agenda-body span { font-size:11.5px; color:var(--t3); display:flex; align-items:center; gap:6px; margin-top:4px; }
/* Quick actions */
.db-qa-grid { display:grid; grid-template-columns:1fr 1fr; gap:10px; padding:12px; }
.db-qa { border:1px solid var(--line); border-radius:11px; padding:14px; display:flex; flex-direction:column; gap:10px; cursor:pointer; background:white; text-decoration:none; transition:border-color 110ms, background 110ms; }
.db-qa:hover { border-color:var(--pri-100); background:var(--pri-50); }
.db-qa-ico { width:34px; height:34px; border-radius:9px; display:grid; place-items:center; }
.db-qa b   { font-size:13px; font-weight:600; color:var(--t1); }
.db-qa span { font-size:11.5px; color:var(--t3); line-height:1.4; }
/* Grafik kunjungan 7 hari */
.db-chart-wrap { padding:16px 18px 12px; }
.db-chart { display:flex; gap:6px; height:90px; align-items:flex-end; }
.db-chart-col { flex:1; display:flex; flex-direction:column; align-items:center; gap:3px; height:100%; }
.db-chart-val { font-size:9px; color:var(--t3); line-height:1; }
.db-chart-bar-wrap { flex:1; width:100%; display:flex; align-items:flex-end; }
.db-chart-bar { width:100%; background:var(--pri); border-radius:3px 3px 0 0; opacity:.75; transition:opacity 100ms; min-height:3px; }
.db-chart-bar:hover { opacity:1; }
.db-chart-lbl { font-size:9px; color:var(--t3); white-space:nowrap; line-height:1; }
/* Divider */
.db-div { height:1px; background:var(--line); margin:4px 14px; }
/* Empty */
.db-empty { padding:28px; text-align:center; color:var(--t3); font-size:13px; }
/* Denda footer */
.db-fine-foot { display:flex; align-items:center; justify-content:space-between; padding:10px 18px; background:var(--red-50); border-top:1px solid #fecaca; border-radius:0 0 var(--r) var(--r); font-size:12.5px; color:var(--red); font-weight:600; }
@media (max-width:1200px) {
  .db-stats { grid-template-columns:repeat(2,1fr); }
  .db-g2, .db-g3 { grid-template-columns:1fr; }
}
</style>

<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <defs>
    <symbol id="dbi-book"   viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></symbol>
    <symbol id="dbi-user"   viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></symbol>
    <symbol id="dbi-check"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 17H5a2 2 0 01-2-2V5a2 2 0 012-2h11a2 2 0 012 2v5"/><polyline points="9 11 12 14 22 4"/></symbol>
    <symbol id="dbi-money"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></symbol>
    <symbol id="dbi-pkg"    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/><line x1="12" y1="8" x2="12" y2="12"/><polyline points="8 12 12 16 16 12"/></symbol>
    <symbol id="dbi-visit"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></symbol>
    <symbol id="dbi-plus"   viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></symbol>
    <symbol id="dbi-return" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 102.13-9.36L1 10"/></symbol>
    <symbol id="dbi-clock"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></symbol>
    <symbol id="dbi-report" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></symbol>
    <symbol id="dbi-warn"   viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></symbol>
  </defs>
</svg>

<div class="db fi-page-content" style="padding:28px 28px 60px;">

  {{-- Page head --}}
  <div class="db-head">
    <div>
      <h1>Dashboard Perpustakaan</h1>
      <p>
        Ringkasan aktivitas perpustakaan &middot; {{ $tanggal }}
        &nbsp;&middot;&nbsp;
        <span style="color:var(--pri);font-weight:600;">{{ $isPetugas ? 'Petugas Perpustakaan' : 'Kepala Sekolah' }}</span>
      </p>
    </div>
    @if($isPetugas)
    <div style="display:flex;gap:10px;">
      <a href="{{ \App\Filament\Resources\Loans\LoanResource::getUrl('create') }}" class="db-btn pri">
        <svg width="16" height="16"><use href="#dbi-plus"/></svg>Catat Peminjaman
      </a>
    </div>
    @endif
  </div>

  {{-- Stats --}}
  <div class="db-stats">

    <div class="db-stat">
      <div class="db-stat-head">
        <span class="db-stat-lbl">Total Koleksi Buku</span>
        <div class="db-stat-ico" style="background:var(--pri-50);color:var(--pri)"><svg width="18" height="18"><use href="#dbi-book"/></svg></div>
      </div>
      <div class="db-stat-val">{{ number_format($totalBuku) }}</div>
      <div class="db-stat-sub" style="color:var(--t3)">Koleksi aktif tersedia</div>
      <svg class="db-stat-spark" width="120" height="40" viewBox="0 0 120 40" fill="none">
        <path d="M0 30 L15 26 L30 28 L45 22 L60 24 L75 18 L90 20 L105 14 L120 12" stroke="#1e3a8a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>

    <div class="db-stat">
      <div class="db-stat-head">
        <span class="db-stat-lbl">Anggota Perpustakaan</span>
        <div class="db-stat-ico" style="background:var(--ok-50);color:var(--ok)"><svg width="18" height="18"><use href="#dbi-user"/></svg></div>
      </div>
      <div class="db-stat-val">{{ number_format($totalAnggota) }}</div>
      <div class="db-stat-sub" style="color:var(--t3)">Siswa &amp; guru aktif</div>
      <svg class="db-stat-spark" width="120" height="40" viewBox="0 0 120 40" fill="none">
        <path d="M0 30 L10 28 L20 26 L30 24 L40 22 L50 22 L60 20 L70 18 L80 16 L90 16 L100 12 L110 10 L120 8" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>

    <div class="db-stat">
      <div class="db-stat-head">
        <span class="db-stat-lbl">Sedang Dipinjam</span>
        <div class="db-stat-ico" style="background:var(--warn-50);color:var(--warn)"><svg width="18" height="18"><use href="#dbi-check"/></svg></div>
      </div>
      <div class="db-stat-val">{{ number_format($peminjamAktif) }}</div>
      <div class="db-stat-sub" style="color:var(--t3)">Transaksi aktif</div>
      <svg class="db-stat-spark" width="120" height="40" viewBox="0 0 120 40" fill="none">
        <path d="M0 28 L10 24 L20 26 L30 18 L40 22 L50 14 L60 18 L70 10 L80 14 L90 8 L100 12 L110 6 L120 4" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>

    <div class="db-stat">
      <div class="db-stat-head">
        <span class="db-stat-lbl">Denda Belum Lunas</span>
        <div class="db-stat-ico" style="background:var(--red-50);color:var(--red)"><svg width="18" height="18"><use href="#dbi-money"/></svg></div>
      </div>
      <div class="db-stat-val">{{ number_format($dendaBelumLunas) }}<span style="font-size:18px;color:var(--t3);font-weight:500"> kasus</span></div>
      <div class="db-stat-sub" style="color:var(--red);font-weight:600;">Rp {{ number_format($totalDenda, 0, ',', '.') }}</div>
      <svg class="db-stat-spark" width="120" height="40" viewBox="0 0 120 40" fill="none">
        <rect x="6"  y="22" width="6" height="14" rx="1" fill="#dc2626" opacity=".35"/>
        <rect x="22" y="18" width="6" height="18" rx="1" fill="#dc2626" opacity=".45"/>
        <rect x="38" y="24" width="6" height="12" rx="1" fill="#dc2626" opacity=".35"/>
        <rect x="54" y="14" width="6" height="22" rx="1" fill="#dc2626" opacity=".55"/>
        <rect x="70" y="20" width="6" height="16" rx="1" fill="#dc2626" opacity=".45"/>
        <rect x="86" y="10" width="6" height="26" rx="1" fill="#dc2626" opacity=".75"/>
        <rect x="102" y="6"  width="6" height="30" rx="1" fill="#dc2626"/>
      </svg>
    </div>

    <div class="db-stat">
      <div class="db-stat-head">
        <span class="db-stat-lbl">Distribusi Buku Paket</span>
        <div class="db-stat-ico" style="background:var(--vio-50);color:var(--vio)"><svg width="18" height="18"><use href="#dbi-pkg"/></svg></div>
      </div>
      <div class="db-stat-val">{{ number_format($bukuPaketAktif) }}</div>
      <div class="db-stat-sub" style="color:var(--t3)">Distribusi aktif tahun ini</div>
      <svg class="db-stat-spark" width="120" height="40" viewBox="0 0 120 40" fill="none">
        <path d="M0 30 L15 26 L30 22 L45 24 L60 18 L75 16 L90 12 L105 10 L120 8" stroke="#7c3aed" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>

    <div class="db-stat">
      <div class="db-stat-head">
        <span class="db-stat-lbl">Kunjungan Hari Ini</span>
        <div class="db-stat-ico" style="background:var(--inf-50);color:var(--inf)"><svg width="18" height="18"><use href="#dbi-visit"/></svg></div>
      </div>
      <div class="db-stat-val">{{ number_format($kunjunganHariIni) }}</div>
      <div class="db-stat-sub" style="color:var(--t3)">
        <svg width="12" height="12"><use href="#dbi-clock"/></svg>
        {{ $kunjunganMingguIni }} minggu ini
      </div>
      <svg class="db-stat-spark" width="120" height="40" viewBox="0 0 120 40" fill="none">
        <path d="M0 28 L10 24 L20 28 L30 20 L40 22 L50 16 L60 20 L70 12 L80 16 L90 10 L100 14 L110 8 L120 6" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>

  </div>

  {{-- 2-col: Peminjaman aktif + Denda belum lunas --}}
  <div class="db-g2">

    {{-- Peminjaman aktif --}}
    <div class="db-card">
      <div class="db-card-head">
        <div>
          <h3>Peminjaman aktif</h3>
          <div class="sub">{{ $peminjamAktif }} transaksi, diurutkan batas kembali terdekat</div>
        </div>
        @if($isPetugas)
        <a href="{{ \App\Filament\Resources\Returns\ReturnResource::getUrl('index') }}" class="lnk">Proses kembali →</a>
        @endif
      </div>
      <div class="db-card-body">
        @forelse($recentLoans as $loan)
          @php $isLate = $loan->status === 'terlambat'; @endphp
          @if(!$loop->first)<div class="db-div"></div>@endif
          <div class="db-msg">
            <div class="db-msg-av" style="{{ $isLate ? 'background:var(--red-50);color:var(--red)' : 'background:var(--warn-50);color:#b45309' }}">
              {{ strtoupper(substr($loan->member?->nama ?? '?', 0, 2)) }}
            </div>
            <div>
              <div class="db-msg-top">
                <b>{{ \Illuminate\Support\Str::limit($loan->book?->judul, 35) }}</b>
                @if($isLate)<span class="db-tag late">Terlambat</span>@else<span class="db-tag due">Aktif</span>@endif
              </div>
              <div class="db-msg-snip">{{ $loan->member?->nama }} &middot; Batas: {{ $loan->tgl_batas_kembali?->format('d M Y') }}</div>
            </div>
            <div class="db-msg-time">
              @if($isLate)+{{ $loan->jumlahHariTerlambat() }}h@else{{ $loan->tgl_batas_kembali?->diffForHumans() }}@endif
            </div>
          </div>
        @empty
          <div class="db-empty">Tidak ada peminjaman aktif.</div>
        @endforelse
      </div>
    </div>

    {{-- Denda belum lunas --}}
    <div class="db-card" style="display:flex;flex-direction:column;">
      <div class="db-card-head">
        <div>
          <h3>Denda belum lunas</h3>
          <div class="sub">{{ $dendaBelumLunas }} denda menunggu pembayaran</div>
        </div>
        @if($isPetugas)
        <a href="{{ \App\Filament\Resources\Fines\FineResource::getUrl('index') }}" class="lnk">Semua →</a>
        @endif
      </div>
      <div class="db-card-body" style="flex:1;">
        @forelse($recentFines as $fine)
          @if(!$loop->first)<div class="db-div"></div>@endif
          <div class="db-act">
            <div class="db-act-dot" style="background:var(--red-50);color:var(--red)">
              <svg width="15" height="15"><use href="#dbi-money"/></svg>
            </div>
            <div class="db-act-body">
              <p><b>{{ $fine->loan?->member?->nama }}</b></p>
              <span>{{ $fine->jumlah_hari }} hari &middot; Rp {{ number_format($fine->nominal, 0, ',', '.') }}</span>
            </div>
            <div class="db-act-time">{{ $fine->created_at?->diffForHumans(short: true) }}</div>
          </div>
        @empty
          <div class="db-empty">Tidak ada denda.</div>
        @endforelse
      </div>
      @if($dendaBelumLunas > 0)
      <div class="db-fine-foot">
        <span>Total belum lunas</span>
        <span>Rp {{ number_format($totalDenda, 0, ',', '.') }}</span>
      </div>
      @endif
    </div>

  </div>

  {{-- Grafik Kunjungan 7 Hari Terakhir --}}
  <div class="db-card" style="margin-bottom:16px;">
    <div class="db-card-head">
      <div>
        <h3>Grafik Kunjungan 7 Hari Terakhir</h3>
        <div class="sub">{{ now()->subDays(6)->locale('id')->translatedFormat('d M') }} – {{ now()->locale('id')->translatedFormat('d M Y') }}</div>
      </div>
      @if($isPetugas)
      <a href="{{ \App\Filament\Resources\Visits\VisitResource::getUrl('index') }}" class="lnk">Data kunjungan →</a>
      @endif
    </div>
    <div class="db-chart-wrap">
      <div class="db-chart">
        @foreach($kunjungan7Hari as $day)
        <div class="db-chart-col">
          <div class="db-chart-val">{{ $day['total'] ?: '' }}</div>
          <div class="db-chart-bar-wrap">
            <div class="db-chart-bar" style="height:{{ $maxKunjungan7Hari > 0 ? round($day['total'] / $maxKunjungan7Hari * 100) : 0 }}%"></div>
          </div>
          <div class="db-chart-lbl">{{ $day['label'] }}</div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  {{-- 3-col: Terlambat + Statistik Kunjungan + Aksi Cepat --}}
  <div class="db-g3">

    {{-- Peminjaman terlambat --}}
    <div class="db-card">
      <div class="db-card-head">
        <div>
          <h3>Peminjaman terlambat</h3>
          <div class="sub">Perlu segera dikembalikan</div>
        </div>
      </div>
      <div class="db-card-body">
        @php
          $lateLoans = $recentLoans->where('status', 'terlambat');
          $rGrads    = ['r1','r2','r3','r4'];
        @endphp
        @forelse($lateLoans as $loan)
          @if(!$loop->first)<div class="db-div"></div>@endif
          <div class="db-post">
            <div class="db-post-thumb {{ $rGrads[$loop->index % 4] }}">
              {{ strtoupper(substr($loan->member?->nama ?? '?', 0, 2)) }}
            </div>
            <div class="db-post-body">
              <b>{{ \Illuminate\Support\Str::limit($loan->book?->judul, 28) }}</b>
              <div class="db-post-meta">
                <span>{{ \Illuminate\Support\Str::limit($loan->member?->nama, 18) }}</span>
                <span><b>+{{ $loan->jumlahHariTerlambat() }} hari</b></span>
              </div>
            </div>
          </div>
        @empty
          <div class="db-empty">Tidak ada peminjaman terlambat.</div>
        @endforelse
      </div>
    </div>

    {{-- Statistik kunjungan --}}
    <div class="db-card">
      <div class="db-card-head">
        <div>
          <h3>Statistik kunjungan</h3>
          <div class="sub">Rekap pengunjung perpustakaan</div>
        </div>
        @if($isPetugas)
        <a href="{{ \App\Filament\Resources\Visits\VisitResource::getUrl('index') }}" class="lnk">Semua →</a>
        @endif
      </div>
      <div class="db-card-body">
        <div class="db-agenda">
          <div class="db-agenda-date today">
            <b>{{ $kunjunganHariIni }}</b>
            <span>Hari Ini</span>
          </div>
          <div class="db-agenda-body">
            <b>Kunjungan Hari Ini</b>
            <span>
              <svg width="12" height="12"><use href="#dbi-visit"/></svg>
              {{ now()->translatedFormat('d F Y') }}
            </span>
          </div>
        </div>
        <div class="db-div"></div>
        <div class="db-agenda">
          <div class="db-agenda-date week">
            <b>{{ $kunjunganMingguIni }}</b>
            <span>Minggu</span>
          </div>
          <div class="db-agenda-body">
            <b>Kunjungan Minggu Ini</b>
            <span>
              <svg width="12" height="12"><use href="#dbi-clock"/></svg>
              {{ now()->startOfWeek()->translatedFormat('d') }}–{{ now()->endOfWeek()->translatedFormat('d M') }}
            </span>
          </div>
        </div>
        <div class="db-div"></div>
        <div class="db-agenda">
          <div class="db-agenda-date month">
            <b>{{ $kunjunganBulanIni }}</b>
            <span>Bulan</span>
          </div>
          <div class="db-agenda-body">
            <b>Kunjungan Bulan Ini</b>
            <span>
              <svg width="12" height="12"><use href="#dbi-clock"/></svg>
              {{ now()->translatedFormat('F Y') }}
            </span>
          </div>
        </div>
      </div>
    </div>

    {{-- Aksi cepat / Ringkasan --}}
    <div class="db-card">
      <div class="db-card-head">
        <div>
          <h3>{{ $isPetugas ? 'Aksi cepat' : 'Ringkasan data' }}</h3>
          <div class="sub">{{ $isPetugas ? 'Pintasan tugas harian' : 'Statistik perpustakaan' }}</div>
        </div>
      </div>

      @if($isPetugas)
      <div class="db-qa-grid">
        <a href="{{ \App\Filament\Resources\Loans\LoanResource::getUrl('create') }}" class="db-qa">
          <div class="db-qa-ico" style="background:var(--warn-50);color:var(--warn)"><svg width="16" height="16"><use href="#dbi-check"/></svg></div>
          <b>Catat Peminjaman</b>
          <span>Transaksi pinjam buku</span>
        </a>
        <a href="{{ \App\Filament\Resources\Returns\ReturnResource::getUrl('index') }}" class="db-qa">
          <div class="db-qa-ico" style="background:var(--ok-50);color:var(--ok)"><svg width="16" height="16"><use href="#dbi-return"/></svg></div>
          <b>Pengembalian</b>
          <span>Proses buku kembali</span>
        </a>
        <a href="{{ \App\Filament\Resources\Books\BookResource::getUrl('create') }}" class="db-qa">
          <div class="db-qa-ico" style="background:var(--pri-50);color:var(--pri)"><svg width="16" height="16"><use href="#dbi-book"/></svg></div>
          <b>Tambah Buku</b>
          <span>Daftarkan koleksi baru</span>
        </a>
        <a href="{{ \App\Filament\Resources\LibraryReports\LibraryReportResource::getUrl('index') }}" class="db-qa">
          <div class="db-qa-ico" style="background:var(--vio-50);color:var(--vio)"><svg width="16" height="16"><use href="#dbi-report"/></svg></div>
          <b>Laporan</b>
          <span>Cetak laporan perpustakaan</span>
        </a>
      </div>

      @else
      {{-- Kepala Sekolah: progress bar ringkasan --}}
      <div style="padding:16px 20px;display:flex;flex-direction:column;gap:16px;">
        @php
          $summaries = [
            ['label' => 'Total Koleksi Buku',   'val' => $totalBuku,       'color' => 'var(--pri)'],
            ['label' => 'Anggota Aktif',         'val' => $totalAnggota,    'color' => 'var(--ok)'],
            ['label' => 'Peminjaman Aktif',       'val' => $peminjamAktif,   'color' => 'var(--warn)'],
            ['label' => 'Denda Belum Lunas',      'val' => $dendaBelumLunas, 'color' => 'var(--red)'],
          ];
          $maxVal = max(array_column($summaries, 'val') ?: [1]);
        @endphp
        @foreach($summaries as $s)
        <div>
          <div style="display:flex;justify-content:space-between;margin-bottom:5px;">
            <span style="font-size:12px;color:var(--t2);font-weight:500;">{{ $s['label'] }}</span>
            <span style="font-size:13px;font-weight:700;color:var(--t1);">{{ number_format($s['val']) }}</span>
          </div>
          <div style="height:5px;background:#f1f3f8;border-radius:999px;overflow:hidden;">
            <div style="height:100%;width:{{ $maxVal > 0 ? min(100, round($s['val'] / $maxVal * 100)) : 0 }}%;background:{{ $s['color'] }};border-radius:999px;transition:width .6s;"></div>
          </div>
        </div>
        @endforeach
      </div>
      @endif

    </div>

  </div>

</div>
</div>{{-- /livewire root --}}
