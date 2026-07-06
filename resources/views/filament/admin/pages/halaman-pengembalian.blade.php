<x-filament-panels::page>
<style>
.kbl {
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
.kbl-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; flex-wrap:wrap; gap:10px; }
.kbl-title { font-size:20px; font-weight:800; color:var(--t1); letter-spacing:-.02em; }
.kbl-btn-add {
    height:36px; padding:0 16px; border-radius:8px; border:none;
    background:var(--pri); color:white; font:inherit; font-size:13px; font-weight:600;
    cursor:pointer; display:inline-flex; align-items:center; gap:6px;
    transition:background 120ms; text-decoration:none;
}
.kbl-btn-add:hover { background:var(--pri-2); color:white; }

/* ── Main tabs ── */
.kbl-tabs {
    display:flex; gap:0; background:var(--panel);
    border-radius:var(--r) var(--r) 0 0;
    border:1px solid var(--line); border-bottom:none; overflow:hidden;
}
.kbl-tab {
    flex:1; padding:14px 20px; background:none; border:none; cursor:pointer;
    font:inherit; font-size:13.5px; font-weight:600; color:var(--t3);
    display:flex; align-items:center; justify-content:center; gap:8px;
    transition:color 150ms, background 150ms;
    border-bottom:2px solid transparent; margin-bottom:-1px; position:relative;
}
.kbl-tab:hover { background:#f8f9fc; color:var(--t2); }
.kbl-tab.active { color:var(--pri); border-bottom-color:var(--pri); background:var(--pri-50); }
.kbl-tab-badge {
    background:var(--err); color:white;
    border-radius:999px; font-size:11px; font-weight:700;
    padding:1px 7px; min-width:20px; text-align:center;
}

/* ── Card ── */
.kbl-card {
    background:var(--panel); border:1px solid var(--line);
    border-radius:0 0 var(--r) var(--r); box-shadow:var(--sh); overflow:hidden;
}
.kbl-card-head {
    padding:16px 20px 14px; border-bottom:1px solid var(--line);
    display:flex; align-items:center; gap:8px; flex-wrap:wrap;
}
.kbl-card-title { font-size:14px; font-weight:700; color:var(--t1); }
.kbl-card-count { font-size:12px; color:var(--t3); margin-left:4px; }

/* ── Search bar ── */
.kbl-search-bar { padding:10px 20px; border-bottom:1px solid var(--line); display:flex; align-items:center; }
.kbl-search-wrap { position:relative; width:100%; max-width:320px; }
.kbl-search-icon { position:absolute; left:11px; top:50%; transform:translateY(-50%); color:var(--t3); pointer-events:none; }
.kbl-search-input {
    width:100%; height:34px; border:1px solid var(--line); border-radius:8px;
    padding:0 30px 0 33px; font-size:13px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; box-sizing:border-box; transition:border-color 150ms;
}
.kbl-search-input:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.kbl-search-clear {
    position:absolute; right:8px; top:50%; transform:translateY(-50%);
    background:none; border:none; cursor:pointer; color:var(--t3); font-size:17px;
    line-height:1; padding:2px; display:flex; align-items:center;
}
.kbl-search-clear:hover { color:var(--t1); }

/* ── Table ── */
.kbl-tbl-wrap { overflow-x:auto; }
.kbl-tbl { width:100%; border-collapse:collapse; font-size:13px; table-layout:auto; }
.kbl-tbl thead tr { background:#f8f9fc; border-bottom:1px solid var(--line); }
.kbl-tbl th {
    padding:10px 14px; text-align:left; font-size:11.5px; font-weight:700;
    text-transform:uppercase; letter-spacing:.06em; color:var(--t3); white-space:nowrap;
}
.kbl-tbl th.center { text-align:center; }
.kbl-tbl tbody tr { border-bottom:1px solid #f1f3f8; transition:background 80ms; }
.kbl-tbl tbody tr:last-child { border-bottom:none; }
.kbl-tbl tbody tr:hover { background:#f8f9fc; }
.kbl-tbl td { padding:11px 14px; vertical-align:middle; color:var(--t1); }
.kbl-tbl td.center { text-align:center; }
.kbl-tbl td.no { color:var(--t3); font-size:12px; text-align:center; width:44px; }
.kbl-tbl td.muted { color:var(--t3); }
.kbl-tbl .cell-main { font-weight:600; margin-bottom:2px; }
.kbl-tbl .cell-sub { font-size:12px; color:var(--t3); font-weight:400; }
.kbl-tbl .cell-code { font-family:'SF Mono','Fira Code',ui-monospace,monospace; font-size:11.5px; letter-spacing:.02em; }
.kbl-tbl .cell-red  { color:var(--err); font-weight:600; }

/* ── Badges ── */
.kbl-badge { display:inline-block; padding:2px 10px; border-radius:999px; font-size:11.5px; font-weight:600; white-space:nowrap; }
.kbl-badge.ok      { background:var(--ok-50); color:var(--ok); }
.kbl-badge.danger  { background:var(--err-50); color:var(--err); }
.kbl-badge.warn    { background:var(--warn-50); color:var(--warn); }
.kbl-badge.gray    { background:#f1f3f8; color:var(--t2); }

/* ── Action buttons ── */
.kbl-btn-act {
    padding:5px 12px; border-radius:7px; border:1px solid var(--line-2);
    background:#f8f9fc; color:var(--t2); font:inherit; font-size:12px;
    font-weight:600; cursor:pointer; white-space:nowrap; text-decoration:none;
    display:inline-flex; align-items:center;
    transition:background 120ms, color 120ms, border-color 120ms;
}
.kbl-btn-act:hover { background:var(--pri-50); color:var(--pri); border-color:var(--pri-100); }
.kbl-btn-kembalikan {
    padding:5px 12px; border-radius:7px;
    border:1px solid #86efac; background:var(--ok-50); color:var(--ok);
    font:inherit; font-size:12px; font-weight:600; cursor:pointer;
    white-space:nowrap; text-decoration:none; display:inline-flex; align-items:center;
    transition:background 120ms;
}
.kbl-btn-kembalikan:hover { background:var(--ok); color:white; border-color:var(--ok); }

/* ── Empty state ── */
.kbl-empty { padding:48px 20px; text-align:center; color:var(--t3); font-size:13.5px; }
.kbl-empty-icon { font-size:32px; margin-bottom:10px; opacity:.4; }

/* ── Pagination ── */
.kbl-pagination {
    display:flex; align-items:center; justify-content:space-between;
    padding:12px 20px; border-top:1px solid var(--line);
    font-size:12.5px; color:var(--t3); flex-wrap:wrap; gap:8px;
}
.kbl-pg-btns { display:flex; gap:4px; flex-wrap:wrap; }
.kbl-pg-btn {
    min-width:30px; height:30px; padding:0 8px; border-radius:7px;
    border:1px solid var(--line); background:white; font-size:12px; font-weight:500;
    color:#0f172a; cursor:pointer; font-family:inherit;
    display:inline-flex; align-items:center; justify-content:center; transition:background 100ms;
}
.kbl-pg-btn:hover:not(.disabled):not(.active) { background:#f5f7fc; }
.kbl-pg-btn.active { background:#1e3a8a; color:white; border-color:#1e3a8a; font-weight:600; }
.kbl-pg-btn.disabled { opacity:.4; cursor:not-allowed; }

/* ── Modal ── */
.kbl-modal-bg {
    position:fixed; inset:0; background:rgba(15,23,42,.5);
    z-index:9999; display:flex; align-items:flex-start; justify-content:center;
    padding:40px 20px; overflow-y:auto;
}
.kbl-modal {
    background:white; border-radius:14px; width:100%; max-width:520px;
    overflow:hidden; box-shadow:0 20px 48px rgba(15,23,42,.18);
    animation:kblUp 160ms ease; margin:auto;
}
@keyframes kblUp { from { transform:translateY(14px); opacity:0; } to { transform:translateY(0); opacity:1; } }
.kbl-modal-head {
    padding:18px 20px 16px; border-bottom:1px solid var(--line);
    display:flex; align-items:center; justify-content:space-between;
}
.kbl-modal-head h3 { margin:0; font-size:15px; font-weight:700; color:var(--t1); }
.kbl-modal-close {
    background:none; border:none; cursor:pointer; color:var(--t3);
    line-height:1; padding:4px; display:flex; align-items:center;
    border-radius:6px; transition:background 120ms;
}
.kbl-modal-close:hover { background:#f1f3f8; color:var(--t1); }
.kbl-modal-body { padding:20px; }
.kbl-modal-foot { padding:0 20px 18px; display:flex; gap:8px; justify-content:flex-end; }
.kbl-btn {
    height:38px; padding:0 16px; border-radius:8px; border:none;
    font:inherit; font-size:13px; font-weight:600; cursor:pointer;
    display:inline-flex; align-items:center; gap:6px; transition:background 120ms;
}
.kbl-btn.secondary { background:white; color:var(--t1); border:1px solid var(--line); }
.kbl-btn.secondary:hover { background:#f5f7fc; }

@media (max-width:1023px) {
    .kbl-tab { padding:12px 14px; font-size:13px; }
    .kbl-tbl th, .kbl-tbl td { padding:9px 10px; }
    .kbl-card-head { padding:12px 16px; }
    .kbl-header { margin-bottom:14px; }
    .kbl-title { font-size:17px; }
    .kbl-hide-mobile { display:none; }
    .kbl-search-wrap { max-width:100%; }
    .kbl-search-input { font-size:16px !important; height:40px; }
    .kbl-modal-bg { padding:16px; align-items:flex-end; }
    .kbl-modal { border-radius:14px 14px 10px 10px; }
    .kbl-modal-foot { flex-direction:column-reverse; }
    .kbl-modal-foot .kbl-btn { width:100%; justify-content:center; height:44px; }
    .kbl-pagination { flex-direction:column; align-items:flex-start; gap:8px; }
}
</style>

<div class="kbl">

    {{-- ── HEADER ── --}}
    <div class="kbl-header">
        <div class="kbl-title">Pengembalian Buku</div>
        <a href="/admin/proses-pengembalian" class="kbl-btn-add">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 12h18M12 3l-9 9 9 9"/></svg>
            Proses Pengembalian
        </a>
    </div>

    {{-- ── MAIN TABS ── --}}
    <div class="kbl-tabs">
        <button type="button" class="kbl-tab {{ $activeTab === 'perlu' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'perlu')">
            Perlu Dikembalikan
            @if($perluCount > 0)<span class="kbl-tab-badge">{{ $perluCount }}</span>@endif
        </button>
        <button type="button" class="kbl-tab {{ $activeTab === 'riwayat' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'riwayat')">
            Riwayat Pengembalian
        </button>
    </div>

    <div class="kbl-card">

        @php $data = $this->getData(); @endphp

        <div class="kbl-card-head">
            <span class="kbl-card-title">
                @if($activeTab === 'perlu') Belum Dikembalikan
                @else Sudah Dikembalikan
                @endif
            </span>
            <span class="kbl-card-count">{{ $data->total() }} data</span>
        </div>

        <div class="kbl-search-bar">
            <div class="kbl-search-wrap">
                <svg class="kbl-search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" class="kbl-search-input"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari nama anggota atau judul buku..."
                    autocomplete="off">
                @if($search)
                <button class="kbl-search-clear" wire:click="$set('search', '')" type="button">×</button>
                @endif
            </div>
        </div>

        <div style="padding:0;">
            @if($data->total() === 0)
            <div class="kbl-empty">
                <div class="kbl-empty-icon">📋</div>
                <div>Tidak ada data</div>
            </div>
            @elseif($activeTab === 'perlu')
            {{-- ══ TAB: PERLU DIKEMBALIKAN ══ --}}
            <div class="kbl-tbl-wrap">
            <table class="kbl-tbl">
                <thead>
                    <tr>
                        <th class="center kbl-hide-mobile">No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th class="kbl-hide-mobile">Tgl Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Terlambat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $loan)
                    @php
                        $isLate = $loan->tgl_batas_kembali?->lt(\Carbon\Carbon::today());
                        $hariLate = $loan->jumlahHariTerlambat();
                        $statusClass = $loan->status === 'terlambat' ? 'danger' : 'warn';
                        $statusLabel = $loan->status === 'terlambat' ? 'Terlambat' : 'Dipinjam';
                    @endphp
                    <tr>
                        <td class="no kbl-hide-mobile">{{ $data->firstItem() + $loop->index }}</td>

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

                        <td class="muted kbl-hide-mobile" style="white-space:nowrap;">
                            {{ $loan->tgl_pinjam?->translatedFormat('d M Y') ?? '—' }}
                        </td>

                        <td style="white-space:nowrap;">
                            @if($isLate)
                                <span class="cell-red">{{ $loan->tgl_batas_kembali?->translatedFormat('d M Y') ?? '—' }}</span>
                            @else
                                {{ $loan->tgl_batas_kembali?->translatedFormat('d M Y') ?? '—' }}
                            @endif
                        </td>

                        <td>
                            @if($hariLate > 0)
                                <span class="cell-red">+{{ $hariLate }} hari</span>
                            @else
                                <span class="muted">—</span>
                            @endif
                        </td>

                        <td><span class="kbl-badge {{ $statusClass }}">{{ $statusLabel }}</span></td>

                        <td>
                            <a href="/admin/proses-pengembalian" class="kbl-btn-kembalikan">Kembalikan</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            @else
            {{-- ══ TAB: RIWAYAT PENGEMBALIAN ══ --}}
            <div class="kbl-tbl-wrap">
            <table class="kbl-tbl">
                <thead>
                    <tr>
                        <th class="center kbl-hide-mobile">No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th class="kbl-hide-mobile">Tgl Pinjam</th>
                        <th>Tgl Dikembalikan</th>
                        <th class="kbl-hide-mobile">Kondisi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $loan)
                    @php
                        $kondisiClass = match($loan->kondisi_kembali) {
                            'baik'   => 'ok',
                            'rusak'  => 'warn',
                            'hilang' => 'danger',
                            default  => 'gray',
                        };
                        $kondisiLabel = match($loan->kondisi_kembali) {
                            'baik'   => 'Baik',
                            'rusak'  => 'Rusak',
                            'hilang' => 'Hilang',
                            default  => '—',
                        };
                    @endphp
                    <tr>
                        <td class="no kbl-hide-mobile">{{ $data->firstItem() + $loop->index }}</td>

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

                        <td class="muted kbl-hide-mobile" style="white-space:nowrap;">
                            {{ $loan->tgl_pinjam?->translatedFormat('d M Y') ?? '—' }}
                        </td>

                        <td style="white-space:nowrap;">
                            {{ $loan->tgl_kembali?->translatedFormat('d M Y') ?? '—' }}
                        </td>

                        <td class="kbl-hide-mobile">
                            @if($loan->kondisi_kembali)
                                <span class="kbl-badge {{ $kondisiClass }}">{{ $kondisiLabel }}</span>
                            @else
                                <span class="muted">—</span>
                            @endif
                        </td>

                        <td><span class="kbl-badge ok">Dikembalikan</span></td>

                        <td>
                            <button type="button" class="kbl-btn-act"
                                wire:click="bukaDetail({{ $loan->id }})">Detail</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            @endif

            {{-- ── Pagination ── --}}
            @if($data->hasPages())
            <div class="kbl-pagination">
                <span>Menampilkan {{ $data->firstItem() }}–{{ $data->lastItem() }} dari {{ $data->total() }} data</span>
                <div class="kbl-pg-btns">
                    <button class="kbl-pg-btn {{ $data->onFirstPage() ? 'disabled' : '' }}"
                        wire:click="prevPage" {{ $data->onFirstPage() ? 'disabled' : '' }}>‹</button>
                    @foreach($data->getUrlRange(1, $data->lastPage()) as $pg => $url)
                    <button class="kbl-pg-btn {{ $pg == $data->currentPage() ? 'active' : '' }}"
                        wire:click="$set('page', {{ $pg }})">{{ $pg }}</button>
                    @endforeach
                    <button class="kbl-pg-btn {{ !$data->hasMorePages() ? 'disabled' : '' }}"
                        wire:click="nextPage" {{ !$data->hasMorePages() ? 'disabled' : '' }}>›</button>
                </div>
            </div>
            @endif
        </div>

    </div>{{-- /.kbl-card --}}

    {{-- ── MODAL DETAIL (tab riwayat) ── --}}
    @if($showModalDetail)
    <div class="kbl-modal-bg" wire:click.self="tutupDetail">
        <div class="kbl-modal">
            <div class="kbl-modal-head">
                <h3>Detail Pengembalian</h3>
                <button type="button" class="kbl-modal-close" wire:click="tutupDetail">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
            <div class="kbl-modal-body">
                @php $detailRecord = $this->getLoanDetail(); @endphp
                @if($detailRecord)
                    @include('filament.admin.partials.loan-detail', ['record' => $detailRecord])
                @endif
            </div>
            <div class="kbl-modal-foot">
                <button type="button" class="kbl-btn secondary" wire:click="tutupDetail">Tutup</button>
            </div>
        </div>
    </div>
    @endif

</div>
</x-filament-panels::page>
