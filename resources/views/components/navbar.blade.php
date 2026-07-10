{{--
    Navbar SMPN 3 Ajibarang — Deep Teal
    - Home: transparan → putih saat scroll
    - Halaman lain: langsung putih dengan border-bottom
--}}

<nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-300
     {{ request()->routeIs('home') ? '' : 'bg-white border-b border-gray-100' }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 flex items-center justify-between">

        {{-- ── Logo & Nama Sekolah ── --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 flex-shrink-0">
            @if(!empty($settings->logo))
                <img src="{{ Storage::url($settings->logo) }}"
                     class="w-12 h-12 object-contain"
                     alt="Logo {{ $settings->nama_sekolah ?? 'SMPN 3 Ajibarang' }}"/>
            @else
                <div class="w-10 h-10 rounded-full bg-[#0d7377] flex items-center justify-center font-bold text-white text-xs">S3</div>
            @endif
            <div class="leading-tight">
                <div id="nav-nama" class="font-bold text-sm tracking-wide transition-colors duration-300
                     {{ request()->routeIs('home') ? 'text-white' : 'text-[#0d7377]' }}">
                    {{ strtoupper($settings->nama_sekolah ?? 'SMPN 3 AJIBARANG') }}
                </div>
                <div id="nav-sub" class="text-xs font-medium transition-colors duration-300
                     {{ request()->routeIs('home') ? 'text-white/70' : 'text-gray-400' }}">
                    Sekolah Adiwiyata
                </div>
            </div>
        </a>

        {{-- ── Desktop Navigation ── --}}
        <ul class="hidden md:flex items-center gap-7 text-sm font-medium">

            {{-- Beranda --}}
            <li>
                <a href="{{ route('home') }}"
                   id="nav-link-beranda"
                   data-active="{{ request()->routeIs('home') ? 'true' : 'false' }}"
                   class="nav-link transition-colors duration-300
                          {{ request()->routeIs('home') ? 'text-white' : 'text-gray-600 hover:text-[#0d7377]' }}">
                    Beranda
                </a>
            </li>

            {{-- Dropdown Tentang Kami --}}
            <li class="relative group">
                <button data-nav-btn
                        class="nav-link transition-colors duration-300 flex items-center gap-1
                               {{ request()->routeIs('home') ? 'text-white' : 'text-gray-600 hover:text-[#0d7377]' }}
                               {{ request()->routeIs('about.*') ? '!text-[#0d7377]' : '' }}">
                    Tentang Kami <i class="fas fa-chevron-down text-[10px] mt-0.5"></i>
                </button>
                <ul class="absolute top-full left-1/2 -translate-x-1/2 mt-3 bg-white shadow-lg rounded-xl py-1.5 w-52
                           text-gray-600 text-sm border border-gray-100
                           opacity-0 invisible group-hover:opacity-100 group-hover:visible
                           translate-y-2 group-hover:translate-y-0 transition-all duration-200">
                    @foreach([
                        ['route' => 'about.sejarah',             'label' => 'Sejarah Sekolah'],
                        ['route' => 'about.visi-misi',           'label' => 'Visi & Misi'],
                        ['route' => 'about.struktur-organisasi', 'label' => 'Struktur Organisasi'],
                        ['route' => 'about.pengajar',            'label' => 'Data Pengajar'],
                        ['route' => 'about.ekstrakurikuler',     'label' => 'Ekstrakurikuler'],
                    ] as $nav)
                    <li>
                        <a href="{{ route($nav['route']) }}"
                           class="block px-4 py-2 transition hover:bg-[#e6f4f4] hover:text-[#0d7377]
                                  {{ request()->routeIs($nav['route']) ? 'bg-[#e6f4f4] text-[#0d7377] font-semibold' : '' }}">
                            {{ $nav['label'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>

            {{-- Dropdown Informasi --}}
            <li class="relative group">
                <button data-nav-btn
                        class="nav-link transition-colors duration-300 flex items-center gap-1
                               {{ request()->routeIs('home') ? 'text-white' : 'text-gray-600 hover:text-[#0d7377]' }}
                               {{ request()->routeIs('information*') ? '!text-[#0d7377]' : '' }}">
                    Informasi <i class="fas fa-chevron-down text-[10px] mt-0.5"></i>
                </button>
                <ul class="absolute top-full left-1/2 -translate-x-1/2 mt-3 bg-white shadow-lg rounded-xl py-1.5 w-44
                           text-gray-600 text-sm border border-gray-100
                           opacity-0 invisible group-hover:opacity-100 group-hover:visible
                           translate-y-2 group-hover:translate-y-0 transition-all duration-200">
                    @foreach([
                        ['type' => 'berita',     'label' => 'Berita'],
                        ['type' => 'pengumuman', 'label' => 'Pengumuman'],
                        ['type' => 'prestasi',   'label' => 'Prestasi'],
                    ] as $nav)
                    <li>
                        <a href="{{ route('information', ['type' => $nav['type']]) }}"
                           class="block px-4 py-2 transition hover:bg-[#e6f4f4] hover:text-[#0d7377]
                                  {{ request()->routeIs('information') && request()->query('type') === $nav['type']
                                     ? 'bg-[#e6f4f4] text-[#0d7377] font-semibold' : '' }}">
                            {{ $nav['label'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>

            {{-- Perpustakaan --}}
            <li>
                <a href="{{ route('perpustakaan.index') }}"
                   class="nav-link transition-colors duration-300
                          {{ request()->routeIs('home') ? 'text-white' : 'text-gray-600 hover:text-[#0d7377]' }}
                          {{ request()->routeIs('perpustakaan.*') ? '!text-[#0d7377]' : '' }}">
                    Perpustakaan
                </a>
            </li>

            {{-- Galeri --}}
            <li>
                <a href="{{ route('gallery') }}"
                   class="nav-link transition-colors duration-300
                          {{ request()->routeIs('home') ? 'text-white' : 'text-gray-600 hover:text-[#0d7377]' }}
                          {{ request()->routeIs('gallery') ? '!text-[#0d7377]' : '' }}">
                    Galeri
                </a>
            </li>

            {{-- Kontak --}}
            <li>
                <a href="{{ route('contact') }}"
                   class="nav-link transition-colors duration-300
                          {{ request()->routeIs('home') ? 'text-white' : 'text-gray-600 hover:text-[#0d7377]' }}
                          {{ request()->routeIs('contact') ? '!text-[#0d7377]' : '' }}">
                    Kontak
                </a>
            </li>

        </ul>

        {{-- ── Mobile Hamburger ── --}}
        <button id="mob-btn"
                class="md:hidden text-xl w-10 h-10 flex items-center justify-center rounded-xl transition
                       {{ request()->routeIs('home') ? 'text-white hover:bg-white/10' : 'text-gray-600 hover:bg-gray-100' }}"
                aria-label="Buka menu">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    {{-- ── Mobile Menu ── --}}
    <div id="mob-menu" class="hidden md:hidden bg-white border-t border-gray-100 px-4 pb-4 pt-2">

        <a href="{{ route('home') }}"
           class="flex items-center py-3 border-b border-gray-100 text-sm font-medium transition
                  {{ request()->routeIs('home') ? 'text-[#0d7377]' : 'text-gray-600 hover:text-[#0d7377]' }}">
            Beranda
        </a>

        <div class="border-b border-gray-100 py-3 space-y-0.5">
            <div class="text-[10px] text-gray-400 font-semibold uppercase tracking-widest mb-2">Tentang Kami</div>
            @foreach([
                ['route' => 'about.sejarah',             'label' => 'Sejarah Sekolah'],
                ['route' => 'about.visi-misi',           'label' => 'Visi & Misi'],
                ['route' => 'about.struktur-organisasi', 'label' => 'Struktur Organisasi'],
                ['route' => 'about.pengajar',            'label' => 'Data Pengajar'],
                ['route' => 'about.ekstrakurikuler',     'label' => 'Ekstrakurikuler'],
            ] as $nav)
            <a href="{{ route($nav['route']) }}"
               class="block text-sm py-1.5 pl-3 rounded-lg transition
                      {{ request()->routeIs($nav['route']) ? 'text-[#0d7377] font-semibold' : 'text-gray-600 hover:text-[#0d7377]' }}">
                {{ $nav['label'] }}
            </a>
            @endforeach
        </div>

        <div class="border-b border-gray-100 py-3 space-y-0.5">
            <div class="text-[10px] text-gray-400 font-semibold uppercase tracking-widest mb-2">Informasi</div>
            @foreach([
                ['type' => 'berita',     'label' => 'Berita'],
                ['type' => 'pengumuman', 'label' => 'Pengumuman'],
                ['type' => 'prestasi',   'label' => 'Prestasi'],
            ] as $nav)
            <a href="{{ route('information', ['type' => $nav['type']]) }}"
               class="block text-sm py-1.5 pl-3 rounded-lg transition
                      {{ request()->routeIs('information') && request()->query('type') === $nav['type']
                         ? 'text-[#0d7377] font-semibold' : 'text-gray-600 hover:text-[#0d7377]' }}">
                {{ $nav['label'] }}
            </a>
            @endforeach
        </div>

        <a href="{{ route('perpustakaan.index') }}"
           class="flex items-center py-3 border-b border-gray-100 text-sm font-medium transition
                  {{ request()->routeIs('perpustakaan.*') ? 'text-[#0d7377]' : 'text-gray-600 hover:text-[#0d7377]' }}">
            Perpustakaan
        </a>

        <a href="{{ route('gallery') }}"
           class="flex items-center py-3 border-b border-gray-100 text-sm font-medium transition
                  {{ request()->routeIs('gallery') ? 'text-[#0d7377]' : 'text-gray-600 hover:text-[#0d7377]' }}">
            Galeri
        </a>

        <a href="{{ route('contact') }}"
           class="flex items-center py-3 text-sm font-medium transition
                  {{ request()->routeIs('contact') ? 'text-[#0d7377]' : 'text-gray-600 hover:text-[#0d7377]' }}">
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
    const navBtns   = nav.querySelectorAll('[data-nav-btn]');
    const navLinks  = nav.querySelectorAll('a.nav-link:not([data-active="true"])');
    const navActive = nav.querySelectorAll('a.nav-link[data-active="true"]');

    // ── Mobile toggle ──
    if (burger && mobMenu) {
        burger.addEventListener('click', function (e) {
            e.stopPropagation();
            mobMenu.classList.toggle('hidden');
        });
        document.addEventListener('click', function (e) {
            if (!nav.contains(e.target)) mobMenu.classList.add('hidden');
        });
    }

    // ── Non-home: kunci putih ──
    if (!isHome) {
        nav.style.cssText = 'background:#ffffff !important; border-bottom:1px solid #f1f5f9;';
        return;
    }

    // ── Home: scroll effect ──
    function applyScroll(scrolled) {
        if (scrolled) {
            nav.style.cssText = 'background:#ffffff !important; border-bottom:1px solid #f1f5f9;';
            if (nama)   nama.style.color = '#0d7377';
            if (sub)    sub.style.color  = '#6b7280';
            if (burger) burger.style.color = '#374151';
            navBtns.forEach(b => b.style.color = '#4b5563');
            navLinks.forEach(a => a.style.color = '#4b5563');
            navActive.forEach(a => a.style.color = '#0d7377');
        } else {
            nav.style.cssText = 'background:transparent !important; border-bottom:none;';
            if (nama)   nama.style.color = '#ffffff';
            if (sub)    sub.style.color  = 'rgba(255,255,255,0.7)';
            if (burger) burger.style.color = '#ffffff';
            navBtns.forEach(b => b.style.color = '#ffffff');
            navLinks.forEach(a => a.style.color = '#ffffff');
            navActive.forEach(a => a.style.color = '#ffffff');
        }
    }

    applyScroll(window.scrollY > 60);
    window.addEventListener('scroll', () => applyScroll(window.scrollY > 60), { passive: true });
})();
</script>
@endpush
