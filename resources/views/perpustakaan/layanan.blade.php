<x-kiosk>
    <x-slot name="title">Layanan</x-slot>

    <style>
        .pl-wrap { max-width: 780px; margin: 0 auto; }

        .pl-hero { text-align: center; margin-bottom: 32px; }
        .pl-hero h1 { font-size: 26px; font-weight: 800; color: var(--k-navy); margin-bottom: 6px; }
        .pl-hero p  { font-size: 14px; color: #64748b; }

        .pl-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .pl-access {
            background: #fff; border-radius: 14px; padding: 40px 28px; text-align: center;
            text-decoration: none; color: inherit; box-shadow: 0 4px 20px rgba(13,115,119,.08);
            border: 2px solid transparent; transition: transform .15s, box-shadow .15s, border-color .15s;
            display: flex; flex-direction: column; align-items: center; gap: 16px;
        }
        .pl-access:hover { transform: translateY(-4px); box-shadow: 0 12px 36px rgba(13,115,119,.16); border-color: var(--k-navy2); }
        .pl-access-icon {
            width: 76px; height: 76px; border-radius: 20px; background: #e6f4f4; color: var(--k-navy);
            display: flex; align-items: center; justify-content: center; font-size: 34px;
        }
        .pl-access h2 { font-size: 20px; font-weight: 800; color: #1e293b; margin: 0; }
        .pl-access p  { font-size: 13px; color: #64748b; margin: 0; line-height: 1.55; }
        .pl-btn {
            margin-top: 8px; display: inline-block; padding: 10px 26px; border-radius: 9px;
            font-size: 14px; font-weight: 700; color: #fff; background: var(--k-navy);
        }

        @media (max-width: 520px) {
            .pl-grid { grid-template-columns: 1fr; max-width: 340px; margin: 0 auto; }
        }
    </style>

    <div class="pl-wrap">
        <div class="pl-hero">
            <h1>Layanan Perpustakaan</h1>
            <p>Pilih layanan yang Anda butuhkan di bawah ini</p>
        </div>

        <div class="pl-grid">
            <a href="{{ route('perpustakaan.hadir') }}" class="pl-access">
                <div class="pl-access-icon"><i class="fas fa-clipboard-list"></i></div>
                <h2>Daftar Hadir</h2>
                <p>Catat kunjungan Anda ke perpustakaan hari ini</p>
                <span class="pl-btn">Isi Sekarang</span>
            </a>

            <a href="{{ route('perpustakaan.katalog') }}" class="pl-access">
                <div class="pl-access-icon"><i class="fas fa-book-open"></i></div>
                <h2>Katalog Buku</h2>
                <p>Temukan buku yang Anda cari di koleksi perpustakaan</p>
                <span class="pl-btn">Cari Buku</span>
            </a>
        </div>
    </div>
</x-kiosk>
