{{--
    Navbar SMPN 3 Ajibarang
    - Home: transparan → putih saat scroll
    - Halaman lain: langsung putih dengan shadow
--}}

<nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-300
     {{ request()->routeIs('home') ? '' : 'bg-white shadow-sm border-b border-gray-100' }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 flex items-center justify-between">

        {{-- ── Logo & Nama Sekolah ── --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 flex-shrink-0">
            @if(!empty($settings->logo))
                <img src="{{ Storage::url($settings->logo) }}"
                     class="w-14 h-14 object-contain"
                     alt="Logo {{ $settings->nama_sekolah ?? 'SMPN 3 Ajibarang' }}"/>
            @else
                <div class="w-10 h-10 rounded-full bg-[#0d2b6b] flex items-center justify-center font-black text-white text-xs">S3</div>
            @endif
            <div class="leading-tight">
                <div id="nav-nama" class="font-bold text-sm tracking-wide transition-colors duration-300
                     {{ request()->routeIs('home') ? 'text-white' : 'text-[#0d2b6b]' }}">
                    {{ strtoupper($settings->nama_sekolah ?? 'SMPN 3 AJIBARANG') }}
                </div>
                <div id="nav-sub" class="text-xs font-medium transition-colors duration-300
                     {{ request()->routeIs('home') ? 'text-yellow-300' : 'text-yellow-500' }}">
                    Sekolah Adiwiyata
                </div>
            </div>
        </a>

        {{-- ── Desktop Navigation ── --}}
        <ul class="hidden md:flex items-center gap-7 text-sm font-semibold">

            {{-- Beranda --}}
            <li>
                <a href="{{ route('home') }}"
                   id="nav-link-beranda"
                   data-active="{{ request()->routeIs('home') ? 'true' : 'false' }}"
                   class="nav-link transition-colors duration-300
                          {{ request()->routeIs('home') ? 'text-yellow-300 hover:text-yellow-200' : 'text-[#0d2b6b] hover:text-yellow-500' }}">
                    Beranda
                </a>
            </li>

            {{-- Dropdown Tentang Kami --}}
            <li class="relative group">
                <button data-nav-btn
                        class="nav-link transition-colors duration-300 hover:text-yellow-500 flex items-center gap-1
                               {{ request()->routeIs('home') ? 'text-white' : 'text-[#0d2b6b]' }}
                               {{ request()->routeIs('about.*') ? '!text-yellow-500' : '' }}">
                    Tentang Kami <i class="fas fa-chevron-down text-[10px] mt-0.5"></i>
                </button>
                <ul class="absolute top-full left-1/2 -translate-x-1/2 mt-3 bg-white shadow-xl rounded-2xl py-2 w-52
                           text-gray-700 text-sm font-medium border border-gray-100
                           opacity-0 invisible group-hover:opacity-100 group-hover:visible
                           translate-y-2 group-hover:translate-y-0 transition-all duration-200">
                    @foreach([
                        ['route' => 'about.sejarah',             'label' => 'Sejarah Sekolah',     'icon' => 'fa-landmark'],
                        ['route' => 'about.visi-misi',           'label' => 'Visi & Misi',         'icon' => 'fa-bullseye'],
                        ['route' => 'about.struktur-organisasi', 'label' => 'Struktur Organisasi', 'icon' => 'fa-sitemap'],
                        ['route' => 'about.pengajar',            'label' => 'Data Pengajar',       'icon' => 'fa-chalkboard-teacher'],
                        ['route' => 'about.ekstrakurikuler',     'label' => 'Ekstrakurikuler',     'icon' => 'fa-running'],
                    ] as $nav)
                    <li>
                        <a href="{{ route($nav['route']) }}"
                           class="group flex items-center gap-2 px-4 py-2.5 rounded-xl mx-1 transition
                                  hover:bg-blue-50 hover:text-[#0d2b6b]
                                  {{ request()->routeIs($nav['route'])
                                     ? 'bg-blue-50 text-[#0d2b6b] font-semibold'
                                     : 'text-gray-500' }}">
                            <i class="fas {{ $nav['icon'] }} text-xs w-4 transition-colors
                                      {{ request()->routeIs($nav['route'])
                                         ? 'text-[#0d2b6b]'
                                         : 'text-gray-300 group-hover:text-[#0d2b6b]' }}"></i>
                            {{ $nav['label'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>

            {{-- Dropdown Informasi --}}
            <li class="relative group">
                <button data-nav-btn
                        class="nav-link transition-colors duration-300 hover:text-yellow-500 flex items-center gap-1
                               {{ request()->routeIs('home') ? 'text-white' : 'text-[#0d2b6b]' }}
                               {{ request()->routeIs('information*') ? '!text-yellow-500' : '' }}">
                    Informasi <i class="fas fa-chevron-down text-[10px] mt-0.5"></i>
                </button>
                <ul class="absolute top-full left-1/2 -translate-x-1/2 mt-3 bg-white shadow-xl rounded-2xl py-2 w-44
                           text-gray-700 text-sm font-medium border border-gray-100
                           opacity-0 invisible group-hover:opacity-100 group-hover:visible
                           translate-y-2 group-hover:translate-y-0 transition-all duration-200">
                    @foreach([
                        ['type' => 'berita',     'label' => 'Berita',     'icon' => 'fa-newspaper'],
                        ['type' => 'pengumuman', 'label' => 'Pengumuman', 'icon' => 'fa-bullhorn'],
                        ['type' => 'prestasi',   'label' => 'Prestasi',   'icon' => 'fa-trophy'],
                    ] as $nav)
                    <li>
                        <a href="{{ route('information', ['type' => $nav['type']]) }}"
                           class="group flex items-center gap-2 px-4 py-2.5 rounded-xl mx-1 transition
                                  hover:bg-blue-50 hover:text-[#0d2b6b]
                                  {{ request()->routeIs('information') && request()->query('type') === $nav['type']
                                     ? 'bg-blue-50 text-[#0d2b6b] font-semibold'
                                     : 'text-gray-500' }}">
                            <i class="fas {{ $nav['icon'] }} text-xs w-4 transition-colors
                                      {{ request()->routeIs('information') && request()->query('type') === $nav['type']
                                         ? 'text-[#0d2b6b]'
                                         : 'text-gray-300 group-hover:text-[#0d2b6b]' }}"></i>
                            {{ $nav['label'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>

            {{-- Galeri --}}
            <li>
                <a href="{{ route('gallery') }}"
                   class="nav-link transition-colors duration-300
                          {{ request()->routeIs('home') ? 'text-white hover:text-yellow-300' : 'text-[#0d2b6b] hover:text-yellow-500' }}
                          {{ request()->routeIs('gallery') ? '!text-yellow-500' : '' }}">
                    Galeri
                </a>
            </li>

            {{-- Kontak --}}
            <li>
                <a href="{{ route('contact') }}"
                   class="nav-link transition-colors duration-300
                          {{ request()->routeIs('home') ? 'text-white hover:text-yellow-300' : 'text-[#0d2b6b] hover:text-yellow-500' }}
                          {{ request()->routeIs('contact') ? '!text-yellow-500' : '' }}">
                    Kontak
                </a>
            </li>

        </ul>

        {{-- ── Mobile Hamburger ── --}}
        <button id="mob-btn"
                class="md:hidden text-xl w-10 h-10 flex items-center justify-center rounded-xl transition
                       {{ request()->routeIs('home') ? 'text-white hover:bg-white/10' : 'text-[#0d2b6b] hover:bg-gray-100' }}"
                aria-label="Buka menu">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    {{-- ── Mobile Menu ── --}}
    <div id="mob-menu" class="hidden md:hidden bg-white border-t border-gray-100 px-4 pb-4 pt-2 shadow-lg">

        <a href="{{ route('home') }}"
           class="flex items-center py-3 border-b border-gray-100 text-sm font-medium hover:text-[#0d2b6b] transition
                  {{ request()->routeIs('home') ? 'text-yellow-500' : 'text-gray-700' }}">
            Beranda
        </a>

        <div class="border-b border-gray-100 py-3 space-y-1">
            <div class="text-xs text-gray-400 font-semibold uppercase tracking-widest mb-2">Tentang Kami</div>
            @foreach([
                ['route' => 'about.sejarah',             'label' => 'Sejarah Sekolah',     'icon' => 'fa-landmark'],
                ['route' => 'about.visi-misi',           'label' => 'Visi & Misi',         'icon' => 'fa-bullseye'],
                ['route' => 'about.struktur-organisasi', 'label' => 'Struktur Organisasi', 'icon' => 'fa-sitemap'],
                ['route' => 'about.pengajar',            'label' => 'Data Pengajar',       'icon' => 'fa-chalkboard-teacher'],
                ['route' => 'about.ekstrakurikuler',     'label' => 'Ekstrakurikuler',     'icon' => 'fa-running'],
            ] as $nav)
            <a href="{{ route($nav['route']) }}"
               class="flex items-center gap-2 text-sm py-1.5 pl-2 rounded-lg transition hover:text-[#0d2b6b]
                      {{ request()->routeIs($nav['route']) ? 'text-[#0d2b6b] font-semibold' : 'text-gray-600' }}">
                <i class="fas {{ $nav['icon'] }} text-xs w-4
                          {{ request()->routeIs($nav['route']) ? 'text-[#0d2b6b]' : 'text-gray-300' }}"></i>
                {{ $nav['label'] }}
            </a>
            @endforeach
        </div>

        <div class="border-b border-gray-100 py-3 space-y-1">
            <div class="text-xs text-gray-400 font-semibold uppercase tracking-widest mb-2">Informasi</div>
            @foreach([
                ['type' => 'berita',     'label' => 'Berita',     'icon' => 'fa-newspaper'],
                ['type' => 'pengumuman', 'label' => 'Pengumuman', 'icon' => 'fa-bullhorn'],
                ['type' => 'prestasi',   'label' => 'Prestasi',   'icon' => 'fa-trophy'],
            ] as $nav)
            <a href="{{ route('information', ['type' => $nav['type']]) }}"
               class="flex items-center gap-2 text-sm py-1.5 pl-2 rounded-lg hover:text-[#0d2b6b] transition
                      {{ request()->routeIs('information') && request()->query('type') === $nav['type']
                         ? 'text-[#0d2b6b] font-semibold' : 'text-gray-600' }}">
                <i class="fas {{ $nav['icon'] }} text-xs w-4
                          {{ request()->routeIs('information') && request()->query('type') === $nav['type']
                             ? 'text-[#0d2b6b]' : 'text-gray-300' }}"></i>
                {{ $nav['label'] }}
            </a>
            @endforeach
        </div>

        <a href="{{ route('gallery') }}"
           class="flex items-center py-3 border-b border-gray-100 text-sm font-medium hover:text-[#0d2b6b] transition
                  {{ request()->routeIs('gallery') ? 'text-yellow-500' : 'text-gray-700' }}">
            Galeri
        </a>

        <a href="{{ route('contact') }}"
           class="flex items-center py-3 text-sm font-medium hover:text-[#0d2b6b] transition
                  {{ request()->routeIs('contact') ? 'text-yellow-500' : 'text-gray-700' }}">
            Kontak
        </a>
    </div>
</nav>

@push('scripts')
<script>
(function () {
    const nav     = document.getElementById('navbar');
    const isHome  = {{ request()->routeIs('home') ? 'true' : 'false' }};
    const nama    = document.getElementById('nav-nama');
    const sub     = document.getElementById('nav-sub');
    const burger  = document.getElementById('mob-btn');
    const mobMenu = document.getElementById('mob-menu');
    const navBtns = nav.querySelectorAll('[data-nav-btn]');
    const navLinks = nav.querySelectorAll('a.nav-link:not([data-active="true"])');

    // ── Mobile toggle — jalan di SEMUA halaman ──
    if (burger && mobMenu) {
        burger.addEventListener('click', function (e) {
            e.stopPropagation();
            mobMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function (e) {
            if (!nav.contains(e.target)) {
                mobMenu.classList.add('hidden');
            }
        });
    }

    // ── Non-home: kunci putih permanen ──
    if (!isHome) {
        nav.style.cssText = 'background:#ffffff !important; box-shadow:0 1px 6px rgba(0,0,0,0.06); border-bottom:1px solid #f1f5f9;';
        return;
    }

    // ── Home: scroll effect ──
    function applyScroll(scrolled) {
        if (scrolled) {
            nav.style.cssText = 'background:#ffffff !important; box-shadow:0 1px 8px rgba(0,0,0,0.08); border-bottom:1px solid #f1f5f9;';
            if (nama)   nama.style.color = '#0d2b6b';
            if (sub)    sub.style.color  = '#eab308';
            if (burger) burger.style.color = '#0d2b6b';
            navBtns.forEach(b => b.style.color = '#0d2b6b');
            navLinks.forEach(a => a.style.color = '#0d2b6b');
        } else {
            nav.style.cssText = 'background:transparent !important; box-shadow:none; border-bottom:none;';
            if (nama)   nama.style.color = '#ffffff';
            if (sub)    sub.style.color  = '#fde047';
            if (burger) burger.style.color = '#ffffff';
            navBtns.forEach(b => b.style.color = '#ffffff');
            navLinks.forEach(a => a.style.color = '#ffffff');
        }
    }

    applyScroll(window.scrollY > 60);
    window.addEventListener('scroll', () => applyScroll(window.scrollY > 60), { passive: true });
})();
</script>
@endpush