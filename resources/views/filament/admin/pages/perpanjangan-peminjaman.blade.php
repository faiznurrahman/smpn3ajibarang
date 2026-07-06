<x-filament-panels::page>
<style>
.pp {
    --pri:#1e3a8a; --pri-2:#2746a4; --pri-50:#eef2ff;
    --ok:#16a34a;  --ok-50:#e6f7ed;
    --warn:#b45309; --warn-50:#fffbeb;
    --err:#dc2626; --err-50:#fee2e2;
    --t1:#0f172a; --t2:#5a6478; --t3:#8b94a6;
    --line:#e6eaf2; --line-2:#d4dae6;
    --panel:#fff;
    --r:14px; --sh:0 1px 2px rgba(15,23,42,.04);
}
.pp-card { background:var(--panel); border:1px solid var(--line); border-radius:var(--r); box-shadow:var(--sh); }
.pp-card-head { padding:18px 24px 16px; border-bottom:1px solid var(--line); }
.pp-card-head h2 { margin:0 0 2px; font-size:15px; font-weight:700; color:var(--t1); letter-spacing:-.005em; }
.pp-card-head .sub { font-size:12px; color:var(--t3); margin:0; }
.pp-card-body { padding:24px; }

.pp-label { display:block; font-size:12.5px; font-weight:600; color:var(--t2); margin-bottom:6px; }
.pp-input-row { display:flex; gap:8px; align-items:stretch; }
.pp-input {
    flex:1; height:40px; border:1px solid var(--line); border-radius:8px;
    padding:0 14px; font-size:13.5px; color:var(--t1); background:#f8f9fc;
    outline:none; transition:border-color 150ms, background 150ms; font-family:inherit;
}
.pp-input:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.pp-input.mono { font-family:'SF Mono','Fira Code',ui-monospace,monospace; letter-spacing:.02em; }

.pp-btn {
    height:40px; padding:0 18px; border-radius:8px; border:none;
    font:inherit; font-size:13px; font-weight:600; cursor:pointer;
    display:inline-flex; align-items:center; gap:7px;
    transition:background 120ms, box-shadow 120ms; flex-shrink:0;
}
.pp-btn.primary { background:var(--pri); color:white; box-shadow:0 1px 2px rgba(30,58,138,.2); }
.pp-btn.primary:hover { background:var(--pri-2); }
.pp-btn.primary:disabled { background:#9fa9c1; cursor:not-allowed; box-shadow:none; }
.pp-btn.secondary { background:white; color:var(--t1); border:1px solid var(--line); }
.pp-btn.secondary:hover { background:#f5f7fc; border-color:var(--line-2); }
.pp-btn.success { background:var(--ok); color:white; box-shadow:0 1px 2px rgba(22,163,74,.2); }
.pp-btn.success:hover { background:#15803d; }
.pp-btn.success:disabled { background:#6dbb8a; cursor:not-allowed; box-shadow:none; }

.pp-error {
    display:flex; align-items:center; gap:6px; margin-top:8px;
    padding:8px 12px; background:var(--err-50); border:1px solid #fca5a5;
    border-radius:8px; font-size:12.5px; color:var(--err); font-weight:500;
}
.pp-hint { font-size:11.5px; color:var(--t3); margin-top:6px; }

.pp-info { margin-top:20px; border:1px solid var(--line); border-radius:10px; overflow:hidden; background:#fafbfd; }
.pp-info-row { display:flex; align-items:flex-start; gap:12px; padding:9px 16px; border-bottom:1px solid var(--line); }
.pp-info-row:last-child { border-bottom:none; }
.pp-info-label { font-size:11.5px; font-weight:600; color:var(--t3); text-transform:uppercase; letter-spacing:.05em; min-width:150px; flex-shrink:0; padding-top:2px; }
.pp-info-val { font-size:13.5px; color:var(--t1); font-weight:500; }
.pp-info-val.red   { color:var(--err); font-weight:600; }
.pp-info-val.mono  { font-family:'SF Mono','Fira Code',ui-monospace,monospace; font-size:12.5px; }
.pp-info-val.green { color:var(--ok); font-weight:600; }

.pp-divider { border:none; border-top:1px solid var(--line); margin:20px 0; }
.pp-section-label { font-size:11.5px; font-weight:700; text-transform:uppercase; letter-spacing:.08em; color:var(--t3); margin:0 0 12px; }

.pp-dur-group { display:flex; gap:10px; flex-wrap:wrap; }
.pp-dur-btn {
    height:44px; padding:0 24px; border-radius:10px; cursor:pointer;
    font:inherit; font-size:13.5px; font-weight:600;
    border:1.5px solid var(--line-2);
    background:white; color:var(--t2);
    transition:background 120ms, border-color 120ms, color 120ms;
    display:inline-flex; align-items:center; gap:6px;
}
.pp-dur-btn:hover { border-color:var(--pri); color:var(--pri); background:var(--pri-50); }
.pp-dur-btn.active { background:var(--pri); border-color:var(--pri); color:white; box-shadow:0 1px 2px rgba(30,58,138,.2); }

.pp-preview {
    margin-top:16px; padding:14px 16px;
    background:#f0f4ff; border:1px solid #c7d4fc; border-radius:10px;
    font-size:13.5px; color:var(--t1); line-height:1.6;
}
.pp-preview strong { font-weight:700; }

.pp-actions { display:flex; justify-content:flex-end; gap:8px; margin-top:20px; padding-top:16px; border-top:1px solid var(--line); }

.pp-sukses {
    margin-top:20px; padding:16px 18px;
    background:var(--ok-50); border:1px solid #86efac;
    border-radius:10px; display:flex; align-items:flex-start; gap:12px;
}
.pp-sukses-icon { flex-shrink:0; margin-top:1px; color:var(--ok); }
.pp-sukses-body { flex:1; min-width:0; }
.pp-sukses-title { font-size:14px; font-weight:700; color:var(--ok); margin:0 0 3px; }
.pp-sukses-sub   { font-size:12.5px; color:#166534; margin:0; }

@keyframes spin { to { transform:rotate(360deg); } }

@media (max-width:1023px) {
    .pp-card-head { padding:16px 18px 14px; }
    .pp-card-body { padding:20px 18px; }
    .pp-input { font-size:16px !important; height:46px; }
    .pp-input-row { flex-direction:column; }
    .pp-input-row .pp-btn { width:100%; justify-content:center; height:48px; font-size:14px; }
    .pp-actions { flex-direction:column; gap:10px; }
    .pp-actions .pp-btn { width:100%; justify-content:center; height:48px; font-size:14px; }
    .pp-info-row { flex-direction:column; gap:3px; padding:10px 14px; }
    .pp-info-label { min-width:auto; font-size:10.5px; }
    .pp-info-val { font-size:13.5px; }
    .pp-dur-btn { flex:1; justify-content:center; }
}
</style>

<div class="pp">

    <div class="pp-card">
        <div class="pp-card-head">
            <h2>Perpanjangan Peminjaman</h2>
            <p class="sub">Scan atau ketik kode eksemplar untuk memperpanjang batas kembali buku</p>
        </div>

        <div class="pp-card-body">

            {{-- ── Input Kode Eksemplar ── --}}
            <label class="pp-label" for="pp-kode-input">Kode Eksemplar</label>
            <div class="pp-input-row">
                <input
                    id="pp-kode-input"
                    type="text"
                    class="pp-input mono"
                    wire:model="kodeInput"
                    wire:keydown.enter="cekEksemplar"
                    placeholder="Ketik kode eksemplar: BK-0001-001"
                    autocomplete="off"
                >
                <button type="button" class="pp-btn primary" wire:click="cekEksemplar" wire:loading.attr="disabled" wire:target="cekEksemplar">
                    <svg wire:loading.remove wire:target="cekEksemplar" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <svg wire:loading wire:target="cekEksemplar" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="animation:spin 1s linear infinite"><path d="M21 12a9 9 0 1 1-18 0"/></svg>
                    Cek
                </button>
            </div>
            {{-- Error --}}
            @if($error)
            <div class="pp-error">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                {{ $error }}
            </div>
            @endif

            {{-- Sukses --}}
            @if($sukses && $loan)
            <div class="pp-sukses">
                <div class="pp-sukses-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="9 12 11 14 15 10"/></svg>
                </div>
                <div class="pp-sukses-body">
                    <p class="pp-sukses-title">Perpanjangan berhasil dicatat!</p>
                    <p class="pp-sukses-sub">
                        Batas kembali baru:
                        <strong>{{ $loan->tgl_batas_kembali->translatedFormat('d F Y') }}</strong>
                        &middot; Perpanjangan ke-{{ $loan->jumlah_perpanjangan }} dari 2x
                    </p>
                </div>
            </div>
            <div class="pp-actions" style="border-top:none; margin-top:12px; padding-top:0; justify-content:flex-start;">
                <button type="button" class="pp-btn secondary" wire:click="resetForm">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.35"/></svg>
                    Perpanjang yang Lain
                </button>
            </div>
            @endif

            {{-- ── Info Peminjaman ── --}}
            @if($loan && !$sukses)
            <div class="pp-info">

                {{-- Anggota --}}
                <div class="pp-info-row">
                    <span class="pp-info-label">Anggota</span>
                    <span class="pp-info-val">
                        {{ $loan->member?->nama }}
                        <span style="font-size:12px; color:var(--t3); font-weight:400; margin-left:6px;">
                            {{ $loan->member?->kode_anggota }}
                            @if($loan->member?->kelas) &middot; Kelas {{ $loan->member->kelas }} @endif
                        </span>
                    </span>
                </div>

                {{-- Buku --}}
                <div class="pp-info-row">
                    <span class="pp-info-label">Buku</span>
                    <span class="pp-info-val">
                        {{ $loan->book?->judul ?? '—' }}
                        <span style="font-size:12px; color:var(--t3); font-weight:400; margin-left:6px; font-family:monospace;">
                            {{ $loan->bookItem?->kode_item ?? $loan->book?->kode_buku }}
                        </span>
                    </span>
                </div>

                {{-- Jatuh tempo sekarang --}}
                @php
                    $isLate   = $loan->tgl_batas_kembali->lt(\Carbon\Carbon::today());
                    $tglLama  = $loan->tgl_batas_kembali;
                @endphp
                <div class="pp-info-row">
                    <span class="pp-info-label">Jatuh Tempo</span>
                    <span class="pp-info-val {{ $isLate ? 'red' : '' }}">
                        {{ $tglLama->translatedFormat('d F Y') }}
                        @if($isLate)
                            <span style="margin-left:6px; font-size:11.5px; font-weight:600; background:var(--err-50); color:var(--err); border-radius:999px; padding:1px 8px;">
                                +{{ $loan->jumlahHariTerlambat() }} hari
                            </span>
                        @endif
                    </span>
                </div>

                {{-- Perpanjangan ke --}}
                <div class="pp-info-row">
                    <span class="pp-info-label">Perpanjangan ke</span>
                    <span class="pp-info-val">{{ $loan->jumlah_perpanjangan + 1 }} dari 2x</span>
                </div>

            </div>

            <hr class="pp-divider">

            {{-- ── Pilih Durasi ── --}}
            <p class="pp-section-label">Pilih Durasi Perpanjangan</p>
            <div class="pp-dur-group">
                <button type="button"
                    class="pp-dur-btn {{ $durasiDipilih === 3 ? 'active' : '' }}"
                    wire:click="$set('durasiDipilih', 3)">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    3 Hari
                </button>
                <button type="button"
                    class="pp-dur-btn {{ $durasiDipilih === 7 ? 'active' : '' }}"
                    wire:click="$set('durasiDipilih', 7)">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    7 Hari
                </button>
            </div>

            {{-- ── Preview Tanggal Baru ── --}}
            @php
                $tglBaru = $tglLama->copy()->addDays($durasiDipilih);
            @endphp
            <div class="pp-preview">
                Jatuh tempo:
                <strong style="color:var(--t2);">{{ $tglLama->translatedFormat('d M Y') }}</strong>
                <span style="margin:0 6px; color:var(--t3);">→</span>
                <strong style="color:var(--ok);">{{ $tglBaru->translatedFormat('d M Y') }}</strong>
                <span style="margin-left:6px; font-size:12px; color:var(--t3);">(+{{ $durasiDipilih }} hari)</span>
            </div>

            {{-- ── Tombol Konfirmasi ── --}}
            <div class="pp-actions">
                <button type="button" class="pp-btn primary" wire:click="simpanPerpanjangan" wire:loading.attr="disabled" wire:target="simpanPerpanjangan">
                    <svg wire:loading.remove wire:target="simpanPerpanjangan" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.35"/></svg>
                    <svg wire:loading wire:target="simpanPerpanjangan" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="animation:spin 1s linear infinite"><path d="M21 12a9 9 0 1 1-18 0"/></svg>
                    Perpanjang Peminjaman
                </button>
            </div>
            @endif

        </div>
    </div>

</div>
</x-filament-panels::page>
