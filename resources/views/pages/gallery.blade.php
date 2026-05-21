@extends('layouts.app')

@section('content')

    {{-- Breadcrumb --}}
    <div class="pt-28 pb-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <div class="text-xs text-gray-400 mb-2 flex items-center justify-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-gray-600 transition">Beranda</a>
            <i class="fas fa-chevron-right text-[9px] text-gray-300"></i>
            <span class="text-gray-500">Galeri</span>
        </div>
        <h1 class="text-2xl font-black text-gray-900">Galeri Foto</h1>
        <p class="text-sm text-gray-400 mt-1">Dokumentasi kegiatan SMPN 3 Ajibarang</p>
    </div>
</div>

    <div class="pb-16 bg-gray-50 pt-6">
        <div class="max-w-7xl mx-auto px-4">

            @if($galleries->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($galleries as $gallery)
                        @if($gallery->images->count())
                        @php
                            $cover  = $gallery->images->sortBy('order')->first();
                            $total  = $gallery->images->count();
                            $photos = $gallery->images->sortBy('order');
                        @endphp
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md hover:border-blue-200 transition cursor-pointer group"
                             onclick="openAlbum({{ $gallery->id }})">

                            {{-- Cover --}}
                            <div class="relative h-52 overflow-hidden bg-gray-100">
                                <img src="{{ Storage::url($cover->gambar) }}"
                                     alt="{{ $gallery->judul }}"
                                     loading="lazy"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500"/>
                                {{-- Overlay jumlah foto --}}
                                <div class="absolute bottom-3 right-3 bg-black/60 text-white text-xs font-semibold px-3 py-1 rounded-full flex items-center gap-1.5">
                                    <i class="fas fa-images text-[10px]"></i> {{ $total }} Foto
                                </div>
                            </div>

                            {{-- Info --}}
                            <div class="p-5">
                                <h3 class="font-bold text-blue-900 text-base group-hover:text-blue-700 transition">
                                    {{ $gallery->judul }}
                                </h3>
                                @if(!empty($gallery->deskripsi))
                                    <p class="text-xs text-gray-400 mt-1 line-clamp-2">{{ $gallery->deskripsi }}</p>
                                @endif
                                <div class="mt-3 flex items-center gap-1.5 text-xs text-blue-600 font-semibold">
                                    Lihat Foto <i class="fas fa-arrow-right text-[10px]"></i>
                                </div>
                            </div>

                            {{-- Preview strip --}}
                            @if($total > 1)
                                <div class="flex gap-1 px-5 pb-5">
                                    @foreach($photos->skip(1)->take(4) as $img)
                                        <div class="flex-1 h-12 rounded-lg overflow-hidden bg-gray-100">
                                            <img src="{{ Storage::url($img->gambar) }}"
                                                 class="w-full h-full object-cover"
                                                 loading="lazy"
                                                 alt=""/>
                                        </div>
                                    @endforeach
                                    @if($total > 5)
                                        <div class="flex-1 h-12 rounded-lg bg-blue-50 flex items-center justify-center">
                                            <span class="text-xs text-blue-500 font-bold">+{{ $total - 5 }}</span>
                                        </div>
                                    @endif
                                </div>
                            @endif

                        </div>

                        {{-- Data foto untuk modal (hidden) --}}
                        <div id="album-data-{{ $gallery->id }}" class="hidden">
                            <div data-title="{{ $gallery->judul }}" data-desc="{{ $gallery->deskripsi }}"></div>
                            @foreach($photos as $img)
                                <div data-src="{{ Storage::url($img->gambar) }}"
                                     data-caption="{{ $img->caption ?? '' }}"></div>
                            @endforeach
                        </div>

                        @endif
                    @endforeach
                </div>

            @else
                <div class="text-center py-24 text-gray-400">
                    <i class="fas fa-images text-5xl mb-4 block"></i>
                    <p class="text-sm">Belum ada galeri foto.</p>
                </div>
            @endif

        </div>
    </div>

    {{-- Modal Album --}}
    <div id="album-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4"
         onclick="closeAlbum(event)">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto z-10">

            {{-- Header Modal --}}
            <div class="sticky top-0 bg-white border-b border-gray-100 px-6 py-4 flex items-center justify-between rounded-t-2xl z-10">
                <div>
                    <h3 id="modal-album-title" class="font-bold text-blue-900 text-lg"></h3>
                    <p id="modal-album-desc" class="text-xs text-gray-400 mt-0.5"></p>
                </div>
                <button onclick="closeAlbumBtn()"
                        class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 transition">
                    <i class="fas fa-times text-gray-500 text-sm"></i>
                </button>
            </div>

            {{-- Grid Foto --}}
            <div id="modal-album-grid" class="grid grid-cols-2 sm:grid-cols-3 gap-3 p-6">
            </div>

        </div>
    </div>

    {{-- Lightbox --}}
    <div id="lightbox" class="hidden fixed inset-0 z-[60] bg-black/95 flex items-center justify-center px-4"
         onclick="closeLightbox()">
        <button class="absolute top-5 right-5 text-white/70 hover:text-white text-2xl transition"
                onclick="closeLightbox()">
            <i class="fas fa-times"></i>
        </button>
        <button id="lb-prev" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition"
                onclick="event.stopPropagation(); lightboxNav(-1)">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button id="lb-next" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition"
                onclick="event.stopPropagation(); lightboxNav(1)">
            <i class="fas fa-chevron-right"></i>
        </button>
        <div class="relative max-w-4xl w-full" onclick="event.stopPropagation()">
            <img id="lightbox-img" src="" alt="" class="w-full max-h-[80vh] object-contain rounded-xl"/>
            <p id="lightbox-caption" class="text-center text-white/70 text-sm mt-3"></p>
            <p id="lightbox-counter" class="text-center text-white/40 text-xs mt-1"></p>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    let currentPhotos = [];
    let currentIndex  = 0;

    function openAlbum(id) {
        const dataEl  = document.getElementById('album-data-' + id);
        const info    = dataEl.querySelector('[data-title]');
        const photos  = dataEl.querySelectorAll('[data-src]');

        document.getElementById('modal-album-title').textContent = info.dataset.title;
        document.getElementById('modal-album-desc').textContent  = info.dataset.desc || '';

        currentPhotos = Array.from(photos).map(p => ({
            src:     p.dataset.src,
            caption: p.dataset.caption,
        }));

        const grid = document.getElementById('modal-album-grid');
        grid.innerHTML = '';

        currentPhotos.forEach((photo, i) => {
            const div = document.createElement('div');
            div.className = 'group relative aspect-square overflow-hidden rounded-xl bg-gray-100 cursor-pointer';
            div.onclick   = (e) => { e.stopPropagation(); openLightbox(i); };
            div.innerHTML = `
                <img src="${photo.src}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500"/>
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition duration-300 flex items-center justify-center">
                    <i class="fas fa-expand text-white text-lg opacity-0 group-hover:opacity-100 transition"></i>
                </div>
                ${photo.caption ? `<div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent px-3 py-2 translate-y-full group-hover:translate-y-0 transition duration-300">
                    <p class="text-white text-[10px] line-clamp-1">${photo.caption}</p>
                </div>` : ''}
            `;
            grid.appendChild(div);
        });

        document.getElementById('album-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeAlbum(event) {
        if (event.target === document.getElementById('album-modal') ||
            event.target.classList.contains('absolute')) {
            closeAlbumBtn();
        }
    }

    function closeAlbumBtn() {
        document.getElementById('album-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function openLightbox(index) {
        currentIndex = index;
        updateLightbox();
        document.getElementById('lightbox').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function updateLightbox() {
        const photo = currentPhotos[currentIndex];
        document.getElementById('lightbox-img').src          = photo.src;
        document.getElementById('lightbox-caption').textContent = photo.caption || '';
        document.getElementById('lightbox-counter').textContent = `${currentIndex + 1} / ${currentPhotos.length}`;
    }

    function lightboxNav(dir) {
        currentIndex = (currentIndex + dir + currentPhotos.length) % currentPhotos.length;
        updateLightbox();
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
        document.getElementById('lightbox-img').src = '';
        document.body.style.overflow = 'hidden'; // keep album modal scroll locked
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            if (!document.getElementById('lightbox').classList.contains('hidden')) {
                closeLightbox();
            } else {
                closeAlbumBtn();
            }
        }
        if (e.key === 'ArrowLeft')  lightboxNav(-1);
        if (e.key === 'ArrowRight') lightboxNav(1);
    });
</script>
@endpush