@extends('layouts.app')

@section('content')
    <div class="pt-28 pb-2 px-4 max-w-7xl mx-auto">
        <div class="text-xs text-gray-500 mb-3 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-blue-700 transition">Beranda</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span>Tentang Kami</span>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-blue-700 font-medium">Sejarah Sekolah</span>
        </div>
    </div>

    <div class="pb-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">

                <main class="flex-1 min-w-0">

                    {{-- Foto sejarah (jika ada) --}}
                    @if(!empty($profile->foto_sejarah))
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                        <img
                            src="{{ Storage::url($profile->foto_sejarah) }}"
                            alt="{{ $profile->foto_sejarah_alt ?: 'Foto Sejarah SMPN 3 Ajibarang' }}"
                            class="w-full object-cover"
                            style="max-height: 380px;"
                        >
                        @if(!empty($profile->foto_sejarah_alt))
                        <div class="px-5 py-3 border-t border-gray-100 flex items-center gap-2">
                            <i class="fas fa-image text-gray-300 text-sm"></i>
                            <p class="text-xs text-gray-400 italic">{{ $profile->foto_sejarah_alt }}</p>
                        </div>
                        @endif
                    </div>
                    @endif

                    {{-- Isi sejarah --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-landmark text-blue-600"></i>
                            </div>
                            <h2 class="text-2xl font-black text-blue-900">Sejarah Sekolah</h2>
                        </div>
                        <div class="prose prose-blue max-w-none text-gray-700 leading-relaxed">
                            {!! $profile->sejarah ?? '<p class="text-gray-400 italic">Sejarah sekolah belum diisi.</p>' !!}
                        </div>
                    </div>

                </main>

                @include('components.about-sidebar')

            </div>
        </div>
    </div>
@endsection
