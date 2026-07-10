<x-filament-panels::page>
<style>
.dbp {
    --pri:#1e3a8a; --pri-2:#2746a4; --pri-50:#eef2ff; --pri-100:#dbe3ff;
    --ok:#16a34a;  --ok-50:#e6f7ed;
    --warn:#b45309; --warn-50:#fffbeb;
    --err:#dc2626; --err-50:#fee2e2;
    --t1:#0f172a; --t2:#5a6478; --t3:#8b94a6;
    --line:#e6eaf2; --line-2:#d4dae6;
    --panel:#fff;
    --r:14px; --sh:0 1px 2px rgba(15,23,42,.04);
}

/* ── Page header ── */
.dbp-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; flex-wrap:wrap; gap:10px; }
.dbp-title { font-size:20px; font-weight:800; color:var(--t1); letter-spacing:-.02em; }
.dbp-btn-add {
    height:36px; padding:0 16px; border-radius:8px; border:none;
    background:var(--pri); color:white; font:inherit; font-size:13px; font-weight:600;
    cursor:pointer; display:inline-flex; align-items:center; gap:6px;
    transition:background 120ms; text-decoration:none;
}
.dbp-btn-add:hover { background:var(--pri-2); color:white; }

/* ── Main tabs ── */
.dbp-tabs {
    display:flex; gap:0; background:var(--panel);
    border-radius:var(--r) var(--r) 0 0;
    border:1px solid var(--line); border-bottom:none; overflow:hidden;
}
.dbp-tab {
    flex:1; padding:14px 20px; background:none; border:none; cursor:pointer;
    font:inherit; font-size:13.5px; font-weight:600; color:var(--t3);
    display:flex; align-items:center; justify-content:center; gap:8px;
    transition:color 150ms, background 150ms;
    border-bottom:2px solid transparent; margin-bottom:-1px; position:relative;
}
.dbp-tab:hover { background:#f8f9fc; color:var(--t2); }
.dbp-tab.active { color:var(--pri); border-bottom-color:var(--pri); background:var(--pri-50); }

/* Judul halaman bawaan Filament (breadcrumb + judul) disembunyikan karena sudah ada judul kustom di dalam konten */
header.fi-header { display:none; }

/* ── Card ── */
.dbp-card {
    background:var(--panel); border:1px solid var(--line);
    border-radius:0 0 var(--r) var(--r); box-shadow:var(--sh); overflow:hidden;
}
.dbp-card-head {
    padding:16px 20px 14px; border-bottom:1px solid var(--line);
    display:flex; align-items:center; gap:8px; flex-wrap:wrap;
}
.dbp-card-title { font-size:14px; font-weight:700; color:var(--t1); }
.dbp-card-count { font-size:12px; color:var(--t3); margin-left:4px; }

/* ── Search bar ── */
.dbp-search-bar { padding:10px 20px; border-bottom:1px solid var(--line); display:flex; align-items:center; }
.dbp-search-wrap { position:relative; width:100%; max-width:320px; }
.dbp-search-icon { position:absolute; left:11px; top:50%; transform:translateY(-50%); color:var(--t3); pointer-events:none; }
.dbp-search-input {
    width:100%; height:34px; border:1px solid var(--line); border-radius:8px;
    padding:0 30px 0 33px; font-size:13px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; box-sizing:border-box; transition:border-color 150ms;
}
.dbp-search-input:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.dbp-search-clear {
    position:absolute; right:8px; top:50%; transform:translateY(-50%);
    background:none; border:none; cursor:pointer; color:var(--t3); font-size:17px;
    line-height:1; padding:2px; display:flex; align-items:center;
}
.dbp-search-clear:hover { color:var(--t1); }

/* ── Table ── */
.dbp-tbl-wrap { overflow-x:auto; }
.dbp-tbl { width:100%; border-collapse:collapse; font-size:13px; table-layout:auto; }
.dbp-tbl thead tr { background:#f8f9fc; border-bottom:1px solid var(--line); }
.dbp-tbl th {
    padding:10px 14px; text-align:left; font-size:11.5px; font-weight:700;
    text-transform:uppercase; letter-spacing:.06em; color:var(--t3); white-space:nowrap;
}
.dbp-tbl th.center { text-align:center; }
.dbp-tbl tbody tr { border-bottom:1px solid #f1f3f8; transition:background 80ms; }
.dbp-tbl tbody tr:last-child { border-bottom:none; }
.dbp-tbl tbody tr:hover { background:#f8f9fc; }
.dbp-tbl td { padding:11px 14px; vertical-align:middle; color:var(--t1); }
.dbp-tbl td.center { text-align:center; }
.dbp-tbl td.no { color:var(--t3); font-size:12px; text-align:center; width:44px; }
.dbp-tbl td.muted { color:var(--t3); }
.dbp-tbl .cell-main { font-weight:600; margin-bottom:2px; }
.dbp-tbl .cell-sub { font-size:12px; color:var(--t3); font-weight:400; }

/* ── Badges ── */
.dbp-badge { display:inline-block; padding:2px 10px; border-radius:999px; font-size:11.5px; font-weight:600; white-space:nowrap; }
.dbp-badge.ok      { background:var(--ok-50); color:var(--ok); }
.dbp-badge.danger  { background:var(--err-50); color:var(--err); }
.dbp-badge.warn    { background:var(--warn-50); color:var(--warn); }
.dbp-badge.gray    { background:#f1f3f8; color:var(--t2); }
.dbp-badge.info    { background:var(--pri-50); color:var(--pri); }

/* ── Action buttons ── */
.dbp-btn-act {
    padding:5px 12px; border-radius:7px; border:1px solid var(--line-2);
    background:#f8f9fc; color:var(--t2); font:inherit; font-size:12px;
    font-weight:600; cursor:pointer; white-space:nowrap; text-decoration:none;
    display:inline-flex; align-items:center;
    transition:background 120ms, color 120ms, border-color 120ms;
}
.dbp-btn-act:hover { background:var(--pri-50); color:var(--pri); border-color:var(--pri-100); }
.dbp-btn-kembalikan {
    padding:5px 12px; border-radius:7px;
    border:1px solid #86efac; background:var(--ok-50); color:var(--ok);
    font:inherit; font-size:12px; font-weight:600; cursor:pointer;
    white-space:nowrap; text-decoration:none; display:inline-flex; align-items:center;
    transition:background 120ms;
}
.dbp-btn-kembalikan:hover { background:var(--ok); color:white; border-color:var(--ok); }

/* ── Empty state ── */
.dbp-empty { padding:48px 20px; text-align:center; color:var(--t3); font-size:13.5px; }
.dbp-empty-icon { font-size:32px; margin-bottom:10px; opacity:.4; }

/* ── Pagination ── */
.dbp-pagination {
    display:flex; align-items:center; justify-content:space-between;
    padding:12px 20px; border-top:1px solid var(--line);
    font-size:12.5px; color:var(--t3); flex-wrap:wrap; gap:8px;
}
.dbp-pg-btns { display:flex; gap:4px; flex-wrap:wrap; }
.dbp-pg-btn {
    min-width:30px; height:30px; padding:0 8px; border-radius:7px;
    border:1px solid var(--line); background:white; font-size:12px; font-weight:500;
    color:#0f172a; cursor:pointer; font-family:inherit;
    display:inline-flex; align-items:center; justify-content:center; transition:background 100ms;
}
.dbp-pg-btn:hover:not(.disabled):not(.active) { background:#f5f7fc; }
.dbp-pg-btn.active { background:#1e3a8a; color:white; border-color:#1e3a8a; font-weight:600; }
.dbp-pg-btn.disabled { opacity:.4; cursor:not-allowed; }

@media (max-width:1023px) {
    .dbp-tab { padding:12px 14px; font-size:13px; }
    .dbp-tbl th, .dbp-tbl td { padding:9px 10px; }
    .dbp-card-head { padding:12px 16px; }
    .dbp-header { margin-bottom:14px; }
    .dbp-title { font-size:17px; }
    .dbp-hide-mobile { display:none; }
    .dbp-search-wrap { max-width:100%; }
    .dbp-search-input { font-size:16px !important; height:40px; }
    .dbp-pagination { flex-direction:column; align-items:flex-start; gap:8px; }
}

@media (max-width:767px) {
    /* Judul + tombol aksi ditumpuk, tombol dibuat full-width di bawah judul */
    .dbp-header {
        flex-direction:column; align-items:stretch; gap:10px;
    }
    .dbp-btn-add {
        width:100%; justify-content:center; height:44px; font-size:14px;
    }
}
</style>

<div class="dbp">

    {{-- ── HEADER ── --}}
    <div class="dbp-header">
        <div class="dbp-title">Distribusi buku paket</div>
        <a href="{{ $this->getCreateUrl() }}" class="dbp-btn-add">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Buat Distribusi
        </a>
    </div>

    {{-- ── MAIN TABS ── --}}
    <div class="dbp-tabs">
        <button type="button" class="dbp-tab {{ $activeTab === 'semua' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'semua')">
            Semua
        </button>
        <button type="button" class="dbp-tab {{ $activeTab === 'aktif' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'aktif')">
            Aktif
        </button>
        <button type="button" class="dbp-tab {{ $activeTab === 'selesai' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'selesai')">
            Selesai
        </button>
    </div>

    <div class="dbp-card">

        @php $data = $this->getData(); @endphp

        <div class="dbp-card-head">
            <span class="dbp-card-count">{{ $data->total() }} data</span>
        </div>

        <div class="dbp-search-bar">
            <div class="dbp-search-wrap">
                <svg class="dbp-search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" class="dbp-search-input"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari tahun ajaran..."
                    autocomplete="off">
                @if($search)
                <button class="dbp-search-clear" wire:click="$set('search', '')" type="button">×</button>
                @endif
            </div>
        </div>

        <div style="padding:0;">
            @if($data->total() === 0)
            <div class="dbp-empty">
                <div class="dbp-empty-icon">📦</div>
                <div>Tidak ada data distribusi</div>
            </div>
            @else
            <div class="dbp-tbl-wrap">
            <table class="dbp-tbl">
                <thead>
                    <tr>
                        <th class="center dbp-hide-mobile">No</th>
                        <th>Tahun Ajaran</th>
                        <th class="dbp-hide-mobile">Tgl Distribusi</th>
                        <th class="dbp-hide-mobile">Tgl Kembali Rencana</th>
                        <th class="center">Siswa Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $dist)
                    <tr>
                        <td class="no dbp-hide-mobile">{{ $data->firstItem() + $loop->index }}</td>

                        <td>
                            <div class="cell-main">{{ $dist->tahun_ajaran }}</div>
                            <div class="cell-sub">Kelas {{ $dist->untuk_tingkat }}</div>
                        </td>

                        <td class="muted dbp-hide-mobile" style="white-space:nowrap;">
                            {{ $dist->tgl_distribusi?->translatedFormat('d M Y') ?? '—' }}
                        </td>

                        <td class="muted dbp-hide-mobile" style="white-space:nowrap;">
                            {{ $dist->tgl_kembali_rencana?->translatedFormat('d M Y') ?? '—' }}
                        </td>

                        <td class="center">
                            <span style="font-weight:600; color:var(--t1);">{{ $dist->jumlah_kembali }}</span><span style="color:var(--t3);">/{{ $dist->jumlah_siswa }}</span>
                        </td>

                        <td>
                            @if($dist->status === 'aktif')
                                <span class="dbp-badge warn">Aktif</span>
                            @else
                                <span class="dbp-badge ok">Selesai</span>
                            @endif
                        </td>

                        <td style="display:flex; gap:6px; flex-wrap:wrap;">
                            <a href="{{ $this->getDetailUrl($dist) }}" class="dbp-btn-act">Detail</a>
                            @if($dist->status === 'aktif')
                            <a href="{{ $this->getPengembalianUrl($dist) }}" class="dbp-btn-kembalikan">Pengembalian</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            {{-- ── Pagination ── --}}
            @if($data->hasPages())
            <div class="dbp-pagination">
                <span>Menampilkan {{ $data->firstItem() }}–{{ $data->lastItem() }} dari {{ $data->total() }} data</span>
                <div class="dbp-pg-btns">
                    <button class="dbp-pg-btn {{ $data->onFirstPage() ? 'disabled' : '' }}"
                        wire:click="prevPage" {{ $data->onFirstPage() ? 'disabled' : '' }}>‹</button>
                    @foreach($data->getUrlRange(1, $data->lastPage()) as $pg => $url)
                    <button class="dbp-pg-btn {{ $pg == $data->currentPage() ? 'active' : '' }}"
                        wire:click="$set('page', {{ $pg }})">{{ $pg }}</button>
                    @endforeach
                    <button class="dbp-pg-btn {{ !$data->hasMorePages() ? 'disabled' : '' }}"
                        wire:click="nextPage" {{ !$data->hasMorePages() ? 'disabled' : '' }}>›</button>
                </div>
            </div>
            @endif
            @endif
        </div>

    </div>{{-- /.dbp-card --}}

</div>
</x-filament-panels::page>
