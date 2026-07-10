@php
    $ks = \App\Models\Setting::first();
    $ksLogo  = $ks?->logo ? \Illuminate\Support\Facades\Storage::url($ks->logo) : null;
    $ksNama  = $ks?->nama_sekolah ?? 'SMPN 3 Ajibarang';
    $kioskProfile = \App\Models\KioskProfile::first();
    $kContact = \App\Models\ContactInfo::first();
    $footerAlamat  = $kioskProfile?->kontak_alamat  ?: ($kContact->alamat ?? 'Jl. Raya Ajibarang Timur No. 53, Ajibarang');
    $footerTelepon = $kioskProfile?->kontak_telepon ?: $kContact?->nomor_telepon;
    $footerEmail   = $kioskProfile?->kontak_email   ?: $kContact?->email;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Perpustakaan' }} — SMPN 3 Ajibarang</title>

    @if($ksLogo)
        <link rel="icon" href="{{ $ksLogo }}">
        <link rel="apple-touch-icon" href="{{ $ksLogo }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            /* Palet mengikuti tone warna web profil utama (teal) */
            --k-navy:   #0d7377;
            --k-navy2:  #0a5c60;
            --k-orange: #14a5ab;
            --k-bg:     #f9fafb;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--k-bg);
            min-height: 100vh;
        }
        .kiosk-main { padding: 100px 24px 40px; }

        /* ── Nav (mengikuti konsep navbar web profil) ── */
        .pk-link { position: relative; font-size: 14px; font-weight: 600; color: #4b5563; text-decoration: none; transition: color .2s; }
        .pk-link:hover { color: var(--k-navy); }
        .pk-link::after {
            content: ''; position: absolute; left: 0; bottom: -4px;
            width: 0; height: 2px; background: var(--k-navy); transition: width .3s;
        }
        .pk-link:hover::after, .pk-link.active::after { width: 100%; }
        .pk-link.active { color: var(--k-navy); }

        /* ── Footer (disederhanakan: kontak + copyright) ── */
        .pk-footer { background: var(--k-navy2); color: rgba(255,255,255,.85); }
        .pk-footer-inner { max-width: 1140px; margin: 0 auto; padding: 28px 24px 20px; text-align: center; }
        .pk-footer h4 {
            font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em;
            color: rgba(255,255,255,.5); margin-bottom: 12px;
        }
        .pk-footer-contact {
            display: flex; flex-direction: column; align-items: center; gap: 8px;
            font-size: 13.5px; margin-bottom: 16px;
        }
        .pk-footer-contact div { display: flex; align-items: center; gap: 8px; }
        .pk-footer-contact i { color: var(--k-orange); flex-shrink: 0; width: 14px; text-align: center; }
        .pk-footer-contact a { color: inherit; text-decoration: none; }
        .pk-footer-contact a:hover { color: #fff; }
        .pk-footer-bottom {
            border-top: 1px solid rgba(255,255,255,.12); margin-top: 16px; padding-top: 16px;
            font-size: 12px; color: rgba(255,255,255,.45); text-align: center;
        }
    </style>
</head>
<body>

<nav id="pk-nav" class="fixed top-0 w-full z-50 bg-white border-b border-gray-100">
    <div class="max-w-5xl mx-auto px-5 py-3 flex items-center justify-between">

        <a href="{{ route('perpustakaan.index') }}" class="flex items-center gap-3">
            @if($ksLogo)
                <img src="{{ $ksLogo }}" alt="Logo" class="w-10 h-10 object-contain">
            @else
                <div class="w-10 h-10 rounded-lg flex items-center justify-center font-bold text-white text-xs" style="background:var(--k-navy);">S3</div>
            @endif
            <div class="leading-tight">
                <div class="font-bold text-sm" style="color:var(--k-navy);">Perpustakaan {{ $ksNama }}</div>
                <div class="text-xs text-gray-400">Pusat Literasi Sekolah</div>
            </div>
        </a>

        <ul class="hidden md:flex items-center gap-7">
            <li><a href="{{ route('perpustakaan.index') }}" class="pk-link {{ request()->routeIs('perpustakaan.index') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ route('perpustakaan.layanan') }}" class="pk-link {{ request()->routeIs('perpustakaan.layanan') || request()->routeIs('perpustakaan.hadir*') || request()->routeIs('perpustakaan.katalog') ? 'active' : '' }}">Layanan</a></li>
            <li>
                <a href="{{ route('home') }}" class="flex items-center gap-1.5 text-xs font-semibold text-gray-400 hover:text-gray-600 transition">
                    <i class="fas fa-arrow-up-right-from-square text-[10px]"></i> Situs Utama
                </a>
            </li>
        </ul>

        <button id="pk-burger" class="md:hidden text-lg w-9 h-9 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100" aria-label="Buka menu">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div id="pk-mobile" class="hidden md:hidden bg-white border-t border-gray-100 px-5 pb-3 pt-1">
        <a href="{{ route('perpustakaan.index') }}" class="block py-3 border-b border-gray-100 text-sm font-medium {{ request()->routeIs('perpustakaan.index') ? 'text-[#0d7377]' : 'text-gray-600' }}">Beranda</a>
        <a href="{{ route('perpustakaan.layanan') }}" class="block py-3 border-b border-gray-100 text-sm font-medium {{ request()->routeIs('perpustakaan.layanan') || request()->routeIs('perpustakaan.hadir*') || request()->routeIs('perpustakaan.katalog') ? 'text-[#0d7377]' : 'text-gray-600' }}">Layanan</a>
        <a href="{{ route('home') }}" class="block py-3 text-sm font-medium text-gray-400">
            <i class="fas fa-arrow-up-right-from-square text-[11px] mr-1.5"></i> Situs Utama
        </a>
    </div>
</nav>

<main class="kiosk-main">
    {{ $slot }}
</main>

<footer class="pk-footer">
    <div class="pk-footer-inner">
        <h4>Kontak</h4>
        <div class="pk-footer-contact">
            <div>
                <i class="fas fa-map-marker-alt"></i>
                <span>{{ $footerAlamat }}</span>
            </div>
            @if(!empty($footerTelepon))
            <div>
                <i class="fas fa-phone"></i>
                <a href="tel:{{ $footerTelepon }}">{{ $footerTelepon }}</a>
            </div>
            @endif
            @if(!empty($footerEmail))
            <div>
                <i class="fas fa-envelope"></i>
                <a href="mailto:{{ $footerEmail }}">{{ $footerEmail }}</a>
            </div>
            @endif
        </div>
        <div class="pk-footer-bottom">© {{ date('Y') }} Perpustakaan {{ $ksNama }}. All Rights Reserved.</div>
    </div>
</footer>

<script>
(function () {
    var burger = document.getElementById('pk-burger');
    var menu   = document.getElementById('pk-mobile');
    if (!burger || !menu) return;
    burger.addEventListener('click', function (e) {
        e.stopPropagation();
        menu.classList.toggle('hidden');
    });
    document.addEventListener('click', function (e) {
        if (!menu.contains(e.target) && !burger.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
})();
</script>

@if(session('kiosk_error'))
<div id="kiosk-alert-bg" style="position:fixed;inset:0;background:rgba(15,23,42,.55);z-index:99999;display:flex;align-items:center;justify-content:center;padding:20px;animation:kioskAlertFade .15s ease;">
    <div style="background:#fff;border-radius:16px;max-width:420px;width:100%;padding:34px 28px 28px;text-align:center;box-shadow:0 20px 50px rgba(0,0,0,.25);">
        <div style="width:60px;height:60px;border-radius:50%;background:#fee2e2;color:#dc2626;display:flex;align-items:center;justify-content:center;font-size:24px;margin:0 auto 18px;">
            <i class="fas fa-triangle-exclamation"></i>
        </div>
        <div style="font-size:17px;font-weight:800;color:#1e293b;margin-bottom:8px;">Tidak Dapat Melanjutkan</div>
        <div style="font-size:13.5px;color:#64748b;line-height:1.6;margin-bottom:24px;">{{ session('kiosk_error') }}</div>
        <button type="button" onclick="document.getElementById('kiosk-alert-bg').remove()"
            style="padding:11px 32px;background:var(--k-navy);color:#fff;border:none;border-radius:9px;font-size:14px;font-weight:700;cursor:pointer;font-family:inherit;">
            Mengerti
        </button>
    </div>
</div>
<style>@keyframes kioskAlertFade { from { opacity:0; } to { opacity:1; } }</style>
@endif

{{ $scripts ?? '' }}
</body>
</html>
