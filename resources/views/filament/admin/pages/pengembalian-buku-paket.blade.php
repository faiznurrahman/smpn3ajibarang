<x-filament-panels::page>
<style>
.pbp {
    --pri:#1e3a8a; --pri-2:#2746a4; --pri-50:#eef2ff; --pri-100:#dbe3ff;
    --ok:#16a34a;  --ok-50:#e6f7ed;
    --warn:#b45309; --warn-50:#fffbeb;
    --err:#dc2626; --err-50:#fee2e2;
    --t1:#0f172a; --t2:#5a6478; --t3:#8b94a6;
    --line:#e6eaf2; --line-2:#d4dae6;
    --panel:#fff;
    --r:14px; --sh:0 1px 2px rgba(15,23,42,.04);
}

/* ── Card ── */
.pbp-card { background:var(--panel); border:1px solid var(--line); border-radius:var(--r); box-shadow:var(--sh); margin-bottom:16px; }
.pbp-card-head { padding:16px 22px 14px; border-bottom:1px solid var(--line); display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px; }
.pbp-card-title { font-size:14px; font-weight:700; color:var(--t1); }
.pbp-card-body  { padding:22px; }

/* ── Filter row ── */
.pbp-filter-row { display:flex; gap:12px; align-items:flex-end; flex-wrap:wrap; }
.pbp-filter-item { flex:1; min-width:180px; }
.pbp-label { display:block; font-size:12.5px; font-weight:600; color:var(--t2); margin-bottom:6px; }
.pbp-select {
    width:100%; height:40px; border:1px solid var(--line); border-radius:8px;
    padding:0 12px; font-size:13.5px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; cursor:pointer; box-sizing:border-box;
    transition:border-color 150ms;
}
.pbp-select:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }

/* ── Search bar ── */
.pbp-search-bar { padding:12px 22px; border-bottom:1px solid var(--line); display:flex; align-items:center; gap:10px; }
.pbp-search-wrap { position:relative; flex:1; max-width:360px; }
.pbp-search-icon { position:absolute; left:11px; top:50%; transform:translateY(-50%); color:var(--t3); pointer-events:none; }
.pbp-search-input {
    width:100%; height:36px; border:1px solid var(--line); border-radius:8px;
    padding:0 32px 0 34px; font-size:13px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; box-sizing:border-box; transition:border-color 150ms;
}
.pbp-search-input:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.pbp-search-clear {
    position:absolute; right:8px; top:50%; transform:translateY(-50%);
    background:none; border:none; cursor:pointer; color:var(--t3); font-size:17px;
    line-height:1; padding:2px; display:flex; align-items:center;
}
.pbp-search-clear:hover { color:var(--t1); }

/* ── Buttons ── */
.pbp-btn {
    height:40px; padding:0 18px; border-radius:8px; border:none;
    font:inherit; font-size:13.5px; font-weight:600; cursor:pointer;
    display:inline-flex; align-items:center; gap:7px; transition:background 120ms;
    flex-shrink:0;
}
.pbp-btn.primary { background:var(--pri); color:white; box-shadow:0 1px 2px rgba(30,58,138,.2); }
.pbp-btn.primary:hover { background:var(--pri-2); }
.pbp-btn.primary:disabled { background:#9fa9c1; cursor:not-allowed; box-shadow:none; }
.pbp-btn.success { background:var(--ok); color:white; box-shadow:0 1px 2px rgba(22,163,74,.2); }
.pbp-btn.success:hover { background:#15803d; }
.pbp-btn.danger  { background:var(--err); color:white; }
.pbp-btn.danger:hover  { background:#b91c1c; }
.pbp-btn.secondary { background:white; color:var(--t1); border:1px solid var(--line); }
.pbp-btn.secondary:hover { background:#f5f7fc; border-color:var(--line-2); }
.pbp-btn.outline-ok {
    background:var(--ok-50); color:var(--ok); border:1px solid var(--ok);
    font-size:12px; height:34px; padding:0 14px;
}
.pbp-btn.outline-ok:hover { background:var(--ok); color:white; }

/* ── Error ── */
.pbp-error {
    display:flex; align-items:center; gap:8px; padding:10px 14px;
    background:var(--err-50); border:1px solid #fca5a5; border-radius:8px;
    font-size:12.5px; color:var(--err); font-weight:500; margin-top:12px;
}

/* ── Table ── */
.pbp-tbl-wrap { overflow-x:auto; }
.pbp-tbl { width:100%; border-collapse:collapse; font-size:13px; table-layout:auto; }
.pbp-tbl thead tr { background:#f8f9fc; border-bottom:1px solid var(--line); }
.pbp-tbl th {
    padding:10px 14px; text-align:left; font-size:11.5px; font-weight:700;
    text-transform:uppercase; letter-spacing:.06em; color:var(--t3); white-space:nowrap;
}
.pbp-tbl th.center { text-align:center; }
.pbp-tbl tbody tr { border-bottom:1px solid #f1f3f8; transition:background 80ms; }
.pbp-tbl tbody tr:last-child { border-bottom:none; }
.pbp-tbl tbody tr:hover { background:#f8f9fc; }
.pbp-tbl td { padding:11px 14px; vertical-align:middle; color:var(--t1); }
.pbp-tbl td.center { text-align:center; }
.pbp-tbl td.no { color:var(--t3); font-size:12px; text-align:center; width:44px; }
.pbp-tbl td.muted { color:var(--t3); }
.pbp-tbl .cell-main { font-weight:600; margin-bottom:2px; }
.pbp-tbl .cell-sub  { font-size:12px; color:var(--t3); }
.pbp-tbl .cell-code { font-family:'SF Mono','Fira Code',ui-monospace,monospace; font-size:11.5px; }

/* ── Badge ── */
.pbp-badge {
    display:inline-block; padding:2px 10px; border-radius:999px;
    font-size:11.5px; font-weight:600; white-space:nowrap;
}
.pbp-badge.ok      { background:var(--ok-50); color:var(--ok); }
.pbp-badge.danger  { background:var(--err-50); color:var(--err); }
.pbp-badge.warn    { background:var(--warn-50); color:var(--warn); }
.pbp-badge.gray    { background:#f1f3f8; color:var(--t2); }
.pbp-badge.pending { background:var(--pri-50); color:var(--pri); }

/* ── Btn action in table ── */
.pbp-btn-tbl {
    padding:4px 12px; border-radius:7px; border:1px solid var(--pri-100);
    background:var(--pri-50); color:var(--pri); font:inherit; font-size:12px;
    font-weight:600; cursor:pointer; white-space:nowrap; transition:background 120ms;
}
.pbp-btn-tbl:hover { background:var(--pri); color:white; border-color:var(--pri); }

/* ── Empty state ── */
.pbp-empty { padding:48px 20px; text-align:center; color:var(--t3); font-size:13.5px; }
.pbp-empty-icon { font-size:32px; margin-bottom:10px; opacity:.4; }

/* ── Modal ── */
.pbp-modal-bg {
    position:fixed; inset:0; background:rgba(15,23,42,.5);
    z-index:9999; display:flex; align-items:center; justify-content:center; padding:20px;
}
.pbp-modal-bg.z-top { z-index:10000; }
.pbp-modal {
    background:white; border-radius:var(--r); width:100%; max-width:440px;
    overflow:hidden; box-shadow:0 20px 48px rgba(15,23,42,.18);
    animation:pbpUp 160ms ease;
}
.pbp-modal-lg { max-width:720px; }
@keyframes pbpUp {
    from { transform:translateY(14px); opacity:0; }
    to   { transform:translateY(0); opacity:1; }
}
.pbp-modal-head { padding:18px 22px 15px; border-bottom:1px solid var(--line); }
.pbp-modal-head h3 { margin:0 0 3px; font-size:15px; font-weight:700; color:var(--t1); }
.pbp-modal-head p  { margin:0; font-size:12.5px; color:var(--t3); }
.pbp-modal-body { padding:18px 22px; }
.pbp-modal-body.scroll { padding:0; max-height:380px; overflow-y:auto; overflow-x:auto; }
.pbp-modal-foot { padding:14px 22px 18px; display:flex; gap:8px; justify-content:flex-end; border-top:1px solid var(--line); }

.pbp-mfield + .pbp-mfield { margin-top:14px; }
.pbp-input {
    width:100%; height:40px; border:1px solid var(--line); border-radius:8px;
    padding:0 12px; font-size:13.5px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; box-sizing:border-box; transition:border-color 150ms;
}
.pbp-input:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.pbp-mselect {
    width:100%; height:40px; border:1px solid var(--line); border-radius:8px;
    padding:0 12px; font-size:13.5px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; cursor:pointer; box-sizing:border-box;
    transition:border-color 150ms;
}
.pbp-mselect:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.pbp-textarea {
    width:100%; border:1px solid var(--line); border-radius:8px;
    padding:10px 12px; font-size:13.5px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; resize:vertical; min-height:68px;
    box-sizing:border-box; transition:border-color 150ms;
}
.pbp-textarea:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }

.pbp-sanksi-box {
    margin-top:14px; padding:14px 16px; background:#f8f9fc;
    border:1px solid var(--line); border-radius:9px;
}
.pbp-sanksi-box > * + * { margin-top:12px; }

@keyframes spin { to { transform:rotate(360deg); } }

@media (max-width:1023px) {
    .pbp-card-head { padding:12px 16px; }
    .pbp-card-body { padding:16px; }
    .pbp-filter-row { flex-direction:column; gap:10px; }
    .pbp-filter-item { min-width:0; }
    .pbp-select, .pbp-input, .pbp-mselect { font-size:16px !important; height:46px; }
    .pbp-textarea { font-size:16px !important; }
    .pbp-tbl th, .pbp-tbl td { padding:9px 10px; }
    .pbp-modal-lg { max-width:100%; }
    .pbp-modal-body.scroll { max-height:300px; }
    .pbp-modal-foot { flex-direction:column-reverse; }
    .pbp-modal-foot .pbp-btn { width:100%; justify-content:center; height:44px; }
    .pbp-search-bar { padding:10px 16px; }
    .pbp-search-input { font-size:16px !important; height:42px; }
}
</style>

<div class="pbp">

    {{-- ── FILTER CARD ── --}}
    <div class="pbp-card">
        <div class="pbp-card-head">
            <span class="pbp-card-title">Pengembalian Buku Paket</span>
        </div>
        <div class="pbp-card-body">

            <div class="pbp-filter-row">

                {{-- Pilih distribusi --}}
                <div class="pbp-filter-item" style="flex:2;">
                    <label class="pbp-label" for="pbp-dist">Distribusi Aktif</label>
                    <select id="pbp-dist" class="pbp-select" wire:model.live="distributionId">
                        <option value="">— Pilih distribusi —</option>
                        @foreach($this->getActiveDistributions() as $dist)
                        <option value="{{ $dist->id }}">
                            Kelas {{ $dist->untuk_tingkat }} — {{ $dist->tahun_ajaran }}
                            ({{ $dist->tgl_distribusi?->translatedFormat('d M Y') }})
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Pilih kelas --}}
                <div class="pbp-filter-item">
                    <label class="pbp-label" for="pbp-kelas">Kelas</label>
                    <select
                        id="pbp-kelas"
                        class="pbp-select"
                        wire:model="selectedKelas"
                        @if(!$distributionId) disabled @endif
                    >
                        <option value="">— Pilih kelas —</option>
                        @foreach($kelasOptions as $kelas)
                        <option value="{{ $kelas }}">Kelas {{ $kelas }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Tombol tampilkan --}}
                <div style="flex-shrink:0;">
                    <button
                        type="button"
                        class="pbp-btn primary"
                        wire:click="tampilkan"
                        wire:loading.attr="disabled"
                        wire:target="tampilkan"
                        style="margin-top:21px;"
                    >
                        <svg wire:loading.remove wire:target="tampilkan" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <svg wire:loading wire:target="tampilkan" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="animation:spin 1s linear infinite"><path d="M21 12a9 9 0 1 1-18 0"/></svg>
                        Tampilkan
                    </button>
                </div>
            </div>

            @if($error)
            <div class="pbp-error">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                {{ $error }}
            </div>
            @endif

        </div>
    </div>

    {{-- ── TABLE CARD ── --}}
    @if(!empty($items))
    @php
        $totalSiswa     = count($items);
        $siswaSelesai   = collect($items)->filter(fn($m) => $m['status'] === 'semua_kembali')->count();
        $bukuBelumTotal = collect($items)->sum(fn($m) => $m['jumlah_buku'] - $m['kembali']);
    @endphp

    <div class="pbp-card" x-data="{ search: '' }">
        <div class="pbp-card-head">
            <span class="pbp-card-title">
                Buku Paket — Kelas {{ $selectedKelas }}
                <span style="font-weight:400; color:var(--t3); font-size:13px;">
                    ({{ $siswaSelesai }}/{{ $totalSiswa }} siswa selesai)
                </span>
            </span>

            @if($bukuBelumTotal > 0)
            <button
                type="button"
                class="pbp-btn outline-ok"
                wire:click="$set('showBulkModal', true)"
            >
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                Kembalikan Semua Buku Belum Kembali
            </button>
            @endif
        </div>

        {{-- Search bar --}}
        <div class="pbp-search-bar">
            <div class="pbp-search-wrap">
                <svg class="pbp-search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input
                    type="text"
                    class="pbp-search-input"
                    x-model="search"
                    placeholder="Cari nama siswa..."
                    autocomplete="off"
                >
                <button
                    class="pbp-search-clear"
                    x-show="search"
                    x-cloak
                    @click="search = ''"
                    type="button"
                    title="Hapus pencarian"
                >×</button>
            </div>
        </div>

        <div class="pbp-card-body" style="padding:0;">
            <div class="pbp-tbl-wrap">
            <table class="pbp-tbl">
                <thead>
                    <tr>
                        <th class="center" style="width:44px;">No</th>
                        <th>Nama Siswa</th>
                        <th class="center" style="width:120px;">Jumlah Buku</th>
                        <th style="width:170px;">Status</th>
                        <th class="center" style="width:110px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $i => $member)
                    <tr x-show="!search || {{ json_encode(strtolower($member['nama'])) }}.includes(search.toLowerCase())">
                        <td class="no">{{ $i + 1 }}</td>

                        <td>
                            <div class="cell-main">{{ $member['nama'] }}</div>
                            <div class="cell-sub">Kelas {{ $member['kelas'] }}</div>
                        </td>

                        <td class="center">
                            <span style="font-weight:600; color:var(--t1);">{{ $member['kembali'] }}</span><span style="color:var(--t3);">/{{ $member['jumlah_buku'] }}</span>
                            <div style="font-size:11px; color:var(--t3); margin-top:1px;">buku kembali</div>
                        </td>

                        <td>
                            @if($member['status'] === 'semua_kembali')
                                <span class="pbp-badge ok">Semua Kembali</span>
                            @elseif($member['status'] === 'sebagian_kembali')
                                <span class="pbp-badge warn">Sebagian Kembali</span>
                            @elseif($member['status'] === 'belum_kembali')
                                <span class="pbp-badge danger">Belum Kembali</span>
                            @elseif($member['status'] === 'ada_masalah')
                                <span class="pbp-badge danger">Ada Masalah</span>
                            @endif
                        </td>

                        <td class="center">
                            <button
                                type="button"
                                class="pbp-btn-tbl"
                                wire:click="lihatBuku({{ $member['member_id'] }})"
                            >Lihat Buku</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>

    @elseif($distributionId && $selectedKelas)
    <div class="pbp-card">
        <div class="pbp-card-body">
            <div class="pbp-empty">
                <div class="pbp-empty-icon">📋</div>
                <div>Tidak ada data untuk kelas yang dipilih</div>
            </div>
        </div>
    </div>
    @endif

    {{-- ════════════ MODAL LIHAT BUKU ════════════ --}}
    @if($showBooksModal)
    @php $modalMember = $this->getModalMemberData(); @endphp
    @if($modalMember)
    <div class="pbp-modal-bg" wire:click.self="tutupBooksModal">
        <div class="pbp-modal pbp-modal-lg">
            <div class="pbp-modal-head">
                <h3>{{ $modalMember['nama'] }}</h3>
                <p>
                    Kelas {{ $modalMember['kelas'] }} &nbsp;·&nbsp;
                    {{ $modalMember['kembali'] }}/{{ $modalMember['jumlah_buku'] }} buku dikembalikan
                    @if($modalMember['status'] === 'semua_kembali')
                        &nbsp;·&nbsp; <span style="color:#16a34a; font-weight:600;">Selesai</span>
                    @elseif($modalMember['status'] === 'ada_masalah')
                        &nbsp;·&nbsp; <span style="color:#dc2626; font-weight:600;">Ada Masalah</span>
                    @endif
                </p>
            </div>
            <div class="pbp-modal-body scroll">
                <table class="pbp-tbl">
                    <thead>
                        <tr>
                            <th>Buku Paket</th>
                            <th style="width:140px;">Kondisi Kembali</th>
                            <th style="width:95px;">Tgl Kembali</th>
                            <th style="width:115px;">Status Sanksi</th>
                            <th class="center" style="width:100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($modalMember['books'] as $book)
                        <tr>
                            <td>
                                <div class="cell-main">{{ $book['judul_buku'] }}</div>
                                <div class="cell-sub cell-code">{{ $book['kode_item'] }}</div>
                            </td>

                            <td>
                                @if(!$book['kondisi_kembali'])
                                    <span class="pbp-badge pending">Belum Kembali</span>
                                @elseif($book['kondisi_kembali'] === 'baik')
                                    <span class="pbp-badge ok">Baik</span>
                                @elseif($book['kondisi_kembali'] === 'rusak_ringan')
                                    <span class="pbp-badge warn">Rusak Ringan</span>
                                @elseif($book['kondisi_kembali'] === 'rusak_berat')
                                    <span class="pbp-badge danger">Rusak Berat</span>
                                @elseif($book['kondisi_kembali'] === 'hilang')
                                    <span class="pbp-badge danger">Hilang</span>
                                @else
                                    <span class="pbp-badge gray">{{ $book['kondisi_kembali'] }}</span>
                                @endif
                            </td>

                            <td class="muted" style="font-size:12px;">
                                {{ $book['tgl_kembali_aktual'] ?? '—' }}
                            </td>

                            <td>
                                @if(!$book['status_sanksi'] || $book['status_sanksi'] === 'tidak_ada')
                                    <span class="pbp-badge gray">—</span>
                                @elseif($book['status_sanksi'] === 'belum_lunas')
                                    <span class="pbp-badge danger">Belum Lunas</span>
                                @else
                                    <span class="pbp-badge ok">Lunas</span>
                                @endif
                            </td>

                            <td class="center">
                                @if(!$book['tgl_kembali_aktual'])
                                <button
                                    type="button"
                                    class="pbp-btn-tbl"
                                    wire:click="bukaModalKembalikan({{ $book['id'] }})"
                                >Kembalikan</button>
                                @else
                                    <span class="pbp-badge ok" style="font-size:11px;">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pbp-modal-foot">
                <button type="button" class="pbp-btn secondary" wire:click="tutupBooksModal">Tutup</button>
            </div>
        </div>
    </div>
    @endif
    @endif

    {{-- ════════════ MODAL KEMBALIKAN (layers on top of books modal) ════════════ --}}
    @if($showReturnModal)
    <div class="pbp-modal-bg z-top" wire:click.self="tutupReturnModal">
        <div class="pbp-modal">
            <div class="pbp-modal-head">
                <h3>Kembalikan Buku Paket</h3>
                <p>Catat kondisi buku saat dikembalikan</p>
            </div>
            <div class="pbp-modal-body">

                <div class="pbp-mfield">
                    <label class="pbp-label" for="pbp-m-kondisi">Kondisi Saat Dikembalikan</label>
                    <select
                        id="pbp-m-kondisi"
                        class="pbp-mselect"
                        wire:model.live="modalKondisi"
                    >
                        <option value="baik">Baik</option>
                        <option value="rusak_ringan">Rusak Ringan</option>
                        <option value="rusak_berat">Rusak Berat</option>
                        <option value="hilang">Hilang</option>
                    </select>
                </div>

                @if(in_array($modalKondisi, ['rusak_ringan', 'rusak_berat', 'hilang']))
                <div class="pbp-sanksi-box">
                    <div class="pbp-mfield">
                        <label class="pbp-label">Jenis Sanksi</label>
                        <select class="pbp-mselect" wire:model="modalJenisSanksi">
                            <option value="bayar_harga">Bayar Harga Buku</option>
                            <option value="ganti_buku">Ganti Buku yang Sama</option>
                        </select>
                    </div>

                    @if($modalJenisSanksi === 'bayar_harga')
                    <div class="pbp-mfield">
                        <label class="pbp-label">Nominal Sanksi (Rp)</label>
                        <input
                            type="number"
                            class="pbp-input"
                            wire:model="modalNominal"
                            placeholder="Masukkan nominal"
                            min="0"
                            step="1000"
                        >
                    </div>
                    @endif
                </div>
                @endif

                <div class="pbp-mfield">
                    <label class="pbp-label">Catatan <span style="color:var(--t3);font-weight:400;">(opsional)</span></label>
                    <textarea
                        class="pbp-textarea"
                        wire:model="modalCatatan"
                        placeholder="Catatan kondisi buku, dll."
                        rows="2"
                    ></textarea>
                </div>

            </div>
            <div class="pbp-modal-foot">
                <button type="button" class="pbp-btn secondary" wire:click="tutupReturnModal">Batal</button>
                <button
                    type="button"
                    class="pbp-btn success"
                    wire:click="simpanPengembalian"
                    wire:loading.attr="disabled"
                    wire:target="simpanPengembalian"
                >
                    <svg wire:loading.remove wire:target="simpanPengembalian" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    <svg wire:loading wire:target="simpanPengembalian" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="animation:spin 1s linear infinite"><path d="M21 12a9 9 0 1 1-18 0"/></svg>
                    Simpan Pengembalian
                </button>
            </div>
        </div>
    </div>
    @endif

    {{-- ════════════ MODAL KEMBALIKAN SEMUA ════════════ --}}
    @if($showBulkModal)
    @php
        $bulkBuku  = collect($items)->sum(fn ($m) => $m['jumlah_buku'] - $m['kembali']);
        $bulkSiswa = collect($items)->filter(fn ($m) => $m['kembali'] < $m['jumlah_buku'])->count();
    @endphp
    <div class="pbp-modal-bg" wire:click.self="$set('showBulkModal', false)">
        <div class="pbp-modal">
            <div class="pbp-modal-head">
                <h3>Kembalikan Semua (Kondisi Baik)</h3>
                <p>Semua buku yang belum dikembalikan akan dicatat kondisi <strong>Baik</strong> dan tanggal hari ini.</p>
            </div>
            <div class="pbp-modal-body">
                <div style="padding:14px 16px; background:#f8f9fc; border:1px solid var(--line); border-radius:9px; font-size:13.5px; color:var(--t1); line-height:1.6;">
                    <strong>{{ $bulkBuku }} buku</strong> dari <strong>{{ $bulkSiswa }} siswa</strong>
                    akan dikembalikan dalam kondisi baik.
                    <div style="margin-top:6px; font-size:12px; color:var(--t3);">Tindakan ini tidak dapat dibatalkan.</div>
                </div>
            </div>
            <div class="pbp-modal-foot">
                <button type="button" class="pbp-btn secondary" wire:click="$set('showBulkModal', false)">Batal</button>
                <button
                    type="button"
                    class="pbp-btn success"
                    wire:click="kembalikanSemua"
                    wire:loading.attr="disabled"
                    wire:target="kembalikanSemua"
                >
                    <svg wire:loading.remove wire:target="kembalikanSemua" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    <svg wire:loading wire:target="kembalikanSemua" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="animation:spin 1s linear infinite"><path d="M21 12a9 9 0 1 1-18 0"/></svg>
                    Ya, Kembalikan Semua
                </button>
            </div>
        </div>
    </div>
    @endif

</div>
</x-filament-panels::page>
