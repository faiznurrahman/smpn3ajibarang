<div>
@php
    $tanggal = now()->locale('id')->translatedFormat('l, d F Y');
@endphp

<style>
.sw {
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
.sw-head { display:flex; align-items:flex-end; justify-content:space-between; gap:20px; margin-bottom:22px; }
.sw-head h1 { font-size:28px; font-weight:700; margin:0 0 4px; letter-spacing:-.015em; color:var(--t1); }
.sw-head p  { margin:0; color:var(--t2); font-size:14px; }
.sw-stats { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:22px; }
.sw-stat  { background:var(--panel); border:1px solid var(--line); border-radius:var(--r); padding:18px 18px 16px; box-shadow:var(--sh-sm); }
.sw-stat-head { display:flex; align-items:center; justify-content:space-between; }
.sw-stat-lbl  { font-size:11.5px; color:var(--t3); letter-spacing:.06em; text-transform:uppercase; font-weight:700; }
.sw-stat-ico  { width:36px; height:36px; border-radius:10px; display:grid; place-items:center; }
.sw-stat-val  { font-size:30px; font-weight:700; letter-spacing:-.02em; margin:14px 0 4px; color:var(--t1); }
.sw-stat-sub  { font-size:12px; color:var(--t2); }
.sw-g2 { display:grid; grid-template-columns:1.6fr 1fr; gap:16px; }
.sw-card { background:var(--panel); border:1px solid var(--line); border-radius:var(--r); box-shadow:var(--sh-sm); }
.sw-card-head { padding:18px 20px 14px; display:flex; align-items:flex-start; justify-content:space-between; border-bottom:1px solid var(--line); }
.sw-card-head h3 { margin:0; font-size:15px; font-weight:700; color:var(--t1); }
.sw-card-head .sub { font-size:12px; color:var(--t3); margin-top:3px; }
.sw-card-body { padding:8px 8px 12px; }
.sw-post { display:grid; grid-template-columns:42px 1fr; gap:12px; padding:11px 14px; border-radius:10px; align-items:center; }
.sw-post:hover { background:#f5f7fc; }
.sw-post-thumb { width:42px; height:42px; border-radius:9px; display:grid; place-items:center; font-size:11px; font-weight:800; color:white; letter-spacing:.02em; }
.sw-post-thumb.c1 { background:linear-gradient(135deg,#1e3a8a,#3b5fc0); }
.sw-post-thumb.c2 { background:linear-gradient(135deg,#0369a1,#38bdf8); }
.sw-post-thumb.c3 { background:linear-gradient(135deg,#065f46,#34d399); }
.sw-post-thumb.c4 { background:linear-gradient(135deg,#581c87,#a855f7); }
.sw-post-thumb.c5 { background:linear-gradient(135deg,#92400e,#f59e0b); }
.sw-post-thumb.c6 { background:linear-gradient(135deg,#9f1239,#fb7185); }
.sw-post-body b { font-size:13.5px; font-weight:600; display:block; color:var(--t1); overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
.sw-post-meta { color:var(--t3); font-size:11.5px; margin-top:3px; }
.sw-div { height:1px; background:var(--line); margin:4px 14px; }
.sw-empty { padding:28px; text-align:center; color:var(--t3); font-size:13px; }
.sw-info-list { padding:12px 8px; }
.sw-info-row  { display:flex; align-items:center; justify-content:space-between; padding:12px 14px; border-radius:10px; }
.sw-info-row:hover { background:#f5f7fc; }
.sw-info-lbl  { font-size:13px; color:var(--t2); display:flex; align-items:center; gap:10px; }
.sw-info-ico  { width:32px; height:32px; border-radius:9px; display:grid; place-items:center; }
.sw-info-val  { font-size:15px; font-weight:700; color:var(--t1); }
.sw-badge { display:inline-flex; align-items:center; gap:4px; padding:2px 8px; border-radius:999px; font-size:11px; font-weight:600; }
.sw-badge.warn { background:var(--warn-50); color:#92400e; }
.sw-badge.ok   { background:var(--ok-50); color:var(--ok); }
.sw-section-lbl { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.08em; color:var(--t3); margin:22px 0 10px; display:flex; align-items:center; gap:8px; }
.sw-section-lbl::after { content:''; flex:1; height:1px; background:var(--line); }
.sw-stats-3 { grid-template-columns:repeat(3,1fr); }

/* ---- Responsive ---- */
@media (max-width: 900px) {
  .sw-stats { grid-template-columns:repeat(2,1fr); }
  .sw-stats-3 { grid-template-columns:repeat(3,1fr); }
  .sw-g2 { grid-template-columns:1fr; }
}
@media (max-width: 640px) {
  .sw { padding:0 !important; }
  .sw-head { flex-direction:column; align-items:flex-start; gap:6px; margin-bottom:14px; }
  .sw-head h1 { font-size:20px; }
  .sw-head p  { font-size:12.5px; }
  .sw-stats { grid-template-columns:repeat(2,1fr); gap:10px; margin-bottom:14px; }
  .sw-stats-3 { grid-template-columns:repeat(2,1fr); }
  .sw-stat { padding:12px 12px 10px; }
  .sw-stat-ico { width:30px; height:30px; border-radius:8px; }
  .sw-stat-ico svg { width:15px; height:15px; }
  .sw-stat-lbl { font-size:10px; }
  .sw-stat-val { font-size:clamp(18px,5vw,26px); margin:10px 0 3px; }
  .sw-stat-sub { font-size:11px; white-space:normal; line-height:1.4; }
  .sw-section-lbl { font-size:10px; margin:16px 0 8px; }
  .sw-g2 { grid-template-columns:1fr; gap:12px; }
  .sw-card-head { padding:12px 14px 10px; }
  .sw-card-head h3 { font-size:13.5px; }
  .sw-card-head .sub { font-size:11px; }
  .sw-card-body { padding:6px 6px 8px; }
  .sw-post { grid-template-columns:36px 1fr; gap:8px; padding:8px 10px; }
  .sw-post-thumb { width:36px; height:36px; border-radius:8px; font-size:10px; }
  .sw-post-body b { font-size:12.5px; white-space:normal; line-height:1.3; }
  .sw-post-meta { font-size:11px; }
  .sw-info-list { padding:8px 4px; }
  .sw-info-row { padding:9px 10px; }
  .sw-info-ico { width:28px; height:28px; border-radius:8px; }
  .sw-info-ico svg { width:14px; height:14px; }
  .sw-info-lbl { font-size:12px; gap:8px; }
  .sw-info-val { font-size:13.5px; }
  .sw-badge { font-size:10.5px; padding:2px 7px; }
  .sw-div { margin:2px 10px; }
}
@media (max-width: 400px) {
  .sw-stat-val { font-size:16px; }
  .sw-stats, .sw-stats-3 { gap:8px; }
  .sw-stat { padding:10px 10px 8px; }
}
</style>

<div class="sw" style="padding:8px 2px 32px;width:100%;box-sizing:border-box;overflow-x:hidden;">

  {{-- Header --}}
  <div class="sw-head">
    <div>
      <h1>Statistik Website</h1>
      <p>{{ $tanggal }} &mdash; Ringkasan konten website sekolah</p>
    </div>
  </div>

  {{-- Stats row --}}
  <div class="sw-stats">
    <div class="sw-stat">
      <div class="sw-stat-head">
        <span class="sw-stat-lbl">Berita Tayang</span>
        <div class="sw-stat-ico" style="background:var(--pri-50);">
          <svg width="18" height="18" fill="none" stroke="var(--pri)" stroke-width="1.8" viewBox="0 0 24 24"><path d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2Z"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
        </div>
      </div>
      <div class="sw-stat-val">{{ $totalBerita }}</div>
      <div class="sw-stat-sub">{{ $beritaBulanIni }} tayang bulan ini &middot; {{ $draftBerita }} draft</div>
    </div>

    <div class="sw-stat">
      <div class="sw-stat-head">
        <span class="sw-stat-lbl">Guru Aktif</span>
        <div class="sw-stat-ico" style="background:var(--ok-50);">
          <svg width="18" height="18" fill="none" stroke="var(--ok)" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/></svg>
        </div>
      </div>
      <div class="sw-stat-val">{{ $totalGuru }}</div>
      <div class="sw-stat-sub">tampil di website sekolah</div>
    </div>

    <div class="sw-stat">
      <div class="sw-stat-head">
        <span class="sw-stat-lbl">Galeri Foto</span>
        <div class="sw-stat-ico" style="background:var(--vio-50);">
          <svg width="18" height="18" fill="none" stroke="var(--vio)" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
        </div>
      </div>
      <div class="sw-stat-val">{{ $totalGaleri }}</div>
      <div class="sw-stat-sub">album dokumentasi kegiatan</div>
    </div>

    <div class="sw-stat">
      <div class="sw-stat-head">
        <span class="sw-stat-lbl">Pesan Masuk</span>
        <div class="sw-stat-ico" style="background:{{ $pesanBelumDibaca ? 'var(--red-50)' : 'var(--acc-50)' }};">
          <svg width="18" height="18" fill="none" stroke="{{ $pesanBelumDibaca ? 'var(--red)' : 'var(--acc)' }}" stroke-width="1.8" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2Z"/></svg>
        </div>
      </div>
      <div class="sw-stat-val">{{ $totalPesan }}</div>
      <div class="sw-stat-sub">{{ $pesanBelumDibaca }} belum dibaca</div>
    </div>
  </div>

  {{-- Kunjungan Website --}}
  <div class="sw-section-lbl">Kunjungan Website</div>
  <div class="sw-stats sw-stats-3" style="margin-bottom:22px;">
    <div class="sw-stat">
      <div class="sw-stat-head">
        <span class="sw-stat-lbl">Total Kunjungan</span>
        <div class="sw-stat-ico" style="background:var(--pri-50);">
          <svg width="18" height="18" fill="none" stroke="var(--pri)" stroke-width="1.8" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
      </div>
      <div class="sw-stat-val">{{ number_format($totalKunjungan) }}</div>
      <div class="sw-stat-sub">total halaman dikunjungi</div>
    </div>
    <div class="sw-stat">
      <div class="sw-stat-head">
        <span class="sw-stat-lbl">Bulan Ini</span>
        <div class="sw-stat-ico" style="background:var(--ok-50);">
          <svg width="18" height="18" fill="none" stroke="var(--ok)" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><line x1="8" y1="14" x2="16" y2="14"/><line x1="8" y1="18" x2="12" y2="18"/></svg>
        </div>
      </div>
      <div class="sw-stat-val">{{ number_format($kunjunganBulanIni) }}</div>
      <div class="sw-stat-sub">kunjungan {{ now()->locale('id')->translatedFormat('F Y') }}</div>
    </div>
    <div class="sw-stat">
      <div class="sw-stat-head">
        <span class="sw-stat-lbl">Hari Ini</span>
        <div class="sw-stat-ico" style="background:var(--acc-50);">
          <svg width="18" height="18" fill="none" stroke="var(--acc)" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
      </div>
      <div class="sw-stat-val">{{ number_format($kunjunganHariIni) }}</div>
      <div class="sw-stat-sub">kunjungan hari ini</div>
    </div>
  </div>

  {{-- 2-col: Berita Terbaru + Info Konten --}}
  <div class="sw-g2">

    {{-- Berita Terbaru --}}
    <div class="sw-card">
      <div class="sw-card-head">
        <div>
          <h3>Berita Terbaru</h3>
          <div class="sub">{{ $totalBerita }} berita tayang di website</div>
        </div>
      </div>
      <div class="sw-card-body">
        @forelse($recentPosts as $i => $post)
          @if($i > 0)<div class="sw-div"></div>@endif
          <div class="sw-post">
            <div class="sw-post-thumb c{{ ($i % 6) + 1 }}">
              {{ strtoupper(substr($post->judul, 0, 2)) }}
            </div>
            <div>
              <b title="{{ $post->judul }}">{{ $post->judul }}</b>
              <div class="sw-post-meta">
                {{ $post->tanggal_publish ? \Carbon\Carbon::parse($post->tanggal_publish)->locale('id')->diffForHumans() : '—' }}
                @if($post->kategori)
                  &middot; {{ $post->kategori }}
                @endif
              </div>
            </div>
          </div>
        @empty
          <div class="sw-empty">Belum ada berita yang diterbitkan.</div>
        @endforelse
      </div>
    </div>

    {{-- Info Konten Website --}}
    <div class="sw-card">
      <div class="sw-card-head">
        <div>
          <h3>Ringkasan Konten</h3>
          <div class="sub">Semua modul website sekolah</div>
        </div>
      </div>
      <div class="sw-info-list">
        <div class="sw-info-row">
          <div class="sw-info-lbl">
            <div class="sw-info-ico" style="background:var(--pri-50);">
              <svg width="16" height="16" fill="none" stroke="var(--pri)" stroke-width="1.8" viewBox="0 0 24 24"><path d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2Z"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
            </div>
            <div>
              Berita
              <div style="font-size:11px;color:var(--t3);margin-top:1px;">{{ $beritaBulanIni }} tayang bulan ini</div>
            </div>
          </div>
          <div style="text-align:right;">
            <span class="sw-info-val">{{ $totalBerita }}</span>
            <div style="font-size:11px;color:var(--t3);">{{ $draftBerita }} draft</div>
          </div>
        </div>
        <div class="sw-div"></div>
        <div class="sw-info-row">
          <div class="sw-info-lbl">
            <div class="sw-info-ico" style="background:var(--warn-50);">
              <svg width="16" height="16" fill="none" stroke="var(--warn)" stroke-width="1.8" viewBox="0 0 24 24"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3Zm-8.27 4a2 2 0 0 1-3.46 0"/></svg>
            </div>
            Pengumuman
          </div>
          <div style="text-align:right;">
            <span class="sw-info-val">{{ $pengumumanAktif }}</span>
            <div style="font-size:11px;color:var(--t3);">{{ $pengumumanDraft }} draft</div>
          </div>
        </div>
        <div class="sw-div"></div>
        <div class="sw-info-row">
          <div class="sw-info-lbl">
            <div class="sw-info-ico" style="background:var(--ok-50);">
              <svg width="16" height="16" fill="none" stroke="var(--ok)" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/></svg>
            </div>
            Guru & Tenaga Pendidik
          </div>
          <span class="sw-info-val">{{ $totalGuru }}</span>
        </div>
        <div class="sw-div"></div>
        <div class="sw-info-row">
          <div class="sw-info-lbl">
            <div class="sw-info-ico" style="background:var(--vio-50);">
              <svg width="16" height="16" fill="none" stroke="var(--vio)" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
            </div>
            Galeri Foto
          </div>
          <span class="sw-info-val">{{ $totalGaleri }}</span>
        </div>
        <div class="sw-div"></div>
        <div class="sw-info-row">
          <div class="sw-info-lbl">
            <div class="sw-info-ico" style="background:var(--inf-50);">
              <svg width="16" height="16" fill="none" stroke="var(--inf)" stroke-width="1.8" viewBox="0 0 24 24"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>
            </div>
            Video Profil
          </div>
          <span class="sw-info-val">{{ $totalVideo }}</span>
        </div>
        <div class="sw-div"></div>
        <div class="sw-info-row">
          <div class="sw-info-lbl">
            <div class="sw-info-ico" style="background:var(--acc-50);">
              <svg width="16" height="16" fill="none" stroke="var(--acc)" stroke-width="1.8" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            Ekstrakurikuler
          </div>
          <span class="sw-info-val">{{ $totalEkskul }}</span>
        </div>
        <div class="sw-div"></div>
        <div class="sw-info-row">
          <div class="sw-info-lbl">
            <div class="sw-info-ico" style="background:{{ $pesanBelumDibaca ? 'var(--red-50)' : 'var(--ok-50)' }};">
              <svg width="16" height="16" fill="none" stroke="{{ $pesanBelumDibaca ? 'var(--red)' : 'var(--ok)' }}" stroke-width="1.8" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2Z"/></svg>
            </div>
            Pesan Belum Dibaca
          </div>
          @if($pesanBelumDibaca)
            <span class="sw-badge warn">{{ $pesanBelumDibaca }} pesan</span>
          @else
            <span class="sw-badge ok">Semua terbaca</span>
          @endif
        </div>
      </div>
    </div>

  </div>
</div>
</div>
