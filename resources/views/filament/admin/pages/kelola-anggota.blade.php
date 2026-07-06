<x-filament-panels::page>
<style>
[x-cloak]{display:none!important;}
.ka{--pri:#1e3a8a;--pri-2:#2746a4;--pri-50:#eef2ff;--pri-100:#dbe3ff;--ok:#16a34a;--ok-50:#dcfce7;--warn:#d97706;--warn-50:#fef3c7;--red:#dc2626;--red-50:#fee2e2;--line:#e6eaf2;--t1:#0f172a;--t2:#5a6478;--t3:#8b94a6;--panel:#fff;--bg:#f3f5fa;--r:12px;--sh-sm:0 1px 3px rgba(15,23,42,.06);}
.ka{display:flex;flex-direction:column;gap:18px;}
/* card */
.ka-card{background:var(--panel);border:1px solid var(--line);border-radius:var(--r);box-shadow:var(--sh-sm);overflow:hidden;}
.ka-card-head{display:flex;align-items:center;gap:10px;padding:14px 20px;border-bottom:1px solid var(--line);background:var(--bg);}
.ka-badge{width:24px;height:24px;border-radius:50%;background:var(--pri);color:#fff;font-size:12px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.ka-badge.red{background:var(--red);}
.ka-card-title{font-size:13.5px;font-weight:600;color:var(--t1);}
.ka-card-body{padding:18px 20px;}
.ka-desc{font-size:13px;color:var(--t2);margin-bottom:18px;line-height:1.6;}
/* 2-col inner layout */
.ka-inner{display:grid;grid-template-columns:1fr 2fr;gap:24px;align-items:start;}
/* download button */
.ka-dl-btn{display:flex;align-items:center;justify-content:center;gap:7px;padding:10px 16px;background:var(--pri);color:#fff;border-radius:8px;font-size:13px;font-weight:600;text-decoration:none;transition:background .15s;width:100%;}
.ka-dl-btn:hover{background:var(--pri-2);}
.ka-dl-hint{margin-top:7px;font-size:11.5px;color:var(--t3);text-align:center;}
/* notes */
.ka-notes{margin-top:16px;}
.ka-notes-lbl{font-size:10.5px;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--t3);margin-bottom:9px;}
.ka-note{display:flex;gap:7px;margin-bottom:7px;font-size:11.5px;color:var(--t2);line-height:1.5;}
.ka-note-dot{width:4px;height:4px;border-radius:50%;background:var(--t3);flex-shrink:0;margin-top:6px;}
.ka-note code{font-size:10.5px;background:var(--bg);border:1px solid var(--line);border-radius:3px;padding:0 4px;color:var(--t1);font-family:ui-monospace,SFMono-Regular,monospace;}
/* column tags */
.ka-tags{display:flex;flex-wrap:wrap;gap:5px;margin-bottom:8px;}
.ka-tag{display:inline-block;padding:2px 7px;border-radius:5px;font-size:11px;font-family:ui-monospace,SFMono-Regular,monospace;background:var(--bg);border:1px solid var(--line);color:var(--t1);}
.ka-tag.req{background:var(--red-50);border-color:#fca5a5;color:var(--red);}
/* upload form */
.ka-form{display:flex;flex-direction:column;gap:14px;}
.ka-dropzone{position:relative;border:2px dashed var(--line);border-radius:10px;background:var(--bg);transition:border-color .2s,background .2s;cursor:pointer;}
.ka-dropzone.dragging,.ka-dropzone:focus-within{border-color:var(--pri);background:var(--pri-50);}
.ka-dropzone-inner{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;padding:36px 20px;min-height:170px;text-align:center;pointer-events:none;}
.ka-dz-icon{width:42px;height:42px;border-radius:50%;background:var(--pri-100);display:flex;align-items:center;justify-content:center;}
.ka-dz-icon svg{color:var(--pri);}
.ka-dz-text{font-size:13.5px;font-weight:600;color:var(--t1);}
.ka-dz-sub{font-size:12px;color:var(--t3);}
.ka-dz-link{color:var(--pri);font-weight:600;}
.ka-dropzone input[type=file]{position:absolute;inset:0;width:100%;height:100%;opacity:0;cursor:pointer;}
/* file preview */
.ka-file-prev{display:flex;align-items:center;gap:10px;padding:10px 14px;border:1px solid var(--line);border-radius:8px;background:var(--panel);}
.ka-file-icon{width:34px;height:34px;border-radius:7px;background:var(--ok-50);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.ka-file-icon svg{color:var(--ok);}
.ka-file-info{flex:1;min-width:0;}
.ka-file-name{font-size:12.5px;font-weight:600;color:var(--t1);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.ka-file-size{font-size:11px;color:var(--t3);}
.ka-file-rm{flex-shrink:0;padding:3px 9px;font-size:11.5px;color:var(--red);background:var(--red-50);border:1px solid #fca5a5;border-radius:5px;cursor:pointer;line-height:1.6;}
.ka-file-rm:hover{background:#fecaca;}
/* inline error */
.ka-err{display:flex;gap:8px;padding:10px 14px;background:var(--red-50);border:1px solid #fca5a5;border-radius:8px;font-size:12.5px;color:var(--red);align-items:flex-start;}
.ka-err svg{flex-shrink:0;margin-top:1px;}
/* buttons */
.ka-btn-submit{width:100%;padding:11px;background:var(--pri);color:#fff;border:none;border-radius:8px;font-size:13.5px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:background .15s;}
.ka-btn-submit:hover:not(:disabled){background:var(--pri-2);}
.ka-btn-submit:disabled{opacity:.65;cursor:not-allowed;}
.ka-btn-danger{padding:11px 20px;background:var(--red);color:#fff;border:none;border-radius:8px;font-size:13.5px;font-weight:700;cursor:pointer;display:inline-flex;align-items:center;gap:7px;transition:background .15s;}
.ka-btn-danger:hover:not(:disabled){background:#b91c1c;}
.ka-btn-danger:disabled{opacity:.5;cursor:not-allowed;}
.ka-btn-outline{padding:8px 16px;border-radius:7px;border:1px solid var(--line);background:var(--panel);color:var(--t1);font-size:12.5px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:6px;transition:background .15s;text-decoration:none;}
.ka-btn-outline:hover{background:var(--bg);}
.ka-btn-primary{padding:8px 16px;border-radius:7px;background:var(--pri);color:#fff;font-size:12.5px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:6px;transition:background .15s;text-decoration:none;border:none;}
.ka-btn-primary:hover{background:var(--pri-2);}
.ka-spin{width:15px;height:15px;border:2.5px solid rgba(255,255,255,.35);border-top-color:#fff;border-radius:50%;animation:ka-rot .7s linear infinite;}
@keyframes ka-rot{to{transform:rotate(360deg)}}
/* inline result */
.ka-result{margin-top:18px;padding-top:18px;border-top:1px solid var(--line);}
.ka-result-head{display:flex;align-items:center;gap:9px;margin-bottom:14px;}
.ka-res-icon{width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.ka-res-icon.ok{background:var(--ok-50);color:var(--ok);}
.ka-res-icon.err{background:var(--red-50);color:var(--red);}
.ka-result-title{font-size:13.5px;font-weight:700;color:var(--t1);}
.ka-stats{display:flex;gap:10px;margin-bottom:14px;}
.ka-stat{flex:1;padding:12px;border-radius:9px;text-align:center;}
.ka-stat.ok{background:var(--ok-50);border:1px solid #86efac;}
.ka-stat.warn{background:var(--warn-50);border:1px solid #fcd34d;}
.ka-stat.err{background:var(--red-50);border:1px solid #fca5a5;}
.ka-stat-num{font-size:24px;font-weight:800;line-height:1;}
.ka-stat.ok .ka-stat-num{color:var(--ok);}
.ka-stat.warn .ka-stat-num{color:var(--warn);}
.ka-stat.err .ka-stat-num{color:var(--red);}
.ka-stat-lbl{font-size:11px;color:var(--t2);margin-top:3px;}
.ka-res-err-msg{padding:10px 14px;background:var(--red-50);border:1px solid #fca5a5;border-radius:8px;font-size:12.5px;color:var(--red);margin-bottom:14px;word-break:break-word;}
.ka-result-actions{display:flex;gap:8px;flex-wrap:wrap;}
.ka-not-found{margin-top:10px;padding:10px 14px;background:var(--bg);border:1px solid var(--line);border-radius:8px;font-size:12px;color:var(--t2);line-height:1.7;}
.ka-not-found strong{color:var(--t1);}
/* kelulusan section */
.ka-warn-box{display:flex;gap:10px;padding:12px 14px;background:var(--warn-50);border:1px solid #fcd34d;border-radius:8px;font-size:12.5px;color:#78350f;margin-bottom:16px;line-height:1.5;}
.ka-warn-box svg{flex-shrink:0;margin-top:1px;}
.ka-label{display:block;font-size:12.5px;font-weight:600;color:var(--t2);margin-bottom:6px;}
.ka-select{width:100%;padding:9px 12px;border:1px solid var(--line);border-radius:8px;font-size:13.5px;color:var(--t1);background:var(--panel);appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%235a6478' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;}
.ka-select:focus{outline:none;border-color:var(--pri);box-shadow:0 0 0 3px rgba(30,58,138,.08);}
.ka-info-box{display:flex;gap:10px;padding:12px 14px;background:#fffbeb;border:1px solid #fcd34d;border-radius:8px;font-size:13px;color:#92400e;margin-top:12px;line-height:1.5;}
.ka-info-box svg{flex-shrink:0;margin-top:1px;}
/* modal */
.ka-modal-backdrop{position:fixed;inset:0;background:rgba(15,23,42,.45);z-index:9999;display:flex;align-items:center;justify-content:center;padding:20px;}
.ka-modal{background:var(--panel);border-radius:var(--r);box-shadow:0 20px 60px rgba(15,23,42,.2);max-width:440px;width:100%;overflow:hidden;}
.ka-modal-head{padding:18px 20px;border-bottom:1px solid var(--line);display:flex;align-items:center;gap:10px;}
.ka-modal-head-icon{width:36px;height:36px;border-radius:50%;background:var(--red-50);display:flex;align-items:center;justify-content:center;flex-shrink:0;color:var(--red);}
.ka-modal-title{font-size:15px;font-weight:700;color:var(--t1);}
.ka-modal-body{padding:18px 20px;font-size:13.5px;color:var(--t2);line-height:1.6;}
.ka-modal-foot{padding:14px 20px;border-top:1px solid var(--line);display:flex;justify-content:flex-end;gap:10px;}
/* responsive */
@media(max-width:640px){.ka-inner{grid-template-columns:1fr;}.ka-stats{flex-direction:column;}}
</style>

{{-- ── SVG helpers ── --}}
@php
  $iconDownload = '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>';
  $iconUpload   = '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>';
  $iconFile     = '<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>';
  $iconAlert    = '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>';
  $iconCheck    = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>';
  $iconX        = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>';
  $iconSync     = '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>';
  $iconSpinSvg  = '<div class="ka-spin" wire:loading wire:target="%s"></div>';
@endphp

<div class="ka">

{{-- ═══════════════════════════════════════════════════════════
     SECTION 1 — Import Siswa Baru
═══════════════════════════════════════════════════════════════ --}}
<div class="ka-card">
  <div class="ka-card-head">
    <div class="ka-badge">1</div>
    <div class="ka-card-title">Import Siswa Baru</div>
  </div>
  <div class="ka-card-body">

    <p class="ka-desc">Import data siswa baru di awal tahun ajaran dari file Excel. NIS yang sudah ada di sistem akan dilewati otomatis.</p>

    <div class="ka-inner">

      {{-- Kiri: template + keterangan kolom --}}
      <div>
        <a href="{{ route('anggota.template.import') }}" class="ka-dl-btn">
          {!! $iconDownload !!}
          Download Template
        </a>
        <p class="ka-dl-hint">Format .xlsx · dengan contoh data</p>

        <div class="ka-notes">
          <div class="ka-notes-lbl">Kolom wajib</div>
          <div class="ka-tags">
            <code class="ka-tag req">nis</code>
            <code class="ka-tag req">nama</code>
            <code class="ka-tag req">kelas</code>
            <code class="ka-tag req">angkatan</code>
          </div>
          <div class="ka-notes-lbl" style="margin-top:10px;">Catatan pengisian</div>
          <div class="ka-note"><div class="ka-note-dot"></div><div>NIS yang sudah ada di sistem akan <strong>dilewati</strong> (tidak diupdate).</div></div>
          <div class="ka-note"><div class="ka-note-dot"></div><div><code>angkatan</code>: tahun pertama masuk sekolah, contoh <code>2025</code>.</div></div>
          <div class="ka-note"><div class="ka-note-dot"></div><div><code>kelas</code>: format <code>7A</code>, <code>7B</code>, <code>8A</code>, dst.</div></div>
        </div>
      </div>

      {{-- Kanan: form upload --}}
      <form wire:submit="importSiswa" class="ka-form">

        <div class="ka-dropzone"
             x-data="{ dragging: false }"
             @dragover.prevent="dragging = true; $el.classList.add('dragging')"
             @dragleave.prevent="dragging = false; $el.classList.remove('dragging')"
             @drop.prevent="
               dragging = false; $el.classList.remove('dragging');
               const inp = $el.querySelector('input[type=file]');
               const dt = new DataTransfer();
               Array.from($event.dataTransfer.files).forEach(f => dt.items.add(f));
               inp.files = dt.files;
               inp.dispatchEvent(new Event('change'));
             ">
          <div class="ka-dropzone-inner">
            <div class="ka-dz-icon">{!! $iconUpload !!}</div>
            @if ($importFile)
              <div class="ka-dz-text" style="color:var(--ok)">File terpilih ✓</div>
              <div class="ka-dz-sub">Klik untuk mengganti</div>
            @else
              <div class="ka-dz-text">Seret file Excel ke sini</div>
              <div class="ka-dz-sub">atau <span class="ka-dz-link">klik untuk memilih</span></div>
              <div class="ka-dz-sub">.xlsx / .xls &nbsp;·&nbsp; Maks. 2 MB</div>
            @endif
          </div>
          <input type="file" wire:model="importFile" accept=".xlsx,.xls">
        </div>

        @if ($importFile)
          <div class="ka-file-prev">
            <div class="ka-file-icon">{!! $iconFile !!}</div>
            <div class="ka-file-info">
              <div class="ka-file-name">{{ $importFile->getClientOriginalName() }}</div>
              <div class="ka-file-size">{{ number_format($importFile->getSize() / 1024, 1) }} KB</div>
            </div>
            <button type="button" class="ka-file-rm" wire:click="$set('importFile', null)">Hapus</button>
          </div>
        @endif

        @error('importFile')
          <div class="ka-err">{!! $iconAlert !!}<span>{{ $message }}</span></div>
        @enderror

        <button
          type="submit"
          class="ka-btn-submit"
          wire:loading.attr="disabled"
          wire:target="importSiswa,importFile"
          @if($importProcessing) disabled @endif
        >
          <div class="ka-spin" wire:loading wire:target="importSiswa"></div>
          <span wire:loading.remove wire:target="importSiswa" style="display:contents;">{!! $iconSync !!}</span>
          <span wire:loading.remove wire:target="importSiswa">Proses Import</span>
          <span wire:loading wire:target="importSiswa">Memproses…</span>
        </button>

      </form>
    </div>

    {{-- Inline result --}}
    @if ($importDone || $importError)
      <div class="ka-result">

        @if ($importDone)
          <div class="ka-result-head">
            <div class="ka-res-icon ok">{!! $iconCheck !!}</div>
            <div class="ka-result-title">Import selesai</div>
          </div>
          <div class="ka-stats">
            <div class="ka-stat ok">
              <div class="ka-stat-num">{{ $importedCount }}</div>
              <div class="ka-stat-lbl">Berhasil diimpor</div>
            </div>
            <div class="ka-stat {{ ($skippedCount ?? 0) > 0 ? 'warn' : 'ok' }}">
              <div class="ka-stat-num">{{ $skippedCount ?? 0 }}</div>
              <div class="ka-stat-lbl">Dilewati / duplikat</div>
            </div>
          </div>
          <div class="ka-result-actions">
            <button type="button" class="ka-btn-outline" wire:click="resetImportForm">
              {!! $iconSync !!} Import Lagi
            </button>
            <a href="{{ route('filament.admin.resources.anggota.index') }}" class="ka-btn-primary">
              Lihat Data Anggota →
            </a>
          </div>

        @elseif ($importError)
          <div class="ka-result-head">
            <div class="ka-res-icon err">{!! $iconX !!}</div>
            <div class="ka-result-title">Import gagal</div>
          </div>
          @if ($importErrMsg)
            <div class="ka-res-err-msg">{{ $importErrMsg }}</div>
          @endif
          <div class="ka-result-actions">
            <button type="button" class="ka-btn-outline" wire:click="resetImportForm">Coba Lagi</button>
          </div>
        @endif

      </div>
    @endif

  </div>
</div>


{{-- ═══════════════════════════════════════════════════════════
     SECTION 2 — Naik Kelas
═══════════════════════════════════════════════════════════════ --}}
<div class="ka-card">
  <div class="ka-card-head">
    <div class="ka-badge">2</div>
    <div class="ka-card-title">Naik Kelas — Update Data Kelas Massal</div>
  </div>
  <div class="ka-card-body">

    <p class="ka-desc">Upload file Excel untuk memperbarui kelas seluruh siswa secara massal. Template sudah berisi NIS dan kelas lama — cukup isi kolom Kelas Baru.</p>

    <div class="ka-inner">

      {{-- Kiri: template + catatan --}}
      <div>
        <a href="{{ route('anggota.template.update-kelas') }}" class="ka-dl-btn">
          {!! $iconDownload !!}
          Download Template
        </a>
        <p class="ka-dl-hint">Format .xlsx · NIS + Nama + Kelas Lama</p>

        <div class="ka-notes">
          <div class="ka-notes-lbl">Cara pengisian</div>
          <div class="ka-note"><div class="ka-note-dot"></div><div>Template berisi data siswa aktif. Isi kolom <code>kelas_baru</code> (kolom D, kuning).</div></div>
          <div class="ka-note"><div class="ka-note-dot"></div><div>Kolom <code>nama</code> dan <code>kelas_sekarang</code> hanya referensi, tidak diimport.</div></div>
          <div class="ka-note"><div class="ka-note-dot"></div><div>Baris dengan <code>kelas_baru</code> kosong akan dilewati otomatis.</div></div>
          <div class="ka-note"><div class="ka-note-dot"></div><div>NIS tidak ditemukan di sistem akan dilaporkan setelah proses.</div></div>
        </div>
      </div>

      {{-- Kanan: form upload --}}
      <form wire:submit="updateKelas" class="ka-form">

        <div class="ka-dropzone"
             x-data="{ dragging: false }"
             @dragover.prevent="dragging = true; $el.classList.add('dragging')"
             @dragleave.prevent="dragging = false; $el.classList.remove('dragging')"
             @drop.prevent="
               dragging = false; $el.classList.remove('dragging');
               const inp = $el.querySelector('input[type=file]');
               const dt = new DataTransfer();
               Array.from($event.dataTransfer.files).forEach(f => dt.items.add(f));
               inp.files = dt.files;
               inp.dispatchEvent(new Event('change'));
             ">
          <div class="ka-dropzone-inner">
            <div class="ka-dz-icon">{!! $iconUpload !!}</div>
            @if ($updateFile)
              <div class="ka-dz-text" style="color:var(--ok)">File terpilih ✓</div>
              <div class="ka-dz-sub">Klik untuk mengganti</div>
            @else
              <div class="ka-dz-text">Seret file Excel ke sini</div>
              <div class="ka-dz-sub">atau <span class="ka-dz-link">klik untuk memilih</span></div>
              <div class="ka-dz-sub">.xlsx / .xls &nbsp;·&nbsp; Maks. 2 MB</div>
            @endif
          </div>
          <input type="file" wire:model="updateFile" accept=".xlsx,.xls">
        </div>

        @if ($updateFile)
          <div class="ka-file-prev">
            <div class="ka-file-icon">{!! $iconFile !!}</div>
            <div class="ka-file-info">
              <div class="ka-file-name">{{ $updateFile->getClientOriginalName() }}</div>
              <div class="ka-file-size">{{ number_format($updateFile->getSize() / 1024, 1) }} KB</div>
            </div>
            <button type="button" class="ka-file-rm" wire:click="$set('updateFile', null)">Hapus</button>
          </div>
        @endif

        @error('updateFile')
          <div class="ka-err">{!! $iconAlert !!}<span>{{ $message }}</span></div>
        @enderror

        <button
          type="submit"
          class="ka-btn-submit"
          wire:loading.attr="disabled"
          wire:target="updateKelas,updateFile"
          @if($updateProcessing) disabled @endif
        >
          <div class="ka-spin" wire:loading wire:target="updateKelas"></div>
          <span wire:loading.remove wire:target="updateKelas" style="display:contents;">{!! $iconSync !!}</span>
          <span wire:loading.remove wire:target="updateKelas">Proses Update Kelas</span>
          <span wire:loading wire:target="updateKelas">Memproses…</span>
        </button>

      </form>
    </div>

    {{-- Inline result --}}
    @if ($updateDone || $updateError)
      <div class="ka-result">

        @if ($updateDone)
          <div class="ka-result-head">
            <div class="ka-res-icon ok">{!! $iconCheck !!}</div>
            <div class="ka-result-title">Update kelas selesai</div>
          </div>
          <div class="ka-stats">
            <div class="ka-stat ok">
              <div class="ka-stat-num">{{ $updatedCount ?? 0 }}</div>
              <div class="ka-stat-lbl">Data kelas diperbarui</div>
            </div>
            <div class="ka-stat {{ ($notFoundCount ?? 0) > 0 ? 'warn' : 'ok' }}">
              <div class="ka-stat-num">{{ $notFoundCount ?? 0 }}</div>
              <div class="ka-stat-lbl">NIS tidak ditemukan</div>
            </div>
          </div>
          @if (($notFoundCount ?? 0) > 0)
            <div class="ka-not-found">
              <strong>NIS tidak ditemukan:</strong>
              {{ implode(', ', array_slice($notFoundList, 0, 20)) }}
              @if (count($notFoundList) > 20)
                <em>+{{ count($notFoundList) - 20 }} lainnya</em>
              @endif
            </div>
          @endif
          <div class="ka-result-actions" style="margin-top:14px;">
            <button type="button" class="ka-btn-outline" wire:click="resetUpdateForm">
              {!! $iconSync !!} Update Lagi
            </button>
            <a href="{{ route('filament.admin.resources.anggota.index') }}" class="ka-btn-primary">
              Lihat Data Anggota →
            </a>
          </div>

        @elseif ($updateError)
          <div class="ka-result-head">
            <div class="ka-res-icon err">{!! $iconX !!}</div>
            <div class="ka-result-title">Update gagal</div>
          </div>
          @if ($updateErrMsg)
            <div class="ka-res-err-msg">{{ $updateErrMsg }}</div>
          @endif
          <div class="ka-result-actions">
            <button type="button" class="ka-btn-outline" wire:click="resetUpdateForm">Coba Lagi</button>
          </div>
        @endif

      </div>
    @endif

  </div>
</div>


{{-- ═══════════════════════════════════════════════════════════
     SECTION 3 — Kelulusan Angkatan
═══════════════════════════════════════════════════════════════ --}}
<div
  class="ka-card"
  x-data="{ confirmOpen: false }"
>
  <div class="ka-card-head">
    <div class="ka-badge red">3</div>
    <div class="ka-card-title">Kelulusan Angkatan</div>
  </div>
  <div class="ka-card-body">

    <div class="ka-warn-box">
      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
      <span>Nonaktifkan seluruh siswa satu angkatan yang telah lulus. Status berubah menjadi <strong>Lulus</strong> dan akun dinonaktifkan. Data dan riwayat peminjaman tetap tersimpan.</span>
    </div>

    <label class="ka-label">Pilih Angkatan</label>
    <select wire:model.live="selectedAngkatan" class="ka-select">
      <option value="">— Pilih Angkatan —</option>
      @foreach ($angkatanOptions as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
      @endforeach
    </select>

    @if ($selectedAngkatan && $angkatanSiswaCount !== null)
      <div class="ka-info-box">
        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <span><strong>{{ $angkatanSiswaCount }} siswa</strong> angkatan {{ $selectedAngkatan }} akan diubah statusnya menjadi <strong>Lulus</strong> dan dinonaktifkan.</span>
      </div>
    @endif

    <div style="margin-top:16px;">
      <button
        type="button"
        class="ka-btn-danger"
        @click="confirmOpen = true"
        @if (!$selectedAngkatan || !$angkatanSiswaCount) disabled @endif
      >
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        Luluskan Angkatan @if($selectedAngkatan) {{ $selectedAngkatan }} @endif
      </button>
    </div>

  </div>

  {{-- Confirmation Modal --}}
  <div
    x-show="confirmOpen"
    x-cloak
    class="ka-modal-backdrop"
    @keydown.escape.window="confirmOpen = false"
    @click.self="confirmOpen = false"
  >
    <div class="ka-modal">
      <div class="ka-modal-head">
        <div class="ka-modal-head-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </div>
        <div class="ka-modal-title">Konfirmasi Kelulusan</div>
      </div>
      <div class="ka-modal-body">
        Tindakan ini <strong>tidak dapat dibatalkan</strong>. Yakin ingin meluluskan
        <strong>{{ $angkatanSiswaCount ?? 0 }} siswa</strong> angkatan <strong>{{ $selectedAngkatan }}</strong>?
        <br><br>
        Status siswa akan diubah menjadi <em>Lulus</em> dan akun akan dinonaktifkan.
      </div>
      <div class="ka-modal-foot">
        <button type="button" class="ka-btn-outline" @click="confirmOpen = false">Batal</button>
        <button
          type="button"
          class="ka-btn-danger"
          wire:click="luluskanAngkatan"
          @click="confirmOpen = false"
        >
          Ya, Luluskan Angkatan
        </button>
      </div>
    </div>
  </div>

</div>

</div>{{-- /ka --}}
</x-filament-panels::page>
