@php
    use Illuminate\Support\Facades\Storage;
    $schoolSettings = $livewire->schoolSettings ?? null;
@endphp

<x-filament-panels::layout.base :livewire="$livewire">
<style>
  *, *::before, *::after { box-sizing: border-box; }

  /* ── Wrapper — navy gradient background with subtle dot texture ── */
  .lc {
    min-height: 100vh;
    display: grid;
    place-items: center;
    padding: 32px 20px;
    font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, -apple-system, sans-serif;
    color-scheme: light;
    background-color: #162a6b;
    background-image:
        url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Ccircle cx='2' cy='2' r='0.7' fill='rgba(255,255,255,0.055)'/%3E%3C/svg%3E"),
        radial-gradient(ellipse at 22% 28%, rgba(52,86,168,0.55) 0%, transparent 58%),
        radial-gradient(ellipse at 82% 78%, rgba(14,22,64,0.65) 0%, transparent 52%),
        linear-gradient(150deg, #1e3a8a 0%, #162a6b 55%, #111f54 100%);
    background-size: 8px 8px, 100% 100%, 100% 100%, 100% 100%;
  }

  .lc-frame { width: 100%; max-width: 400px; }

  /* ── Brand mark above card ── */
  .lc-brand {
    display: flex; align-items: center; gap: 13px;
    margin-bottom: 28px; justify-content: center;
  }
  .lc-brand-mark {
    width: 46px; height: 46px; border-radius: 12px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.18);
    color: white;
    display: grid; place-items: center;
    font-weight: 800; font-size: 13px; letter-spacing: 0.5px;
    flex: 0 0 46px;
  }
  .lc-brand-text { line-height: 1.25; }
  .lc-brand-text b {
    font-size: 14.5px; font-weight: 700;
    color: rgba(255,255,255,0.90); display: block;
  }
  .lc-brand-text span {
    display: block;
    color: rgba(255,255,255,0.40);
    font-size: 10.5px; font-weight: 600; margin-top: 3px;
    text-transform: uppercase; letter-spacing: 0.08em;
  }

  /* ── Login card ── */
  .lc-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 40px;
    box-shadow:
        0 0 0 1px rgba(0,0,0,0.05),
        0 8px 24px rgba(0,0,0,0.10),
        0 28px 64px rgba(0,0,0,0.20);
  }

  .lc-card-head { margin-bottom: 28px; }
  .lc-card-head h1 {
    margin: 0 0 7px;
    font-size: 21px; font-weight: 700; letter-spacing: -0.02em; color: #0f172a;
  }
  .lc-card-head p {
    margin: 0; color: #64748b; font-size: 13.5px; line-height: 1.55;
  }

  /* ── Footer below card ── */
  .lc-foot {
    margin-top: 24px; text-align: center;
    font-size: 11.5px; color: rgba(255,255,255,0.28);
    letter-spacing: 0.01em; line-height: 1.6;
  }

  /* ── Filament overrides ── */

  /* Hide the fi-simple-header (Filament renders "Sign in" + school name there — we have our own above) */
  .lc .fi-simple-header { display: none !important; }

  /* Strip Filament form wrapper styles so they match our card */
  .lc .fi-fo-component-ctn {
    background: transparent !important;
    padding: 0 !important;
    border: none !important;
    box-shadow: none !important;
  }

  /* Submit button — navy */
  .lc .fi-btn-color-primary {
    background: #1e3a8a !important;
    box-shadow: 0 1px 4px rgba(30,58,138,0.25) !important;
    transition: background 150ms ease, box-shadow 150ms ease !important;
  }
  .lc .fi-btn-color-primary:hover {
    background: #1a3278 !important;
    box-shadow: 0 4px 14px rgba(30,58,138,0.32) !important;
  }

  /* Input focus ring — navy instead of Filament blue */
  .lc input:focus, .lc select:focus {
    outline: none !important;
    border-color: #1e3a8a !important;
    box-shadow: 0 0 0 3px rgba(30,58,138,0.11) !important;
  }

  /* ── Responsive ── */
  @media (max-width: 480px) {
    .lc-card { padding: 28px 22px; }
    .lc-brand-text b { font-size: 13.5px; }
  }
</style>

<div class="lc">
  <div class="lc-frame">

    {{-- Brand above card --}}
    <div class="lc-brand">
      @if($schoolSettings?->logo)
        <img src="{{ Storage::url($schoolSettings->logo) }}"
             alt="Logo {{ $schoolSettings?->nama_sekolah }}"
             style="width:46px;height:46px;border-radius:11px;object-fit:contain;flex:0 0 46px;
                    background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);">
      @else
        <div class="lc-brand-mark">S3</div>
      @endif
      <div class="lc-brand-text">
        <b>{{ $schoolSettings?->nama_sekolah ?? 'SMP Negeri 3 Ajibarang' }}</b>
        <span>Panel Administrasi</span>
      </div>
    </div>

    {{-- Login card --}}
    <div class="lc-card">
      <div class="lc-card-head">
        <h1>Masuk</h1>
        <p>Masukkan kredensial Anda untuk mengakses dasbor.</p>
      </div>
      {{ $slot }}
    </div>

    {{-- Footer --}}
    <div class="lc-foot">
      &copy; {{ date('Y') }} {{ $schoolSettings?->nama_sekolah ?? 'SMP Negeri 3 Ajibarang' }}
      &middot; Panel Administrasi
    </div>

  </div>
</div>
</x-filament-panels::layout.base>
