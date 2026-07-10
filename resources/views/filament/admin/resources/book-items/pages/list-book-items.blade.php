<x-filament-panels::page>
<style>
.bki {
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
.bki-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; flex-wrap:wrap; gap:10px; }
.bki-title { font-size:20px; font-weight:800; color:var(--t1); letter-spacing:-.02em; }
.bki-header-actions { display:flex; gap:8px; flex-wrap:wrap; }
.bki-btn-add {
    height:36px; padding:0 16px; border-radius:8px; border:1px solid var(--line-2);
    background:white; color:var(--t2); font:inherit; font-size:13px; font-weight:600;
    cursor:pointer; display:inline-flex; align-items:center; gap:6px;
    transition:background 120ms; text-decoration:none;
}
.bki-btn-add:hover { background:#f5f7fc; color:var(--t1); }

/* ── Main tabs ── */
.bki-tabs {
    display:flex; gap:0; background:var(--panel);
    border-radius:var(--r) var(--r) 0 0;
    border:1px solid var(--line); border-bottom:none; overflow:hidden;
}
.bki-tab {
    flex:1; padding:14px 20px; background:none; border:none; cursor:pointer;
    font:inherit; font-size:13.5px; font-weight:600; color:var(--t3);
    display:flex; align-items:center; justify-content:center; gap:8px;
    transition:color 150ms, background 150ms;
    border-bottom:2px solid transparent; margin-bottom:-1px; position:relative;
}
.bki-tab:hover { background:#f8f9fc; color:var(--t2); }
.bki-tab.active { color:var(--pri); border-bottom-color:var(--pri); background:var(--pri-50); }

/* Judul halaman bawaan Filament (breadcrumb + judul) disembunyikan karena sudah ada judul kustom di dalam konten */
header.fi-header { display:none; }

/* ── Card ── */
.bki-card {
    background:var(--panel); border:1px solid var(--line);
    border-radius:0 0 var(--r) var(--r); box-shadow:var(--sh); overflow:hidden;
}
.bki-card-head {
    padding:16px 20px 14px; border-bottom:1px solid var(--line);
    display:flex; align-items:center; gap:8px; flex-wrap:wrap;
}
.bki-card-title { font-size:14px; font-weight:700; color:var(--t1); }
.bki-card-count { font-size:12px; color:var(--t3); margin-left:4px; }

/* ── Filter bar ── */
.bki-filter-bar { padding:10px 20px; border-bottom:1px solid var(--line); display:flex; align-items:center; gap:10px; flex-wrap:wrap; }
.bki-search-wrap { position:relative; flex:1; min-width:180px; max-width:320px; }
.bki-search-icon { position:absolute; left:11px; top:50%; transform:translateY(-50%); color:var(--t3); pointer-events:none; }
.bki-search-input {
    width:100%; height:34px; border:1px solid var(--line); border-radius:8px;
    padding:0 30px 0 33px; font-size:13px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; box-sizing:border-box; transition:border-color 150ms;
}
.bki-search-input:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.bki-search-clear {
    position:absolute; right:8px; top:50%; transform:translateY(-50%);
    background:none; border:none; cursor:pointer; color:var(--t3); font-size:17px;
    line-height:1; padding:2px; display:flex; align-items:center;
}
.bki-search-clear:hover { color:var(--t1); }
.bki-filter-select {
    height:34px; border:1px solid var(--line); border-radius:8px;
    padding:0 10px; font-size:12.5px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; cursor:pointer; transition:border-color 150ms;
    min-width:150px;
}
.bki-filter-select:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }

/* ── Bulk bar ── */
.bki-bulk-bar {
    padding:10px 20px; border-bottom:1px solid var(--line);
    background:var(--pri-50); display:flex; align-items:center; justify-content:space-between;
    flex-wrap:wrap; gap:8px;
}
.bki-bulk-text { font-size:12.5px; font-weight:600; color:var(--pri); }
.bki-bulk-actions { display:flex; gap:8px; }

/* ── Table ── */
.bki-tbl-wrap { overflow-x:auto; }
.bki-tbl { width:100%; border-collapse:collapse; font-size:13px; table-layout:auto; }
.bki-tbl thead tr { background:#f8f9fc; border-bottom:1px solid var(--line); }
.bki-tbl th {
    padding:10px 14px; text-align:left; font-size:11.5px; font-weight:700;
    text-transform:uppercase; letter-spacing:.06em; color:var(--t3); white-space:nowrap;
}
.bki-tbl th.center { text-align:center; }
.bki-tbl tbody tr { border-bottom:1px solid #f1f3f8; transition:background 80ms; }
.bki-tbl tbody tr:last-child { border-bottom:none; }
.bki-tbl tbody tr:hover { background:#f8f9fc; }
.bki-tbl td { padding:11px 14px; vertical-align:middle; color:var(--t1); }
.bki-tbl td.center { text-align:center; }
.bki-tbl td.no { color:var(--t3); font-size:12px; text-align:center; width:44px; }
.bki-tbl td.chk { width:36px; text-align:center; }
.bki-tbl .cell-main { font-weight:600; margin-bottom:2px; font-family:'SF Mono','Fira Code',ui-monospace,monospace; font-size:12.5px; }
.bki-tbl .cell-sub { font-size:12px; color:var(--t3); font-weight:400; font-family:inherit; }
.bki-chk { width:16px; height:16px; cursor:pointer; accent-color:var(--pri); }

/* ── Badges ── */
.bki-badge { display:inline-block; padding:2px 10px; border-radius:999px; font-size:11.5px; font-weight:600; white-space:nowrap; }
.bki-badge.ok      { background:var(--ok-50); color:var(--ok); }
.bki-badge.danger  { background:var(--err-50); color:var(--err); }
.bki-badge.warn    { background:var(--warn-50); color:var(--warn); }
.bki-badge.gray    { background:#f1f3f8; color:var(--t2); }

/* ── Action button ── */
.bki-btn-act {
    padding:5px 12px; border-radius:7px; border:1px solid var(--line-2);
    background:#f8f9fc; color:var(--t2); font:inherit; font-size:12px;
    font-weight:600; cursor:pointer; white-space:nowrap;
    transition:background 120ms, color 120ms, border-color 120ms;
}
.bki-btn-act:hover { background:var(--pri-50); color:var(--pri); border-color:var(--pri-100); }

/* ── Empty state ── */
.bki-empty { padding:48px 20px; text-align:center; color:var(--t3); font-size:13.5px; }
.bki-empty-icon { font-size:32px; margin-bottom:10px; opacity:.4; }

/* ── Pagination ── */
.bki-pagination {
    display:flex; align-items:center; justify-content:space-between;
    padding:12px 20px; border-top:1px solid var(--line);
    font-size:12.5px; color:var(--t3); flex-wrap:wrap; gap:8px;
}
.bki-pg-btns { display:flex; gap:4px; flex-wrap:wrap; }
.bki-pg-btn {
    min-width:30px; height:30px; padding:0 8px; border-radius:7px;
    border:1px solid var(--line); background:white; font-size:12px; font-weight:500;
    color:#0f172a; cursor:pointer; font-family:inherit;
    display:inline-flex; align-items:center; justify-content:center; transition:background 100ms;
}
.bki-pg-btn:hover:not(.disabled):not(.active) { background:#f5f7fc; }
.bki-pg-btn.active { background:#1e3a8a; color:white; border-color:#1e3a8a; font-weight:600; }
.bki-pg-btn.disabled { opacity:.4; cursor:not-allowed; }

/* ── Modal ── */
.bki-modal-bg {
    position:fixed; inset:0; background:rgba(15,23,42,.5);
    z-index:9999; display:flex; align-items:flex-start; justify-content:center;
    padding:40px 20px; overflow-y:auto;
}
.bki-modal {
    background:white; border-radius:14px; width:100%; max-width:440px;
    overflow:hidden; box-shadow:0 20px 48px rgba(15,23,42,.18);
    animation:bkiUp 160ms ease; margin:auto;
}
@keyframes bkiUp { from { transform:translateY(14px); opacity:0; } to { transform:translateY(0); opacity:1; } }
.bki-modal-head { padding:18px 20px 16px; border-bottom:1px solid var(--line); }
.bki-modal-head h3 { margin:0 0 3px; font-size:15px; font-weight:700; color:var(--t1); }
.bki-modal-head p  { margin:0; font-size:12.5px; color:var(--t3); }
.bki-modal-body { padding:20px; }
.bki-modal-body.scroll { padding:10px 20px; max-height:320px; overflow-y:auto; }
.bki-modal-foot { padding:0 20px 18px; display:flex; gap:8px; justify-content:flex-end; }
.bki-btn {
    height:38px; padding:0 16px; border-radius:8px; border:none;
    font:inherit; font-size:13px; font-weight:600; cursor:pointer;
    display:inline-flex; align-items:center; gap:6px; transition:background 120ms;
}
.bki-btn.secondary { background:white; color:var(--t1); border:1px solid var(--line); }
.bki-btn.secondary:hover { background:#f5f7fc; }
.bki-btn.primary { background:var(--pri); color:white; }
.bki-btn.primary:hover { background:var(--pri-2); }

.bki-mfield + .bki-mfield { margin-top:14px; }
.bki-label { display:block; font-size:12.5px; font-weight:600; color:var(--t2); margin-bottom:6px; }
.bki-mselect, .bki-textarea {
    width:100%; border:1px solid var(--line); border-radius:8px;
    padding:0 12px; font-size:13.5px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; box-sizing:border-box; transition:border-color 150ms;
}
.bki-mselect { height:40px; cursor:pointer; }
.bki-textarea { padding:10px 12px; resize:vertical; min-height:64px; }
.bki-mselect:focus, .bki-textarea:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.bki-toggle-row { display:flex; align-items:center; gap:8px; }
.bki-check-list { display:flex; flex-direction:column; gap:2px; }
.bki-check-item {
    display:flex; align-items:center; gap:10px; padding:8px 6px; border-radius:8px;
    font-size:13px; color:var(--t1); cursor:pointer; transition:background 100ms;
}
.bki-check-item:hover { background:#f8f9fc; }

@media (max-width:1023px) {
    .bki-tab { padding:12px 14px; font-size:13px; }
    .bki-tbl th, .bki-tbl td { padding:9px 10px; }
    .bki-card-head { padding:12px 16px; }
    .bki-header { margin-bottom:14px; }
    .bki-title { font-size:17px; }
    .bki-hide-mobile { display:none; }
    .bki-search-wrap { max-width:100%; min-width:0; flex:1 1 100%; }
    .bki-search-input { font-size:16px !important; height:40px; }
    .bki-filter-select { font-size:16px !important; height:40px; flex:1; min-width:0; }
    .bki-mselect, .bki-textarea { font-size:16px !important; }
    .bki-modal-bg { padding:16px; align-items:flex-end; }
    .bki-modal { border-radius:14px 14px 10px 10px; }
    .bki-modal-foot { flex-direction:column-reverse; }
    .bki-modal-foot .bki-btn { width:100%; justify-content:center; height:44px; }
    .bki-pagination { flex-direction:column; align-items:flex-start; gap:8px; }
}

@media (max-width:767px) {
    .bki-header { flex-direction:column; align-items:stretch; gap:10px; }
    .bki-header-actions { flex-direction:column; }
    .bki-btn-add { width:100%; justify-content:center; height:44px; font-size:14px; }
}
</style>

<div class="bki">

    {{-- ── HEADER ── --}}
    <div class="bki-header">
        <div class="bki-title">Daftar eksemplar</div>
        <div class="bki-header-actions">
            <button type="button" class="bki-btn-add" wire:click="$set('showCetakSemuaModal', true)">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9V2h12v7"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                Cetak Semua Label
            </button>
            <button type="button" class="bki-btn-add" wire:click="bukaCetakBukuModal">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                Cetak Label per Buku
            </button>
        </div>
    </div>

    {{-- ── MAIN TABS ── --}}
    <div class="bki-tabs">
        <button type="button" class="bki-tab {{ $activeTab === 'semua' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'semua')">
            Semua
        </button>
        <button type="button" class="bki-tab {{ $activeTab === 'tersedia' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'tersedia')">
            Tersedia
        </button>
        <button type="button" class="bki-tab {{ $activeTab === 'dipinjam' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'dipinjam')">
            Dipinjam
        </button>
    </div>

    <div class="bki-card">

        @php $data = $this->getData(); @endphp

        <div class="bki-card-head">
            <span class="bki-card-count">{{ $data->total() }} data</span>
        </div>

        <div class="bki-filter-bar">
            <div class="bki-search-wrap">
                <svg class="bki-search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" class="bki-search-input"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari kode eksemplar atau judul buku..."
                    autocomplete="off">
                @if($search)
                <button class="bki-search-clear" wire:click="$set('search', '')" type="button">×</button>
                @endif
            </div>

            <select class="bki-filter-select" wire:model.live="filterBook">
                <option value="">Semua Buku</option>
                @foreach($this->getBookOptions() as $b)
                <option value="{{ $b->id }}">{{ $b->judul }}</option>
                @endforeach
            </select>

            <select class="bki-filter-select" wire:model.live="filterKondisi">
                <option value="">Semua Kondisi</option>
                <option value="baik">Baik</option>
                <option value="rusak">Rusak</option>
                <option value="hilang">Hilang</option>
            </select>
        </div>

        {{-- ── Bulk bar ── --}}
        @if(count($selected) > 0)
        <div class="bki-bulk-bar">
            <span class="bki-bulk-text">{{ count($selected) }} eksemplar dipilih</span>
            <div class="bki-bulk-actions">
                <button type="button" class="bki-btn-act" wire:click="clearSelection">Batal Pilih</button>
                <button type="button" class="bki-btn-act" wire:click="cetakTerpilih"
                    style="background:var(--pri); color:white; border-color:var(--pri);">Cetak Label Terpilih</button>
            </div>
        </div>
        @endif

        <div style="padding:0;">
            @if($data->total() === 0)
            <div class="bki-empty">
                <div class="bki-empty-icon">🏷️</div>
                <div>Tidak ada data eksemplar</div>
            </div>
            @else
            @php $pageIds = $data->pluck('id')->map(fn ($id) => (string) $id)->toArray(); @endphp
            <div class="bki-tbl-wrap">
            <table class="bki-tbl">
                <thead>
                    <tr>
                        <th class="chk">
                            <input type="checkbox" class="bki-chk"
                                wire:click="toggleSelectAllPage"
                                @checked(!empty($pageIds) && empty(array_diff($pageIds, $selected)))>
                        </th>
                        <th class="center bki-hide-mobile">No</th>
                        <th>Kode / Judul Buku</th>
                        <th>Kondisi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    @php
                        $kondisiClass = match($item->kondisi) {
                            'baik' => 'ok', 'rusak' => 'warn', 'hilang' => 'danger', default => 'gray',
                        };
                        $kondisiLabel = match($item->kondisi) {
                            'baik' => 'Baik', 'rusak' => 'Rusak', 'hilang' => 'Hilang', default => $item->kondisi,
                        };
                    @endphp
                    <tr>
                        <td class="chk">
                            <input type="checkbox" class="bki-chk" wire:model.live="selected" value="{{ $item->id }}">
                        </td>
                        <td class="no bki-hide-mobile">{{ $data->firstItem() + $loop->index }}</td>

                        <td>
                            <div class="cell-main">{{ $item->kode_item }}</div>
                            <div class="cell-sub">{{ $item->book?->judul ?? '—' }}</div>
                        </td>

                        <td><span class="bki-badge {{ $kondisiClass }}">{{ $kondisiLabel }}</span></td>

                        <td>
                            @if($item->is_available)
                                <span class="bki-badge ok">Tersedia</span>
                            @else
                                <span class="bki-badge warn">Dipinjam</span>
                            @endif
                        </td>

                        <td>
                            <button type="button" class="bki-btn-act"
                                wire:click="bukaEditModal({{ $item->id }})">Edit Kondisi</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            {{-- ── Pagination ── --}}
            @if($data->hasPages())
            <div class="bki-pagination">
                <span>Menampilkan {{ $data->firstItem() }}–{{ $data->lastItem() }} dari {{ $data->total() }} data</span>
                <div class="bki-pg-btns">
                    <button class="bki-pg-btn {{ $data->onFirstPage() ? 'disabled' : '' }}"
                        wire:click="prevPage" {{ $data->onFirstPage() ? 'disabled' : '' }}>‹</button>
                    @foreach($data->getUrlRange(1, $data->lastPage()) as $pg => $url)
                    <button class="bki-pg-btn {{ $pg == $data->currentPage() ? 'active' : '' }}"
                        wire:click="$set('page', {{ $pg }})">{{ $pg }}</button>
                    @endforeach
                    <button class="bki-pg-btn {{ !$data->hasMorePages() ? 'disabled' : '' }}"
                        wire:click="nextPage" {{ !$data->hasMorePages() ? 'disabled' : '' }}>›</button>
                </div>
            </div>
            @endif
            @endif
        </div>

    </div>{{-- /.bki-card --}}

    {{-- ── MODAL EDIT KONDISI ── --}}
    @if($showEditModal)
    <div class="bki-modal-bg" wire:click.self="tutupEditModal">
        <div class="bki-modal">
            <div class="bki-modal-head">
                <h3>Edit Kondisi Eksemplar</h3>
                <p>Perbarui kondisi dan ketersediaan eksemplar buku</p>
            </div>
            <div class="bki-modal-body">

                <div class="bki-mfield">
                    <label class="bki-label" for="bki-m-kondisi">Kondisi</label>
                    <select id="bki-m-kondisi" class="bki-mselect" wire:model.live="modalKondisi">
                        <option value="baik">Baik</option>
                        <option value="rusak">Rusak</option>
                        <option value="hilang">Hilang</option>
                    </select>
                </div>

                <div class="bki-mfield">
                    <label class="bki-toggle-row">
                        <input type="checkbox" class="bki-chk" wire:model="modalIsAvailable"
                            @disabled(in_array($modalKondisi, ['rusak', 'hilang']))>
                        <span class="bki-label" style="margin-bottom:0;">Tersedia untuk dipinjam</span>
                    </label>
                </div>

                <div class="bki-mfield">
                    <label class="bki-label">Catatan <span style="color:var(--t3);font-weight:400;">(opsional)</span></label>
                    <textarea class="bki-textarea" wire:model="modalCatatan"
                        placeholder="Contoh: ditemukan rusak di rak A-1" rows="2"></textarea>
                </div>

            </div>
            <div class="bki-modal-foot">
                <button type="button" class="bki-btn secondary" wire:click="tutupEditModal">Batal</button>
                <button type="button" class="bki-btn primary" wire:click="simpanKondisi">Simpan</button>
            </div>
        </div>
    </div>
    @endif

    {{-- ── MODAL CETAK SEMUA LABEL ── --}}
    @if($showCetakSemuaModal)
    <div class="bki-modal-bg" wire:click.self="$set('showCetakSemuaModal', false)">
        <div class="bki-modal">
            <div class="bki-modal-head">
                <h3>Cetak Semua Label Eksemplar</h3>
                <p>PDF akan berisi label untuk SEMUA eksemplar dari SEMUA buku dalam koleksi.</p>
            </div>
            <div class="bki-modal-foot">
                <button type="button" class="bki-btn secondary" wire:click="$set('showCetakSemuaModal', false)">Batal</button>
                <button type="button" class="bki-btn primary" wire:click="konfirmasiCetakSemua">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9V2h12v7"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                    Ya, Cetak Semua
                </button>
            </div>
        </div>
    </div>
    @endif

    {{-- ── MODAL CETAK LABEL PER BUKU ── --}}
    @if($showCetakBukuModal)
    <div class="bki-modal-bg" wire:click.self="$set('showCetakBukuModal', false)">
        <div class="bki-modal">
            <div class="bki-modal-head">
                <h3>Cetak Label per Buku</h3>
                <p>Pilih satu atau beberapa buku untuk dicetak labelnya</p>
            </div>
            <div class="bki-modal-body scroll">
                <div class="bki-check-list">
                    @foreach($this->getBookOptions() as $b)
                    <label class="bki-check-item">
                        <input type="checkbox" class="bki-chk" wire:model="modalBookIds" value="{{ $b->id }}">
                        {{ $b->judul }}
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="bki-modal-foot">
                <button type="button" class="bki-btn secondary" wire:click="$set('showCetakBukuModal', false)">Batal</button>
                <button type="button" class="bki-btn primary" wire:click="cetakPerBuku">Cetak</button>
            </div>
        </div>
    </div>
    @endif

</div>
</x-filament-panels::page>
