<aside class="w-full lg:w-80 flex-shrink-0 space-y-6">

    {{-- Navigasi Cepat --}}
    <div class="bg-blue-900 rounded-2xl p-5 text-white">
        <div class="text-xs font-bold tracking-widest uppercase text-blue-300 mb-4">Tentang Kami</div>
        <nav class="space-y-1">
            @php
                $navItems = [
                    ['route' => 'about.sejarah',              'label' => 'Sejarah Sekolah',       'icon' => 'fa-landmark'],
                    ['route' => 'about.visi-misi',            'label' => 'Visi & Misi',           'icon' => 'fa-bullseye'],
                    ['route' => 'about.struktur-organisasi',  'label' => 'Struktur Organisasi',   'icon' => 'fa-sitemap'],
                    ['route' => 'about.pengajar',             'label' => 'Data Pengajar',         'icon' => 'fa-chalkboard-teacher'],
                    ['route' => 'about.ekstrakurikuler',      'label' => 'Ekstrakurikuler',       'icon' => 'fa-star'],
                ];
            @endphp
            @foreach($navItems as $nav)
            <a href="{{ route($nav['route']) }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs($nav['route'])
                         ? 'bg-white text-blue-900 font-bold'
                         : 'text-blue-100 hover:bg-white/10' }}">
                <i class="fas {{ $nav['icon'] }} w-4 text-center
                           {{ request()->routeIs($nav['route']) ? 'text-blue-600' : 'text-blue-300' }}"></i>
                {{ $nav['label'] }}
            </a>
            @endforeach
        </nav>
    </div>

    {{-- Berita Terbaru --}}
    @if($sidebarBerita->count())
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
        <div class="flex items-center justify-between mb-4">
            <div class="font-bold text-blue-900 text-sm flex items-center gap-2">
                <i class="fas fa-newspaper text-blue-500"></i> Berita Terbaru
            </div>
            <a href="{{ route('information', ['type' => 'berita']) }}"
               class="text-xs text-blue-600 hover:underline font-semibold">Semua →</a>
        </div>
        <div class="space-y-3">
            @foreach($sidebarBerita as $item)
            <a href="{{ route('information.detail', $item->slug) }}"
               class="flex gap-3 group">
                @if(!empty($item->thumbnail))
                    <img src="{{ Storage::url($item->thumbnail) }}"
                         class="w-16 h-12 rounded-lg object-cover flex-shrink-0"/>
                @else
                    <div class="w-16 h-12 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-newspaper text-blue-300 text-xs"></i>
                    </div>
                @endif
                <div>
                    <div class="text-xs font-semibold text-gray-800 group-hover:text-blue-700 leading-tight line-clamp-2">
                        {{ $item->judul }}
                    </div>
                    <div class="text-xs text-gray-400 mt-1">
                        {{ \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d M Y') }}
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Pengumuman Terbaru --}}
    @if($sidebarPengumuman->count())
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
        <div class="flex items-center justify-between mb-4">
            <div class="font-bold text-blue-900 text-sm flex items-center gap-2">
                <i class="fas fa-bullhorn text-yellow-500"></i> Pengumuman
            </div>
            <a href="{{ route('information', ['type' => 'pengumuman']) }}"
               class="text-xs text-blue-600 hover:underline font-semibold">Semua →</a>
        </div>
        <div class="space-y-2">
            @foreach($sidebarPengumuman as $item)
            <a href="{{ route('information.detail', $item->slug) }}"
               class="flex gap-2 items-start group p-2 rounded-lg hover:bg-yellow-50 transition">
                <div class="w-7 h-7 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                    @if($item->is_pinned)
                        <i class="fas fa-thumbtack text-yellow-600 text-xs"></i>
                    @else
                        <i class="fas fa-bullhorn text-yellow-600 text-xs"></i>
                    @endif
                </div>
                <div>
                    <div class="text-xs font-semibold text-gray-800 group-hover:text-blue-700 leading-tight line-clamp-2">
                        {{ $item->judul }}
                    </div>
                    <div class="text-xs text-gray-400 mt-0.5">
                        {{ \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d M Y') }}
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</aside>