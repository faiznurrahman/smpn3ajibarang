@props([
    'id',
    'field',
    'action',
    'label' => 'Scan Barcode',
])

<div
    x-data="qrScanner({
        elementId: '{{ $id }}-reader',
        onScan: (kode) => { $wire.set('{{ $field }}', kode); $wire.call('{{ $action }}'); },
    })"
>
    <style>
        .qrs-trigger {
            height: 40px; padding: 0 16px; border-radius: 8px;
            border: 1.5px solid #1e3a8a; background: white; color: #1e3a8a;
            font: inherit; font-size: 13px; font-weight: 600; cursor: pointer;
            display: inline-flex; align-items: center; gap: 7px;
            transition: background 120ms; flex-shrink: 0;
        }
        .qrs-trigger:hover { background: #eef2ff; }

        .qrs-modal-bg {
            position: fixed; inset: 0; background: rgba(15, 23, 42, .6);
            z-index: 9999; display: flex; align-items: center; justify-content: center; padding: 20px;
        }
        .qrs-modal {
            background: white; border-radius: 16px; width: 100%; max-width: 400px;
            overflow: hidden; box-shadow: 0 20px 48px rgba(15, 23, 42, .2);
        }
        .qrs-modal-head {
            background: #1e3a8a; padding: 16px 20px;
            display: flex; align-items: center; justify-content: space-between; color: white;
        }
        .qrs-modal-head h3 { margin: 0; font-size: 15px; font-weight: 700; }
        .qrs-modal-head p { margin: 2px 0 0; font-size: 12px; opacity: .8; }
        .qrs-modal-close {
            background: transparent; border: none; color: white; cursor: pointer;
            padding: 4px; display: flex; flex-shrink: 0;
        }
        .qrs-modal-body { padding: 18px 20px; }
        .qrs-reader-box {
            width: 100%; border-radius: 10px; overflow: hidden;
            background: #0f172a; min-height: 240px;
        }
        .qrs-error {
            margin-top: 12px; padding: 10px 12px; background: #fee2e2;
            border: 1px solid #fca5a5; border-radius: 8px;
            font-size: 12.5px; color: #dc2626; font-weight: 500;
        }
        .qrs-hint { margin: 10px 0 0; font-size: 11.5px; color: #8b94a6; text-align: center; }
        .qrs-modal-foot { padding: 0 20px 18px; }
        .qrs-btn-cancel {
            width: 100%; height: 40px; border-radius: 8px; border: 1px solid #e6eaf2;
            background: white; color: #0f172a; font: inherit; font-size: 13px;
            font-weight: 600; cursor: pointer; transition: background 120ms;
        }
        .qrs-btn-cancel:hover { background: #f5f7fc; }

        @media (max-width: 1023px) {
            .qrs-trigger { width: 100%; justify-content: center; height: 50px; font-size: 14.5px; }
        }
    </style>

    <button type="button" class="qrs-trigger" @click="open()">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
            <path d="M3 7V5a2 2 0 0 1 2-2h2" /><path d="M17 3h2a2 2 0 0 1 2 2v2" />
            <path d="M21 17v2a2 2 0 0 1-2 2h-2" /><path d="M7 21H5a2 2 0 0 1-2-2v-2" />
            <rect x="7" y="7" width="10" height="10" rx="1" />
        </svg>
        {{ $label }}
    </button>

    <div x-show="isOpen" x-cloak x-transition.opacity class="qrs-modal-bg" @click.self="close()">
        <div class="qrs-modal">
            <div class="qrs-modal-head">
                <div>
                    <h3>Scan QR Eksemplar</h3>
                    <p>Arahkan kamera ke QR Code pada label eksemplar</p>
                </div>
                <button type="button" class="qrs-modal-close" @click="close()">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
            <div class="qrs-modal-body">
                <div id="{{ $id }}-reader" class="qrs-reader-box" x-show="isOpen"></div>

                <template x-if="cameraError">
                    <div class="qrs-error" x-text="cameraError"></div>
                </template>

                <p class="qrs-hint">Kamera otomatis berhenti setelah QR Code berhasil terbaca</p>
            </div>
            <div class="qrs-modal-foot">
                <button type="button" class="qrs-btn-cancel" @click="close()">
                    Batal / Tutup Scanner
                </button>
            </div>
        </div>
    </div>
</div>
