@extends('layouts.app')

@section('content')
{{-- ===================== HERO ===================== --}}
<section id="beranda"
    class="relative min-h-screen flex flex-col justify-center items-center text-center px-4 pt-20"
    style="background-image:
           linear-gradient(to bottom, rgba(5,15,35,0.55) 0%, rgba(5,15,35,0.25) 45%, rgba(5,15,35,0.70) 100%),
           url('{{ !empty($settings->background_hero) ? Storage::url($settings->background_hero) : 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=1400&q=80' }}');
           background-size: cover; background-position: center top;">

    <div class="anim-fade-up max-w-4xl mx-auto">

        {{-- Badge tagline --}}
        @if(!empty($settings->tagline))
        <div class="inline-flex items-center bg-[#0d7377]/80 backdrop-blur text-white text-xs font-medium px-5 py-2 rounded-full mb-7 tracking-wide uppercase">
            {{ $settings->tagline }}
        </div>
        @endif

        {{-- Judul --}}
        <h1 class="font-bold leading-tight drop-shadow-lg text-4xl sm:text-5xl md:text-6xl lg:text-7xl text-white">
            {{ $settings->judul_hero ?? 'SMPN 3 Ajibarang' }}
        </h1>

        {{-- Deskripsi --}}
        <p class="text-white/80 text-base md:text-lg max-w-lg mx-auto leading-relaxed mt-5">
            {{ $settings->deskripsi_hero ?? 'Berkomitmen mencetak generasi yang berkarakter, berprestasi, dan peduli lingkungan.' }}
        </p>

    </div>

    {{-- Stats row --}}
    <div class="mt-10 md:mt-16 w-full max-w-2xl px-4 anim-fade-up delay-2">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
            <div class="text-center bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl py-4 px-3">
                <div class="text-3xl font-bold text-white">{{ $jumlahSiswa > 0 ? $jumlahSiswa.'+' : '—' }}</div>
                <div class="text-[11px] text-white/60 mt-1.5 uppercase tracking-wide">Siswa Aktif</div>
            </div>
            <div class="text-center bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl py-4 px-3">
                <div class="text-3xl font-bold text-white">{{ $jumlahGuruKaryawan > 0 ? $jumlahGuruKaryawan.'+' : '—' }}</div>
                <div class="text-[11px] text-white/60 mt-1.5 uppercase tracking-wide">Pengajar</div>
            </div>
            <div class="text-center bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl py-4 px-3">
                <div class="text-3xl font-bold text-white">{{ $settings->jumlah_prestasi ? $settings->jumlah_prestasi.'+' : '120+' }}</div>
                <div class="text-[11px] text-white/60 mt-1.5 uppercase tracking-wide">Prestasi</div>
            </div>
            <div class="text-center bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl py-4 px-3">
                <div class="text-3xl font-bold text-white">{{ $settings->tahun_berdiri ? date('Y') - $settings->tahun_berdiri .'+' : '25+' }}</div>
                <div class="text-[11px] text-white/60 mt-1.5 uppercase tracking-wide">Tahun</div>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="mt-12 flex flex-col items-center gap-2 text-white/35">
        <i class="fas fa-chevron-down text-base animate-bounce"></i>
    </div>

</section>

{{-- ===================== SAMBUTAN KEPSEK ===================== --}}
<section id="sambutan" class="py-24 bg-white">
    <div class="max-w-5xl mx-auto px-6 md:px-10">
        <div class="flex flex-col lg:flex-row gap-14 items-center">

            {{-- Foto --}}
            <div class="flex-shrink-0 flex justify-center anim-fade-up opacity-0">
                @if(!empty($greeting->foto))
                    <img src="{{ Storage::url($greeting->foto) }}"
                         alt="Kepala Sekolah"
                         loading="lazy"
                         class="w-56 h-64 md:w-64 md:h-72 object-cover rounded-2xl shadow-md"/>
                @else
                    <div class="w-56 h-64 md:w-64 md:h-72 rounded-2xl shadow-md bg-[#e6f4f4] flex items-center justify-center">
                        <i class="fas fa-user text-[#0d7377]/30 text-5xl"></i>
                    </div>
                @endif
            </div>

            {{-- Konten --}}
            <div class="flex-1 anim-fade-up opacity-0 delay-1">
                <p class="text-xs font-semibold text-[#0d7377] tracking-widest uppercase mb-3">Sambutan</p>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8">
                    Sambutan Kepala Sekolah
                </h2>

                {{-- Blockquote --}}
                <blockquote class="border-l-[3px] border-[#0d7377] pl-6">
                    <div class="text-gray-600 leading-relaxed text-base italic space-y-3">
                        {!! $greeting->deskripsi ?? '<p>Selamat datang di website resmi SMPN 3 Ajibarang. Kami berkomitmen untuk terus meningkatkan kualitas pendidikan yang berlandaskan nilai-nilai karakter, keunggulan akademik, dan kepedulian terhadap lingkungan.</p>' !!}
                    </div>
                </blockquote>

                {{-- Nama & Jabatan --}}
                <div class="mt-7 flex items-center gap-3">
                    <div class="w-8 h-0.5 bg-[#0d7377]"></div>
                    <div>
                        <div class="font-semibold text-gray-900 text-sm">
                            {{ $greeting->nama_kepala_sekolah ?? 'Kepala Sekolah' }}
                        </div>
                        <div class="text-xs text-gray-400 mt-0.5">Kepala SMPN 3 Ajibarang</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ===================== VIDEO PROFIL ===================== --}}
@if(!empty($video))
<section class="py-20 bg-[#0d7377]">
    <div class="max-w-4xl mx-auto px-6 md:px-10 text-center">

        <p class="text-xs font-semibold text-[#14a5ab] tracking-widest uppercase mb-3">Visual Sekolah</p>
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">
            {{ $video->judul ?? 'Video Profil Sekolah' }}
        </h2>

        @if(!empty($video->deskripsi))
        <p class="mt-2 text-white/60 max-w-lg mx-auto text-sm leading-relaxed mb-8">
            {{ $video->deskripsi }}
        </p>
        @else
        <div class="mt-8"></div>
        @endif

        <div class="max-w-3xl mx-auto">
            <div class="rounded-xl overflow-hidden shadow-lg border border-white/10 aspect-video">
                @php
                    $videoUrl = $video->link_video ?? '';
                    preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\&\?\/]+)/', $videoUrl, $matches);
                    $videoId = $matches[1] ?? null;
                @endphp
                @if($videoId)
                    <iframe class="w-full h-full"
                        src="https://www.youtube.com/embed/{{ $videoId }}"
                        title="{{ $video->judul }}"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                @else
                    <div class="w-full h-full bg-black/20 flex items-center justify-center min-h-64">
                        <a href="{{ $videoUrl }}" target="_blank"
                           class="text-white flex flex-col items-center gap-3 hover:text-[#e6f4f4] transition">
                            <div class="w-14 h-14 rounded-full bg-white/15 hover:bg-white/25 flex items-center justify-center transition">
                                <i class="fas fa-play text-xl ml-1"></i>
                            </div>
                            <span class="text-sm font-medium">Tonton Video</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>

    </div>
</section>
@endif

{{-- ===================== TENAGA PENGAJAR ===================== --}}
@if($teachers->count())
<section id="guru" class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 md:px-10">

        <div class="text-center mb-12">
            <p class="text-xs font-semibold text-[#0d7377] tracking-widest uppercase mb-2">Tim Pendidik</p>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Tenaga Pengajar</h2>
        </div>

        {{-- Mobile: 2×2 grid --}}
        <div class="md:hidden grid grid-cols-2 gap-3 mb-5">
            @foreach($teachers->take(4) as $teacher)
            <div class="py-4 px-3 text-center bg-[#f9fafb] rounded-xl">
                @if(!empty($teacher->foto))
                    <img src="{{ Storage::url($teacher->foto) }}"
                         class="w-14 h-14 rounded-full object-cover mx-auto"
                         loading="lazy" alt="{{ $teacher->nama }}"/>
                @else
                    <div class="w-14 h-14 rounded-full mx-auto bg-[#e6f4f4] flex items-center justify-center">
                        <span class="text-[#0d7377] font-bold text-base">{{ mb_substr($teacher->nama, 0, 1) }}</span>
                    </div>
                @endif
                <div class="mt-2.5 font-semibold text-gray-800 text-xs leading-tight line-clamp-2">
                    {{ $teacher->nama }}
                </div>
                <div class="text-[11px] text-gray-400 mt-0.5 line-clamp-1">
                    {{ $teacher->mata_pelajaran ?? $teacher->jabatan ?? '-' }}
                </div>
            </div>
            @endforeach
        </div>
        <div class="md:hidden text-center">
            <a href="{{ route('about.pengajar') }}"
               class="text-[#0d7377] font-medium hover:text-[#0a5c60] text-sm inline-flex items-center gap-2 transition">
                Lihat Semua Pengajar <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        {{-- Desktop: Carousel --}}
        <div class="hidden md:block relative overflow-hidden">
            <div id="teacherTrack" class="flex gap-4 transition-transform duration-500 ease-in-out">
                @foreach($teachers as $teacher)
                <div class="teacher-card flex-shrink-0">
                    <div class="pt-5 pb-4 px-4 text-center hover:bg-[#f9fafb] rounded-xl transition duration-200 cursor-default">
                        @if(!empty($teacher->foto))
                            <img src="{{ Storage::url($teacher->foto) }}"
                                 class="w-16 h-16 rounded-full object-cover mx-auto"
                                 style="width:64px;height:64px;"
                                 loading="lazy"
                                 alt="{{ $teacher->nama }}"/>
                        @else
                            <div class="w-16 h-16 rounded-full mx-auto bg-[#e6f4f4] flex items-center justify-center"
                                 style="width:64px;height:64px;">
                                <span class="text-[#0d7377] font-bold text-lg">{{ mb_substr($teacher->nama, 0, 1) }}</span>
                            </div>
                        @endif
                        <div class="mt-3 font-semibold text-gray-800 text-xs leading-tight line-clamp-2">
                            {{ $teacher->nama }}
                        </div>
                        <div class="text-[11px] text-gray-400 mt-1 line-clamp-1">
                            {{ $teacher->mata_pelajaran ?? $teacher->jabatan ?? '-' }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div id="teacherDots" class="hidden md:flex justify-center gap-2 mt-8"></div>
    </div>
</section>
@endif

{{-- ===================== INFORMASI TERBARU ===================== --}}
<section id="informasi" class="pt-16 pb-12 bg-[#f9fafb]">
    <div class="max-w-7xl mx-auto px-6 md:px-10">

        <div class="text-center mb-12">
            <p class="text-xs font-semibold text-[#0d7377] tracking-widest uppercase mb-2">Update Terkini</p>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Informasi Terbaru</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- ── Berita (2/3 width) ── --}}
            <div class="lg:col-span-2">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-semibold text-gray-800 text-sm uppercase tracking-wide">Berita</h3>
                    <a href="{{ route('information', ['type' => 'berita']) }}"
                       class="text-xs text-[#0d7377] hover:text-[#0a5c60] font-medium flex items-center gap-1 transition">
                        Lihat semua <i class="fas fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                @if($posts->count())
                    @php $featured = $posts->first(); $restPosts = $posts->skip(1); @endphp

                    {{-- Featured --}}
                    <a href="{{ route('information.detail', $featured->slug) }}" class="group block mb-5">
                        <div class="overflow-hidden rounded-xl mb-3 h-52 bg-gray-100">
                            @if(!empty($featured->thumbnail))
                                <img src="{{ Storage::url($featured->thumbnail) }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                     loading="lazy" alt="{{ $featured->judul }}"/>
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#0d7377]/10 to-[#0a5c60]/5">
                                    <i class="fas fa-newspaper text-[#0d7377]/25 text-5xl"></i>
                                </div>
                            @endif
                        </div>
                        <h4 class="font-bold text-gray-900 text-base group-hover:text-[#0d7377] leading-snug transition mb-1">
                            {{ $featured->judul }}
                        </h4>
                        <div class="text-xs text-gray-400">
                            {{ $featured->tanggal_publish
                                ? \Carbon\Carbon::parse($featured->tanggal_publish)->translatedFormat('d F Y')
                                : $featured->created_at->translatedFormat('d F Y') }}
                        </div>
                    </a>

                    {{-- Grid kartu berita lainnya --}}
                    @if($restPosts->count())
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($restPosts as $post)
                        <a href="{{ route('information.detail', $post->slug) }}" class="group block">
                            <div class="overflow-hidden rounded-lg mb-2 h-28 bg-gray-100">
                                @if(!empty($post->thumbnail))
                                    <img src="{{ Storage::url($post->thumbnail) }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                         loading="lazy" alt="{{ $post->judul }}"/>
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#0d7377]/10 to-[#0a5c60]/5">
                                        <i class="fas fa-newspaper text-[#0d7377]/25 text-3xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="font-semibold text-sm text-gray-800 group-hover:text-[#0d7377] leading-snug line-clamp-2 transition">
                                {{ $post->judul }}
                            </div>
                            <div class="text-xs text-gray-400 mt-1">
                                {{ $post->tanggal_publish
                                    ? \Carbon\Carbon::parse($post->tanggal_publish)->translatedFormat('d M Y')
                                    : $post->created_at->translatedFormat('d M Y') }}
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @endif
                @else
                    <div class="py-12 text-center text-gray-400 text-sm">
                        Belum ada berita.
                    </div>
                @endif
            </div>

            {{-- ── Pengumuman (1/3 width) ── --}}
            <div>
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-semibold text-gray-800 text-sm uppercase tracking-wide">Pengumuman</h3>
                    <a href="{{ route('information', ['type' => 'pengumuman']) }}"
                       class="text-xs text-[#0d7377] hover:text-[#0a5c60] font-medium flex items-center gap-1 transition">
                        Semua <i class="fas fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($pengumuman as $item)
                    @php
                        $expired  = $item->end_date && now()->gt($item->end_date);
                        $isPinned = $item->is_pinned && !$expired;
                    @endphp
                    <a href="{{ route('information.detail', $item->slug) }}"
                       class="block p-4 rounded-xl border transition group
                              {{ $isPinned
                                  ? 'bg-[#0d7377]/5 border-[#0d7377]/20 hover:bg-[#0d7377]/10'
                                  : ($expired
                                      ? 'bg-white/60 border-gray-100 opacity-55'
                                      : 'bg-white/70 border-gray-100 hover:bg-gray-50') }}">
                        @if($isPinned)
                        <span class="text-[10px] font-semibold text-[#0d7377] bg-[#0d7377]/10 px-2 py-0.5 rounded inline-block mb-2">
                            <i class="fas fa-thumbtack text-[9px] mr-0.5"></i> Disematkan
                        </span>
                        @elseif($expired)
                        <span class="text-[10px] font-semibold text-gray-400 bg-gray-100 px-2 py-0.5 rounded inline-block mb-2">
                            Berakhir
                        </span>
                        @endif
                        <div class="font-medium text-sm text-gray-700 group-hover:text-[#0d7377] leading-snug line-clamp-2 transition">
                            {{ $item->judul }}
                        </div>
                        <div class="text-xs mt-1.5 {{ $item->end_date && !$expired ? 'text-orange-500' : 'text-gray-400' }}">
                            @if($item->end_date)
                                Sampai {{ \Carbon\Carbon::parse($item->end_date)->translatedFormat('d M Y') }}
                            @else
                                {{ $item->tanggal_publish
                                    ? \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d F Y')
                                    : $item->created_at->translatedFormat('d F Y') }}
                            @endif
                        </div>
                    </a>
                    @empty
                    <div class="py-8 text-center text-gray-400 text-sm">
                        Belum ada pengumuman.
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ===================== PRESTASI ===================== --}}
@if($prestasi->count())
<section id="prestasi" class="pt-14 pb-12 bg-white">
    <div class="max-w-7xl mx-auto px-6 md:px-10">

        <div class="flex items-end justify-between mb-10">
            <div>
                <p class="text-xs font-semibold text-[#0d7377] tracking-widest uppercase mb-2">Kebanggaan Kami</p>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Prestasi Terbaru</h2>
            </div>
            <a href="{{ route('information', ['type' => 'prestasi']) }}"
               class="text-sm text-[#0d7377] hover:text-[#0a5c60] font-medium flex items-center gap-1.5 transition hidden sm:flex">
                Lihat semua <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        {{-- List sederhana --}}
        <div class="divide-y divide-gray-100">
            @foreach($prestasi as $idx => $item)
            <a href="{{ route('information.detail', $item->slug) }}"
               class="flex items-center gap-5 py-4 group hover:bg-[#f9fafb] -mx-2 px-2 rounded-lg transition">
                <div class="w-8 h-8 rounded-lg bg-[#e6f4f4] flex items-center justify-center flex-shrink-0">
                    <span class="text-xs font-bold text-[#0d7377]">{{ $loop->iteration }}</span>
                </div>
                @if(!empty($item->thumbnail))
                    <img src="{{ Storage::url($item->thumbnail) }}"
                         class="w-14 h-11 rounded-lg object-cover flex-shrink-0 group-hover:opacity-90 transition"
                         loading="lazy"
                         alt="{{ $item->judul }}"/>
                @endif
                <div class="flex-1 min-w-0">
                    <div class="font-medium text-gray-800 text-sm group-hover:text-[#0d7377] leading-snug line-clamp-1 transition">
                        {{ $item->judul }}
                    </div>
                    @if(!empty($item->isi_konten))
                    <div class="text-xs text-gray-400 mt-0.5 line-clamp-1">
                        {{ Str::limit(strip_tags($item->isi_konten), 80) }}
                    </div>
                    @endif
                </div>
                @if($item->tanggal_publish)
                <div class="text-xs text-gray-400 flex-shrink-0 hidden sm:block">
                    {{ \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('Y') }}
                </div>
                @endif
            </a>
            @endforeach
        </div>

        <div class="text-center mt-8 sm:hidden">
            <a href="{{ route('information', ['type' => 'prestasi']) }}"
               class="inline-flex items-center gap-2 text-[#0d7377] font-medium text-sm hover:text-[#0a5c60] transition">
                Lihat Semua Prestasi <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

    </div>
</section>
@endif

{{-- ===================== KONTAK ===================== --}}
<section id="kontak" class="py-20 bg-[#f9fafb]">
    <div class="max-w-7xl mx-auto px-6 md:px-10">

        <div class="text-center mb-10">
            <p class="text-xs font-semibold text-[#0d7377] tracking-widest uppercase mb-2">Hubungi Kami</p>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Kontak Sekolah</h2>
        </div>

        {{-- Baris 1: Info + Maps --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

            {{-- Info Kontak --}}
            <div class="bg-[#0d7377] rounded-2xl p-7 text-white">
                <h3 class="font-semibold text-white text-sm mb-6">Informasi Kontak</h3>

                <div class="space-y-5">
                    @if(!empty($contactInfo->alamat))
                    <div class="flex gap-3 items-start">
                        <i class="fas fa-map-marker-alt text-[#14a5ab] text-sm mt-0.5 w-4 flex-shrink-0"></i>
                        <div>
                            <div class="text-[10px] text-white/50 uppercase font-medium tracking-wider mb-0.5">Alamat</div>
                            <div class="text-sm text-white/90 leading-relaxed">{{ $contactInfo->alamat }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($contactInfo->nomor_telepon))
                    <div class="flex gap-3 items-start">
                        <i class="fas fa-phone text-[#14a5ab] text-sm mt-0.5 w-4 flex-shrink-0"></i>
                        <div>
                            <div class="text-[10px] text-white/50 uppercase font-medium tracking-wider mb-0.5">Telepon</div>
                            <a href="tel:{{ $contactInfo->nomor_telepon }}"
                               class="text-sm text-white/90 hover:text-white transition">
                                {{ $contactInfo->nomor_telepon }}
                            </a>
                        </div>
                    </div>
                    @endif

                    @if(!empty($contactInfo->email))
                    <div class="flex gap-3 items-start">
                        <i class="fas fa-envelope text-[#14a5ab] text-sm mt-0.5 w-4 flex-shrink-0"></i>
                        <div>
                            <div class="text-[10px] text-white/50 uppercase font-medium tracking-wider mb-0.5">Email</div>
                            <a href="mailto:{{ $contactInfo->email }}"
                               class="text-sm text-white/90 hover:text-white transition">
                                {{ $contactInfo->email }}
                            </a>
                        </div>
                    </div>
                    @endif

                    @if(!empty($contactInfo->website))
                    <div class="flex gap-3 items-start">
                        <i class="fas fa-globe text-[#14a5ab] text-sm mt-0.5 w-4 flex-shrink-0"></i>
                        <div>
                            <div class="text-[10px] text-white/50 uppercase font-medium tracking-wider mb-0.5">Website</div>
                            <a href="{{ $contactInfo->website }}" target="_blank"
                               class="text-sm text-white/90 hover:text-white transition">
                                {{ $contactInfo->website }}
                            </a>
                        </div>
                    </div>
                    @endif
                </div>

                @if(!empty($socialMedia) && $socialMedia->count())
                <div class="mt-6 pt-5 border-t border-white/10">
                    <div class="text-[10px] text-white/50 uppercase font-medium tracking-wider mb-3">Ikuti Kami</div>
                    <div class="flex gap-2 flex-wrap">
                        @foreach($socialMedia as $sm)
                        <a href="{{ $sm->url }}" target="_blank" rel="noopener"
                           class="w-9 h-9 bg-white/10 hover:bg-white/25 rounded-lg flex items-center justify-center transition"
                           title="{{ $sm->nama }}">
                            <i class="fab fa-{{ $sm->icon }} text-white text-sm"></i>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Maps --}}
            <div class="flex flex-col gap-3">
                @if(!empty($contactInfo->embed_maps))
                <div class="rounded-xl overflow-hidden border border-gray-200 flex-1" style="min-height: 260px;">
                    {!! preg_replace(
                        ['/width="\d+"/', '/height="\d+"/'],
                        ['width="100%"', 'height="100%"'],
                        $contactInfo->embed_maps
                    ) !!}
                </div>
                @else
                <div class="rounded-xl border border-gray-200 bg-white flex flex-col items-center justify-center gap-2 flex-1"
                     style="min-height: 260px;">
                    <i class="fas fa-map-marker-alt text-gray-300 text-3xl"></i>
                    <p class="text-sm text-gray-400">Peta belum dikonfigurasi</p>
                </div>
                @endif

                @if(!empty($contactInfo->alamat))
                <a href="https://maps.google.com/?q={{ urlencode($contactInfo->alamat) }}"
                   target="_blank"
                   class="flex items-center justify-center gap-2 bg-[#0d7377] hover:bg-[#0a5c60] text-white font-medium text-sm py-3 rounded-xl transition">
                    <i class="fas fa-map-marked-alt"></i>
                    Lihat di Google Maps
                </a>
                @endif
            </div>

        </div>

        {{-- Baris 2: Form --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-8">
            <div class="max-w-4xl mx-auto">
                <h3 class="font-semibold text-gray-900 text-sm mb-1">Kirim Pesan</h3>
                <p class="text-xs text-gray-400 mb-6">Punya pertanyaan? Kami siap membantu Anda.</p>

                @if(session('success'))
                <div class="mb-5 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl flex items-center gap-2">
                    <i class="fas fa-check-circle text-green-500"></i>
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">
                                Nama Lengkap <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="nama" value="{{ old('nama') }}"
                                   placeholder="Nama Anda"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-[#0d7377] transition {{ $errors->has('nama') ? 'border-red-400' : '' }}"/>
                            @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Nomor Telepon</label>
                            <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon') }}"
                                   placeholder="0812xxxxxxxx"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-[#0d7377] transition"/>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   placeholder="email@example.com"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-[#0d7377] transition {{ $errors->has('email') ? 'border-red-400' : '' }}"/>
                            @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Subjek</label>
                            <select name="subjek"
                                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-[#0d7377] transition text-gray-600">
                                <option value="">Pilih subjek</option>
                                <option value="Informasi Sekolah"  {{ old('subjek') == 'Informasi Sekolah'  ? 'selected' : '' }}>Informasi Sekolah</option>
                                <option value="Kegiatan Sekolah"   {{ old('subjek') == 'Kegiatan Sekolah'   ? 'selected' : '' }}>Kegiatan Sekolah</option>
                                <option value="Prestasi Akademik"  {{ old('subjek') == 'Prestasi Akademik'  ? 'selected' : '' }}>Prestasi Akademik</option>
                                <option value="Kerjasama"          {{ old('subjek') == 'Kerjasama'          ? 'selected' : '' }}>Kerjasama</option>
                                <option value="Lainnya"            {{ old('subjek') == 'Lainnya'            ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-600 mb-1.5">
                            Pesan <span class="text-red-400">*</span>
                        </label>
                        <textarea name="isi_pesan" rows="4"
                                  placeholder="Tulis pesan Anda di sini..."
                                  class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-[#0d7377] transition resize-none {{ $errors->has('isi_pesan') ? 'border-red-400' : '' }}">{{ old('isi_pesan') }}</textarea>
                        @error('isi_pesan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <button type="submit"
                            class="w-full bg-[#0d7377] hover:bg-[#0a5c60] text-white font-semibold py-3 rounded-lg transition flex items-center justify-center gap-2 active:scale-95">
                        <i class="fas fa-paper-plane text-sm"></i>
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    const track     = document.getElementById('teacherTrack');
    const dotsWrap  = document.getElementById('teacherDots');
    if (!track || !dotsWrap) return;

    const cards     = track.querySelectorAll('.teacher-card');
    let visible     = window.innerWidth >= 1024 ? 5 : window.innerWidth >= 640 ? 3 : 2;
    let current     = 0;
    const total     = Math.ceil(cards.length / visible);

    function setWidths() {
        visible = window.innerWidth >= 1024 ? 5 : window.innerWidth >= 640 ? 3 : 2;
        const pct = `calc(${100 / visible}% - 16px)`;
        cards.forEach(c => c.style.flexBasis = pct);
    }

    function buildDots() {
        dotsWrap.innerHTML = '';
        for (let i = 0; i < total; i++) {
            const d = document.createElement('button');
            d.className = `h-2 rounded-full transition-all duration-300 ${i === current ? 'w-5 bg-[#0d7377]' : 'w-2 bg-gray-300'}`;
            d.addEventListener('click', () => goTo(i));
            dotsWrap.appendChild(d);
        }
    }

    function goTo(idx) {
        current = idx;
        const cardW = cards[0].offsetWidth + 16;
        track.style.transform = `translateX(-${current * visible * cardW}px)`;
        buildDots();
    }

    setWidths();
    buildDots();

    setInterval(() => goTo((current + 1) % total), 4000);

    window.addEventListener('resize', () => { setWidths(); goTo(0); });
})();
</script>
@endpush
