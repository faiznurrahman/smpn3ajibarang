<x-kiosk>
    <x-slot name="title">Selamat Datang</x-slot>

    <style>
        .ki-welcome { text-align: center; margin-bottom: 36px; }
        .ki-welcome h1 { font-size: 28px; font-weight: 800; color: var(--k-navy); margin-bottom: 6px; }
        .ki-welcome p  { font-size: 15px; color: #64748b; }

        .ki-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; max-width: 680px; margin: 0 auto; }

        .ki-card {
            background: #fff;
            border-radius: 18px;
            padding: 40px 28px;
            text-align: center;
            text-decoration: none;
            color: inherit;
            border: 2px solid transparent;
            box-shadow: 0 4px 20px rgba(30,58,138,.08);
            transition: transform .15s, box-shadow .15s, border-color .15s;
            display: flex; flex-direction: column; align-items: center; gap: 16px;
        }
        .ki-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 36px rgba(30,58,138,.16);
            border-color: var(--k-navy2);
        }
        .ki-card-icon {
            width: 76px; height: 76px;
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 34px;
        }
        .ki-card-icon.hadir   { background: #eff6ff; color: var(--k-navy); }
        .ki-card-icon.katalog { background: #fff7ed; color: var(--k-orange); }
        .ki-card h2 { font-size: 20px; font-weight: 800; color: #1e293b; margin: 0; }
        .ki-card p  { font-size: 13px; color: #64748b; margin: 0; line-height: 1.55; }

        .ki-btn {
            margin-top: 8px;
            display: inline-block;
            padding: 10px 26px;
            border-radius: 9px;
            font-size: 14px; font-weight: 700;
            color: #fff;
        }
        .ki-btn.hadir   { background: var(--k-navy); }
        .ki-btn.katalog { background: var(--k-orange); }

        @media (max-width: 520px) {
            .ki-grid { grid-template-columns: 1fr; max-width: 340px; }
        }
    </style>

    <div class="ki-welcome">
        <h1>Selamat Datang di Perpustakaan</h1>
        <p>Pilih layanan yang Anda butuhkan di bawah ini</p>
    </div>

    <div class="ki-grid">
        <a href="{{ route('perpustakaan.hadir') }}" class="ki-card">
            <div class="ki-card-icon hadir">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <h2>Isi Daftar Hadir</h2>
            <p>Catat kunjungan Anda ke perpustakaan hari ini</p>
            <span class="ki-btn hadir">Isi Sekarang</span>
        </a>

        <a href="{{ route('perpustakaan.katalog') }}" class="ki-card">
            <div class="ki-card-icon katalog">
                <i class="fas fa-book-open"></i>
            </div>
            <h2>Cari Katalog Buku</h2>
            <p>Temukan buku yang Anda cari di koleksi perpustakaan</p>
            <span class="ki-btn katalog">Cari Buku</span>
        </a>
    </div>
</x-kiosk>
