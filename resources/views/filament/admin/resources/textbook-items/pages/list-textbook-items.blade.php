<x-filament-panels::page>
<style>
.txi {
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
.txi-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; flex-wrap:wrap; gap:10px; }
.txi-title { font-size:20px; font-weight:800; color:var(--t1); letter-spacing:-.02em; }
.txi-header-actions { display:flex; gap:8px; flex-wrap:wrap; }
.txi-btn-add {
    height:36px; padding:0 16px; border-radius:8px; border:1px solid var(--line-2);
    background:white; color:var(--t2); font:inherit; font-size:13px; font-weight:600;
    cursor:pointer; display:inline-flex; align-items:center; gap:6px;
    transition:background 120ms; text-decoration:none;
}
.txi-btn-add:hover { background:#f5f7fc; color:var(--t1); }

/* ── Main tabs ── */
.txi-tabs {
    display:flex; gap:0; background:var(--panel);
    border-radius:var(--r) var(--r) 0 0;
    border:1px solid var(--line); border-bottom:none; overflow:hidden;
}
.txi-tab {
    flex:1; padding:14px 20px; background:none; border:none; cursor:pointer;
    font:inherit; font-size:13.5px; font-weight:600; color:var(--t3);
    display:flex; align-items:center; justify-content:center; gap:8px;
    transition:color 150ms, background 150ms;
    border-bottom:2px solid transparent; margin-bottom:-1px; position:relative;
}
.txi-tab:hover { background:#f8f9fc; color:var(--t2); }
.txi-tab.active { color:var(--pri); border-bottom-color:var(--pri); background:var(--pri-50); }

/* Judul halaman bawaan Filament (breadcrumb + judul) disembunyikan karena sudah ada judul kustom di dalam konten */
header.fi-header { display:none; }

/* ── Card ── */
.txi-card {
    background:var(--panel); border:1px solid var(--line);
    border-radius:0 0 var(--r) var(--r); box-shadow:var(--sh); overflow:hidden;
}
.txi-card-head {
    padding:16px 20px 14px; border-bottom:1px solid var(--line);
    display:flex; align-items:center; gap:8px; flex-wrap:wrap;
}
.txi-card-title { font-size:14px; font-weight:700; color:var(--t1); }
.txi-card-count { font-size:12px; color:var(--t3); margin-left:4px; }

/* ── Filter bar ── */
.txi-filter-bar { padding:10px 20px; border-bottom:1px solid var(--line); display:flex; align-items:center; gap:10px; flex-wrap:wrap; }
.txi-search-wrap { position:relative; flex:1; min-width:180px; max-width:320px; }
.txi-search-icon { position:absolute; left:11px; top:50%; transform:translateY(-50%); color:var(--t3); pointer-events:none; }
.txi-search-input {
    width:100%; height:34px; border:1px solid var(--line); border-radius:8px;
    padding:0 30px 0 33px; font-size:13px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; box-sizing:border-box; transition:border-color 150ms;
}
.txi-search-input:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.txi-search-clear {
    position:absolute; right:8px; top:50%; transform:translateY(-50%);
    background:none; border:none; cursor:pointer; color:var(--t3); font-size:17px;
    line-height:1; padding:2px; display:flex; align-items:center;
}
.txi-search-clear:hover { color:var(--t1); }
.txi-filter-select {
    height:34px; border:1px solid var(--line); border-radius:8px;
    padding:0 10px; font-size:12.5px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; cursor:pointer; transition:border-color 150ms;
    min-width:150px;
}
.txi-filter-select:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }

/* ── Bulk bar ── */
.txi-bulk-bar {
    padding:10px 20px; border-bottom:1px solid var(--line);
    background:var(--pri-50); display:flex; align-items:center; justify-content:space-between;
    flex-wrap:wrap; gap:8px;
}
.txi-bulk-text { font-size:12.5px; font-weight:600; color:var(--pri); }
.txi-bulk-actions { display:flex; gap:8px; }

/* ── Table ── */
.txi-tbl-wrap { overflow-x:auto; }
.txi-tbl { width:100%; border-collapse:collapse; font-size:13px; table-layout:auto; }
.txi-tbl thead tr { background:#f8f9fc; border-bottom:1px solid var(--line); }
.txi-tbl th {
    padding:10px 14px; text-align:left; font-size:11.5px; font-weight:700;
    text-transform:uppercase; letter-spacing:.06em; color:var(--t3); white-space:nowrap;
}
.txi-tbl th.center { text-align:center; }
.txi-tbl tbody tr { border-bottom:1px solid #f1f3f8; transition:background 80ms; }
.txi-tbl tbody tr:last-child { border-bottom:none; }
.txi-tbl tbody tr:hover { background:#f8f9fc; }
.txi-tbl td { padding:11px 14px; vertical-align:middle; color:var(--t1); }
.txi-tbl td.center { text-align:center; }
.txi-tbl td.no { color:var(--t3); font-size:12px; text-align:center; width:44px; }
.txi-tbl td.chk { width:36px; text-align:center; }
.txi-tbl .cell-main { font-weight:600; margin-bottom:2px; font-family:'SF Mono','Fira Code',ui-monospace,monospace; font-size:12.5px; }
.txi-tbl .cell-sub { font-size:12px; color:var(--t3); font-weight:400; font-family:inherit; }
.txi-chk { width:16px; height:16px; cursor:pointer; accent-color:var(--pri); }

/* ── Badges ── */
.txi-badge { display:inline-block; padding:2px 10px; border-radius:999px; font-size:11.5px; font-weight:600; white-space:nowrap; }
.txi-badge.ok      { background:var(--ok-50); color:var(--ok); }
.txi-badge.danger  { background:var(--err-50); color:var(--err); }
.txi-badge.warn    { background:var(--warn-50); color:var(--warn); }
.txi-badge.gray    { background:#f1f3f8; color:var(--t2); }
.txi-badge.info    { background:var(--pri-50); color:var(--pri); }

/* ── Action button ── */
.txi-btn-act {
    padding:5px 12px; border-radius:7px; border:1px solid var(--line-2);
    background:#f8f9fc; color:var(--t2); font:inherit; font-size:12px;
    font-weight:600; cursor:pointer; white-space:nowrap;
    transition:background 120ms, color 120ms, border-color 120ms;
}
.txi-btn-act:hover { background:var(--pri-50); color:var(--pri); border-color:var(--pri-100); }

/* ── Empty state ── */
.txi-empty { padding:48px 20px; text-align:center; color:var(--t3); font-size:13.5px; }
.txi-empty-icon { font-size:32px; margin-bottom:10px; opacity:.4; }

/* ── Pagination ── */
.txi-pagination {
    display:flex; align-items:center; justify-content:space-between;
    padding:12px 20px; border-top:1px solid var(--line);
    font-size:12.5px; color:var(--t3); flex-wrap:wrap; gap:8px;
}
.txi-pg-btns { display:flex; gap:4px; flex-wrap:wrap; }
.txi-pg-btn {
    min-width:30px; height:30px; padding:0 8px; border-radius:7px;
    border:1px solid var(--line); background:white; font-size:12px; font-weight:500;
    color:#0f172a; cursor:pointer; font-family:inherit;
    display:inline-flex; align-items:center; justify-content:center; transition:background 100ms;
}
.txi-pg-btn:hover:not(.disabled):not(.active) { background:#f5f7fc; }
.txi-pg-btn.active { background:#1e3a8a; color:white; border-color:#1e3a8a; font-weight:600; }
.txi-pg-btn.disabled { opacity:.4; cursor:not-allowed; }

/* ── Modal ── */
.txi-modal-bg {
    position:fixed; inset:0; background:rgba(15,23,42,.5);
    z-index:9999; display:flex; align-items:flex-start; justify-content:center;
    padding:40px 20px; overflow-y:auto;
}
.txi-modal {
    background:white; border-radius:14px; width:100%; max-width:440px;
    overflow:hidden; box-shadow:0 20px 48px rgba(15,23,42,.18);
    animation:txiUp 160ms ease; margin:auto;
}
@keyframes txiUp { from { transform:translateY(14px); opacity:0; } to { transform:translateY(0); opacity:1; } }
.txi-modal-head { padding:18px 20px 16px; border-bottom:1px solid var(--line); }
.txi-modal-head h3 { margin:0 0 3px; font-size:15px; font-weight:700; color:var(--t1); }
.txi-modal-head p  { margin:0; font-size:12.5px; color:var(--t3); }
.txi-modal-body { padding:20px; }
.txi-modal-body.scroll { padding:10px 20px; max-height:320px; overflow-y:auto; }
.txi-modal-foot { padding:0 20px 18px; display:flex; gap:8px; justify-content:flex-end; }
.txi-btn {
    height:38px; padding:0 16px; border-radius:8px; border:none;
    font:inherit; font-size:13px; font-weight:600; cursor:pointer;
    display:inline-flex; align-items:center; gap:6px; transition:background 120ms;
}
.txi-btn.secondary { background:white; color:var(--t1); border:1px solid var(--line); }
.txi-btn.secondary:hover { background:#f5f7fc; }
.txi-btn.primary { background:var(--pri); color:white; }
.txi-btn.primary:hover { background:var(--pri-2); }
.txi-btn.success { background:var(--ok); color:white; }
.txi-btn.success:hover { background:#15803d; }

.txi-mfield + .txi-mfield { margin-top:14px; }
.txi-label { display:block; font-size:12.5px; font-weight:600; color:var(--t2); margin-bottom:6px; }
.txi-mselect, .txi-textarea {
    width:100%; border:1px solid var(--line); border-radius:8px;
    padding:0 12px; font-size:13.5px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; box-sizing:border-box; transition:border-color 150ms;
}
.txi-mselect { height:40px; cursor:pointer; }
.txi-textarea { padding:10px 12px; resize:vertical; min-height:64px; }
.txi-mselect:focus, .txi-textarea:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.txi-toggle-row { display:flex; align-items:center; gap:8px; }
.txi-check-list { display:flex; flex-direction:column; gap:2px; }
.txi-check-item {
    display:flex; align-items:center; gap:10px; padding:8px 6px; border-radius:8px;
    font-size:13px; color:var(--t1); cursor:pointer; transition:background 100ms;
}
.txi-check-item:hover { background:#f8f9fc; }

@media (max-width:1023px) {
    .txi-tab { padding:12px 14px; font-size:13px; }
    .txi-tbl th, .txi-tbl td { padding:9px 10px; }
    .txi-card-head { padding:12px 16px; }
    .txi-header { margin-bottom:14px; }
    .txi-title { font-size:17px; }
    .txi-hide-mobile { display:none; }
    .txi-search-wrap { max-width:100%; min-width:0; flex:1 1 100%; }
    .txi-search-input { font-size:16px !important; height:40px; }
    .txi-filter-select { font-size:16px !important; height:40px; flex:1; min-width:0; }
    .txi-mselect, .txi-textarea { font-size:16px !important; }
    .txi-modal-bg { padding:16px; align-items:flex-end; }
    .txi-modal { border-radius:14px 14px 10px 10px; }
    .txi-modal-foot { flex-direction:column-reverse; }
    .txi-modal-foot .txi-btn { width:100%; justify-content:center; height:44px; }
    .txi-pagination { flex-direction:column; align-items:flex-start; gap:8px; }
}

@media (max-width:767px) {
    .txi-header { flex-direction:column; align-items:stretch; gap:10px; }
    .txi-header-actions { flex-direction:column; }
    .txi-btn-add { width:100%; justify-content:center; height:44px; font-size:14px; }
}
</style>

<div class="txi">

    {{-- ── HEADER ── --}}
    <div class="txi-header">
        <div class="txi-title">Eksemplar buku paket</div>
        <div class="txi-header-actions">
            <button type="button" class="txi-btn-add" wire:click="$set('showCetakSemuaModal', true)">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9V2h12v7"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                Cetak Semua Label
            </button>
            <button type="button" class="txi-btn-add" wire:click="bukaCetakBukuModal">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                Cetak per Buku Paket
            </button>
        </div>
    </div>

    {{-- ── MAIN TABS ── --}}
    <div class="txi-tabs">
        <button type="button" class="txi-tab {{ $activeTab === 'semua' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'semua')">
            Semua
        </button>
        <button type="button" class="txi-tab {{ $activeTab === 'tersedia' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'tersedia')">
            Tersedia
        </button>
        <button type="button" class="txi-tab {{ $activeTab === 'dipinjam' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'dipinjam')">
            Dipinjam
        </button>
    </div>

    <div class="txi-card">

        @php $data = $this->getData(); @endphp

        <div class="txi-card-head">
            <span class="txi-card-count">{{ $data->total() }} data</span>
        </div>

        <div class="txi-filter-bar">
            <div class="txi-search-wrap">
                <svg class="txi-search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" class="txi-search-input"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari kode eksemplar atau judul buku..."
                    autocomplete="off">
                @if($search)
                <button class="txi-search-clear" wire:click="$set('search', '')" type="button">×</button>
                @endif
            </div>

            <select class="txi-filter-select" wire:model.live="filterTextbook">
                <option value="">Semua Buku Paket</option>
                @foreach($this->getTextbookOptions() as $t)
                <option value="{{ $t->id }}">{{ $t->judul }}</option>
                @endforeach
            </select>

            <select class="txi-filter-select" wire:model.live="filterKondisi">
                <option value="">Semua Kondisi</option>
                <option value="baik">Baik</option>
                <option value="rusak">Rusak</option>
                <option value="hilang">Hilang</option>
            </select>
        </div>

        {{-- ── Bulk bar ── --}}
        @if(count($selected) > 0)
        <div class="txi-bulk-bar">
            <span class="txi-bulk-text">{{ count($selected) }} eksemplar dipilih</span>
            <div class="txi-bulk-actions">
                <button type="button" class="txi-btn-act" wire:click="clearSelection">Batal Pilih</button>
                <button type="button" class="txi-btn-act" wire:click="cetakTerpilih"
                    style="background:var(--pri); color:white; border-color:var(--pri);">Cetak Label Terpilih</button>
            </div>
        </div>
        @endif

        <div style="padding:0;">
            @if($data->total() === 0)
            <div class="txi-empty">
                <div class="txi-empty-icon">🏷️</div>
                <div>Tidak ada data eksemplar</div>
            </div>
            @else
            @php $pageIds = $data->pluck('id')->map(fn ($id) => (string) $id)->toArray(); @endphp
            <div class="txi-tbl-wrap">
            <table class="txi-tbl">
                <thead>
                    <tr>
                        <th class="chk">
                            <input type="checkbox" class="txi-chk"
                                wire:click="toggleSelectAllPage"
                                @checked(!empty($pageIds) && empty(array_diff($pageIds, $selected)))>
                        </th>
                        <th class="center txi-hide-mobile">No</th>
                        <th>Kode / Buku Paket</th>
                        <th class="txi-hide-mobile">Tingkat</th>
                        <th>Kondisi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    @php
                        $tingkatClass = match((int) $item->textbook?->untuk_tingkat) {
                            7 => 'info', 8 => 'ok', 9 => 'warn', default => 'gray',
                        };
                        $kondisiClass = match($item->kondisi) {
                            'baik' => 'ok', 'rusak' => 'warn', 'hilang' => 'danger', default => 'gray',
                        };
                        $kondisiLabel = match($item->kondisi) {
                            'baik' => 'Baik', 'rusak' => 'Rusak', 'hilang' => 'Hilang', default => $item->kondisi,
                        };
                    @endphp
                    <tr>
                        <td class="chk">
                            <input type="checkbox" class="txi-chk" wire:model.live="selected" value="{{ $item->id }}">
                        </td>
                        <td class="no txi-hide-mobile">{{ $data->firstItem() + $loop->index }}</td>

                        <td>
                            <div class="cell-main">{{ $item->kode_item }}</div>
                            <div class="cell-sub">{{ $item->textbook?->judul ?? '—' }}</div>
                        </td>

                        <td class="txi-hide-mobile">
                            <span class="txi-badge {{ $tingkatClass }}">Kelas {{ $item->textbook?->untuk_tingkat }}</span>
                        </td>

                        <td><span class="txi-badge {{ $kondisiClass }}">{{ $kondisiLabel }}</span></td>

                        <td>
                            @if($item->is_available)
                                <span class="txi-badge ok">Tersedia</span>
                            @else
                                <span class="txi-badge warn">Dipinjam</span>
                            @endif
                        </td>

                        <td>
                            <button type="button" class="txi-btn-act"
                                wire:click="bukaEditModal({{ $item->id }})">Edit Kondisi</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            {{-- ── Pagination ── --}}
            @if($data->hasPages())
            <div class="txi-pagination">
                <span>Menampilkan {{ $data->firstItem() }}–{{ $data->lastItem() }} dari {{ $data->total() }} data</span>
                <div class="txi-pg-btns">
                    <button class="txi-pg-btn {{ $data->onFirstPage() ? 'disabled' : '' }}"
                        wire:click="prevPage" {{ $data->onFirstPage() ? 'disabled' : '' }}>‹</button>
                    @foreach($data->getUrlRange(1, $data->lastPage()) as $pg => $url)
                    <button class="txi-pg-btn {{ $pg == $data->currentPage() ? 'active' : '' }}"
                        wire:click="$set('page', {{ $pg }})">{{ $pg }}</button>
                    @endforeach
                    <button class="txi-pg-btn {{ !$data->hasMorePages() ? 'disabled' : '' }}"
                        wire:click="nextPage" {{ !$data->hasMorePages() ? 'disabled' : '' }}>›</button>
                </div>
            </div>
            @endif
            @endif
        </div>

    </div>{{-- /.txi-card --}}

    {{-- ── MODAL EDIT KONDISI ── --}}
    @if($showEditModal)
    <div class="txi-modal-bg" wire:click.self="tutupEditModal">
        <div class="txi-modal">
            <div class="txi-modal-head">
                <h3>Edit Kondisi Eksemplar</h3>
                <p>Perbarui kondisi dan ketersediaan eksemplar buku paket</p>
            </div>
            <div class="txi-modal-body">

                <div class="txi-mfield">
                    <label class="txi-label" for="txi-m-kondisi">Kondisi</label>
                    <select id="txi-m-kondisi" class="txi-mselect" wire:model.live="modalKondisi">
                        <option value="baik">Baik</option>
                        <option value="rusak">Rusak</option>
                        <option value="hilang">Hilang</option>
                    </select>
                </div>

                <div class="txi-mfield">
                    <label class="txi-toggle-row">
                        <input type="checkbox" class="txi-chk" wire:model="modalIsAvailable"
                            @disabled($modalKondisi === 'hilang')>
                        <span class="txi-label" style="margin-bottom:0;">Tersedia untuk dipinjam</span>
                    </label>
                </div>

                <div class="txi-mfield">
                    <label class="txi-label">Catatan <span style="color:var(--t3);font-weight:400;">(opsional)</span></label>
                    <textarea class="txi-textarea" wire:model="modalCatatan"
                        placeholder="Contoh: ditemukan rusak di rak B-2" rows="2"></textarea>
                </div>

            </div>
            <div class="txi-modal-foot">
                <button type="button" class="txi-btn secondary" wire:click="tutupEditModal">Batal</button>
                <button type="button" class="txi-btn primary" wire:click="simpanKondisi">Simpan</button>
            </div>
        </div>
    </div>
    @endif

    {{-- ── MODAL CETAK SEMUA LABEL ── --}}
    @if($showCetakSemuaModal)
    <div class="txi-modal-bg" wire:click.self="$set('showCetakSemuaModal', false)">
        <div class="txi-modal">
            <div class="txi-modal-head">
                <h3>Cetak Semua Label Eksemplar</h3>
                <p>PDF akan berisi label untuk SEMUA eksemplar dari SEMUA buku paket dalam koleksi.</p>
            </div>
            <div class="txi-modal-foot">
                <button type="button" class="txi-btn secondary" wire:click="$set('showCetakSemuaModal', false)">Batal</button>
                <button type="button" class="txi-btn primary" wire:click="konfirmasiCetakSemua">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9V2h12v7"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                    Ya, Cetak Semua
                </button>
            </div>
        </div>
    </div>
    @endif

    {{-- ── MODAL CETAK LABEL PER BUKU PAKET ── --}}
    @if($showCetakBukuModal)
    <div class="txi-modal-bg" wire:click.self="$set('showCetakBukuModal', false)">
        <div class="txi-modal">
            <div class="txi-modal-head">
                <h3>Cetak Label per Buku Paket</h3>
                <p>Pilih satu atau beberapa buku paket untuk dicetak labelnya</p>
            </div>
            <div class="txi-modal-body scroll">
                <div class="txi-check-list">
                    @foreach($this->getTextbookOptions() as $t)
                    <label class="txi-check-item">
                        <input type="checkbox" class="txi-chk" wire:model="modalTextbookIds" value="{{ $t->id }}">
                        {{ $t->judul }}
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="txi-modal-foot">
                <button type="button" class="txi-btn secondary" wire:click="$set('showCetakBukuModal', false)">Batal</button>
                <button type="button" class="txi-btn primary" wire:click="cetakPerBuku">Cetak</button>
            </div>
        </div>
    </div>
    @endif

</div>
</x-filament-panels::page>
