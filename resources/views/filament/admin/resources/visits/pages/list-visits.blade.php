<x-filament-panels::page>
<style>
.kjn {
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
.kjn-title { font-size:20px; font-weight:800; color:var(--t1); letter-spacing:-.02em; margin-bottom:20px; }
.kjn-stats-wrap { margin-bottom:18px; }

/* ── Main tabs ── */
.kjn-tabs {
    display:flex; gap:0; background:var(--panel);
    border-radius:var(--r) var(--r) 0 0;
    border:1px solid var(--line); border-bottom:none; overflow:hidden;
}
.kjn-tab {
    flex:1; padding:14px 20px; background:none; border:none; cursor:pointer;
    font:inherit; font-size:13.5px; font-weight:600; color:var(--t3);
    display:flex; align-items:center; justify-content:center; gap:8px;
    transition:color 150ms, background 150ms;
    border-bottom:2px solid transparent; margin-bottom:-1px; position:relative;
}
.kjn-tab:hover { background:#f8f9fc; color:var(--t2); }
.kjn-tab.active { color:var(--pri); border-bottom-color:var(--pri); background:var(--pri-50); }

/* Judul halaman bawaan Filament (breadcrumb + judul) disembunyikan karena sudah ada judul kustom di dalam konten */
header.fi-header { display:none; }
.kjn-tab-badge {
    background:var(--err); color:white;
    border-radius:999px; font-size:11px; font-weight:700;
    padding:1px 7px; min-width:20px; text-align:center;
}

/* ── Card ── */
.kjn-card {
    background:var(--panel); border:1px solid var(--line);
    border-radius:0 0 var(--r) var(--r); box-shadow:var(--sh); overflow:hidden;
}
.kjn-card-head {
    padding:16px 20px 14px; border-bottom:1px solid var(--line);
    display:flex; align-items:center; gap:8px; flex-wrap:wrap;
}
.kjn-card-title { font-size:14px; font-weight:700; color:var(--t1); }
.kjn-card-count { font-size:12px; color:var(--t3); margin-left:4px; }

/* ── Filter bar ── */
.kjn-filter-bar { padding:10px 20px; border-bottom:1px solid var(--line); display:flex; align-items:center; gap:10px; flex-wrap:wrap; }
.kjn-search-wrap { position:relative; flex:1; min-width:180px; max-width:280px; }
.kjn-search-icon { position:absolute; left:11px; top:50%; transform:translateY(-50%); color:var(--t3); pointer-events:none; }
.kjn-search-input {
    width:100%; height:34px; border:1px solid var(--line); border-radius:8px;
    padding:0 30px 0 33px; font-size:13px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; box-sizing:border-box; transition:border-color 150ms;
}
.kjn-search-input:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.kjn-search-clear {
    position:absolute; right:8px; top:50%; transform:translateY(-50%);
    background:none; border:none; cursor:pointer; color:var(--t3); font-size:17px;
    line-height:1; padding:2px; display:flex; align-items:center;
}
.kjn-search-clear:hover { color:var(--t1); }
.kjn-filter-select, .kjn-filter-date {
    height:34px; border:1px solid var(--line); border-radius:8px;
    padding:0 10px; font-size:12.5px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; cursor:pointer; transition:border-color 150ms;
}
.kjn-filter-select { min-width:140px; }
.kjn-filter-date { min-width:130px; cursor:text; }
.kjn-filter-select:focus, .kjn-filter-date:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }

/* ── Bulk bar ── */
.kjn-bulk-bar {
    padding:10px 20px; border-bottom:1px solid var(--line);
    background:var(--err-50); display:flex; align-items:center; justify-content:space-between;
    flex-wrap:wrap; gap:8px;
}
.kjn-bulk-text { font-size:12.5px; font-weight:600; color:var(--err); }
.kjn-bulk-actions { display:flex; gap:8px; }

/* ── Table ── */
.kjn-tbl-wrap { overflow-x:auto; }
.kjn-tbl { width:100%; border-collapse:collapse; font-size:13px; table-layout:auto; }
.kjn-tbl thead tr { background:#f8f9fc; border-bottom:1px solid var(--line); }
.kjn-tbl th {
    padding:10px 14px; text-align:left; font-size:11.5px; font-weight:700;
    text-transform:uppercase; letter-spacing:.06em; color:var(--t3); white-space:nowrap;
}
.kjn-tbl th.center { text-align:center; }
.kjn-tbl tbody tr { border-bottom:1px solid #f1f3f8; transition:background 80ms; }
.kjn-tbl tbody tr:last-child { border-bottom:none; }
.kjn-tbl tbody tr:hover { background:#f8f9fc; }
.kjn-tbl td { padding:11px 14px; vertical-align:middle; color:var(--t1); }
.kjn-tbl td.center { text-align:center; }
.kjn-tbl td.no { color:var(--t3); font-size:12px; text-align:center; width:44px; }
.kjn-tbl td.chk { width:36px; text-align:center; }
.kjn-tbl .cell-main { font-weight:600; margin-bottom:2px; }
.kjn-tbl .cell-sub { font-size:12px; color:var(--t3); font-weight:400; }
.kjn-chk { width:16px; height:16px; cursor:pointer; accent-color:var(--pri); }

/* ── Badges ── */
.kjn-badge { display:inline-block; padding:2px 10px; border-radius:999px; font-size:11.5px; font-weight:600; white-space:nowrap; }
.kjn-badge.ok      { background:var(--ok-50); color:var(--ok); }
.kjn-badge.danger  { background:var(--err-50); color:var(--err); }
.kjn-badge.warn    { background:var(--warn-50); color:var(--warn); }
.kjn-badge.gray    { background:#f1f3f8; color:var(--t2); }
.kjn-badge.info    { background:var(--pri-50); color:var(--pri); }

/* ── Action button ── */
.kjn-btn-act {
    padding:5px 12px; border-radius:7px; border:1px solid #fca5a5;
    background:var(--err-50); color:var(--err); font:inherit; font-size:12px;
    font-weight:600; cursor:pointer; white-space:nowrap;
    transition:background 120ms, color 120ms, border-color 120ms;
}
.kjn-btn-act:hover { background:var(--err); color:white; border-color:var(--err); }

/* ── Empty state ── */
.kjn-empty { padding:48px 20px; text-align:center; color:var(--t3); font-size:13.5px; }
.kjn-empty-icon { font-size:32px; margin-bottom:10px; opacity:.4; }

/* ── Pagination ── */
.kjn-pagination {
    display:flex; align-items:center; justify-content:space-between;
    padding:12px 20px; border-top:1px solid var(--line);
    font-size:12.5px; color:var(--t3); flex-wrap:wrap; gap:8px;
}
.kjn-pg-btns { display:flex; gap:4px; flex-wrap:wrap; }
.kjn-pg-btn {
    min-width:30px; height:30px; padding:0 8px; border-radius:7px;
    border:1px solid var(--line); background:white; font-size:12px; font-weight:500;
    color:#0f172a; cursor:pointer; font-family:inherit;
    display:inline-flex; align-items:center; justify-content:center; transition:background 100ms;
}
.kjn-pg-btn:hover:not(.disabled):not(.active) { background:#f5f7fc; }
.kjn-pg-btn.active { background:#1e3a8a; color:white; border-color:#1e3a8a; font-weight:600; }
.kjn-pg-btn.disabled { opacity:.4; cursor:not-allowed; }

/* ── Modal ── */
.kjn-modal-bg {
    position:fixed; inset:0; background:rgba(15,23,42,.5);
    z-index:9999; display:flex; align-items:flex-start; justify-content:center;
    padding:40px 20px; overflow-y:auto;
}
.kjn-modal {
    background:white; border-radius:14px; width:100%; max-width:420px;
    overflow:hidden; box-shadow:0 20px 48px rgba(15,23,42,.18);
    animation:kjnUp 160ms ease; margin:auto;
}
@keyframes kjnUp { from { transform:translateY(14px); opacity:0; } to { transform:translateY(0); opacity:1; } }
.kjn-modal-head { padding:18px 20px 16px; border-bottom:1px solid var(--line); }
.kjn-modal-head h3 { margin:0 0 3px; font-size:15px; font-weight:700; color:var(--t1); }
.kjn-modal-head p  { margin:0; font-size:12.5px; color:var(--t3); }
.kjn-modal-foot { padding:18px 20px; display:flex; gap:8px; justify-content:flex-end; }
.kjn-btn {
    height:38px; padding:0 16px; border-radius:8px; border:none;
    font:inherit; font-size:13px; font-weight:600; cursor:pointer;
    display:inline-flex; align-items:center; gap:6px; transition:background 120ms;
}
.kjn-btn.secondary { background:white; color:var(--t1); border:1px solid var(--line); }
.kjn-btn.secondary:hover { background:#f5f7fc; }
.kjn-btn.danger { background:var(--err); color:white; }
.kjn-btn.danger:hover { background:#b91c1c; }

@media (max-width:1023px) {
    .kjn-tab { padding:12px 14px; font-size:13px; }
    .kjn-tbl th, .kjn-tbl td { padding:9px 10px; }
    .kjn-card-head { padding:12px 16px; }
    .kjn-title { font-size:17px; margin-bottom:14px; }
    .kjn-hide-mobile { display:none; }
    .kjn-search-wrap { max-width:100%; min-width:0; flex:1 1 100%; }
    .kjn-search-input { font-size:16px !important; height:40px; }
    .kjn-filter-select, .kjn-filter-date { font-size:16px !important; height:40px; flex:1; min-width:0; }
    .kjn-modal-bg { padding:16px; align-items:flex-end; }
    .kjn-modal { border-radius:14px 14px 10px 10px; }
    .kjn-modal-foot { flex-direction:column-reverse; }
    .kjn-modal-foot .kjn-btn { width:100%; justify-content:center; height:44px; }
    .kjn-pagination { flex-direction:column; align-items:flex-start; gap:8px; }
}

</style>

<div class="kjn">

    <div class="kjn-title">Data kunjungan</div>

    {{-- ── STATS WIDGET (reused, sudah benar) ── --}}
    <div class="kjn-stats-wrap">
        @livewire(\App\Filament\Widgets\VisitStatsWidget::class)
    </div>

    {{-- ── MAIN TABS ── --}}
    @php $counts = $this->getTabCounts(); @endphp
    <div class="kjn-tabs">
        <button type="button" class="kjn-tab {{ $activeTab === 'hari_ini' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'hari_ini')">
            Hari Ini
            @if($counts['hari_ini'] > 0)<span class="kjn-tab-badge">{{ $counts['hari_ini'] }}</span>@endif
        </button>
        <button type="button" class="kjn-tab {{ $activeTab === 'minggu_ini' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'minggu_ini')">
            Minggu Ini
            @if($counts['minggu_ini'] > 0)<span class="kjn-tab-badge">{{ $counts['minggu_ini'] }}</span>@endif
        </button>
        <button type="button" class="kjn-tab {{ $activeTab === 'bulan_ini' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'bulan_ini')">
            Bulan Ini
            @if($counts['bulan_ini'] > 0)<span class="kjn-tab-badge">{{ $counts['bulan_ini'] }}</span>@endif
        </button>
        <button type="button" class="kjn-tab {{ $activeTab === 'semua' ? 'active' : '' }}"
            wire:click="$set('activeTab', 'semua')">
            Semua
        </button>
    </div>

    <div class="kjn-card">

        @php $data = $this->getData(); @endphp

        <div class="kjn-card-head">
            <span class="kjn-card-count">{{ $data->total() }} data</span>
        </div>

        <div class="kjn-filter-bar">
            <div class="kjn-search-wrap">
                <svg class="kjn-search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" class="kjn-search-input"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari nama pengunjung..."
                    autocomplete="off">
                @if($search)
                <button class="kjn-search-clear" wire:click="$set('search', '')" type="button">×</button>
                @endif
            </div>

            <input type="date" class="kjn-filter-date" wire:model.live="filterDari" title="Dari tanggal">
            <input type="date" class="kjn-filter-date" wire:model.live="filterSampai" title="Sampai tanggal">

            <select class="kjn-filter-select" wire:model.live="filterJenis">
                <option value="">Semua Jenis</option>
                <option value="siswa">Siswa</option>
                <option value="guru">Guru / Staf</option>
                <option value="umum">Tamu</option>
            </select>

            <select class="kjn-filter-select" wire:model.live="filterKeperluan">
                <option value="">Semua Keperluan</option>
                <option value="Membaca">Membaca Buku</option>
                <option value="Meminjam Buku">Meminjam Buku</option>
                <option value="Mengembalikan Buku">Mengembalikan Buku</option>
                <option value="Belajar / Mengerjakan Tugas">Belajar / Tugas</option>
                <option value="Mencari Referensi">Mencari Referensi</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        {{-- ── Bulk bar ── --}}
        @if(count($selected) > 0)
        <div class="kjn-bulk-bar">
            <span class="kjn-bulk-text">{{ count($selected) }} kunjungan dipilih</span>
            <div class="kjn-bulk-actions">
                <button type="button" class="kjn-btn-act" style="background:white; color:var(--t2); border-color:var(--line-2);" wire:click="clearSelection">Batal Pilih</button>
                <button type="button" class="kjn-btn-act" wire:click="bukaHapusTerpilih">Hapus Terpilih</button>
            </div>
        </div>
        @endif

        <div style="padding:0;">
            @if($data->total() === 0)
            <div class="kjn-empty">
                <div class="kjn-empty-icon">🚪</div>
                <div>Tidak ada data kunjungan</div>
            </div>
            @else
            @php $pageIds = $data->pluck('id')->map(fn ($id) => (string) $id)->toArray(); @endphp
            <div class="kjn-tbl-wrap">
            <table class="kjn-tbl">
                <thead>
                    <tr>
                        <th class="chk">
                            <input type="checkbox" class="kjn-chk"
                                wire:click="toggleSelectAllPage"
                                @checked(!empty($pageIds) && empty(array_diff($pageIds, $selected)))>
                        </th>
                        <th class="center kjn-hide-mobile">No</th>
                        <th>Pengunjung</th>
                        <th class="kjn-hide-mobile">Jenis</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $visit)
                    @php
                        $jenisLabel = match($visit->jenis_pengunjung) {
                            'siswa' => 'Siswa', 'guru' => 'Guru', 'umum' => 'Tamu', default => '—',
                        };
                        $jenisClass = match($visit->jenis_pengunjung) {
                            'siswa' => 'info', 'guru' => 'warn', default => 'gray',
                        };
                        $subLine = implode(' · ', array_filter([
                            match ($visit->jenis_pengunjung) {
                                'siswa' => $visit->kelas ? 'Kelas ' . $visit->kelas : 'Siswa',
                                'guru'  => 'Guru / Staf',
                                default => 'Tamu',
                            },
                            $visit->keperluan ?: null,
                            $visit->jam_kunjungan ? substr($visit->jam_kunjungan, 0, 5) : null,
                        ]));
                    @endphp
                    <tr>
                        <td class="chk">
                            <input type="checkbox" class="kjn-chk" wire:model.live="selected" value="{{ $visit->id }}">
                        </td>
                        <td class="no kjn-hide-mobile">{{ $data->firstItem() + $loop->index }}</td>

                        <td>
                            <div class="cell-main">{{ $visit->nama }}</div>
                            <div class="cell-sub">{{ $subLine }}</div>
                        </td>

                        <td class="kjn-hide-mobile">
                            <span class="kjn-badge {{ $jenisClass }}">{{ $jenisLabel }}</span>
                        </td>

                        <td class="muted" style="white-space:nowrap;">
                            {{ $visit->tgl_kunjungan?->translatedFormat('d M Y') ?? '—' }}
                        </td>

                        <td>
                            <button type="button" class="kjn-btn-act"
                                wire:click="bukaHapus({{ $visit->id }})">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            {{-- ── Pagination ── --}}
            @if($data->hasPages())
            <div class="kjn-pagination">
                <span>Menampilkan {{ $data->firstItem() }}–{{ $data->lastItem() }} dari {{ $data->total() }} data</span>
                <div class="kjn-pg-btns">
                    <button class="kjn-pg-btn {{ $data->onFirstPage() ? 'disabled' : '' }}"
                        wire:click="prevPage" {{ $data->onFirstPage() ? 'disabled' : '' }}>‹</button>
                    @foreach($data->getUrlRange(1, $data->lastPage()) as $pg => $url)
                    <button class="kjn-pg-btn {{ $pg == $data->currentPage() ? 'active' : '' }}"
                        wire:click="$set('page', {{ $pg }})">{{ $pg }}</button>
                    @endforeach
                    <button class="kjn-pg-btn {{ !$data->hasMorePages() ? 'disabled' : '' }}"
                        wire:click="nextPage" {{ !$data->hasMorePages() ? 'disabled' : '' }}>›</button>
                </div>
            </div>
            @endif
            @endif
        </div>

    </div>{{-- /.kjn-card --}}

    {{-- ── MODAL HAPUS ── --}}
    @if($showDeleteModal)
    <div class="kjn-modal-bg" wire:click.self="batalHapus">
        <div class="kjn-modal">
            <div class="kjn-modal-head">
                <h3>Hapus Data Kunjungan</h3>
                <p>
                    @if(count($deleteTargetIds) > 1)
                        {{ count($deleteTargetIds) }} data kunjungan akan dihapus permanen. Tindakan ini tidak dapat dibatalkan.
                    @else
                        Data kunjungan ini akan dihapus permanen. Tindakan ini tidak dapat dibatalkan.
                    @endif
                </p>
            </div>
            <div class="kjn-modal-foot">
                <button type="button" class="kjn-btn secondary" wire:click="batalHapus">Batal</button>
                <button type="button" class="kjn-btn danger" wire:click="konfirmasiHapus">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
    @endif

</div>
</x-filament-panels::page>
