<x-kiosk>
    <x-slot name="title">Perpustakaan</x-slot>

    <style>
        .pi-wrap { max-width: 1140px; margin: 0 auto; }

        /* ── Fold pertama: hero + statistik jadi satu layar, baru lanjut scroll ── */
        .pi-first-fold {
            margin: -100px -24px 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Hero (full-bleed, nempel di bawah nav, tanpa jarak) ── */
        .pi-hero {
            flex: 1 1 auto;
            min-height: 340px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 116px 24px 36px;
            text-align: center;
            background:
                @if(!empty($kiosk?->hero_image))
                    linear-gradient(180deg, rgba(9,50,53,.42) 0%, rgba(9,50,53,.3) 45%, rgba(9,50,53,.55) 100%),
                    url('{{ Storage::url($kiosk->hero_image) }}') center / cover no-repeat;
                @else
                    linear-gradient(135deg, var(--k-navy) 0%, var(--k-navy2) 60%, #093f42 100%);
                @endif
        }
        @media (max-width: 640px) { .pi-hero { padding: 100px 18px 28px; min-height: 280px; } }
        .pi-hero-inner { max-width: 720px; margin: 0 auto; }
        .pi-hero h1 {
            font-size: clamp(23px, 6.5vw, 42px); font-weight: 800; color: #fff; margin-bottom: 10px;
            line-height: 1.25; text-shadow: 0 2px 16px rgba(0,0,0,.4);
        }
        .pi-hero p.tagline {
            font-size: clamp(13px, 3.6vw, 16px); color: rgba(255,255,255,.9); max-width: 520px;
            margin: 0 auto 26px; line-height: 1.6; text-shadow: 0 1px 8px rgba(0,0,0,.35);
        }

        .pi-search-form { max-width: 640px; margin: 0 auto; }
        .pi-search-row {
            display: flex; gap: 8px; background: #fff; padding: 7px; border-radius: 14px;
            box-shadow: 0 8px 24px rgba(0,0,0,.22);
        }
        .pi-search-input {
            flex: 1; border: none; outline: none; font-family: inherit;
            font-size: 14.5px; color: #1e293b; padding: 11px 12px; border-radius: 9px; min-width: 0;
        }
        .pi-search-btn {
            flex-shrink: 0; border: none; cursor: pointer; font-family: inherit;
            background: var(--k-orange); color: #fff; font-weight: 700; font-size: 13.5px;
            padding: 0 18px; border-radius: 9px; display: inline-flex; align-items: center; gap: 7px;
            transition: background .15s;
        }
        .pi-search-btn:hover { background: var(--k-navy2); }
        @media (max-width: 420px) {
            .pi-search-row { flex-direction: column; }
            .pi-search-btn { padding: 11px; justify-content: center; }
        }

        /* ── Konten di bawah hero — putih polos, nempel rata ke footer (tanpa jarak) ── */
        .pi-content-bg { background: #fff; margin: 0 -24px -40px; padding: 0 24px 0; }

        /* ── Statistik — grid 2x2 di mobile, 1 baris 4 kolom di desktop ── */
        .pi-stats-band { background: #fff; padding: 0 24px; }
        .pi-stats {
            display: grid; grid-template-columns: repeat(2, 1fr);
            border-top: 0.5px solid #e2e8f0;
        }
        @media (min-width: 768px) { .pi-stats { grid-template-columns: repeat(4, 1fr); } }
        .pi-stat-item {
            display: flex; align-items: center; gap: 12px; text-align: left;
            padding: 20px 14px; border-color: #e2e8f0;
        }
        .pi-stat-item:nth-child(odd) { border-right: 0.5px solid #e2e8f0; }
        .pi-stat-item:nth-child(1), .pi-stat-item:nth-child(2) { border-bottom: 0.5px solid #e2e8f0; }
        @media (min-width: 768px) {
            .pi-stat-item { border-bottom: none !important; border-right: 0.5px solid #e2e8f0; }
            .pi-stat-item:last-child { border-right: none; }
        }
        .pi-stat-icon {
            flex-shrink: 0; width: 40px; height: 40px; border-radius: 50%;
            background: #e6f4f4; color: var(--k-navy); font-size: 18px;
            display: flex; align-items: center; justify-content: center;
        }
        .pi-stat-text { display: flex; align-items: baseline; gap: 5px; flex-wrap: wrap; min-width: 0; }
        .pi-stat-value { font-size: 16px; font-weight: 800; color: var(--k-navy); line-height: 1.2; }
        .pi-stat-label { font-size: 11.5px; color: #64748b; font-weight: 500; line-height: 1.2; }
        @media (min-width: 480px) {
            .pi-stat-item { padding: 24px 18px; gap: 14px; }
            .pi-stat-icon { width: 46px; height: 46px; font-size: 20px; }
            .pi-stat-value { font-size: 19px; }
            .pi-stat-label { font-size: 13px; }
        }
        @media (min-width: 900px) { .pi-stat-item { padding: 30px 26px; } }

        /* ── Section polos (tanpa kotak) ── */
        .pi-section { max-width: 780px; margin: 0 auto; padding: 36px 4px; border-top: 1px solid #eef1f4; }
        @media (min-width: 640px) { .pi-section { padding: 48px 4px; } }
        .pi-section h2 {
            font-size: clamp(16px, 4.2vw, 19px); font-weight: 800; color: #1e293b; margin-bottom: 16px;
            text-align: center;
        }
        .pi-section p.body { font-size: 13.5px; color: #475569; line-height: 1.75; white-space: pre-line; text-align: center; }
        @media (min-width: 640px) { .pi-section p.body { font-size: 14.5px; line-height: 1.8; } }
        .pi-empty { font-size: 13px; color: #94a3b8; font-style: italic; text-align: center; }

        .pi-section-wide { max-width: 1140px; }

        .pi-people {
            display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px;
        }
        @media (min-width: 640px) { .pi-people { grid-template-columns: repeat(4, 1fr); gap: 10px; } }
        .pi-person { text-align: center; padding: 14px 8px; border-radius: 14px; transition: background .15s; }
        .pi-person:hover { background: #f9fafb; }
        .pi-person img, .pi-person .pi-avatar {
            width: 64px; height: 64px; border-radius: 50%; object-fit: cover; margin: 0 auto;
        }
        @media (min-width: 640px) { .pi-person img, .pi-person .pi-avatar { width: 76px; height: 76px; } }
        .pi-avatar { background: #e6f4f4; display: flex; align-items: center; justify-content: center; }
        .pi-avatar span { color: var(--k-navy); font-weight: 800; font-size: 22px; }
        .pi-person .pi-nama { margin-top: 8px; font-weight: 700; font-size: 12px; color: #1e293b; line-height: 1.3; }
        .pi-person .pi-jabatan { font-size: 11px; color: #94a3b8; margin-top: 2px; }

        /* ── Galeri — geser horizontal ── */
        .pi-gallery {
            display: flex; gap: 10px; overflow-x: auto; padding-bottom: 10px;
            scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch;
        }
        .pi-gallery a {
            flex: 0 0 auto; width: 58vw; max-width: 220px; aspect-ratio: 1/1;
            border-radius: 12px; overflow: hidden; border: 1px solid #f1f5f9;
            scroll-snap-align: start;
        }
        @media (min-width: 640px) { .pi-gallery a { width: 220px; } .pi-gallery { gap: 12px; } }
        .pi-gallery img { width: 100%; height: 100%; object-fit: cover; transition: transform .25s; }
        .pi-gallery a:hover img { transform: scale(1.06); }
    </style>

    {{-- ── Fold pertama: hero + statistik (satu layar) ── --}}
    <div class="pi-first-fold">
        <div class="pi-hero">
            <div class="pi-hero-inner">
                <h1>Perpustakaan {{ $settings->nama_sekolah ?? 'SMP Negeri 3 Ajibarang' }}</h1>
                <p class="tagline">{{ $kiosk->tagline ?? 'Pusat literasi dan sumber belajar bagi seluruh warga sekolah' }}</p>

                <form method="GET" action="{{ route('perpustakaan.katalog') }}" class="pi-search-form">
                    <div class="pi-search-row">
                        <input type="text" name="cari" class="pi-search-input"
                               placeholder="Cari judul, penulis, atau kode buku..." autocomplete="off">
                        <button type="submit" class="pi-search-btn">
                            <i class="fas fa-search"></i> Cari Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ── Statistik ── --}}
        <div class="pi-stats-band">
            <div class="pi-wrap">
                <div class="pi-stats">
                    <div class="pi-stat-item">
                        <div class="pi-stat-icon"><i class="ti ti-book-2"></i></div>
                        <div class="pi-stat-text">
                            <span class="pi-stat-value">{{ $jumlahBuku }}</span>
                            <span class="pi-stat-label">Judul Buku</span>
                        </div>
                    </div>
                    <div class="pi-stat-item">
                        <div class="pi-stat-icon"><i class="ti ti-users"></i></div>
                        <div class="pi-stat-text">
                            <span class="pi-stat-value">{{ $jumlahAnggota }}</span>
                            <span class="pi-stat-label">Anggota Terdaftar</span>
                        </div>
                    </div>
                    <div class="pi-stat-item">
                        <div class="pi-stat-icon"><i class="ti ti-clock"></i></div>
                        <div class="pi-stat-text">
                            <span class="pi-stat-value">{{ $jamOperasional }}</span>
                            <span class="pi-stat-label">Jam Operasional</span>
                        </div>
                    </div>
                    <div class="pi-stat-item">
                        <div class="pi-stat-icon"><i class="ti ti-calendar"></i></div>
                        <div class="pi-stat-text">
                            <span class="pi-stat-value">{{ $hariLayanan }}</span>
                            <span class="pi-stat-label">Hari Layanan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pi-content-bg">
    <div class="pi-wrap">

        {{-- ── Sejarah ── --}}
        <div class="pi-section">
            <h2>Sejarah Perpustakaan</h2>
            @if(!empty($kiosk?->sejarah))
                <p class="body">{{ $kiosk->sejarah }}</p>
            @else
                <p class="pi-empty">Sejarah perpustakaan belum diisi.</p>
            @endif
        </div>

        {{-- ── Struktur Pengelola ── --}}
        <div class="pi-section pi-section-wide">
            <h2>Struktur Pengelola</h2>
            <div class="pi-people">
                @forelse(($kiosk?->pengelola ?? []) as $orang)
                    <div class="pi-person">
                        @if(!empty($orang['foto']))
                            <img src="{{ Storage::url($orang['foto']) }}" alt="{{ $orang['nama'] ?? '' }}" loading="lazy">
                        @else
                            <div class="pi-avatar"><span>{{ mb_substr($orang['nama'] ?? '?', 0, 1) }}</span></div>
                        @endif
                        <div class="pi-nama">{{ $orang['nama'] ?? '-' }}</div>
                        <div class="pi-jabatan">{{ $orang['jabatan'] ?? '-' }}</div>
                    </div>
                @empty
                    <p class="pi-empty" style="grid-column:1/-1;">Struktur pengelola belum diisi.</p>
                @endforelse
            </div>
        </div>

        {{-- ── Galeri ── --}}
        @if(!empty($kiosk?->galeri))
        <div class="pi-section pi-section-wide">
            <h2>Galeri Foto</h2>
            <div class="pi-gallery">
                @foreach($kiosk->galeri as $foto)
                    @if(!empty($foto['gambar']))
                    <a href="{{ Storage::url($foto['gambar']) }}" target="_blank" rel="noopener">
                        <img src="{{ Storage::url($foto['gambar']) }}" alt="{{ $foto['keterangan'] ?? 'Foto perpustakaan' }}" loading="lazy">
                    </a>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

    </div>
    </div>
</x-kiosk>
