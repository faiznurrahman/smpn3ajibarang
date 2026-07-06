<x-filament-panels::page>
<style>
.plg {
    --pri:#1e3a8a; --pri-2:#2746a4; --pri-50:#eef2ff; --pri-100:#dbe3ff;
    --ok:#16a34a;  --ok-50:#e6f7ed;
    --warn:#b45309; --warn-50:#fffbeb;
    --err:#dc2626; --err-50:#fee2e2;
    --t1:#0f172a; --t2:#5a6478; --t3:#8b94a6;
    --line:#e6eaf2; --line-2:#d4dae6;
    --panel:#fff;
    --r:14px; --sh:0 1px 2px rgba(15,23,42,.04);
}

/* ── Main tabs ── */
.plg-tabs {
    display:flex; gap:0; border-bottom:2px solid var(--line);
    margin-bottom:16px; background:var(--panel);
    border-radius:var(--r) var(--r) 0 0;
    border:1px solid var(--line); border-bottom:none;
    overflow:hidden;
}
.plg-tab {
    flex:1; padding:14px 20px; background:none; border:none; cursor:pointer;
    font:inherit; font-size:13.5px; font-weight:600; color:var(--t3);
    display:flex; align-items:center; justify-content:center; gap:8px;
    transition:color 150ms, background 150ms;
    border-bottom:2px solid transparent; margin-bottom:-2px;
    position:relative;
}
.plg-tab:hover { background:#f8f9fc; color:var(--t2); }
.plg-tab.active {
    color:var(--pri); border-bottom-color:var(--pri);
    background:var(--pri-50);
}
.plg-tab-badge {
    background:var(--err); color:white;
    border-radius:999px; font-size:11px; font-weight:700;
    padding:1px 7px; min-width:20px; text-align:center;
}

/* ── Card ── */
.plg-card {
    background:var(--panel); border:1px solid var(--line);
    border-radius:0 0 var(--r) var(--r);
    box-shadow:var(--sh); overflow:hidden;
}
.plg-card-head {
    padding:16px 20px 14px; border-bottom:1px solid var(--line);
    display:flex; align-items:center; gap:8px; flex-wrap:wrap;
}
.plg-card-title { font-size:14px; font-weight:700; color:var(--t1); }
.plg-card-body { padding:0; }

/* ── Sub-filter pills ── */
.plg-filters { display:flex; gap:6px; align-items:center; flex-wrap:wrap; }
.plg-filter-pill {
    height:28px; padding:0 12px; border-radius:6px; font-size:12px; font-weight:600;
    cursor:pointer; border:1.5px solid var(--line); background:white;
    color:var(--t2); font:inherit; transition:all 120ms;
    display:inline-flex; align-items:center;
}
.plg-filter-pill:hover { background:#f5f7fc; border-color:var(--line-2); }
.plg-filter-pill.active { background:var(--pri); color:white; border-color:var(--pri); }
.plg-filter-pill.danger { background:var(--err-50); color:var(--err); border-color:#fca5a5; }
.plg-filter-pill.success { background:var(--ok-50); color:var(--ok); border-color:#86efac; }

/* ── Search bar ── */
.plg-search-bar { padding:10px 20px; border-bottom:1px solid var(--line); display:flex; align-items:center; }
.plg-search-wrap { position:relative; width:100%; max-width:320px; }
.plg-search-icon { position:absolute; left:11px; top:50%; transform:translateY(-50%); color:var(--t3); pointer-events:none; }
.plg-search-input {
    width:100%; height:34px; border:1px solid var(--line); border-radius:8px;
    padding:0 30px 0 33px; font-size:13px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; box-sizing:border-box; transition:border-color 150ms;
}
.plg-search-input:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.plg-search-clear {
    position:absolute; right:8px; top:50%; transform:translateY(-50%);
    background:none; border:none; cursor:pointer; color:var(--t3); font-size:17px;
    line-height:1; padding:2px; display:flex; align-items:center;
}
.plg-search-clear:hover { color:var(--t1); }

/* ── Table ── */
.plg-tbl-wrap { overflow-x:auto; }
.plg-tbl {
    width:100%; border-collapse:collapse; font-size:13px;
    table-layout:auto;
}
.plg-tbl thead tr { background:#f8f9fc; border-bottom:1px solid var(--line); }
.plg-tbl th {
    padding:10px 14px; text-align:left; font-size:11.5px; font-weight:700;
    text-transform:uppercase; letter-spacing:.06em; color:var(--t3);
    white-space:nowrap;
}
.plg-tbl th.center { text-align:center; }
.plg-tbl tbody tr { border-bottom:1px solid #f1f3f8; transition:background 80ms; }
.plg-tbl tbody tr:last-child { border-bottom:none; }
.plg-tbl tbody tr:hover { background:#f8f9fc; }
.plg-tbl td { padding:11px 14px; vertical-align:middle; color:var(--t1); }
.plg-tbl td.center { text-align:center; }
.plg-tbl td.no { color:var(--t3); font-size:12px; text-align:center; width:44px; }
.plg-tbl td.muted { color:var(--t3); }
.plg-tbl .cell-main { font-weight:600; margin-bottom:2px; }
.plg-tbl .cell-sub { font-size:12px; color:var(--t3); font-weight:400; }
.plg-tbl .cell-code { font-family:'SF Mono','Fira Code',ui-monospace,monospace; font-size:11.5px; letter-spacing:.02em; }
.plg-tbl .cell-red  { color:var(--err); font-weight:600; }
.plg-tbl .cell-warn { color:var(--warn); font-weight:600; }

/* ── Badge ── */
.plg-badge {
    display:inline-block; padding:2px 10px; border-radius:999px;
    font-size:11.5px; font-weight:600; white-space:nowrap;
}
.plg-badge.ok     { background:var(--ok-50); color:var(--ok); }
.plg-badge.danger { background:var(--err-50); color:var(--err); }
.plg-badge.warn   { background:var(--warn-50); color:var(--warn); }
.plg-badge.gray   { background:#f1f3f8; color:var(--t2); }

/* ── Action button ── */
.plg-btn-act {
    padding:5px 12px; border-radius:7px; border:1px solid var(--ok);
    background:var(--ok-50); color:var(--ok); font:inherit; font-size:12px;
    font-weight:600; cursor:pointer; white-space:nowrap;
    transition:background 120ms;
}
.plg-btn-act:hover { background:var(--ok); color:white; }

/* ── Empty state ── */
.plg-empty { padding:48px 20px; text-align:center; color:var(--t3); font-size:13.5px; }
.plg-empty-icon { font-size:32px; margin-bottom:10px; opacity:.4; }

/* ── Pagination ── */
.plg-pagination {
    display:flex; align-items:center; justify-content:space-between;
    padding:12px 20px; border-top:1px solid var(--line);
    font-size:12.5px; color:var(--t3); flex-wrap:wrap; gap:8px;
}
.plg-pg-btns { display:flex; gap:4px; flex-wrap:wrap; }
.plg-pg-btn {
    min-width:30px; height:30px; padding:0 8px; border-radius:7px;
    border:1px solid var(--line); background:white; font-size:12px; font-weight:500;
    color:#0f172a; cursor:pointer; font-family:inherit;
    display:inline-flex; align-items:center; justify-content:center; transition:background 100ms;
}
.plg-pg-btn:hover:not(.disabled):not(.active) { background:#f5f7fc; }
.plg-pg-btn.active { background:#1e3a8a; color:white; border-color:#1e3a8a; font-weight:600; }
.plg-pg-btn.disabled { opacity:.4; cursor:not-allowed; }

/* ── Modal ── */
.plg-modal-bg {
    position:fixed; inset:0; background:rgba(15,23,42,.5);
    z-index:9999; display:flex; align-items:center; justify-content:center; padding:20px;
}
.plg-modal {
    background:white; border-radius:14px; width:100%; max-width:380px;
    overflow:hidden; box-shadow:0 20px 48px rgba(15,23,42,.18);
    animation:plgUp 160ms ease;
}
@keyframes plgUp {
    from { transform:translateY(14px); opacity:0; }
    to   { transform:translateY(0); opacity:1; }
}
.plg-modal-head { padding:18px 20px 16px; border-bottom:1px solid var(--line); }
.plg-modal-head h3 { margin:0 0 3px; font-size:15px; font-weight:700; color:var(--t1); }
.plg-modal-head p  { margin:0; font-size:12.5px; color:var(--t3); }
.plg-modal-body { padding:18px 20px; }
.plg-modal-foot { padding:0 20px 18px; display:flex; gap:8px; justify-content:flex-end; }

.plg-label { display:block; font-size:12.5px; font-weight:600; color:var(--t2); margin-bottom:6px; }
.plg-input {
    width:100%; height:40px; border:1px solid var(--line); border-radius:8px;
    padding:0 12px; font-size:13.5px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; box-sizing:border-box;
    transition:border-color 150ms;
}
.plg-input:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.plg-textarea {
    width:100%; border:1px solid var(--line); border-radius:8px;
    padding:10px 12px; font-size:13.5px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; resize:vertical; min-height:68px;
    box-sizing:border-box; transition:border-color 150ms;
}
.plg-textarea:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }

.plg-mfield + .plg-mfield { margin-top:14px; }

.plg-btn {
    height:38px; padding:0 16px; border-radius:8px; border:none;
    font:inherit; font-size:13px; font-weight:600; cursor:pointer;
    display:inline-flex; align-items:center; gap:6px; transition:background 120ms;
}
.plg-btn.primary { background:var(--ok); color:white; }
.plg-btn.primary:hover { background:#15803d; }
.plg-btn.secondary { background:white; color:var(--t1); border:1px solid var(--line); }
.plg-btn.secondary:hover { background:#f5f7fc; }

@keyframes spin { to { transform:rotate(360deg); } }

@media (max-width:1023px) {
    .plg-tab { padding:12px 14px; font-size:13px; }
    .plg-tbl th, .plg-tbl td { padding:9px 10px; }
    .plg-card-head { padding:12px 16px 12px; }
    .plg-input { font-size:16px !important; height:44px; }
    .plg-textarea { font-size:16px !important; }
    .plg-modal-foot { flex-direction:column-reverse; }
    .plg-modal-foot .plg-btn { width:100%; justify-content:center; height:44px; }
    .plg-hide-mobile { display:none; }
    .plg-search-wrap { max-width:100%; }
    .plg-search-input { font-size:16px !important; height:40px; }
    .plg-pagination { flex-direction:column; align-items:flex-start; gap:8px; }
}
</style>

<div class="plg">

    {{-- ── MAIN TABS ── --}}
    <div class="plg-tabs">
        <button
            type="button"
            class="plg-tab {{ $activeTab === 'denda' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'denda')"
        >
            Denda Keterlambatan
            @if($dendaBelumLunas > 0)
            <span class="plg-tab-badge">{{ $dendaBelumLunas }}</span>
            @endif
        </button>

        <button
            type="button"
            class="plg-tab {{ $activeTab === 'sanksi' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'sanksi')"
        >
            Sanksi Buku
            @if($sanksiBelumLunas > 0)
            <span class="plg-tab-badge">{{ $sanksiBelumLunas }}</span>
            @endif
        </button>
    </div>

    <div class="plg-card">

        {{-- ════════════════ TAB 1: DENDA ════════════════ --}}
        @if($activeTab === 'denda')
        @php $dendaRows = $this->getDendaData(); @endphp

        <div class="plg-card-head">
            <span class="plg-card-title">Denda Keterlambatan</span>
            <div class="plg-filters" style="margin-left:auto;">
                <button type="button" class="plg-filter-pill {{ $filterDenda === 'belum_lunas' ? 'danger' : '' }}"
                    wire:click="$set('filterDenda', 'belum_lunas')">Belum Lunas</button>
                <button type="button" class="plg-filter-pill {{ $filterDenda === 'lunas' ? 'success' : '' }}"
                    wire:click="$set('filterDenda', 'lunas')">Lunas</button>
            </div>
        </div>

        <div class="plg-search-bar">
            <div class="plg-search-wrap">
                <svg class="plg-search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input
                    type="text"
                    class="plg-search-input"
                    wire:model.live.debounce.300ms="searchDenda"
                    placeholder="Cari nama anggota..."
                    autocomplete="off"
                >
                @if($searchDenda)
                <button class="plg-search-clear" wire:click="$set('searchDenda', '')" type="button" title="Hapus pencarian">×</button>
                @endif
            </div>
        </div>

        <div class="plg-card-body">
            @if($dendaRows->total() === 0)
            <div class="plg-empty">
                <div class="plg-empty-icon">📋</div>
                <div>Tidak ada data denda</div>
            </div>
            @else
            <div class="plg-tbl-wrap">
            <table class="plg-tbl">
                <thead>
                    <tr>
                        <th class="center plg-hide-mobile">No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th class="plg-hide-mobile">Tgl Kembali</th>
                        <th class="plg-hide-mobile">Keterlambatan</th>
                        <th>Nominal</th>
                        <th>Status</th>
                        <th class="plg-hide-mobile">Tgl Bayar</th>
                        @if(!$this->isReadOnly())<th>Aksi</th>@endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($dendaRows as $fine)
                    <tr>
                        <td class="no plg-hide-mobile">{{ $dendaRows->firstItem() + $loop->index }}</td>

                        <td>
                            <div class="cell-main">{{ $fine->loan?->member?->nama ?? '—' }}</div>
                            <div class="cell-sub cell-code">
                                {{ $fine->loan?->member?->kode_anggota }}
                                @if($fine->loan?->member?->kelas)
                                    · Kelas {{ $fine->loan->member->kelas }}
                                @endif
                            </div>
                        </td>

                        <td>
                            <div class="cell-main">{{ $fine->loan?->book?->judul ?? '—' }}</div>
                            <div class="cell-sub cell-code">{{ $fine->loan?->book?->kode_buku }}</div>
                        </td>

                        <td class="muted plg-hide-mobile" style="white-space:nowrap;">
                            {{ $fine->loan?->tgl_kembali?->translatedFormat('d M Y') ?? '—' }}
                        </td>

                        <td class="cell-red plg-hide-mobile" style="white-space:nowrap;">
                            {{ $fine->jumlah_hari }} hari
                        </td>

                        <td class="cell-red" style="white-space:nowrap;">
                            Rp {{ number_format((int) $fine->nominal, 0, ',', '.') }}
                        </td>

                        <td>
                            @if($fine->status_bayar === 'lunas')
                                <span class="plg-badge ok">Lunas</span>
                            @else
                                <span class="plg-badge danger">Belum Lunas</span>
                            @endif
                        </td>

                        <td class="muted plg-hide-mobile" style="white-space:nowrap;">
                            {{ $fine->tgl_bayar?->translatedFormat('d M Y') ?? '—' }}
                        </td>

                        @if(!$this->isReadOnly())
                        <td>
                            @if($fine->status_bayar === 'belum_lunas')
                            <button
                                type="button"
                                class="plg-btn-act"
                                wire:click="bukaModalDenda({{ $fine->id }})"
                            >Tandai Lunas</button>
                            @endif
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            {{-- ── Pagination Denda ── --}}
            @if($dendaRows->hasPages())
            <div class="plg-pagination">
                <span>Menampilkan {{ $dendaRows->firstItem() }}–{{ $dendaRows->lastItem() }} dari {{ $dendaRows->total() }} data</span>
                <div class="plg-pg-btns">
                    <button class="plg-pg-btn {{ $dendaRows->onFirstPage() ? 'disabled' : '' }}"
                        wire:click="prevPageDenda" {{ $dendaRows->onFirstPage() ? 'disabled' : '' }}>‹</button>
                    @foreach($dendaRows->getUrlRange(1, $dendaRows->lastPage()) as $pg => $url)
                    <button class="plg-pg-btn {{ $pg == $dendaRows->currentPage() ? 'active' : '' }}"
                        wire:click="$set('pageDenda', {{ $pg }})">{{ $pg }}</button>
                    @endforeach
                    <button class="plg-pg-btn {{ !$dendaRows->hasMorePages() ? 'disabled' : '' }}"
                        wire:click="nextPageDenda" {{ !$dendaRows->hasMorePages() ? 'disabled' : '' }}>›</button>
                </div>
            </div>
            @endif
            @endif
        </div>

        {{-- ════════════════ TAB 2: SANKSI ════════════════ --}}
        @else
        @php $sanksiRows = $this->getSanksiData(); @endphp

        <div class="plg-card-head">
            <span class="plg-card-title">Sanksi Buku</span>
            <div class="plg-filters" style="margin-left:auto;">
                <button type="button" class="plg-filter-pill {{ $filterSanksi === 'belum_lunas' ? 'danger' : '' }}"
                    wire:click="$set('filterSanksi', 'belum_lunas')">Belum Lunas</button>
                <button type="button" class="plg-filter-pill {{ $filterSanksi === 'lunas' ? 'success' : '' }}"
                    wire:click="$set('filterSanksi', 'lunas')">Lunas</button>
            </div>
        </div>

        <div class="plg-search-bar">
            <div class="plg-search-wrap">
                <svg class="plg-search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input
                    type="text"
                    class="plg-search-input"
                    wire:model.live.debounce.300ms="searchSanksi"
                    placeholder="Cari nama anggota..."
                    autocomplete="off"
                >
                @if($searchSanksi)
                <button class="plg-search-clear" wire:click="$set('searchSanksi', '')" type="button" title="Hapus pencarian">×</button>
                @endif
            </div>
        </div>

        <div class="plg-card-body">
            @if($sanksiRows->total() === 0)
            <div class="plg-empty">
                <div class="plg-empty-icon">📋</div>
                <div>Tidak ada data sanksi</div>
            </div>
            @else
            <div class="plg-tbl-wrap">
            <table class="plg-tbl">
                <thead>
                    <tr>
                        <th class="center plg-hide-mobile">No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th class="plg-hide-mobile">Kondisi</th>
                        <th>Jenis Sanksi</th>
                        <th>Nominal</th>
                        <th>Status</th>
                        <th class="plg-hide-mobile">Tgl Selesai</th>
                        <th class="plg-hide-mobile">Catatan</th>
                        @if(!$this->isReadOnly())<th>Aksi</th>@endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($sanksiRows as $loan)
                    <tr>
                        <td class="no plg-hide-mobile">{{ $sanksiRows->firstItem() + $loop->index }}</td>

                        <td>
                            <div class="cell-main">{{ $loan->member?->nama ?? '—' }}</div>
                            <div class="cell-sub cell-code">
                                {{ $loan->member?->kode_anggota }}
                                @if($loan->member?->kelas)
                                    · Kelas {{ $loan->member->kelas }}
                                @endif
                            </div>
                        </td>

                        <td>
                            <div class="cell-main">{{ $loan->book?->judul ?? '—' }}</div>
                            <div class="cell-sub cell-code">{{ $loan->book?->kode_buku }}</div>
                        </td>

                        <td class="plg-hide-mobile">
                            @if($loan->kondisi_kembali === 'rusak')
                                <span class="plg-badge warn">Rusak</span>
                            @elseif($loan->kondisi_kembali === 'hilang')
                                <span class="plg-badge danger">Hilang</span>
                            @else
                                <span class="plg-badge gray">{{ $loan->kondisi_kembali ?? '—' }}</span>
                            @endif
                        </td>

                        <td style="white-space:nowrap;">
                            @if($loan->jenis_sanksi === 'ganti_buku')
                                Ganti Buku
                            @elseif($loan->jenis_sanksi === 'bayar_harga')
                                Bayar Harga Buku
                            @else
                                —
                            @endif
                        </td>

                        <td style="white-space:nowrap;">
                            @if($loan->nominal_sanksi)
                                <span class="cell-warn">Rp {{ number_format((float) $loan->nominal_sanksi, 0, ',', '.') }}</span>
                            @else
                                <span class="muted">—</span>
                            @endif
                        </td>

                        <td>
                            @if($loan->status_sanksi === 'lunas')
                                <span class="plg-badge ok">Lunas</span>
                            @elseif($loan->status_sanksi === 'belum_lunas')
                                <span class="plg-badge danger">Belum Lunas</span>
                            @else
                                <span class="plg-badge gray">—</span>
                            @endif
                        </td>

                        <td class="muted plg-hide-mobile" style="white-space:nowrap;">
                            {{ $loan->tgl_selesai_sanksi?->translatedFormat('d M Y') ?? 'Belum diselesaikan' }}
                        </td>

                        <td class="muted plg-hide-mobile" style="max-width:160px;">
                            {{ $loan->catatan_sanksi ?? '—' }}
                        </td>

                        @if(!$this->isReadOnly())
                        <td>
                            @if($loan->status_sanksi === 'belum_lunas')
                            <button
                                type="button"
                                class="plg-btn-act"
                                wire:click="bukaModalSanksi({{ $loan->id }})"
                            >Tandai Lunas</button>
                            @endif
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            {{-- ── Pagination Sanksi ── --}}
            @if($sanksiRows->hasPages())
            <div class="plg-pagination">
                <span>Menampilkan {{ $sanksiRows->firstItem() }}–{{ $sanksiRows->lastItem() }} dari {{ $sanksiRows->total() }} data</span>
                <div class="plg-pg-btns">
                    <button class="plg-pg-btn {{ $sanksiRows->onFirstPage() ? 'disabled' : '' }}"
                        wire:click="prevPageSanksi" {{ $sanksiRows->onFirstPage() ? 'disabled' : '' }}>‹</button>
                    @foreach($sanksiRows->getUrlRange(1, $sanksiRows->lastPage()) as $pg => $url)
                    <button class="plg-pg-btn {{ $pg == $sanksiRows->currentPage() ? 'active' : '' }}"
                        wire:click="$set('pageSanksi', {{ $pg }})">{{ $pg }}</button>
                    @endforeach
                    <button class="plg-pg-btn {{ !$sanksiRows->hasMorePages() ? 'disabled' : '' }}"
                        wire:click="nextPageSanksi" {{ !$sanksiRows->hasMorePages() ? 'disabled' : '' }}>›</button>
                </div>
            </div>
            @endif
            @endif
        </div>

        @endif {{-- /activeTab --}}

    </div>{{-- /.plg-card --}}

    {{-- ════════════ MODAL TANDAI LUNAS — DENDA ════════════ --}}
    @if($showModalDenda)
    <div class="plg-modal-bg" wire:click.self="$set('showModalDenda', false)">
        <div class="plg-modal">
            <div class="plg-modal-head">
                <h3>Tandai Denda Lunas</h3>
                <p>Masukkan tanggal pembayaran denda</p>
            </div>
            <div class="plg-modal-body">
                <div class="plg-mfield">
                    <label class="plg-label" for="plg-tgl-bayar">Tanggal Pembayaran</label>
                    <input
                        id="plg-tgl-bayar"
                        type="date"
                        class="plg-input"
                        wire:model="tglBayar"
                        max="{{ now()->format('Y-m-d') }}"
                    >
                </div>
            </div>
            <div class="plg-modal-foot">
                <button type="button" class="plg-btn secondary" wire:click="$set('showModalDenda', false)">Batal</button>
                <button
                    type="button"
                    class="plg-btn primary"
                    wire:click="simpanLunasDenda"
                    wire:loading.attr="disabled"
                    wire:target="simpanLunasDenda"
                >
                    <svg wire:loading.remove wire:target="simpanLunasDenda" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    <svg wire:loading wire:target="simpanLunasDenda" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="animation:spin 1s linear infinite"><path d="M21 12a9 9 0 1 1-18 0"/></svg>
                    Simpan
                </button>
            </div>
        </div>
    </div>
    @endif

    {{-- ════════════ MODAL TANDAI LUNAS — SANKSI ════════════ --}}
    @if($showModalSanksi)
    <div class="plg-modal-bg" wire:click.self="$set('showModalSanksi', false)">
        <div class="plg-modal">
            <div class="plg-modal-head">
                <h3>Tandai Sanksi Lunas</h3>
                <p>Masukkan tanggal penyelesaian sanksi</p>
            </div>
            <div class="plg-modal-body">
                <div class="plg-mfield">
                    <label class="plg-label" for="plg-tgl-selesai">Tanggal Penyelesaian</label>
                    <input
                        id="plg-tgl-selesai"
                        type="date"
                        class="plg-input"
                        wire:model="tglSelesai"
                        max="{{ now()->format('Y-m-d') }}"
                    >
                </div>
                <div class="plg-mfield">
                    <label class="plg-label">Catatan <span style="color:var(--t3);font-weight:400;">(opsional)</span></label>
                    <textarea
                        class="plg-textarea"
                        wire:model="catatanSelesai"
                        placeholder="Contoh: buku sudah diganti, sudah dibayar, dll."
                        rows="3"
                    ></textarea>
                </div>
            </div>
            <div class="plg-modal-foot">
                <button type="button" class="plg-btn secondary" wire:click="$set('showModalSanksi', false)">Batal</button>
                <button
                    type="button"
                    class="plg-btn primary"
                    wire:click="simpanLunasSanksi"
                    wire:loading.attr="disabled"
                    wire:target="simpanLunasSanksi"
                >
                    <svg wire:loading.remove wire:target="simpanLunasSanksi" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    <svg wire:loading wire:target="simpanLunasSanksi" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="animation:spin 1s linear infinite"><path d="M21 12a9 9 0 1 1-18 0"/></svg>
                    Simpan
                </button>
            </div>
        </div>
    </div>
    @endif

</div>
</x-filament-panels::page>
