<x-filament-panels::page>
<style>
.pmj {
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
.pmj-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; flex-wrap:wrap; gap:10px; }
.pmj-title { font-size:20px; font-weight:800; color:var(--t1); letter-spacing:-.02em; }
.pmj-btn-add {
    height:36px; padding:0 16px; border-radius:8px; border:none;
    background:var(--pri); color:white; font:inherit; font-size:13px; font-weight:600;
    cursor:pointer; display:inline-flex; align-items:center; gap:6px;
    transition:background 120ms; text-decoration:none;
}
.pmj-btn-add:hover { background:var(--pri-2); color:white; }

/* ── Main tabs ── */
.pmj-tabs {
    display:flex; gap:0; background:var(--panel);
    border-radius:var(--r) var(--r) 0 0;
    border:1px solid var(--line); border-bottom:none; overflow:hidden;
}
.pmj-tab {
    flex:1; padding:14px 20px; background:none; border:none; cursor:pointer;
    font:inherit; font-size:13.5px; font-weight:600; color:var(--t3);
    display:flex; align-items:center; justify-content:center; gap:8px;
    transition:color 150ms, background 150ms;
    border-bottom:2px solid transparent; margin-bottom:-1px; position:relative;
}
.pmj-tab:hover { background:#f8f9fc; color:var(--t2); }
.pmj-tab.active { color:var(--pri); border-bottom-color:var(--pri); background:var(--pri-50); }
.pmj-tab-badge {
    background:var(--err); color:white;
    border-radius:999px; font-size:11px; font-weight:700;
    padding:1px 7px; min-width:20px; text-align:center;
}

/* ── Card ── */
.pmj-card {
    background:var(--panel); border:1px solid var(--line);
    border-radius:0 0 var(--r) var(--r); box-shadow:var(--sh); overflow:hidden;
}
.pmj-card-head {
    padding:16px 20px 14px; border-bottom:1px solid var(--line);
    display:flex; align-items:center; gap:8px; flex-wrap:wrap;
}
.pmj-card-title { font-size:14px; font-weight:700; color:var(--t1); }
.pmj-card-count { font-size:12px; color:var(--t3); margin-left:4px; }

/* ── Search bar ── */
.pmj-search-bar { padding:10px 20px; border-bottom:1px solid var(--line); display:flex; align-items:center; }
.pmj-search-wrap { position:relative; width:100%; max-width:320px; }
.pmj-search-icon { position:absolute; left:11px; top:50%; transform:translateY(-50%); color:var(--t3); pointer-events:none; }
.pmj-search-input {
    width:100%; height:34px; border:1px solid var(--line); border-radius:8px;
    padding:0 30px 0 33px; font-size:13px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; box-sizing:border-box; transition:border-color 150ms;
}
.pmj-search-input:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.pmj-search-clear {
    position:absolute; right:8px; top:50%; transform:translateY(-50%);
    background:none; border:none; cursor:pointer; color:var(--t3); font-size:17px;
    line-height:1; padding:2px; display:flex; align-items:center;
}
.pmj-search-clear:hover { color:var(--t1); }

/* ── Table ── */
.pmj-tbl-wrap { overflow-x:auto; }
.pmj-tbl { width:100%; border-collapse:collapse; font-size:13px; table-layout:auto; }
.pmj-tbl thead tr { background:#f8f9fc; border-bottom:1px solid var(--line); }
.pmj-tbl th {
    padding:10px 14px; text-align:left; font-size:11.5px; font-weight:700;
    text-transform:uppercase; letter-spacing:.06em; color:var(--t3); white-space:nowrap;
}
.pmj-tbl th.center { text-align:center; }
.pmj-tbl tbody tr { border-bottom:1px solid #f1f3f8; transition:background 80ms; }
.pmj-tbl tbody tr:last-child { border-bottom:none; }
.pmj-tbl tbody tr:hover { background:#f8f9fc; }
.pmj-tbl td { padding:11px 14px; vertical-align:middle; color:var(--t1); }
.pmj-tbl td.center { text-align:center; }
.pmj-tbl td.no { color:var(--t3); font-size:12px; text-align:center; width:44px; }
.pmj-tbl td.muted { color:var(--t3); }
.pmj-tbl .cell-main { font-weight:600; margin-bottom:2px; }
.pmj-tbl .cell-sub { font-size:12px; color:var(--t3); font-weight:400; }
.pmj-tbl .cell-code { font-family:'SF Mono','Fira Code',ui-monospace,monospace; font-size:11.5px; letter-spacing:.02em; }
.pmj-tbl .cell-red  { color:var(--err); font-weight:600; }

/* ── Badges ── */
.pmj-badge { display:inline-block; padding:2px 10px; border-radius:999px; font-size:11.5px; font-weight:600; white-space:nowrap; }
.pmj-badge.ok      { background:var(--ok-50); color:var(--ok); }
.pmj-badge.danger  { background:var(--err-50); color:var(--err); }
.pmj-badge.warn    { background:var(--warn-50); color:var(--warn); }
.pmj-badge.gray    { background:#f1f3f8; color:var(--t2); }

/* ── Action button ── */
.pmj-btn-act {
    padding:5px 12px; border-radius:7px; border:1px solid var(--line-2);
    background:#f8f9fc; color:var(--t2); font:inherit; font-size:12px;
    font-weight:600; cursor:pointer; white-space:nowrap;
    transition:background 120ms, color 120ms, border-color 120ms;
}
.pmj-btn-act:hover { background:var(--pri-50); color:var(--pri); border-color:var(--pri-100); }

/* ── Empty state ── */
.pmj-empty { padding:48px 20px; text-align:center; color:var(--t3); font-size:13.5px; }
.pmj-empty-icon { font-size:32px; margin-bottom:10px; opacity:.4; }

/* ── Pagination ── */
.pmj-pagination {
    display:flex; align-items:center; justify-content:space-between;
    padding:12px 20px; border-top:1px solid var(--line);
    font-size:12.5px; color:var(--t3); flex-wrap:wrap; gap:8px;
}
.pmj-pg-btns { display:flex; gap:4px; flex-wrap:wrap; }
.pmj-pg-btn {
    min-width:30px; height:30px; padding:0 8px; border-radius:7px;
    border:1px solid var(--line); background:white; font-size:12px; font-weight:500;
    color:#0f172a; cursor:pointer; font-family:inherit;
    display:inline-flex; align-items:center; justify-content:center; transition:background 100ms;
}
.pmj-pg-btn:hover:not(.disabled):not(.active) { background:#f5f7fc; }
.pmj-pg-btn.active { background:#1e3a8a; color:white; border-color:#1e3a8a; font-weight:600; }
.pmj-pg-btn.disabled { opacity:.4; cursor:not-allowed; }

/* ── Modal ── */
.pmj-modal-bg {
    position:fixed; inset:0; background:rgba(15,23,42,.5);
    z-index:9999; display:flex; align-items:flex-start; justify-content:center;
    padding:40px 20px; overflow-y:auto;
}
.pmj-modal {
    background:white; border-radius:14px; width:100%; max-width:520px;
    overflow:hidden; box-shadow:0 20px 48px rgba(15,23,42,.18);
    animation:pmjUp 160ms ease; margin:auto;
}
@keyframes pmjUp { from { transform:translateY(14px); opacity:0; } to { transform:translateY(0); opacity:1; } }
.pmj-modal-head {
    padding:18px 20px 16px; border-bottom:1px solid var(--line);
    display:flex; align-items:center; justify-content:space-between;
}
.pmj-modal-head h3 { margin:0; font-size:15px; font-weight:700; color:var(--t1); }
.pmj-modal-close {
    background:none; border:none; cursor:pointer; color:var(--t3);
    line-height:1; padding:4px; display:flex; align-items:center;
    border-radius:6px; transition:background 120ms;
}
.pmj-modal-close:hover { background:#f1f3f8; color:var(--t1); }
.pmj-modal-body { padding:20px; }
.pmj-modal-foot { padding:0 20px 18px; display:flex; gap:8px; justify-content:flex-end; }
.pmj-btn {
    height:38px; padding:0 16px; border-radius:8px; border:none;
    font:inherit; font-size:13px; font-weight:600; cursor:pointer;
    display:inline-flex; align-items:center; gap:6px; transition:background 120ms;
}
.pmj-btn.secondary { background:white; color:var(--t1); border:1px solid var(--line); }
.pmj-btn.secondary:hover { background:#f5f7fc; }

@media (max-width:1023px) {
    .pmj-tab { padding:12px 14px; font-size:13px; }
    .pmj-tbl th, .pmj-tbl td { padding:9px 10px; }
    .pmj-card-head { padding:12px 16px; }
    .pmj-header { margin-bottom:14px; }
    .pmj-title { font-size:17px; }
    .pmj-hide-mobile { display:none; }
    .pmj-search-wrap { max-width:100%; }
    .pmj-search-input { font-size:16px !important; height:40px; }
    .pmj-modal-bg { padding:16px; align-items:flex-end; }
    .pmj-modal { border-radius:14px 14px 10px 10px; }
    .pmj-modal-foot { flex-direction:column-reverse; }
    .pmj-modal-foot .pmj-btn { width:100%; justify-content:center; height:44px; }
    .pmj-pagination { flex-direction:column; align-items:flex-start; gap:8px; }
}
</style>

<div class="pmj">

    {{-- ── HEADER ── --}}
    <div class="pmj-header">
        <div class="pmj-title">Peminjaman Buku</div>
        <a href="/admin/catat-peminjaman" class="pmj-btn-add">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Catat Peminjaman
        </a>
    </div>

    {{-- ── MAIN TABS ── --}}
    <div class="pmj-tabs">
        <button type="button" class="pmj-tab {{ $activeTab === 'aktif' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'aktif')">
            Aktif
            @if($aktifCount > 0)<span class="pmj-tab-badge">{{ $aktifCount }}</span>@endif
        </button>
        <button type="button" class="pmj-tab {{ $activeTab === 'terlambat' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'terlambat')">
            Terlambat
            @if($terlambatCount > 0)<span class="pmj-tab-badge">{{ $terlambatCount }}</span>@endif
        </button>
        <button type="button" class="pmj-tab {{ $activeTab === 'semua' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'semua')">
            Semua
        </button>
    </div>

    <div class="pmj-card">

        @php $data = $this->getData(); @endphp

        <div class="pmj-card-head">
            <span class="pmj-card-title">
                @if($activeTab === 'aktif') Peminjaman Aktif
                @elseif($activeTab === 'terlambat') Sedang Terlambat
                @else Semua Peminjaman Aktif
                @endif
            </span>
            <span class="pmj-card-count">{{ $data->total() }} data</span>
        </div>

        <div class="pmj-search-bar">
            <div class="pmj-search-wrap">
                <svg class="pmj-search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" class="pmj-search-input"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari nama anggota atau judul buku..."
                    autocomplete="off">
                @if($search)
                <button class="pmj-search-clear" wire:click="$set('search', '')" type="button">×</button>
                @endif
            </div>
        </div>

        <div style="padding:0;">
            @if($data->total() === 0)
            <div class="pmj-empty">
                <div class="pmj-empty-icon">📚</div>
                <div>Tidak ada data peminjaman</div>
            </div>
            @else
            <div class="pmj-tbl-wrap">
            <table class="pmj-tbl">
                <thead>
                    <tr>
                        <th class="center pmj-hide-mobile">No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Batas Kembali</th>
                        <th class="pmj-hide-mobile">Terlambat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $loan)
                    @php
                        $isLate = $loan->tgl_batas_kembali?->lt(\Carbon\Carbon::today()) && $loan->status !== 'dikembalikan';
                        $hariLate = ($loan->status !== 'dikembalikan') ? $loan->jumlahHariTerlambat() : null;
                        $statusClass = match($loan->status) {
                            'dipinjam'     => 'warn',
                            'dikembalikan' => 'ok',
                            'terlambat'    => 'danger',
                            default        => 'gray',
                        };
                        $statusLabel = match($loan->status) {
                            'dipinjam'     => 'Dipinjam',
                            'dikembalikan' => 'Dikembalikan',
                            'terlambat'    => 'Terlambat',
                            default        => $loan->status,
                        };
                    @endphp
                    <tr>
                        <td class="no pmj-hide-mobile">{{ $data->firstItem() + $loop->index }}</td>

                        <td>
                            <div class="cell-main">{{ $loan->member?->nama ?? '—' }}</div>
                            <div class="cell-sub cell-code">
                                {{ $loan->member?->kode_anggota }}
                                @if($loan->member?->kelas) · Kelas {{ $loan->member->kelas }} @endif
                            </div>
                        </td>

                        <td>
                            <div class="cell-main">{{ $loan->book?->judul ?? '—' }}</div>
                            <div class="cell-sub cell-code">{{ $loan->book?->kode_buku }}</div>
                        </td>

                        <td style="white-space:nowrap;">
                            @if($isLate)
                                <span class="cell-red">{{ $loan->tgl_batas_kembali?->translatedFormat('d M Y') ?? '—' }}</span>
                            @else
                                {{ $loan->tgl_batas_kembali?->translatedFormat('d M Y') ?? '—' }}
                            @endif
                        </td>

                        <td class="pmj-hide-mobile">
                            @if($hariLate && $hariLate > 0)
                                <span class="cell-red">+{{ $hariLate }} hari</span>
                            @else
                                <span class="muted">—</span>
                            @endif
                        </td>

                        <td><span class="pmj-badge {{ $statusClass }}">{{ $statusLabel }}</span></td>

                        <td>
                            <button type="button" class="pmj-btn-act"
                                wire:click="bukaDetail({{ $loan->id }})">Detail</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            {{-- ── Pagination ── --}}
            @if($data->hasPages())
            <div class="pmj-pagination">
                <span>Menampilkan {{ $data->firstItem() }}–{{ $data->lastItem() }} dari {{ $data->total() }} data</span>
                <div class="pmj-pg-btns">
                    <button class="pmj-pg-btn {{ $data->onFirstPage() ? 'disabled' : '' }}"
                        wire:click="prevPage" {{ $data->onFirstPage() ? 'disabled' : '' }}>‹</button>
                    @foreach($data->getUrlRange(1, $data->lastPage()) as $pg => $url)
                    <button class="pmj-pg-btn {{ $pg == $data->currentPage() ? 'active' : '' }}"
                        wire:click="$set('page', {{ $pg }})">{{ $pg }}</button>
                    @endforeach
                    <button class="pmj-pg-btn {{ !$data->hasMorePages() ? 'disabled' : '' }}"
                        wire:click="nextPage" {{ !$data->hasMorePages() ? 'disabled' : '' }}>›</button>
                </div>
            </div>
            @endif
            @endif
        </div>

    </div>{{-- /.pmj-card --}}

    {{-- ── MODAL DETAIL ── --}}
    @if($showModalDetail)
    <div class="pmj-modal-bg" wire:click.self="tutupDetail">
        <div class="pmj-modal">
            <div class="pmj-modal-head">
                <h3>Detail Peminjaman</h3>
                <button type="button" class="pmj-modal-close" wire:click="tutupDetail">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
            <div class="pmj-modal-body">
                @php $detailRecord = $this->getLoanDetail(); @endphp
                @if($detailRecord)
                    @include('filament.admin.partials.loan-detail', ['record' => $detailRecord])
                @endif
            </div>
            <div class="pmj-modal-foot">
                <button type="button" class="pmj-btn secondary" wire:click="tutupDetail">Tutup</button>
            </div>
        </div>
    </div>
    @endif

</div>
</x-filament-panels::page>
