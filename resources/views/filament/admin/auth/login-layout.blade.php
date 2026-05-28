@php
    use Illuminate\Support\Facades\Storage;
    $schoolSettings = $livewire->schoolSettings ?? null;
@endphp

<x-filament-panels::layout.base :livewire="$livewire">
<style>
  *, *::before, *::after { box-sizing: border-box; }

  .lc {
    height: 100vh;
    overflow-y: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, -apple-system, sans-serif;
    color-scheme: light;
    background-color: #f0f2f8;
  }

  .lc-frame { width: 100%; max-width: 360px; }

  /* ── Login card ── */
  .lc-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 30px 28px 26px;
    box-shadow:
        0 0 0 1px rgba(30,58,138,0.07),
        0 4px 16px rgba(30,58,138,0.08),
        0 16px 40px rgba(30,58,138,0.07);
  }

  /* ── Brand inside card ── */
  .lc-brand {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    text-align: center;
  }
  .lc-brand-mark {
    width: 48px; height: 48px; border-radius: 12px;
    background: #1e3a8a;
    color: white;
    display: grid; place-items: center;
    font-weight: 800; font-size: 15px; letter-spacing: 0.5px;
    flex-shrink: 0;
  }
  .lc-brand-mark img {
    width: 48px; height: 48px;
    border-radius: 12px;
    object-fit: contain;
  }
  .lc-brand-name {
    font-size: 16px; font-weight: 700;
    color: #0f172a; letter-spacing: -0.01em; line-height: 1.3;
  }
  .lc-brand-sub {
    font-size: 11.5px; font-weight: 500;
    color: #94a3b8; margin-top: 2px;
    text-transform: uppercase; letter-spacing: 0.07em;
  }

  /* ── Divider ── */
  .lc-divider {
    border: none; border-top: 1px solid #e9ecf4;
    margin: 0 0 16px;
  }

  /* ── Heading ── */
  .lc-head { margin-bottom: 14px; }
  .lc-head h1 {
    margin: 0 0 3px;
    font-size: 17px; font-weight: 700; letter-spacing: -0.02em; color: #0f172a;
  }
  .lc-head p {
    margin: 0; color: #64748b; font-size: 12.5px; line-height: 1.5;
  }

  /* ── Footer ── */
  .lc-foot {
    margin-top: 16px; text-align: center;
    font-size: 11.5px; color: #a0aec0;
    letter-spacing: 0.01em; line-height: 1.6;
  }

  /* ── Filament overrides ── */
  .lc .fi-simple-header { display: none !important; }

  .lc .fi-fo-component-ctn {
    background: transparent !important;
    padding: 0 !important;
    border: none !important;
    box-shadow: none !important;
  }

  .lc .fi-btn-color-primary {
    background: #1e3a8a !important;
    box-shadow: 0 1px 4px rgba(30,58,138,0.20) !important;
    transition: background 150ms ease, box-shadow 150ms ease !important;
  }
  .lc .fi-btn-color-primary:hover {
    background: #1a3278 !important;
    box-shadow: 0 4px 14px rgba(30,58,138,0.28) !important;
  }

  .lc input:focus, .lc select:focus {
    outline: none !important;
    border-color: #1e3a8a !important;
    box-shadow: 0 0 0 3px rgba(30,58,138,0.10) !important;
  }

  @media (max-width: 480px) {
    .lc { align-items: center; padding: 20px 16px; }
    .lc-frame { max-width: 320px; }
    .lc-card { padding: 26px 20px 22px; }
    .lc-brand-mark { width: 44px; height: 44px; }
    .lc-brand-mark img { width: 44px; height: 44px; }
  }
</style>

<div class="lc">
  <div class="lc-frame">
    <div class="lc-card">

      {{-- Brand --}}
      <div class="lc-brand">
        @if($schoolSettings?->logo)
          <div class="lc-brand-mark">
            <img src="{{ Storage::url($schoolSettings->logo) }}"
                 alt="Logo {{ $schoolSettings?->nama_sekolah }}">
          </div>
        @else
          <div class="lc-brand-mark">S3</div>
        @endif
        <div>
          <div class="lc-brand-name">{{ $schoolSettings?->nama_sekolah ?? 'SMP Negeri 3 Ajibarang' }}</div>
          <div class="lc-brand-sub">Panel Administrasi</div>
        </div>
      </div>

      <hr class="lc-divider">

      {{-- Heading --}}
      <div class="lc-head">
        <h1>Masuk</h1>
        <p>Masukkan kredensial Anda untuk melanjutkan.</p>
      </div>

      {{-- Form --}}
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
