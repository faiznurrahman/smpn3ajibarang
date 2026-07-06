<x-filament-panels::page>
<style>
.ik{--pri:#1e3a8a;--pri-2:#2746a4;--pri-50:#eef2ff;--pri-100:#dbe3ff;--ok:#16a34a;--ok-50:#dcfce7;--warn:#d97706;--warn-50:#fef3c7;--red:#dc2626;--red-50:#fee2e2;--line:#e6eaf2;--t1:#0f172a;--t2:#5a6478;--t3:#8b94a6;--panel:#fff;--bg:#f3f5fa;--r:12px;--sh-sm:0 1px 3px rgba(15,23,42,.06);}
/* main layout: vertical stack full width */
.ik{display:flex;flex-direction:column;gap:18px;}
/* inner 2-col inside template card */
.ik-template-inner{display:grid;grid-template-columns:1fr 2fr;gap:24px;align-items:start;}
.ik-card{background:var(--panel);border:1px solid var(--line);border-radius:var(--r);box-shadow:var(--sh-sm);overflow:hidden;}
/* card header */
.ik-card-head{display:flex;align-items:center;gap:10px;padding:14px 20px;border-bottom:1px solid var(--line);background:var(--bg);}
.ik-step-badge{width:24px;height:24px;border-radius:50%;background:var(--pri);color:#fff;font-size:12px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.ik-card-title{font-size:13.5px;font-weight:600;color:var(--t1);}
.ik-card-body{padding:18px 20px;}
/* download button */
.ik-dl-btn{display:flex;align-items:center;justify-content:center;gap:7px;padding:10px 16px;background:var(--pri);color:#fff;border-radius:8px;font-size:13px;font-weight:600;text-decoration:none;border:none;cursor:pointer;transition:background .15s;width:100%;}
.ik-dl-btn:hover{background:var(--pri-2);}
.ik-dl-hint{margin-top:7px;font-size:11.5px;color:var(--t3);text-align:center;}
/* column tags */
.ik-cols-section{margin-top:16px;}
.ik-cols-label{font-size:10.5px;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--t3);margin-bottom:6px;}
.ik-cols-label.req{color:var(--red);}
.ik-col-tags{display:flex;flex-wrap:wrap;gap:5px;margin-bottom:12px;}
.ik-tag{display:inline-block;padding:2px 7px;border-radius:5px;font-size:11px;font-family:ui-monospace,SFMono-Regular,monospace;background:var(--bg);border:1px solid var(--line);color:var(--t1);}
.ik-tag.req{background:var(--red-50);border-color:#fca5a5;color:var(--red);}
/* notes */
.ik-notes{border-top:1px solid var(--line);padding-top:14px;margin-top:4px;}
.ik-notes-label{font-size:10.5px;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--t3);margin-bottom:9px;}
.ik-note{display:flex;gap:7px;margin-bottom:7px;font-size:11.5px;color:var(--t2);line-height:1.5;}
.ik-note-dot{width:4px;height:4px;border-radius:50%;background:var(--t3);flex-shrink:0;margin-top:6px;}
.ik-note code{font-size:10.5px;background:var(--bg);border:1px solid var(--line);border-radius:3px;padding:0 4px;color:var(--t1);font-family:ui-monospace,SFMono-Regular,monospace;}
/* upload form */
.ik-form{display:flex;flex-direction:column;gap:14px;}
/* dropzone */
.ik-dropzone{position:relative;border:2px dashed var(--line);border-radius:10px;background:var(--bg);transition:border-color .2s,background .2s;cursor:pointer;}
.ik-dropzone.dragging,.ik-dropzone:focus-within{border-color:var(--pri);background:var(--pri-50);}
.ik-dropzone-inner{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;padding:40px 20px;min-height:190px;text-align:center;pointer-events:none;}
.ik-dz-icon{width:46px;height:46px;border-radius:50%;background:var(--pri-100);display:flex;align-items:center;justify-content:center;}
.ik-dz-icon svg{color:var(--pri);}
.ik-dz-text{font-size:14px;font-weight:600;color:var(--t1);}
.ik-dz-sub{font-size:12px;color:var(--t3);}
.ik-dz-link{color:var(--pri);font-weight:600;}
.ik-dropzone input[type=file]{position:absolute;inset:0;width:100%;height:100%;opacity:0;cursor:pointer;}
/* file preview */
.ik-file-preview{display:flex;align-items:center;gap:10px;padding:10px 14px;border:1px solid var(--line);border-radius:8px;background:var(--panel);}
.ik-file-icon{width:34px;height:34px;border-radius:7px;background:var(--ok-50);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.ik-file-icon svg{color:var(--ok);}
.ik-file-info{flex:1;min-width:0;}
.ik-file-name{font-size:12.5px;font-weight:600;color:var(--t1);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.ik-file-size{font-size:11px;color:var(--t3);}
.ik-file-remove{flex-shrink:0;padding:3px 9px;font-size:11.5px;color:var(--red);background:var(--red-50);border:1px solid #fca5a5;border-radius:5px;cursor:pointer;line-height:1.6;}
.ik-file-remove:hover{background:#fecaca;}
/* error */
.ik-err{display:flex;gap:8px;padding:10px 14px;background:var(--red-50);border:1px solid #fca5a5;border-radius:8px;font-size:12.5px;color:var(--red);align-items:flex-start;}
.ik-err svg{flex-shrink:0;margin-top:1px;}
/* submit button */
.ik-btn-submit{width:100%;padding:12px;background:var(--pri);color:#fff;border:none;border-radius:8px;font-size:14px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:background .15s;}
.ik-btn-submit:hover:not(:disabled){background:var(--pri-2);}
.ik-btn-submit:disabled{opacity:.65;cursor:not-allowed;}
.ik-spin{width:16px;height:16px;border:2.5px solid rgba(255,255,255,.35);border-top-color:#fff;border-radius:50%;animation:ik-rot .7s linear infinite;}
@keyframes ik-rot{to{transform:rotate(360deg)}}
/* result card */
.ik-result{margin-top:18px;}
.ik-result-head{display:flex;align-items:center;gap:10px;padding:14px 20px;border-bottom:1px solid var(--line);}
.ik-result-head.ok{background:#f0fdf4;}
.ik-result-head.err{background:var(--red-50);}
.ik-res-icon{width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.ik-res-icon.ok{background:var(--ok-50);color:var(--ok);}
.ik-res-icon.err{background:var(--red-50);color:var(--red);}
.ik-result-title{font-size:14px;font-weight:700;color:var(--t1);}
.ik-result-body{padding:18px 20px;}
.ik-stats{display:flex;gap:12px;margin-bottom:16px;}
.ik-stat{flex:1;padding:14px;border-radius:9px;text-align:center;}
.ik-stat.ok{background:var(--ok-50);border:1px solid #86efac;}
.ik-stat.warn{background:var(--warn-50);border:1px solid #fcd34d;}
.ik-stat.err{background:var(--red-50);border:1px solid #fca5a5;}
.ik-stat-num{font-size:28px;font-weight:800;line-height:1;}
.ik-stat.ok .ik-stat-num{color:var(--ok);}
.ik-stat.warn .ik-stat-num{color:var(--warn);}
.ik-stat.err .ik-stat-num{color:var(--red);}
.ik-stat-label{font-size:11px;color:var(--t2);margin-top:4px;}
.ik-res-err-msg{padding:10px 14px;background:var(--red-50);border:1px solid #fca5a5;border-radius:8px;font-size:12.5px;color:var(--red);margin-bottom:16px;word-break:break-word;}
.ik-result-actions{display:flex;gap:10px;flex-wrap:wrap;}
.ik-btn-outline{padding:8px 16px;border-radius:7px;border:1px solid var(--line);background:var(--panel);color:var(--t1);font-size:13px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:6px;transition:background .15s;text-decoration:none;}
.ik-btn-outline:hover{background:var(--bg);}
.ik-btn-primary{padding:8px 16px;border-radius:7px;background:var(--pri);color:#fff;font-size:13px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:6px;transition:background .15s;text-decoration:none;border:none;}
.ik-btn-primary:hover{background:var(--pri-2);}
/* responsive */
@media(max-width:640px){.ik-template-inner{grid-template-columns:1fr;}.ik-stats{flex-direction:column;}}
</style>

<div class="ik">

  {{-- ─── Card 1: Download Template ─── --}}
  <div class="ik-card">
    <div class="ik-card-head">
      <div class="ik-step-badge">1</div>
      <div class="ik-card-title">Download Template</div>
    </div>
    <div class="ik-card-body">
      <div class="ik-template-inner">

        {{-- Kiri: tombol download + catatan --}}
        <div>
          <a href="{{ route('buku.template') }}" class="ik-dl-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Download Template Excel
          </a>
          <p class="ik-dl-hint">Format .xlsx · 24 kolom · dengan contoh data</p>

          <div class="ik-notes" style="margin-top:18px;border-top:none;padding-top:0;">
            <div class="ik-notes-label">Catatan pengisian</div>
            <div class="ik-note"><div class="ik-note-dot"></div><div><code>kode_buku</code> kosong → otomatis <code>BK-XXXX</code>. Baris dengan kode yang sudah ada di sistem akan <strong>dilewati</strong>.</div></div>
            <div class="ik-note"><div class="ik-note-dot"></div><div><code>sumber</code>: <code>beli</code> / <code>hibah</code> / <code>sumbangan</code></div></div>
            <div class="ik-note"><div class="ik-note-dot"></div><div><code>tgl_masuk</code>: format <code>YYYY-MM-DD</code> · contoh: <code>2024-01-15</code></div></div>
            <div class="ik-note"><div class="ik-note-dot"></div><div><code>bahasa</code>: kode ISO — <code>ind</code> · <code>eng</code> · <code>ara</code> · <code>chi</code> · <code>dut</code> · <code>fre</code> · <code>ger</code> · <code>jpn</code> · <code>may</code></div></div>
            <div class="ik-note"><div class="ik-note-dot"></div><div><code>bentuk_karya</code>: <code>0</code>=Non-fiksi · <code>1</code>=Fiksi · <code>f</code>=Novel · <code>j</code>=Cerpen · <code>d</code>=Drama · <code>p</code>=Puisi · <code>e</code>=Esai · <code>|</code>=Lainnya</div></div>
            <div class="ik-note"><div class="ik-note-dot"></div><div><code>jumlah_halaman</code>: angka saja (contoh: <code>256</code>). <code>dimensi</code>: teks bebas (contoh: <code>14.8 x 21 cm</code>)</div></div>
            <div class="ik-note"><div class="ik-note-dot"></div><div><code>status</code>: <code>aktif</code> / <code>nonaktif</code> (default: <code>aktif</code>)</div></div>
          </div>
        </div>

        {{-- Kanan: daftar kolom --}}
        <div class="ik-cols-section" style="margin-top:0;">
          <div class="ik-cols-label req">Wajib diisi</div>
          <div class="ik-col-tags">
            <code class="ik-tag req">judul</code>
            <code class="ik-tag req">penulis</code>
          </div>
          <div class="ik-cols-label" style="margin-top:12px;">Kolom opsional</div>
          <div class="ik-col-tags">
            <code class="ik-tag">kode_buku</code>
            <code class="ik-tag">no_panggil</code>
            <code class="ik-tag">isbn</code>
            <code class="ik-tag">anak_judul</code>
            <code class="ik-tag">pengarang_tambahan</code>
            <code class="ik-tag">penerbit</code>
            <code class="ik-tag">tahun</code>
            <code class="ik-tag">edisi</code>
            <code class="ik-tag">kota_terbit</code>
            <code class="ik-tag">deskripsi_fisik</code>
            <code class="ik-tag">jumlah_halaman</code>
            <code class="ik-tag">dimensi</code>
            <code class="ik-tag">bahasa</code>
            <code class="ik-tag">bentuk_karya</code>
            <code class="ik-tag">sumber</code>
            <code class="ik-tag">tgl_masuk</code>
            <code class="ik-tag">harga</code>
            <code class="ik-tag">kategori</code>
            <code class="ik-tag">rak</code>
            <code class="ik-tag">stok</code>
            <code class="ik-tag">deskripsi</code>
            <code class="ik-tag">status</code>
          </div>
        </div>

      </div>
    </div>
  </div>

  {{-- ─── Card 2: Upload & Import ─── --}}
  <div class="ik-card">
    <div class="ik-card-head">
      <div class="ik-step-badge">2</div>
      <div class="ik-card-title">Upload &amp; Proses Import</div>
    </div>
    <div class="ik-card-body">

        <form wire:submit="import" class="ik-form">

          {{-- Dropzone --}}
          <div class="ik-dropzone"
               x-data="{ dragging: false }"
               @dragover.prevent="dragging = true; $el.classList.add('dragging')"
               @dragleave.prevent="dragging = false; $el.classList.remove('dragging')"
               @drop.prevent="
                 dragging = false;
                 $el.classList.remove('dragging');
                 const input = $el.querySelector('input[type=file]');
                 const dt = new DataTransfer();
                 Array.from($event.dataTransfer.files).forEach(f => dt.items.add(f));
                 input.files = dt.files;
                 input.dispatchEvent(new Event('change'));
               ">

            <div class="ik-dropzone-inner">
              <div class="ik-dz-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
              </div>
              @if ($file)
                <div class="ik-dz-text" style="color:var(--ok)">File terpilih ✓</div>
                <div class="ik-dz-sub">Klik untuk mengganti file</div>
              @else
                <div class="ik-dz-text">Seret file Excel ke sini</div>
                <div class="ik-dz-sub">atau <span class="ik-dz-link">klik untuk memilih</span></div>
                <div class="ik-dz-sub">.xlsx / .xls &nbsp;·&nbsp; Maks. 2 MB</div>
              @endif
            </div>

            <input type="file" wire:model="file" accept=".xlsx,.xls">
          </div>

          {{-- File preview --}}
          @if ($file)
            <div class="ik-file-preview">
              <div class="ik-file-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
              </div>
              <div class="ik-file-info">
                <div class="ik-file-name">{{ $file->getClientOriginalName() }}</div>
                <div class="ik-file-size">{{ number_format($file->getSize() / 1024, 1) }} KB</div>
              </div>
              <button type="button" class="ik-file-remove" wire:click="$set('file', null)">Hapus</button>
            </div>
          @endif

          {{-- Validation error --}}
          @error('file')
            <div class="ik-err">
              <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
              <span>{{ $message }}</span>
            </div>
          @enderror

          {{-- Submit --}}
          <button
            type="submit"
            class="ik-btn-submit"
            wire:loading.attr="disabled"
            wire:target="import,file"
            @if($isProcessing) disabled @endif
          >
            <div class="ik-spin" wire:loading wire:target="import"></div>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" wire:loading.remove wire:target="import"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
            <span wire:loading.remove wire:target="import">Proses Import</span>
            <span wire:loading wire:target="import">Memproses…</span>
          </button>

        </form>
      </div>
    </div>

  {{-- ─── Result card ─── --}}
  @if ($importDone || $importError)
    <div class="ik-result">
      <div class="ik-card">

        @if ($importDone)
          <div class="ik-result-head ok">
            <div class="ik-res-icon ok">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div class="ik-result-title">Import selesai</div>
          </div>
          <div class="ik-result-body">
            <div class="ik-stats">
              <div class="ik-stat ok">
                <div class="ik-stat-num">{{ $importedCount }}</div>
                <div class="ik-stat-label">Berhasil diimpor</div>
              </div>
              <div class="ik-stat warn">
                <div class="ik-stat-num">{{ $skippedCount }}</div>
                <div class="ik-stat-label">Dilewati (sudah ada)</div>
              </div>
              <div class="ik-stat err">
                <div class="ik-stat-num">{{ $failureCount }}</div>
                <div class="ik-stat-label">Gagal validasi</div>
              </div>
            </div>
            <div class="ik-result-actions">
              <button type="button" class="ik-btn-outline" wire:click="resetForm">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
                Import Lagi
              </button>
              <a href="{{ route('filament.admin.resources.katalog.index') }}" class="ik-btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                Lihat Data Katalog
              </a>
            </div>
          </div>

        @elseif ($importError)
          <div class="ik-result-head err">
            <div class="ik-res-icon err">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            </div>
            <div class="ik-result-title">Import gagal</div>
          </div>
          <div class="ik-result-body">
            @if ($errorMessage)
              <div class="ik-res-err-msg">{{ $errorMessage }}</div>
            @endif
            <div class="ik-result-actions">
              <button type="button" class="ik-btn-outline" wire:click="resetForm">Coba Lagi</button>
            </div>
          </div>
        @endif

      </div>
    </div>
  @endif

</div>{{-- /ik --}}
</x-filament-panels::page>
