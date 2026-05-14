@php
    $logo        = \App\Models\Setting::value('logo');
    $namaSekolah = \App\Models\Setting::value('nama_sekolah') ?: 'SMPN 3 Ajibarang';
@endphp

<div class="sb-brand">
    @if ($logo)
        <img src="{{ asset('storage/' . $logo) }}"
             alt="Logo {{ $namaSekolah }}"
             class="sb-logo" />
    @else
        <div class="sb-mark-fallback"><span>S3</span></div>
    @endif

    <div class="sb-text">
        <b>{{ $namaSekolah }}</b>
        <span>Panel Admin</span>
    </div>
</div>

<style>
    .sb-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 18px;
        border-bottom: 1px solid #e6eaf2;
    }

    /* Logo dari settings — langsung tampil tanpa kotak pembatas */
    .sb-logo {
        width: 42px;
        height: 42px;
        object-fit: contain;
        flex-shrink: 0;
        display: block;
    }

    /* Fallback S3 mark bila belum ada logo */
    .sb-mark-fallback {
        width: 42px; height: 42px;
        border-radius: 10px;
        background: #1e3a8a;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .sb-mark-fallback span {
        color: white;
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 0.3px;
    }

    .sb-text {
        display: flex;
        flex-direction: column;
        line-height: 1.15;
        min-width: 0;
    }
    .sb-text b {
        font-size: 13.5px;
        font-weight: 700;
        color: #0f172a;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .sb-text span {
        font-size: 10px;
        color: #8b94a6;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        margin-top: 3px;
    }

    /* Sembunyikan default Filament brand */
    .fi-sidebar-header-logo-ctn { display: none !important; }
</style>
