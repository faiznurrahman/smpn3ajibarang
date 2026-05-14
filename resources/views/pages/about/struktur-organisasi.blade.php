@extends('layouts.app')

@section('content')
    <div class="pt-28 pb-2 px-4 max-w-7xl mx-auto">
        <div class="text-xs text-gray-500 mb-3 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-blue-700 transition">Beranda</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span>Tentang Kami</span>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-blue-700 font-medium">Struktur Organisasi</span>
        </div>
    </div>

    <div class="pb-8 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                <main class="flex-1 min-w-0">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-sitemap text-purple-600"></i>
                            </div>
                            <h2 class="font-family: 'Oswald', sans-serif; text-2xl font-black text-blue-900">Struktur Organisasi</h2>
                        </div>
                        @forelse($structures as $structure)
                            <div class="mb-8">
                                <h3 class="font-semibold text-gray-700 text-sm mb-3">{{ $structure->title }}</h3>
                                <img src="{{ Storage::url($structure->image) }}"
                                     class="w-full rounded-xl border border-gray-100 shadow-sm"
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