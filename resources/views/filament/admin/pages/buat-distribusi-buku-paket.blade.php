<x-filament-panels::page>
<style>
.bdb {
    --pri:#1e3a8a; --pri-2:#2746a4; --pri-50:#eef2ff; --pri-100:#dbe3ff;
    --ok:#16a34a;  --ok-50:#e6f7ed;
    --warn:#b45309; --warn-50:#fffbeb;
    --err:#dc2626; --err-50:#fee2e2;
    --t1:#0f172a; --t2:#5a6478; --t3:#8b94a6;
    --line:#e6eaf2; --line-2:#d4dae6;
    --panel:#fff;
    --r:14px; --sh:0 1px 2px rgba(15,23,42,.04);
}

/* ── Stepper ── */
.bdb-stepper {
    display:flex; align-items:center; gap:0;
    background:var(--panel); border:1px solid var(--line);
    border-radius:var(--r) var(--r) 0 0; padding:18px 24px;
    border-bottom:none;
}
.bdb-step {
    display:flex; align-items:center; gap:10px; flex:1;
}
.bdb-step-num {
    width:28px; height:28px; border-radius:50%; display:flex; align-items:center; justify-content:center;
    font-size:13px; font-weight:700; flex-shrink:0; border:2px solid var(--line);
    color:var(--t3); background:white; transition:all 150ms;
}
.bdb-step.active .bdb-step-num  { background:var(--pri); border-color:var(--pri); color:white; }
.bdb-step.done .bdb-step-num    { background:var(--ok); border-color:var(--ok); color:white; }
.bdb-step-label { font-size:13px; font-weight:600; color:var(--t3); }
.bdb-step.active .bdb-step-label { color:var(--pri); }
.bdb-step.done .bdb-step-label   { color:var(--ok); }
.bdb-step-sep {
    width:40px; height:2px; background:var(--line); margin:0 8px; flex-shrink:0; transition:background 150ms;
}
.bdb-step-sep.done { background:var(--ok); }

/* ── Card ── */
.bdb-card {
    background:var(--panel); border:1px solid var(--line);
    border-radius:0 0 var(--r) var(--r);
    box-shadow:var(--sh);
}
.bdb-card-body { padding:28px 28px 24px; }

/* ── Form grid ── */
.bdb-form-grid {
    display:grid; grid-template-columns:1fr 1fr; gap:18px 20px;
}
@media (max-width:700px) { .bdb-form-grid { grid-template-columns:1fr; } }
.bdb-form-full { grid-column:1 / -1; }

/* ── Label & input ── */
.bdb-label { display:block; font-size:12.5px; font-weight:600; color:var(--t2); margin-bottom:6px; }
.bdb-label span { color:var(--t3); font-weight:400; }
.bdb-input {
    width:100%; height:40px; border:1px solid var(--line); border-radius:8px;
    padding:0 14px; font-size:13.5px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; box-sizing:border-box;
    transition:border-color 150ms, background 150ms;
}
.bdb-input:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }
.bdb-select {
    width:100%; height:40px; border:1px solid var(--line); border-radius:8px;
    padding:0 12px; font-size:13.5px; color:var(--t1); background:#f8f9fc;
    outline:none; font-family:inherit; cursor:pointer;
    transition:border-color 150ms; box-sizing:border-box;
}
.bdb-select:focus { border-color:var(--pri); background:white; box-shadow:0 0 0 3px rgba(30,58,138,.08); }

/* ── Info box ── */
.bdb-info-box {
    display:flex; align-items:center; gap:12px;
    padding:12px 16px; border-radius:9px; margin-top:0;
    border:1px solid var(--pri-100); background:var(--pri-50); font-size:13px;
}
.bdb-info-box-icon { font-size:20px; flex-shrink:0; }
.bdb-info-box b { color:var(--pri); }
.bdb-info-box.warn { border-color:#fbbf24; background:var(--warn-50); }
.bdb-info-box.warn b { color:var(--warn); }

/* ── Error / warning alerts ── */
.bdb-error {
    display:flex; align-items:center; gap:8px; padding:10px 14px;
    background:var(--err-50); border:1px solid #fca5a5; border-radius:8px;
    font-size:12.5px; color:var(--err); font-weight:500; margin-bottom:14px;
}
.bdb-warnings { margin-top:16px; display:flex; flex-direction:column; gap:6px; }
.bdb-warning-item {
    padding:8px 14px; background:var(--warn-50); border:1px solid #fbbf24;
    border-radius:7px; font-size:12.5px; color:var(--warn); font-weight:500;
}

/* ── Section divider ── */
.bdb-section { margin-top:24px; padding-top:20px; border-top:1px solid var(--line); }
.bdb-section-title {
    font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.07em;
    color:var(--t3); margin-bottom:14px;
}

/* ── Summary card ── */
.bdb-summary {
    background:#f8f9fc; border:1px solid var(--line); border-radius:10px;
    padding:16px 20px; display:grid; grid-template-columns:1fr 1fr; gap:10px 24px;
}
@media (max-width:600px) { .bdb-summary { grid-template-columns:1fr; } }
.bdb-sum-row { font-size:13px; }
.bdb-sum-label { font-size:11.5px; font-weight:600; color:var(--t3); text-transform:uppercase; letter-spacing:.05em; margin-bottom:2px; }
.bdb-sum-val { color:var(--t1); font-weight:600; }

/* ── Textbook checkbox list ── */
.bdb-tb-list { display:flex; flex-direction:column; gap:8px; }
.bdb-tb-item {
    display:flex; align-items:center; gap:14px; padding:13px 16px;
    border:1.5px solid var(--line); border-radius:10px; background:white;
    cursor:pointer; transition:all 120ms; user-select:none;
}
.bdb-tb-item:hover { border-color:var(--pri-100); background:var(--pri-50); }
.bdb-tb-item.selected { border-color:var(--pri); background:var(--pri-50); }
.bdb-tb-check {
    width:20px; height:20px; border-radius:5px; border:2px solid var(--line);
    flex-shrink:0; display:flex; align-items:center; justify-content:center;
    background:white; transition:all 120ms;
}
.bdb-tb-item.selected .bdb-tb-check { background:var(--pri); border-color:var(--pri); }
.bdb-tb-info { flex:1; min-width:0; }
.bdb-tb-judul { font-size:13.5px; font-weight:600; color:var(--t1); }
.bdb-tb-meta  { font-size:12px; color:var(--t3); margin-top:2px; }
.bdb-tb-tersedia {
    font-size:12px; font-weight:600; flex-shrink:0; padding:3px 10px;
    border-radius:999px; background:#f1f3f8; color:var(--t2);
}
.bdb-tb-tersedia.warn { background:var(--warn-50); color:var(--warn); }
.bdb-tb-tersedia.ok   { background:var(--ok-50); color:var(--ok); }

/* ── Buttons ── */
.bdb-actions {
    display:flex; justify-content:flex-end; gap:10px;
    margin-top:28px; padding-top:20px; border-top:1px solid var(--line);
}
.bdb-btn {
    height:40px; padding:0 20px; border-radius:8px; border:none;
    font:inherit; font-size:13.5px; font-weight:600; cursor:pointer;
    display:inline-flex; align-items:center; gap:7px; transition:background 120ms;
}
.bdb-btn.primary { background:var(--pri); color:white; box-shadow:0 1px 2px rgba(30,58,138,.2); }
.bdb-btn.primary:hover { background:var(--pri-2); }
.bdb-btn.primary:disabled { background:#9fa9c1; cursor:not-allowed; box-shadow:none; }
.bdb-btn.success { background:var(--ok); color:white; box-shadow:0 1px 2px rgba(22,163,74,.2); }
.bdb-btn.success:hover { background:#15803d; }
.bdb-btn.secondary { background:white; color:var(--t1); border:1px solid var(--line); }
.bdb-btn.secondary:hover { background:#f5f7fc; border-color:var(--line-2); }

/* ── Empty state ── */
.bdb-empty { padding:40px 20px; text-align:center; color:var(--t3); font-size:13.5px; }
.bdb-empty-icon { font-size:32px; margin-bottom:10px; opacity:.4; }

@keyframes spin { to { transform:rotate(360deg); } }

@media (max-width:1023px) {
    .bdb-card-body { padding:20px 18px 20px; }
    .bdb-input, .bdb-select { font-size:16px !important; height:46px; }
    .bdb-actions { flex-direction:column-reverse; gap:8px; }
    .bdb-actions .bdb-btn { width:100%; justify-content:center; height:46px; font-size:14px; }
}
</style>

<div class="bdb">

    {{-- ── STEPPER ── --}}
    <div class="bdb-stepper">
        <div class="bdb-step {{ $step >= 1 ? ($step > 1 ? 'done' : 'active') : '' }}">
            <div class="bdb-step-num">
                @if($step > 1)
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                @else
                    1
                @endif
            </div>
            <span class="bdb-step-label">Konfigurasi</span>
        </div>

        <div class="bdb-step-sep {{ $step > 1 ? 'done' : '' }}"></div>

        <div class="bdb-step {{ $step >= 2 ? 'active' : '' }}">
            <div class="bdb-step-num">2</div>
            <span class="bdb-step-label">Pilih Buku Paket</span>
        </div>
    </div>

    <div class="bdb-card">
        <div class="bdb-card-body">

            {{-- ════════════ STEP 1: KONFIGURASI ════════════ --}}
            @if($step === 1)

            <div class="bdb-form-grid">

                {{-- Tahun Ajaran --}}
                <div>
                    <label class="bdb-label" for="bdb-tahun">Tahun Ajaran <span>*</span></label>
                    <input
                        id="bdb-tahun"
                        type="text"
                        class="bdb-input"
                        wire:model="tahunAjaran"
                        placeholder="Contoh: 2026/2027"
                        autocomplete="off"
                    >
                    @error('tahunAjaran')
                    <div style="font-size:12px;color:var(--err);margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Untuk Tingkat --}}
                <div>
                    <label class="bdb-label" for="bdb-tingkat">Untuk Tingkat (Kelas) <span>*</span></label>
                    <select id="bdb-tingkat" class="bdb-select" wire:model.live="untukTingkat">
                        <option value="7">Kelas 7</option>
                        <option value="8">Kelas 8</option>
                        <option value="9">Kelas 9</option>
                    </select>
                    @error('untukTingkat')
                    <div style="font-size:12px;color:var(--err);margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tanggal Distribusi --}}
                <div>
                    <label class="bdb-label" for="bdb-tgl-dist">Tanggal Distribusi <span>*</span></label>
                    <input
                        id="bdb-tgl-dist"
                        type="date"
                        class="bdb-input"
                        wire:model="tglDistribusi"
                    >
                    @error('tglDistribusi')
                    <div style="font-size:12px;color:var(--err);margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tanggal Kembali Rencana --}}
                <div>
                    <label class="bdb-label" for="bdb-tgl-kembali">Rencana Tanggal Kembali <span>(opsional)</span></label>
                    <input
                        id="bdb-tgl-kembali"
                        type="date"
                        class="bdb-input"
                        wire:model="tglKembaliRencana"
                    >
                </div>

                {{-- Info siswa aktif (hanya tampil setelah tahun_ajaran diisi) --}}
                @if($untukTingkat && $tahunAjaran)
                <div class="bdb-form-full">
                    @if($formatError)
                    <div class="bdb-info-box warn">
                        <span class="bdb-info-box-icon">⚠️</span>
                        <span>{{ $formatError }}</span>
                    </div>
                    @elseif($jumlahSiswa > 0)
                    <div class="bdb-info-box">
                        <span class="bdb-info-box-icon">👥</span>
                        <span>Ditemukan <b>{{ $jumlahSiswa }} siswa aktif</b> di Kelas {{ $untukTingkat }}.</span>
                    </div>
                    @else
                    <div class="bdb-info-box warn">
                        <span class="bdb-info-box-icon">⚠️</span>
                        <span>Tidak ada siswa aktif untuk Kelas {{ $untukTingkat }}. Pastikan data anggota sudah diimport.</span>
                    </div>
                    @endif
                </div>
                @endif

            </div>

            <div class="bdb-actions">
                <button
                    type="button"
                    class="bdb-btn primary"
                    wire:click="lanjut"
                    wire:loading.attr="disabled"
                    wire:target="lanjut"
                >
                    <svg wire:loading.remove wire:target="lanjut" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                    <svg wire:loading wire:target="lanjut" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="animation:spin 1s linear infinite"><path d="M21 12a9 9 0 1 1-18 0"/></svg>
                    Lanjut
                </button>
            </div>

            @endif {{-- /step 1 --}}

            {{-- ════════════ STEP 2: PILIH BUKU PAKET ════════════ --}}
            @if($step === 2)

            {{-- Ringkasan konfigurasi --}}
            <div class="bdb-section-title" style="margin-bottom:12px;">Ringkasan Distribusi</div>
            <div class="bdb-summary">
                <div class="bdb-sum-row">
                    <div class="bdb-sum-label">Tahun Ajaran</div>
                    <div class="bdb-sum-val">{{ $tahunAjaran }}</div>
                </div>
                <div class="bdb-sum-row">
                    <div class="bdb-sum-label">Untuk Tingkat</div>
                    <div class="bdb-sum-val">Kelas {{ $untukTingkat }}</div>
                </div>
                <div class="bdb-sum-row">
                    <div class="bdb-sum-label">Tanggal Distribusi</div>
                    <div class="bdb-sum-val">{{ \Carbon\Carbon::parse($tglDistribusi)->translatedFormat('d F Y') }}</div>
                </div>
                <div class="bdb-sum-row">
                    <div class="bdb-sum-label">Jumlah Siswa</div>
                    <div class="bdb-sum-val">{{ $jumlahSiswa }} siswa</div>
                </div>
                @if($tglKembaliRencana)
                <div class="bdb-sum-row">
                    <div class="bdb-sum-label">Rencana Kembali</div>
                    <div class="bdb-sum-val">{{ \Carbon\Carbon::parse($tglKembaliRencana)->translatedFormat('d F Y') }}</div>
                </div>
                @endif
            </div>

            {{-- Warning stok --}}
            @if(!empty($warnings))
            <div class="bdb-warnings">
                @foreach($warnings as $w)
                <div class="bdb-warning-item">{{ $w }}</div>
                @endforeach
            </div>
            @endif

            {{-- Error --}}
            @if($error)
            <div class="bdb-error" style="margin-top:14px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                {{ $error }}
            </div>
            @endif

            {{-- Pilih buku paket --}}
            <div class="bdb-section">
                <div class="bdb-section-title">Pilih Buku Paket yang Akan Didistribusikan</div>

                @if(empty($availableTextbooks))
                <div class="bdb-empty">
                    <div class="bdb-empty-icon">📚</div>
                    <div>Tidak ada buku paket aktif untuk Kelas {{ $untukTingkat }}</div>
                </div>
                @else
                <div class="bdb-tb-list">
                    @foreach($availableTextbooks as $tb)
                    @php $isSelected = in_array($tb['id'], $selectedTextbooks); @endphp
                    <div
                        class="bdb-tb-item {{ $isSelected ? 'selected' : '' }}"
                        wire:click="toggleTextbook({{ $tb['id'] }})"
                    >
                        <div class="bdb-tb-check">
                            @if($isSelected)
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3.5"><polyline points="20 6 9 17 4 12"/></svg>
                            @endif
                        </div>
                        <div class="bdb-tb-info">
                            <div class="bdb-tb-judul">{{ $tb['judul'] }}</div>
                            <div class="bdb-tb-meta">{{ $tb['mata_pelajaran'] }} &middot; Prefix: {{ $tb['kode_prefix'] }}</div>
                        </div>
                        <div class="bdb-tb-tersedia {{ $tb['tersedia'] >= $jumlahSiswa ? 'ok' : 'warn' }}">
                            {{ $tb['tersedia'] }} tersedia
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <div class="bdb-actions">
                <button
                    type="button"
                    class="bdb-btn secondary"
                    wire:click="kembali"
                >
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                    Kembali
                </button>

                <button
                    type="button"
                    class="bdb-btn success"
                    wire:click="distribusikan"
                    wire:loading.attr="disabled"
                    wire:target="distribusikan"
                    @if(empty($selectedTextbooks) || $jumlahSiswa === 0) disabled @endif
                >
                    <svg wire:loading.remove wire:target="distribusikan" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    <svg wire:loading wire:target="distribusikan" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="animation:spin 1s linear infinite"><path d="M21 12a9 9 0 1 1-18 0"/></svg>
                    Distribusikan ke {{ $jumlahSiswa }} Siswa
                </button>
            </div>

            @endif {{-- /step 2 --}}

        </div>
    </div>

</div>
</x-filament-panels::page>
