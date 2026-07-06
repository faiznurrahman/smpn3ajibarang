<x-filament-panels::page>
@vite(['resources/js/app.js'])
<style>
.cp {
    --pri:#1e3a8a; --pri-2:#2746a4; --pri-50:#eef2ff; --pri-100:#dbe3ff;
    --ok:#16a34a;  --ok-50:#e6f7ed;
    --err:#dc2626; --err-50:#fee2e2;
    --t1:#0f172a; --t2:#5a6478; --t3:#8b94a6;
    --line:#e6eaf2; --line-2:#d4dae6;
    --panel:#fff;
    --r:14px; --sh:0 1px 2px rgba(15,23,42,.04);
}
.cp-card { background:var(--panel); border:1px solid var(--line); border-radius:var(--r); box-shadow:var(--sh); }
.cp-card-head { padding:18px 24px 16px; border-bottom:1px solid var(--line); }
.cp-card-head h2 { margin:0 0 2px; font-size:15px; font-weight:700; color:var(--t1); letter-spacing:-.005em; }
.cp-card-head .sub { font-size:12px; color:var(--t3); margin:0; }
.cp-card-body { padding:24px; }

.cp-stepper {
    display:flex; align-items:center; margin-bottom:28px;
    overflow-x:auto; -webkit-overflow-scrolling:touch; scrollbar-width:none;
}
.cp-stepper::-webkit-scrollbar { display:none; }
.cp-step { display:flex; align-items:center; flex-shrink:0; }
.cp-step-circle {
    width:32px; height:32px; border-radius:50%;
    display:flex; align-items:center; justify-content:center;
    font-size:13px; font-weight:700; flex-shrink:0; border:2px solid;
    transition:background 200ms, border-color 200ms, color 200ms;
}
.cp-step.done .cp-step-circle   { background:var(--ok);  border-color:var(--ok);  color:white; }
.cp-step.active .cp-step-circle { background:var(--pri); border-color:var(--pri); color:white; }
.cp-step.pending .cp-step-circle { background:white; border-color:var(--line-2); color:var(--t3); }
.cp-step-label { margin-left:8px; font-size:12.5px; font-weight:600; white-space:nowrap; }
.cp-step.done .cp-step-label    { color:var(--ok); }
.cp-step.active .cp-step-label  { color:var(--pri); }
.cp-step.pending .cp-step-label { color:var(--t3); }
.cp-step-line { flex:1; height:2px; background:var(--line); margin:0 10px; min-width:24px; }
.cp-step-line.done { background:var(--ok); }

.cp-label { display:block; font-size:12.5px; font-weight:600; color:var(--t2); margin-bottom:6px; }
.cp-input-row { display:flex; gap:8px; align-items:stretch; }
.cp-input {
    flex:1; width:100%; min-width:0; box-sizing:border-box; height:40px; border:1px solid var(--line); border-radius:8px;
    padding:0 14px; font-size:13.5px; color:var(--t1); background:#f8f9fc;
    outline:none; transition:border-color 150ms, background 150ms; font-family:inherit;
    text-overflow:ellipsis;
}
.cp-input:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.cp-input.mono { font-family:'SF Mono','Fira Code',ui-monospace,monospace; letter-spacing:.02em; }

.cp-btn {
    height:40px; padding:0 18px; border-radius:8px; border:none;
    font:inherit; font-size:13px; font-weight:600; cursor:pointer;
    display:inline-flex; align-items:center; gap:7px;
    transition:background 120ms, box-shadow 120ms; flex-shrink:0;
}
.cp-btn.primary { background:var(--pri); color:white; box-shadow:0 1px 2px rgba(30,58,138,.2); }
.cp-btn.primary:hover { background:var(--pri-2); }
.cp-btn.primary:disabled { background:#9fa9c1; cursor:not-allowed; box-shadow:none; }
.cp-btn.secondary { background:white; color:var(--t1); border:1px solid var(--line); }
.cp-btn.secondary:hover { background:#f5f7fc; border-color:var(--line-2); }
.cp-btn.success { background:var(--ok); color:white; box-shadow:0 1px 2px rgba(22,163,74,.2); }
.cp-btn.success:hover { background:#15803d; }
.cp-btn.success:disabled { background:#6dbb8a; cursor:not-allowed; box-shadow:none; }

.cp-error {
    display:flex; align-items:center; gap:6px; margin-top:8px;
    padding:8px 12px; background:var(--err-50); border:1px solid #fca5a5;
    border-radius:8px; font-size:12.5px; color:var(--err); font-weight:500;
}
.cp-hint { font-size:11.5px; color:var(--t3); margin-top:6px; }

.cp-input-wrap { position:relative; flex:1; min-width:0; }

.cp-suggest {
    position:absolute; top:calc(100% + 6px); left:0; right:0; z-index:20;
    background:white; border:1px solid var(--line); border-radius:10px;
    box-shadow:0 8px 24px rgba(15,23,42,.12);
    max-height:280px; overflow-y:auto; -webkit-overflow-scrolling:touch; overscroll-behavior:contain;
}
.cp-suggest-item {
    width:100%; display:flex; align-items:center; gap:12px; padding:12px 14px;
    border:none; border-bottom:1px solid var(--line); background:none;
    cursor:pointer; text-align:left; font:inherit; transition:background 100ms;
}
.cp-suggest-item:last-child { border-bottom:none; }
.cp-suggest-item:hover,
.cp-suggest-item:active { background:var(--pri-50); }
.cp-suggest-av {
    width:34px; height:34px; border-radius:9px; flex-shrink:0;
    display:flex; align-items:center; justify-content:center;
    background:var(--pri-50); color:var(--pri); font-weight:700; font-size:12.5px;
}
.cp-suggest-av.guru { background:#fff4ea; color:#d96815; }
.cp-suggest-body { min-width:0; }
.cp-suggest-name {
    display:block; font-size:13.5px; font-weight:700; color:var(--t1);
    overflow:hidden; text-overflow:ellipsis; white-space:nowrap;
}
.cp-suggest-meta {
    display:block; font-size:12px; color:var(--t2); margin-top:2px;
    overflow-wrap:break-word;
}

.cp-result {
    margin-top:14px; border:1px solid var(--line); border-radius:10px;
    padding:12px 16px; display:flex; align-items:center; gap:12px; background:#fafbfd;
}
.cp-result-av {
    width:42px; height:42px; border-radius:10px;
    display:flex; align-items:center; justify-content:center;
    font-weight:700; font-size:15px; flex-shrink:0;
}
.cp-result-av.member { background:var(--pri-50); color:var(--pri); }
.cp-result-av.book   { background:#f1ebff; color:#7c3aed; }
.cp-result-body { flex:1; min-width:0; }
.cp-result-name { font-size:14px; font-weight:600; color:var(--t1); margin:0 0 2px; }
.cp-result-meta { font-size:12px; color:var(--t3); }
.cp-result-badge { padding:3px 10px; border-radius:999px; font-size:11.5px; font-weight:600; background:var(--ok-50); color:var(--ok); white-space:nowrap; }
.cp-result-badge.blue { background:var(--pri-50); color:var(--pri); }

.cp-actions {
    display:flex; justify-content:flex-end; gap:8px;
    margin-top:20px; padding-top:16px; border-top:1px solid var(--line);
}

.cp-summary { background:#f8f9fc; border:1px solid var(--line); border-radius:10px; overflow:hidden; }
.cp-sum-row { display:flex; align-items:flex-start; gap:12px; padding:10px 16px; border-bottom:1px solid var(--line); }
.cp-sum-row:last-child { border-bottom:none; }
.cp-sum-label { font-size:12px; font-weight:600; color:var(--t3); text-transform:uppercase; letter-spacing:.05em; min-width:140px; flex-shrink:0; padding-top:1px; }
.cp-sum-val { font-size:13.5px; color:var(--t1); font-weight:500; }
.cp-sum-val.red  { color:var(--err); font-weight:600; }
.cp-sum-val.mono { font-family:'SF Mono','Fira Code',ui-monospace,monospace; font-size:12.5px; }

.cp-modal-bg {
    position:fixed; inset:0; background:rgba(15,23,42,.5);
    z-index:9999; display:flex; align-items:center; justify-content:center; padding:20px;
}
.cp-modal {
    background:white; border-radius:16px; width:100%; max-width:440px;
    overflow:hidden; box-shadow:0 20px 48px rgba(15,23,42,.18);
    animation:cpSlideUp 180ms ease;
}
@keyframes cpSlideUp {
    from { transform:translateY(18px); opacity:0; }
    to   { transform:translateY(0);    opacity:1; }
}
.cp-modal-head { background:var(--ok); padding:22px 24px 18px; text-align:center; color:white; }
.cp-modal-head h3 { margin:0 0 4px; font-size:17px; font-weight:700; }
.cp-modal-head p  { margin:0; font-size:13px; opacity:.85; }
.cp-modal-body { padding:20px 24px 8px; }
.cp-struk-id {
    text-align:center; font-family:'SF Mono','Fira Code',ui-monospace,monospace;
    font-size:12.5px; font-weight:700; letter-spacing:.06em; color:var(--t3);
    background:#f6f7f9; border-radius:8px; padding:8px 12px; margin-bottom:16px;
}
.cp-struk-row {
    display:flex; justify-content:space-between; align-items:flex-start;
    gap:12px; padding:8px 0; border-bottom:1px solid #f1f3f8; font-size:13px;
}
.cp-struk-row:last-child { border-bottom:none; }
.cp-struk-label { color:var(--t3); flex-shrink:0; }
.cp-struk-val   { color:var(--t1); font-weight:600; text-align:right; }
.cp-struk-val.red  { color:var(--err); }
.cp-struk-val.mono { font-family:'SF Mono','Fira Code',ui-monospace,monospace; font-size:12px; }
.cp-modal-foot { padding:12px 24px 20px; }

@keyframes spin { to { transform:rotate(360deg); } }

@media (max-width:1023px) {
    /* Padding card lebih lega */
    .cp-card-head { padding:16px 18px 14px; }
    .cp-card-body { padding:20px 18px; }

    /* iOS auto-zoom fix + area sentuh nyaman: padding vertikal jadi acuan tinggi, bukan height tetap */
    .cp-input {
        font-size:16px !important; height:auto; min-height:50px;
        padding:13px 16px;
    }

    /* Stepper: circle lebih besar, label tetap terbaca */
    .cp-step-circle { width:36px; height:36px; font-size:14px; }
    .cp-step-label  { font-size:12px; }
    .cp-step-line   { min-width:14px; margin:0 6px; }

    /* Input row: stack vertikal */
    .cp-input-row { flex-direction:column; }
    .cp-input-row .cp-btn {
        width:100%; justify-content:center;
        height:50px; font-size:14.5px;
    }

    /* Tombol aksi: full width */
    .cp-actions { flex-direction:column-reverse; gap:10px; }
    .cp-actions .cp-btn {
        width:100%; justify-content:center;
        height:50px; font-size:14.5px;
    }

    /* Summary rows: label di atas nilai */
    .cp-sum-row   { flex-direction:column; gap:3px; padding:10px 14px; }
    .cp-sum-label { min-width:auto; font-size:11px; }
    .cp-sum-val   { font-size:13.5px; }

    /* Result card */
    .cp-result { padding:12px 14px; }

    /* Struk modal */
    .cp-modal-head { padding:20px 18px 16px; }
    .cp-modal-body { padding:16px 18px 8px; }
    .cp-modal-foot { padding:10px 18px 18px; }
}

@media (max-width:479px) {
    /* Card lebih rapat di layar sempit */
    .cp-card-head { padding:14px 14px 12px; }
    .cp-card-body { padding:16px 14px; }

    /* Stepper: perkecil supaya 3 langkah muat tanpa overflow */
    .cp-stepper     { margin-bottom:20px; }
    .cp-step-circle { width:26px; height:26px; font-size:11px; border-width:1.5px; }
    .cp-step-label  { font-size:10.5px; margin-left:5px; }
    .cp-step-line   { min-width:8px; margin:0 4px; }
}
</style>

<div class="cp">

    <div class="cp-card">
        <div class="cp-card-head">
            <h2>Catat Peminjaman</h2>
            <p class="sub">Isi 3 langkah berikut untuk mencatat transaksi peminjaman buku</p>
        </div>

        <div class="cp-card-body">

            {{-- ── Stepper ── --}}
            <div class="cp-stepper">
                <div class="cp-step {{ $step > 1 ? 'done' : 'active' }}">
                    <div class="cp-step-circle">
                        @if($step > 1)
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        @else 1 @endif
                    </div>
                    <span class="cp-step-label">Anggota</span>
                </div>

                <div class="cp-step-line {{ $step > 1 ? 'done' : '' }}"></div>

                <div class="cp-step {{ $step > 2 ? 'done' : ($step === 2 ? 'active' : 'pending') }}">
                    <div class="cp-step-circle">
                        @if($step > 2)
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        @else 2 @endif
                    </div>
                    <span class="cp-step-label">Buku</span>
                </div>

                <div class="cp-step-line {{ $step > 2 ? 'done' : '' }}"></div>

                <div class="cp-step {{ $step === 3 ? 'active' : 'pending' }}">
                    <div class="cp-step-circle">3</div>
                    <span class="cp-step-label">Konfirmasi</span>
                </div>
            </div>

            {{-- ══ STEP 1 — Validasi Anggota ══ --}}
            @if($step === 1)
            <div>
                <label class="cp-label" for="cp-member-input">Cari Anggota</label>
                <div class="cp-input-row">
                    <div class="cp-input-wrap">
                        <input
                            id="cp-member-input"
                            type="text"
                            class="cp-input"
                            wire:model.live.debounce.300ms="memberInput"
                            wire:keydown.enter="cariAnggota"
                            placeholder="Ketik min. 3 huruf: NIS/NIP atau nama anggota"
                            autocomplete="off"
                        >

                        @if(!empty($memberResults))
                        <div class="cp-suggest" wire:loading.remove wire:target="memberInput">
                            @foreach($memberResults as $result)
                            <button type="button" class="cp-suggest-item" wire:click="pilihAnggota({{ $result->id }})">
                                <span class="cp-suggest-av {{ $result->jenis === 'guru' ? 'guru' : '' }}">{{ mb_strtoupper(mb_substr($result->nama, 0, 2)) }}</span>
                                <span class="cp-suggest-body">
                                    <span class="cp-suggest-name">{{ $result->nama }}</span>
                                    <span class="cp-suggest-meta">
                                        {{ $result->kode_anggota }}
                                        @if($result->kelas) &middot; Kelas {{ $result->kelas }} @endif
                                        @if($result->jenis === 'guru') &middot; Guru @endif
                                    </span>
                                </span>
                            </button>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <button type="button" class="cp-btn primary" wire:click="cariAnggota" wire:loading.attr="disabled" wire:target="cariAnggota">
                        <svg wire:loading.remove wire:target="cariAnggota" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <svg wire:loading wire:target="cariAnggota" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="animation:spin 1s linear infinite"><path d="M21 12a9 9 0 1 1-18 0"/></svg>
                        Cari Anggota
                    </button>
                </div>

                @if(mb_strlen(trim($memberInput)) >= 3 && empty($memberResults) && ! $member && ! $memberError)
                <p class="cp-hint">Tidak ada anggota yang cocok dengan "{{ $memberInput }}".</p>
                @endif

                @if($memberError)
                <div class="cp-error">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                    {{ $memberError }}
                </div>
                @endif

                @if($member)
                <div class="cp-result">
                    <div class="cp-result-av member">{{ mb_strtoupper(mb_substr($member->nama, 0, 2)) }}</div>
                    <div class="cp-result-body">
                        <p class="cp-result-name">{{ $member->nama }}</p>
                        <span class="cp-result-meta">
                            {{ $member->kode_anggota }}
                            @if($member->kelas) &middot; Kelas {{ $member->kelas }} @endif
                            @if($member->jenis === 'siswa' && $member->tahun_masuk) &middot; Angkatan {{ $member->tahun_masuk }} @endif
                        </span>
                    </div>
                    <span class="cp-result-badge">Aktif</span>
                </div>
                @endif

                <div class="cp-actions">
                    <button type="button" class="cp-btn primary" wire:click="goToStep2" {{ !$member ? 'disabled' : '' }}>
                        Lanjut
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </div>
            </div>
            @endif

            {{-- ══ STEP 2 — Pilih Eksemplar ══ --}}
            @if($step === 2)
            <div>
                @if($member)
                <div class="cp-result" style="margin-bottom:20px;">
                    <div class="cp-result-av member">{{ mb_strtoupper(mb_substr($member->nama, 0, 2)) }}</div>
                    <div class="cp-result-body">
                        <p class="cp-result-name">{{ $member->nama }}</p>
                        <span class="cp-result-meta">{{ $member->kode_anggota }} @if($member->kelas) &middot; Kelas {{ $member->kelas }} @endif</span>
                    </div>
                    <span class="cp-result-badge blue">Anggota dipilih</span>
                </div>
                @endif

                <label class="cp-label" for="cp-book-input">Cari Eksemplar Buku</label>
                <div class="cp-input-row">
                    <input
                        id="cp-book-input"
                        type="text"
                        class="cp-input mono"
                        wire:model="bookInput"
                        wire:keydown.enter="cariEksemplar"
                        placeholder="Ketik kode eksemplar: BK-0001-001"
                        autocomplete="off"
                    >
                    <button type="button" class="cp-btn primary" wire:click="cariEksemplar" wire:loading.attr="disabled" wire:target="cariEksemplar">
                        <svg wire:loading.remove wire:target="cariEksemplar" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <svg wire:loading wire:target="cariEksemplar" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="animation:spin 1s linear infinite"><path d="M21 12a9 9 0 1 1-18 0"/></svg>
                        Cari
                    </button>
                    <x-qr-scanner id="cp-book" field="bookInput" action="cariEksemplar" label="Scan Barcode" />
                </div>
                @if($bookError)
                <div class="cp-error">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                    {{ $bookError }}
                </div>
                @endif

                @if($bookItem)
                <div class="cp-result">
                    <div class="cp-result-av book">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    </div>
                    <div class="cp-result-body">
                        <p class="cp-result-name">{{ $bookItem->book?->judul ?? '—' }}</p>
                        <span class="cp-result-meta">
                            Kode:&nbsp;<code style="font-family:monospace;font-size:12px;">{{ $bookItem->kode_item }}</code>
                            &middot; Kondisi: {{ ucfirst($bookItem->kondisi) }}
                            &middot; <span style="color:var(--ok);font-weight:600;">Tersedia</span>
                        </span>
                    </div>
                </div>
                @endif

                <p class="cp-hint" style="margin-top:12px;">Maksimal 1 buku &middot; Batas kembali 3 hari</p>

                <div class="cp-actions">
                    <button type="button" class="cp-btn secondary" wire:click="backStep">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                        Kembali
                    </button>
                    <button type="button" class="cp-btn primary" wire:click="goToStep3" {{ !$bookItem ? 'disabled' : '' }}>
                        Lanjut ke Konfirmasi
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </div>
            </div>
            @endif

            {{-- ══ STEP 3 — Konfirmasi ══ --}}
            @if($step === 3)
            <div>
                @php
                    $tglPinjam = \Carbon\Carbon::today()->translatedFormat('d F Y');
                    $tglBatas  = \Carbon\Carbon::today()->addDays(3)->translatedFormat('d F Y');
                @endphp
                <div class="cp-summary">
                    <div class="cp-sum-row">
                        <span class="cp-sum-label">Nama Anggota</span>
                        <span class="cp-sum-val">{{ $member?->nama }}</span>
                    </div>
                    <div class="cp-sum-row">
                        <span class="cp-sum-label">Kode Anggota</span>
                        <span class="cp-sum-val mono">{{ $member?->kode_anggota }}</span>
                    </div>
                    <div class="cp-sum-row">
                        <span class="cp-sum-label">Kelas</span>
                        <span class="cp-sum-val">{{ $member?->kelas ?? '—' }}</span>
                    </div>
                    <div class="cp-sum-row">
                        <span class="cp-sum-label">Judul Buku</span>
                        <span class="cp-sum-val">{{ $bookItem?->book?->judul ?? '—' }}</span>
                    </div>
                    <div class="cp-sum-row">
                        <span class="cp-sum-label">Kode Eksemplar</span>
                        <span class="cp-sum-val mono">{{ $bookItem?->kode_item }}</span>
                    </div>
                    <div class="cp-sum-row">
                        <span class="cp-sum-label">Tanggal Pinjam</span>
                        <span class="cp-sum-val">{{ $tglPinjam }}</span>
                    </div>
                    <div class="cp-sum-row">
                        <span class="cp-sum-label">Batas Kembali</span>
                        <span class="cp-sum-val red">{{ $tglBatas }}</span>
                    </div>
                    <div class="cp-sum-row">
                        <span class="cp-sum-label">Petugas</span>
                        <span class="cp-sum-val">{{ auth()->user()?->name }}</span>
                    </div>
                </div>

                <div class="cp-actions">
                    <button type="button" class="cp-btn secondary" wire:click="backStep">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                        Kembali
                    </button>
                    <button type="button" class="cp-btn success" wire:click="simpanPeminjaman" wire:loading.attr="disabled" wire:target="simpanPeminjaman">
                        <svg wire:loading.remove wire:target="simpanPeminjaman" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <svg wire:loading wire:target="simpanPeminjaman" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="animation:spin 1s linear infinite"><path d="M21 12a9 9 0 1 1-18 0"/></svg>
                        Catat Peminjaman
                    </button>
                </div>
            </div>
            @endif

        </div>
    </div>

    {{-- ── Struk Modal ── --}}
    @if($showStruk && $successLoan)
    <div class="cp-modal-bg" wire:click.self="tutupStruk">
        <div class="cp-modal">
            <div class="cp-modal-head">
                <div style="margin-bottom:8px;">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="9 12 11 14 15 10"/></svg>
                </div>
                <h3>Peminjaman Berhasil Dicatat</h3>
                <p>Struk digital peminjaman buku</p>
            </div>
            <div class="cp-modal-body">
                <div class="cp-struk-id">
                    LNS-{{ \Carbon\Carbon::today()->format('Ymd') }}-{{ str_pad($successLoan->id, 4, '0', STR_PAD_LEFT) }}
                </div>
                <div class="cp-struk-row">
                    <span class="cp-struk-label">Anggota</span>
                    <span class="cp-struk-val">{{ $successLoan->member?->nama }}</span>
                </div>
                <div class="cp-struk-row">
                    <span class="cp-struk-label">Kode Anggota</span>
                    <span class="cp-struk-val mono">{{ $successLoan->member?->kode_anggota }}</span>
                </div>
                <div class="cp-struk-row">
                    <span class="cp-struk-label">Buku</span>
                    <span class="cp-struk-val">{{ $successLoan->book?->judul }}</span>
                </div>
                <div class="cp-struk-row">
                    <span class="cp-struk-label">Kode Eksemplar</span>
                    <span class="cp-struk-val mono">{{ $successLoan->bookItem?->kode_item ?? '—' }}</span>
                </div>
                <div class="cp-struk-row">
                    <span class="cp-struk-label">Tanggal Pinjam</span>
                    <span class="cp-struk-val">{{ \Carbon\Carbon::parse($successLoan->tgl_pinjam)->translatedFormat('d F Y') }}</span>
                </div>
                <div class="cp-struk-row">
                    <span class="cp-struk-label">Batas Kembali</span>
                    <span class="cp-struk-val red">{{ \Carbon\Carbon::parse($successLoan->tgl_batas_kembali)->translatedFormat('d F Y') }}</span>
                </div>
            </div>
            <div class="cp-modal-foot">
                <button type="button" class="cp-btn primary" style="width:100%;justify-content:center;height:42px;" wire:click="tutupStruk">
                    Tutup
                </button>
            </div>
        </div>
    </div>
    @endif

</div>
</x-filament-panels::page>
