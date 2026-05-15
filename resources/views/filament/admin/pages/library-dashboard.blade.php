<div>
@php
    use App\Enums\UserRole;
    $tanggal   = now()->locale('id')->translatedFormat('l, d F Y');
    $isPetugas = auth()->user()?->role === UserRole::PetugasPerpustakaan;
@endphp

<style>
.ldb {
  --pri:#1e3a8a; --pri-2:#2746a4; --pri-50:#eef2ff; --pri-100:#dbe3ff;
  --acc:#ef7c2a; --acc-2:#d96815; --acc-50:#fff4ea;
  --ok:#16a34a;  --ok-50:#e6f7ed;
  --inf:#2563eb; --inf-50:#e8efff;
  --red:#dc2626; --red-50:#fee2e2;
  --warn:#f59e0b; --warn-50:#fffbeb;
  --line:#e6eaf2; --line-2:#d4dae6;
  --t1:#0f172a; --t2:#5a6478; --t3:#8b94a6;
  --panel:#fff; --bg:#f3f5fa;
  --r:14px; --sh-sm:0 1px 2px rgba(15,23,42,.04);
}
.ldb-head { display:flex; align-items:flex-end; justify-content:space-between; gap:20px; margin-bottom:22px; }
.ldb-head h1 { font-size:28px; font-weight:700; margin:0 0 4px; letter-spacing:-.015em; color:var(--t1); }
.ldb-head p  { margin:0; color:var(--t2); font-size:14px; }
.ldb-badge { display:inline-flex; align-items:center; gap:6px; background:var(--inf-50); color:var(--inf); border-radius:8px; padding:5px 12px; font-size:12px; font-weight:600; }

.ldb-stats { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:22px; }
@media(max-width:900px){ .ldb-stats { grid-template-columns:repeat(2,1fr); } }
@media(max-width:560px){ .ldb-stats { grid-template-columns:1fr; } }

.ldb-stat { background:var(--panel); border:1px solid var(--line); border-radius:var(--r); padding:18px 18px 16px; box-shadow:var(--sh-sm); }
.ldb-stat-head { display:flex; align-items:center; justify-content:space-between; }
.ldb-stat-lbl  { font-size:11.5px; color:var(--t3); letter-spacing:.06em; text-transform:uppercase; font-weight:700; }
.ldb-stat-ico  { width:36px; height:36px; border-radius:10px; display:grid; place-items:center; flex-shrink:0; }
.ldb-stat-val  { font-size:32px; font-weight:700; letter-spacing:-.02em; margin:14px 0 4px; color:var(--t1); }
.ldb-stat-sub  { font-size:12px; color:var(--t2); }

.ldb-g2 { display:grid; grid-template-columns:1.4fr 1fr; gap:16px; }
@media(max-width:900px){ .ldb-g2 { grid-template-columns:1fr; } }

.ldb-card { background:var(--panel); border:1px solid var(--line); border-radius:var(--r); box-shadow:var(--sh-sm); }
.ldb-card-head { padding:16px 20px 14px; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid var(--line); }
.ldb-card-head h3 { margin:0; font-size:15px; font-weight:700; color:var(--t1); }
.ldb-card-link { font-size:12.5px; font-weight:600; color:var(--pri); text-decoration:none; }
.ldb-card-link:hover { color:var(--pri-2); }

.ldb-list { padding:4px 0; }
.ldb-row { display:flex; align-items:center; gap:12px; padding:10px 20px; transition:background 100ms; }
.ldb-row:hover { background:#f8fafc; }
.ldb-row-ico { width:32px; height:32px; border-radius:8px; display:grid; place-items:center; flex-shrink:0; }
.ldb-row-body { flex:1; min-width:0; }
.ldb-row-title { font-size:13px; font-weight:600; color:var(--t1); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.ldb-row-sub   { font-size:11.5px; color:var(--t2); margin-top:1px; }
.ldb-badge-pill { display:inline-flex; align-items:center; font-size:10.5px; font-weight:700; padding:2px 8px; border-radius:999px; flex-shrink:0; }
.ldb-badge-warn  { background:var(--warn-50); color:#b45309; }
.ldb-badge-red   { background:var(--red-50); color:var(--red); }
.ldb-badge-ok    { background:var(--ok-50); color:var(--ok); }

.ldb-empty { display:flex; flex-direction:column; align-items:center; gap:10px; padding:28px 16px; color:var(--t3); font-size:12.5px; }
.ldb-empty svg { opacity:.4; }
.ldb-empty p { margin:0; }

.ldb-denda-total { display:flex; align-items:center; justify-content:space-between; padding:12px 20px; background:var(--red-50); border-top:1px solid #fecaca; }
.ldb-denda-total span { font-size:12.5px; color:var(--red); font-weight:600; }
</style>

{{-- Header --}}
<div class="ldb-head">
    <div>
        <h1>Dasbor Perpustakaan</h1>
        <p>{{ $tanggal }}</p>
    </div>
    <div style="display:flex;gap:10px;align-items:center;">
        <span class="ldb-badge">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
            Perpustakaan SMPN 3 Ajibarang
        </span>
        @if ($isPetugas)
            <a href="{{ \App\Filament\Resources\Loans\LoanResource::getUrl('create') }}" class="ldb-badge" style="background:var(--acc-50);color:var(--acc-2);text-decoration:none;">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                Catat Peminjaman
            </a>
        @endif
    </div>
</div>

{{-- Stats --}}
<div class="ldb-stats">
    <div class="ldb-stat">
        <div class="ldb-stat-head">
            <span class="ldb-stat-lbl">Total Buku</span>
            <div class="ldb-stat-ico" style="background:#eef2ff;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1e3a8a" stroke-width="1.8"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
            </div>
        </div>
        <div class="ldb-stat-val">{{ $totalBuku }}</div>
        <div class="ldb-stat-sub">koleksi aktif</div>
    </div>

    <div class="ldb-stat">
        <div class="ldb-stat-head">
            <span class="ldb-stat-lbl">Total Anggota</span>
            <div class="ldb-stat-ico" style="background:#e6f7ed;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
        </div>
        <div class="ldb-stat-val">{{ $totalAnggota }}</div>
        <div class="ldb-stat-sub">anggota aktif</div>
    </div>

    <div class="ldb-stat">
        <div class="ldb-stat-head">
            <span class="ldb-stat-lbl">Dipinjam</span>
            <div class="ldb-stat-ico" style="background:#fffbeb;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="1.8"><path d="M9 17H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v5"/><polyline points="9 11 12 14 22 4"/></svg>
            </div>
        </div>
        <div class="ldb-stat-val">{{ $peminjamAktif }}</div>
        <div class="ldb-stat-sub">sedang dipinjam</div>
    </div>

    <div class="ldb-stat">
        <div class="ldb-stat-head">
            <span class="ldb-stat-lbl">Denda Belum Lunas</span>
            <div class="ldb-stat-ico" style="background:#fee2e2;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="1.8"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
            </div>
        </div>
        <div class="ldb-stat-val">{{ $dendaBelumLunas }}</div>
        <div class="ldb-stat-sub">Rp {{ number_format($totalDenda, 0, ',', '.') }}</div>
    </div>
</div>

{{-- Main grid --}}
<div class="ldb-g2">
    {{-- Peminjaman aktif --}}
    <div class="ldb-card">
        <div class="ldb-card-head">
            <h3>Peminjaman Aktif</h3>
            @if ($isPetugas)
                <a href="{{ \App\Filament\Resources\Returns\ReturnResource::getUrl('index') }}" class="ldb-card-link">Proses pengembalian →</a>
            @endif
        </div>
        <div class="ldb-list">
            @forelse ($recentLoans as $loan)
                @php $isLate = $loan->isLate(); @endphp
                <div class="ldb-row">
                    <div class="ldb-row-ico" style="background:{{ $isLate ? '#fee2e2' : '#fffbeb' }};">
                        @if ($isLate)
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        @else
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                        @endif
                    </div>
                    <div class="ldb-row-body">
                        <div class="ldb-row-title">{{ \Illuminate\Support\Str::limit($loan->book?->judul, 35) }}</div>
                        <div class="ldb-row-sub">{{ $loan->member?->nama }} · Batas: {{ $loan->tgl_batas_kembali?->format('d M Y') }}</div>
                    </div>
                    @if ($isLate)
                        <span class="ldb-badge-pill ldb-badge-red">+{{ $loan->jumlahHariTerlambat() }} hari</span>
                    @else
                        <span class="ldb-badge-pill ldb-badge-warn">Dipinjam</span>
                    @endif
                </div>
            @empty
                <div class="ldb-empty">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    <p>Tidak ada peminjaman aktif</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Denda belum lunas --}}
    <div class="ldb-card">
        <div class="ldb-card-head">
            <h3>Denda Belum Lunas</h3>
            @if ($isPetugas)
                <a href="{{ \App\Filament\Resources\Fines\FineResource::getUrl('index') }}" class="ldb-card-link">Lihat semua →</a>
            @endif
        </div>
        <div class="ldb-list">
            @forelse ($recentFines as $fine)
                <div class="ldb-row">
                    <div class="ldb-row-ico" style="background:#fee2e2;">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                    </div>
                    <div class="ldb-row-body">
                        <div class="ldb-row-title">{{ \Illuminate\Support\Str::limit($fine->loan?->member?->nama, 22) }}</div>
                        <div class="ldb-row-sub">{{ $fine->jumlah_hari }} hari · Rp {{ number_format($fine->nominal, 0, ',', '.') }}</div>
                    </div>
                    <span class="ldb-badge-pill ldb-badge-red">Belum Lunas</span>
                </div>
            @empty
                <div class="ldb-empty">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                    <p>Tidak ada denda</p>
                </div>
            @endforelse
            @if ($dendaBelumLunas > 0)
                <div class="ldb-denda-total">
                    <span>Total denda belum lunas</span>
                    <span>Rp {{ number_format($totalDenda, 0, ',', '.') }}</span>
                </div>
            @endif
        </div>
    </div>
</div>
</div>
