{{--
    Navbar SMPN 3 Ajibarang
    Data dari: $settings (nama_sekolah, logo), $socialMedia (collection)
    Transparent di top, solid navy setelah scroll
--}}

<nav id="navbar" class="fixed top-0 w-full z-50 {{ request()->routeIs('home') ? 'bg-transparent' : 'bg-[#0d2b6b] shadow-lg' }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 flex items-center justify-between">

        {{-- ── Logo & Nama Sekolah ── --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 flex-shrink-0">
            @if(!empty($settings->logo))
                <img src="{{ Storage::url($settings->logo) }}"
                     class="w-16 h-16 object-contain" alt="Logo {{ $settings->nama_sekolah ?? 'SMPN 3 Ajibarang' }}"/>
            @else
                <div class="w-10 h-10 rounded-full bg-yellow-400 flex items-center justify-center font-black text-blue-900 text-xs">S3</div>
            @endif
            <div class="leading-tight">
                <div class="text-white font-bold text-sm tracking-wide">
                    {{ strtoupper($settings->nama_sekolah ?? 'SMPN 3 AJIBARANG') }}
                </div>
                <div class="text-yellow-300 text-xs font-medium">Sekolah Adiwiyata</div>
            </div>
        </a>

        {{-- ── Desktop Navigation ── --}}
        <ul class="hidden md:flex items-center gap-7 text-white text-sm font-semibold">

            {{-- Beranda --}}
            <li>
                <a href="{{ route('home') }}"
                   class="nav-link hover:text-yellow-300 transition {{ request()->routeIs('home') ? 'active text-yellow-300' : '' }}">
                    Beranda
                </a>
            </li>

            {{-- Dropdown Tentang Kami --}}
            <li class="relative group">
                <button class="nav-link hover:text-yellow-300 transition flex items-center gap-1
                               {{ request()->routeIs('about.*') ? 'active text-yellow-300' : '' }}">
                    Tentang Kami <i class="fas fa-chevron-down text-[10px] mt-0.5"></i>
                </button>
                <ul class="absolute top-full left-1/2 -translate-x-1/2 mt-3 bg-white shadow-2xl rounded-2xl py-2 w-52
                           text-gray-700 text-sm font-medium
                           opacity-0 invisible group-hover:opacity-100 group-hover:visible
                           translate-y-2 group-hover:translate-y-0 transition-all duration-200">
                    <li>
                        <a href="{{ route('about.sejarah') }}"
                           class="flex items-center gap-2 px-4 py-2.5 hover:bg-blue-50 hover:text-blue-700 transition rounded-xl mx-1
                                  {{ request()->routeIs('about.sejarah') ? 'bg-blue-50 text-blue-700' : '' }}">
                            <i class="fas fa-landmark text-blue-400 text-xs w-4"></i> Sejarah Sekolah
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about.visi-misi') }}"
                           class="flex items-center gap-2 px-4 py-2.5 hover:bg-blue-50 hover:text-blue-700 transition rounded-xl mx-1
                                  {{ request()->routeIs('about.visi-misi') ? 'bg-blue-50 text-blue-700' : '' }}">
                            <i class="fas fa-bullseye text-green-500 text-xs w-4"></i> Visi & Misi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about.struktur-organisasi') }}"
                           class="flex items-center gap-2 px-4 py-2.5 hover:bg-blue-50 hover:text-blue-700 transition rounded-xl mx-1
                                  {{ request()->routeIs('about.struktur-organisasi') ? 'bg-blue-50 text-blue-700' : '' }}">
                            <i class="fas fa-sitemap text-purple-400 text-xs w-4"></i> Struktur Organisasi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about.pengajar') }}"
                           class="flex items-center gap-2 px-4 py-2.5 hover:bg-blue-50 hover:text-blue-700 transition rounded-xl mx-1
                                  {{ request()->routeIs('about.pengajar') ? 'bg-blue-50 text-blue-700' : '' }}">
                            <i class="fas fa-chalkboard-teacher text-yellow-500 text-xs w-4"></i> Data Pengajar
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about.ekstrakurikuler') }}"
                           class="flex items-center gap-2 px-4 py-2.5 hover:bg-blue-50 hover:text-blue-700 transition rounded-xl mx-1
                                  {{ request()->routeIs('about.ekstrakurikuler') ? 'bg-blue-50 text-blue-700' : '' }}">
                            <i class="fas fa-running text-red-400 text-xs w-4"></i> Ekstrakurikuler
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Dropdown Informasi --}}
            <li class="relative group">
                <button class="nav-link hover:text-yellow-300 transition flex items-center gap-1
                               {{ request()->routeIs('information*') ? 'active text-yellow-300' : '' }}">
                    Informasi <i class="fas fa-chevron-down text-[10px] mt-0.5"></i>
                </button>
                <ul class="absolute top-full left-1/2 -translate-x-1/2 mt-3 bg-white shadow-2xl rounded-2xl py-2 w-44
                           text-gray-700 text-sm font-medium
                           opacity-0 invisible group-hover:opacity-100 group-hover:visible
                           translate-y-2 group-hover:translate-y-0 transition-all duration-200">
                    <li>
                        <a href="{{ route('information', ['type' => 'berita']) }}"
                           class="flex items-center gap-2 px-4 py-2.5 hover:bg-blue-50 hover:text-blue-700 transition rounded-xl mx-1">
                            <i class="fas fa-newspaper text-blue-400 text-xs w-4"></i> Berita
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('information', ['type' => 'pengumuman']) }}"
                           class="flex items-center gap-2 px-4 py-2.5 hover:bg-blue-50 hover:text-blue-700 transition rounded-xl mx-1">
                            <i class="fas fa-bullhorn text-yellow-500 text-xs w-4"></i> Pengumuman
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('information', ['type' => 'prestasi']) }}"
                           class="flex items-center gap-2 px-4 py-2.5 hover:bg-blue-50 hover:text-blue-700 transition rounded-xl mx-1">
                            <i class="fas fa-trophy text-yellow-400 text-xs w-4"></i> Prestasi
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Galeri --}}
            <li>
                <a href="{{ route('gallery') }}"
                   class="nav-link hover:text-yellow-300 transition {{ request()->routeIs('gallery') ? 'active text-yellow-300' : '' }}">
                    Galeri
                </a>
            </li>

            {{-- Kontak --}}
            <li>
                <a href="{{ route('contact') }}"
                   class="nav-link hover:text-yellow-300 transition {{ request()->routeIs('contact') ? 'active text-yellow-300' : '' }}">
                    Kontak
                </a>
            </li>

        </ul>

        {{-- ── Mobile Hamburger ── --}}
        <button id="mob-btn"
                class="md:hidden text-white text-xl w-10 h-10 flex items-center justify-center rounded-xl hover:bg-white/10 transition"
                aria-label="Buka menu">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    {{-- ── Mobile Menu ── --}}
    <div id="mob-menu" class="hidden md:hidden bg-[#0d2b6b] border-t border-white/10 px-4 pb-4 pt-2">

        {{-- Beranda --}}
        <a href="{{ route('home') }}"
           class="flex items-center py-3 border-b border-white/10 text-sm font-medium
                  {{ request()->routeIs('home') ? 'text-yellow-300' : 'text-white' }}
                  hover:text-yellow-300 transition">
            Beranda
        </a>

        {{-- Tentang Kami sub-links --}}
        <div class="border-b border-white/10 py-3 space-y-1">
            <div class="text-xs text-blue-300 font-semibold uppercase tracking-widest mb-2">Tentang Kami</div>
            <a href="{{ route('about.sejarah') }}"
               class="flex items-center gap-2 text-sm hover:text-yellow-300 transition py-1 pl-2
                      {{ request()->routeIs('about.sejarah') ? 'text-yellow-300' : 'text-white' }}">
                <i class="fas fa-landmark text-blue-300 text-xs"></i> Sejarah Sekolah
            </a>
            <a href="{{ route('about.visi-misi') }}"
               class="flex items-center gap-2 text-sm hover:text-yellow-300 transition py-1 pl-2
                      {{ request()->routeIs('about.visi-misi') ? 'text-yellow-300' : 'text-white' }}">
                <i class="fas fa-bullseye text-green-400 text-xs"></i> Visi & Misi
            </a>
            <a href="{{ route('about.struktur-organisasi') }}"
               class="flex items-center gap-2 text-sm hover:text-yellow-300 transition py-1 pl-2
                      {{ request()->routeIs('about.struktur-organisasi') ? 'text-yellow-300' : 'text-white' }}">
                <i class="fas fa-sitemap text-purple-300 text-xs"></i> Struktur Organisasi
            </a>
            <a href="{{ route('about.pengajar') }}"
               class="flex items-center gap-2 text-sm hover:text-yellow-300 transition py-1 pl-2
                      {{ request()->routeIs('about.pengajar') ? 'text-yellow-300' : 'text-white' }}">
                <i class="fas fa-chalkboard-teacher text-yellow-400 text-xs"></i> Data Pengajar
            </a>
            <a href="{{ route('about.ekstrakurikuler') }}"
               class="flex items-center gap-2 text-sm hover:text-yellow-300 transition py-1 pl-2
                      {{ request()->routeIs('about.ekstrakurikuler') ? 'text-yellow-300' : 'text-white' }}">
                <i class="fas fa-running text-red-400 text-xs"></i> Ekstrakurikuler
            </a>
        </div>

        {{-- Informasi sub-links --}}
        <div class="border-b border-white/10 py-3 space-y-1">
            <div class="text-xs text-blue-300 font-semibold uppercase tracking-widest mb-2">Informasi</div>
            <a href="{{ route('information', ['type' => 'berita']) }}"
               class="flex items-center gap-2 text-sm text-white hover:text-yellow-300 transition py-1 pl-2">
                <i class="fas fa-newspaper text-blue-300 text-xs"></i> Berita
            </a>
            <a href="{{ route('information', ['type' => 'pengumuman']) }}"
               class="flex items-center gap-2 text-sm text-white hover:text-yellow-300 transition py-1 pl-2">
                <i class="fas fa-bullhorn text-yellow-400 text-xs"></i> Pengumuman
            </a>
            <a href="{{ route('information', ['type' => 'prestasi']) }}"
               class="flex items-center gap-2 text-sm text-white hover:text-yellow-300 transition py-1 pl-2">
                <i class="fas fa-trophy text-yellow-400 text-xs"></i> Prestasi
            </a>
        </div>

        {{-- Galeri --}}
        <a href="{{ route('gallery') }}"
           class="flex items-center py-3 border-b border-white/10 text-sm font-medium
                  {{ request()->routeIs('gallery') ? 'text-yellow-300' : 'text-white' }}
                  hover:text-yellow-300 transition">
            Galeri
        </a>

        {{-- Kontak --}}
        <a href="{{ route('contact') }}"
           class="flex items-center py-3 text-sm font-medium
                  {{ request()->routeIs('contact') ? 'text-yellow-300' : 'text-white' }}
                  hover:text-yellow-300 transition">
            Kontak
        </a>

    </div>
</nav>