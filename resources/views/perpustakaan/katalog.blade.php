<x-kiosk>
    <x-slot name="title">Katalog Buku</x-slot>

    <style>
        .kk-top  { display: flex; align-items: flex-start; gap: 16px; margin-bottom: 24px; }
        .kk-back {
            display: inline-flex; align-items: center; gap: 8px;
            color: var(--k-navy); font-size: 14px; font-weight: 600;
            text-decoration: none; flex-shrink: 0; padding-top: 4px;
        }
        .kk-back:hover { text-decoration: underline; }

        .kk-search-wrap { flex: 1; }
        .kk-search-row  { display: flex; gap: 10px; }
        .kk-search-input {
            flex: 1; padding: 12px 16px;
            border: 1.5px solid #e5e7eb; border-radius: 10px;
            font-size: 15px; font-family: inherit; color: #1e293b;
            outline: none;
            transition: border-color .15s, box-shadow .15s;
        }
        .kk-search-input:focus {
            border-color: var(--k-navy2);
            box-shadow: 0 0 0 3px rgba(30,58,138,.1);
        }
        .kk-search-select {
            padding: 12px 14px;
            border: 1.5px solid #e5e7eb; border-radius: 10px;
            font-size: 14px; font-family: inherit; color: #374151;
            background: #fff; outline: none;
            min-width: 160px;
        }
        .kk-search-btn {
            padding: 12px 20px;
            background: var(--k-navy); color: #fff; border: none;
            border-radius: 10px; font-family: inherit; font-size: 14px;
            font-weight: 700; cursor: pointer;
        }
        .kk-clear {
            font-size: 13px; color: #64748b; text-decoration: none;
            display: inline-flex; align-items: center; gap: 4px; margin-top: 8px;
        }
        .kk-clear:hover { color: var(--k-navy); }

        .kk-meta { font-size: 13px; color: #64748b; margin-bottom: 18px; }
        .kk-meta strong { color: #1e293b; }

        .kk-empty {
            text-align: center; padding: 60px 24px; color: #94a3b8;
        }
        .kk-empty i { font-size: 52px; margin-bottom: 16px; display: block; }
        .kk-empty p { font-size: 15px; }

        .kk-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }
        .kk-book {
            background: #fff; border-radius: 14px;
            box-shadow: 0 2px 12px rgba(30,58,138,.07);
            overflow: hidden; display: flex; flex-direction: column;
            transition: transform .15s, box-shadow .15s;
        }
        .kk-book:hover { transform: translateY(-3px); box-shadow: 0 8px 28px rgba(30,58,138,.13); }

        .kk-cover {
            width: 100%; aspect-ratio: 3/4; object-fit: cover;
            background: #f0f4fb;
        }
        .kk-cover-placeholder {
            width: 100%; aspect-ratio: 3/4;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            display: flex; align-items: center; justify-content: center;
            font-size: 40px; color: #93c5fd;
        }
        .kk-info { padding: 14px 14px 16px; flex: 1; display: flex; flex-direction: column; gap: 6px; }
        .kk-judul { font-size: 14px; font-weight: 700; color: #1e293b; line-height: 1.3; }
        .kk-pengarang { font-size: 12px; color: #64748b; }
        .kk-meta-row { display: flex; align-items: center; justify-content: space-between; margin-top: auto; padding-top: 8px; }
        .kk-kategori {
            font-size: 11px; font-weight: 600; padding: 3px 8px; border-radius: 5px;
            background: #eff6ff; color: var(--k-navy);
        }
        .kk-stok {
            font-size: 11px; font-weight: 700; padding: 3px 8px; border-radius: 5px;
        }
        .kk-stok.ada { background: #dcfce7; color: #15803d; }
        .kk-stok.habis { background: #fee2e2; color: #dc2626; }

        .kk-pagination {
            display: flex; justify-content: center; gap: 6px; flex-wrap: wrap;
        }
        .kk-pagination a, .kk-pagination span {
            padding: 8px 14px; border-radius: 8px; font-size: 13px; font-weight: 600;
            text-decoration: none; color: #64748b;
            border: 1.5px solid #e5e7eb; background: #fff;
            transition: background .15s, color .15s, border-color .15s;
        }
        .kk-pagination a:hover { background: #eff6ff; border-color: var(--k-navy2); color: var(--k-navy); }
        .kk-pagination span.active-page {
            background: var(--k-navy); color: #fff; border-color: var(--k-navy);
        }
        .kk-pagination span.disabled { opacity: .45; pointer-events: none; }
    </style>

    {{-- Top bar --}}
    <div class="kk-top">
        <a href="{{ route('perpustakaan.index') }}" class="kk-back">
            <i class="fas fa-arrow-left"></i> Menu
        </a>
        <div class="kk-search-wrap">
            <form method="GET" action="{{ route('perpustakaan.katalog') }}">
                <div class="kk-search-row">
                    <input type="text" name="cari" class="kk-search-input"
                           placeholder="Cari judul, pengarang, penerbit..."
                           value="{{ request('cari') }}" autocomplete="off">
                    <select name="kategori" class="kk-search-select">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $kat)
                            <option value="{{ $kat }}" {{ request('kategori') === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="kk-search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                @if(request('cari') || request('kategori'))
                <a href="{{ route('perpustakaan.katalog') }}" class="kk-clear">
                    <i class="fas fa-times-circle"></i> Hapus filter
                </a>
                @endif
            </form>
        </div>
    </div>

    {{-- Result meta --}}
    @if(request('cari') || request('kategori'))
    <div class="kk-meta">
        Menampilkan <strong>{{ $books->total() }}</strong> buku
        @if(request('cari')) untuk "<strong>{{ request('cari') }}</strong>"@endif
        @if(request('kategori')) &nbsp;— Kategori: <strong>{{ request('kategori') }}</strong>@endif
    </div>
    @else
    <div class="kk-meta">
        Total koleksi: <strong>{{ $books->total() }}</strong> judul buku
    </div>
    @endif

    {{-- Empty state --}}
    @if($books->isEmpty())
        <div class="kk-empty">
            <i class="fas fa-book-open"></i>
            <p>Buku tidak ditemukan.<br>Coba kata kunci yang berbeda.</p>
        </div>
    @else

    {{-- Book grid --}}
    <div class="kk-grid">
        @foreach($books as $book)
        <div class="kk-book">
            @if($book->cover)
                <img src="{{ \Illuminate\Support\Facades\Storage::url($book->cover) }}"
                     alt="{{ $book->judul }}" class="kk-cover">
            @else
                <div class="kk-cover-placeholder">
                    <i class="fas fa-book"></i>
                </div>
            @endif
            <div class="kk-info">
                <div class="kk-judul">{{ $book->judul }}</div>
                <div class="kk-pengarang">{{ $book->penulis }}</div>
                @if($book->penerbit || $book->tahun)
                <div style="font-size:11px;color:#94a3b8;">
                    {{ implode(' · ', array_filter([$book->penerbit, $book->tahun])) }}
                </div>
                @endif
                <div class="kk-meta-row">
                    @if($book->kategori)
                    <span class="kk-kategori">{{ $book->kategori }}</span>
                    @else
                    <span></span>
                    @endif
                    @php $tersedia = $book->stok_tersedia; @endphp
                    <span class="kk-stok {{ $tersedia > 0 ? 'ada' : 'habis' }}">
                        {{ $tersedia > 0 ? "Tersedia ($tersedia)" : 'Habis' }}
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($books->hasPages())
    <div class="kk-pagination">
        @if($books->onFirstPage())
            <span class="disabled"><i class="fas fa-chevron-left"></i></span>
        @else
            <a href="{{ $books->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
        @endif

        @foreach($books->getUrlRange(max(1, $books->currentPage()-2), min($books->lastPage(), $books->currentPage()+2)) as $page => $url)
            @if($page == $books->currentPage())
                <span class="active-page">{{ $page }}</span>
            @else
                <a href="{{ $url }}">{{ $page }}</a>
            @endif
        @endforeach

        @if($books->hasMorePages())
            <a href="{{ $books->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
        @else
            <span class="disabled"><i class="fas fa-chevron-right"></i></span>
        @endif
    </div>
    @endif

    @endif
</x-kiosk>
