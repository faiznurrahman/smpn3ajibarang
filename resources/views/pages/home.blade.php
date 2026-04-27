@extends('layouts.app')

@section('content')
{{-- ===================== HERO ===================== --}}
<section id="beranda"
    class="relative min-h-screen flex flex-col justify-center items-center text-center px-4 pt-20"
    style="background-image: linear-gradient(to bottom, rgba(13,43,107,0.75) 0%, rgba(13,43,107,0.5) 60%, rgba(13,43,107,0.88) 100%),
           url('{{ !empty($settings->background_hero) ? Storage::url($settings->background_hero) : 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=1400&q=80' }}');
           background-size: cover; background-position: center top;">

    <div class="anim-fade-up opacity-0">

        {{-- Badge tagline dari database --}}
        @if(!empty($settings->tagline))
        <div class="inline-block bg-yellow-400 text-blue-900 text-xs font-bold px-4 py-1.5 rounded-full mb-5 tracking-widest uppercase shadow-md">
            {{ $settings->tagline }}
        </div>
        @endif

        {{-- Judul: baris putih dari DB, baris kuning tetap nama kota --}}
        <h1 class="text-white text-5xl md:text-7xl lg:text-8xl font-black leading-tight drop-shadow-lg"
            style="font-family: 'Oswald', sans-serif; letter-spacing: -0.5px;">
            {{ strtoupper($settings->judul_hero ?? 'SMPN 3') }}<br/>
            
        </h1>

        <p class="mt-5 text-blue-100 text-base md:text-xl max-w-xl mx-auto leading-relaxed font-medium">
            {{ $settings->deskripsi_hero ?? 'Berkomitmen .....' }}
        </p>

    </div>

    {{-- Stats bar --}}
    <div class="mt-16 w-full max-w-4xl grid grid-cols-2 md:grid-cols-4 gap-4 anim-fade-up opacity-0 delay-2">
        <div class="bg-white/10 backdrop-blur border border-white/20 rounded-2xl py-5 px-4 text-white">
            <div class="text-3xl font-black text-yellow-300" style="font-family: 'Oswald', sans-serif;">
                {{ $settings->jumlah_siswa ? $settings->jumlah_siswa.'+' : '800+' }}
            </div>
            <div class="text-sm text-blue-100 mt-1">Siswa Aktif</div>
        </div>
        <div class="bg-white/10 backdrop-blur border border-white/20 rounded-2xl py-5 px-4 text-white">
            <div class="text-3xl font-black text-yellow-300" style="font-family: 'Oswald', sans-serif;">
                {{ $settings->jumlah_guru_karyawan ? $settings->jumlah_guru_karyawan.'+' : '45+' }}
            </div>
            <div class="text-sm text-blue-100 mt-1">Tenaga Pengajar</div>
        </div>
        <div class="bg-white/10 backdrop-blur border border-white/20 rounded-2xl py-5 px-4 text-white">
            <div class="text-3xl font-black text-yellow-300" style="font-family: 'Oswald', sans-serif;">
                {{ $settings->jumlah_prestasi ? $settings->jumlah_prestasi.'+' : '120+' }}
            </div>
            <div class="text-sm text-blue-100 mt-1">Prestasi</div>
        </div>
        <div class="bg-white/10 backdrop-blur border border-white/20 rounded-2xl py-5 px-4 text-white">
            <div class="text-3xl font-black text-yellow-300" style="font-family: 'Oswald', sans-serif;">
                {{ $settings->tahun_berdiri ? date('Y') - $settings->tahun_berdiri .'+' : '25+' }}
            </div>
            <div class="text-sm text-blue-100 mt-1">Tahun Berdiri</div>
        </div>
    </div>

    <div class="mt-12 animate-bounce text-white/40">
        <i class="fas fa-chevron-down text-2xl"></i>
    </div>
</section>
{{-- ===================== SAMBUTAN KEPSEK ===================== --}}
<section id="sambutan" class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 flex flex-col lg:flex-row gap-12 items-center">

        <div class="flex-1 anim-fade-up opacity-0">
            <div class="text-xs font-bold text-blue-600 tracking-widest uppercase mb-2">Dari Pimpinan Kami</div>
            <h2 class="font-display text-3xl md:text-4xl font-black text-blue-900 gold-underline">
                Sambutan<br/>Kepala Sekolah
            </h2>
            <div class="mt-6 text-gray-600 leading-relaxed text-base space-y-4">
                {!! $greeting->deskripsi ?? 'Selamat datang...' !!}
            </div>
            <div class="mt-7 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-user text-blue-400"></i>
                </div>
                <div>
                    <div class="font-bold text-blue-900 text-base">
                        {{ $greeting->nama_kepala_sekolah ?? 'Kepala Sekolah' }}
                    </div>
                    <div class="text-sm text-gray-500">Kepala SMPN 3 Ajibarang</div>
                </div>
            </div>
        </div>

        <div class="flex-shrink-0 anim-fade-up opacity-0 delay-2">
            <div class="relative">
                <div class="absolute -top-4 -left-4 w-full h-full rounded-2xl bg-yellow-400 opacity-25"></div>
                @if(!empty($greeting->foto))
                    <img src="{{ Storage::url($greeting->foto) }}"
                         alt="Kepala Sekolah"
                         class="relative w-72 h-80 object-cover rounded-2xl shadow-2xl border-4 border-white"/>
                @else
                    <div class="relative w-72 h-80 rounded-2xl shadow-2xl border-4 border-white bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-user text-blue-300 text-6xl"></i>
                    </div>
                @endif
            </div>
        </div>

    </div>
</section>

{{-- ===================== VIDEO PROFIL ===================== --}}
@if(!empty($video))
<section class="py-20 bg-gradient-to-br from-blue-900 to-blue-800">
    <div class="max-w-5xl mx-auto px-4 text-center">
        <div class="text-xs font-bold text-yellow-300 tracking-widest uppercase mb-2">Visual Sekolah</div>
        <h2 class="font-display text-3xl md:text-4xl font-black text-white gold-underline-center">
            {{ $video->judul ?? 'Video Profil Sekolah' }}
        </h2>
        @if(!empty($video->deskripsi))
            <p class="mt-4 text-blue-200 max-w-xl mx-auto text-sm">{{ $video->deskripsi }}</p>
        @endif
        <div class="mt-10 rounded-2xl overflow-hidden shadow-2xl border-4 border-white/10 aspect-video max-w-3xl mx-auto">
            @php
                // Convert youtube URL to embed URL
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
                <div class="w-full h-full bg-blue-950 flex items-center justify-center">
                    <a href="{{ $videoUrl }}" target="_blank"
                       class="text-white flex flex-col items-center gap-3 hover:text-yellow-300 transition">
                        <i class="fas fa-play-circle text-6xl"></i>
                        <span class="text-sm font-semibold">Tonton Video</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>
@endif
{{-- ===================== PREVIEW GURU ===================== --}}
@if($teachers->count())
<section id="guru" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <div class="text-xs font-bold text-blue-600 tracking-widest uppercase mb-2">Tim Pendidik</div>
            <h2 class="font-display text-3xl md:text-4xl font-black text-blue-900 gold-underline-center">
                Tenaga Pengajar
            </h2>
        </div>

        <div class="relative overflow-hidden">
            <div id="teacherTrack" class="flex gap-4 transition-transform duration-500 ease-in-out">
                @foreach($teachers as $teacher)
                <div class="teacher-card flex-shrink-0 w-40">
                    <div class="bg-white rounded-2xl shadow-md pt-6 pb-5 px-4 text-center hover:shadow-xl transition transform hover:-translate-y-1">
                        @if(!empty($teacher->foto))
                            <div class="flex justify-center mb-3">
                                <img src="{{ Storage::url($teacher->foto) }}"
                                     class="w-20 h-20 rounded-full object-cover border-4 border-blue-100"
                                     alt="{{ $teacher->nama }}"/>
                            </div>
                        @else
                            <div class="flex justify-center mb-3">
                                <div class="w-20 h-20 rounded-full border-4 border-blue-100 bg-blue-50 flex items-center justify-center">
                                    <i class="fas fa-user text-blue-300 text-2xl"></i>
                                </div>
                            </div>
                        @endif
                        <div class="font-bold text-blue-900 text-sm leading-tight">{{ $teacher->nama }}</div>
                        <div class="text-xs text-gray-500 mt-1">
                            {{ $teacher->mata_pelajaran ?? '-' }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div id="teacherDots" class="flex justify-center gap-2 mt-8"></div>

        <div class="text-center mt-6">
            <a href="{{ route('about') }}#guru"
               class="text-blue-700 font-semibold hover:text-blue-900 text-sm inline-flex items-center gap-2 transition">
                Lihat Semua Pengajar <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
@endif
{{-- ===================== INFORMASI TERBARU ===================== --}}
<section id="informasi" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <div class="text-xs font-bold text-blue-600 tracking-widest uppercase mb-2">Update Terkini</div>
            <h2 class="font-display text-3xl md:text-4xl font-black text-blue-900 gold-underline-center">
                Informasi Terbaru
            </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

            {{-- Berita --}}
            <div>
                <div class="flex items-center justify-between mb-5">
                    <h3 class="font-bold text-blue-900 text-lg flex items-center gap-2">
                        <i class="fas fa-newspaper text-blue-500"></i> Berita
                    </h3>
                    <a href="{{ route('information', ['type' => 'berita']) }}"
                       class="text-xs text-blue-600 hover:underline font-semibold">Lihat semua →</a>
                </div>
                <div class="space-y-4">
                    @forelse($posts as $post)
                    <a href="{{ route('information.detail', $post->slug) }}" class="flex gap-4 group">
                        @if(!empty($post->thumbnail))
                            <img src="{{ Storage::url($post->thumbnail) }}"
                                 class="w-20 h-16 rounded-xl object-cover flex-shrink-0 group-hover:opacity-80 transition"
                                 alt="{{ $post->judul }}"/>
                        @else
                            <div class="w-20 h-16 rounded-xl flex-shrink-0 bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-newspaper text-blue-300"></i>
                            </div>
                        @endif
                        <div>
                            <div class="font-semibold text-sm text-gray-800 group-hover:text-blue-700 leading-tight line-clamp-2">
                                {{ $post->judul }}
                            </div>
                            <div class="text-xs text-gray-400 mt-1">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                {{ $post->tanggal_publish
                                    ? \Carbon\Carbon::parse($post->tanggal_publish)->translatedFormat('d F Y')
                                    : $post->created_at->translatedFormat('d F Y') }}
                            </div>
                        </div>
                    </a>
                    @empty
                    <p class="text-sm text-gray-400 italic">Belum ada berita.</p>
                    @endforelse
                </div>
            </div>

            {{-- Pengumuman --}}
            <div>
                <div class="flex items-center justify-between mb-5">
                    <h3 class="font-bold text-blue-900 text-lg flex items-center gap-2">
                        <i class="fas fa-bullhorn text-yellow-500"></i> Pengumuman
                    </h3>
                    <a href="{{ route('information', ['type' => 'pengumuman']) }}"
                       class="text-xs text-blue-600 hover:underline font-semibold">Lihat semua →</a>
                </div>
                <div class="space-y-2">
                    @forelse($pengumuman as $item)
                    <a href="{{ route('information.detail', $item->slug) }}"
                       class="flex gap-3 items-start group p-3 rounded-xl hover:bg-blue-50 transition">
                        <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            @if($item->is_pinned)
                                <i class="fas fa-thumbtack text-yellow-600 text-sm"></i>
                            @else
                                <i class="fas fa-bullhorn text-yellow-600 text-sm"></i>
                            @endif
                        </div>
                        <div>
                            <div class="font-semibold text-sm text-gray-800 group-hover:text-blue-700 leading-tight line-clamp-2">
                                {{ $item->judul }}
                            </div>
                            <div class="text-xs text-gray-400 mt-1">
                                @if($item->start_date && $item->end_date)
                                    {{ \Carbon\Carbon::parse($item->start_date)->translatedFormat('d M') }}
                                    – {{ \Carbon\Carbon::parse($item->end_date)->translatedFormat('d M Y') }}
                                @else
                                    {{ $item->tanggal_publish
                                        ? \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d F Y')
                                        : $item->created_at->translatedFormat('d F Y') }}
                                @endif
                            </div>
                        </div>
                    </a>
                    @empty
                    <p class="text-sm text-gray-400 italic px-3">Belum ada pengumuman.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ===================== PRESTASI ===================== --}}
@if($prestasi->count())
<section id="prestasi" class="py-20 bg-gradient-to-br from-yellow-50 to-amber-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <div class="text-xs font-bold text-yellow-600 tracking-widest uppercase mb-2">Kebanggaan Kami</div>
            <h2 class="font-display text-3xl md:text-4xl font-black text-blue-900 gold-underline-center">
                Prestasi Terbaru
            </h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($prestasi as $item)
            <a href="{{ route('information.detail', $item->slug) }}"
               class="bg-white rounded-2xl border border-yellow-200 overflow-hidden hover:border-yellow-400 transition shadow-sm hover:shadow-md block group">
                @if(!empty($item->thumbnail))
                    <img src="{{ Storage::url($item->thumbnail) }}"
                         class="w-full h-24 object-cover group-hover:opacity-90 transition"
                         alt="{{ $item->judul }}"/>
                @else
                    <div class="w-full h-24 bg-gradient-to-br from-yellow-50 to-amber-100 flex items-center justify-center">
                        <i class="fas fa-trophy text-2xl text-amber-500"></i>
                    </div>
                @endif
                <div class="p-4 text-center">
                    <div class="font-semibold text-blue-900 text-sm leading-tight line-clamp-2">
                        {{ $item->judul }}
                    </div>
                    <div class="text-xs text-gray-500 mt-1 line-clamp-2">
                        {{ Str::limit(strip_tags($item->isi_konten ?? ''), 60) }}
                    </div>
                    @if($item->tanggal_publish)
                    <span class="mt-3 inline-block bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full font-semibold">
                        {{ \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('Y') }}
                    </span>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('information', ['type' => 'prestasi']) }}"
               class="bg-blue-900 hover:bg-blue-800 text-white font-bold px-7 py-3 rounded-full shadow-lg transition inline-flex items-center gap-2">
                Lihat Semua Prestasi <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
@endif
{{-- ===================== KONTAK ===================== --}}
<section id="kontak" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <div class="text-xs font-bold text-blue-600 tracking-widest uppercase mb-2">Hubungi Kami</div>
            <h2 class="font-display text-3xl md:text-4xl font-black text-blue-900 gold-underline-center">
                Halaman Kontak
            </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

            {{-- Info + Map --}}
            <div class="flex flex-col gap-6">
                <div class="bg-blue-900 rounded-2xl p-7 text-white">
                    <h3 class="font-bold text-xl mb-5 flex items-center gap-2">
                        <i class="fas fa-info-circle text-yellow-300"></i> Informasi Kontak
                    </h3>
                    <div class="space-y-4">
                        @if(!empty($contactInfo->alamat))
                        <div class="flex gap-4 items-start">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-yellow-300"></i>
                            </div>
                            <div>
                                <div class="text-xs text-blue-300 uppercase font-semibold tracking-wider">Alamat</div>
                                <div class="text-sm mt-1">{{ $contactInfo->alamat }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($contactInfo->nomor_telepon))
                        <div class="flex gap-4 items-start">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-phone text-yellow-300"></i>
                            </div>
                            <div>
                                <div class="text-xs text-blue-300 uppercase font-semibold tracking-wider">Telepon</div>
                                <div class="text-sm mt-1">{{ $contactInfo->nomor_telepon }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($contactInfo->email))
                        <div class="flex gap-4 items-start">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-envelope text-yellow-300"></i>
                            </div>
                            <div>
                                <div class="text-xs text-blue-300 uppercase font-semibold tracking-wider">Email</div>
                                <div class="text-sm mt-1">{{ $contactInfo->email }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($contactInfo->website))
                        <div class="flex gap-4 items-start">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-globe text-yellow-300"></i>
                            </div>
                            <div>
                                <div class="text-xs text-blue-300 uppercase font-semibold tracking-wider">Website</div>
                                <div class="text-sm mt-1">{{ $contactInfo->website }}</div>
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Sosial Media --}}
                    @if($socialMedia->count())
                    <div class="mt-6 pt-5 border-t border-white/20">
                        <div class="text-xs text-blue-300 uppercase font-semibold tracking-wider mb-3">Ikuti Kami</div>
                        <div class="flex gap-3 flex-wrap">
                            @foreach($socialMedia as $sm)
                            <a href="{{ $sm->url }}" target="_blank"
                               class="w-9 h-9 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition"
                               title="{{ $sm->nama }}">
                                <i class="fab fa-{{ $sm->icon }} text-white text-sm"></i>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Embed Maps --}}
                <div class="flex-1 flex flex-col gap-3">
                    @if(!empty($contactInfo->embed_maps))
                    <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-200 w-full"
                         style="min-height: 320px;">
                        {!! preg_replace(
                            ['/width="\d+"/', '/height="\d+"/'],
                            ['width="100%"', 'height="100%"'],
                            $contactInfo->embed_maps
                        ) !!}
                    </div>
                    @else
                    <div class="rounded-2xl border border-gray-200 bg-gray-50 flex items-center justify-center"
                         style="min-height: 320px;">
                        <div class="text-center text-gray-400">
                            <i class="fas fa-map-marked-alt text-4xl mb-3"></i>
                            <p class="text-sm">Peta belum dikonfigurasi</p>
                            <p class="text-xs mt-1">Tambahkan embed maps di pengaturan kontak</p>
                        </div>
                    </div>
                    @endif

                    @if(!empty($contactInfo->alamat))
                    <a href="https://maps.google.com/?q={{ urlencode($contactInfo->alamat) }}"
                       target="_blank"
                       class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-3 rounded-xl transition">
                        <i class="fas fa-map-marked-alt"></i> Lihat di Google Maps
                    </a>
                    @endif
                </div>
            </div>

            {{-- Form Kirim Pesan --}}
            <div class="bg-gray-50 rounded-2xl p-8 border border-gray-200">
                <h3 class="font-bold text-blue-900 text-xl mb-2 flex items-center gap-2">
                    <i class="fas fa-paper-plane text-blue-500"></i> Kirim Pesan
                </h3>
                <p class="text-gray-500 text-sm mb-6">Punya pertanyaan? Kami siap membantu Anda.</p>

                {{-- Flash success --}}
                @if(session('success'))
                <div class="mb-5 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl flex items-center gap-2">
                    <i class="fas fa-check-circle text-green-500"></i>
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">
                                Nama Lengkap <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="nama" value="{{ old('nama') }}"
                                   placeholder="Nama Anda"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:border-blue-400 transition {{ $errors->has('nama') ? 'border-red-400' : '' }}"/>
                            @error('nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">Nomor Telepon</label>
                            <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon') }}"
                                   placeholder="0812xxxxxxxx"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:border-blue-400 transition"/>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               placeholder="email@example.com"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:border-blue-400 transition {{ $errors->has('email') ? 'border-red-400' : '' }}"/>
                        @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Subjek</label>
                        <select name="subjek"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:border-blue-400 transition text-gray-600">
                            <option value="">Pilih subjek pesan</option>
                            <option value="Informasi Sekolah"  {{ old('subjek') == 'Informasi Sekolah'  ? 'selected' : '' }}>Informasi Sekolah</option>
                            <option value="Kegiatan Sekolah"  {{ old('subjek') == 'Kegiatan Sekolah'  ? 'selected' : '' }}>Kegiatan Sekolah</option>
                            <option value="Prestasi Akademik" {{ old('subjek') == 'Prestasi Akademik' ? 'selected' : '' }}>Prestasi Akademik</option>
                            <option value="Kerjasama"         {{ old('subjek') == 'Kerjasama'         ? 'selected' : '' }}>Kerjasama</option>
                            <option value="Lainnya"           {{ old('subjek') == 'Lainnya'           ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">
                            Pesan <span class="text-red-400">*</span>
                        </label>
                        <textarea name="isi_pesan" rows="5"
                                  placeholder="Tulis pesan Anda di sini..."
                                  class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:border-blue-400 transition resize-none {{ $errors->has('isi_pesan') ? 'border-red-400' : '' }}">{{ old('isi_pesan') }}</textarea>
                        @error('isi_pesan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="w-full bg-blue-900 hover:bg-blue-800 text-white font-bold py-3 rounded-xl transition shadow-lg flex items-center justify-center gap-2 active:scale-95">
                        <i class="fas fa-paper-plane"></i> Kirim Pesan
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