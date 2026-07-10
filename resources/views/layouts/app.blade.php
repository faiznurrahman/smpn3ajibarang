<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? ($settings->nama_sekolah ?? 'SMPN 3 Ajibarang') }} – Sekolah Adiwiyata</title>
    <meta name="description" content="{{ $metaDesc ?? 'Website resmi SMPN 3 Ajibarang – Berkomitmen mencetak generasi yang berkarakter, berprestasi, dan peduli lingkungan.' }}">

    @if(!empty($settings->logo))
        <link rel="icon" href="{{ Storage::url($settings->logo) }}">
        <link rel="apple-touch-icon" href="{{ Storage::url($settings->logo) }}">
    @endif

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --teal:       #0d7377;
            --teal-dark:  #0a5c60;
            --teal-light: #e6f4f4;
            --teal-mid:   #14a5ab;
            --bg:         #f9fafb;
        }
        body { font-family: 'Poppins', sans-serif; background: var(--bg); color: #1e293b; }

        .teal-underline::after {
            content: ''; display: block;
            width: 40px; height: 3px;
            background: var(--teal); border-radius: 2px; margin-top: 8px;
        }
        .teal-underline-center::after {
            content: ''; display: block;
            width: 40px; height: 3px;
            background: var(--teal); border-radius: 2px;
            margin: 8px auto 0;
        }

        .nav-link { position: relative; }
        .nav-link::after {
            content: ''; position: absolute;
            left: 0; bottom: -3px;
            width: 0; height: 2px;
            background: var(--teal); transition: width 0.3s;
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
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(13,115,119,0.12);
        }

        #toast { transition: opacity 0.3s; }

        /* ── Page Loader ── */
        @keyframes loader-spin   { to { transform: rotate(360deg); } }
        @keyframes loader-fadein { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:translateY(0); } }

        /* ── Scroll-reveal ── */
        .reveal-ready { will-change: opacity, transform; }
    </style>

    @stack('styles')
</head>
<body class="antialiased">

    {{-- ── Page Loader ── --}}
    <div id="page-loader" style="position:fixed;inset:0;z-index:9999;background:#fff;display:flex;flex-direction:column;align-items:center;justify-content:center;">

        <div style="position:relative;width:100px;height:100px;display:flex;align-items:center;justify-content:center;">

            {{-- Ring luar --}}
            <div style="position:absolute;inset:0;border-radius:50%;border:3px solid rgba(13,115,119,0.1);border-top-color:#0d7377;animation:loader-spin 1s linear infinite;"></div>

            {{-- Ring dalam --}}
            <div style="position:absolute;inset:9px;border-radius:50%;border:2.5px solid rgba(20,165,171,0.1);border-bottom-color:#14a5ab;animation:loader-spin 1.4s linear infinite reverse;"></div>

            {{-- Logo di tengah --}}
            @if(!empty($settings->logo))
                <img src="{{ Storage::url($settings->logo) }}"
                     alt="Logo {{ $settings->nama_sekolah ?? 'SMPN 3 Ajibarang' }}"
                     style="width:60px;height:60px;object-fit:contain;position:relative;z-index:1;">
            @else
                <div style="width:60px;height:60px;border-radius:50%;background:#0d7377;display:flex;align-items:center;justify-content:center;font-family:'Poppins',sans-serif;font-weight:700;font-size:18px;color:#fff;position:relative;z-index:1;">S3</div>
            @endif

        </div>

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
    <div id="toast" class="hidden fixed bottom-6 right-6 z-50 flex items-center gap-3 px-6 py-3 rounded-xl shadow-lg text-white font-medium text-sm">
        <i id="toast-icon" class="text-lg"></i>
        <span id="toast-msg">Pesan berhasil dikirim!</span>
    </div>

    <script>
        function showToast(msg = 'Berhasil!', type = 'success') {
            const toast = document.getElementById('toast');
            const icon  = document.getElementById('toast-icon');
            const msgEl = document.getElementById('toast-msg');
            toast.className = toast.className.replace(/bg-\w+-\d+/g, '');
            toast.classList.add(type === 'success' ? 'bg-green-600' : 'bg-red-500');
            icon.className  = `text-lg fas ${type === 'success' ? 'fa-check-circle' : 'fa-times-circle'}`;
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

        // ── Scroll-reveal ──
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
