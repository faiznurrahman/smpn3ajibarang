<x-filament-panels::page>
<style>
.bks {
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
.bks-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; flex-wrap:wrap; gap:10px; }
.bks-title { font-size:20px; font-weight:800; color:var(--t1); letter-spacing:-.02em; }
.bks-btn-add {
    height:36px; padding:0 16px; border-radius:8px; border:none;
    background:var(--pri); color:white; font:inherit; font-size:13px; font-weight:600;
    cursor:pointer; display:inline-flex; align-items:center; gap:6px;
    transition:background 120ms; text-decoration:none;
}
.bks-btn-add:hover { background:var(--pri-2); color:white; }

/* ── Main tabs ── */
.bks-tabs {
    display:flex; gap:0; background:var(--panel);
    border-radius:var(--r) var(--r) 0 0;
    border:1px solid var(--line); border-bottom:none; overflow:hidden;
}
.bks-tab {
    flex:1; padding:14px 20px; background:none; border:none; cursor:pointer;
    font:inherit; font-size:13.5px; font-weight:600; color:var(--t3);
    display:flex; align-items:center; justify-content:center; gap:8px;
    transition:color 150ms, background 150ms;
    border-bottom:2px solid transparent; margin-bottom:-1px; position:relative;
}
.bks-tab:hover { background:#f8f9fc; color:var(--t2); }
.bks-tab.active { color:var(--pri); border-bottom-color:var(--pri); background:var(--pri-50); }

/* Judul halaman bawaan Filament (breadcrumb + judul) disembunyikan karena sudah ada judul kustom di dalam konten */
header.fi-header { display:none; }

/* ── Card ── */
.bks-card {
    background:var(--panel); border:1px solid var(--line);
    border-radius:0 0 var(--r) var(--r); box-shadow:var(--sh); overflow:hidden;
}
.bks-card-head {
    padding:16px 20px 14px; border-bottom:1px solid var(--line);
    display:flex; align-items:center; gap:8px; flex-wrap:wrap;
}
.bks-card-title { font-size:14px; font-weight:700; color:var(--t1); }
.bks-card-count { font-size:12px; color:var(--t3); margin-left:4px; }

/* ── Filter bar ── */
.bks-filter-bar { padding:10px 20px; border-bottom:1px solid var(--line); display:flex; align-items:center; gap:10px; flex-wrap:wrap; }
.bks-search-wrap { position:relative; flex:1; min-width:180px; max-width:320px; }
.bks-search-icon { position:absolute; left:11px; top:50%; transform:translateY(-50%); color:var(--t3); pointer-events:none; }
.bks-search-input {
    width:100%; height:34px; border:1px solid var(--line); border-radius:8px;
    padding:0 30px 0 33px; font-size:13px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; box-sizing:border-box; transition:border-color 150ms;
}
.bks-search-input:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.bks-search-clear {
    position:absolute; right:8px; top:50%; transform:translateY(-50%);
    background:none; border:none; cursor:pointer; color:var(--t3); font-size:17px;
    line-height:1; padding:2px; display:flex; align-items:center;
}
.bks-search-clear:hover { color:var(--t1); }
.bks-filter-select {
    height:34px; border:1px solid var(--line); border-radius:8px;
    padding:0 10px; font-size:12.5px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; cursor:pointer; transition:border-color 150ms;
    min-width:160px;
}
.bks-filter-select:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }

/* ── Table ── */
.bks-tbl-wrap { overflow-x:auto; }
.bks-tbl { width:100%; border-collapse:collapse; font-size:13px; table-layout:auto; }
.bks-tbl thead tr { background:#f8f9fc; border-bottom:1px solid var(--line); }
.bks-tbl th {
    padding:10px 14px; text-align:left; font-size:11.5px; font-weight:700;
    text-transform:uppercase; letter-spacing:.06em; color:var(--t3); white-space:nowrap;
}
.bks-tbl th.center { text-align:center; }
.bks-tbl tbody tr { border-bottom:1px solid #f1f3f8; transition:background 80ms; }
.bks-tbl tbody tr:last-child { border-bottom:none; }
.bks-tbl tbody tr:hover { background:#f8f9fc; }
.bks-tbl td { padding:11px 14px; vertical-align:middle; color:var(--t1); }
.bks-tbl td.center { text-align:center; }
.bks-tbl td.no { color:var(--t3); font-size:12px; text-align:center; width:44px; }
.bks-tbl td.muted { color:var(--t3); }
.bks-tbl .cell-main { font-weight:600; margin-bottom:2px; }
.bks-tbl .cell-sub { font-size:12px; color:var(--t3); font-weight:400; }
.bks-tbl .cell-code { font-family:'SF Mono','Fira Code',ui-monospace,monospace; font-size:11.5px; letter-spacing:.02em; }

/* ── Badges ── */
.bks-badge { display:inline-block; padding:2px 10px; border-radius:999px; font-size:11.5px; font-weight:600; white-space:nowrap; }
.bks-badge.ok      { background:var(--ok-50); color:var(--ok); }
.bks-badge.danger  { background:var(--err-50); color:var(--err); }
.bks-badge.warn    { background:var(--warn-50); color:var(--warn); }
.bks-badge.gray    { background:#f1f3f8; color:var(--t2); }
.bks-badge.info    { background:var(--pri-50); color:var(--pri); }

/* ── Action button ── */
.bks-btn-act {
    padding:5px 12px; border-radius:7px; border:1px solid var(--line-2);
    background:#f8f9fc; color:var(--t2); font:inherit; font-size:12px;
    font-weight:600; cursor:pointer; white-space:nowrap; text-decoration:none;
    display:inline-flex; align-items:center;
    transition:background 120ms, color 120ms, border-color 120ms;
}
.bks-btn-act:hover { background:var(--pri-50); color:var(--pri); border-color:var(--pri-100); }

/* ── Empty state ── */
.bks-empty { padding:48px 20px; text-align:center; color:var(--t3); font-size:13.5px; }
.bks-empty-icon { font-size:32px; margin-bottom:10px; opacity:.4; }

/* ── Pagination ── */
.bks-pagination {
    display:flex; align-items:center; justify-content:space-between;
    padding:12px 20px; border-top:1px solid var(--line);
    font-size:12.5px; color:var(--t3); flex-wrap:wrap; gap:8px;
}
.bks-pg-btns { display:flex; gap:4px; flex-wrap:wrap; }
.bks-pg-btn {
    min-width:30px; height:30px; padding:0 8px; border-radius:7px;
    border:1px solid var(--line); background:white; font-size:12px; font-weight:500;
    color:#0f172a; cursor:pointer; font-family:inherit;
    display:inline-flex; align-items:center; justify-content:center; transition:background 100ms;
}
.bks-pg-btn:hover:not(.disabled):not(.active) { background:#f5f7fc; }
.bks-pg-btn.active { background:#1e3a8a; color:white; border-color:#1e3a8a; font-weight:600; }
.bks-pg-btn.disabled { opacity:.4; cursor:not-allowed; }

@media (max-width:1023px) {
    .bks-tab { padding:12px 14px; font-size:13px; }
    .bks-tbl th, .bks-tbl td { padding:9px 10px; }
    .bks-card-head { padding:12px 16px; }
    .bks-header { margin-bottom:14px; }
    .bks-title { font-size:17px; }
    .bks-hide-mobile { display:none; }
    .bks-search-wrap { max-width:100%; min-width:0; flex:1 1 100%; }
    .bks-search-input { font-size:16px !important; height:40px; }
    .bks-filter-select { font-size:16px !important; height:40px; flex:1; min-width:0; }
    .bks-pagination { flex-direction:column; align-items:flex-start; gap:8px; }
}

@media (max-width:767px) {
    .bks-header { flex-direction:column; align-items:stretch; gap:10px; }
    .bks-btn-add { width:100%; justify-content:center; height:44px; font-size:14px; }
}
</style>

<div class="bks">

    {{-- ── HEADER ── --}}
    <div class="bks-header">
        <div class="bks-title">Katalog buku</div>
        <a href="{{ $this->getCreateUrl() }}" class="bks-btn-add">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Buku
        </a>
    </div>

    {{-- ── MAIN TABS ── --}}
    <div class="bks-tabs">
        <button type="button" class="bks-tab {{ $activeTab === 'aktif' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'aktif')">
            Aktif
        </button>
        <button type="button" class="bks-tab {{ $activeTab === 'nonaktif' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'nonaktif')">
            Nonaktif
        </button>
        <button type="button" class="bks-tab {{ $activeTab === 'semua' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'semua')">
            Semua
        </button>
    </div>

    <div class="bks-card">

        @php $data = $this->getData(); @endphp

        <div class="bks-card-head">
            <span class="bks-card-count">{{ $data->total() }} data</span>
        </div>

        <div class="bks-filter-bar">
            <div class="bks-search-wrap">
                <svg class="bks-search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" class="bks-search-input"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari judul, kode, penulis, atau no. panggil..."
                    autocomplete="off">
                @if($search)
                <button class="bks-search-clear" wire:click="$set('search', '')" type="button">×</button>
                @endif
            </div>

            <select class="bks-filter-select" wire:model.live="filterKategori">
                <option value="">Semua Kategori</option>
                <option value="Fiksi">Fiksi</option>
                <option value="Non-Fiksi">Non-Fiksi</option>
                <option value="Pelajaran">Pelajaran</option>
                <option value="Referensi">Referensi</option>
                <option value="Ensiklopedi">Ensiklopedi</option>
                <option value="Biografi">Biografi</option>
                <option value="Sains & Teknologi">Sains & Teknologi</option>
                <option value="Sosial & Budaya">Sosial & Budaya</option>
                <option value="Agama">Agama</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        <div style="padding:0;">
            @if($data->total() === 0)
            <div class="bks-empty">
                <div class="bks-empty-icon">📚</div>
                <div>Tidak ada data buku</div>
            </div>
            @else
            <div class="bks-tbl-wrap">
            <table class="bks-tbl">
                <thead>
                    <tr>
                        <th class="center bks-hide-mobile">No</th>
                        <th>Judul Buku</th>
                        <th class="bks-hide-mobile">No. Panggil</th>
                        <th>Kategori</th>
                        <th class="center">Eksemplar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $book)
                    <tr>
                        <td class="no bks-hide-mobile">{{ $data->firstItem() + $loop->index }}</td>

                        <td>
                            <div class="cell-main">{{ $book->judul }}</div>
                            <div class="cell-sub">
                                {{ $book->penulis }}
                                @if($book->tahun) · {{ $book->tahun }} @endif
                                <span class="cell-code">{{ $book->kode_buku }}</span>
                            </div>
                        </td>

                        <td class="muted bks-hide-mobile">{{ $book->no_panggil ?: '—' }}</td>

                        <td><span class="bks-badge info">{{ $book->kategori }}</span></td>

                        <td class="center">
                            <span style="font-weight:600; color:var(--t1);">{{ $book->eksemplar_tersedia }}</span><span style="color:var(--t3);">/{{ $book->jumlah_eksemplar }}</span>
                            <div style="font-size:11px; color:var(--t3); margin-top:1px;">tersedia</div>
                        </td>

                        <td>
                            @if($book->is_active)
                                <span class="bks-badge ok">Aktif</span>
                            @else
                                <span class="bks-badge gray">Nonaktif</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ $this->getEditUrl($book) }}" class="bks-btn-act">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            {{-- ── Pagination ── --}}
            @if($data->hasPages())
            <div class="bks-pagination">
                <span>Menampilkan {{ $data->firstItem() }}–{{ $data->lastItem() }} dari {{ $data->total() }} data</span>
                <div class="bks-pg-btns">
                    <button class="bks-pg-btn {{ $data->onFirstPage() ? 'disabled' : '' }}"
                        wire:click="prevPage" {{ $data->onFirstPage() ? 'disabled' : '' }}>‹</button>
                    @foreach($data->getUrlRange(1, $data->lastPage()) as $pg => $url)
                    <button class="bks-pg-btn {{ $pg == $data->currentPage() ? 'active' : '' }}"
                        wire:click="$set('page', {{ $pg }})">{{ $pg }}</button>
                    @endforeach
                    <button class="bks-pg-btn {{ !$data->hasMorePages() ? 'disabled' : '' }}"
                        wire:click="nextPage" {{ !$data->hasMorePages() ? 'disabled' : '' }}>›</button>
                </div>
            </div>
            @endif
            @endif
        </div>

    </div>{{-- /.bks-card --}}

</div>
</x-filament-panels::page>
