<x-filament-panels::page>
<style>
.txb {
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
.txb-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; flex-wrap:wrap; gap:10px; }
.txb-title { font-size:20px; font-weight:800; color:var(--t1); letter-spacing:-.02em; }
.txb-btn-add {
    height:36px; padding:0 16px; border-radius:8px; border:none;
    background:var(--pri); color:white; font:inherit; font-size:13px; font-weight:600;
    cursor:pointer; display:inline-flex; align-items:center; gap:6px;
    transition:background 120ms; text-decoration:none;
}
.txb-btn-add:hover { background:var(--pri-2); color:white; }

/* ── Main tabs ── */
.txb-tabs {
    display:flex; gap:0; background:var(--panel);
    border-radius:var(--r) var(--r) 0 0;
    border:1px solid var(--line); border-bottom:none; overflow:hidden;
}
.txb-tab {
    flex:1; padding:14px 20px; background:none; border:none; cursor:pointer;
    font:inherit; font-size:13.5px; font-weight:600; color:var(--t3);
    display:flex; align-items:center; justify-content:center; gap:8px;
    transition:color 150ms, background 150ms;
    border-bottom:2px solid transparent; margin-bottom:-1px; position:relative;
}
.txb-tab:hover { background:#f8f9fc; color:var(--t2); }
.txb-tab.active { color:var(--pri); border-bottom-color:var(--pri); background:var(--pri-50); }

/* Judul halaman bawaan Filament (breadcrumb + judul) disembunyikan karena sudah ada judul kustom di dalam konten */
header.fi-header { display:none; }

/* ── Card ── */
.txb-card {
    background:var(--panel); border:1px solid var(--line);
    border-radius:0 0 var(--r) var(--r); box-shadow:var(--sh); overflow:hidden;
}
.txb-card-head {
    padding:16px 20px 14px; border-bottom:1px solid var(--line);
    display:flex; align-items:center; gap:8px; flex-wrap:wrap;
}
.txb-card-title { font-size:14px; font-weight:700; color:var(--t1); }
.txb-card-count { font-size:12px; color:var(--t3); margin-left:4px; }

/* ── Search bar ── */
.txb-search-bar { padding:10px 20px; border-bottom:1px solid var(--line); display:flex; align-items:center; }
.txb-search-wrap { position:relative; width:100%; max-width:320px; }
.txb-search-icon { position:absolute; left:11px; top:50%; transform:translateY(-50%); color:var(--t3); pointer-events:none; }
.txb-search-input {
    width:100%; height:34px; border:1px solid var(--line); border-radius:8px;
    padding:0 30px 0 33px; font-size:13px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; box-sizing:border-box; transition:border-color 150ms;
}
.txb-search-input:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.txb-search-clear {
    position:absolute; right:8px; top:50%; transform:translateY(-50%);
    background:none; border:none; cursor:pointer; color:var(--t3); font-size:17px;
    line-height:1; padding:2px; display:flex; align-items:center;
}
.txb-search-clear:hover { color:var(--t1); }

/* ── Table ── */
.txb-tbl-wrap { overflow-x:auto; }
.txb-tbl { width:100%; border-collapse:collapse; font-size:13px; table-layout:auto; }
.txb-tbl thead tr { background:#f8f9fc; border-bottom:1px solid var(--line); }
.txb-tbl th {
    padding:10px 14px; text-align:left; font-size:11.5px; font-weight:700;
    text-transform:uppercase; letter-spacing:.06em; color:var(--t3); white-space:nowrap;
}
.txb-tbl th.center { text-align:center; }
.txb-tbl tbody tr { border-bottom:1px solid #f1f3f8; transition:background 80ms; }
.txb-tbl tbody tr:last-child { border-bottom:none; }
.txb-tbl tbody tr:hover { background:#f8f9fc; }
.txb-tbl td { padding:11px 14px; vertical-align:middle; color:var(--t1); }
.txb-tbl td.center { text-align:center; }
.txb-tbl td.no { color:var(--t3); font-size:12px; text-align:center; width:44px; }
.txb-tbl td.muted { color:var(--t3); }
.txb-tbl .cell-main { font-weight:600; margin-bottom:2px; }
.txb-tbl .cell-sub { font-size:12px; color:var(--t3); font-weight:400; }
.txb-tbl .cell-code { font-family:'SF Mono','Fira Code',ui-monospace,monospace; font-size:11.5px; letter-spacing:.02em; }

/* ── Badges ── */
.txb-badge { display:inline-block; padding:2px 10px; border-radius:999px; font-size:11.5px; font-weight:600; white-space:nowrap; }
.txb-badge.ok      { background:var(--ok-50); color:var(--ok); }
.txb-badge.danger  { background:var(--err-50); color:var(--err); }
.txb-badge.warn    { background:var(--warn-50); color:var(--warn); }
.txb-badge.gray    { background:#f1f3f8; color:var(--t2); }
.txb-badge.info    { background:var(--pri-50); color:var(--pri); }

/* ── Action button ── */
.txb-btn-act {
    padding:5px 12px; border-radius:7px; border:1px solid var(--line-2);
    background:#f8f9fc; color:var(--t2); font:inherit; font-size:12px;
    font-weight:600; cursor:pointer; white-space:nowrap; text-decoration:none;
    display:inline-flex; align-items:center;
    transition:background 120ms, color 120ms, border-color 120ms;
}
.txb-btn-act:hover { background:var(--pri-50); color:var(--pri); border-color:var(--pri-100); }

/* ── Empty state ── */
.txb-empty { padding:48px 20px; text-align:center; color:var(--t3); font-size:13.5px; }
.txb-empty-icon { font-size:32px; margin-bottom:10px; opacity:.4; }

/* ── Pagination ── */
.txb-pagination {
    display:flex; align-items:center; justify-content:space-between;
    padding:12px 20px; border-top:1px solid var(--line);
    font-size:12.5px; color:var(--t3); flex-wrap:wrap; gap:8px;
}
.txb-pg-btns { display:flex; gap:4px; flex-wrap:wrap; }
.txb-pg-btn {
    min-width:30px; height:30px; padding:0 8px; border-radius:7px;
    border:1px solid var(--line); background:white; font-size:12px; font-weight:500;
    color:#0f172a; cursor:pointer; font-family:inherit;
    display:inline-flex; align-items:center; justify-content:center; transition:background 100ms;
}
.txb-pg-btn:hover:not(.disabled):not(.active) { background:#f5f7fc; }
.txb-pg-btn.active { background:#1e3a8a; color:white; border-color:#1e3a8a; font-weight:600; }
.txb-pg-btn.disabled { opacity:.4; cursor:not-allowed; }

@media (max-width:1023px) {
    .txb-tab { padding:12px 14px; font-size:13px; }
    .txb-tbl th, .txb-tbl td { padding:9px 10px; }
    .txb-card-head { padding:12px 16px; }
    .txb-header { margin-bottom:14px; }
    .txb-title { font-size:17px; }
    .txb-hide-mobile { display:none; }
    .txb-search-wrap { max-width:100%; }
    .txb-search-input { font-size:16px !important; height:40px; }
    .txb-pagination { flex-direction:column; align-items:flex-start; gap:8px; }
}

@media (max-width:767px) {
    /* Judul + tombol aksi ditumpuk, tombol dibuat full-width di bawah judul */
    .txb-header {
        flex-direction:column; align-items:stretch; gap:10px;
    }
    .txb-btn-add {
        width:100%; justify-content:center; height:44px; font-size:14px;
    }
}
</style>

<div class="txb">

    {{-- ── HEADER ── --}}
    <div class="txb-header">
        <div class="txb-title">Katalog buku paket</div>
        <a href="{{ $this->getCreateUrl() }}" class="txb-btn-add">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Buku Paket
        </a>
    </div>

    {{-- ── MAIN TABS ── --}}
    <div class="txb-tabs">
        <button type="button" class="txb-tab {{ $activeTab === 'aktif' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'aktif')">
            Aktif
        </button>
        <button type="button" class="txb-tab {{ $activeTab === 'nonaktif' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'nonaktif')">
            Nonaktif
        </button>
        <button type="button" class="txb-tab {{ $activeTab === 'semua' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'semua')">
            Semua
        </button>
    </div>

    <div class="txb-card">

        @php $data = $this->getData(); @endphp

        <div class="txb-card-head">
            <span class="txb-card-count">{{ $data->total() }} data</span>
        </div>

        <div class="txb-search-bar">
            <div class="txb-search-wrap">
                <svg class="txb-search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" class="txb-search-input"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari judul, kode, mata pelajaran, atau penerbit..."
                    autocomplete="off">
                @if($search)
                <button class="txb-search-clear" wire:click="$set('search', '')" type="button">×</button>
                @endif
            </div>
        </div>

        <div style="padding:0;">
            @if($data->total() === 0)
            <div class="txb-empty">
                <div class="txb-empty-icon">📚</div>
                <div>Tidak ada data buku paket</div>
            </div>
            @else
            <div class="txb-tbl-wrap">
            <table class="txb-tbl">
                <thead>
                    <tr>
                        <th class="center txb-hide-mobile">No</th>
                        <th>Judul Buku</th>
                        <th>Tingkat</th>
                        <th class="center">Eksemplar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $textbook)
                    @php
                        $tingkatClass = match((int) $textbook->untuk_tingkat) {
                            7 => 'info',
                            8 => 'ok',
                            9 => 'warn',
                            default => 'gray',
                        };
                    @endphp
                    <tr>
                        <td class="no txb-hide-mobile">{{ $data->firstItem() + $loop->index }}</td>

                        <td>
                            <div class="cell-main">{{ $textbook->judul }}</div>
                            <div class="cell-sub">
                                {{ $textbook->mata_pelajaran }}
                                <span class="cell-code">{{ $textbook->kode_prefix }}</span>
                            </div>
                        </td>

                        <td><span class="txb-badge {{ $tingkatClass }}">Kelas {{ $textbook->untuk_tingkat }}</span></td>

                        <td class="center">
                            <span style="font-weight:600; color:var(--t1);">{{ $textbook->eksemplar_tersedia }}</span><span style="color:var(--t3);">/{{ $textbook->total_eksemplar }}</span>
                            <div style="font-size:11px; color:var(--t3); margin-top:1px;">tersedia</div>
                        </td>

                        <td>
                            @if($textbook->is_active)
                                <span class="txb-badge ok">Aktif</span>
                            @else
                                <span class="txb-badge gray">Nonaktif</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ $this->getEditUrl($textbook) }}" class="txb-btn-act">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            {{-- ── Pagination ── --}}
            @if($data->hasPages())
            <div class="txb-pagination">
                <span>Menampilkan {{ $data->firstItem() }}–{{ $data->lastItem() }} dari {{ $data->total() }} data</span>
                <div class="txb-pg-btns">
                    <button class="txb-pg-btn {{ $data->onFirstPage() ? 'disabled' : '' }}"
                        wire:click="prevPage" {{ $data->onFirstPage() ? 'disabled' : '' }}>‹</button>
                    @foreach($data->getUrlRange(1, $data->lastPage()) as $pg => $url)
                    <button class="txb-pg-btn {{ $pg == $data->currentPage() ? 'active' : '' }}"
                        wire:click="$set('page', {{ $pg }})">{{ $pg }}</button>
                    @endforeach
                    <button class="txb-pg-btn {{ !$data->hasMorePages() ? 'disabled' : '' }}"
                        wire:click="nextPage" {{ !$data->hasMorePages() ? 'disabled' : '' }}>›</button>
                </div>
            </div>
            @endif
            @endif
        </div>

    </div>{{-- /.txb-card --}}

</div>
</x-filament-panels::page>
