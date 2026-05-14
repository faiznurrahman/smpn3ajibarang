<div>
@php
    $tanggal  = now()->locale('id')->translatedFormat('l, d F Y');
    $typeColors = [
        'berita'     => 'Berita',
        'pengumuman' => 'Pengumuman',
        'prestasi'   => 'Prestasi',
    ];
    $actColors = [
        'orange' => ['bg' => '#fff4ea', 'fg' => '#d96815'],
        'green'  => ['bg' => '#e6f7ed', 'fg' => '#16a34a'],
        'blue'   => ['bg' => '#e8efff', 'fg' => '#2563eb'],
        'violet' => ['bg' => '#f1ebff', 'fg' => '#7c3aed'],
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
  --red:#dc2626;
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
.db-stats { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:22px; }
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
/* Messages */
.db-msg { display:grid; grid-template-columns:38px 1fr auto; gap:14px; padding:12px 14px; border-radius:10px; cursor:pointer; text-decoration:none; color:inherit; }
.db-msg:hover { background:#f5f7fc; }
.db-msg-av { width:38px; height:38px; border-radius:10px; background:#eef1f6; color:var(--t2); display:grid; place-items:center; font-weight:600; font-size:13px; }
.db-msg-top { display:flex; align-items:center; gap:8px; flex-wrap:wrap; }
.db-msg-top b { font-size:13.5px; font-weight:600; color:var(--t1); }
.db-tag { font-size:10.5px; padding:2px 7px; border-radius:999px; font-weight:600; background:#f1f3f8; color:var(--t2); }
.db-tag.new { background:var(--acc-50); color:var(--acc-2); }
.db-msg-snip { color:var(--t2); font-size:12.5px; margin-top:3px; line-height:1.45; overflow:hidden; text-overflow:ellipsis; display:-webkit-box; -webkit-line-clamp:1; -webkit-box-orient:vertical; }
.db-msg-time { color:var(--t3); font-size:11.5px; white-space:nowrap; font-weight:500; }
/* Activity */
.db-act { display:grid; grid-template-columns:32px 1fr auto; gap:12px; padding:10px 14px; align-items:flex-start; }
.db-act-dot { width:32px; height:32px; border-radius:9px; display:grid; place-items:center; flex:0 0 32px; }
.db-act-body p { margin:0; font-size:13px; color:var(--t1); }
.db-act-body p b { font-weight:600; }
.db-act-body span { color:var(--t3); font-size:11.5px; }
.db-act-time { color:var(--t3); font-size:11.5px; white-space:nowrap; padding-top:2px; font-weight:500; }
/* Posts */
.db-post { display:grid; grid-template-columns:64px 1fr auto; gap:14px; padding:12px 14px; border-radius:10px; align-items:center; text-decoration:none; color:inherit; }
.db-post:hover { background:#f5f7fc; }
.db-post-thumb { width:64px; height:48px; border-radius:8px; }
.db-post-thumb.g1 { background:linear-gradient(135deg,#f59e0b,#ef7c2a); }
.db-post-thumb.g2 { background:linear-gradient(135deg,#3b82f6,#1e3a8a); }
.db-post-thumb.g3 { background:linear-gradient(135deg,#10b981,#0d9488); }
.db-post-thumb.g4 { background:linear-gradient(135deg,#a78bfa,#ec4899); }
.db-post-body b { font-size:13.5px; font-weight:600; display:block; color:var(--t1); overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
.db-post-meta { color:var(--t3); font-size:11.5px; display:flex; gap:10px; margin-top:4px; }
.db-post-meta b { font-weight:600; color:var(--pri); display:inline; }
/* Agenda */
.db-agenda { display:grid; grid-template-columns:54px 1fr auto; gap:14px; padding:12px 14px; align-items:center; border-radius:10px; }
.db-agenda:hover { background:#f5f7fc; }
.db-agenda-date { width:54px; height:54px; border-radius:10px; background:var(--bg); border:1px solid var(--line); display:flex; flex-direction:column; align-items:center; justify-content:center; line-height:1; flex:0 0 54px; }
.db-agenda-date b { font-size:18px; font-weight:700; color:var(--t1); }
.db-agenda-date span { font-size:10px; color:var(--t3); margin-top:3px; text-transform:uppercase; letter-spacing:.08em; font-weight:700; }
.db-agenda-date.now { background:var(--acc-50); border-color:transparent; }
.db-agenda-date.now b, .db-agenda-date.now span { color:var(--acc-2); }
.db-agenda-body b { font-size:13.5px; font-weight:600; display:block; color:var(--t1); }
.db-agenda-body span { font-size:11.5px; color:var(--t3); display:flex; align-items:center; gap:6px; margin-top:4px; }
.db-pill { font-size:10.5px; padding:3px 9px; border-radius:999px; font-weight:600; background:#eef1f6; color:var(--t2); }
.db-pill.now { background:var(--acc-50); color:var(--acc-2); }
.db-pill.green { background:var(--ok-50); color:var(--ok); }
/* Quick actions */
.db-qa-grid { display:grid; grid-template-columns:1fr 1fr; gap:10px; padding:12px; }
.db-qa { border:1px solid var(--line); border-radius:11px; padding:14px; display:flex; flex-direction:column; gap:10px; cursor:pointer; background:white; text-decoration:none; transition:border-color 110ms, background 110ms; }
.db-qa:hover { border-color:var(--pri-100); background:var(--pri-50); }
.db-qa-ico { width:34px; height:34px; border-radius:9px; display:grid; place-items:center; }
.db-qa b   { font-size:13px; font-weight:600; color:var(--t1); }
.db-qa span { font-size:11.5px; color:var(--t3); line-height:1.4; }
/* Divider */
.db-div { height:1px; background:var(--line); margin:4px 14px; }
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
    <symbol id="dbi-clock" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></symbol>
    <symbol id="dbi-pin"   viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s7-7 7-12a7 7 0 1 0-14 0c0 5 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/></symbol>
    <symbol id="dbi-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L20 7"/></symbol>
  </defs>
</svg>

<div class="db fi-page-content" style="padding:28px 28px 60px;">

  {{-- Page head --}}
  <div class="db-head">
    <div>
      <h1>Dasbor</h1>
      <p>Ringkasan aktivitas situs sekolah &middot; {{ $tanggal }}</p>
    </div>
    <div style="display:flex;gap:10px;">
      <a href="{{ route('filament.admin.resources.posts.create') }}" class="db-btn pri">
        <svg width="16" height="16"><use href="#dbi-plus"/></svg>Berita baru
      </a>
    </div>
  </div>

  {{-- Stats --}}
  <div class="db-stats">
    <div class="db-stat">
      <div class="db-stat-head">
        <span class="db-stat-lbl">Berita Dipublikasi</span>
        <div class="db-stat-ico" style="background:var(--acc-50);color:var(--acc-2)"><svg width="18" height="18"><use href="#dbi-news"/></svg></div>
      </div>
      <div class="db-stat-val">{{ number_format($this->totalBerita) }}</div>
      <div class="db-stat-sub" style="color:var(--t3)">Total berita tayang</div>
      <svg class="db-stat-spark" width="120" height="40" viewBox="0 0 120 40" fill="none">
        <path d="M0 28 L10 24 L20 26 L30 18 L40 22 L50 14 L60 18 L70 10 L80 14 L90 8 L100 12 L110 6 L120 4" stroke="#ef7c2a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>
    <div class="db-stat">
      <div class="db-stat-head">
        <span class="db-stat-lbl">Total Pesan Masuk</span>
        <div class="db-stat-ico" style="background:var(--vio-50);color:var(--vio)"><svg width="18" height="18"><use href="#dbi-mail"/></svg></div>
      </div>
      <div class="db-stat-val">{{ $this->pesanBelumDibaca }}<span style="font-size:18px;color:var(--t3);font-weight:500"> / {{ $this->totalPesan }}</span></div>
      <div class="db-stat-sub" style="color:var(--t3)">{{ $this->pesanBelumDibaca }} belum dibaca</div>
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
        <span class="db-stat-lbl">Guru Aktif</span>
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
        <div class="db-stat-ico" style="background:var(--ok-50);color:var(--ok)"><svg width="18" height="18"><use href="#dbi-run"/></svg></div>
      </div>
      <div class="db-stat-val">{{ $this->siswaAktif > 0 ? number_format($this->siswaAktif) : '—' }}</div>
      <div class="db-stat-sub" style="color:var(--t3)">
        @if($this->siswaAktif > 0) Tahun ajaran ini
        @else <a href="{{ route('filament.admin.resources.settings.index') }}" style="color:var(--pri)">Atur di Pengaturan</a>
        @endif
      </div>
      <svg class="db-stat-spark" width="120" height="40" viewBox="0 0 120 40" fill="none">
        <path d="M0 30 L10 28 L20 26 L30 24 L40 22 L50 22 L60 20 L70 18 L80 16 L90 16 L100 12 L110 10 L120 8" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>
  </div>

  {{-- 2-col: Messages + Activity --}}
  <div class="db-g2">

    {{-- Pesan masuk terbaru --}}
    <div class="db-card">
      <div class="db-card-head">
        <div>
          <h3>Pesan masuk terbaru</h3>
          <div class="sub">{{ $this->pesanBelumDibaca }} pesan menunggu balasan</div>
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
                @if($msg->subjek)<span class="db-tag">{{ Str::limit($msg->subjek, 20) }}</span>@endif
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
          <div class="sub">Log perubahan di situs</div>
        </div>
      </div>
      <div class="db-card-body">
        @forelse($this->recentActivities as $i => $act)
          @if($i > 0)<div class="db-div"></div>@endif
          @php
            $c = $actColors[$act['color']] ?? $actColors['slate'];
            $iconMap = ['news'=>'dbi-news','cap'=>'dbi-cap','img'=>'dbi-img','check'=>'dbi-check'];
            $iconId  = $iconMap[$act['icon']] ?? 'dbi-check';
          @endphp
          <div class="db-act">
            <div class="db-act-dot" style="background:{{ $c['bg'] }};color:{{ $c['fg'] }}">
              <svg width="15" height="15"><use href="#{{ $iconId }}"/></svg>
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

  {{-- 3-col: Posts + Agenda + Quick actions --}}
  <div class="db-g3">

    {{-- Berita populer --}}
    <div class="db-card">
      <div class="db-card-head">
        <div>
          <h3>Berita populer</h3>
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
                <span><b>{{ $typeColors[$post->type] ?? ucfirst($post->type) }}</b></span>
                @if($post->tanggal_publish)
                  <span>&middot; {{ \Carbon\Carbon::parse($post->tanggal_publish)->translatedFormat('d M') }}</span>
                @endif
              </div>
            </div>
          </a>
        @empty
          <div class="db-empty">Belum ada berita dipublikasi.</div>
        @endforelse
      </div>
    </div>

    {{-- Agenda mendatang (static) --}}
    <div class="db-card">
      <div class="db-card-head">
        <div>
          <h3>Agenda mendatang</h3>
          <div class="sub">Jadwal kegiatan sekolah</div>
        </div>
      </div>
      <div class="db-card-body">
        @php
          $agendas = [
            ['day'=>'12','mon'=>'Mei','title'=>'Rapat Dewan Guru','time'=>'13.00–15.00','place'=>'R. Guru','now'=>true,'pill'=>'Hari ini','pill_class'=>'now'],
            ['day'=>'15','mon'=>'Mei','title'=>'Simulasi Ujian Sekolah','time'=>'07.30–12.00','place'=>'Ruang Kelas','now'=>false,'pill'=>'Jumat','pill_class'=>''],
            ['day'=>'17','mon'=>'Mei','title'=>'Pentas Seni Akhir Semester','time'=>'08.00–12.00','place'=>'Aula Sekolah','now'=>false,'pill'=>'Publik','pill_class'=>'green'],
            ['day'=>'20','mon'=>'Mei','title'=>'Upacara Hari Kebangkitan Nasional','time'=>'07.00–08.30','place'=>'Lapangan','now'=>false,'pill'=>'Selasa','pill_class'=>''],
          ];
        @endphp
        @foreach($agendas as $i => $ag)
          @if($i > 0)<div class="db-div"></div>@endif
          <div class="db-agenda">
            <div class="db-agenda-date {{ $ag['now'] ? 'now' : '' }}">
              <b>{{ $ag['day'] }}</b>
              <span>{{ $ag['mon'] }}</span>
            </div>
            <div class="db-agenda-body">
              <b>{{ $ag['title'] }}</b>
              <span>
                <svg width="12" height="12"><use href="#dbi-clock"/></svg>{{ $ag['time'] }} WIB
                <svg width="12" height="12" style="margin-left:6px"><use href="#dbi-pin"/></svg>{{ $ag['place'] }}
              </span>
            </div>
            <span class="db-pill {{ $ag['pill_class'] }}">{{ $ag['pill'] }}</span>
          </div>
        @endforeach
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
          <span>Buat artikel atau pengumuman baru</span>
        </a>
        <a href="{{ route('filament.admin.resources.teachers.create') }}" class="db-qa">
          <div class="db-qa-ico" style="background:var(--inf-50);color:var(--inf)"><svg width="16" height="16"><use href="#dbi-cap"/></svg></div>
          <b>Tambah Guru</b>
          <span>Daftarkan tenaga pendidik baru</span>
        </a>
        <a href="{{ route('filament.admin.resources.galleries.create') }}" class="db-qa">
          <div class="db-qa-ico" style="background:var(--ok-50);color:var(--ok)"><svg width="16" height="16"><use href="#dbi-img"/></svg></div>
          <b>Album Galeri</b>
          <span>Buat album foto kegiatan</span>
        </a>
        <a href="{{ route('filament.admin.resources.extracurriculars.create') }}" class="db-qa">
          <div class="db-qa-ico" style="background:var(--vio-50);color:var(--vio)"><svg width="16" height="16"><use href="#dbi-run"/></svg></div>
          <b>Ekstrakurikuler</b>
          <span>Atur jadwal &amp; pembina</span>
        </a>
      </div>
    </div>

  </div>

</div>
</div>{{-- /livewire root --}}
