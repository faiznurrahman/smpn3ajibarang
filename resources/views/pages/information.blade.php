@extends('layouts.app')

@section('content')

{{-- ===================== HEADER ===================== --}}
<div class="pt-28 pb-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <div class="text-xs text-gray-400 mb-2 flex items-center justify-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-gray-600 transition">Beranda</a>
            <i class="fas fa-chevron-right text-[9px] text-gray-300"></i>
            <span class="text-gray-500">
                {{ $type === 'berita' ? 'Berita' : ($type === 'pengumuman' ? 'Pengumuman' : 'Prestasi') }}
            </span>
        </div>
        <h1 class="text-2xl font-black text-gray-900">
            {{ $type === 'berita' ? 'Berita' : ($type === 'pengumuman' ? 'Pengumuman' : 'Prestasi') }}
        </h1>
        <p class="text-sm text-gray-400 mt-1">
            {{ $type === 'berita' ? 'Informasi dan kegiatan terkini sekolah' : ($type === 'pengumuman' ? 'Pengumuman resmi dari sekolah' : 'Prestasi dan pencapaian siswa') }}
        </p>
    </div>
</div>

{{-- ===================== KONTEN ===================== --}}
<div class="bg-gray-50 pb-16">
    <div class="max-w-7xl mx-auto px-4 pt-10">

        {{-- Tab Filter --}}
        <div class="flex gap-2 mb-6 flex-wrap">
            @foreach([
                'berita'     => ['label' => 'Berita',     'icon' => 'fa-newspaper'],
                'pengumuman' => ['label' => 'Pengumuman', 'icon' => 'fa-bullhorn'],
                'prestasi'   => ['label' => 'Prestasi',   'icon' => 'fa-trophy'],
            ] as $key => $item)
                <a href="{{ route('information', ['type' => $key]) }}"
                   class="flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold transition
                          {{ $type === $key
                              ? 'bg-blue-900 text-white shadow-lg shadow-blue-900/20'
                              : 'bg-white text-gray-600 border border-gray-200 hover:border-blue-300 hover:text-blue-700' }}">
                    <i class="fas {{ $item['icon'] }} text-xs"></i>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>

        {{-- Search Bar --}}
        <form method="GET" action="{{ route('information') }}" class="mb-8">
            <input type="hidden" name="type" value="{{ $type }}">
            <div class="relative max-w-md">
                <input type="text"
                       name="search"
                       value="{{ $search ?? '' }}"
                       placeholder="Cari {{ $type === 'berita' ? 'berita' : ($type === 'pengumuman' ? 'pengumuman' : 'prestasi') }}..."
                       class="w-full pl-10 pr-10 py-2.5 rounded-xl border border-gray-200 bg-white text-sm text-gray-700
                              focus:outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition"/>
                <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                @if(!empty($search))
                    <a href="{{ route('information', ['type' => $type]) }}"
                       class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition">
                        <i class="fas fa-times text-xs"></i>
                    </a>
                @endif
            </div>
            @if(!empty($search))
                <p class="text-xs text-gray-500 mt-2">
                    Hasil pencarian untuk <span class="font-semibold text-blue-700">"{{ $search }}"</span>
                    — {{ $posts->total() }} ditemukan
                </p>
            @endif
        </form>

        @if($posts->count())

            {{-- ── Layout Pengumuman ── --}}
            @if($type === 'pengumuman')
                @php
                    $now     = now();
                    $pinned  = $posts->filter(fn($p) => $p->is_pinned);
                    $active  = $posts->filter(fn($p) => !$p->is_pinned && (!$p->end_date || $now->lte($p->end_date)));
                    $expired = $posts->filter(fn($p) => !$p->is_pinned && $p->end_date && $now->gt($p->end_date));
                @endphp

                {{-- Pinned --}}
                @if($pinned->count())
                <div class="mb-8">
                    <div class="flex items-center gap-2 mb-4">
                        <i class="fas fa-thumbtack text-yellow-500"></i>
                        <h3 class="font-bold text-gray-700 text-sm uppercase tracking-wide">Disematkan</h3>
                    </div>
                    <div class="space-y-3">
                        @foreach($pinned as $post)
                        <a href="{{ route('information.detail', $post->slug) }}"
                           class="flex items-start gap-4 bg-yellow-50 border border-yellow-200 rounded-2xl p-5 hover:shadow-md transition group">
                            <div class="w-10 h-10 bg-yellow-400 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-thumbtack text-white text-sm"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-blue-900 text-sm group-hover:text-blue-700 transition line-clamp-1">
                                    {{ $post->judul }}
                                </h4>
                                <div class="flex items-center gap-4 mt-1.5 text-xs text-gray-500 flex-wrap">
                                    <span><i class="fas fa-calendar-alt mr-1"></i>{{ \Carbon\Carbon::parse($post->tanggal_publish)->translatedFormat('d F Y') }}</span>
                                    @if($post->end_date)
                                    <span class="text-red-500 font-medium">
                                        <i class="fas fa-clock mr-1"></i>Sampai {{ \Carbon\Carbon::parse($post->end_date)->translatedFormat('d F Y') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-gray-300 group-hover:text-blue-400 transition mt-1 flex-shrink-0"></i>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Aktif --}}
                @if($active->count())
                <div class="mb-8">
                    <div class="flex items-center gap-2 mb-4">
                        <i class="fas fa-bullhorn text-blue-500"></i>
                        <h3 class="font-bold text-gray-700 text-sm uppercase tracking-wide">Pengumuman Aktif</h3>
                    </div>
                    <div class="space-y-3">
                        @foreach($active as $post)
                        <a href="{{ route('information.detail', $post->slug) }}"
                           class="flex items-start gap-4 bg-white border border-gray-100 rounded-2xl p-5 hover:shadow-md hover:border-blue-200 transition group">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-bullhorn text-blue-500 text-sm"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-blue-900 text-sm group-hover:text-blue-700 transition line-clamp-1">
                                    {{ $post->judul }}
                                </h4>
                                <div class="flex items-center gap-4 mt-1.5 text-xs text-gray-500 flex-wrap">
                                    <span><i class="fas fa-calendar-alt mr-1"></i>{{ \Carbon\Carbon::parse($post->tanggal_publish)->translatedFormat('d F Y') }}</span>
                                    @if($post->end_date)
                                    <span class="text-orange-500 font-medium">
                                        <i class="fas fa-clock mr-1"></i>Sampai {{ \Carbon\Carbon::parse($post->end_date)->translatedFormat('d F Y') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-gray-300 group-hover:text-blue-400 transition mt-1 flex-shrink-0"></i>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Kadaluarsa --}}
                @if($expired->count())
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <i class="fas fa-archive text-gray-400"></i>
                        <h3 class="font-bold text-gray-400 text-sm uppercase tracking-wide">Sudah Berakhir</h3>
                    </div>
                    <div class="space-y-3">
                        @foreach($expired as $post)
                        <a href="{{ route('information.detail', $post->slug) }}"
                           class="flex items-start gap-4 bg-gray-50 border border-gray-100 rounded-2xl p-5 hover:shadow-sm transition group opacity-70">
                            <div class="w-10 h-10 bg-gray-200 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-archive text-gray-400 text-sm"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-600 text-sm line-clamp-1">{{ $post->judul }}</h4>
                                <div class="flex items-center gap-4 mt-1.5 text-xs text-gray-400 flex-wrap">
                                    <span><i class="fas fa-calendar-alt mr-1"></i>{{ \Carbon\Carbon::parse($post->tanggal_publish)->translatedFormat('d F Y') }}</span>
                                    <span><i class="fas fa-clock mr-1"></i>Berakhir {{ \Carbon\Carbon::parse($post->end_date)->translatedFormat('d F Y') }}</span>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-gray-200 mt-1 flex-shrink-0"></i>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

            {{-- ── Layout Berita & Prestasi ── --}}
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($posts as $post)
                    <a href="{{ route('information.detail', $post->slug) }}"
                       class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-blue-200 transition overflow-hidden group flex flex-col">
                        @if(!empty($post->thumbnail))
                            <div class="overflow-hidden h-44">
                                <img src="{{ Storage::url($post->thumbnail) }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                     alt="{{ $post->judul }}"/>
                            </div>
                        @else
                            <div class="h-44 bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center">
                                <i class="fas {{ $type === 'prestasi' ? 'fa-trophy text-yellow-300' : 'fa-newspaper text-blue-200' }} text-4xl"></i>
                            </div>
                        @endif
                        <div class="p-5 flex flex-col flex-1">
                            {{-- Badge type --}}
                            <div class="mb-2">
                                <span class="text-xs font-bold px-2.5 py-1 rounded-full
                                    {{ $type === 'prestasi' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ $type === 'berita' ? 'Berita' : 'Prestasi' }}
                                </span>
                            </div>
                            <h3 class="font-bold text-blue-900 text-sm leading-snug line-clamp-2 mb-2 group-hover:text-blue-700 transition">
                                {{ $post->judul }}
                            </h3>
                            @if(!empty($post->isi_konten))
                            <p class="text-xs text-gray-500 line-clamp-2 mb-3 leading-relaxed">
                                {{ Str::limit(strip_tags($post->isi_konten), 100) }}
                            </p>
                            @endif
                            <div class="text-xs text-gray-400 flex items-center gap-2 mt-auto">
                                <i class="fas fa-calendar-alt"></i>
                                {{ $post->tanggal_publish
                                    ? \Carbon\Carbon::parse($post->tanggal_publish)->translatedFormat('d F Y')
                                    : $post->created_at->translatedFormat('d F Y') }}
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-10">
                    {{ $posts->appends(['type' => $type, 'search' => $search])->links() }}
                </div>
            @endif

        @else
            {{-- Empty state --}}
            <div class="text-center py-24 text-gray-400">
                <i class="fas fa-inbox text-5xl mb-4 block"></i>
                @if(!empty($search))
                    <p class="text-sm font-medium text-gray-500">Tidak ada hasil untuk "<span class="text-blue-600">{{ $search }}</span>"</p>
                    <a href="{{ route('information', ['type' => $type]) }}"
                       class="mt-4 inline-block text-sm text-blue-600 hover:underline">Hapus pencarian</a>
                @else
                    <p class="text-sm">Belum ada {{ $type }} yang dipublikasikan.</p>
                @endif
            </div>
        @endif

    </div>
</div>

@endsection