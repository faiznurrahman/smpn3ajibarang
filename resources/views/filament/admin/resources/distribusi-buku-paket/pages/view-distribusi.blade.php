<x-filament-panels::page>
<div class="vdb">
<style>
.vdb {
    --pri:#1e3a8a; --pri-2:#2746a4; --pri-50:#eef2ff;
    --ok:#16a34a;  --ok-50:#e6f7ed;
    --warn:#b45309; --warn-50:#fffbeb;
    --err:#dc2626; --err-50:#fee2e2;
    --t1:#0f172a; --t2:#5a6478; --t3:#8b94a6;
    --line:#e6eaf2; --panel:#fff;
    --r:14px; --sh:0 1px 2px rgba(15,23,42,.04);
}

/* Info card */
.vdb-info {
    background:var(--panel); border:1px solid var(--line);
    border-radius:var(--r); box-shadow:var(--sh);
    padding:18px 22px; margin-bottom:18px;
    display:flex; flex-wrap:wrap; gap:24px;
}
.vdb-info-item { display:flex; flex-direction:column; gap:2px; }
.vdb-info-label { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.07em; color:var(--t3); }
.vdb-info-val { font-size:14px; font-weight:600; color:var(--t1); }

/* Tabs */
.vdb-tabs {
    display:flex; gap:0; overflow-x:auto;
    border-bottom:2px solid var(--line);
    margin-bottom:0;
}
.vdb-tab {
    padding:11px 18px; background:none; border:none; cursor:pointer;
    font:inherit; font-size:13px; font-weight:600; color:var(--t3);
    white-space:nowrap; border-bottom:2px solid transparent; margin-bottom:-2px;
    transition:color 120ms;
}
.vdb-tab:hover { color:var(--t2); }
.vdb-tab.active { color:var(--pri); border-bottom-color:var(--pri); }

/* Card */
.vdb-card {
    background:var(--panel); border:1px solid var(--line);
    border-radius:0 0 var(--r) var(--r); border-top:none;
    box-shadow:var(--sh);
}

/* Table */
.vdb-tbl-wrap { overflow-x:auto; }
.vdb-tbl { width:100%; border-collapse:collapse; font-size:13px; }
.vdb-tbl thead tr { background:#f8f9fc; border-bottom:1px solid var(--line); }
.vdb-tbl th {
    padding:10px 14px; text-align:left; font-size:11px; font-weight:700;
    text-transform:uppercase; letter-spacing:.07em; color:var(--t3); white-space:nowrap;
}
.vdb-tbl th.center { text-align:center; }
.vdb-tbl tbody tr { border-bottom:1px solid #f1f3f8; transition:background 80ms; }
.vdb-tbl tbody tr:last-child { border-bottom:none; }
.vdb-tbl tbody tr:hover { background:#fafbfd; }
.vdb-tbl td { padding:9px 14px; color:var(--t1); vertical-align:middle; }
.vdb-tbl td.center { text-align:center; }
.vdb-tbl td.mono { font-family:'SF Mono','Fira Code',ui-monospace,monospace; font-size:12px; letter-spacing:.02em; }

/* Badges */
.vdb-badge {
    display:inline-flex; align-items:center; padding:2px 10px;
    border-radius:999px; font-size:11px; font-weight:600; line-height:1.5;
}
.vdb-badge.ok     { background:var(--ok-50); color:var(--ok); }
.vdb-badge.warn   { background:var(--warn-50); color:var(--warn); }
.vdb-badge.err    { background:var(--err-50); color:var(--err); }
.vdb-badge.gray   { background:#f1f3f8; color:var(--t2); }
.vdb-badge.blue   { background:var(--pri-50); color:var(--pri); }

.vdb-empty {
    padding:36px 20px; text-align:center;
    font-size:13px; color:var(--t3);
}
</style>

{{-- Distribution info --}}
<div class="vdb-info">
    <div class="vdb-info-item">
        <span class="vdb-info-label">Tahun Ajaran</span>
        <span class="vdb-info-val">{{ $this->distribution->tahun_ajaran }}</span>
    </div>
    <div class="vdb-info-item">
        <span class="vdb-info-label">Tingkat</span>
        <span class="vdb-info-val">Kelas {{ $this->distribution->untuk_tingkat }}</span>
    </div>
    <div class="vdb-info-item">
        <span class="vdb-info-label">Tgl Distribusi</span>
        <span class="vdb-info-val">{{ $this->distribution->tgl_distribusi?->format('d M Y') ?? '—' }}</span>
    </div>
    <div class="vdb-info-item">
        <span class="vdb-info-label">Tgl Kembali Rencana</span>
        <span class="vdb-info-val">{{ $this->distribution->tgl_kembali_rencana?->format('d M Y') ?? '—' }}</span>
    </div>
    <div class="vdb-info-item">
        <span class="vdb-info-label">Status</span>
        <span class="vdb-info-val">
            @if($this->distribution->status === 'aktif')
                <span class="vdb-badge warn">Aktif</span>
            @else
                <span class="vdb-badge ok">Selesai</span>
            @endif
        </span>
    </div>
    <div class="vdb-info-item">
        <span class="vdb-info-label">Jumlah Siswa</span>
        <span class="vdb-info-val">{{ $this->distribution->jumlah_siswa }}</span>
    </div>
    <div class="vdb-info-item">
        <span class="vdb-info-label">Sudah Kembali</span>
        <span class="vdb-info-val">{{ $this->distribution->jumlah_kembali }}</span>
    </div>
</div>

@if(empty($this->tabs))
    <div class="vdb-card">
        <div class="vdb-empty">Belum ada buku paket yang didistribusikan dalam batch ini.</div>
    </div>
@else
    {{-- Tabs --}}
    <div class="vdb-tabs">
        @foreach($this->tabs as $tab)
            <button
                class="vdb-tab {{ $this->activeTab == $tab['id'] ? 'active' : '' }}"
                wire:click="setActiveTab('{{ $tab['id'] }}')"
            >
                {{ $tab['judul'] }}
                <span style="font-size:11px;font-weight:400;color:var(--t3);margin-left:4px;">{{ $tab['mata_pelajaran'] }}</span>
            </button>
        @endforeach
    </div>

    <div class="vdb-card">
        @php $activeItems = $this->getActiveItems(); @endphp
        @if(empty($activeItems))
            <div class="vdb-empty">Belum ada data untuk buku paket ini.</div>
        @else
            <div class="vdb-tbl-wrap">
                <table class="vdb-tbl">
                    <thead>
                        <tr>
                            <th class="center" style="width:50px">No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Kode Eksemplar</th>
                            <th>Kondisi Kembali</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activeItems as $item)
                        <tr>
                            <td class="center" style="font-size:12px;color:var(--t3)">{{ $item['no'] }}</td>
                            <td style="font-weight:600">{{ $item['nama'] }}</td>
                            <td>{{ $item['kelas'] }}</td>
                            <td class="mono">{{ $item['kode_item'] }}</td>
                            <td>
                                @php $k = $item['kondisi_kembali']; @endphp
                                @if($k)
                                    @php $kLabel = match($k) {
                                        'baik' => 'Baik', 'rusak_ringan' => 'Rusak Ringan',
                                        'rusak_berat' => 'Rusak Berat', 'hilang' => 'Hilang', default => $k
                                    }; $kClass = match($k) {
                                        'baik' => 'ok', 'rusak_ringan' => 'warn',
                                        'rusak_berat' => 'err', 'hilang' => 'err', default => 'gray'
                                    }; @endphp
                                    <span class="vdb-badge {{ $kClass }}">{{ $kLabel }}</span>
                                @else
                                    <span style="color:var(--t3);font-size:12px">Belum kembali</span>
                                @endif
                            </td>
                            <td style="font-size:12.5px">{{ $item['tgl_kembali'] ?? '—' }}</td>
                            <td>
                                @php $ss = $item['status_sanksi']; @endphp
                                @if($ss === 'belum_lunas')
                                    <span class="vdb-badge err">Sanksi Belum Lunas</span>
                                @elseif($ss === 'lunas')
                                    <span class="vdb-badge ok">Lunas</span>
                                @elseif($item['kondisi_kembali'])
                                    <span class="vdb-badge ok">Selesai</span>
                                @else
                                    <span class="vdb-badge gray">Dipinjam</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endif

</div>
</x-filament-panels::page>
