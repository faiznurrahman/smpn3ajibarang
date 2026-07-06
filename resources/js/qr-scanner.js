import { Html5Qrcode } from 'html5-qrcode';

document.addEventListener('alpine:init', () => {
    Alpine.data('qrScanner', ({ elementId, onScan }) => ({
        isOpen: false,
        cameraError: '',
        scanner: null,
        starting: false,

        open() {
            this.cameraError = '';
            this.isOpen = true;
            this.$nextTick(() => this.startScanner());
        },

        async close() {
            this.isOpen = false;
            await this.stopScanner();
        },

        async startScanner() {
            if (this.starting) {
                return;
            }
            this.starting = true;

            try {
                this.scanner = new Html5Qrcode(elementId);
                await this.scanner.start(
                    { facingMode: 'environment' },
                    { fps: 10, qrbox: { width: 230, height: 230 } },
                    (decodedText) => {
                        const kode = decodedText.trim();
                        this.stopScanner();
                        this.isOpen = false;
                        onScan(kode);
                    },
                    () => {
                        // per-frame "QR belum terbaca" — abaikan, bukan error
                    },
                );
            } catch (error) {
                this.cameraError = this.pesanErrorKamera(error);
            } finally {
                this.starting = false;
            }
        },

        async stopScanner() {
            if (!this.scanner) {
                return;
            }
            try {
                if (this.scanner.isScanning) {
                    await this.scanner.stop();
                }
                this.scanner.clear();
            } catch (error) {
                // kamera mungkin sudah berhenti sendiri, aman diabaikan
            }
            this.scanner = null;
        },

        pesanErrorKamera(error) {
            const name = error?.name || '';

            if (name === 'NotAllowedError' || name === 'PermissionDeniedError') {
                return 'Akses kamera ditolak. Izinkan akses kamera pada browser untuk memakai fitur scan.';
            }
            if (name === 'NotFoundError' || name === 'DevicesNotFoundError') {
                return 'Kamera tidak ditemukan pada perangkat ini.';
            }
            if (name === 'NotReadableError') {
                return 'Kamera sedang dipakai aplikasi lain. Tutup aplikasi tersebut lalu coba lagi.';
            }

            return 'Gagal mengaktifkan kamera. Gunakan input manual sebagai alternatif.';
        },
    }));
});
