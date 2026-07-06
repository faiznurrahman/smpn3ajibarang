@extends('layouts.app')

@section('content')
    <div class="pt-28 pb-2 px-4 max-w-7xl mx-auto">
        <div class="text-xs text-gray-400 mb-3 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-[#0d7377] transition">Beranda</a>
            <i class="fas fa-chevron-right text-[9px]"></i>
            <span>Tentang Kami</span>
            <i class="fas fa-chevron-right text-[9px]"></i>
            <span class="text-[#0d7377] font-medium">Visi & Misi</span>
        </div>
    </div>

    <div class="pb-8 bg-[#f9fafb]">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                <main class="flex-1 min-w-0">
                    <div class="space-y-5">

                        {{-- Visi --}}
                        <div class="bg-white rounded-xl border border-gray-100 p-7">
                            <h2 class="text-xl font-bold text-gray-900 mb-5 teal-underline">Visi</h2>
                            <div class="bg-[#e6f4f4] border-l-[3px] border-[#0d7377] rounded-r-lg p-5">
                                <div class="text-[#0a5c60] font-medium leading-relaxed
                                            [&_p]:mb-3 [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:mb-3
                                            [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:mb-3 [&_li]:mb-1">
                                    {!! $profile->visi ?? '<p class="text-gray-400 italic">Visi belum diisi.</p>' !!}
                                </div>
                            </div>
                        </div>

                        {{-- Misi --}}
                        <div class="bg-white rounded-xl border border-gray-100 p-7">
                            <h2 class="text-xl font-bold text-gray-900 mb-5 teal-underline">Misi</h2>
                            <div class="text-gray-700 leading-relaxed
                                        [&_p]:mb-4 [&_img]:rounded-xl [&_img]:my-5
                                        [&_h2]:text-lg [&_h2]:font-bold [&_h2]:mt-5 [&_h2]:mb-2
                                        [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:mb-4
                                        [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:mb-4
                                        [&_li]:mb-1 text-sm">
                                {!! $profile->misi ?? '<p class="text-gray-400 italic">Misi belum diisi.</p>' !!}
                            </div>
                        </div>

                    </div>
                </main>
                @include('components.about-sidebar')
            </div>
        </div>
    </div>
@endsection
