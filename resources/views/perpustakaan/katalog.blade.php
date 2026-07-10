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
            box-shadow: 0 0 0 3px rgba(13,115,119,.1);
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
            font-weight: 700; cursor: pointer; flex-shrink: 0;
        }
        .kk-clear {
            font-size: 13px; color: #64748b; text-decoration: none;
            display: inline-flex; align-items: center; gap: 4px; margin-top: 8px;
        }
        .kk-clear:hover { color: var(--k-navy); }

        /* ── Mobile: cegah search bar & filter meluber ke samping (scroll horizontal) ── */
        @media (max-width: 640px) {
            .kk-top { flex-direction: column; align-items: stretch; gap: 12px; }
            .kk-search-wrap { width: 100%; min-width: 0; }
            .kk-search-row { flex-wrap: wrap; }
            .kk-search-input { flex: 1 1 100%; min-width: 0; }
            .kk-search-select { flex: 1 1 auto; min-width: 0; width: auto; }
        }

        .kk-meta { font-size: 13px; color: #64748b; margin-bottom: 14px; }
        .kk-meta strong { color: #1e293b; }

        .kk-empty {
            text-align: center; padding: 60px 24px; color: #94a3b8;
        }
        .kk-empty i { font-size: 52px; margin-bottom: 16px; display: block; }
        .kk-empty p { font-size: 15px; }

        /* ── Tabel ── */
        .kk-card {
            background: #fff; border-radius: 14px; border: 1px solid #f1f5f9;
            box-shadow: 0 2px 12px rgba(13,115,119,.06);
            overflow: hidden; margin-bottom: 24px;
        }
        .kk-tbl-wrap { overflow-x: auto; }
        .kk-tbl { width: 100%; border-collapse: collapse; font-size: 13.5px; }
        .kk-tbl thead tr { background: #f9fafb; border-bottom: 1px solid #f1f5f9; }
        .kk-tbl th {
            padding: 11px 16px; text-align: left; font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .06em; color: #94a3b8; white-space: nowrap;
        }
        .kk-tbl th.center { text-align: center; }
        .kk-tbl tbody tr { border-bottom: 1px solid #f1f5f9; transition: background .1s; }
        .kk-tbl tbody tr:last-child { border-bottom: none; }
        .kk-tbl tbody tr:hover { background: #f9fafb; }
        .kk-tbl td { padding: 13px 16px; vertical-align: middle; color: #1e293b; }
        .kk-tbl td.center { text-align: center; }
        .kk-tbl td.no { color: #94a3b8; font-size: 12px; text-align: center; width: 44px; }
        .kk-judul { font-weight: 700; font-size: 13.5px; color: #1e293b; }
        .kk-pengarang { font-size: 12px; color: #94a3b8; margin-top: 2px; }

        .kk-kategori {
            display: inline-block; font-size: 11px; font-weight: 600; padding: 3px 9px; border-radius: 999px;
            background: #e6f4f4; color: var(--k-navy); white-space: nowrap;
        }
        .kk-stok {
            display: inline-block; font-size: 11px; font-weight: 700; padding: 3px 9px; border-radius: 999px;
            white-space: nowrap;
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
        .kk-pagination a:hover { background: #e6f4f4; border-color: var(--k-navy2); color: var(--k-navy); }
        .kk-pagination span.active-page {
            background: var(--k-navy); color: #fff; border-color: var(--k-navy);
        }
        .kk-pagination span.disabled { opacity: .45; pointer-events: none; }

        @media (max-width: 640px) {
            .kk-hide-mobile { display: none; }
        }
    </style>

    {{-- Top bar --}}
    <div class="kk-top">
        <a href="{{ route('perpustakaan.layanan') }}" class="kk-back">
            <i class="fas fa-arrow-left"></i> Layanan
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
        <div class="kk-card">
            <div class="kk-empty">
                <i class="fas fa-book-open"></i>
                <p>Buku tidak ditemukan.<br>Coba kata kunci yang berbeda.</p>
            </div>
        </div>
    @else

    {{-- Book table --}}
    <div class="kk-card">
        <div class="kk-tbl-wrap">
        <table class="kk-tbl">
            <thead>
                <tr>
                    <th class="center kk-hide-mobile">No</th>
                    <th>Judul Buku</th>
                    <th class="kk-hide-mobile">Kategori</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $i => $book)
                @php $tersedia = $book->stok_tersedia; @endphp
                <tr>
                    <td class="no kk-hide-mobile">{{ $books->firstItem() + $i }}</td>
                    <td>
                        <div class="kk-judul">{{ $book->judul }}</div>
                        <div class="kk-pengarang">
                            {{ implode(' · ', array_filter([$book->penulis, $book->penerbit, $book->tahun])) }}
                        </div>
                    </td>
                    <td class="kk-hide-mobile">
                        @if($book->kategori)
                            <span class="kk-kategori">{{ $book->kategori }}</span>
                        @else
                            <span style="color:#cbd5e1;">—</span>
                        @endif
                    </td>
                    <td>
                        <span class="kk-stok {{ $tersedia > 0 ? 'ada' : 'habis' }}">
                            {{ $tersedia > 0 ? "Tersedia ($tersedia)" : 'Habis' }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
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
