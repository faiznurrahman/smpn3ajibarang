<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Perpustakaan' }} — SMPN 3 Ajibarang</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --k-navy:   #1e3a8a;
            --k-navy2:  #1e40af;
            --k-orange: #ef7c2a;
            --k-bg:     #f0f4fb;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--k-bg);
            min-height: 100vh;
        }
        .kiosk-header {
            background: var(--k-navy);
            color: #fff;
            padding: 18px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 12px rgba(30,58,138,.25);
        }
        .kiosk-mark {
            width: 44px; height: 44px;
            background: var(--k-orange);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 18px; color: #fff;
            flex-shrink: 0;
            letter-spacing: -1px;
        }
        .kiosk-title { font-size: 17px; font-weight: 700; line-height: 1.2; }
        .kiosk-sub   { font-size: 12px; font-weight: 400; opacity: .75; }
        .kiosk-clock { text-align: right; }
        .kiosk-clock-time { font-size: 22px; font-weight: 800; letter-spacing: 1px; }
        .kiosk-clock-date { font-size: 12px; opacity: .75; }
        .kiosk-main { padding: 36px 24px; }
    </style>
</head>
@php
    $ks = \App\Models\Setting::first();
    $ksLogo  = $ks?->logo ? \Illuminate\Support\Facades\Storage::url($ks->logo) : null;
    $ksNama  = $ks?->nama_sekolah ?? 'SMPN 3 Ajibarang';
@endphp
<body>

<header class="kiosk-header">
    <div style="display:flex;align-items:center;gap:14px;">
        @if($ksLogo)
            <img src="{{ $ksLogo }}" alt="Logo"
                 style="width:44px;height:44px;object-fit:contain;border-radius:10px;background:#fff;padding:3px;flex-shrink:0;">
        @else
            <div class="kiosk-mark">S3</div>
        @endif
        <div>
            <div class="kiosk-title">Perpustakaan {{ $ksNama }}</div>
            <div class="kiosk-sub">Jl. Raya Ajibarang Timur No. 53 Ajibarang</div>
        </div>
    </div>
    <div class="kiosk-clock">
        <div class="kiosk-clock-time" id="kiosk-time">--:--</div>
        <div class="kiosk-clock-date" id="kiosk-date">--</div>
    </div>
</header>

<main class="kiosk-main">
    {{ $slot }}
</main>

<script>
(function () {
    const DAYS = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const MONTHS = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    function tick() {
        const now = new Date();
        const h = String(now.getHours()).padStart(2,'0');
        const m = String(now.getMinutes()).padStart(2,'0');
        document.getElementById('kiosk-time').textContent = h + ':' + m;
        document.getElementById('kiosk-date').textContent =
            DAYS[now.getDay()] + ', ' + now.getDate() + ' ' + MONTHS[now.getMonth()] + ' ' + now.getFullYear();
    }
    tick();
    setInterval(tick, 10000);
})();
</script>

{{ $scripts ?? '' }}
</body>
</html>
