<div>
@php
    $r = $this->message;

    // Inisial avatar: huruf pertama dari tiap kata (maks 2)
    $parts    = preg_split('/\s+/', trim($r->nama));
    $initials = strtoupper(substr($parts[0], 0, 1));
    if (isset($parts[1])) {
        $initials .= strtoupper(substr($parts[1], 0, 1));
    }

    // Warna avatar berdasarkan huruf pertama
    $avatarColors = [
        'A' => '#1e3a8a', 'B' => '#1d4ed8', 'C' => '#0369a1',
        'D' => '#065f46', 'E' => '#166534', 'F' => '#b45309',
        'G' => '#92400e', 'H' => '#7c3aed', 'I' => '#6d28d9',
        'J' => '#be185d', 'K' => '#9d174d', 'L' => '#0f766e',
        'M' => '#0e7490', 'N' => '#1e40af', 'O' => '#1a56db',
        'P' => '#6b21a8', 'Q' => '#7e22ce', 'R' => '#b91c1c',
        'S' => '#991b1b', 'T' => '#854d0e', 'U' => '#15803d',
        'V' => '#0f6d47', 'W' => '#1f5c84', 'X' => '#4c1d95',
        'Y' => '#713f12', 'Z' => '#7f1d1d',
    ];
    $avatarBg = $avatarColors[strtoupper($initials[0])] ?? '#475569';
@endphp

{{-- ── SVG sprite ── --}}
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <defs>
    <symbol id="mv-check"    viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></symbol>
    <symbol id="mv-envelope" viewBox="0 0 20 20" fill="currentColor"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></symbol>
    <symbol id="mv-mail-open" viewBox="0 0 20 20" fill="currentColor"><path d="M2.94 6.412A2 2 0 002 8.108V16a2 2 0 002 2h12a2 2 0 002-2V8.108a2 2 0 00-.94-1.696l-6-3.75a2 2 0 00-2.12 0l-6 3.75zm2.615 2.423a1 1 0 10-1.11 1.664l5 3.333a1 1 0 001.11 0l5-3.333a1 1 0 00-1.11-1.664L10 12.027 5.555 8.835z"/></symbol>
    <symbol id="mv-phone"    viewBox="0 0 20 20" fill="currentColor"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></symbol>
    <symbol id="mv-at"       viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M14.243 5.757a6 6 0 10-.986 9.284 1 1 0 111.087 1.678A8 8 0 1118 10a3 3 0 01-4.8 2.401A4 4 0 1114 10a1 1 0 102 0c0-1.537-.586-3.07-1.757-4.243zM12 10a2 2 0 10-4 0 2 2 0 004 0z" clip-rule="evenodd"/></symbol>
    <symbol id="mv-arrow"    viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/></symbol>
  </defs>
</svg>

<style>
/* ── Design tokens ─────────────────────────────────── */
.mv {
    --pri:    #1e3a8a;
    --line:   #e6eaf2;
    --line-2: #f1f3f8;
    --t1:     #0f172a;
    --t2:     #5a6478;
    --t3:     #8b94a6;
    --ok:     #16a34a;
    --ok-bg:  #e6f7ed;
    --warn:   #d96815;
    --warn-bg:#fff4ea;
    --r:      14px;
    font-family: inherit;
}

/* ── Wrapper: fill content area, no artificial max-width ── */
.mv-wrap {
    width: 100%;
}

/* ── Card container ───────────────────────────────── */
.mv-card {
    background: white;
    border: 1px solid var(--line);
    border-radius: var(--r);
    box-shadow: 0 1px 3px rgba(15,23,42,.05);
    overflow: hidden;
}

/* ── Header section ───────────────────────────────── */
.mv-hd {
    padding: 28px 32px 24px;
}

/* Baris atas: badge status + timestamp */
.mv-toprow {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    flex-wrap: wrap;
    margin-bottom: 14px;
}

/* Badge status baca */
.mv-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 11.5px;
    font-weight: 600;
    padding: 3px 10px 3px 8px;
    border-radius: 999px;
    letter-spacing: .01em;
}
.mv-badge svg { width: 12px; height: 12px; }
.mv-badge--read   { background: var(--ok-bg);   color: var(--ok);   }
.mv-badge--unread { background: var(--warn-bg);  color: var(--warn); }

/* Timestamp */
.mv-ts {
    font-size: 12px;
    color: var(--t3);
    white-space: nowrap;
}

/* Subjek / judul pesan */
.mv-subj {
    font-size: 22px;
    font-weight: 700;
    color: var(--t1);
    letter-spacing: -.02em;
    line-height: 1.3;
    margin: 0 0 18px;
    word-break: break-word;
}

/* Baris pengirim */
.mv-from {
    display: flex;
    align-items: center;
    gap: 11px;
}

/* Avatar inisial */
.mv-av {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    color: white;
    display: grid;
    place-items: center;
    flex-shrink: 0;
    letter-spacing: .04em;
}

/* Nama pengirim */
.mv-fname {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--t1);
    margin-bottom: 3px;
}

/* Kontak (email & telepon) */
.mv-fcontact {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 4px 8px;
    font-size: 12px;
    color: var(--t3);
}
.mv-fcontact-item {
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.mv-fcontact-item svg {
    width: 11px;
    height: 11px;
    flex-shrink: 0;
    opacity: .7;
}
.mv-fcontact a {
    color: #2563eb;
    text-decoration: none;
}
.mv-fcontact a:hover { text-decoration: underline; }
.mv-fcontact-sep {
    color: var(--line);
    font-size: 14px;
    line-height: 1;
}

/* ── Garis pemisah ────────────────────────────────── */
.mv-divider {
    height: 1px;
    background: var(--line-2);
    margin: 0 32px;
}

/* ── Isi pesan ────────────────────────────────────── */
.mv-body {
    padding: 26px 32px 32px;
    font-size: 14.5px;
    color: #374151;
    line-height: 1.85;
    white-space: pre-wrap;
    word-break: break-word;
    min-height: 80px;
}

/* ── Footer: waktu baca ───────────────────────────── */
.mv-foot {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 5px;
    padding: 12px 32px 16px;
    font-size: 12px;
    color: var(--t3);
    border-top: 1px solid var(--line-2);
}
.mv-foot svg { width: 12px; height: 12px; }

/* ── Tombol kembali ───────────────────────────────── */
.mv-back {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 14px;
    font-size: 13px;
    font-weight: 500;
    color: var(--t2);
    text-decoration: none;
    padding: 6px 12px 6px 10px;
    border: 1px solid var(--line);
    border-radius: 8px;
    background: white;
    transition: background 100ms, border-color 100ms;
}
.mv-back:hover {
    background: #f5f7fc;
    border-color: #d4dae6;
    color: var(--t1);
}
.mv-back svg { width: 14px; height: 14px; }

/* ── Responsive ───────────────────────────────────── */
@media (max-width: 768px) {
    .mv-hd     { padding: 20px 22px 18px; }
    .mv-subj   { font-size: 19px; }
    .mv-divider{ margin: 0 22px; }
    .mv-body   { padding: 20px 22px 26px; font-size: 14px; }
    .mv-foot   { padding: 10px 22px 14px; }
}
@media (max-width: 480px) {
    .mv-hd     { padding: 16px 18px 14px; }
    .mv-subj   { font-size: 17px; }
    .mv-divider{ margin: 0 18px; }
    .mv-body   { padding: 16px 18px 20px; font-size: 13.5px; }
    .mv-foot   { padding: 8px 18px 12px; }
    .mv-av     { width: 34px; height: 34px; font-size: 12px; }
}
</style>

<div class="mv fi-page-content">
<div class="mv-wrap">

  {{-- Tombol kembali --}}
  <a href="{{ route('filament.admin.resources.pesan.index') }}" class="mv-back">
    <svg><use href="#mv-arrow"/></svg>
    Pesan Masuk
  </a>

  <div class="mv-card">

    {{-- ── Header: status + tanggal + subjek + pengirim ── --}}
    <div class="mv-hd">

      {{-- Baris atas: badge + timestamp --}}
      <div class="mv-toprow">
        @if($r->is_read)
          <span class="mv-badge mv-badge--read">
            <svg><use href="#mv-check"/></svg>
            Sudah Dibaca
          </span>
        @else
          <span class="mv-badge mv-badge--unread">
            <svg><use href="#mv-envelope"/></svg>
            Belum Dibaca
          </span>
        @endif
        <span class="mv-ts">{{ $r->created_at->translatedFormat('d F Y, H:i') }}</span>
      </div>

      {{-- Subjek --}}
      <h1 class="mv-subj">{{ $r->subjek ?: '(Tanpa Subjek)' }}</h1>

      {{-- Pengirim --}}
      <div class="mv-from">
        <div class="mv-av" style="background: {{ $avatarBg }}">{{ $initials }}</div>
        <div>
          <div class="mv-fname">{{ $r->nama }}</div>
          <div class="mv-fcontact">
            @if($r->email)
              <span class="mv-fcontact-item">
                <svg><use href="#mv-at"/></svg>
                <a href="mailto:{{ $r->email }}">{{ $r->email }}</a>
              </span>
            @endif
            @if($r->email && $r->nomor_telepon)
              <span class="mv-fcontact-sep">·</span>
            @endif
            @if($r->nomor_telepon)
              <span class="mv-fcontact-item">
                <svg><use href="#mv-phone"/></svg>
                <a href="tel:{{ $r->nomor_telepon }}">{{ $r->nomor_telepon }}</a>
              </span>
            @endif
            @if(!$r->email && !$r->nomor_telepon)
              <span>Tidak ada informasi kontak</span>
            @endif
          </div>
        </div>
      </div>

    </div>{{-- /mv-hd --}}

    {{-- Garis pemisah header ↔ body --}}
    <div class="mv-divider"></div>

    {{-- ── Isi Pesan ── --}}
    <div class="mv-body">{{ $r->isi_pesan ?: '(Tidak ada isi pesan)' }}</div>

    {{-- ── Footer: waktu dibaca ── --}}
    @if($r->is_read && $r->read_at)
      <div class="mv-foot">
        <svg><use href="#mv-mail-open"/></svg>
        Dibaca pada {{ $r->read_at->translatedFormat('d F Y, H:i') }}
      </div>
    @endif

  </div>{{-- /mv-card --}}

</div>{{-- /mv-wrap --}}
</div>{{-- /mv --}}
</div>{{-- livewire root --}}
