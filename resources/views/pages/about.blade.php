@extends('layouts.app')

@section('content')

{{-- ── PAGE HERO ── --}}
<section class="relative py-24 flex items-center justify-center text-center overflow-hidden"
    style="background-image: linear-gradient(to bottom, rgba(10,92,96,0.88) 0%, rgba(10,92,96,0.75) 60%, rgba(10,92,96,0.92) 100%),
           url('{{ !empty($settings->background_hero) ? Storage::url($settings->background_hero) : 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=1400&q=80' }}');
           background-size: cover; background-position: center;">
    <div class="anim-fade-up opacity-0 relative z-10">
        <div class="inline-block bg-[#0d7377] text-white text-xs font-medium px-4 py-1.5 rounded-full mb-4 tracking-wide uppercase">
            Profil Sekolah
        </div>
        <h1 class="text-white text-4xl md:text-5xl font-bold leading-tight drop-shadow-sm">
            TENTANG KAMI
        </h1>
        <p class="mt-3 text-white/70 text-base max-w-lg mx-auto">
            Mengenal lebih dekat {{ $settings->judul_hero ?? 'SMPN 3 Ajibarang' }}
        </p>
        <div class="mt-5 text-sm text-white/60 flex items-center justify-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-white/90">Tentang</span>
        </div>
    </div>
</section>

{{-- ── MAIN CONTENT + SIDEBAR ── --}}
<div class="max-w-7xl mx-auto px-4 py-14">
    <div class="flex flex-col lg:flex-row gap-10">

        {{-- MAIN CONTENT --}}
        <div class="flex-1 min-w-0">

            {{-- PROFIL SEKOLAH --}}
            @if(!empty($profile))
            <section id="profil" class="mb-14 anim-fade-up opacity-0">
                <p class="text-xs font-semibold text-[#0d7377] tracking-widest uppercase mb-2">Sejarah & Profil</p>
                <h2 class="text-2xl font-bold text-gray-900 teal-underline mb-6">Profil Sekolah</h2>
                <div class="bg-white rounded-xl border border-gray-100 p-6">
                    <h3 class="font-semibold text-gray-800 text-sm mb-3">Sejarah Singkat</h3>
                    <div class="text-gray-600 text-sm leading-relaxed">
                        {!! $profile->sejarah !!}
                    </div>
                </div>
            </section>

            {{-- VISI & MISI --}}
            <section id="visi-misi" class="mb-14 anim-fade-up opacity-0">
                <p class="text-xs font-semibold text-[#0d7377] tracking-widest uppercase mb-2">Arah & Tujuan</p>
                <h2 class="text-2xl font-bold text-gray-900 teal-underline mb-6">Visi & Misi</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- Visi --}}
                    <div class="bg-[#0d7377] rounded-xl p-6 text-white">
                        <h3 class="font-bold text-base mb-3 text-white">VISI</h3>
                        <div class="text-white/85 text-sm leading-relaxed">
                            {!! $profile->visi !!}
                        </div>
                    </div>
                    {{-- Misi --}}
                    <div class="bg-white rounded-xl border border-gray-100 p-6">
                        <h3 class="font-bold text-[#0d7377] text-base mb-3">MISI</h3>
                        <div class="text-gray-600 text-sm leading-relaxed">
                            {!! $profile->misi !!}
                        </div>
                    </div>
                </div>
            </section>
            @endif

            {{-- STRUKTUR ORGANISASI --}}
            @if($structures->count())
            <section id="struktur" class="mb-14 anim-fade-up opacity-0">
                <p class="text-xs font-semibold text-[#0d7377] tracking-widest uppercase mb-2">Kepengurusan</p>
                <h2 class="text-2xl font-bold text-gray-900 teal-underline mb-6">Struktur Organisasi</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach($structures as $structure)
                    <div class="bg-white rounded-xl border border-gray-100 overflow-hidden text-center hover:border-[#0d7377]/30 transition">
                        @if(!empty($structure->image))
                            <img src="{{ Storage::url($structure->image) }}"
                                 alt="{{ $structure->title }}"
                                 loading="lazy"
                                 class="w-full h-32 object-cover"/>
                        @else
                            <div class="w-full h-32 bg-[#e6f4f4] flex items-center justify-center">
                                <i class="fas fa-user text-[#0d7377]/30 text-3xl"></i>
                            </div>
                        @endif
                        <div class="p-3">
                            <div class="font-medium text-gray-800 text-xs leading-tight">{{ $structure->title }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            {{-- TENAGA PENGAJAR --}}
            @if($teachers->count())
            <section id="guru" class="mb-14 anim-fade-up opacity-0">
                <p class="text-xs font-semibold text-[#0d7377] tracking-widest uppercase mb-2">Tim Pendidik</p>
                <h2 class="text-2xl font-bold text-gray-900 teal-underline mb-6">Tenaga Pengajar & Staff</h2>

                {{-- Tab --}}
                <div class="flex gap-2 mb-6">
                    <button onclick="filterTeacher('guru')" id="tab-guru"
                        class="tab-teacher-btn px-5 py-2 rounded-full text-sm font-medium bg-[#0d7377] text-white transition">
                        Guru
                    </button>
                    <button onclick="filterTeacher('staff')" id="tab-staff"
                        class="tab-teacher-btn px-5 py-2 rounded-full text-sm font-medium bg-gray-100 text-gray-600 hover:bg-gray-200 transition">
                        Staff
                    </button>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4" id="teacherGrid">
                    @foreach($teachers as $teacher)
                    <div class="teacher-item text-center py-5 px-3 rounded-xl hover:bg-[#f9fafb] transition"
                         data-jenis="{{ $teacher->jenis }}">
                        @if(!empty($teacher->foto))
                            <img src="{{ Storage::url($teacher->foto) }}"
                                 class="w-16 h-16 rounded-full object-cover mx-auto"
                                 loading="lazy"
                                 alt="{{ $teacher->nama }}"/>
                        @else
                            <div class="w-16 h-16 rounded-full mx-auto bg-[#e6f4f4] flex items-center justify-center">
                                <span class="text-[#0d7377] font-bold text-lg">{{ mb_substr($teacher->nama, 0, 1) }}</span>
                            </div>
                        @endif
                        <div class="mt-3 font-semibold text-gray-800 text-xs leading-tight">{{ $teacher->nama }}</div>
                        @if($teacher->jabatan)
                        <div class="text-xs text-[#0d7377] font-medium mt-0.5">{{ $teacher->jabatan }}</div>
                        @endif
                        @if($teacher->mata_pelajaran)
                        <div class="text-xs text-gray-400 mt-0.5">{{ $teacher->mata_pelajaran }}</div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            {{-- EKSTRAKURIKULER --}}
            @if($extracurriculars->count())
            <section id="ekskul" class="mb-6 anim-fade-up opacity-0">
                <p class="text-xs font-semibold text-[#0d7377] tracking-widest uppercase mb-2">Kegiatan Siswa</p>
                <h2 class="text-2xl font-bold text-gray-900 teal-underline mb-6">Ekstrakurikuler</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($extracurriculars as $ekskul)
                    <div class="flex gap-4 bg-white rounded-xl border border-gray-100 p-4 hover:border-[#0d7377]/30 transition">
                        @if(!empty($ekskul->gambar))
                            <img src="{{ Storage::url($ekskul->gambar) }}"
                                 class="w-14 h-14 rounded-lg object-cover flex-shrink-0"
                                 loading="lazy"
                                 alt="{{ $ekskul->nama }}"/>
                        @else
                            <div class="w-14 h-14 rounded-lg bg-[#e6f4f4] flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-star text-[#0d7377]/40 text-lg"></i>
                            </div>
                        @endif
                        <div>
                            <div class="font-semibold text-gray-800 text-sm">{{ $ekskul->nama }}</div>
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

        {{-- SIDEBAR --}}
        <aside class="w-full lg:w-72 flex-shrink-0 space-y-5">

            {{-- Widget Pengumuman --}}
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden sticky top-24">
                <div class="bg-[#e6f4f4] px-5 py-4 flex items-center justify-between border-b border-[#0d7377]/10">
                    <h3 class="font-semibold text-[#0d7377] text-sm">Pengumuman</h3>
                    <a href="{{ route('information', ['type' => 'pengumuman']) }}"
                       class="text-xs text-[#0d7377] hover:underline font-medium">Lihat semua →</a>
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
                       class="flex gap-3 items-start px-5 py-4 hover:bg-[#f9fafb] transition group">
                        <div class="w-7 h-7 bg-[#e6f4f4] rounded-md flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas {{ $item->is_pinned ? 'fa-thumbtack' : 'fa-bullhorn' }} text-[#0d7377] text-[9px]"></i>
                        </div>
                        <div>
                            <div class="font-medium text-xs text-gray-700 group-hover:text-[#0d7377] leading-snug line-clamp-2">
                                {{ $item->judul }}
                            </div>
                            <div class="text-[10px] text-gray-400 mt-1">
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
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <div class="px-5 py-4 flex items-center justify-between border-b border-gray-100">
                    <h3 class="font-semibold text-gray-800 text-sm">Berita Terbaru</h3>
                    <a href="{{ route('information', ['type' => 'berita']) }}"
                       class="text-xs text-[#0d7377] hover:underline font-medium">Semua →</a>
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
                       class="flex gap-3 items-start px-5 py-4 hover:bg-[#f9fafb] transition group">
                        @if(!empty($post->thumbnail))
                            <img src="{{ Storage::url($post->thumbnail) }}"
                                 class="w-12 h-10 rounded-lg object-cover flex-shrink-0"
                                 loading="lazy"
                                 alt="{{ $post->judul }}"/>
                        @else
                            <div class="w-12 h-10 rounded-lg bg-[#e6f4f4] flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-newspaper text-[#0d7377]/40 text-xs"></i>
                            </div>
                        @endif
                        <div>
                            <div class="font-medium text-xs text-gray-700 group-hover:text-[#0d7377] leading-snug line-clamp-2">
                                {{ $post->judul }}
                            </div>
                            <div class="text-[10px] text-gray-400 mt-1">
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

        </aside>

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
        btn.classList.remove('bg-[#0d7377]', 'text-white');
        btn.classList.add('bg-gray-100', 'text-gray-600');
    });

    const active = document.getElementById('tab-' + jenis);
    active.classList.remove('bg-gray-100', 'text-gray-600');
    active.classList.add('bg-[#0d7377]', 'text-white');
}

filterTeacher('guru');
</script>
@endpush
