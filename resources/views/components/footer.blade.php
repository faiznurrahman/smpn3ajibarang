{{--
    Footer SMPN 3 Ajibarang
    Data dari: $settings, $contactInfo, $socialMedia (collection)
--}}

@php
    $infoLinks = [
        ['label' => 'Berita',       'route' => 'information', 'params' => ['type' => 'berita']],
        ['label' => 'Pengumuman',   'route' => 'information', 'params' => ['type' => 'pengumuman']],
        ['label' => 'Prestasi',     'route' => 'information', 'params' => ['type' => 'prestasi']],
    ];

    $socialIcons = [
        'facebook'  => ['class' => 'fab fa-facebook-f',  'hover' => 'hover:bg-blue-500'],
        'instagram' => ['class' => 'fab fa-instagram',   'hover' => 'hover:bg-pink-500'],
        'youtube'   => ['class' => 'fab fa-youtube',     'hover' => 'hover:bg-red-500'],
        'twitter'   => ['class' => 'fab fa-twitter',     'hover' => 'hover:bg-sky-400'],
        'tiktok'    => ['class' => 'fab fa-tiktok',      'hover' => 'hover:bg-gray-600'],
    ];
@endphp

<footer class="bg-[#070e2b] text-white pt-16 pb-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">

            {{-- ── Kolom 1: Brand --}}
            <div>
                <a href="{{ route('home') }}" class="flex items-center gap-3 mb-5">
                    @if(!empty($settings->logo))
                        <img src="{{ Storage::url($settings->logo) }}"
                             class="w-10 h-10 object-contain" alt="Logo"/>
                    @else
                        <div class="w-10 h-10 rounded-full bg-yellow-400 flex items-center justify-center font-black text-blue-900 text-xs">S3</div>
                    @endif
                    <div>
                        <div class="font-black text-sm tracking-wide text-white">{{ strtoupper($settings->nama_sekolah ?? 'SMPN 3 AJIBARANG') }}</div>
                        <div class="text-yellow-400 text-xs font-medium">Sekolah Adiwiyata</div>
                    </div>
                </a>
                <p class="text-slate-400 text-sm leading-relaxed">
                    {{ $settings->deskripsi_hero ?? 'Berkomitmen mencetak generasi yang berkarakter, berprestasi, dan peduli lingkungan.' }}
                </p>

                {{-- Sosial Media --}}
                @if(!empty($socialMedia) && $socialMedia->count())
                    <div class="flex gap-2.5 mt-5">
                        @foreach($socialMedia->where('is_active', true)->sortBy('order') as $sm)
                            @php
                                $key   = strtolower($sm->icon ?? '');
                                $icon  = $socialIcons[$key] ?? ['class' => 'fas fa-link', 'hover' => 'hover:bg-blue-500'];
                            @endphp
                            <a href="{{ $sm->url }}" target="_blank" rel="noopener"
                               class="w-9 h-9 bg-white/5 border border-white/10 {{ $icon['hover'] }} hover:border-transparent rounded-xl flex items-center justify-center transition-all duration-200"
                               title="{{ $sm->nama }}">
                                <i class="{{ $icon['class'] }} text-sm text-slate-300"></i>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="flex gap-2.5 mt-5">
                        <a href="#" class="w-9 h-9 bg-white/5 border border-white/10 hover:bg-blue-500 hover:border-transparent rounded-xl flex items-center justify-center transition-all duration-200"><i class="fab fa-facebook-f text-sm text-slate-300"></i></a>
                        <a href="#" class="w-9 h-9 bg-white/5 border border-white/10 hover:bg-pink-500 hover:border-transparent rounded-xl flex items-center justify-center transition-all duration-200"><i class="fab fa-instagram text-sm text-slate-300"></i></a>
                        <a href="#" class="w-9 h-9 bg-white/5 border border-white/10 hover:bg-red-500 hover:border-transparent rounded-xl flex items-center justify-center transition-all duration-200"><i class="fab fa-youtube text-sm text-slate-300"></i></a>
                    </div>
                @endif
            </div>

            {{-- ── Kolom 2: Menu --}}
            <div>
                <h4 class="font-bold text-xs uppercase tracking-widest text-yellow-400 mb-5 flex items-center gap-2">
                    <span class="w-4 h-px bg-yellow-400/50 inline-block"></span> Menu
                </h4>
                <ul class="space-y-2.5 text-sm text-slate-400">

                    <li>
                        <a href="{{ route('home') }}" class="hover:text-yellow-400 transition-colors duration-200 flex items-center gap-2 group">
                            <i class="fas fa-chevron-right text-[9px] text-yellow-400/40 group-hover:text-yellow-400 transition-colors"></i>
                            Beranda
                        </a>
                    </li>

                    {{-- Tentang Kami + Submenu --}}
                    <li>
                        <span class="flex items-center gap-2 text-slate-300 cursor-default">
                            <i class="fas fa-chevron-right text-[9px] text-yellow-400/40"></i>
                            Tentang Kami
                        </span>
                        <ul class="ml-4 mt-1.5 space-y-1.5 text-slate-500">
                            <li>
                                <a href="{{ route('about.sejarah') }}" class="hover:text-yellow-400 transition-colors duration-200 flex items-center gap-2 group">
                                    <i class="fas fa-minus text-[8px] text-yellow-400/30 group-hover:text-yellow-400/70 transition-colors"></i> Sejarah
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('about.visi-misi') }}" class="hover:text-yellow-400 transition-colors duration-200 flex items-center gap-2 group">
                                    <i class="fas fa-minus text-[8px] text-yellow-400/30 group-hover:text-yellow-400/70 transition-colors"></i> Visi & Misi
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('about.struktur-organisasi') }}" class="hover:text-yellow-400 transition-colors duration-200 flex items-center gap-2 group">
                                    <i class="fas fa-minus text-[8px] text-yellow-400/30 group-hover:text-yellow-400/70 transition-colors"></i> Struktur Organisasi
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('about.pengajar') }}" class="hover:text-yellow-400 transition-colors duration-200 flex items-center gap-2 group">
                                    <i class="fas fa-minus text-[8px] text-yellow-400/30 group-hover:text-yellow-400/70 transition-colors"></i> Pengajar
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('about.ekstrakurikuler') }}" class="hover:text-yellow-400 transition-colors duration-200 flex items-center gap-2 group">
                                    <i class="fas fa-minus text-[8px] text-yellow-400/30 group-hover:text-yellow-400/70 transition-colors"></i> Ekstrakurikuler
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ route('gallery') }}" class="hover:text-yellow-400 transition-colors duration-200 flex items-center gap-2 group">
                            <i class="fas fa-chevron-right text-[9px] text-yellow-400/40 group-hover:text-yellow-400 transition-colors"></i>
                            Galeri
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="hover:text-yellow-400 transition-colors duration-200 flex items-center gap-2 group">
                            <i class="fas fa-chevron-right text-[9px] text-yellow-400/40 group-hover:text-yellow-400 transition-colors"></i>
                            Kontak
                        </a>
                    </li>

                </ul>
            </div>

            {{-- ── Kolom 3: Informasi --}}
            <div>
                <h4 class="font-bold text-xs uppercase tracking-widest text-yellow-400 mb-5 flex items-center gap-2">
                    <span class="w-4 h-px bg-yellow-400/50 inline-block"></span> Informasi
                </h4>
                <ul class="space-y-2.5 text-sm text-slate-400">
                    @foreach($infoLinks as $link)
                        <li>
                            <a href="{{ route($link['route'], $link['params']) }}"
                               class="hover:text-yellow-400 transition-colors duration-200 flex items-center gap-2 group">
                                <i class="fas fa-chevron-right text-[9px] text-yellow-400/40 group-hover:text-yellow-400 transition-colors"></i>
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                {{-- ── Visitor Counter ── --}}
<div class="mt-8">
    <h4 class="font-bold text-xs uppercase tracking-widest text-yellow-400 mb-4 flex items-center gap-2">
        <span class="w-4 h-px bg-yellow-400/50 inline-block"></span> Statistik Pengunjung
    </h4>
    <div class="flex items-center gap-4 bg-white/5 border border-white/8 rounded-xl px-4 py-3">
        <div class="w-10 h-10 bg-yellow-400/10 rounded-lg flex items-center justify-center flex-shrink-0">
            <i class="fas fa-users text-yellow-400 text-sm"></i>
        </div>
        <div>
            <div class="text-white/60 text-xs mb-0.5">Total Pengunjung</div>
            <div class="text-yellow-400 font-black text-xl tabular-nums">
                {{ number_format($visitorStats->total ?? 0) }}
            </div>
        </div>
    </div>
</div>
            </div>

            {{-- ── Kolom 4: Kontak --}}
            <div>
                <h4 class="font-bold text-xs uppercase tracking-widest text-yellow-400 mb-5 flex items-center gap-2">
                    <span class="w-4 h-px bg-yellow-400/50 inline-block"></span> Hubungi Kami
                </h4>
                <div class="text-sm text-slate-400 space-y-3.5">

                    @if(!empty($contactInfo->alamat))
                        <div class="flex items-start gap-3 group">
                            <div class="w-8 h-8 bg-yellow-400/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:bg-yellow-400/20 transition">
                                <i class="fas fa-map-marker-alt text-yellow-400 text-xs"></i>
                            </div>
                            <span class="leading-relaxed pt-1.5">{{ $contactInfo->alamat }}</span>
                        </div>
                    @endif

                    @if(!empty($contactInfo->nomor_telepon))
                        <div class="flex items-center gap-3 group">
                            <div class="w-8 h-8 bg-yellow-400/10 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-yellow-400/20 transition">
                                <i class="fas fa-phone text-yellow-400 text-xs"></i>
                            </div>
                            <a href="tel:{{ $contactInfo->nomor_telepon }}" class="hover:text-yellow-400 transition-colors duration-200">
                                {{ $contactInfo->nomor_telepon }}
                            </a>
                        </div>
                    @endif

                    @if(!empty($contactInfo->email))
                        <div class="flex items-center gap-3 group">
                            <div class="w-8 h-8 bg-yellow-400/10 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-yellow-400/20 transition">
                                <i class="fas fa-envelope text-yellow-400 text-xs"></i>
                            </div>
                            <a href="mailto:{{ $contactInfo->email }}" class="hover:text-yellow-400 transition-colors duration-200 break-all">
                                {{ $contactInfo->email }}
                            </a>
                        </div>
                    @endif

                    @if(empty($contactInfo))
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-yellow-400/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-map-marker-alt text-yellow-400 text-xs"></i>
                            </div>
                            <span class="leading-relaxed pt-1.5">Jl. Raya Ajibarang Timur No.63, Banyumas</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-yellow-400/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-envelope text-yellow-400 text-xs"></i>
                            </div>
                            <span>smpn3ajibarang@gmail.com</span>
                        </div>
                    @endif

                </div>
            </div>

        </div>

        {{-- ── Copyright Bar ── --}}
        <div class="border-t border-white/8 py-5 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
            <div>© {{ date('Y') }} <span class="text-slate-400">{{ $settings->nama_sekolah ?? 'SMPN 3 Ajibarang' }}</span>. All Rights Reserved.</div>
            <div class="flex items-center gap-1">
                Dibuat dengan <i class="fas fa-heart text-red-400 mx-1"></i> untuk Pendidikan Indonesia
            </div>
        </div>

    </div>
</footer>