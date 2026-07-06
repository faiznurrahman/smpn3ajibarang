@extends('layouts.app')

@section('content')

    {{-- Breadcrumb --}}
    <div class="pt-28 pb-8 bg-[#f9fafb]">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="text-xs text-gray-400 mb-2 flex items-center justify-center gap-2">
                <a href="{{ route('home') }}" class="hover:text-gray-600 transition">Beranda</a>
                <i class="fas fa-chevron-right text-[9px] text-gray-300"></i>
                <span class="text-gray-500">Kontak</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Hubungi Kami</h1>
            <p class="text-sm text-gray-400 mt-1">Sampaikan pertanyaan atau pesan Anda kepada kami</p>
        </div>
    </div>

    <div class="pb-16 bg-[#f9fafb] pt-6">
        <div class="max-w-7xl mx-auto px-4">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- ── Kolom Kiri: Info + Maps ── --}}
                <div class="flex flex-col gap-5">

                    {{-- Info Kontak --}}
                    <div class="bg-[#0d7377] rounded-2xl p-7 text-white">
                        <h3 class="font-semibold text-base text-white mb-6">Informasi Kontak</h3>
                        <div class="space-y-5">
                            @if(!empty($contactInfo->alamat))
                            <div class="flex gap-3 items-start">
                                <i class="fas fa-map-marker-alt text-[#14a5ab] text-sm mt-0.5 w-4 flex-shrink-0"></i>
                                <div>
                                    <div class="text-[10px] text-white/50 uppercase font-medium tracking-wider">Alamat</div>
                                    <div class="text-sm text-white/90 mt-0.5 leading-relaxed">{{ $contactInfo->alamat }}</div>
                                </div>
                            </div>
                            @endif

                            @if(!empty($contactInfo->nomor_telepon))
                            <div class="flex gap-3 items-start">
                                <i class="fas fa-phone text-[#14a5ab] text-sm mt-0.5 w-4 flex-shrink-0"></i>
                                <div>
                                    <div class="text-[10px] text-white/50 uppercase font-medium tracking-wider">Telepon</div>
                                    <a href="tel:{{ $contactInfo->nomor_telepon }}"
                                       class="text-sm text-white/90 hover:text-white transition mt-0.5 block">
                                        {{ $contactInfo->nomor_telepon }}
                                    </a>
                                </div>
                            </div>
                            @endif

                            @if(!empty($contactInfo->email))
                            <div class="flex gap-3 items-start">
                                <i class="fas fa-envelope text-[#14a5ab] text-sm mt-0.5 w-4 flex-shrink-0"></i>
                                <div>
                                    <div class="text-[10px] text-white/50 uppercase font-medium tracking-wider">Email</div>
                                    <a href="mailto:{{ $contactInfo->email }}"
                                       class="text-sm text-white/90 hover:text-white transition mt-0.5 block">
                                        {{ $contactInfo->email }}
                                    </a>
                                </div>
                            </div>
                            @endif

                            @if(!empty($contactInfo->website))
                            <div class="flex gap-3 items-start">
                                <i class="fas fa-globe text-[#14a5ab] text-sm mt-0.5 w-4 flex-shrink-0"></i>
                                <div>
                                    <div class="text-[10px] text-white/50 uppercase font-medium tracking-wider">Website</div>
                                    <a href="{{ $contactInfo->website }}" target="_blank"
                                       class="text-sm text-white/90 hover:text-white transition mt-0.5 block">
                                        {{ $contactInfo->website }}
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>

                        {{-- Sosial Media --}}
                        @if(!empty($socialMedia) && $socialMedia->count())
                        <div class="mt-6 pt-5 border-t border-white/10">
                            <div class="text-[10px] text-white/50 uppercase font-medium tracking-wider mb-3">Ikuti Kami</div>
                            <div class="flex gap-2 flex-wrap">
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
                                   class="w-9 h-9 bg-white/10 hover:bg-white/25 rounded-lg flex items-center justify-center transition"
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
                        <div class="rounded-xl overflow-hidden border border-gray-100 flex-grow" style="min-height: 300px;">
                            {!! preg_replace(
                                ['/width="\d+"/', '/height="\d+"/'],
                                ['width="100%"', 'height="100%"'],
                                $contactInfo->embed_maps
                            ) !!}
                        </div>
                        @if(!empty($contactInfo->alamat))
                        <a href="https://maps.google.com/?q={{ urlencode($contactInfo->alamat) }}"
                           target="_blank"
                           class="flex items-center justify-center gap-2 bg-[#0d7377] hover:bg-[#0a5c60] text-white font-medium text-sm py-3 rounded-xl transition">
                            <i class="fas fa-map-marked-alt"></i> Lihat di Google Maps
                        </a>
                        @endif
                    </div>
                    @else
                    <div class="rounded-xl border border-gray-100 bg-white flex items-center justify-center flex-grow" style="min-height: 200px;">
                        <div class="text-center text-gray-400">
                            <i class="fas fa-map-marked-alt text-3xl mb-2 block"></i>
                            <p class="text-xs">Peta belum dikonfigurasi</p>
                        </div>
                    </div>
                    @endif

                </div>

                {{-- ── Kolom Kanan: Form ── --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-8 flex flex-col">
                    <h3 class="font-semibold text-gray-900 text-base mb-1">Kirim Pesan</h3>
                    <p class="text-gray-400 text-xs mb-6">Punya pertanyaan? Kami siap membantu Anda.</p>

                    @if(session('success'))
                    <div class="mb-5 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-500"></i>
                        {{ session('success') }}
                    </div>
                    @endif

                    @error('throttle')
                    <div class="mb-5 bg-orange-50 border border-orange-200 text-orange-700 text-sm px-4 py-3 rounded-xl flex items-center gap-2">
                        <i class="fas fa-clock text-orange-500"></i>
                        {{ $message }}
                    </div>
                    @enderror

                    <form action="{{ route('contact.send') }}" method="POST" id="contact-form" class="flex flex-col flex-grow space-y-4">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">
                                    Nama Lengkap <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="nama" value="{{ old('nama') }}"
                                       placeholder="Nama Anda"
                                       class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-[#0d7377] transition
                                              {{ $errors->has('nama') ? 'border-red-400' : '' }}"/>
                                @error('nama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Nomor Telepon</label>
                                <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon') }}"
                                       placeholder="0812xxxxxxxx"
                                       class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-[#0d7377] transition"/>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   placeholder="email@example.com"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-[#0d7377] transition
                                          {{ $errors->has('email') ? 'border-red-400' : '' }}"/>
                            @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Subjek</label>
                            <select name="subjek"
                                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-[#0d7377] transition text-gray-600">
                                <option value="">Pilih subjek pesan</option>
                                <option value="Informasi Sekolah"  {{ old('subjek') == 'Informasi Sekolah'  ? 'selected' : '' }}>Informasi Sekolah</option>
                                <option value="Kegiatan Sekolah"   {{ old('subjek') == 'Kegiatan Sekolah'   ? 'selected' : '' }}>Kegiatan Sekolah</option>
                                <option value="Prestasi Akademik"  {{ old('subjek') == 'Prestasi Akademik'  ? 'selected' : '' }}>Prestasi Akademik</option>
                                <option value="Kerjasama"          {{ old('subjek') == 'Kerjasama'          ? 'selected' : '' }}>Kerjasama</option>
                                <option value="Lainnya"            {{ old('subjek') == 'Lainnya'            ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        <div class="flex flex-col flex-grow">
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">
                                Pesan <span class="text-red-400">*</span>
                            </label>
                            <textarea name="isi_pesan"
                                      placeholder="Tulis pesan Anda di sini..."
                                      class="w-full flex-grow border border-gray-200 rounded-lg px-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-[#0d7377] transition resize-none
                                             {{ $errors->has('isi_pesan') ? 'border-red-400' : '' }}"
                                      style="min-height: 120px;">{{ old('isi_pesan') }}</textarea>
                            @error('isi_pesan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" id="contact-submit"
                                class="w-full bg-[#0d7377] hover:bg-[#0a5c60] text-white font-semibold py-3 rounded-lg transition flex items-center justify-center gap-2 active:scale-95">
                            <i class="fas fa-paper-plane text-sm"></i> Kirim Pesan
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
document.getElementById('contact-form').addEventListener('submit', function () {
    var btn = document.getElementById('contact-submit');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-circle-notch fa-spin text-sm"></i> Mengirim...';
    btn.style.opacity = '0.7';
    btn.style.cursor  = 'not-allowed';
});
</script>
@endpush
