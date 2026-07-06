@extends('layouts.app')

@section('content')
    <div class="pt-28 pb-2 px-4 max-w-7xl mx-auto">
        <div class="text-xs text-gray-400 mb-3 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-[#0d7377] transition">Beranda</a>
            <i class="fas fa-chevron-right text-[9px]"></i>
            <span>Tentang Kami</span>
            <i class="fas fa-chevron-right text-[9px]"></i>
            <span class="text-[#0d7377] font-medium">Sejarah Sekolah</span>
        </div>
    </div>

    <div class="pb-12 bg-[#f9fafb]">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">

                <main class="flex-1 min-w-0">

                    {{-- Foto sejarah --}}
                    @if(!empty($profile->foto_sejarah))
                    <div class="bg-white rounded-xl border border-gray-100 overflow-hidden mb-5">
                        <img src="{{ Storage::url($profile->foto_sejarah) }}"
                            alt="{{ $profile->foto_sejarah_alt ?: 'Foto Sejarah SMPN 3 Ajibarang' }}"
                            class="w-full object-cover"
                            style="max-height: 360px;">
                        @if(!empty($profile->foto_sejarah_alt))
                        <div class="px-5 py-3 border-t border-gray-100">
                            <p class="text-xs text-gray-400 italic">{{ $profile->foto_sejarah_alt }}</p>
                        </div>
                        @endif
                    </div>
                    @endif

                    {{-- Isi sejarah --}}
                    <div class="bg-white rounded-xl border border-gray-100 p-7">
                        <h2 class="text-xl font-bold text-gray-900 mb-5 teal-underline">Sejarah Sekolah</h2>
                        <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed
                                    [&_a]:text-[#0d7377] [&_blockquote]:border-l-[3px] [&_blockquote]:border-[#0d7377] [&_blockquote]:pl-4 [&_blockquote]:italic">
                            {!! $profile->sejarah ?? '<p class="text-gray-400 italic">Sejarah sekolah belum diisi.</p>' !!}
                        </div>
                    </div>

                </main>

                @include('components.about-sidebar')

            </div>
        </div>
    </div>
@endsection
