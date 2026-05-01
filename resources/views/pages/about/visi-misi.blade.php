@extends('layouts.app')

@section('content')
    <div class="pt-28 pb-2 px-4 max-w-7xl mx-auto">
        <div class="text-xs text-gray-500 mb-3 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-blue-700 transition">Beranda</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span>Tentang Kami</span>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-blue-700 font-medium">Visi & Misi</span>
        </div>
    </div>

    <div class="pb-8 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                <main class="flex-1 min-w-0">
                    <div class="space-y-6">

                        {{-- Visi --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                            <div class="flex items-center gap-3 mb-5">
                                <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-eye text-yellow-600"></i>
                                </div>
                                <h2 class="font-display text-2xl font-black text-blue-900">Visi</h2>
                            </div>
                            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-r-xl p-5">
                                <div class="text-blue-900 font-medium leading-relaxed
                                            [&_p]:mb-4 [&_img]:rounded-xl [&_img]:my-6
                                            [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:mb-4
                                            [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:mb-4
                                            [&_li]:mb-1">
                                    {!! $profile->visi ?? '<p class="text-gray-400 italic">Visi belum diisi.</p>' !!}
                                </div>
                            </div>
                        </div>

                        {{-- Misi --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                            <div class="flex items-center gap-3 mb-5">
                                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-bullseye text-green-600"></i>
                                </div>
                                <h2 class="font-display text-2xl font-black text-blue-900">Misi</h2>
                            </div>
                            <div class="prose prose-blue max-w-none text-gray-700 leading-relaxed
                                        [&_p]:mb-4 [&_img]:rounded-xl [&_img]:my-6
                                        [&_h2]:text-xl [&_h2]:font-bold [&_h2]:mt-6 [&_h2]:mb-3
                                        [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:mb-4
                                        [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:mb-4
                                        [&_li]:mb-1">
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