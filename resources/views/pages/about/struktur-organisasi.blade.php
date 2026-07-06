@extends('layouts.app')

@section('content')
    <div class="pt-28 pb-2 px-4 max-w-7xl mx-auto">
        <div class="text-xs text-gray-400 mb-3 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-[#0d7377] transition">Beranda</a>
            <i class="fas fa-chevron-right text-[9px]"></i>
            <span>Tentang Kami</span>
            <i class="fas fa-chevron-right text-[9px]"></i>
            <span class="text-[#0d7377] font-medium">Struktur Organisasi</span>
        </div>
    </div>

    <div class="pb-8 bg-[#f9fafb]">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                <main class="flex-1 min-w-0">
                    <div class="bg-white rounded-xl border border-gray-100 p-7">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 teal-underline">Struktur Organisasi</h2>
                        @forelse($structures as $structure)
                            <div class="mb-8">
                                <h3 class="font-medium text-gray-700 text-sm mb-3">{{ $structure->title }}</h3>
                                <img src="{{ Storage::url($structure->image) }}"
                                     class="w-full rounded-xl border border-gray-100"
                                     loading="lazy"
                                     alt="{{ $structure->title }}"/>
                            </div>
                        @empty
                            <p class="text-gray-400 italic text-sm">Struktur organisasi belum diupload.</p>
                        @endforelse
                    </div>
                </main>
                @include('components.about-sidebar')
            </div>
        </div>
    </div>
@endsection
