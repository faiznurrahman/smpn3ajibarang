<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? ($settings->nama_sekolah ?? 'SMPN 3 Ajibarang') }} – Sekolah Adiwiyata</title>
    <meta name="description" content="{{ $metaDesc ?? 'Website resmi SMPN 3 Ajibarang – Berkomitmen mencetak generasi yang berkarakter, berprestasi, dan peduli lingkungan.' }}">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700;800&family=Poppins:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --navy:       #0d2b6b;
            --navy-light: #1a3f8f;
            --gold:       #e8a020;
            --gold-light: #f5c842;
            --bg:         #f7f9fc;
        }
        body { font-family: 'Poppins', sans-serif; background: var(--bg); color: #1e293b; }
        .font-display { font-family: 'Playfair Display', serif; }

        .gold-underline::after {
            content: ''; display: block;
            width: 52px; height: 4px;
            background: var(--gold); border-radius: 2px; margin-top: 8px;
        }
        .gold-underline-center::after {
            content: ''; display: block;
            width: 52px; height: 4px;
            background: var(--gold); border-radius: 2px;
            margin: 8px auto 0;
        }

        .nav-link { position: relative; }
        .nav-link::after {
            content: ''; position: absolute;
            left: 0; bottom: -3px;
            width: 0; height: 2px;
            background: var(--gold); transition: width 0.3s;
        }
        .nav-link:hover::after,
        .nav-link.active::after { width: 100%; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .anim-fade-up { animation: fadeUp 0.7s ease forwards; }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.25s; }
        .delay-3 { animation-delay: 0.4s; }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--navy-light);
            box-shadow: 0 0 0 3px rgba(26,63,143,0.14);
        }

        #toast { transition: opacity 0.3s; }

        /* ── Page Loader ── */
        @keyframes loader-spin { to { transform: rotate(360deg); } }

        /* ── Scroll-reveal smooth easing ── */
        .reveal-ready {
            will-change: opacity, transform;
        }
    </style>

    @stack('styles')
</head>
<body class="antialiased">

    {{-- ── Page Loader ── --}}
    <div id="page-loader" style="position:fixed;inset:0;z-index:9999;background:#0d2b6b;display:flex;flex-direction:column;align-items:center;justify-content:center;">
        <div style="position:relative;width:60px;height:60px;margin-bottom:20px;">
            <div style="position:absolute;inset:0;border-radius:50%;border:2.5px solid rgba(255,255,255,0.08);border-top-color:#e8a020;animation:loader-spin 0.85s linear infinite;"></div>
            <div style="position:absolute;inset:11px;border-radius:50%;background:rgba(255,255,255,0.04);display:flex;align-items:center;justify-content:center;font-family:'Oswald',sans-serif;font-weight:800;font-size:13px;color:rgba(255,255,255,0.7);letter-spacing:1px;">S3</div>
        </div>
        <div style="color:rgba(255,255,255,0.28);font-size:9px;letter-spacing:4px;text-transform:uppercase;font-family:'Poppins',sans-serif;font-weight:600;">Memuat Halaman</div>
    </div>

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Konten Halaman --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    {{-- Toast Notifikasi --}}
    <div id="toast" class="hidden fixed bottom-6 right-6 z-50 flex items-center gap-3 px-6 py-3 rounded-2xl shadow-2xl text-white font-semibold text-sm">
        <i id="toast-icon" class="text-xl"></i>
        <span id="toast-msg">Pesan berhasil dikirim!</span>
    </div>

    <script>
        function showToast(msg = 'Berhasil!', type = 'success') {
            const toast = document.getElementById('toast');
            const icon  = document.getElementById('toast-icon');
            const msgEl = document.getElementById('toast-msg');
            toast.className = toast.className.replace(/bg-\w+-\d+/g, '');
            toast.classList.add(type === 'success' ? 'bg-green-600' : 'bg-red-500');
            icon.className  = `text-xl fas ${type === 'success' ? 'fa-check-circle' : 'fa-times-circle'}`;
            msgEl.textContent = msg;
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 3200);
        }
    </script>

    <script>
        // ── Page Loader dismiss ──
        window.addEventListener('load', function () {
            var l = document.getElementById('page-loader');
            if (!l) return;
            l.style.transition = 'opacity 0.45s ease, visibility 0.45s ease';
            l.style.opacity = '0';
            l.style.visibility = 'hidden';
            setTimeout(function () { if (l.parentNode) l.parentNode.removeChild(l); }, 480);
        });

        // ── Lazy image fade-in ──
        (function () {
            document.querySelectorAll('img[loading="lazy"]').forEach(function (img) {
                img.style.opacity = '0';
                img.style.transition = 'opacity 0.5s ease';
                var show = function () { img.style.opacity = '1'; };
                img.addEventListener('load', show);
                img.addEventListener('error', show);
                if (img.complete) show();
            });
        })();

        // ── Scroll-reveal: animate below-fold opacity-0 elements ──
        (function () {
            if (!('IntersectionObserver' in window)) return;
            var els = document.querySelectorAll('.anim-fade-up.opacity-0');
            els.forEach(function (el) {
                el.style.animation  = 'none';
                el.style.transition = 'opacity 0.65s cubic-bezier(0.22,1,0.36,1), transform 0.65s cubic-bezier(0.22,1,0.36,1)';
                el.style.transform  = 'translateY(22px)';
                if (el.classList.contains('delay-1')) el.style.transitionDelay = '0.1s';
                if (el.classList.contains('delay-2')) el.style.transitionDelay = '0.22s';
                if (el.classList.contains('delay-3')) el.style.transitionDelay = '0.38s';
            });
            var obs = new IntersectionObserver(function (entries) {
                entries.forEach(function (e) {
                    if (e.isIntersecting) {
                        e.target.style.opacity   = '1';
                        e.target.style.transform = 'translateY(0)';
                        obs.unobserve(e.target);
                    }
                });
            }, { threshold: 0.12, rootMargin: '0px 0px -44px 0px' });
            els.forEach(function (el) { obs.observe(el); });
        })();
    </script>

    @stack('scripts')
</body>
</html>