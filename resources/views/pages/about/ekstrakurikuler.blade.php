@extends('layouts.app')

@section('content')
    <div class="pt-28 pb-2 px-4 max-w-7xl mx-auto">
        <div class="text-xs text-gray-400 mb-3 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-[#0d7377] transition">Beranda</a>
            <i class="fas fa-chevron-right text-[9px]"></i>
            <span>Tentang Kami</span>
            <i class="fas fa-chevron-right text-[9px]"></i>
            <span class="text-[#0d7377] font-medium">Ekstrakurikuler</span>
        </div>
    </div>

    <div class="pb-8 bg-[#f9fafb]">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                <main class="flex-1 min-w-0">
                    <div class="bg-white rounded-xl border border-gray-100 p-7">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 teal-underline">Ekstrakurikuler</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @forelse($extracurriculars as $ekstra)
                                <div class="flex gap-4 p-4 rounded-xl border border-gray-100 hover:border-[#0d7377]/30 hover:bg-[#f9fafb] transition cursor-pointer"
                                     onclick="openModal(
                                         '{{ $ekstra->nama }}',
                                         '{{ !empty($ekstra->gambar) ? Storage::url($ekstra->gambar) : '' }}',
                                         `{!! addslashes($ekstra->deskripsi) !!}`
                                     )">
                                    @if(!empty($ekstra->gambar))
                                        <img src="{{ Storage::url($ekstra->gambar) }}"
                                             class="w-14 h-14 rounded-xl object-cover flex-shrink-0"
                                             loading="lazy"
                                             alt="{{ $ekstra->nama }}"/>
                                    @else
                                        <div class="w-14 h-14 rounded-xl bg-[#e6f4f4] flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-star text-[#0d7377]/40 text-xl"></i>
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <div class="font-semibold text-gray-800 text-sm">{{ $ekstra->nama }}</div>
                                        @if(!empty($ekstra->deskripsi))
                                            <div class="text-xs text-gray-500 mt-1 leading-relaxed line-clamp-2">
                                                {{ strip_tags($ekstra->deskripsi) }}
                                            </div>
                                        @endif
                                        <div class="mt-2 text-xs text-[#0d7377] font-medium flex items-center gap-1">
                                            Lihat Detail <i class="fas fa-arrow-right text-[10px]"></i>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-400 italic text-sm col-span-2">Data ekstrakurikuler belum tersedia.</p>
                            @endforelse
                        </div>
                    </div>
                </main>
                @include('components.about-sidebar')
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div id="ekstra-modal"
         class="hidden fixed inset-0 z-50 flex items-center justify-center p-4"
         onclick="closeModal(event)">

        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto z-10">

            <div id="modal-img-wrap" class="hidden">
                <img id="modal-img" src="" alt=""
                     class="w-full h-52 object-cover rounded-t-2xl"/>
            </div>

            <div class="p-6">
                <div class="flex items-start justify-between gap-4 mb-4">
                    <h3 id="modal-title" class="text-lg font-bold text-gray-900"></h3>
                    <button onclick="closeModalBtn()"
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 hover:bg-gray-200 transition flex-shrink-0">
                        <i class="fas fa-times text-gray-500 text-sm"></i>
                    </button>
                </div>
                <div id="modal-desc"
                     class="text-gray-600 text-sm leading-relaxed
                            [&_p]:mb-3 [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:mb-3
                            [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:mb-3 [&_li]:mb-1">
                </div>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
<script>
    function openModal(nama, gambar, deskripsi) {
        document.getElementById('modal-title').textContent = nama;
        document.getElementById('modal-desc').innerHTML = deskripsi;

        const imgWrap = document.getElementById('modal-img-wrap');
        const img = document.getElementById('modal-img');
        if (gambar) {
            img.src = gambar;
            img.alt = nama;
            imgWrap.classList.remove('hidden');
        } else {
            imgWrap.classList.add('hidden');
        }

        document.getElementById('ekstra-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModalBtn() {
        document.getElementById('ekstra-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function closeModal(event) {
        if (event.target === document.getElementById('ekstra-modal') ||
            event.target.classList.contains('absolute')) {
            closeModalBtn();
        }
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModalBtn();
    });
</script>
@endpush
