<x-filament-panels::page>
@vite(['resources/js/app.js'])
<style>
.pkb {
    --pri:#1e3a8a; --pri-2:#2746a4; --pri-50:#eef2ff; --pri-100:#dbe3ff;
    --ok:#16a34a;  --ok-50:#e6f7ed;
    --warn:#b45309; --warn-50:#fffbeb;
    --err:#dc2626; --err-50:#fee2e2;
    --t1:#0f172a; --t2:#5a6478; --t3:#8b94a6;
    --line:#e6eaf2; --line-2:#d4dae6;
    --panel:#fff;
    --r:14px; --sh:0 1px 2px rgba(15,23,42,.04);
}
.pkb-card { background:var(--panel); border:1px solid var(--line); border-radius:var(--r); box-shadow:var(--sh); }
.pkb-card-head { padding:18px 24px 16px; border-bottom:1px solid var(--line); }
.pkb-card-head h2 { margin:0 0 2px; font-size:15px; font-weight:700; color:var(--t1); letter-spacing:-.005em; }
.pkb-card-head .sub { font-size:12px; color:var(--t3); margin:0; }
.pkb-card-body { padding:24px; }

.pkb-label { display:block; font-size:12.5px; font-weight:600; color:var(--t2); margin-bottom:6px; }
.pkb-input-row { display:flex; gap:8px; align-items:stretch; }
.pkb-input {
    flex:1; height:40px; border:1px solid var(--line); border-radius:8px;
    padding:0 14px; font-size:13.5px; color:var(--t1); background:#f8f9fc;
    outline:none; transition:border-color 150ms, background 150ms; font-family:inherit;
}
.pkb-input:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.pkb-input.mono { font-family:'SF Mono','Fira Code',ui-monospace,monospace; letter-spacing:.02em; }

.pkb-btn {
    height:40px; padding:0 18px; border-radius:8px; border:none;
    font:inherit; font-size:13px; font-weight:600; cursor:pointer;
    display:inline-flex; align-items:center; gap:7px;
    transition:background 120ms; flex-shrink:0;
}
.pkb-btn.primary { background:var(--pri); color:white; box-shadow:0 1px 2px rgba(30,58,138,.2); }
.pkb-btn.primary:hover { background:var(--pri-2); }
.pkb-btn.primary:disabled { background:#9fa9c1; cursor:not-allowed; box-shadow:none; }
.pkb-btn.secondary { background:white; color:var(--t1); border:1px solid var(--line); }
.pkb-btn.secondary:hover { background:#f5f7fc; border-color:var(--line-2); }
.pkb-btn.success { background:var(--ok); color:white; box-shadow:0 1px 2px rgba(22,163,74,.2); }
.pkb-btn.success:hover { background:#15803d; }
.pkb-btn.success:disabled { background:#6dbb8a; cursor:not-allowed; box-shadow:none; }

.pkb-error {
    display:flex; align-items:center; gap:6px; margin-top:8px;
    padding:8px 12px; background:var(--err-50); border:1px solid #fca5a5;
    border-radius:8px; font-size:12.5px; color:var(--err); font-weight:500;
}

.pkb-info {
    margin-top:14px; border:1px solid var(--line); border-radius:10px; overflow:hidden; background:#fafbfd;
}
.pkb-info-row {
    display:flex; align-items:flex-start; gap:12px; padding:10px 16px;
    border-bottom:1px solid var(--line); font-size:13px;
}
.pkb-info-row:last-child { border-bottom:none; }
.pkb-info-label { font-size:12px; font-weight:600; color:var(--t3); text-transform:uppercase; letter-spacing:.05em; min-width:130px; flex-shrink:0; padding-top:1px; }
.pkb-info-val { color:var(--t1); font-weight:500; }
.pkb-info-val.red  { color:var(--err); font-weight:700; }
.pkb-info-val.mono { font-family:'SF Mono','Fira Code',ui-monospace,monospace; font-size:12px; }

.pkb-badge {
    display:inline-block; padding:2px 10px; border-radius:999px;
    font-size:11.5px; font-weight:600; line-height:1.5;
}
.pkb-badge.warn   { background:var(--warn-50); color:var(--warn); }
.pkb-badge.danger { background:var(--err-50); color:var(--err); }
.pkb-badge.ok     { background:var(--ok-50); color:var(--ok); }

.pkb-section { margin-top:20px; }
.pkb-section-title {
    font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.07em;
    color:var(--t3); margin-bottom:10px;
}

.pkb-kondisi-row { display:flex; gap:8px; }
.pkb-kondisi-btn {
    flex:1; padding:10px 8px; border-radius:9px; border:1.5px solid var(--line);
    background:white; cursor:pointer; text-align:center; transition:all 120ms;
    font:inherit; font-size:13px; font-weight:600; color:var(--t2);
}
.pkb-kondisi-btn:hover { border-color:var(--line-2); background:#f8f9fc; }
.pkb-kondisi-btn.active-baik   { border-color:var(--ok);   background:var(--ok-50);   color:var(--ok); }
.pkb-kondisi-btn.active-rusak  { border-color:var(--warn);  background:var(--warn-50);  color:var(--warn); }
.pkb-kondisi-btn.active-hilang { border-color:var(--err);  background:var(--err-50);  color:var(--err); }
.pkb-kondisi-btn { transition:background 120ms, border-color 120ms, color 120ms; }
.pkb-kondisi-icon { display:flex; justify-content:center; margin-bottom:4px; }

.pkb-sanksi { margin-top:16px; padding:16px; background:#f8f9fc; border:1px solid var(--line); border-radius:10px; }
.pkb-sanksi > * + * { margin-top:12px; }

.pkb-select {
    width:100%; height:40px; border:1px solid var(--line); border-radius:8px;
    padding:0 12px; font-size:13.5px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; cursor:pointer;
    transition:border-color 150ms;
}
.pkb-select:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }

.pkb-textarea {
    width:100%; border:1px solid var(--line); border-radius:8px;
    padding:10px 14px; font-size:13.5px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; resize:vertical; min-height:72px;
    transition:border-color 150ms;
}
.pkb-textarea:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }

.pkb-actions {
    display:flex; justify-content:flex-end; gap:8px;
    margin-top:20px; padding-top:16px; border-top:1px solid var(--line);
}

/* ── Struk Modal ── */
.pkb-modal-bg {
    position:fixed; inset:0; background:rgba(15,23,42,.5);
    z-index:9999; display:flex; align-items:center; justify-content:center; padding:20px;
}
.pkb-modal {
    background:white; border-radius:16px; width:100%; max-width:440px;
    overflow:hidden; box-shadow:0 20px 48px rgba(15,23,42,.18);
    animation:pkbUp 180ms ease;
}
@keyframes pkbUp {
    from { transform:translateY(18px); opacity:0; }
    to   { transform:translateY(0);    opacity:1; }
}
.pkb-modal-head { padding:22px 24px 18px; text-align:center; color:white; }
.pkb-modal-head.ok  { background:var(--ok); }
.pkb-modal-head h3 { margin:0 0 4px; font-size:17px; font-weight:700; }
.pkb-modal-head p  { margin:0; font-size:13px; opacity:.85; }
.pkb-modal-body { padding:20px 24px 8px; }
.pkb-struk-row {
    display:flex; justify-content:space-between; align-items:flex-start;
    gap:12px; padding:8px 0; border-bottom:1px solid #f1f3f8; font-size:13px;
}
.pkb-struk-row:last-child { border-bottom:none; }
.pkb-struk-label { color:var(--t3); flex-shrink:0; }
.pkb-struk-val   { color:var(--t1); font-weight:600; text-align:right; }
.pkb-struk-val.red  { color:var(--err); }
.pkb-struk-val.warn { color:var(--warn); }
.pkb-struk-val.mono { font-family:'SF Mono','Fira Code',ui-monospace,monospace; font-size:12px; }
.pkb-modal-foot { padding:12px 24px 20px; }

.pkb-denda-box {
    margin-top:8px; padding:10px 14px; background:var(--err-50);
    border:1px solid #fca5a5; border-radius:8px; font-size:13px; color:var(--err);
    font-weight:600;
}
.pkb-sanksi-box {
    margin-top:6px; padding:10px 14px; background:var(--warn-50);
    border:1px solid #fbbf24; border-radius:8px; font-size:13px; color:var(--warn);
    font-weight:600;
}

@keyframes spin { to { transform:rotate(360deg); } }

@media (max-width:1023px) {
    .pkb-card-head { padding:16px 18px 14px; }
    .pkb-card-body { padding:20px 18px; }
    .pkb-input { font-size:16px !important; height:auto; min-height:50px; padding:13px 16px; }
    .pkb-select { font-size:16px !important; height:auto; min-height:50px; padding:13px 16px; }
    .pkb-textarea { font-size:16px !important; }
    .pkb-input-row { flex-direction:column; }
    .pkb-input-row .pkb-btn { width:100%; justify-content:center; height:50px; font-size:14.5px; }
    .pkb-actions { flex-direction:column-reverse; gap:10px; }
    .pkb-actions .pkb-btn { width:100%; justify-content:center; height:50px; font-size:14.5px; }
    .pkb-modal-head { padding:20px 18px 16px; }
    .pkb-modal-body { padding:16px 18px 8px; }
    .pkb-modal-foot { padding:10px 18px 18px; }
    .pkb-info-row { flex-direction:column; gap:3px; }
    .pkb-info-label { min-width:auto; }
}
</style>

<div class="pkb">

    <div class="pkb-card">
        <div class="pkb-card-head">
            <h2>Proses Pengembalian Buku</h2>
            <p class="sub">Scan atau ketik kode eksemplar untuk memproses pengembalian</p>
        </div>

        <div class="pkb-card-body">

            {{-- ── INPUT KODE ── --}}
            <div>
                <label class="pkb-label" for="pkb-kode-input">Kode Eksemplar</label>
                <div class="pkb-input-row">
                    <input
                        id="pkb-kode-input"
                        type="text"
                        class="pkb-input mono"
                        wire:model="kodeInput"
                        wire:keydown.enter="cekEksemplar"
                        placeholder="Contoh: BK-0001-001"
                        autocomplete="off"
                        autofocus
                    >
                    <button type="button" class="pkb-btn primary" wire:click="cekEksemplar" wire:loading.attr="disabled" wire:target="cekEksemplar">
                        <svg wire:loading.remove wire:target="cekEksemplar" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <svg wire:loading wire:target="cekEksemplar" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="animation:spin 1s linear infinite"><path d="M21 12a9 9 0 1 1-18 0"/></svg>
                        Cek
                    </button>
                    <x-qr-scanner id="pkb-kode" field="kodeInput" action="cekEksemplar" label="Scan Barcode" />
                </div>

                @if($error)
                <div class="pkb-error">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                    {{ $error }}
                </div>
                @endif
            </div>

            {{-- ── INFO PEMINJAMAN ── --}}
            @if($loan)
            @php
                $today    = \Carbon\Carbon::today();
                $isLate   = $today->gt($loan->tgl_batas_kembali);
                $hariLate = $isLate ? (int) $loan->tgl_batas_kembali->diffInDays($today) : 0;
            @endphp

            <div class="pkb-section">
                <div class="pkb-section-title">Informasi Peminjaman</div>

                <div class="pkb-info">
                    <div class="pkb-info-row">
                        <span class="pkb-info-label">Anggota</span>
                        <span class="pkb-info-val" style="font-weight:600;">{{ $loan->member?->nama }}</span>
                    </div>
                    <div class="pkb-info-row">
                        <span class="pkb-info-label">Kode Anggota</span>
                        <span class="pkb-info-val mono">{{ $loan->member?->kode_anggota }}</span>
                    </div>
                    @if($loan->member?->kelas)
                    <div class="pkb-info-row">
                        <span class="pkb-info-label">Kelas</span>
                        <span class="pkb-info-val">{{ $loan->member->kelas }}</span>
                    </div>
                    @endif
                    <div class="pkb-info-row">
                        <span class="pkb-info-label">Judul Buku</span>
                        <span class="pkb-info-val" style="font-weight:600;">{{ $loan->book?->judul }}</span>
                    </div>
                    <div class="pkb-info-row">
                        <span class="pkb-info-label">Kode Eksemplar</span>
                        <span class="pkb-info-val mono">{{ $loan->bookItem?->kode_item ?? $loan->book?->kode_buku }}</span>
                    </div>
                    <div class="pkb-info-row">
                        <span class="pkb-info-label">Tgl Pinjam</span>
                        <span class="pkb-info-val">{{ $loan->tgl_pinjam?->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="pkb-info-row">
                        <span class="pkb-info-label">Batas Kembali</span>
                        <span class="pkb-info-val {{ $isLate ? 'red' : '' }}">
                            {{ $loan->tgl_batas_kembali?->translatedFormat('d F Y') }}
                            @if($isLate)
                                <span class="pkb-badge danger" style="margin-left:8px;">Terlambat {{ $hariLate }} hari</span>
                            @endif
                        </span>
                    </div>
                    @if($isLate)
                    <div class="pkb-info-row">
                        <span class="pkb-info-label">Est. Denda</span>
                        <span class="pkb-info-val red">
                            Rp {{ number_format($hariLate * 1000, 0, ',', '.') }}
                            <span style="font-weight:400; color:var(--t3); font-size:12px;">({{ $hariLate }} hari × Rp 1.000)</span>
                        </span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- ── KONDISI BUKU ── --}}
            <div class="pkb-section" x-data="{ k: $wire.entangle('kondisi').live }">
                <div class="pkb-section-title">Kondisi Buku Saat Dikembalikan</div>
                <div class="pkb-kondisi-row">
                    <button
                        type="button"
                        class="pkb-kondisi-btn"
                        :class="k === 'baik' ? 'active-baik' : ''"
                        @click="k = 'baik'"
                    >
                        <span class="pkb-kondisi-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M8.5 12.5l2.5 2.5 5-5"/></svg></span>
                        Baik
                    </button>
                    <button
                        type="button"
                        class="pkb-kondisi-btn"
                        :class="k === 'rusak' ? 'active-rusak' : ''"
                        @click="k = 'rusak'"
                    >
                        <span class="pkb-kondisi-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.3 4.2L2.6 17.5a1.8 1.8 0 0 0 1.56 2.7h15.68a1.8 1.8 0 0 0 1.56-2.7L13.7 4.2a1.8 1.8 0 0 0-3.4 0z"/><path d="M12 10v3.5"/><path d="M12 16.8h.01"/></svg></span>
                        Rusak
                    </button>
                    <button
                        type="button"
                        class="pkb-kondisi-btn"
                        :class="k === 'hilang' ? 'active-hilang' : ''"
                        @click="k = 'hilang'"
                    >
                        <span class="pkb-kondisi-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M14.5 9.5l-5 5M9.5 9.5l5 5"/></svg></span>
                        Hilang
                    </button>
                </div>
            </div>

            {{-- ── SANKSI (jika rusak / hilang) ── --}}
            @if(in_array($kondisi, ['rusak', 'hilang']))
            <div class="pkb-sanksi">
                <div>
                    <label class="pkb-label">Jenis Sanksi</label>
                    <select class="pkb-select" wire:model.live="jenisSanksi">
                        <option value="bayar_harga">Bayar Harga Buku</option>
                        <option value="ganti_buku">Ganti Buku yang Sama</option>
                    </select>
                </div>

                @if($jenisSanksi === 'bayar_harga')
                <div>
                    <label class="pkb-label">Nominal Sanksi (Rp)</label>
                    <input
                        type="text"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        class="pkb-input"
                        wire:model="nominalSanksi"
                        placeholder="Masukkan nominal sanksi"
                    >
                </div>
                @endif

                <div>
                    <label class="pkb-label">Catatan Sanksi <span style="color:var(--t3);font-weight:400;">(opsional)</span></label>
                    <textarea
                        class="pkb-textarea"
                        wire:model="catatanSanksi"
                        placeholder="Contoh: kondisi kerusakan, halaman robek, dll."
                        rows="2"
                    ></textarea>
                </div>
            </div>
            @endif

            {{-- ── TOMBOL PROSES ── --}}
            <div class="pkb-actions">
                <button
                    type="button"
                    class="pkb-btn primary"
                    wire:click="simpanPengembalian"
                    wire:loading.attr="disabled"
                    wire:target="simpanPengembalian"
                    @if(in_array($kondisi, ['rusak', 'hilang']) && $jenisSanksi === 'bayar_harga' && !$nominalSanksi) disabled @endif
                >
                    <svg wire:loading.remove wire:target="simpanPengembalian" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    <svg wire:loading wire:target="simpanPengembalian" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="animation:spin 1s linear infinite"><path d="M21 12a9 9 0 1 1-18 0"/></svg>
                    Proses Pengembalian
                </button>
            </div>

            @endif {{-- /if($loan) --}}

        </div>
    </div>

    {{-- ── STRUK MODAL ── --}}
    @if($showStruk && !empty($successData))
    <div class="pkb-modal-bg" wire:click.self="tutupStruk">
        <div class="pkb-modal">
            <div class="pkb-modal-head ok">
                <div style="margin-bottom:8px;">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="9 12 11 14 15 10"/></svg>
                </div>
                <h3>Pengembalian Berhasil</h3>
                <p>Buku telah berhasil dikembalikan</p>
            </div>

            <div class="pkb-modal-body">
                <div class="pkb-struk-row">
                    <span class="pkb-struk-label">Anggota</span>
                    <span class="pkb-struk-val">{{ $successData['anggota'] }}</span>
                </div>
                @if($successData['kelas'])
                <div class="pkb-struk-row">
                    <span class="pkb-struk-label">Kelas</span>
                    <span class="pkb-struk-val">{{ $successData['kelas'] }}</span>
                </div>
                @endif
                <div class="pkb-struk-row">
                    <span class="pkb-struk-label">Buku</span>
                    <span class="pkb-struk-val" style="max-width:220px; text-align:right;">{{ $successData['buku'] }}</span>
                </div>
                <div class="pkb-struk-row">
                    <span class="pkb-struk-label">Kode Eksemplar</span>
                    <span class="pkb-struk-val mono">{{ $successData['kode_item'] }}</span>
                </div>
                <div class="pkb-struk-row">
                    <span class="pkb-struk-label">Tgl Pinjam</span>
                    <span class="pkb-struk-val">{{ $successData['tgl_pinjam'] }}</span>
                </div>
                <div class="pkb-struk-row">
                    <span class="pkb-struk-label">Tgl Dikembalikan</span>
                    <span class="pkb-struk-val">{{ $successData['tgl_kembali'] }}</span>
                </div>
                <div class="pkb-struk-row">
                    <span class="pkb-struk-label">Kondisi Buku</span>
                    <span class="pkb-struk-val {{ match($successData['kondisi']) { 'rusak' => 'warn', 'hilang' => 'red', default => '' } }}">
                        {{ ucfirst($successData['kondisi']) }}
                    </span>
                </div>

                @if($successData['denda'])
                <div class="pkb-denda-box">
                    Denda keterlambatan: <strong>Rp {{ number_format($successData['denda']['nominal'], 0, ',', '.') }}</strong>
                    <span style="font-weight:400; font-size:12px;">({{ $successData['denda']['jumlah_hari'] }} hari × Rp 1.000)</span>
                </div>
                @endif

                @if($successData['ada_sanksi'])
                <div class="pkb-sanksi-box">
                    Sanksi: <strong>{{ $successData['jenis_sanksi'] === 'ganti_buku' ? 'Ganti Buku yang Sama' : 'Bayar Harga Buku' }}</strong>
                    @if($successData['jenis_sanksi'] === 'bayar_harga' && $successData['nominal_sanksi'])
                        — <strong>Rp {{ number_format($successData['nominal_sanksi'], 0, ',', '.') }}</strong>
                    @endif
                </div>
                @endif
            </div>

            <div class="pkb-modal-foot">
                <button
                    type="button"
                    class="pkb-btn primary"
                    style="width:100%; justify-content:center; height:42px;"
                    wire:click="tutupStruk"
                >
                    Tutup &amp; Kembali ke Form
                </button>
            </div>
        </div>
    </div>
    @endif

</div>
</x-filament-panels::page>
