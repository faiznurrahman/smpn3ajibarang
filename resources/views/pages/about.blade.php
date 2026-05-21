@extends('layouts.app')

@section('content')

{{-- ===================== PAGE HERO ===================== --}}
<section class="relative py-24 flex items-center justify-center text-center overflow-hidden"
    style="background-image: linear-gradient(to bottom, rgba(13,43,107,0.82) 0%, rgba(13,43,107,0.70) 60%, rgba(13,43,107,0.92) 100%),
           url('{{ !empty($settings->background_hero) ? Storage::url($settings->background_hero) : 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=1400&q=80' }}');
           background-size: cover; background-position: center;">
    <div class="anim-fade-up opacity-0 relative z-10">
        <div class="inline-block bg-yellow-400 text-blue-900 text-xs font-bold px-4 py-1.5 rounded-full mb-4 tracking-widest uppercase shadow">
            Profil Sekolah
        </div>
        <h1 class="text-white text-4xl md:text-6xl font-black leading-tight drop-shadow-lg"
            style="font-family: 'Oswald', sans-serif;">
            TENTANG KAMI
        </h1>
        <p class="mt-3 text-blue-100 text-base max-w-lg mx-auto">
            Mengenal lebih dekat {{ $settings->judul_hero ?? 'SMPN 3 Ajibarang' }}
        </p>
        <div class="mt-5 text-sm text-blue-200 flex items-center justify-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-yellow-300 transition">Beranda</a>
            <i class="fas fa-chevron-right text-xs text-blue-400"></i>
            <span class="text-yellow-300 font-semibold">Tentang</span>
        </div>
    </div>
</section>

{{-- ===================== MAIN CONTENT + SIDEBAR ===================== --}}
<div class="max-w-7xl mx-auto px-4 py-16">
    <div class="flex flex-col lg:flex-row gap-10">

        {{-- ===== MAIN CONTENT (kiri) ===== --}}
        <div class="flex-1 min-w-0">

            {{-- PROFIL SEKOLAH --}}
            @if(!empty($profile))
            <section id="profil" class="mb-16 anim-fade-up opacity-0">
                <div class="text-xs font-bold text-blue-600 tracking-widest uppercase mb-2">Sejarah & Profil</div>
                <h2 class="font-display text-2xl md:text-3xl font-black text-blue-900 gold-underline mb-6">
                    Profil Sekolah
                </h2>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-7">
                    <h3 class="font-bold text-blue-900 text-base mb-3 flex items-center gap-2">
                        <i class="fas fa-landmark text-blue-400"></i> Sejarah Singkat
                    </h3>
                    <div class="text-gray-600 text-sm leading-relaxed">
                        {!! $profile->sejarah !!}
                    </div>
                </div>
            </section>

            {{-- VISI & MISI --}}
            <section id="visi-misi" class="mb-16 anim-fade-up opacity-0">
                <div class="text-xs font-bold text-blue-600 tracking-widest uppercase mb-2">Arah & Tujuan</div>
                <h2 class="font-display text-2xl md:text-3xl font-black text-blue-900 gold-underline mb-6">
                    Visi & Misi
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- Visi --}}
                    <div class="bg-blue-900 rounded-2xl p-7 text-white">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-yellow-400 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-eye text-blue-900"></i>
                            </div>
                            <h3 class="font-bold text-lg" style="font-family: 'Oswald', sans-serif;">VISI</h3>
                        </div>
                        <div class="text-blue-100 text-sm leading-relaxed">
                            {!! $profile->visi !!}
                        </div>
                    </div>
                    {{-- Misi --}}
                    <div class="bg-white rounded-2xl border border-blue-100 shadow-sm p-7">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-bullseye text-blue-600"></i>
                            </div>
                            <h3 class="font-bold text-blue-900 text-lg" style="font-family: 'Oswald', sans-serif;">MISI</h3>
                        </div>
                        <div class="text-gray-600 text-sm leading-relaxed">
                            {!! $profile->misi !!}
                        </div>
                    </div>
                </div>
            </section>
            @endif

            {{-- STRUKTUR ORGANISASI --}}
            @if($structures->count())
            <section id="struktur" class="mb-16 anim-fade-up opacity-0">
                <div class="text-xs font-bold text-blue-600 tracking-widest uppercase mb-2">Kepengurusan</div>
                <h2 class="font-display text-2xl md:text-3xl font-black text-blue-900 gold-underline mb-6">
                    Struktur Organisasi
                </h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach($structures as $structure)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden text-center hover:shadow-md transition">
                        @if(!empty($structure->image))
                            <img src="{{ Storage::url($structure->image) }}"
                                 alt="{{ $structure->title }}"
                                 loading="lazy"
                                 class="w-full h-36 object-cover"/>
                        @else
                            <div class="w-full h-36 bg-blue-50 flex items-center justify-center">
                                <i class="fas fa-user text-blue-200 text-4xl"></i>
                            </div>
                        @endif
                        <div class="p-4">
                            <div class="font-semibold text-blue-900 text-sm leading-tight">{{ $structure->title }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            {{-- TENAGA PENGAJAR --}}
            @if($teachers->count())
            <section id="guru" class="mb-16 anim-fade-up opacity-0">
                <div class="text-xs font-bold text-blue-600 tracking-widest uppercase mb-2">Tim Pendidik</div>
                <h2 class="font-display text-2xl md:text-3xl font-black text-blue-900 gold-underline mb-6">
                    Tenaga Pengajar & Staff
                </h2>

                {{-- Tab Guru / Staff --}}
                <div class="flex gap-2 mb-6">
                    <button onclick="filterTeacher('guru')" id="tab-guru"
                        class="tab-teacher-btn px-5 py-2 rounded-full text-sm font-bold bg-blue-900 text-white transition">
                        <i class="fas fa-chalkboard-teacher mr-1"></i> Guru
                    </button>
                    <button onclick="filterTeacher('staff')" id="tab-staff"
                        class="tab-teacher-btn px-5 py-2 rounded-full text-sm font-bold bg-gray-100 text-gray-600 hover:bg-gray-200 transition">
                        <i class="fas fa-users mr-1"></i> Staff
                    </button>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4" id="teacherGrid">
                    @foreach($teachers as $teacher)
                    <div class="teacher-item bg-white rounded-2xl shadow-sm border border-gray-100 pt-5 pb-4 px-3 text-center hover:shadow-md transition"
                         data-jenis="{{ $teacher->jenis }}">
                        @if(!empty($teacher->foto))
                            <div class="flex justify-center mb-3">
                                <img src="{{ Storage::url($teacher->foto) }}"
                                     class="w-16 h-16 rounded-full object-cover border-4 border-blue-100"
                                     loading="lazy"
                                     alt="{{ $teacher->nama }}"/>
                            </div>
                        @else
                            <div class="flex justify-center mb-3">
                                <div class="w-16 h-16 rounded-full border-4 border-blue-100 bg-blue-50 flex items-center justify-center">
                                    <i class="fas fa-user text-blue-300 text-xl"></i>
                                </div>
                            </div>
                        @endif
                        <div class="font-bold text-blue-900 text-xs leading-tight">{{ $teacher->nama }}</div>
                        @if($teacher->jabatan)
                        <div class="text-xs text-yellow-600 font-semibold mt-0.5">{{ $teacher->jabatan }}</div>
                        @endif
                        @if($teacher->mata_pelajaran)
                        <div class="text-xs text-gray-400 mt-1">{{ $teacher->mata_pelajaran }}</div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            {{-- EKSTRAKULIKULER --}}
            @if($extracurriculars->count())
            <section id="ekskul" class="mb-6 anim-fade-up opacity-0">
                <div class="text-xs font-bold text-blue-600 tracking-widest uppercase mb-2">Kegiatan Siswa</div>
                <h2 class="font-display text-2xl md:text-3xl font-black text-blue-900 gold-underline mb-6">
                    Ekstrakurikuler
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($extracurriculars as $ekskul)
                    <div class="flex gap-4 bg-white rounded-2xl border border-gray-100 shadow-sm p-4 hover:shadow-md transition">
                        @if(!empty($ekskul->gambar))
                            <img src="{{ Storage::url($ekskul->gambar) }}"
                                 class="w-16 h-16 rounded-xl object-cover flex-shrink-0"
                                 loading="lazy"
                                 alt="{{ $ekskul->nama }}"/>
                        @else
                            <div class="w-16 h-16 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-star text-blue-300 text-xl"></i>
                            </div>
                        @endif
                        <div>
                            <div class="font-bold text-blue-900 text-sm">{{ $ekskul->nama }}</div>
                            @if(!empty($ekskul->deskripsi))
                            <div class="text-xs text-gray-500 mt-1 leading-relaxed line-clamp-2">
                                {{ strip_tags($ekskul->deskripsi) }}
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

        </div>{{-- end main --}}

        {{-- ===== SIDEBAR (kanan) ===== --}}
        <aside class="w-full lg:w-80 flex-shrink-0 space-y-6">

            {{-- Widget Pengumuman --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden sticky top-24">
                <div class="bg-yellow-400 px-5 py-4 flex items-center justify-between">
                    <h3 class="font-bold text-blue-900 text-sm flex items-center gap-2">
                        <i class="fas fa-bullhorn"></i> Pengumuman
                    </h3>
                    <a href="{{ route('information', ['type' => 'pengumuman']) }}"
                       class="text-xs text-blue-900 font-semibold hover:underline">Lihat semua →</a>
                </div>
                <div class="divide-y divide-gray-50">
                    @php
                        $pengumuman = \App\Models\Post::where('status', 'published')
                            ->where('type', 'pengumuman')
                            ->orderBy('is_pinned', 'desc')
                            ->orderBy('tanggal_publish', 'desc')
                            ->take(5)
                            ->get();
                    @endphp
                    @forelse($pengumuman as $item)
                    <a href="{{ route('information.detail', $item->slug) }}"
                       class="flex gap-3 items-start px-5 py-4 hover:bg-yellow-50 transition group">
                        <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            @if($item->is_pinned)
                                <i class="fas fa-thumbtack text-yellow-600 text-xs"></i>
                            @else
                                <i class="fas fa-bullhorn text-yellow-600 text-xs"></i>
                            @endif
                        </div>
                        <div>
                            <div class="font-semibold text-xs text-gray-800 group-hover:text-blue-700 leading-snug line-clamp-2">
                                {{ $item->judul }}
                            </div>
                            <div class="text-xs text-gray-400 mt-1">
                                @if($item->start_date && $item->end_date)
                                    {{ \Carbon\Carbon::parse($item->start_date)->translatedFormat('d M') }}
                                    – {{ \Carbon\Carbon::parse($item->end_date)->translatedFormat('d M Y') }}
                                @else
                                    {{ $item->tanggal_publish
                                        ? \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d M Y')
                                        : $item->created_at->translatedFormat('d M Y') }}
                                @endif
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="px-5 py-6 text-center text-gray-400 text-xs italic">
                        Belum ada pengumuman.
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Widget Berita Terbaru --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="bg-blue-900 px-5 py-4 flex items-center justify-between">
                    <h3 class="font-bold text-white text-sm flex items-center gap-2">
                        <i class="fas fa-newspaper text-blue-300"></i> Berita Terbaru
                    </h3>
                    <a href="{{ route('information', ['type' => 'berita']) }}"
                       class="text-xs text-blue-300 hover:text-yellow-300 font-semibold transition">Lihat semua →</a>
                </div>
                <div class="divide-y divide-gray-50">
                    @php
                        $beritaSidebar = \App\Models\Post::where('status', 'published')
                            ->where('type', 'berita')
                            ->orderBy('tanggal_publish', 'desc')
                            ->take(5)
                            ->get();
                    @endphp
                    @forelse($beritaSidebar as $post)
                    <a href="{{ route('information.detail', $post->slug) }}"
                       class="flex gap-3 items-start px-5 py-4 hover:bg-blue-50 transition group">
                        @if(!empty($post->thumbnail))
                            <img src="{{ Storage::url($post->thumbnail) }}"
                                 class="w-14 h-12 rounded-lg object-cover flex-shrink-0"
                                 loading="lazy"
                                 alt="{{ $post->judul }}"/>
                        @else
                            <div class="w-14 h-12 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-newspaper text-blue-200 text-sm"></i>
                            </div>
                        @endif
                        <div>
                            <div class="font-semibold text-xs text-gray-800 group-hover:text-blue-700 leading-snug line-clamp-2">
                                {{ $post->judul }}
                            </div>
                            <div class="text-xs text-gray-400 mt-1">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                {{ $post->tanggal_publish
                                    ? \Carbon\Carbon::parse($post->tanggal_publish)->translatedFormat('d M Y')
                                    : $post->created_at->translatedFormat('d M Y') }}
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="px-5 py-6 text-center text-gray-400 text-xs italic">
                        Belum ada berita.
                    </div>
                    @endforelse
                </div>
            </div>

        </aside>{{-- end sidebar --}}

    </div>
</div>

@endsection

@push('scripts')
<script>
function filterTeacher(jenis) {
    const items = document.querySelectorAll('.teacher-item');
    items.forEach(el => {
        el.style.display = (el.dataset.jenis === jenis) ? '' : 'none';
    });

    document.querySelectorAll('.tab-teacher-btn').forEach(btn => {
        btn.classList.remove('bg-blue-900', 'text-white');
        btn.classList.add('bg-gray-100', 'text-gray-600');
    });

    const active = document.getElementById('tab-' + jenis);
    active.classList.remove('bg-gray-100', 'text-gray-600');
    active.classList.add('bg-blue-900', 'text-white');
}

// default tampilkan guru
filterTeacher('guru');
</script>
@endpush