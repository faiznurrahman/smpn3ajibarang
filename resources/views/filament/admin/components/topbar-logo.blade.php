@php
    $logo        = \App\Models\Setting::value('logo');
    $namaSekolah = \App\Models\Setting::value('nama_sekolah') ?: 'SMPN 3 Ajibarang';
@endphp

<div class="tbl-wrap">
    @if ($logo)
        <img src="{{ asset('storage/' . $logo) }}"
             alt="Logo {{ $namaSekolah }}"
             class="tbl-logo" />
    @else
        <div class="tbl-mark"><span>S3</span></div>
    @endif
    <span class="tbl-name">{{ $namaSekolah }}</span>
</div>

<style>
    .tbl-wrap {
        width: var(--sidebar-width);
        box-sizing: border-box;
        display: flex;
        align-items: center;
        gap: 10px;
        height: 64px;
        padding: 0 20px;
        border-right: 1px solid #e6eaf2;
        flex-shrink: 0;
    }

    /* Logo dari Settings */
    .tbl-logo {
        width: 34px;
        height: 34px;
        object-fit: contain;
        display: block;
        flex-shrink: 0;
    }

    /* Fallback S3 mark */
    .tbl-mark {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: #1e3a8a;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .tbl-mark span {
        color: white;
        font-weight: 700;
        font-size: 13px;
        letter-spacing: 0.3px;
    }

    /* Nama sekolah */
    .tbl-name {
        font-size: 13.5px;
        font-weight: 700;
        color: #0f172a;
        white-space: nowrap;
        letter-spacing: -0.01em;
        line-height: 1;
    }

    /* Mobile: sembunyikan nama, cukup logo */
    @media (max-width: 640px) {
        .tbl-name { display: none; }
        .tbl-wrap { padding: 0 14px; }
    }
</style>
