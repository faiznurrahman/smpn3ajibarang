@php
    use Carbon\Carbon;
    $isLate    = $record->status !== 'dikembalikan' && $record->tgl_batas_kembali?->lt(Carbon::today());
    $hariLate  = $record->jumlahHariTerlambat();
    $hasSanksi = $record->jenis_sanksi && $record->jenis_sanksi !== 'tidak_ada';
    $idStr     = 'LNS-' . $record->tgl_pinjam?->format('Ymd') . '-' . str_pad($record->id, 4, '0', STR_PAD_LEFT);

    $statusLabel = match($record->status) {
        'dipinjam'     => 'Dipinjam',
        'terlambat'    => 'Terlambat',
        'dikembalikan' => 'Dikembalikan',
        default        => $record->status,
    };
    $statusBg = match($record->status) {
        'dipinjam'     => '#fffbeb; color:#b45309',
        'terlambat'    => '#fee2e2; color:#dc2626',
        'dikembalikan' => '#e6f7ed; color:#16a34a',
        default        => '#f1f3f8; color:#5a6478',
    };
    $sanksiLabel = match($record->jenis_sanksi) {
        'ganti_buku'  => 'Ganti Buku',
        'bayar_harga' => 'Bayar Harga Buku',
        default        => '—',
    };
    $sanksiStatusLabel = match($record->status_sanksi) {
        'belum_lunas' => 'Belum Lunas',
        'lunas'       => 'Lunas',
        default        => '—',
    };
@endphp
<div style="font-size:13.5px; line-height:1.6;">

    {{-- ── ID Peminjaman ── --}}
    <div style="text-align:center; margin-bottom:16px;">
        <span style="font-family:'SF Mono','Fira Code',ui-monospace,monospace; font-size:12.5px; font-weight:700; letter-spacing:.06em; color:#8b94a6; background:#f6f7f9; border-radius:8px; padding:6px 14px; display:inline-block;">
            {{ $idStr }}
        </span>
    </div>

    {{-- ── Data Anggota ── --}}
    <div style="margin-bottom:16px;">
        <div style="font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.09em; color:#8b94a6; margin-bottom:8px; padding-bottom:6px; border-bottom:1px solid #e6eaf2;">
            Data Anggota
        </div>
        @php $rows = [
            ['Nama Lengkap',  $record->member?->nama ?? '—'],
            ['Kode Anggota',  $record->member?->kode_anggota ?? '—'],
            ['Kelas',         $record->member?->kelas ?? '—'],
            ['Angkatan',      $record->member?->tahun_masuk ? 'Angkatan ' . $record->member->tahun_masuk : '—'],
        ]; @endphp
        @foreach($rows as [$lbl, $val])
        <div style="display:flex; gap:12px; padding:5px 0; border-bottom:1px solid #f8f9fc;">
            <span style="min-width:130px; font-size:12px; color:#8b94a6; font-weight:600; flex-shrink:0;">{{ $lbl }}</span>
            <span style="color:#0f172a; font-weight:500;">{{ $val }}</span>
        </div>
        @endforeach
    </div>

    {{-- ── Data Buku ── --}}
    <div style="margin-bottom:16px;">
        <div style="font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.09em; color:#8b94a6; margin-bottom:8px; padding-bottom:6px; border-bottom:1px solid #e6eaf2;">
            Data Buku
        </div>
        @php $rows = [
            ['Judul Buku',    $record->book?->judul ?? '—'],
            ['Kode Buku',     $record->book?->kode_buku ?? '—'],
            ['Kode Eksemplar', $record->bookItem?->kode_item ?? '—'],
            ['Penulis',       $record->book?->penulis ?? '—'],
            ['Penerbit',      $record->book?->penerbit ?? '—'],
        ]; @endphp
        @foreach($rows as [$lbl, $val])
        <div style="display:flex; gap:12px; padding:5px 0; border-bottom:1px solid #f8f9fc;">
            <span style="min-width:130px; font-size:12px; color:#8b94a6; font-weight:600; flex-shrink:0;">{{ $lbl }}</span>
            <span style="color:#0f172a; font-weight:500; font-family:{{ in_array($lbl, ['Kode Buku','Kode Eksemplar']) ? '\'SF Mono\',monospace' : 'inherit' }};">{{ $val }}</span>
        </div>
        @endforeach
    </div>

    {{-- ── Data Peminjaman ── --}}
    <div style="margin-bottom:16px;">
        <div style="font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.09em; color:#8b94a6; margin-bottom:8px; padding-bottom:6px; border-bottom:1px solid #e6eaf2;">
            Data Peminjaman
        </div>

        <div style="display:flex; gap:12px; padding:5px 0; border-bottom:1px solid #f8f9fc;">
            <span style="min-width:130px; font-size:12px; color:#8b94a6; font-weight:600; flex-shrink:0;">Tanggal Pinjam</span>
            <span style="color:#0f172a; font-weight:500;">{{ $record->tgl_pinjam?->translatedFormat('d F Y') ?? '—' }}</span>
        </div>

        <div style="display:flex; gap:12px; padding:5px 0; border-bottom:1px solid #f8f9fc;">
            <span style="min-width:130px; font-size:12px; color:#8b94a6; font-weight:600; flex-shrink:0;">Batas Kembali</span>
            <span style="color:{{ $isLate ? '#dc2626' : '#0f172a' }}; font-weight:{{ $isLate ? '700' : '500' }};">
                {{ $record->tgl_batas_kembali?->translatedFormat('d F Y') ?? '—' }}
            </span>
        </div>

        <div style="display:flex; gap:12px; padding:5px 0; border-bottom:1px solid #f8f9fc;">
            <span style="min-width:130px; font-size:12px; color:#8b94a6; font-weight:600; flex-shrink:0;">Tgl Dikembalikan</span>
            <span style="color:#0f172a; font-weight:500;">{{ $record->tgl_kembali?->translatedFormat('d F Y') ?? '—' }}</span>
        </div>

        @if($hariLate > 0)
        <div style="display:flex; gap:12px; padding:5px 0; border-bottom:1px solid #f8f9fc;">
            <span style="min-width:130px; font-size:12px; color:#8b94a6; font-weight:600; flex-shrink:0;">Hari Terlambat</span>
            <span style="color:#dc2626; font-weight:700;">+{{ $hariLate }} hari</span>
        </div>
        @endif

        <div style="display:flex; gap:12px; padding:5px 0; border-bottom:1px solid #f8f9fc; align-items:center;">
            <span style="min-width:130px; font-size:12px; color:#8b94a6; font-weight:600; flex-shrink:0;">Status</span>
            <span style="padding:2px 10px; border-radius:999px; font-size:11.5px; font-weight:600; background:{{ $statusBg }};">
                {{ $statusLabel }}
            </span>
        </div>

        <div style="display:flex; gap:12px; padding:5px 0; border-bottom:1px solid #f8f9fc;">
            <span style="min-width:130px; font-size:12px; color:#8b94a6; font-weight:600; flex-shrink:0;">Jumlah Perpanjangan</span>
            <span style="color:#0f172a; font-weight:500;">
                {{ $record->jumlah_perpanjangan }} dari 2x
                @if($record->jumlah_perpanjangan >= 2)
                    <span style="margin-left:6px; padding:1px 8px; border-radius:999px; font-size:11px; font-weight:600; background:#fee2e2; color:#dc2626;">Maks</span>
                @endif
            </span>
        </div>

        <div style="display:flex; gap:12px; padding:5px 0; border-bottom:1px solid #f8f9fc;">
            <span style="min-width:130px; font-size:12px; color:#8b94a6; font-weight:600; flex-shrink:0;">Tgl Perpanjangan</span>
            <span style="color:#0f172a; font-weight:500;">
                {{ $record->tgl_perpanjangan_terakhir?->translatedFormat('d F Y') ?? 'Belum pernah diperpanjang' }}
            </span>
        </div>

        <div style="display:flex; gap:12px; padding:5px 0;">
            <span style="min-width:130px; font-size:12px; color:#8b94a6; font-weight:600; flex-shrink:0;">Petugas</span>
            <span style="color:#0f172a; font-weight:500;">{{ $record->petugas?->name ?? '—' }}</span>
        </div>
    </div>

    {{-- ── Sanksi ── --}}
    @php
        $kondisiLabel = match($record->kondisi_kembali) {
            'baik'   => 'Baik',
            'rusak'  => 'Rusak',
            'hilang' => 'Hilang',
            default  => null,
        };
        $kondisiBg = match($record->kondisi_kembali) {
            'baik'   => '#e6f7ed; color:#16a34a',
            'rusak'  => '#fffbeb; color:#b45309',
            'hilang' => '#fee2e2; color:#dc2626',
            default  => '#f1f3f8; color:#5a6478',
        };
        $statusSanksiBg = match($record->status_sanksi) {
            'lunas'       => '#e6f7ed; color:#16a34a',
            'belum_lunas' => '#fee2e2; color:#dc2626',
            default       => '#f1f3f8; color:#5a6478',
        };
    @endphp
    <div>
        <div style="font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.09em; color:#8b94a6; margin-bottom:8px; padding-bottom:6px; border-bottom:1px solid #e6eaf2;">
            Sanksi
        </div>

        @if($hasSanksi)

        @if($kondisiLabel)
        <div style="display:flex; gap:12px; padding:5px 0; border-bottom:1px solid #f8f9fc; align-items:center;">
            <span style="min-width:130px; font-size:12px; color:#8b94a6; font-weight:600; flex-shrink:0;">Kondisi Kembali</span>
            <span style="padding:2px 10px; border-radius:999px; font-size:11.5px; font-weight:600; background:{{ $kondisiBg }};">
                {{ $kondisiLabel }}
            </span>
        </div>
        @endif

        <div style="display:flex; gap:12px; padding:5px 0; border-bottom:1px solid #f8f9fc;">
            <span style="min-width:130px; font-size:12px; color:#8b94a6; font-weight:600; flex-shrink:0;">Jenis Sanksi</span>
            <span style="color:#0f172a; font-weight:500;">{{ $sanksiLabel }}</span>
        </div>

        <div style="display:flex; gap:12px; padding:5px 0; border-bottom:1px solid #f8f9fc;">
            <span style="min-width:130px; font-size:12px; color:#8b94a6; font-weight:600; flex-shrink:0;">Nominal Sanksi</span>
            <span style="color:{{ $record->nominal_sanksi ? '#dc2626' : '#0f172a' }}; font-weight:{{ $record->nominal_sanksi ? '600' : '500' }};">
                {{ $record->nominal_sanksi ? 'Rp ' . number_format((float) $record->nominal_sanksi, 0, ',', '.') : '—' }}
            </span>
        </div>

        <div style="display:flex; gap:12px; padding:5px 0; border-bottom:1px solid #f8f9fc; align-items:center;">
            <span style="min-width:130px; font-size:12px; color:#8b94a6; font-weight:600; flex-shrink:0;">Status Sanksi</span>
            @if($record->status_sanksi && $record->status_sanksi !== 'tidak_ada')
            <span style="padding:2px 10px; border-radius:999px; font-size:11.5px; font-weight:600; background:{{ $statusSanksiBg }};">
                {{ $sanksiStatusLabel }}
            </span>
            @else
            <span style="color:#0f172a; font-weight:500;">—</span>
            @endif
        </div>

        <div style="display:flex; gap:12px; padding:5px 0; border-bottom:1px solid #f8f9fc;">
            <span style="min-width:130px; font-size:12px; color:#8b94a6; font-weight:600; flex-shrink:0;">Tgl Selesai</span>
            <span style="color:#0f172a; font-weight:500;">
                {{ $record->tgl_selesai_sanksi?->translatedFormat('d F Y') ?? 'Belum diselesaikan' }}
            </span>
        </div>

        <div style="display:flex; gap:12px; padding:5px 0;">
            <span style="min-width:130px; font-size:12px; color:#8b94a6; font-weight:600; flex-shrink:0;">Catatan</span>
            <span style="color:#0f172a; font-weight:500;">{{ $record->catatan_sanksi ?? '—' }}</span>
        </div>

        @else
        <p style="font-size:12.5px; color:#8b94a6; margin:4px 0 0; font-style:italic;">Tidak ada sanksi pada peminjaman ini.</p>
        @endif
    </div>

</div>
