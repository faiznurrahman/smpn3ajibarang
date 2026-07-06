@extends('layouts.app')

@section('content')

    {{-- Breadcrumb --}}
    <div class="pt-28 pb-2 px-4 max-w-4xl mx-auto">
        <div class="text-xs text-gray-400 mb-3 flex items-center gap-2 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-[#0d7377] transition">Beranda</a>
            <i class="fas fa-chevron-right text-[9px] text-gray-300"></i>
            <a href="{{ route('information', ['type' => $post->type]) }}" class="hover:text-[#0d7377] transition">
                {{ $post->type === 'berita' ? 'Berita' : ($post->type === 'pengumuman' ? 'Pengumuman' : 'Prestasi') }}
            </a>
            <i class="fas fa-chevron-right text-[9px] text-gray-300"></i>
            <span class="text-gray-600">{{ Str::limit($post->judul, 60) }}</span>
        </div>
    </div>

    <div class="pb-16 bg-[#f9fafb]">
        <div class="max-w-4xl mx-auto px-4">

            {{-- Back --}}
            <div class="mb-4">
                <a href="{{ route('information', ['type' => $post->type]) }}"
                   class="inline-flex items-center gap-1.5 text-xs font-medium text-gray-400 hover:text-[#0d7377] transition">
                    <i class="fas fa-arrow-left text-[10px]"></i>
                    Kembali ke {{ $post->type === 'berita' ? 'Berita' : ($post->type === 'pengumuman' ? 'Pengumuman' : 'Prestasi') }}
                </a>
            </div>

            {{-- ── ARTIKEL ── --}}
            <div class="bg-white rounded-xl border border-gray-100 overflow-hidden mb-10">

                {{-- Thumbnail --}}
                @if(!empty($post->thumbnail))
                <img src="{{ Storage::url($post->thumbnail) }}"
                     alt="{{ $post->judul }}"
                     loading="lazy"
                     class="w-full max-h-[420px] object-cover"/>
                @endif

                <div class="p-6 md:p-10">

                    {{-- Badge --}}
                    <div class="flex items-center gap-2 mb-4 flex-wrap">
                        <span class="text-[11px] font-medium px-3 py-1 rounded-full
                            {{ $post->type === 'berita'
                                ? 'bg-[#e6f4f4] text-[#0d7377]'
                                : ($post->type === 'pengumuman'
                                    ? 'bg-amber-50 text-amber-600'
                                    : 'bg-emerald-50 text-emerald-600') }}">
                            {{ ucfirst($post->type) }}
                        </span>
                        @if($post->is_pinned)
                        <span class="text-[11px] font-medium px-3 py-1 rounded-full bg-rose-50 text-rose-500">
                            <i class="fas fa-thumbtack mr-1 text-[9px]"></i> Disematkan
                        </span>
                        @endif
                    </div>

                    {{-- Judul --}}
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 leading-snug mb-4">
                        {{ $post->judul }}
                    </h1>

                    {{-- Meta --}}
                    <div class="flex items-center gap-5 text-xs text-gray-400 pb-6 border-b border-gray-100 flex-wrap">
                        <span class="flex items-center gap-1.5">
                            <i class="fas fa-calendar-alt"></i>
                            {{ $post->tanggal_publish
                                ? \Carbon\Carbon::parse($post->tanggal_publish)->translatedFormat('d F Y')
                                : $post->created_at->translatedFormat('d F Y') }}
                        </span>
                        @if($post->end_date)
                        <span class="flex items-center gap-1.5 text-rose-400">
                            <i class="fas fa-clock"></i>
                            Sampai {{ \Carbon\Carbon::parse($post->end_date)->translatedFormat('d F Y') }}
                        </span>
                        @endif
                    </div>

                    {{-- Isi --}}
                    <div class="prose prose-sm max-w-none mt-6 text-gray-700 leading-relaxed
                                [&_a]:text-[#0d7377] [&_a]:no-underline [&_a:hover]:underline
                                [&_h2]:text-gray-900 [&_h3]:text-gray-800
                                [&_blockquote]:border-l-[3px] [&_blockquote]:border-[#0d7377] [&_blockquote]:pl-4 [&_blockquote]:italic [&_blockquote]:text-gray-600">
                        {!! $post->isi_konten !!}
                    </div>

                </div>
            </div>

            {{-- ── ARTIKEL LAINNYA ── --}}
            <div class="border-t border-gray-200 pt-10">
                <h3 class="font-semibold text-gray-800 text-sm uppercase tracking-widest mb-6 flex items-center gap-2">
                    <span class="w-1 h-4 bg-[#0d7377] rounded-full"></span>
                    Artikel Lainnya
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    {{-- BERITA --}}
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-1 h-3.5 bg-[#0d7377] rounded-full"></span>
                            <h4 class="font-semibold text-gray-700 text-xs uppercase tracking-wider">Berita</h4>
                            <a href="{{ route('information', ['type' => 'berita']) }}"
                               class="ml-auto text-[11px] text-[#0d7377] hover:underline">Semua →</a>
                        </div>
                        @php
                            $sideBerita = \App\Models\Post::where('status', 'published')
                                ->where('type', 'berita')
                                ->where('id', '!=', $post->id)
                                ->latest('tanggal_publish')
                                ->take(4)->get();
                        @endphp
                        <div class="space-y-2.5">
                            @forelse($sideBerita as $item)
                            <a href="{{ route('information.detail', $item->slug) }}"
                               class="flex gap-3 group bg-white rounded-lg p-3 border border-gray-100 hover:border-[#0d7377]/30 transition">
                                @if(!empty($item->thumbnail))
                                    <img src="{{ Storage::url($item->thumbnail) }}"
                                         class="w-12 h-10 rounded-lg object-cover flex-shrink-0 group-hover:opacity-80 transition"
                                         loading="lazy"/>
                                @else
                                    <div class="w-12 h-10 rounded-lg bg-[#e6f4f4] flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-newspaper text-[#0d7377]/40 text-xs"></i>
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <div class="text-xs font-medium text-gray-700 group-hover:text-[#0d7377] line-clamp-2 leading-snug">
                                        {{ $item->judul }}
                                    </div>
                                    <div class="text-[10px] text-gray-400 mt-1">
                                        {{ $item->tanggal_publish
                                            ? \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d M Y')
                                            : $item->created_at->translatedFormat('d M Y') }}
                                    </div>
                                </div>
                            </a>
                            @empty
                            <p class="text-xs text-gray-400 italic">Belum ada berita lain.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- PENGUMUMAN --}}
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-1 h-3.5 bg-amber-400 rounded-full"></span>
                            <h4 class="font-semibold text-gray-700 text-xs uppercase tracking-wider">Pengumuman</h4>
                            <a href="{{ route('information', ['type' => 'pengumuman']) }}"
                               class="ml-auto text-[11px] text-[#0d7377] hover:underline">Semua →</a>
                        </div>
                        @php
                            $sidePengumuman = \App\Models\Post::where('type', 'pengumuman')
                                ->where('status', 'published')
                                ->where('id', '!=', $post->id)
                                ->orderBy('is_pinned', 'desc')
                                ->latest('tanggal_publish')
                                ->take(4)->get();
                        @endphp
                        <div class="space-y-2.5">
                            @forelse($sidePengumuman as $item)
                            <a href="{{ route('information.detail', $item->slug) }}"
                               class="flex gap-3 items-start group bg-white rounded-lg p-3 border border-gray-100 hover:border-amber-200 transition">
                                <div class="w-7 h-7 bg-amber-50 rounded-md flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="fas {{ $item->is_pinned ? 'fa-thumbtack' : 'fa-bullhorn' }} text-amber-400 text-[10px]"></i>
                                </div>
                                <div class="min-w-0">
                                    <div class="text-xs font-medium text-gray-700 group-hover:text-[#0d7377] line-clamp-2 leading-snug">
                                        {{ $item->judul }}
                                    </div>
                                    <div class="text-[10px] text-gray-400 mt-1">
                                        {{ $item->tanggal_publish
                                            ? \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d M Y')
                                            : $item->created_at->translatedFormat('d M Y') }}
                                    </div>
                                </div>
                            </a>
                            @empty
                            <p class="text-xs text-gray-400 italic">Belum ada pengumuman lain.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- PRESTASI --}}
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-1 h-3.5 bg-emerald-500 rounded-full"></span>
                            <h4 class="font-semibold text-gray-700 text-xs uppercase tracking-wider">Prestasi</h4>
                            <a href="{{ route('information', ['type' => 'prestasi']) }}"
                               class="ml-auto text-[11px] text-[#0d7377] hover:underline">Semua →</a>
                        </div>
                        @php
                            $sidePrestasi = \App\Models\Post::where('type', 'prestasi')
                                ->where('status', 'published')
                                ->where('id', '!=', $post->id)
                                ->latest('tanggal_publish')
                                ->take(4)->get();
                        @endphp
                        <div class="space-y-2.5">
                            @forelse($sidePrestasi as $item)
                            <a href="{{ route('information.detail', $item->slug) }}"
                               class="flex gap-3 group bg-white rounded-lg p-3 border border-gray-100 hover:border-emerald-200 transition">
                                @if(!empty($item->thumbnail))
                                    <img src="{{ Storage::url($item->thumbnail) }}"
                                         class="w-12 h-10 rounded-lg object-cover flex-shrink-0 group-hover:opacity-80 transition"
                                         loading="lazy"/>
                                @else
                                    <div class="w-12 h-10 rounded-lg bg-emerald-50 flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-trophy text-emerald-200 text-xs"></i>
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <div class="text-xs font-medium text-gray-700 group-hover:text-[#0d7377] line-clamp-2 leading-snug">
                                        {{ $item->judul }}
                                    </div>
                                    <div class="text-[10px] text-gray-400 mt-1">
                                        {{ $item->tanggal_publish
                                            ? \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d M Y')
                                            : $item->created_at->translatedFormat('d M Y') }}
                                    </div>
                                </div>
                            </a>
                            @empty
                            <p class="text-xs text-gray-400 italic">Belum ada prestasi lain.</p>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection
