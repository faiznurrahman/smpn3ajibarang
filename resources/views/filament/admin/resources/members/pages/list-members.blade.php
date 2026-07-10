<x-filament-panels::page>
<style>
.mbr {
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
.mbr-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; flex-wrap:wrap; gap:10px; }
.mbr-title { font-size:20px; font-weight:800; color:var(--t1); letter-spacing:-.02em; }
.mbr-btn-add {
    height:36px; padding:0 16px; border-radius:8px; border:none;
    background:var(--pri); color:white; font:inherit; font-size:13px; font-weight:600;
    cursor:pointer; display:inline-flex; align-items:center; gap:6px;
    transition:background 120ms; text-decoration:none;
}
.mbr-btn-add:hover { background:var(--pri-2); color:white; }

/* ── Main tabs ── */
.mbr-tabs {
    display:flex; gap:0; background:var(--panel);
    border-radius:var(--r) var(--r) 0 0;
    border:1px solid var(--line); border-bottom:none; overflow:hidden;
}
.mbr-tab {
    flex:1; padding:14px 20px; background:none; border:none; cursor:pointer;
    font:inherit; font-size:13.5px; font-weight:600; color:var(--t3);
    display:flex; align-items:center; justify-content:center; gap:8px;
    transition:color 150ms, background 150ms;
    border-bottom:2px solid transparent; margin-bottom:-1px; position:relative;
}
.mbr-tab:hover { background:#f8f9fc; color:var(--t2); }
.mbr-tab.active { color:var(--pri); border-bottom-color:var(--pri); background:var(--pri-50); }

/* Judul halaman bawaan Filament (breadcrumb + judul) disembunyikan karena sudah ada judul kustom di dalam konten */
header.fi-header { display:none; }

/* ── Card ── */
.mbr-card {
    background:var(--panel); border:1px solid var(--line);
    border-radius:0 0 var(--r) var(--r); box-shadow:var(--sh); overflow:hidden;
}
.mbr-card-head {
    padding:16px 20px 14px; border-bottom:1px solid var(--line);
    display:flex; align-items:center; gap:8px; flex-wrap:wrap;
}
.mbr-card-title { font-size:14px; font-weight:700; color:var(--t1); }
.mbr-card-count { font-size:12px; color:var(--t3); margin-left:4px; }

/* ── Filter bar ── */
.mbr-filter-bar { padding:10px 20px; border-bottom:1px solid var(--line); display:flex; align-items:center; gap:10px; flex-wrap:wrap; }
.mbr-search-wrap { position:relative; flex:1; min-width:180px; max-width:320px; }
.mbr-search-icon { position:absolute; left:11px; top:50%; transform:translateY(-50%); color:var(--t3); pointer-events:none; }
.mbr-search-input {
    width:100%; height:34px; border:1px solid var(--line); border-radius:8px;
    padding:0 30px 0 33px; font-size:13px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; box-sizing:border-box; transition:border-color 150ms;
}
.mbr-search-input:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.mbr-search-clear {
    position:absolute; right:8px; top:50%; transform:translateY(-50%);
    background:none; border:none; cursor:pointer; color:var(--t3); font-size:17px;
    line-height:1; padding:2px; display:flex; align-items:center;
}
.mbr-search-clear:hover { color:var(--t1); }
.mbr-filter-select {
    height:34px; border:1px solid var(--line); border-radius:8px;
    padding:0 10px; font-size:12.5px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; cursor:pointer; transition:border-color 150ms;
    min-width:140px;
}
.mbr-filter-select:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }

/* ── Table ── */
.mbr-tbl-wrap { overflow-x:auto; }
.mbr-tbl { width:100%; border-collapse:collapse; font-size:13px; table-layout:auto; }
.mbr-tbl thead tr { background:#f8f9fc; border-bottom:1px solid var(--line); }
.mbr-tbl th {
    padding:10px 14px; text-align:left; font-size:11.5px; font-weight:700;
    text-transform:uppercase; letter-spacing:.06em; color:var(--t3); white-space:nowrap;
}
.mbr-tbl th.center { text-align:center; }
.mbr-tbl tbody tr { border-bottom:1px solid #f1f3f8; transition:background 80ms; }
.mbr-tbl tbody tr:last-child { border-bottom:none; }
.mbr-tbl tbody tr:hover { background:#f8f9fc; }
.mbr-tbl td { padding:11px 14px; vertical-align:middle; color:var(--t1); }
.mbr-tbl td.center { text-align:center; }
.mbr-tbl td.no { color:var(--t3); font-size:12px; text-align:center; width:44px; }
.mbr-tbl td.muted { color:var(--t3); }
.mbr-tbl .cell-main { font-weight:600; margin-bottom:2px; }
.mbr-tbl .cell-sub { font-size:12px; color:var(--t3); font-weight:400; }
.mbr-tbl .cell-code { font-family:'SF Mono','Fira Code',ui-monospace,monospace; font-size:11.5px; letter-spacing:.02em; }

/* ── Badges ── */
.mbr-badge { display:inline-block; padding:2px 10px; border-radius:999px; font-size:11.5px; font-weight:600; white-space:nowrap; }
.mbr-badge.ok      { background:var(--ok-50); color:var(--ok); }
.mbr-badge.danger  { background:var(--err-50); color:var(--err); }
.mbr-badge.warn    { background:var(--warn-50); color:var(--warn); }
.mbr-badge.gray    { background:#f1f3f8; color:var(--t2); }
.mbr-badge.info    { background:var(--pri-50); color:var(--pri); }

/* ── Action button ── */
.mbr-btn-act {
    padding:5px 12px; border-radius:7px; border:1px solid var(--line-2);
    background:#f8f9fc; color:var(--t2); font:inherit; font-size:12px;
    font-weight:600; cursor:pointer; white-space:nowrap; text-decoration:none;
    display:inline-flex; align-items:center;
    transition:background 120ms, color 120ms, border-color 120ms;
}
.mbr-btn-act:hover { background:var(--pri-50); color:var(--pri); border-color:var(--pri-100); }

/* ── Empty state ── */
.mbr-empty { padding:48px 20px; text-align:center; color:var(--t3); font-size:13.5px; }
.mbr-empty-icon { font-size:32px; margin-bottom:10px; opacity:.4; }

/* ── Pagination ── */
.mbr-pagination {
    display:flex; align-items:center; justify-content:space-between;
    padding:12px 20px; border-top:1px solid var(--line);
    font-size:12.5px; color:var(--t3); flex-wrap:wrap; gap:8px;
}
.mbr-pg-btns { display:flex; gap:4px; flex-wrap:wrap; }
.mbr-pg-btn {
    min-width:30px; height:30px; padding:0 8px; border-radius:7px;
    border:1px solid var(--line); background:white; font-size:12px; font-weight:500;
    color:#0f172a; cursor:pointer; font-family:inherit;
    display:inline-flex; align-items:center; justify-content:center; transition:background 100ms;
}
.mbr-pg-btn:hover:not(.disabled):not(.active) { background:#f5f7fc; }
.mbr-pg-btn.active { background:#1e3a8a; color:white; border-color:#1e3a8a; font-weight:600; }
.mbr-pg-btn.disabled { opacity:.4; cursor:not-allowed; }

@media (max-width:1023px) {
    .mbr-tab { padding:12px 14px; font-size:13px; }
    .mbr-tbl th, .mbr-tbl td { padding:9px 10px; }
    .mbr-card-head { padding:12px 16px; }
    .mbr-header { margin-bottom:14px; }
    .mbr-title { font-size:17px; }
    .mbr-hide-mobile { display:none; }
    .mbr-search-wrap { max-width:100%; min-width:0; flex:1 1 100%; }
    .mbr-search-input { font-size:16px !important; height:40px; }
    .mbr-filter-select { font-size:16px !important; height:40px; flex:1; min-width:0; }
    .mbr-pagination { flex-direction:column; align-items:flex-start; gap:8px; }
}

@media (max-width:767px) {
    /* Judul + tombol aksi ditumpuk, tombol dibuat full-width di bawah judul */
    .mbr-header {
        flex-direction:column; align-items:stretch; gap:10px;
    }
    .mbr-btn-add {
        width:100%; justify-content:center; height:44px; font-size:14px;
    }
}
</style>

<div class="mbr">

    {{-- ── HEADER ── --}}
    <div class="mbr-header">
        <div class="mbr-title">Data anggota</div>
        <a href="{{ $this->getCreateUrl() }}" class="mbr-btn-add">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Anggota
        </a>
    </div>

    {{-- ── MAIN TABS ── --}}
    <div class="mbr-tabs">
        <button type="button" class="mbr-tab {{ $activeTab === 'aktif' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'aktif')">
            Aktif
        </button>
        <button type="button" class="mbr-tab {{ $activeTab === 'nonaktif' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'nonaktif')">
            Nonaktif
        </button>
        <button type="button" class="mbr-tab {{ $activeTab === 'semua' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'semua')">
            Semua
        </button>
    </div>

    <div class="mbr-card">

        @php $data = $this->getData(); @endphp

        <div class="mbr-card-head">
            <span class="mbr-card-count">{{ $data->total() }} data</span>
        </div>

        <div class="mbr-filter-bar">
            <div class="mbr-search-wrap">
                <svg class="mbr-search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" class="mbr-search-input"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari nama atau NIS/NIP..."
                    autocomplete="off">
                @if($search)
                <button class="mbr-search-clear" wire:click="$set('search', '')" type="button">×</button>
                @endif
            </div>

            <select class="mbr-filter-select" wire:model.live="filterJenis">
                <option value="">Semua Jenis</option>
                <option value="siswa">Siswa</option>
                <option value="guru">Guru</option>
            </select>

            <select class="mbr-filter-select" wire:model.live="filterStatus">
                <option value="">Semua Status</option>
                <option value="aktif">Aktif</option>
                <option value="lulus">Lulus</option>
                <option value="pindah">Pindah</option>
                <option value="keluar">Keluar</option>
            </select>
        </div>

        <div style="padding:0;">
            @if($data->total() === 0)
            <div class="mbr-empty">
                <div class="mbr-empty-icon">👥</div>
                <div>Tidak ada data anggota</div>
            </div>
            @else
            <div class="mbr-tbl-wrap">
            <table class="mbr-tbl">
                <thead>
                    <tr>
                        <th class="center mbr-hide-mobile">No</th>
                        <th>Nama Anggota</th>
                        <th>Jenis</th>
                        <th class="mbr-hide-mobile">Kelas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $member)
                    @php
                        $statusClass = match($member->status) {
                            'aktif'  => 'ok',
                            'lulus'  => 'gray',
                            'pindah' => 'warn',
                            'keluar' => 'danger',
                            default  => 'gray',
                        };
                        $statusLabel = match($member->status) {
                            'aktif'  => 'Aktif',
                            'lulus'  => 'Lulus',
                            'pindah' => 'Pindah',
                            'keluar' => 'Keluar',
                            default  => $member->status,
                        };
                    @endphp
                    <tr>
                        <td class="no mbr-hide-mobile">{{ $data->firstItem() + $loop->index }}</td>

                        <td>
                            <div class="cell-main">{{ $member->nama }}</div>
                            <div class="cell-sub cell-code">{{ $member->kode_anggota }}</div>
                        </td>

                        <td>
                            @if($member->jenis === 'guru')
                                <span class="mbr-badge warn">Guru</span>
                            @else
                                <span class="mbr-badge info">Siswa</span>
                            @endif
                        </td>

                        <td class="muted mbr-hide-mobile">
                            {{ $member->kelas ?: '—' }}
                        </td>

                        <td><span class="mbr-badge {{ $statusClass }}">{{ $statusLabel }}</span></td>

                        <td>
                            <a href="{{ $this->getEditUrl($member) }}" class="mbr-btn-act">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            {{-- ── Pagination ── --}}
            @if($data->hasPages())
            <div class="mbr-pagination">
                <span>Menampilkan {{ $data->firstItem() }}–{{ $data->lastItem() }} dari {{ $data->total() }} data</span>
                <div class="mbr-pg-btns">
                    <button class="mbr-pg-btn {{ $data->onFirstPage() ? 'disabled' : '' }}"
                        wire:click="prevPage" {{ $data->onFirstPage() ? 'disabled' : '' }}>‹</button>
                    @foreach($data->getUrlRange(1, $data->lastPage()) as $pg => $url)
                    <button class="mbr-pg-btn {{ $pg == $data->currentPage() ? 'active' : '' }}"
                        wire:click="$set('page', {{ $pg }})">{{ $pg }}</button>
                    @endforeach
                    <button class="mbr-pg-btn {{ !$data->hasMorePages() ? 'disabled' : '' }}"
                        wire:click="nextPage" {{ !$data->hasMorePages() ? 'disabled' : '' }}>›</button>
                </div>
            </div>
            @endif
            @endif
        </div>

    </div>{{-- /.mbr-card --}}

</div>
</x-filament-panels::page>
