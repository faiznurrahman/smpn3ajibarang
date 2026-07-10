<x-kiosk>
    <x-slot name="title">Daftar Hadir Berhasil</x-slot>

    <style>
        .ks-wrap {
            max-width: 460px; margin: 0 auto; text-align: center;
        }
        .ks-card {
            background: #fff; border-radius: 18px;
            padding: 52px 32px;
            box-shadow: 0 4px 20px rgba(13,115,119,.09);
        }
        .ks-icon {
            width: 88px; height: 88px;
            background: #dcfce7; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 44px; color: #16a34a;
            margin: 0 auto 24px;
        }
        .ks-title { font-size: 26px; font-weight: 800; color: #1e293b; margin-bottom: 8px; }
        .ks-name  { font-size: 20px; font-weight: 700; color: var(--k-navy); margin-bottom: 8px; }
        .ks-desc  { font-size: 14px; color: #64748b; line-height: 1.6; margin-bottom: 32px; }
        .ks-countdown { font-size: 13px; color: #94a3b8; margin-bottom: 18px; }
        .ks-btn {
            display: inline-block; padding: 13px 36px;
            background: var(--k-navy); color: #fff;
            border-radius: 10px; font-size: 15px; font-weight: 700;
            text-decoration: none;
        }
        .ks-progress {
            height: 4px; background: #e2e8f0; border-radius: 999px;
            margin-top: 28px; overflow: hidden;
        }
        .ks-progress-bar {
            height: 100%; background: var(--k-navy);
            border-radius: 999px; width: 100%;
            transition: width 1s linear;
        }
    </style>

    <div class="ks-wrap">
        <div class="ks-card">
            <div class="ks-icon"><i class="fas fa-check"></i></div>
            <div class="ks-title">Terima Kasih!</div>
            <div class="ks-name">{{ $nama }}</div>
            <div class="ks-desc">
                Daftar hadir Anda telah berhasil dicatat.<br>
                Selamat berkunjung di Perpustakaan SMPN 3 Ajibarang.
            </div>
            <div class="ks-countdown" id="countdown-text">Kembali ke layanan dalam <strong id="ctr">8</strong> detik...</div>
            <a href="{{ route('perpustakaan.layanan') }}" class="ks-btn" id="back-btn">
                Kembali ke Layanan
            </a>
            <div class="ks-progress">
                <div class="ks-progress-bar" id="prog"></div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
    <script>
    (function () {
        let sisa = 8;
        const ctr  = document.getElementById('ctr');
        const prog = document.getElementById('prog');

        prog.style.width = '100%';
        setTimeout(() => { prog.style.width = '0%'; prog.style.transitionDuration = sisa + 's'; }, 50);

        const iv = setInterval(() => {
            sisa--;
            ctr.textContent = sisa;
            if (sisa <= 0) {
                clearInterval(iv);
                window.location.href = '{{ route('perpustakaan.layanan') }}';
            }
        }, 1000);

        document.getElementById('back-btn').addEventListener('click', () => clearInterval(iv));
    })();
    </script>
    </x-slot>
</x-kiosk>
