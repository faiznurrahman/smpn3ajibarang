@props(['title', 'breadcrumb'])

@extends('layouts.app')

@section('content')
    <div class="bg-blue-900 py-10">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-xs text-blue-300 mb-2 flex items-center gap-2">
                <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span>Tentang Kami</span>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-white">{{ $breadcrumb }}</span>
            </div>
            <h1 class="font-display text-2xl md:text-3xl font-black text-white">{{ $title }}</h1>
        </div>
    </div>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                <main class="flex-1 min-w-0">
                    {{ $slot }}
                </main>
                @include('components.about-sidebar')
            </div>
        </div>
    </div>
@endsection
