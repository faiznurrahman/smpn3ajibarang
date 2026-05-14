@extends('layouts.app')

@section('content')
{{-- ===================== HERO ===================== --}}
{{-- ===================== HERO ===================== --}}
<section id="beranda"
    class="relative min-h-screen flex flex-col justify-center items-center text-center px-4 pt-20"
    style="background-image:
           linear-gradient(to bottom, rgba(5,15,45,0.50) 0%, rgba(5,15,45,0.20) 45%, rgba(5,15,45,0.65) 100%),
           url('{{ !empty($settings->background_hero) ? Storage::url($settings->background_hero) : 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=1400&q=80' }}');
           background-size: cover; background-position: center top;">

    {{-- Konten Utama --}}
    <div class="anim-fade-up">

        {{-- Tagline badge --}}
        @if(!empty($settings->tagline))
        <div class="inline-flex items-center gap-2 bg-yellow-400/90 backdrop-blur text-blue-900 text-xs font-bold px-5 py-2 rounded-full mb-7 tracking-widest uppercase shadow-lg">
            <i class="fas fa-star text-[10px]"></i>
            {{ $settings->tagline }}
        </div>
        @endif

        {{-- Judul --}}
        <h1 class="font-black leading-none drop-shadow-2xl"
            style="font-family: 'Oswald', sans-serif; letter-spacing: -1px;">
            <span class="block text-white text-5xl md:text-7xl lg:text-8xl">
                {{ strtoupper($settings->judul_hero ?? 'SMPN 3') }}
            </span>
        </h1>

        {{-- Garis dekoratif --}}
        <div class="flex items-center justify-center gap-3 mt-5 mb-5">
            <div class="w-12 h-px bg-white/30"></div>
            <div class="w-2 h-2 rounded-full bg-yellow-400"></div>
            <div class="w-12 h-px bg-white/30"></div>
        </div>

        {{-- Deskripsi --}}
        <p class="text-white/85 text-base md:text-lg max-w-lg mx-auto leading-relaxed">
            {{ $settings->deskripsi_hero ?? 'Berkomitmen mencetak generasi yang berkarakter, berprestasi, dan peduli lingkungan.' }}
        </p>

    </div>

    {{-- Stats bar --}}
    <div class="mt-16 w-full max-w-4xl grid grid-cols-2 md:grid-cols-4 gap-4 anim-fade-up delay-2">
        <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl py-5 px-4 text-white hover:bg-white/15 transition">
            <div class="text-3xl font-black text-yellow-300" style="font-family: 'Oswald', sans-serif;">
                {{ $settings->jumlah_siswa ? $settings->jumlah_siswa.'+' : '800+' }}
            </div>
            <div class="text-xs text-white/70 mt-1 uppercase tracking-wider">Siswa Aktif</div>
        </div>
        <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl py-5 px-4 text-white hover:bg-white/15 transition">
            <div class="text-3xl font-black text-yellow-300" style="font-family: 'Oswald', sans-serif;">
                {{ $settings->jumlah_guru_karyawan ? $settings->jumlah_guru_karyawan.'+' : '45+' }}
            </div>
            <div class="text-xs text-white/70 mt-1 uppercase tracking-wider">Tenaga Pengajar</div>
        </div>
        <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl py-5 px-4 text-white hover:bg-white/15 transition">
            <div class="text-3xl font-black text-yellow-300" style="font-family: 'Oswald', sans-serif;">
                {{ $settings->jumlah_prestasi ? $settings->jumlah_prestasi.'+' : '120+' }}
            </div>
            <div class="text-xs text-white/70 mt-1 uppercase tracking-wider">Prestasi</div>
        </div>
        <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl py-5 px-4 text-white hover:bg-white/15 transition">
            <div class="text-3xl font-black text-yellow-300" style="font-family: 'Oswald', sans-serif;">
                {{ $settings->tahun_berdiri ? date('Y') - $settings->tahun_berdiri .'+' : '25+' }}
            </div>
            <div class="text-xs text-white/70 mt-1 uppercase tracking-wider">Tahun Berdiri</div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="mt-12 flex flex-col items-center gap-2 text-white/40">
        <span class="text-xs tracking-widest uppercase">Scroll</span>
        <i class="fas fa-chevron-down text-lg animate-bounce"></i>
    </div>

</section>
{{-- ===================== SAMBUTAN KEPSEK ===================== --}}
<section id="sambutan" class="py-24 bg-white overflow-hidden">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-16 items-center">

            {{-- ── Foto ── --}}
            <div class="flex-shrink-0 flex justify-center lg:justify-start anim-fade-up opacity-0">
                <div class="relative">
                    {{-- Background dekorasi --}}
                    <div class="absolute -bottom-4 -right-4 w-full h-full rounded-3xl bg-[#0d2b6b] opacity-10"></div>
                    <div class="absolute -top-4 -left-4 w-24 h-24 rounded-full bg-yellow-400 opacity-20"></div>

                    @if(!empty($greeting->foto))
                        <img src="{{ Storage::url($greeting->foto) }}"
                             alt="Kepala Sekolah"
                             class="relative w-64 h-72 md:w-72 md:h-80 object-cover rounded-3xl shadow-2xl border-4 border-white"/>
                    @else
                        <div class="relative w-64 h-72 md:w-72 md:h-80 rounded-3xl shadow-2xl border-4 border-white bg-blue-50 flex items-center justify-center">
                            <i class="fas fa-user text-blue-200 text-6xl"></i>
                        </div>
                    @endif

                </div>
            </div>

            {{-- ── Konten ── --}}
            <div class="flex-1 anim-fade-up opacity-0 delay-1">

               <h2 style="font-family: 'Oswald', sans-serif; letter-spacing: -0.5px;"
    class="text-3xl md:text-4xl font-black text-[#0d2b6b] leading-tight mb-6">
    Sambutan Kepala Sekolah
</h2>

                {{-- Quote mark dekoratif --}}
                <div class="text-6xl text-yellow-400/30 font-serif leading-none mb-2 select-none">"</div>

                {{-- Isi sambutan --}}
                <div class="text-gray-600 leading-relaxed text-base space-y-3 prose prose-blue max-w-none">
                    {!! $greeting->deskripsi_sambutan ?? '<p>Selamat datang di website resmi SMPN 3 Ajibarang. Kami berkomitmen untuk terus meningkatkan kualitas pendidikan yang berlandaskan nilai-nilai karakter, keunggulan akademik, dan kepedulian terhadap lingkungan.</p>' !!}
                </div>

                {{-- Nama & Jabatan --}}
                <div class="mt-8 flex items-center gap-4">
                    <div class="w-12 h-0.5 bg-yellow-400"></div>
                    <div>
                        <div class="font-bold text-[#0d2b6b] text-base">
                            {{ $greeting->nama_kepala_sekolah ?? 'Kepala Sekolah' }}
                        </div>
                        <div class="text-xs text-gray-400 mt-0.5 uppercase tracking-wider">Kepala SMPN 3 Ajibarang</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
{{-- ===================== VIDEO PROFIL ===================== --}}
@if(!empty($video))
<section class="py-24 bg-[#0d2b6b] relative overflow-hidden">

    {{-- Background pattern --}}
    <div class="absolute inset-0 opacity-5"
         style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>

    <div class="relative max-w-5xl mx-auto px-4 text-center">

        {{-- Label --}}
        <div class="flex items-center justify-center gap-3 mb-4">
            <div class="w-10 h-px bg-yellow-400/50"></div>
            <span class="text-xs font-bold text-yellow-400 tracking-widest uppercase">Visual Sekolah</span>
            <div class="w-10 h-px bg-yellow-400/50"></div>
        </div>

        {{-- Judul --}}
        <h2 style="font-family: 'Oswald', sans-serif; letter-spacing: -0.5px;"
            class="text-3xl md:text-4xl font-black text-white">
            {{ $video->judul ?? 'Video Profil Sekolah' }}
        </h2>

        @if(!empty($video->deskripsi))
        <p class="mt-3 text-white/60 max-w-xl mx-auto text-sm leading-relaxed">
            {{ $video->deskripsi }}
        </p>
        @endif

        {{-- Video --}}
        <div class="mt-10 max-w-3xl mx-auto">
            <div class="rounded-2xl overflow-hidden shadow-2xl border border-white/10 aspect-video">
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
                    <div class="w-full h-full bg-black/30 flex items-center justify-center min-h-64">
                        <a href="{{ $videoUrl }}" target="_blank"
                           class="text-white flex flex-col items-center gap-3 hover:text-yellow-300 transition group">
                            <div class="w-16 h-16 rounded-full bg-white/10 group-hover:bg-white/20 flex items-center justify-center transition">
                                <i class="fas fa-play text-2xl ml-1"></i>
                            </div>
                            <span class="text-sm font-semibold">Tonton Video</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>

    </div>
</section>
@endif
{{-- ===================== PREVIEW GURU ===================== --}}
@if($teachers->count())
<section id="guru" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4">

        {{-- Header --}}
        <div class="text-center mb-12">
    <div class="flex items-center justify-center gap-2 mb-3">
        <div class="w-8 h-px bg-yellow-400"></div>
        <span class="text-xs font-bold text-yellow-500 tracking-widest uppercase">Tim Pendidik</span>
        <div class="w-8 h-px bg-yellow-400"></div>
    </div>
    <h2 style="font-family: 'Oswald', sans-serif; letter-spacing: -0.5px;"
        class="text-3xl md:text-4xl font-black text-[#0d2b6b]">
        Tenaga Pengajar
    </h2>
</div>

        {{-- Carousel --}}
        <div class="relative overflow-hidden">
            <div id="teacherTrack" class="flex gap-4 transition-transform duration-500 ease-in-out">
                @foreach($teachers as $teacher)
                <div class="teacher-card flex-shrink-0">
                    <div class="bg-gray-50 border border-gray-100 rounded-2xl pt-6 pb-5 px-4 text-center hover:shadow-lg hover:border-blue-100 hover:-translate-y-1 transition duration-300">
                        @if(!empty($teacher->foto))
                            <img src="{{ Storage::url($teacher->foto) }}"
                                 class="w-18 h-18 rounded-full object-cover mx-auto border-4 border-white shadow-md"
                                 style="width:72px;height:72px;"
                                 alt="{{ $teacher->nama }}"/>
                        @else
                            <div class="w-18 h-18 rounded-full mx-auto border-4 border-white shadow-md bg-blue-50 flex items-center justify-center"
                                 style="width:72px;height:72px;">
                                <i class="fas fa-user text-blue-200 text-2xl"></i>
                            </div>
                        @endif
                        <div class="mt-3 font-bold text-[#0d2b6b] text-xs leading-tight line-clamp-2">
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

        <div id="teacherDots" class="flex justify-center gap-2 mt-8"></div>

        <div class="text-center mt-4 md:hidden">
            <a href="{{ route('about.pengajar') }}"
               class="text-[#0d2b6b] font-semibold hover:text-yellow-500 text-sm inline-flex items-center gap-2 transition">
                Lihat Semua Pengajar <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ===================== INFORMASI TERBARU ===================== --}}
<section id="informasi" class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">

        {{-- Header --}}
        <div class="text-center mb-12">
    <div class="flex items-center justify-center gap-2 mb-3">
        <div class="w-8 h-px bg-yellow-400"></div>
        <span class="text-xs font-bold text-yellow-500 tracking-widest uppercase">Update Terkini</span>
        <div class="w-8 h-px bg-yellow-400"></div>
    </div>
    <h2 style="font-family: 'Oswald', sans-serif; letter-spacing: -0.5px;"
        class="text-3xl md:text-4xl font-black text-[#0d2b6b]">
        Informasi Terbaru
    </h2>
</div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- ── Berita ── --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 bg-[#0d2b6b] rounded-lg flex items-center justify-center">
                            <i class="fas fa-newspaper text-yellow-300 text-xs"></i>
                        </div>
                        <h3 class="font-bold text-gray-900 text-sm uppercase tracking-wide">Berita Terbaru</h3>
                    </div>
                    <a href="{{ route('information', ['type' => 'berita']) }}"
                       class="text-xs text-[#0d2b6b] hover:text-yellow-500 font-semibold flex items-center gap-1 transition">
                        Semua <i class="fas fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <div class="divide-y divide-gray-50">
                    @forelse($posts as $post)
                    <a href="{{ route('information.detail', $post->slug) }}"
                       class="flex gap-4 px-6 py-4 group hover:bg-blue-50/50 transition">
                        @if(!empty($post->thumbnail))
                            <img src="{{ Storage::url($post->thumbnail) }}"
                                 class="w-20 h-16 rounded-xl object-cover flex-shrink-0 group-hover:opacity-90 transition"
                                 alt="{{ $post->judul }}"/>
                        @else
                            <div class="w-20 h-16 rounded-xl flex-shrink-0 bg-gray-50 border border-gray-100 flex items-center justify-center">
                                <i class="fas fa-newspaper text-gray-200 text-xl"></i>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <div class="font-semibold text-sm text-gray-800 group-hover:text-[#0d2b6b] leading-snug line-clamp-2 transition">
                                {{ $post->judul }}
                            </div>
                            <div class="text-xs text-gray-400 mt-2 flex items-center gap-1.5">
                                <i class="fas fa-calendar-alt"></i>
                                {{ $post->tanggal_publish
                                    ? \Carbon\Carbon::parse($post->tanggal_publish)->translatedFormat('d F Y')
                                    : $post->created_at->translatedFormat('d F Y') }}
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-200 group-hover:text-[#0d2b6b] transition text-xs mt-1 flex-shrink-0"></i>
                    </a>
                    @empty
                    <div class="px-6 py-10 text-center text-gray-400 text-sm">
                        <i class="fas fa-newspaper text-3xl mb-2 block text-gray-200"></i>
                        Belum ada berita.
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- ── Pengumuman ── --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 bg-yellow-400 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bullhorn text-white text-xs"></i>
                        </div>
                        <h3 class="font-bold text-gray-900 text-sm uppercase tracking-wide">Pengumuman</h3>
                    </div>
                    <a href="{{ route('information', ['type' => 'pengumuman']) }}"
                       class="text-xs text-[#0d2b6b] hover:text-yellow-500 font-semibold flex items-center gap-1 transition">
                        Semua <i class="fas fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <div class="divide-y divide-gray-50">
                    @forelse($pengumuman as $item)
                    @php $expired = $item->end_date && now()->gt($item->end_date); @endphp
                    <a href="{{ route('information.detail', $item->slug) }}"
                       class="flex gap-4 px-6 py-4 group hover:bg-yellow-50/50 transition {{ $expired ? 'opacity-60' : '' }}">

                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5
                                    {{ $item->is_pinned ? 'bg-yellow-400' : ($expired ? 'bg-gray-100' : 'bg-blue-50') }}">
                            @if($item->is_pinned)
                                <i class="fas fa-thumbtack text-white text-sm"></i>
                            @elseif($expired)
                                <i class="fas fa-archive text-gray-400 text-sm"></i>
                            @else
                                <i class="fas fa-bullhorn text-[#0d2b6b] text-sm"></i>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            @if($item->is_pinned)
                            <span class="text-[10px] font-bold text-yellow-600 bg-yellow-100 px-2 py-0.5 rounded-full inline-block mb-1">
                                Disematkan
                            </span>
                            @elseif($expired)
                            <span class="text-[10px] font-bold text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full inline-block mb-1">
                                Berakhir
                            </span>
                            @endif
                            <div class="font-semibold text-sm text-gray-800 group-hover:text-[#0d2b6b] leading-snug line-clamp-2 transition">
                                {{ $item->judul }}
                            </div>
                            <div class="text-xs mt-2 flex items-center gap-1.5
                                        {{ $expired ? 'text-gray-400' : ($item->end_date ? 'text-orange-500' : 'text-gray-400') }}">
                                <i class="fas {{ $item->end_date ? 'fa-clock' : 'fa-calendar-alt' }}"></i>
                                @if($item->end_date)
                                    Sampai {{ \Carbon\Carbon::parse($item->end_date)->translatedFormat('d M Y') }}
                                @else
                                    {{ $item->tanggal_publish
                                        ? \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d F Y')
                                        : $item->created_at->translatedFormat('d F Y') }}
                                @endif
                            </div>
                        </div>

                        <i class="fas fa-chevron-right text-gray-200 group-hover:text-yellow-400 transition text-xs mt-1 flex-shrink-0"></i>
                    </a>
                    @empty
                    <div class="px-6 py-10 text-center text-gray-400 text-sm">
                        <i class="fas fa-bullhorn text-3xl mb-2 block text-gray-200"></i>
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
<section id="prestasi" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4">

        {{-- Header --}}
        <div class="text-center mb-12">
            <div class="flex items-center justify-center gap-2 mb-3">
                <div class="w-8 h-px bg-yellow-400"></div>
                <span class="text-xs font-bold text-yellow-500 tracking-widest uppercase">Kebanggaan Kami</span>
                <div class="w-8 h-px bg-yellow-400"></div>
            </div>
            <h2 style="font-family: 'Oswald', sans-serif; letter-spacing: -0.5px;"
                class="text-3xl md:text-4xl font-black text-[#0d2b6b]">
                Prestasi Terbaru
            </h2>
        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($prestasi as $item)
            <a href="{{ route('information.detail', $item->slug) }}"
               class="bg-gray-50 border border-gray-100 rounded-2xl overflow-hidden hover:shadow-lg hover:border-yellow-300 hover:-translate-y-1 transition duration-300 block group">

                {{-- Thumbnail --}}
                @if(!empty($item->thumbnail))
                    <div class="h-36 overflow-hidden">
                        <img src="{{ Storage::url($item->thumbnail) }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                             alt="{{ $item->judul }}"/>
                    </div>
                @else
                    <div class="h-36 bg-[#0d2b6b]/5 flex items-center justify-center">
                        <i class="fas fa-trophy text-3xl text-yellow-400/60"></i>
                    </div>
                @endif

                {{-- Konten --}}
                <div class="p-4">
                    @if($item->tanggal_publish)
                    <div class="text-[11px] font-bold text-yellow-600 mb-2 flex items-center gap-1.5">
                        <i class="fas fa-calendar-alt text-[10px]"></i>
                        {{ \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('Y') }}
                    </div>
                    @endif
                    <div class="font-bold text-[#0d2b6b] text-sm leading-snug line-clamp-2 group-hover:text-yellow-600 transition">
                        {{ $item->judul }}
                    </div>
                    @if(!empty($item->isi_konten))
                    <div class="text-xs text-gray-400 mt-2 line-clamp-2 leading-relaxed">
                        {{ Str::limit(strip_tags($item->isi_konten), 70) }}
                    </div>
                    @endif
                </div>

            </a>
            @endforeach
        </div>

        {{-- CTA --}}
        <div class="text-center mt-10">
            <a href="{{ route('information', ['type' => 'prestasi']) }}"
               class="inline-flex items-center gap-2 bg-[#0d2b6b] hover:bg-[#1a3f8f] text-white font-bold px-8 py-3 rounded-full shadow-lg transition text-sm">
                Lihat Semua Prestasi <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

    </div>
</section>
@endif
{{-- ===================== KONTAK ===================== --}}
<section id="kontak" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">

        {{-- Header --}}
        <div class="text-center mb-10">
            <div class="flex items-center justify-center gap-3 mb-3">
                <div class="w-7 h-px bg-yellow-500"></div>
                <span class="text-xs font-semibold text-yellow-500 tracking-widest uppercase">Hubungi Kami</span>
                <div class="w-7 h-px bg-yellow-500"></div>
            </div>
            <h2 class="text-3xl font-black text-[#0d2b6b]" style="font-family:'Oswald',sans-serif;">
                Kontak Sekolah
            </h2>
        </div>

        {{-- Baris 1: Info Kontak + Maps --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">

            {{-- Info Kontak --}}
            <div class="bg-[#0d2b6b] rounded-2xl p-7 text-white">
                <h3 class="text-base font-bold text-white mb-6 flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 16 16" fill="none">
                        <circle cx="8" cy="8" r="7" stroke="rgba(255,255,255,0.5)" stroke-width="1.2"/>
                        <path d="M8 5v4M8 11v.5" stroke="#FAC775" stroke-width="1.4" stroke-linecap="round"/>
                    </svg>
                    Informasi Kontak
                </h3>

                <div class="space-y-4">
                    @if(!empty($contactInfo->alamat))
                    <div class="flex gap-3 items-start">
                        <div class="w-9 h-9 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 14 14" fill="none">
                                <path d="M7 1C4.79 1 3 2.79 3 5c0 3 4 8 4 8s4-5 4-8c0-2.21-1.79-4-4-4zm0 5.5A1.5 1.5 0 115 5a1.5 1.5 0 012 1.5z" fill="#FAC775"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-[10px] text-white/40 uppercase font-semibold tracking-wider mb-0.5">Alamat</div>
                            <div class="text-sm text-white/90 leading-relaxed">{{ $contactInfo->alamat }}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($contactInfo->nomor_telepon))
                    <div class="flex gap-3 items-start">
                        <div class="w-9 h-9 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 14 14" fill="none">
                                <path d="M2 2.5A1.5 1.5 0 013.5 1h.879a1.5 1.5 0 011.414 1L6.5 4a1.5 1.5 0 01-.44 1.56l-.5.5a6.042 6.042 0 002.879 2.879l.5-.5A1.5 1.5 0 0110.5 8h1.5a1.5 1.5 0 011 1.421V10.5A1.5 1.5 0 0111.5 12C5.701 12 1 7.299 1 2.5A1.5 1.5 0 012.5 1H3" stroke="#FAC775" stroke-width="1.2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-[10px] text-white/40 uppercase font-semibold tracking-wider mb-0.5">Telepon</div>
                            <a href="tel:{{ $contactInfo->nomor_telepon }}"
                               class="text-sm text-white/90 hover:text-yellow-300 transition">
                                {{ $contactInfo->nomor_telepon }}
                            </a>
                        </div>
                    </div>
                    @endif

                    @if(!empty($contactInfo->email))
                    <div class="flex gap-3 items-start">
                        <div class="w-9 h-9 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 14 14" fill="none">
                                <rect x="1" y="3" width="12" height="8" rx="1.5" stroke="#FAC775" stroke-width="1.2"/>
                                <path d="M1 4l6 4 6-4" stroke="#FAC775" stroke-width="1.2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-[10px] text-white/40 uppercase font-semibold tracking-wider mb-0.5">Email</div>
                            <a href="mailto:{{ $contactInfo->email }}"
                               class="text-sm text-white/90 hover:text-yellow-300 transition">
                                {{ $contactInfo->email }}
                            </a>
                        </div>
                    </div>
                    @endif

                    @if(!empty($contactInfo->website))
                    <div class="flex gap-3 items-start">
                        <div class="w-9 h-9 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 14 14" fill="none">
                                <circle cx="7" cy="7" r="6" stroke="#FAC775" stroke-width="1.2"/>
                                <path d="M7 1c-1.5 2-2 3.5-2 6s.5 4 2 6M7 1c1.5 2 2 3.5 2 6s-.5 4-2 6M1 7h12" stroke="#FAC775" stroke-width="1.2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-[10px] text-white/40 uppercase font-semibold tracking-wider mb-0.5">Website</div>
                            <a href="{{ $contactInfo->website }}" target="_blank"
                               class="text-sm text-white/90 hover:text-yellow-300 transition">
                                {{ $contactInfo->website }}
                            </a>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Sosial Media --}}
                @if(!empty($socialMedia) && $socialMedia->count())
                <div class="mt-6 pt-5 border-t border-white/10">
                    <div class="text-[10px] text-white/40 uppercase font-semibold tracking-wider mb-3">Ikuti Kami</div>
                    <div class="flex gap-2 flex-wrap">
                        @foreach($socialMedia as $sm)
                        <a href="{{ $sm->url }}" target="_blank" rel="noopener"
                           class="w-9 h-9 bg-white/10 hover:bg-yellow-400 rounded-full flex items-center justify-center transition group"
                           title="{{ $sm->nama }}">
                            <i class="fab fa-{{ $sm->icon }} text-white group-hover:text-[#0d2b6b] text-sm transition"></i>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Maps --}}
            <div class="flex flex-col gap-3">
                @if(!empty($contactInfo->embed_maps))
                <div class="rounded-2xl overflow-hidden border border-gray-200 flex-1" style="min-height: 260px;">
                    {!! preg_replace(
                        ['/width="\d+"/', '/height="\d+"/'],
                        ['width="100%"', 'height="100%"'],
                        $contactInfo->embed_maps
                    ) !!}
                </div>
                @else
                <div class="rounded-2xl border border-gray-200 bg-white flex flex-col items-center justify-center gap-2 flex-1"
                     style="min-height: 260px;">
                    <svg class="w-10 h-10 text-gray-300" viewBox="0 0 36 36" fill="none">
                        <path d="M18 8C14.134 8 11 11.134 11 15c0 5.25 7 13 7 13s7-7.75 7-13c0-3.866-3.134-7-7-7z" stroke="currentColor" stroke-width="1.5" fill="none"/>
                        <circle cx="18" cy="15" r="2.5" stroke="currentColor" stroke-width="1.5"/>
                    </svg>
                    <p class="text-sm text-gray-400">Peta belum dikonfigurasi</p>
                    <p class="text-xs text-gray-300">Tambahkan embed maps di pengaturan kontak</p>
                </div>
                @endif

                @if(!empty($contactInfo->alamat))
                <a href="https://maps.google.com/?q={{ urlencode($contactInfo->alamat) }}"
                   target="_blank"
                   class="flex items-center justify-center gap-2 bg-[#0d2b6b] hover:bg-[#1a3f8f] text-white font-semibold text-sm py-3 rounded-xl transition">
                    <svg class="w-4 h-4" viewBox="0 0 14 14" fill="white">
                        <path d="M7 1C4.239 1 2 3.239 2 6c0 4.25 5 7 5 7s5-2.75 5-7c0-2.761-2.239-5-5-5zm0 6.5A1.5 1.5 0 115 6a1.5 1.5 0 012 1.5z"/>
                    </svg>
                    Lihat di Google Maps
                </a>
                @endif
            </div>

        </div>

        {{-- Baris 2: Form Kirim Pesan --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
            <div class="max-w-4xl mx-auto">
                <h3 class="text-base font-bold text-[#0d2b6b] mb-1 flex items-center gap-2"
                    style="font-family:'Oswald',sans-serif;">
                    <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 16 16" fill="none">
                        <path d="M2 3h12a1 1 0 011 1v7a1 1 0 01-1 1H2a1 1 0 01-1-1V4a1 1 0 011-1z" stroke="#BA7517" stroke-width="1.2"/>
                        <path d="M1 4l7 5 7-5" stroke="#BA7517" stroke-width="1.2" stroke-linecap="round"/>
                    </svg>
                    Kirim Pesan
                </h3>
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
                            <label class="block text-xs font-semibold text-gray-500 mb-1.5">
                                Nama Lengkap <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="nama" value="{{ old('nama') }}"
                                   placeholder="Nama Anda"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-[#0d2b6b] transition {{ $errors->has('nama') ? 'border-red-400' : '' }}"/>
                            @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1.5">Nomor Telepon</label>
                            <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon') }}"
                                   placeholder="0812xxxxxxxx"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-[#0d2b6b] transition"/>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1.5">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   placeholder="email@example.com"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-[#0d2b6b] transition {{ $errors->has('email') ? 'border-red-400' : '' }}"/>
                            @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1.5">Subjek</label>
                            <select name="subjek"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-[#0d2b6b] transition text-gray-600">
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
                        <label class="block text-xs font-semibold text-gray-500 mb-1.5">
                            Pesan <span class="text-red-400">*</span>
                        </label>
                        <textarea name="isi_pesan" rows="4"
                                  placeholder="Tulis pesan Anda di sini..."
                                  class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-[#0d2b6b] transition resize-none {{ $errors->has('isi_pesan') ? 'border-red-400' : '' }}">{{ old('isi_pesan') }}</textarea>
                        @error('isi_pesan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <button type="submit"
                            class="w-full bg-[#0d2b6b] hover:bg-[#1a3f8f] text-white font-bold py-3 rounded-xl transition flex items-center justify-center gap-2 active:scale-95">
                        <svg class="w-4 h-4" viewBox="0 0 14 14" fill="none">
                            <path d="M13 1L1 5.5l5 2 2 5L13 1z" stroke="white" stroke-width="1.2" stroke-linejoin="round"/>
                        </svg>
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

    // Set card widths
    function setWidths() {
        visible = window.innerWidth >= 1024 ? 5 : window.innerWidth >= 640 ? 3 : 2;
        const pct = `calc(${100 / visible}% - 16px)`;
        cards.forEach(c => c.style.flexBasis = pct);
    }

    function buildDots() {
        dotsWrap.innerHTML = '';
        for (let i = 0; i < total; i++) {
            const d = document.createElement('button');
            d.className = `h-2 rounded-full transition-all duration-300 ${i === current ? 'w-5 bg-blue-900' : 'w-2 bg-gray-300'}`;
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

    // Auto slide
    setInterval(() => goTo((current + 1) % total), 4000);

    window.addEventListener('resize', () => { setWidths(); goTo(0); });
})();
</script>
@endpush