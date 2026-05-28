<div>
@php
    use Illuminate\Support\Str;
    $tanggal    = now()->locale('id')->translatedFormat('l, d F Y');
    $typeLabels = ['berita' => 'Berita', 'pengumuman' => 'Pengumuman', 'prestasi' => 'Prestasi'];
    $actColors  = [
        'orange' => ['bg' => '#fff4ea', 'fg' => '#d96815'],
        'green'  => ['bg' => '#e6f7ed', 'fg' => '#16a34a'],
        'blue'   => ['bg' => '#e8efff', 'fg' => '#2563eb'],
        'slate'  => ['bg' => '#eef1f6', 'fg' => '#5a6478'],
    ];
@endphp

<style>
.db {
  --pri:#1e3a8a; --pri-2:#2746a4; --pri-50:#eef2ff; --pri-100:#dbe3ff;
  --acc:#ef7c2a; --acc-2:#d96815; --acc-50:#fff4ea;
  --ok:#16a34a;  --ok-50:#e6f7ed;
  --inf:#2563eb; --inf-50:#e8efff;
  --vio:#7c3aed; --vio-50:#f1ebff;
  --warn:#f59e0b; --warn-50:#fffbeb;
  --red:#dc2626;
  --line:#e6eaf2; --line-2:#d4dae6;
  --t1:#0f172a; --t2:#5a6478; --t3:#8b94a6;
  --panel:#fff; --bg:#f3f5fa;
  --r:14px; --sh-sm:0 1px 2px rgba(15,23,42,.04);
}
.db-head { display:flex; align-items:flex-end; justify-content:space-between; gap:20px; margin-bottom:24px; }
.db-head h1 { font-size:26px; font-weight:700; margin:0 0 4px; letter-spacing:-.015em; color:var(--t1); }
.db-head p  { margin:0; color:var(--t2); font-size:13.5px; }
.db-btn {
  height:38px; padding:0 16px; border-radius:10px; border:1px solid var(--line);
  background:white; color:var(--t1); font:inherit; font-size:13px; font-weight:500;
  cursor:pointer; display:inline-flex; align-items:center; gap:8px; text-decoration:none;
  transition:background 100ms, border-color 100ms;
}
.db-btn:hover { border-color:var(--line-2); background:#f5f7fc; }
.db-btn.pri  { background:var(--pri); color:white; border-color:transparent; font-weight:600; box-shadow:0 1px 3px rgba(30,58,138,.2); }
.db-btn.pri:hover { background:var(--pri-2); }
/* Stats */
.db-stats { display:grid; grid-template-columns:repeat(4,1fr); gap:14px; margin-bottom:20px; }
.db-stat  { background:var(--panel); border:1px solid var(--line); border-radius:var(--r); padding:18px 18px 16px; position:relative; overflow:hidden; box-shadow:var(--sh-sm); }
.db-stat-head { display:flex; align-items:center; justify-content:space-between; }
.db-stat-lbl  { font-size:11px; color:var(--t3); letter-spacing:.07em; text-transform:uppercase; font-weight:700; }
.db-stat-ico  { width:36px; height:36px; border-radius:10px; display:grid; place-items:center; flex:0 0 36px; }
.db-stat-val  { font-size:30px; font-weight:700; letter-spacing:-.02em; margin:12px 0 4px; color:var(--t1); }
.db-stat-sub  { font-size:12px; color:var(--t2); display:flex; align-items:center; gap:5px; }
.db-stat-spark { position:absolute; right:-10px; bottom:-2px; opacity:.65; pointer-events:none; }
/* 2-col */
.db-g2 { display:grid; grid-template-columns:1.55fr 1fr; gap:14px; margin-bottom:14px; }
/* 3-col */
.db-g3 { display:grid; grid-template-columns:1fr 1fr 1fr; gap:14px; align-items:start; }
.db-g3 > * { min-width:0; }
.db-g2 > * { min-width:0; }
/* Card */
.db-card { background:var(--panel); border:1px solid var(--line); border-radius:var(--r); box-shadow:var(--sh-sm); overflow:hidden; }
.db-card-head { padding:16px 20px 12px; display:flex; align-items:flex-start; justify-content:space-between; border-bottom:1px solid var(--line); }
.db-card-head h3 { margin:0; font-size:14.5px; font-weight:700; color:var(--t1); letter-spacing:-.005em; }
.db-card-head .sub { font-size:11.5px; color:var(--t3); margin-top:3px; }
.db-card-head .lnk { color:var(--pri); font-size:12px; text-decoration:none; font-weight:600; white-space:nowrap; margin-top:2px; }
.db-card-head .lnk:hover { color:var(--pri-2); }
.db-card-body { padding:8px 8px 10px; }
/* Messages */
.db-msg { display:grid; grid-template-columns:38px 1fr auto; gap:12px; padding:10px 12px; border-radius:10px; cursor:pointer; text-decoration:none; color:inherit; }
.db-msg:hover { background:#f5f7fc; }
.db-msg-av { width:38px; height:38px; border-radius:10px; background:#eef1f6; color:var(--t2); display:grid; place-items:center; font-weight:600; font-size:13px; flex:0 0 38px; }
.db-msg-top { display:flex; align-items:center; gap:7px; flex-wrap:wrap; }
.db-msg-top b { font-size:13px; font-weight:600; color:var(--t1); }
.db-tag { font-size:10px; padding:2px 7px; border-radius:999px; font-weight:600; background:#f1f3f8; color:var(--t2); }
.db-tag.new { background:var(--acc-50); color:var(--acc-2); }
.db-msg-snip { color:var(--t2); font-size:12px; margin-top:2px; line-height:1.45; overflow:hidden; text-overflow:ellipsis; display:-webkit-box; -webkit-line-clamp:1; -webkit-box-orient:vertical; }
.db-msg-time { color:var(--t3); font-size:11px; white-space:nowrap; font-weight:500; }
/* Activity */
.db-act { display:grid; grid-template-columns:32px 1fr auto; gap:11px; padding:9px 12px; align-items:flex-start; }
.db-act-dot { width:32px; height:32px; border-radius:9px; display:grid; place-items:center; flex:0 0 32px; }
.db-act-body p { margin:0; font-size:12.5px; color:var(--t1); }
.db-act-body p b { font-weight:600; }
.db-act-body span { color:var(--t3); font-size:11px; }
.db-act-time { color:var(--t3); font-size:11px; white-space:nowrap; padding-top:2px; font-weight:500; }
/* Posts */
.db-post { display:grid; grid-template-columns:58px 1fr; gap:12px; padding:10px 12px; border-radius:10px; align-items:center; text-decoration:none; color:inherit; min-width:0; }
.db-post:hover { background:#f5f7fc; }
.db-post-thumb { width:58px; height:44px; border-radius:8px; flex:0 0 58px; }
.db-post-thumb.g1 { background:linear-gradient(135deg,#f59e0b,#ef7c2a); }
.db-post-thumb.g2 { background:linear-gradient(135deg,#3b82f6,#1e3a8a); }
.db-post-thumb.g3 { background:linear-gradient(135deg,#10b981,#0d9488); }
.db-post-thumb.g4 { background:linear-gradient(135deg,#a78bfa,#ec4899); }
.db-post-body { min-width:0; overflow:hidden; }
.db-post-body b { font-size:13px; font-weight:600; display:block; color:var(--t1); overflow:hidden; text-overflow:ellipsis; white-space:nowrap; max-width:100%; }
.db-post-meta { color:var(--t3); font-size:11px; display:flex; gap:8px; margin-top:4px; flex-wrap:wrap; }
.db-post-meta b { font-weight:600; color:var(--pri); display:inline; }
/* Status website rows */
.db-status-row { display:grid; grid-template-columns:32px 1fr auto; gap:10px; padding:11px 14px; align-items:center; border-bottom:1px solid #f1f3f8; min-width:0; }
.db-status-row:last-child { border-bottom:none; }
.db-status-ico { width:32px; height:32px; border-radius:9px; display:grid; place-items:center; flex:0 0 32px; }
.db-status-label { min-width:0; overflow:hidden; }
.db-status-label b { display:block; font-size:12.5px; font-weight:600; color:var(--t1); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.db-status-label span { font-size:11px; color:var(--t3); margin-top:2px; display:block; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.db-status-num { font-size:18px; font-weight:700; color:var(--t1); text-align:right; white-space:nowrap; }
.db-status-num small { display:block; font-size:10.5px; font-weight:500; color:var(--t3); text-align:right; margin-top:1px; }
/* Quick actions */
.db-qa-grid { display:grid; grid-template-columns:1fr 1fr; gap:8px; padding:10px; }
.db-qa { border:1px solid var(--line); border-radius:11px; padding:13px; display:flex; flex-direction:column; gap:9px; cursor:pointer; background:white; text-decoration:none; transition:border-color 110ms, background 110ms; }
.db-qa:hover { border-color:var(--pri-100); background:var(--pri-50); }
.db-qa-ico { width:33px; height:33px; border-radius:9px; display:grid; place-items:center; }
.db-qa b   { font-size:12.5px; font-weight:600; color:var(--t1); }
.db-qa span { font-size:11px; color:var(--t3); line-height:1.4; }
/* Divider */
.db-div { height:1px; background:var(--line); margin:3px 12px; }
/* Empty */
.db-empty { padding:28px; text-align:center; color:var(--t3); font-size:13px; }
@media (max-width:1200px) {
  .db-stats { grid-template-columns:repeat(2,1fr); }
  .db-g2, .db-g3 { grid-template-columns:1fr; }
}
</style>

<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <defs>
    <symbol id="dbi-news"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M7 8h10M7 12h10M7 16h6"/></symbol>
    <symbol id="dbi-mail"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></symbol>
    <symbol id="dbi-cap"   viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 9l10-5 10 5-10 5L2 9z"/><path d="M6 11v4c0 1.7 2.7 3 6 3s6-1.3 6-3v-4"/></symbol>
    <symbol id="dbi-img"   viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="M21 15l-5-5L5 21"/></symbol>
    <symbol id="dbi-run"   viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="14" cy="4" r="2"/><path d="M5 22l3-7 4 2 2-5 4 3"/><path d="M9 13l-2-3 3-3 4 3-2 3"/></symbol>
    <symbol id="dbi-plus"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></symbol>
    <symbol id="dbi-users" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></symbol>
  </defs>
</svg>

<div class="db fi-page-content" style="padding:28px 28px 60px;">

  {{-- Page head --}}
  <div class="db-head">
    <div>
      <h1>Dashboard Admin</h1>
      <p>Ringkasan aktivitas situs sekolah &middot; {{ $tanggal }}</p>
    </div>
    <div style="display:flex;gap:8px;">
      <a href="{{ route('filament.admin.resources.messages.index') }}" class="db-btn">
        <svg width="15" height="15"><use href="#dbi-mail"/></svg>
        Pesan
        @if($this->pesanBelumDibaca > 0)
        <span style="min-width:18px;height:18px;padding:0 5px;border-radius:999px;background:var(--acc);color:white;font-size:10.5px;font-weight:700;display:inline-flex;align-items:center;justify-content:center;">{{ $this->pesanBelumDibaca }}</span>
        @endif
      </a>
      <a href="{{ route('filament.admin.resources.posts.create') }}" class="db-btn pri">
        <svg width="15" height="15"><use href="#dbi-plus"/></svg>Tulis Berita
      </a>
    </div>
  </div>

  {{-- Stats --}}
  <div class="db-stats">

    <div class="db-stat">
      <div class="db-stat-head">
        <span class="db-stat-lbl">Berita Tayang</span>
        <div class="db-stat-ico" style="background:var(--acc-50);color:var(--acc-2)"><svg width="18" height="18"><use href="#dbi-news"/></svg></div>
      </div>
      <div class="db-stat-val">{{ number_format($this->totalBerita) }}</div>
      <div class="db-stat-sub">
        @if($this->draftBerita > 0)
        <span style="color:var(--warn);font-weight:600;">{{ $this->draftBerita }} draft</span> menunggu publish
        @else
        <span style="color:var(--t3)">Semua sudah tayang</span>
        @endif
      </div>
      <svg class="db-stat-spark" width="120" height="40" viewBox="0 0 120 40" fill="none">
        <path d="M0 28 L10 24 L20 26 L30 18 L40 22 L50 14 L60 18 L70 10 L80 14 L90 8 L100 12 L110 6 L120 4" stroke="#ef7c2a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>

    <div class="db-stat">
      <div class="db-stat-head">
        <span class="db-stat-lbl">Pesan Masuk</span>
        <div class="db-stat-ico" style="background:var(--vio-50);color:var(--vio)"><svg width="18" height="18"><use href="#dbi-mail"/></svg></div>
      </div>
      <div class="db-stat-val">{{ $this->totalPesan }}</div>
      <div class="db-stat-sub">
        @if($this->pesanBelumDibaca > 0)
        <span style="color:var(--acc-2);font-weight:600;">{{ $this->pesanBelumDibaca }} belum dibaca</span>
        @else
        <span style="color:var(--ok);font-weight:600;">✓ Semua sudah dibaca</span>
        @endif
      </div>
      <svg class="db-stat-spark" width="120" height="40" viewBox="0 0 120 40" fill="none">
        <rect x="6"  y="22" width="6" height="14" rx="1" fill="#7c3aed" opacity=".35"/>
        <rect x="22" y="18" width="6" height="18" rx="1" fill="#7c3aed" opacity=".45"/>
        <rect x="38" y="24" width="6" height="12" rx="1" fill="#7c3aed" opacity=".35"/>
        <rect x="54" y="14" width="6" height="22" rx="1" fill="#7c3aed" opacity=".55"/>
        <rect x="70" y="20" width="6" height="16" rx="1" fill="#7c3aed" opacity=".45"/>
        <rect x="86" y="10" width="6" height="26" rx="1" fill="#7c3aed" opacity=".75"/>
        <rect x="102" y="6"  width="6" height="30" rx="1" fill="#7c3aed"/>
      </svg>
    </div>

    <div class="db-stat">
      <div class="db-stat-head">
        <span class="db-stat-lbl">Guru & Staf</span>
        <div class="db-stat-ico" style="background:var(--inf-50);color:var(--inf)"><svg width="18" height="18"><use href="#dbi-cap"/></svg></div>
      </div>
      <div class="db-stat-val">{{ number_format($this->totalGuru) }}</div>
      <div class="db-stat-sub" style="color:var(--t3)">Tenaga pendidik aktif</div>
      <svg class="db-stat-spark" width="120" height="40" viewBox="0 0 120 40" fill="none">
        <path d="M0 30 L15 26 L30 28 L45 22 L60 24 L75 18 L90 20 L105 14 L120 12" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>

    <div class="db-stat">
      <div class="db-stat-head">
        <span class="db-stat-lbl">Siswa Aktif</span>
        <div class="db-stat-ico" style="background:var(--ok-50);color:var(--ok)"><svg width="18" height="18"><use href="#dbi-users"/></svg></div>
      </div>
      <div class="db-stat-val">{{ $this->siswaAktif > 0 ? number_format($this->siswaAktif) : '—' }}</div>
      <div class="db-stat-sub">
        @if($this->siswaAktif > 0)
        <span style="color:var(--t3)">Tahun ajaran ini</span>
        @else
        <a href="{{ route('filament.admin.resources.settings.index') }}" style="color:var(--pri);font-weight:500;">Atur di Pengaturan →</a>
        @endif
      </div>
      <svg class="db-stat-spark" width="120" height="40" viewBox="0 0 120 40" fill="none">
        <path d="M0 30 L10 28 L20 26 L30 24 L40 22 L50 22 L60 20 L70 18 L80 16 L90 16 L100 12 L110 10 L120 8" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>

  </div>

  {{-- 2-col: Pesan terbaru + Aktivitas --}}
  <div class="db-g2">

    {{-- Pesan masuk terbaru --}}
    <div class="db-card">
      <div class="db-card-head">
        <div>
          <h3>Pesan masuk terbaru</h3>
          <div class="sub">
            @if($this->pesanBelumDibaca > 0)
            {{ $this->pesanBelumDibaca }} pesan menunggu balasan
            @else
            Tidak ada pesan baru
            @endif
          </div>
        </div>
        <a href="{{ route('filament.admin.resources.messages.index') }}" class="lnk">Lihat semua →</a>
      </div>
      <div class="db-card-body">
        @forelse($this->recentMessages as $i => $msg)
          @if($i > 0)<div class="db-div"></div>@endif
          <a href="{{ route('filament.admin.resources.messages.view', $msg) }}" class="db-msg">
            <div class="db-msg-av">{{ strtoupper(substr($msg->nama, 0, 2)) }}</div>
            <div>
              <div class="db-msg-top">
                <b>{{ $msg->nama }}</b>
                <span class="db-tag new">Baru</span>
                @if($msg->subjek)<span class="db-tag">{{ Str::limit($msg->subjek, 22) }}</span>@endif
              </div>
              <div class="db-msg-snip">{{ $msg->isi_pesan }}</div>
            </div>
            <div class="db-msg-time">{{ $msg->created_at->diffForHumans() }}</div>
          </a>
        @empty
          <div class="db-empty">Tidak ada pesan baru.</div>
        @endforelse
      </div>
    </div>

    {{-- Aktivitas terbaru --}}
    <div class="db-card">
      <div class="db-card-head">
        <div>
          <h3>Aktivitas terbaru</h3>
          <div class="sub">Perubahan konten situs</div>
        </div>
      </div>
      <div class="db-card-body">
        @forelse($this->recentActivities as $i => $act)
          @if($i > 0)<div class="db-div"></div>@endif
          @php
            $c      = $actColors[$act['color']] ?? $actColors['slate'];
            $icoMap = ['news' => 'dbi-news', 'cap' => 'dbi-cap', 'img' => 'dbi-img'];
            $icoId  = $icoMap[$act['icon']] ?? 'dbi-news';
          @endphp
          <div class="db-act">
            <div class="db-act-dot" style="background:{{ $c['bg'] }};color:{{ $c['fg'] }}">
              <svg width="15" height="15"><use href="#{{ $icoId }}"/></svg>
            </div>
            <div class="db-act-body">
              <p>{{ $act['title'] }}</p>
              <span>{{ $act['sub'] }}</span>
            </div>
            <div class="db-act-time">{{ $act['time']->diffForHumans(short: true) }}</div>
          </div>
        @empty
          <div class="db-empty">Belum ada aktivitas.</div>
        @endforelse
      </div>
    </div>

  </div>

  {{-- 3-col: Berita terbaru + Status Website + Aksi cepat --}}
  <div class="db-g3">

    {{-- Berita terbaru --}}
    <div class="db-card">
      <div class="db-card-head">
        <div>
          <h3>Berita terbaru</h3>
          <div class="sub">Baru dipublikasi</div>
        </div>
        <a href="{{ route('filament.admin.resources.posts.index') }}" class="lnk">Semua →</a>
      </div>
      <div class="db-card-body">
        @php $grads = ['g1','g2','g3','g4']; @endphp
        @forelse($this->recentPosts as $i => $post)
          @if($i > 0)<div class="db-div"></div>@endif
          <a href="{{ route('filament.admin.resources.posts.edit', $post) }}" class="db-post">
            <div class="db-post-thumb {{ $grads[$i % 4] }}"></div>
            <div class="db-post-body">
              <b>{{ $post->judul }}</b>
              <div class="db-post-meta">
                <span><b>{{ $typeLabels[$post->type] ?? ucfirst($post->type) }}</b></span>
                @if($post->tanggal_publish)
                  <span>&middot; {{ \Carbon\Carbon::parse($post->tanggal_publish)->translatedFormat('d M Y') }}</span>
                @endif
              </div>
            </div>
          </a>
        @empty
          <div class="db-empty">Belum ada berita dipublikasi.</div>
        @endforelse
      </div>
    </div>

    {{-- Status Konten Website --}}
    <div class="db-card">
      <div class="db-card-head">
        <div>
          <h3>Status konten</h3>
          <div class="sub">Ringkasan data situs sekolah</div>
        </div>
      </div>
      <div style="padding:4px 0;">

        <a href="{{ route('filament.admin.resources.posts.index') }}" class="db-status-row" style="text-decoration:none;color:inherit;transition:background 100ms;" onmouseover="this.style.background='#f5f7fc'" onmouseout="this.style.background=''">
          <div class="db-status-ico" style="background:var(--acc-50);color:var(--acc-2)"><svg width="15" height="15"><use href="#dbi-news"/></svg></div>
          <div class="db-status-label">
            <b>Berita & Pengumuman</b>
            <span>{{ $this->totalBerita }} tayang
              @if($this->draftBerita > 0)
                &middot; <span style="color:var(--warn);font-weight:600;">{{ $this->draftBerita }} draft</span>
              @endif
            </span>
          </div>
          <div class="db-status-num">{{ $this->totalBerita + $this->draftBerita }}<small>total</small></div>
        </a>

        <a href="{{ route('filament.admin.resources.teachers.index') }}" class="db-status-row" style="text-decoration:none;color:inherit;transition:background 100ms;" onmouseover="this.style.background='#f5f7fc'" onmouseout="this.style.background=''">
          <div class="db-status-ico" style="background:var(--inf-50);color:var(--inf)"><svg width="15" height="15"><use href="#dbi-cap"/></svg></div>
          <div class="db-status-label">
            <b>Guru & Staf</b>
            <span>Tenaga pendidik terdaftar</span>
          </div>
          <div class="db-status-num">{{ $this->totalGuru }}<small>aktif</small></div>
        </a>

        <a href="{{ route('filament.admin.resources.galleries.index') }}" class="db-status-row" style="text-decoration:none;color:inherit;transition:background 100ms;" onmouseover="this.style.background='#f5f7fc'" onmouseout="this.style.background=''">
          <div class="db-status-ico" style="background:var(--ok-50);color:var(--ok)"><svg width="15" height="15"><use href="#dbi-img"/></svg></div>
          <div class="db-status-label">
            <b>Galeri Foto</b>
            <span>Album dokumentasi kegiatan</span>
          </div>
          <div class="db-status-num">{{ $this->totalGaleri }}<small>album</small></div>
        </a>

        <a href="{{ route('filament.admin.resources.extracurriculars.index') }}" class="db-status-row" style="text-decoration:none;color:inherit;transition:background 100ms;" onmouseover="this.style.background='#f5f7fc'" onmouseout="this.style.background=''">
          <div class="db-status-ico" style="background:var(--vio-50);color:var(--vio)"><svg width="15" height="15"><use href="#dbi-run"/></svg></div>
          <div class="db-status-label">
            <b>Ekstrakurikuler</b>
            <span>Kegiatan siswa aktif</span>
          </div>
          <div class="db-status-num">{{ $this->totalEkskul }}<small>kegiatan</small></div>
        </a>

      </div>
    </div>

    {{-- Aksi cepat --}}
    <div class="db-card">
      <div class="db-card-head">
        <div>
          <h3>Aksi cepat</h3>
          <div class="sub">Pintasan tugas harian</div>
        </div>
      </div>
      <div class="db-qa-grid">
        <a href="{{ route('filament.admin.resources.posts.create') }}" class="db-qa">
          <div class="db-qa-ico" style="background:var(--acc-50);color:var(--acc-2)"><svg width="16" height="16"><use href="#dbi-news"/></svg></div>
          <b>Tulis Berita</b>
          <span>Buat artikel atau pengumuman</span>
        </a>
        <a href="{{ route('filament.admin.resources.teachers.create') }}" class="db-qa">
          <div class="db-qa-ico" style="background:var(--inf-50);color:var(--inf)"><svg width="16" height="16"><use href="#dbi-cap"/></svg></div>
          <b>Tambah Guru</b>
          <span>Daftarkan tenaga pendidik</span>
        </a>
        <a href="{{ route('filament.admin.resources.galleries.create') }}" class="db-qa">
          <div class="db-qa-ico" style="background:var(--ok-50);color:var(--ok)"><svg width="16" height="16"><use href="#dbi-img"/></svg></div>
          <b>Album Galeri</b>
          <span>Buat album foto kegiatan</span>
        </a>
        <a href="{{ route('filament.admin.resources.extracurriculars.create') }}" class="db-qa">
          <div class="db-qa-ico" style="background:var(--vio-50);color:var(--vio)"><svg width="16" height="16"><use href="#dbi-run"/></svg></div>
          <b>Ekstrakurikuler</b>
          <span>Tambah kegiatan siswa</span>
        </a>
      </div>
    </div>

  </div>

</div>
</div>{{-- /livewire root --}}
