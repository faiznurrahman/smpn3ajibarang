<aside class="w-full lg:w-72 flex-shrink-0 space-y-5">

    {{-- Navigasi Tentang Kami --}}
    <div class="bg-[#0d7377] rounded-2xl p-5 text-white">
        <div class="text-[10px] font-semibold tracking-widest uppercase text-[#14a5ab] mb-4">Tentang Kami</div>
        <nav class="space-y-0.5">
            @php
                $navItems = [
                    ['route' => 'about.sejarah',              'label' => 'Sejarah Sekolah'],
                    ['route' => 'about.visi-misi',            'label' => 'Visi & Misi'],
                    ['route' => 'about.struktur-organisasi',  'label' => 'Struktur Organisasi'],
                    ['route' => 'about.pengajar',             'label' => 'Data Pengajar'],
                    ['route' => 'about.ekstrakurikuler',      'label' => 'Ekstrakurikuler'],
                ];
            @endphp
            @foreach($navItems as $nav)
            <a href="{{ route($nav['route']) }}"
               class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition
                      {{ request()->routeIs($nav['route'])
                         ? 'bg-white text-[#0d7377] font-semibold'
                         : 'text-white/80 hover:bg-white/10' }}">
                {{ $nav['label'] }}
            </a>
            @endforeach
        </nav>
    </div>

    {{-- Berita Terbaru --}}
    @if($sidebarBerita->count())
    <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-4">
            <div class="font-semibold text-gray-800 text-sm">Berita Terbaru</div>
            <a href="{{ route('information', ['type' => 'berita']) }}"
               class="text-xs text-[#0d7377] hover:underline font-medium">Semua →</a>
        </div>
        <div class="space-y-4">
            @foreach($sidebarBerita as $item)
            <a href="{{ route('information.detail', $item->slug) }}"
               class="flex gap-3 group">
                @if(!empty($item->thumbnail))
                    <img src="{{ Storage::url($item->thumbnail) }}"
                         class="w-14 h-11 rounded-lg object-cover flex-shrink-0 group-hover:opacity-80 transition"/>
                @else
                    <div class="w-14 h-11 rounded-lg bg-[#e6f4f4] flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-newspaper text-[#0d7377] text-xs"></i>
                    </div>
                @endif
                <div>
                    <div class="text-xs font-medium text-gray-700 group-hover:text-[#0d7377] leading-snug line-clamp-2">
                        {{ $item->judul }}
                    </div>
                    <div class="text-[10px] text-gray-400 mt-1">
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
    <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-4">
            <div class="font-semibold text-gray-800 text-sm">Pengumuman</div>
            <a href="{{ route('information', ['type' => 'pengumuman']) }}"
               class="text-xs text-[#0d7377] hover:underline font-medium">Semua →</a>
        </div>
        <div class="space-y-3">
            @foreach($sidebarPengumuman as $item)
            <a href="{{ route('information.detail', $item->slug) }}"
               class="flex gap-2.5 items-start group">
                <div class="w-6 h-6 bg-[#e6f4f4] rounded-md flex items-center justify-center flex-shrink-0 mt-0.5">
                    <i class="fas {{ $item->is_pinned ? 'fa-thumbtack' : 'fa-bullhorn' }} text-[#0d7377] text-[9px]"></i>
                </div>
                <div>
                    <div class="text-xs font-medium text-gray-700 group-hover:text-[#0d7377] leading-snug line-clamp-2">
                        {{ $item->judul }}
                    </div>
                    <div class="text-[10px] text-gray-400 mt-0.5">
                        {{ \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d M Y') }}
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</aside>
