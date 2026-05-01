@extends('layouts.app')

@section('content')

    {{-- Breadcrumb --}}
    <div class="pt-28 pb-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <div class="text-xs text-gray-400 mb-2 flex items-center justify-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-gray-600 transition">Beranda</a>
            <i class="fas fa-chevron-right text-[9px] text-gray-300"></i>
            <span class="text-gray-500">Kontak</span>
        </div>
        <h1 class="text-2xl font-black text-gray-900">Hubungi Kami</h1>
        <p class="text-sm text-gray-400 mt-1">Sampaikan pertanyaan atau pesan Anda kepada kami</p>
    </div>
</div>

    <div class="pb-16 bg-gray-50 pt-6">
        <div class="max-w-7xl mx-auto px-4">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- ── Kolom Kiri: Info + Maps ── --}}
                <div class="flex flex-col gap-5">

                    {{-- Info Kontak --}}
                    <div class="bg-blue-900 rounded-2xl p-7 text-white">
                        <h3 class="font-bold text-lg mb-5 flex items-center gap-2">
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
                                    <div class="text-sm mt-1 leading-relaxed">{{ $contactInfo->alamat }}</div>
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
                                    <a href="tel:{{ $contactInfo->nomor_telepon }}"
                                       class="text-sm mt-1 block hover:text-yellow-300 transition">
                                        {{ $contactInfo->nomor_telepon }}
                                    </a>
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
                                    <a href="mailto:{{ $contactInfo->email }}"
                                       class="text-sm mt-1 block hover:text-yellow-300 transition">
                                        {{ $contactInfo->email }}
                                    </a>
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
                                    <a href="{{ $contactInfo->website }}" target="_blank"
                                       class="text-sm mt-1 block hover:text-yellow-300 transition">
                                        {{ $contactInfo->website }}
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>

                        {{-- Sosial Media --}}
                        @if(!empty($socialMedia) && $socialMedia->count())
                        <div class="mt-6 pt-5 border-t border-white/20">
                            <div class="text-xs text-blue-300 uppercase font-semibold tracking-wider mb-3">Ikuti Kami</div>
                            <div class="flex gap-3 flex-wrap">
                                @php
                                    $socialIcons = [
                                        'facebook'  => 'fab fa-facebook-f',
                                        'instagram' => 'fab fa-instagram',
                                        'youtube'   => 'fab fa-youtube',
                                        'twitter'   => 'fab fa-twitter',
                                        'tiktok'    => 'fab fa-tiktok',
                                    ];
                                @endphp
                                @foreach($socialMedia as $sm)
                                <a href="{{ $sm->url }}" target="_blank" rel="noopener"
                                   class="w-9 h-9 bg-white/10 hover:bg-white/25 rounded-full flex items-center justify-center transition"
                                   title="{{ $sm->nama }}">
                                    <i class="{{ $socialIcons[strtolower($sm->icon ?? '')] ?? 'fas fa-link' }} text-white text-sm"></i>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Maps --}}
                    @if(!empty($contactInfo->embed_maps))
                    <div class="flex flex-col gap-3 flex-grow">
                        <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-100 flex-grow"
                             style="min-height: 300px;">
                            {!! preg_replace(
                                ['/width="\d+"/', '/height="\d+"/'],
                                ['width="100%"', 'height="100%"'],
                                $contactInfo->embed_maps
                            ) !!}
                        </div>
                        @if(!empty($contactInfo->alamat))
                        <a href="https://maps.google.com/?q={{ urlencode($contactInfo->alamat) }}"
                           target="_blank"
                           class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-3 rounded-xl transition">
                            <i class="fas fa-map-marked-alt"></i> Lihat di Google Maps
                        </a>
                        @endif
                    </div>
                    @else
                    <div class="rounded-2xl border border-gray-100 bg-white flex items-center justify-center flex-grow"
                         style="min-height: 200px;">
                        <div class="text-center text-gray-400">
                            <i class="fas fa-map-marked-alt text-3xl mb-2 block"></i>
                            <p class="text-xs">Peta belum dikonfigurasi</p>
                        </div>
                    </div>
                    @endif

                </div>

                {{-- ── Kolom Kanan: Form ── --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 flex flex-col">
                    <h3 class="font-bold text-blue-900 text-lg mb-1 flex items-center gap-2">
                        <i class="fas fa-paper-plane text-blue-500 text-base"></i> Kirim Pesan
                    </h3>
                    <p class="text-gray-400 text-xs mb-6">Punya pertanyaan? Kami siap membantu Anda.</p>

                    @if(session('success'))
                    <div class="mb-5 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-500"></i>
                        {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST" class="flex flex-col flex-grow space-y-4">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                                    Nama Lengkap <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="nama" value="{{ old('nama') }}"
                                       placeholder="Nama Anda"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-blue-400 transition
                                              {{ $errors->has('nama') ? 'border-red-400' : '' }}"/>
                                @error('nama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nomor Telepon</label>
                                <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon') }}"
                                       placeholder="0812xxxxxxxx"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-blue-400 transition"/>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   placeholder="email@example.com"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-blue-400 transition
                                          {{ $errors->has('email') ? 'border-red-400' : '' }}"/>
                            @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Subjek</label>
                            <select name="subjek"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-blue-400 transition text-gray-600">
                                <option value="">Pilih subjek pesan</option>
                                <option value="Informasi Sekolah"  {{ old('subjek') == 'Informasi Sekolah'  ? 'selected' : '' }}>Informasi Sekolah</option>
                                <option value="Kegiatan Sekolah"   {{ old('subjek') == 'Kegiatan Sekolah'   ? 'selected' : '' }}>Kegiatan Sekolah</option>
                                <option value="Prestasi Akademik"  {{ old('subjek') == 'Prestasi Akademik'  ? 'selected' : '' }}>Prestasi Akademik</option>
                                <option value="Kerjasama"          {{ old('subjek') == 'Kerjasama'          ? 'selected' : '' }}>Kerjasama</option>
                                <option value="Lainnya"            {{ old('subjek') == 'Lainnya'            ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        <div class="flex flex-col flex-grow">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                                Pesan <span class="text-red-400">*</span>
                            </label>
                            <textarea name="isi_pesan"
                                      placeholder="Tulis pesan Anda di sini..."
                                      class="w-full flex-grow border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-blue-400 transition resize-none
                                             {{ $errors->has('isi_pesan') ? 'border-red-400' : '' }}"
                                      style="min-height: 120px;">{{ old('isi_pesan') }}</textarea>
                            @error('isi_pesan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                                class="w-full bg-blue-900 hover:bg-blue-800 text-white font-bold py-3 rounded-xl transition flex items-center justify-center gap-2 active:scale-95">
                            <i class="fas fa-paper-plane text-sm"></i> Kirim Pesan
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection