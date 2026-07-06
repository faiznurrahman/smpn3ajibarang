@extends('layouts.app')

@section('content')
    <div class="pt-28 pb-2 px-4 max-w-7xl mx-auto">
        <div class="text-xs text-gray-400 mb-3 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-[#0d7377] transition">Beranda</a>
            <i class="fas fa-chevron-right text-[9px]"></i>
            <span>Tentang Kami</span>
            <i class="fas fa-chevron-right text-[9px]"></i>
            <span class="text-[#0d7377] font-medium">Data Pengajar</span>
        </div>
    </div>

    <div class="pb-8 bg-[#f9fafb]">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                <main class="flex-1 min-w-0">
                    <div class="space-y-6">

                        {{-- Tenaga Pengajar --}}
                        <div class="bg-white rounded-xl border border-gray-100 p-7">
                            <h2 class="text-xl font-bold text-gray-900 mb-6 teal-underline">Tenaga Pengajar</h2>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                @forelse($guru as $teacher)
                                    <div class="text-center py-5 px-3 rounded-xl hover:bg-[#f9fafb] transition">
                                        @if(!empty($teacher->foto))
                                            <img src="{{ Storage::url($teacher->foto) }}"
                                                 class="w-16 h-16 rounded-full object-cover mx-auto"
                                                 loading="lazy"
                                                 alt="{{ $teacher->nama }}"/>
                                        @else
                                            <div class="w-16 h-16 rounded-full mx-auto bg-[#e6f4f4] flex items-center justify-center">
                                                <span class="text-[#0d7377] font-bold text-lg">{{ mb_substr($teacher->nama, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <div class="mt-3 font-semibold text-gray-800 text-xs leading-tight">{{ $teacher->nama }}</div>
                                        <div class="text-xs text-gray-400 mt-1">{{ $teacher->mata_pelajaran ?? '-' }}</div>
                                    </div>
                                @empty
                                    <p class="text-gray-400 italic text-sm col-span-4">Data pengajar belum tersedia.</p>
                                @endforelse
                            </div>
                        </div>

                        {{-- Tenaga Kependidikan --}}
                        @if($staff->count())
                            <div class="bg-white rounded-xl border border-gray-100 p-7">
                                <h2 class="text-xl font-bold text-gray-900 mb-6 teal-underline">Tenaga Kependidikan</h2>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                    @foreach($staff as $teacher)
                                        <div class="text-center py-5 px-3 rounded-xl hover:bg-[#f9fafb] transition">
                                            @if(!empty($teacher->foto))
                                                <img src="{{ Storage::url($teacher->foto) }}"
                                                     class="w-16 h-16 rounded-full object-cover mx-auto"
                                                     loading="lazy"
                                                     alt="{{ $teacher->nama }}"/>
                                            @else
                                                <div class="w-16 h-16 rounded-full mx-auto bg-[#e6f4f4] flex items-center justify-center">
                                                    <span class="text-[#0d7377] font-bold text-lg">{{ mb_substr($teacher->nama, 0, 1) }}</span>
                                                </div>
                                            @endif
                                            <div class="mt-3 font-semibold text-gray-800 text-xs leading-tight">{{ $teacher->nama }}</div>
                                            <div class="text-xs text-gray-400 mt-1">{{ $teacher->jabatan ?? '-' }}</div>
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
