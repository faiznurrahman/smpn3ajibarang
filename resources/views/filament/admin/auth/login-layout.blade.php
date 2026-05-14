@php
    use Illuminate\Support\Facades\Storage;
    $schoolSettings = $livewire->schoolSettings ?? null;
@endphp

<x-filament-panels::layout.base :livewire="$livewire">
<style>
  * { box-sizing: border-box; }
  .lc {
    min-height: 100vh;
    background: #f6f7f9;
    display: grid;
    place-items: center;
    padding: 24px;
    font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, -apple-system, sans-serif;
    color-scheme: light;
  }
  .lc-frame { width: 100%; max-width: 400px; }

  .lc-brand {
    display: flex; align-items: center; gap: 12px;
    margin-bottom: 32px; justify-content: center;
  }
  .lc-brand-mark {
    width: 36px; height: 36px; border-radius: 9px;
    background: #1e3a8a; color: white;
    display: grid; place-items: center;
    font-weight: 700; font-size: 13px; letter-spacing: 0.3px;
    flex: 0 0 36px;
  }
  .lc-brand-text { line-height: 1.2; }
  .lc-brand-text b { font-size: 14px; font-weight: 600; color: #111827; display: block; }
  .lc-brand-text span { display: block; color: #9ca3af; font-size: 11.5px; font-weight: 500; margin-top: 1px; }

  .lc-card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 32px;
  }
  .lc-card-head { margin-bottom: 28px; }
  .lc-card-head h1 {
    margin: 0 0 6px;
    font-size: 22px; font-weight: 700; letter-spacing: -0.01em; color: #111827;
  }
  .lc-card-head p { margin: 0; color: #4b5563; font-size: 13.5px; line-height: 1.5; }

  .lc-foot {
    margin-top: 22px; text-align: center;
    font-size: 12px; color: #9ca3af;
  }
  .lc-foot a { color: #4b5563; text-decoration: none; font-weight: 500; }
  .lc-foot a:hover { color: #1e3a8a; }

  /* Override Filament form to look clean inside the card */
  .lc .fi-fo-component-ctn { background: transparent !important; padding: 0 !important; border: none !important; box-shadow: none !important; }
  .lc .fi-form-actions .fi-btn-color-primary { background: #1e3a8a !important; }
  .lc .fi-form-actions .fi-btn-color-primary:hover { background: #1a3175 !important; }
</style>
<div class="lc">
  <div class="lc-frame">

    <div class="lc-brand">
      @if($schoolSettings?->logo)
        <img src="{{ Storage::url($schoolSettings->logo) }}"
             alt="Logo"
             style="width:36px;height:36px;border-radius:9px;object-fit:contain;flex:0 0 36px;">
      @else
        <div class="lc-brand-mark">S3</div>
      @endif
      <div class="lc-brand-text">
        <b>{{ $schoolSettings?->nama_sekolah ?? 'SMP Negeri 3 Ajibarang' }}</b>
        <span>Panel Administrasi</span>
      </div>
    </div>

    <div class="lc-card">
      <div class="lc-card-head">
        <h1>Masuk</h1>
        <p>Masukkan email dan kata sandi untuk mengakses dasbor.</p>
      </div>
      {{ $slot }}
    </div>

    <div class="lc-foot">
      &copy; {{ date('Y') }} {{ $schoolSettings?->nama_sekolah ?? 'SMPN 3 Ajibarang' }}
      &middot; <a href="#">Bantuan</a>
    </div>

  </div>
</div>
</x-filament-panels::layout.base>
