@extends('layouts.app')

@section('content')
    <div class="pt-28 pb-2 px-4 max-w-7xl mx-auto">
        <div class="text-xs text-gray-500 mb-3 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-blue-700 transition">Beranda</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span>Tentang Kami</span>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-blue-700 font-medium">Data Pengajar</span>
        </div>
    </div>

    <div class="pb-8 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                <main class="flex-1 min-w-0">
                    <div class="space-y-8">

                        {{-- Tenaga Pengajar --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-chalkboard-teacher text-blue-600"></i>
                                </div>
                                <h2 class="font-display text-2xl font-black text-blue-900">Tenaga Pengajar</h2>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                @forelse($guru as $teacher)
                                    <div class="text-center p-4 rounded-xl hover:bg-blue-50 transition">
                                        @if(!empty($teacher->foto))
                                            <img src="{{ Storage::url($teacher->foto) }}"
                                                 class="w-16 h-16 rounded-full object-cover mx-auto border-4 border-blue-100"
                                                 alt="{{ $teacher->nama }}"/>
                                        @else
                                            <div class="w-16 h-16 rounded-full mx-auto border-4 border-blue-100 bg-blue-50 flex items-center justify-center">
                                                <i class="fas fa-user text-blue-300 text-xl"></i>
                                            </div>
                                        @endif
                                        <div class="mt-3 font-semibold text-blue-900 text-sm leading-tight">{{ $teacher->nama }}</div>
                                        <div class="text-xs text-gray-500 mt-1">{{ $teacher->mata_pelajaran ?? '-' }}</div>
                                    </div>
                                @empty
                                    <p class="text-gray-400 italic text-sm col-span-4">Data pengajar belum tersedia.</p>
                                @endforelse
                            </div>
                        </div>

                        {{-- Tenaga Kependidikan --}}
                        @if($staff->count())
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-users text-green-600"></i>
                                    </div>
                                    <h2 class="font-display text-2xl font-black text-blue-900">Tenaga Kependidikan</h2>
                                </div>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                    @foreach($staff as $teacher)
                                        <div class="text-center p-4 rounded-xl hover:bg-green-50 transition">
                                            @if(!empty($teacher->foto))
                                                <img src="{{ Storage::url($teacher->foto) }}"
                                                     class="w-16 h-16 rounded-full object-cover mx-auto border-4 border-green-100"
                                                     alt="{{ $teacher->nama }}"/>
                                            @else
                                                <div class="w-16 h-16 rounded-full mx-auto border-4 border-green-100 bg-green-50 flex items-center justify-center">
                                                    <i class="fas fa-user text-green-300 text-xl"></i>
                                                </div>
                                            @endif
                                            <div class="mt-3 font-semibold text-blue-900 text-sm leading-tight">{{ $teacher->nama }}</div>
                                            <div class="text-xs text-gray-500 mt-1">{{ $teacher->jabatan ?? '-' }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>
                </main>
                @include('components.about-sidebar')
            </div>
        </div>
    </div>
@endsection