{{--
    Footer SMPN 3 Ajibarang — Deep Teal / #111
--}}

@php
    $infoLinks = [
        ['label' => 'Berita',       'route' => 'information', 'params' => ['type' => 'berita']],
        ['label' => 'Pengumuman',   'route' => 'information', 'params' => ['type' => 'pengumuman']],
        ['label' => 'Prestasi',     'route' => 'information', 'params' => ['type' => 'prestasi']],
    ];

    $socialIcons = [
        'facebook'  => ['class' => 'fab fa-facebook-f'],
        'instagram' => ['class' => 'fab fa-instagram'],
        'youtube'   => ['class' => 'fab fa-youtube'],
        'twitter'   => ['class' => 'fab fa-twitter'],
        'tiktok'    => ['class' => 'fab fa-tiktok'],
    ];
@endphp

<footer class="bg-[#111111] text-white pt-14 pb-0">
    <div class="max-w-7xl mx-auto px-6 md:px-10">

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 mb-12">

            {{-- ── Kolom 1: Brand --}}
            <div class="col-span-2 lg:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center gap-3 mb-5">
                    @if(!empty($settings->logo))
                        <img src="{{ Storage::url($settings->logo) }}"
                             class="w-10 h-10 object-contain" alt="Logo"/>
                    @else
                        <div class="w-10 h-10 rounded-full bg-[#0d7377] flex items-center justify-center font-bold text-white text-xs">S3</div>
                    @endif
                    <div>
                        <div class="font-bold text-sm tracking-wide text-white">{{ strtoupper($settings->nama_sekolah ?? 'SMPN 3 AJIBARANG') }}</div>
                        <div class="text-[#14a5ab] text-xs font-medium mt-0.5">Sekolah Adiwiyata</div>
                    </div>
                </a>
                <p class="text-white/50 text-sm leading-relaxed">
                    {{ $settings->deskripsi_hero ?? 'Berkomitmen mencetak generasi yang berkarakter, berprestasi, dan peduli lingkungan.' }}
                </p>

                {{-- Sosial Media --}}
                @if(!empty($socialMedia) && $socialMedia->count())
                    <div class="flex gap-2.5 mt-5">
                        @foreach($socialMedia->where('is_active', true)->sortBy('order') as $sm)
                            @php
                                $key  = strtolower($sm->icon ?? '');
                                $icon = $socialIcons[$key] ?? ['class' => 'fas fa-link'];
                            @endphp
                            <a href="{{ $sm->url }}" target="_blank" rel="noopener"
                               class="w-9 h-9 bg-white/8 hover:bg-[#0d7377] rounded-lg flex items-center justify-center transition-all duration-200"
                               title="{{ $sm->nama }}">
                                <i class="{{ $icon['class'] }} text-sm text-white/60 hover:text-white"></i>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="flex gap-2.5 mt-5">
                        <a href="#" class="w-9 h-9 bg-white/8 hover:bg-[#0d7377] rounded-lg flex items-center justify-center transition"><i class="fab fa-facebook-f text-sm text-white/60"></i></a>
                        <a href="#" class="w-9 h-9 bg-white/8 hover:bg-[#0d7377] rounded-lg flex items-center justify-center transition"><i class="fab fa-instagram text-sm text-white/60"></i></a>
                        <a href="#" class="w-9 h-9 bg-white/8 hover:bg-[#0d7377] rounded-lg flex items-center justify-center transition"><i class="fab fa-youtube text-sm text-white/60"></i></a>
                    </div>
                @endif
            </div>

            {{-- ── Kolom 2: Menu --}}
            <div>
                <h4 class="font-semibold text-xs uppercase tracking-widest text-[#14a5ab] mb-5">Menu</h4>
                <ul class="space-y-2.5 text-sm text-white/50">

                    <li>
                        <a href="{{ route('home') }}" class="hover:text-white transition-colors duration-200">
                            Beranda
                        </a>
                    </li>

                    <li>
                        <span class="text-white/30 cursor-default">Tentang Kami</span>
                        <ul class="ml-3 mt-1.5 space-y-1.5 text-white/40">
                            <li><a href="{{ route('about.sejarah') }}" class="hover:text-white transition-colors duration-200">Sejarah</a></li>
                            <li><a href="{{ route('about.visi-misi') }}" class="hover:text-white transition-colors duration-200">Visi & Misi</a></li>
                            <li><a href="{{ route('about.struktur-organisasi') }}" class="hover:text-white transition-colors duration-200">Struktur Organisasi</a></li>
                            <li><a href="{{ route('about.pengajar') }}" class="hover:text-white transition-colors duration-200">Pengajar</a></li>
                            <li><a href="{{ route('about.ekstrakurikuler') }}" class="hover:text-white transition-colors duration-200">Ekstrakurikuler</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ route('gallery') }}" class="hover:text-white transition-colors duration-200">Galeri</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors duration-200">Kontak</a></li>

                </ul>
            </div>

            {{-- ── Kolom 3: Informasi --}}
            <div>
                <h4 class="font-semibold text-xs uppercase tracking-widest text-[#14a5ab] mb-5">Informasi</h4>
                <ul class="space-y-2.5 text-sm text-white/50">
                    @foreach($infoLinks as $link)
                        <li>
                            <a href="{{ route($link['route'], $link['params']) }}"
                               class="hover:text-white transition-colors duration-200">
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                {{-- Visitor Counter --}}
                <div class="mt-8">
                    <h4 class="font-semibold text-xs uppercase tracking-widest text-[#14a5ab] mb-4">Statistik Pengunjung</h4>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-users text-[#0d7377] text-base"></i>
                        <div>
                            <div class="text-white/40 text-xs">Total Pengunjung</div>
                            <div class="text-[#14a5ab] font-bold text-lg tabular-nums">
                                {{ number_format($visitorStats->total ?? 0) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Kolom 4: Kontak --}}
            <div class="col-span-2 lg:col-span-1">
                <h4 class="font-semibold text-xs uppercase tracking-widest text-[#14a5ab] mb-5">Hubungi Kami</h4>
                <div class="text-sm text-white/50 space-y-3.5">

                    @if(!empty($contactInfo->alamat))
                        <div class="flex items-start gap-2.5">
                            <i class="fas fa-map-marker-alt text-[#0d7377] text-sm mt-0.5 w-4 flex-shrink-0"></i>
                            <span class="leading-relaxed">{{ $contactInfo->alamat }}</span>
                        </div>
                    @endif

                    @if(!empty($contactInfo->nomor_telepon))
                        <div class="flex items-center gap-2.5">
                            <i class="fas fa-phone text-[#0d7377] text-sm w-4 flex-shrink-0"></i>
                            <a href="tel:{{ $contactInfo->nomor_telepon }}" class="hover:text-white transition-colors duration-200">
                                {{ $contactInfo->nomor_telepon }}
                            </a>
                        </div>
                    @endif

                    @if(!empty($contactInfo->email))
                        <div class="flex items-center gap-2.5">
                            <i class="fas fa-envelope text-[#0d7377] text-sm w-4 flex-shrink-0"></i>
                            <a href="mailto:{{ $contactInfo->email }}" class="hover:text-white transition-colors duration-200 break-all">
                                {{ $contactInfo->email }}
                            </a>
                        </div>
                    @endif

                    @if(empty($contactInfo))
                        <div class="flex items-start gap-2.5">
                            <i class="fas fa-map-marker-alt text-[#0d7377] text-sm mt-0.5 w-4 flex-shrink-0"></i>
                            <span class="leading-relaxed">Jl. Raya Ajibarang Timur No.63, Banyumas</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="fas fa-envelope text-[#0d7377] text-sm w-4 flex-shrink-0"></i>
                            <span>smpn3ajibarang@gmail.com</span>
                        </div>
                    @endif

                </div>
            </div>

        </div>

        {{-- ── Copyright Bar ── --}}
        <div class="border-t border-white/8 py-5 flex items-center justify-center text-xs text-white/30">
            <div>© {{ date('Y') }} <span class="text-white/50">{{ $settings->nama_sekolah ?? 'SMPN 3 Ajibarang' }}</span>. All Rights Reserved.</div>
        </div>

    </div>
</footer>
