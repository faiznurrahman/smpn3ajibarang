<x-filament-panels::page>
<style>
.tsk {
    --pri:#1e3a8a; --pri-2:#2746a4; --pri-50:#eef2ff; --pri-100:#dbe3ff;
    --ok:#16a34a;  --ok-50:#e6f7ed;
    --warn:#b45309; --warn-50:#fffbeb;
    --err:#dc2626; --err-50:#fee2e2;
    --t1:#0f172a; --t2:#5a6478; --t3:#8b94a6;
    --line:#e6eaf2; --line-2:#d4dae6;
    --panel:#fff;
    --r:14px; --sh:0 1px 2px rgba(15,23,42,.04);
}

/* ── Stats ── */
.tsk-stats { display:grid; grid-template-columns:repeat(5, 1fr); gap:12px; margin-bottom:18px; }
.tsk-stat {
    background:var(--panel); border:1px solid var(--line); border-radius:var(--r);
    box-shadow:var(--sh); padding:14px 16px;
}
.tsk-stat-label { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.06em; color:var(--t3); margin-bottom:4px; }
.tsk-stat-val { font-size:22px; font-weight:800; color:var(--t1); letter-spacing:-.02em; }
.tsk-stat.danger .tsk-stat-val { color:var(--err); }
.tsk-stat.ok .tsk-stat-val { color:var(--ok); }
.tsk-stat.warn .tsk-stat-val { color:var(--warn); }

/* ── Page header ── */
.tsk-title { font-size:20px; font-weight:800; color:var(--t1); letter-spacing:-.02em; margin-bottom:20px; }

/* ── Main tabs ── */
.tsk-tabs {
    display:flex; gap:0; background:var(--panel);
    border-radius:var(--r) var(--r) 0 0;
    border:1px solid var(--line); border-bottom:none; overflow:hidden;
}
.tsk-tab {
    flex:1; padding:14px 20px; background:none; border:none; cursor:pointer;
    font:inherit; font-size:13.5px; font-weight:600; color:var(--t3);
    display:flex; align-items:center; justify-content:center; gap:8px;
    transition:color 150ms, background 150ms;
    border-bottom:2px solid transparent; margin-bottom:-1px; position:relative;
}
.tsk-tab:hover { background:#f8f9fc; color:var(--t2); }
.tsk-tab.active { color:var(--pri); border-bottom-color:var(--pri); background:var(--pri-50); }

/* Judul halaman bawaan Filament (breadcrumb + judul) disembunyikan karena sudah ada judul kustom di dalam konten */
header.fi-header { display:none; }
.tsk-tab-badge {
    background:var(--err); color:white;
    border-radius:999px; font-size:11px; font-weight:700;
    padding:1px 7px; min-width:20px; text-align:center;
}

/* ── Card ── */
.tsk-card {
    background:var(--panel); border:1px solid var(--line);
    border-radius:0 0 var(--r) var(--r); box-shadow:var(--sh); overflow:hidden;
}
.tsk-card-head {
    padding:16px 20px 14px; border-bottom:1px solid var(--line);
    display:flex; align-items:center; gap:8px; flex-wrap:wrap;
}
.tsk-card-title { font-size:14px; font-weight:700; color:var(--t1); }
.tsk-card-count { font-size:12px; color:var(--t3); margin-left:4px; }

/* ── Search bar ── */
.tsk-search-bar { padding:10px 20px; border-bottom:1px solid var(--line); display:flex; align-items:center; }
.tsk-search-wrap { position:relative; width:100%; max-width:320px; }
.tsk-search-icon { position:absolute; left:11px; top:50%; transform:translateY(-50%); color:var(--t3); pointer-events:none; }
.tsk-search-input {
    width:100%; height:34px; border:1px solid var(--line); border-radius:8px;
    padding:0 30px 0 33px; font-size:13px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; box-sizing:border-box; transition:border-color 150ms;
}
.tsk-search-input:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.tsk-search-clear {
    position:absolute; right:8px; top:50%; transform:translateY(-50%);
    background:none; border:none; cursor:pointer; color:var(--t3); font-size:17px;
    line-height:1; padding:2px; display:flex; align-items:center;
}
.tsk-search-clear:hover { color:var(--t1); }

/* ── Table ── */
.tsk-tbl-wrap { overflow-x:auto; }
.tsk-tbl { width:100%; border-collapse:collapse; font-size:13px; table-layout:auto; }
.tsk-tbl thead tr { background:#f8f9fc; border-bottom:1px solid var(--line); }
.tsk-tbl th {
    padding:10px 14px; text-align:left; font-size:11.5px; font-weight:700;
    text-transform:uppercase; letter-spacing:.06em; color:var(--t3); white-space:nowrap;
}
.tsk-tbl th.center { text-align:center; }
.tsk-tbl tbody tr { border-bottom:1px solid #f1f3f8; transition:background 80ms; }
.tsk-tbl tbody tr:last-child { border-bottom:none; }
.tsk-tbl tbody tr:hover { background:#f8f9fc; }
.tsk-tbl td { padding:11px 14px; vertical-align:middle; color:var(--t1); }
.tsk-tbl td.center { text-align:center; }
.tsk-tbl td.no { color:var(--t3); font-size:12px; text-align:center; width:44px; }
.tsk-tbl td.muted { color:var(--t3); }
.tsk-tbl .cell-main { font-weight:600; margin-bottom:2px; }
.tsk-tbl .cell-sub { font-size:12px; color:var(--t3); font-weight:400; }
.tsk-tbl .cell-code { font-family:'SF Mono','Fira Code',ui-monospace,monospace; font-size:11.5px; letter-spacing:.02em; }
.tsk-tbl .cell-red { color:var(--err); font-weight:600; }

/* ── Badges ── */
.tsk-badge { display:inline-block; padding:2px 10px; border-radius:999px; font-size:11.5px; font-weight:600; white-space:nowrap; }
.tsk-badge.ok      { background:var(--ok-50); color:var(--ok); }
.tsk-badge.danger  { background:var(--err-50); color:var(--err); }
.tsk-badge.warn    { background:var(--warn-50); color:var(--warn); }
.tsk-badge.gray    { background:#f1f3f8; color:var(--t2); }

/* ── Action button ── */
.tsk-btn-act {
    padding:5px 12px; border-radius:7px; border:1px solid #86efac;
    background:var(--ok-50); color:var(--ok); font:inherit; font-size:12px;
    font-weight:600; cursor:pointer; white-space:nowrap;
    transition:background 120ms, color 120ms, border-color 120ms;
}
.tsk-btn-act:hover { background:var(--ok); color:white; border-color:var(--ok); }

/* ── Empty state ── */
.tsk-empty { padding:48px 20px; text-align:center; color:var(--t3); font-size:13.5px; }
.tsk-empty-icon { font-size:32px; margin-bottom:10px; opacity:.4; }

/* ── Pagination ── */
.tsk-pagination {
    display:flex; align-items:center; justify-content:space-between;
    padding:12px 20px; border-top:1px solid var(--line);
    font-size:12.5px; color:var(--t3); flex-wrap:wrap; gap:8px;
}
.tsk-pg-btns { display:flex; gap:4px; flex-wrap:wrap; }
.tsk-pg-btn {
    min-width:30px; height:30px; padding:0 8px; border-radius:7px;
    border:1px solid var(--line); background:white; font-size:12px; font-weight:500;
    color:#0f172a; cursor:pointer; font-family:inherit;
    display:inline-flex; align-items:center; justify-content:center; transition:background 100ms;
}
.tsk-pg-btn:hover:not(.disabled):not(.active) { background:#f5f7fc; }
.tsk-pg-btn.active { background:#1e3a8a; color:white; border-color:#1e3a8a; font-weight:600; }
.tsk-pg-btn.disabled { opacity:.4; cursor:not-allowed; }

/* ── Modal ── */
.tsk-modal-bg {
    position:fixed; inset:0; background:rgba(15,23,42,.5);
    z-index:9999; display:flex; align-items:flex-start; justify-content:center;
    padding:40px 20px; overflow-y:auto;
}
.tsk-modal {
    background:white; border-radius:14px; width:100%; max-width:440px;
    overflow:hidden; box-shadow:0 20px 48px rgba(15,23,42,.18);
    animation:tskUp 160ms ease; margin:auto;
}
@keyframes tskUp { from { transform:translateY(14px); opacity:0; } to { transform:translateY(0); opacity:1; } }
.tsk-modal-head { padding:18px 20px 16px; border-bottom:1px solid var(--line); }
.tsk-modal-head h3 { margin:0 0 3px; font-size:15px; font-weight:700; color:var(--t1); }
.tsk-modal-head p  { margin:0; font-size:12.5px; color:var(--t3); }
.tsk-modal-body { padding:20px; }
.tsk-modal-foot { padding:0 20px 18px; display:flex; gap:8px; justify-content:flex-end; }
.tsk-btn {
    height:38px; padding:0 16px; border-radius:8px; border:none;
    font:inherit; font-size:13px; font-weight:600; cursor:pointer;
    display:inline-flex; align-items:center; gap:6px; transition:background 120ms;
}
.tsk-btn.secondary { background:white; color:var(--t1); border:1px solid var(--line); }
.tsk-btn.secondary:hover { background:#f5f7fc; }
.tsk-btn.success { background:var(--ok); color:white; }
.tsk-btn.success:hover { background:#15803d; }

.tsk-mfield + .tsk-mfield { margin-top:14px; }
.tsk-label { display:block; font-size:12.5px; font-weight:600; color:var(--t2); margin-bottom:6px; }
.tsk-mselect, .tsk-input, .tsk-textarea {
    width:100%; border:1px solid var(--line); border-radius:8px;
    padding:0 12px; font-size:13.5px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; box-sizing:border-box; transition:border-color 150ms;
}
.tsk-mselect, .tsk-input { height:40px; }
.tsk-textarea { padding:10px 12px; resize:vertical; min-height:64px; }
.tsk-mselect:focus, .tsk-input:focus, .tsk-textarea:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }

@media (max-width:1023px) {
    .tsk-stats { grid-template-columns:repeat(2, 1fr); }
    .tsk-tab { padding:12px 14px; font-size:13px; }
    .tsk-tbl th, .tsk-tbl td { padding:9px 10px; }
    .tsk-card-head { padding:12px 16px; }
    .tsk-title { font-size:17px; margin-bottom:14px; }
    .tsk-hide-mobile { display:none; }
    .tsk-search-wrap { max-width:100%; }
    .tsk-search-input { font-size:16px !important; height:40px; }
    .tsk-mselect, .tsk-input { font-size:16px !important; height:46px; }
    .tsk-textarea { font-size:16px !important; }
    .tsk-modal-bg { padding:16px; align-items:flex-end; }
    .tsk-modal { border-radius:14px 14px 10px 10px; }
    .tsk-modal-foot { flex-direction:column-reverse; }
    .tsk-modal-foot .tsk-btn { width:100%; justify-content:center; height:44px; }
    .tsk-pagination { flex-direction:column; align-items:flex-start; gap:8px; }
}

@media (max-width:767px) {
    .tsk-stats { grid-template-columns:repeat(2, 1fr); }
}
</style>

<div class="tsk">

    <div class="tsk-title">Sanksi buku paket</div>

    {{-- ── STATS ── --}}
    @php $stats = $this->getStats(); @endphp
    <div class="tsk-stats">
        <div class="tsk-stat">
            <div class="tsk-stat-label">Total Sanksi</div>
            <div class="tsk-stat-val">{{ $stats['total'] }}</div>
        </div>
        <div class="tsk-stat danger">
            <div class="tsk-stat-label">Belum Lunas</div>
            <div class="tsk-stat-val">{{ $stats['belumLunas'] }}</div>
        </div>
        <div class="tsk-stat ok">
            <div class="tsk-stat-label">Lunas</div>
            <div class="tsk-stat-val">{{ $stats['lunas'] }}</div>
        </div>
        <div class="tsk-stat warn">
            <div class="tsk-stat-label">Rusak</div>
            <div class="tsk-stat-val">{{ $stats['rusak'] }}</div>
        </div>
        <div class="tsk-stat danger">
            <div class="tsk-stat-label">Hilang</div>
            <div class="tsk-stat-val">{{ $stats['hilang'] }}</div>
        </div>
    </div>

    {{-- ── MAIN TABS ── --}}
    <div class="tsk-tabs">
        <button type="button" class="tsk-tab {{ $activeTab === 'belum_lunas' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'belum_lunas')">
            Belum Lunas
            @if($stats['belumLunas'] > 0)<span class="tsk-tab-badge">{{ $stats['belumLunas'] }}</span>@endif
        </button>
        <button type="button" class="tsk-tab {{ $activeTab === 'riwayat' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'riwayat')">
            Riwayat / Lunas
        </button>
    </div>

    <div class="tsk-card">

        @php $data = $this->getData(); @endphp

        <div class="tsk-card-head">
            <span class="tsk-card-count">{{ $data->total() }} data</span>
        </div>

        <div class="tsk-search-bar">
            <div class="tsk-search-wrap">
                <svg class="tsk-search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" class="tsk-search-input"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari nama siswa..."
                    autocomplete="off">
                @if($search)
                <button class="tsk-search-clear" wire:click="$set('search', '')" type="button">×</button>
                @endif
            </div>
        </div>

        <div style="padding:0;">
            @if($data->total() === 0)
            <div class="tsk-empty">
                <div class="tsk-empty-icon">⚠️</div>
                <div>Tidak ada data sanksi</div>
            </div>
            @else
            <div class="tsk-tbl-wrap">
            <table class="tsk-tbl">
                <thead>
                    <tr>
                        <th class="center tsk-hide-mobile">No</th>
                        <th>Siswa</th>
                        <th>Buku Paket</th>
                        <th class="tsk-hide-mobile">Kondisi</th>
                        <th>Nominal</th>
                        <th>Status</th>
                        @if($activeTab === 'belum_lunas')<th>Aksi</th>@endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    @php
                        $kondisiClass = match($item->kondisi_kembali) {
                            'baik'         => 'ok',
                            'rusak_ringan' => 'warn',
                            'rusak_berat', 'hilang' => 'danger',
                            default        => 'gray',
                        };
                        $kondisiLabel = match($item->kondisi_kembali) {
                            'baik'         => 'Baik',
                            'rusak_ringan' => 'Rusak Ringan',
                            'rusak_berat'  => 'Rusak Berat',
                            'hilang'       => 'Hilang',
                            default        => '—',
                        };
                    @endphp
                    <tr>
                        <td class="no tsk-hide-mobile">{{ $data->firstItem() + $loop->index }}</td>

                        <td>
                            <div class="cell-main">{{ $item->member?->nama ?? '—' }}</div>
                            <div class="cell-sub">Kelas {{ $item->member?->kelas ?? '—' }}</div>
                        </td>

                        <td>
                            <div class="cell-main">{{ $item->textbookItem?->textbook?->judul ?? '—' }}</div>
                            <div class="cell-sub cell-code">{{ $item->textbookItem?->kode_item }}</div>
                        </td>

                        <td class="tsk-hide-mobile">
                            <span class="tsk-badge {{ $kondisiClass }}">{{ $kondisiLabel }}</span>
                        </td>

                        <td class="cell-red">
                            {{ $item->nominal_sanksi ? 'Rp ' . number_format($item->nominal_sanksi, 0, ',', '.') : '—' }}
                        </td>

                        <td>
                            @if($item->status_sanksi === 'belum_lunas')
                                <span class="tsk-badge danger">Belum Lunas</span>
                            @else
                                <span class="tsk-badge ok">Lunas</span>
                            @endif
                        </td>

                        @if($activeTab === 'belum_lunas')
                        <td>
                            <button type="button" class="tsk-btn-act"
                                wire:click="bukaModal({{ $item->id }})">Tandai Lunas</button>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            {{-- ── Pagination ── --}}
            @if($data->hasPages())
            <div class="tsk-pagination">
                <span>Menampilkan {{ $data->firstItem() }}–{{ $data->lastItem() }} dari {{ $data->total() }} data</span>
                <div class="tsk-pg-btns">
                    <button class="tsk-pg-btn {{ $data->onFirstPage() ? 'disabled' : '' }}"
                        wire:click="prevPage" {{ $data->onFirstPage() ? 'disabled' : '' }}>‹</button>
                    @foreach($data->getUrlRange(1, $data->lastPage()) as $pg => $url)
                    <button class="tsk-pg-btn {{ $pg == $data->currentPage() ? 'active' : '' }}"
                        wire:click="$set('page', {{ $pg }})">{{ $pg }}</button>
                    @endforeach
                    <button class="tsk-pg-btn {{ !$data->hasMorePages() ? 'disabled' : '' }}"
                        wire:click="nextPage" {{ !$data->hasMorePages() ? 'disabled' : '' }}>›</button>
                </div>
            </div>
            @endif
            @endif
        </div>

    </div>{{-- /.tsk-card --}}

    {{-- ── MODAL TANDAI LUNAS ── --}}
    @if($showModal)
    <div class="tsk-modal-bg" wire:click.self="tutupModal">
        <div class="tsk-modal">
            <div class="tsk-modal-head">
                <h3>Tandai Lunas</h3>
                <p>Catat penyelesaian sanksi buku paket</p>
            </div>
            <div class="tsk-modal-body">

                <div class="tsk-mfield">
                    <label class="tsk-label" for="tsk-m-penyelesaian">Diselesaikan dengan</label>
                    <select id="tsk-m-penyelesaian" class="tsk-mselect" wire:model="modalPenyelesaian">
                        <option value="bayar_harga">Sudah Bayar Harga Buku</option>
                        <option value="ganti_buku">Sudah Ganti Buku</option>
                    </select>
                </div>

                @if($modalPenyelesaian === 'bayar_harga')
                <div class="tsk-mfield">
                    <label class="tsk-label">Nominal Dibayar (Rp)</label>
                    <input type="number" class="tsk-input" wire:model="modalNominal"
                        placeholder="Contoh: 75000" min="0" step="1000">
                </div>
                @endif

                <div class="tsk-mfield">
                    <label class="tsk-label">Catatan Penyelesaian <span style="color:var(--t3);font-weight:400;">(opsional)</span></label>
                    <textarea class="tsk-textarea" wire:model="modalCatatan" rows="2"></textarea>
                </div>

            </div>
            <div class="tsk-modal-foot">
                <button type="button" class="tsk-btn secondary" wire:click="tutupModal">Batal</button>
                <button type="button" class="tsk-btn success" wire:click="simpanLunas">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    Simpan
                </button>
            </div>
        </div>
    </div>
    @endif

</div>
</x-filament-panels::page>
