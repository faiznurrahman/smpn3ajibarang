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

<footer class="bg-[#070e2b] text-white pt-16 pb-6">
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
                        <div class="font-black text-sm tracking-wide">{{ strtoupper($settings->nama_sekolah ?? 'SMPN 3 AJIBARANG') }}</div>
                        <div class="text-yellow-300 text-xs font-medium">Sekolah Adiwiyata</div>
                    </div>
                </a>
                <p class="text-blue-300 text-sm leading-relaxed">
                    {{ $settings->deskripsi_hero ?? 'Berkomitmen mencetak generasi yang berkarakter, berprestasi, dan peduli lingkungan.' }}
                </p>

                {{-- Sosial Media --}}
                @if(!empty($socialMedia) && $socialMedia->count())
                    <div class="flex gap-3 mt-5">
                        @foreach($socialMedia->where('is_active', true)->sortBy('order') as $sm)
                            @php
                                $key   = strtolower($sm->icon ?? '');
                                $icon  = $socialIcons[$key] ?? ['class' => 'fas fa-link', 'hover' => 'hover:bg-blue-500'];
                            @endphp
                            <a href="{{ $sm->url }}" target="_blank" rel="noopener"
                               class="w-9 h-9 bg-white/10 {{ $icon['hover'] }} rounded-full flex items-center justify-center transition"
                               title="{{ $sm->nama }}">
                                <i class="{{ $icon['class'] }} text-sm"></i>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="flex gap-3 mt-5">
                        <a href="#" class="w-9 h-9 bg-white/10 hover:bg-blue-500 rounded-full flex items-center justify-center transition"><i class="fab fa-facebook-f text-sm"></i></a>
                        <a href="#" class="w-9 h-9 bg-white/10 hover:bg-pink-500 rounded-full flex items-center justify-center transition"><i class="fab fa-instagram text-sm"></i></a>
                        <a href="#" class="w-9 h-9 bg-white/10 hover:bg-red-500 rounded-full flex items-center justify-center transition"><i class="fab fa-youtube text-sm"></i></a>
                    </div>
                @endif
            </div>

            {{-- ── Kolom 2: Menu --}}
            <div>
                <h4 class="font-bold text-xs uppercase tracking-widest text-yellow-300 mb-5">Menu</h4>
                <ul class="space-y-2.5 text-sm text-blue-300">

                    <li>
                        <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-[9px] text-yellow-400/60"></i>
                            Beranda
                        </a>
                    </li>

                    {{-- Tentang Kami + Submenu --}}
                    <li>
                        <span class="flex items-center gap-2 text-white/80 cursor-default">
                            <i class="fas fa-chevron-right text-[9px] text-yellow-400/60"></i>
                            Tentang Kami
                        </span>
                        <ul class="ml-4 mt-1.5 space-y-1.5 text-blue-400">
                            <li>
                                <a href="{{ route('about.sejarah') }}" class="hover:text-white transition flex items-center gap-2">
                                    <i class="fas fa-minus text-[8px] text-yellow-400/40"></i> Sejarah
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('about.visi-misi') }}" class="hover:text-white transition flex items-center gap-2">
                                    <i class="fas fa-minus text-[8px] text-yellow-400/40"></i> Visi & Misi
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('about.struktur-organisasi') }}" class="hover:text-white transition flex items-center gap-2">
                                    <i class="fas fa-minus text-[8px] text-yellow-400/40"></i> Struktur Organisasi
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('about.pengajar') }}" class="hover:text-white transition flex items-center gap-2">
                                    <i class="fas fa-minus text-[8px] text-yellow-400/40"></i> Pengajar
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('about.ekstrakurikuler') }}" class="hover:text-white transition flex items-center gap-2">
                                    <i class="fas fa-minus text-[8px] text-yellow-400/40"></i> Ekstrakurikuler
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ route('gallery') }}" class="hover:text-white transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-[9px] text-yellow-400/60"></i>
                            Galeri
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="hover:text-white transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-[9px] text-yellow-400/60"></i>
                            Kontak
                        </a>
                    </li>

                </ul>
            </div>

            {{-- ── Kolom 3: Informasi --}}
            <div>
                <h4 class="font-bold text-xs uppercase tracking-widest text-yellow-300 mb-5">Informasi</h4>
                <ul class="space-y-2.5 text-sm text-blue-300">
                    @foreach($infoLinks as $link)
                        <li>
                            <a href="{{ route($link['route'], $link['params']) }}"
                               class="hover:text-white transition flex items-center gap-2">
                                <i class="fas fa-chevron-right text-[9px] text-yellow-400/60"></i>
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- ── Kolom 4: Kontak --}}
            <div>
                <h4 class="font-bold text-xs uppercase tracking-widest text-yellow-300 mb-5">Hubungi Kami</h4>
                <div class="text-sm text-blue-300 space-y-3">

                    @if(!empty($contactInfo->alamat))
                        <div class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt text-yellow-300 w-4 mt-0.5 flex-shrink-0"></i>
                            <span class="leading-relaxed">{{ $contactInfo->alamat }}</span>
                        </div>
                    @endif

                    @if(!empty($contactInfo->nomor_telepon))
                        <div class="flex items-center gap-3">
                            <i class="fas fa-phone text-yellow-300 w-4 flex-shrink-0"></i>
                            <a href="tel:{{ $contactInfo->nomor_telepon }}" class="hover:text-white transition">
                                {{ $contactInfo->nomor_telepon }}
                            </a>
                        </div>
                    @endif

                    @if(!empty($contactInfo->email))
                        <div class="flex items-center gap-3">
                            <i class="fas fa-envelope text-yellow-300 w-4 flex-shrink-0"></i>
                            <a href="mailto:{{ $contactInfo->email }}" class="hover:text-white transition">
                                {{ $contactInfo->email }}
                            </a>
                        </div>
                    @endif

                    @if(empty($contactInfo))
                        <div class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt text-yellow-300 w-4 mt-0.5 flex-shrink-0"></i>
                            <span>Jl. Raya Ajibarang Timur No.63, Banyumas</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-envelope text-yellow-300 w-4 flex-shrink-0"></i>
                            <span>smpn3ajibarang@gmail.com</span>
                        </div>
                    @endif

                </div>
            </div>

        </div>

        {{-- ── Copyright Bar ── --}}
        <div class="border-t border-white/10 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-sm text-blue-400">
            <div>© {{ date('Y') }} {{ $settings->nama_sekolah ?? 'SMPN 3 Ajibarang' }}. All Rights Reserved.</div>
            <div class="flex items-center gap-1">
                Dibuat dengan <i class="fas fa-heart text-red-400 mx-1 text-xs"></i> untuk Pendidikan Indonesia
            </div>
        </div>

    </div>
</footer>