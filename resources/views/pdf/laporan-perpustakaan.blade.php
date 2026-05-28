<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Perpustakaan - {{ $periode }}</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'DejaVu Sans', sans-serif; font-size: 9pt; color: #0f172a; background: #fff; line-height: 1.4; }

  /* Tabel utama */
  .tbl-main { width: 100%; border-collapse: collapse; }

  /* Seksi tabel data */
  .tbl { width: 100%; border-collapse: collapse; font-size: 8pt; margin-top: 0; }
  .tbl thead th {
    background: #e8efff; color: #1e3a8a; font-weight: 700;
    padding: 6px 8px; text-align: left; border: 1px solid #c7d2f0;
    font-size: 7.5pt; text-transform: uppercase; letter-spacing: 0.4px;
  }
  .tbl tbody td { padding: 5px 8px; border: 1px solid #e6eaf2; vertical-align: top; }
  .tbl tbody tr:nth-child(even) td { background: #fafbfd; }
  .tbl tfoot td { padding: 6px 8px; border: 1px solid #c7d2f0; background: #e8efff; font-weight: 700; font-size: 8pt; }

  /* Header seksi */
  .sec-head { background: #1e3a8a; color: #fff; padding: 8px 12px; margin-bottom: 0; }
  .sec-head-title { font-size: 10pt; font-weight: 700; }
  .sec-head-sub   { font-size: 7.5pt; color: #b8c8f0; margin-top: 2px; }

  /* Badge */
  .badge { display: inline; padding: 1px 5px; border-radius: 3px; font-size: 7pt; font-weight: 700; }
  .b-ok   { background: #dcfce7; color: #15803d; }
  .b-warn { background: #fef3c7; color: #92400e; }
  .b-red  { background: #fee2e2; color: #b91c1c; }
  .b-gray { background: #f1f5f9; color: #64748b; }
  .b-pri  { background: #dbeafe; color: #1d4ed8; }
  .b-vio  { background: #ede9fe; color: #6d28d9; }

  /* Utility */
  .sub  { font-size: 7pt; color: #8b94a6; margin-top: 1px; }
  .mono { font-size: 7.5pt; color: #64748b; }
  .bold { font-weight: 700; }
  .red  { color: #b91c1c; font-weight: 700; }
  .ok   { color: #15803d; font-weight: 700; }
  .ta-r { text-align: right; }
  .ta-c { text-align: center; }
  .num  { color: #5a6478; }
  .empty-row td { text-align: center; color: #94a3b8; font-style: italic; padding: 14px 8px; }

  .divider { height: 16px; }
  .page-break { page-break-before: always; }
</style>
</head>
<body>

{{-- KOP SURAT --}}
<table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:12px;border-bottom:3px solid #1e3a8a;padding-bottom:10px;">
  <tr>
    <td width="62" valign="middle">
      @if($logoBase64)
        <img src="{{ $logoBase64 }}" width="52" height="52" style="object-fit:contain;display:block;" alt="Logo">
      @else
        <table width="48" height="48" cellpadding="0" cellspacing="0" style="background:#1e3a8a;border-radius:8px;">
          <tr><td align="center" valign="middle" style="color:#fff;font-size:16pt;font-weight:700;padding:0;">S3</td></tr>
        </table>
      @endif
    </td>
    <td valign="middle" style="padding-left:10px;">
      <div style="font-size:13pt;font-weight:700;color:#1e3a8a;">{{ $setting?->nama_sekolah ?? 'SMPN 3 Ajibarang' }}</div>
      <div style="font-size:8pt;color:#5a6478;margin-top:2px;">
        {{ $setting?->alamat ?: 'Jl. Raya Ajibarang Timur No. 53 Ajibarang, Banyumas, Jawa Tengah' }}
      </div>
      @if($setting?->no_telp)
      <div style="font-size:8pt;color:#5a6478;margin-top:1px;">Telp: {{ $setting->no_telp }}</div>
      @endif
    </td>
  </tr>
</table>

{{-- JUDUL LAPORAN --}}
<div style="text-align:center;margin-bottom:14px;">
  <div style="font-size:13pt;font-weight:700;color:#1e3a8a;text-transform:uppercase;letter-spacing:1px;">Laporan Perpustakaan</div>
  <div style="font-size:8.5pt;color:#5a6478;margin-top:4px;">
    Periode: {{ $periode }} &nbsp;|&nbsp; Dicetak: {{ now()->locale('id')->translatedFormat('d F Y, H:i') }} WIB
  </div>
</div>

{{-- RINGKASAN --}}
<table width="100%" cellpadding="10" cellspacing="0" style="border-collapse:collapse;margin-bottom:18px;border:1px solid #e6eaf2;">
  <tr>
    <td width="25%" style="text-align:center;border-right:1px solid #e6eaf2;">
      <div style="font-size:22pt;font-weight:700;color:#1e3a8a;">{{ $loans->count() }}</div>
      <div style="font-size:7.5pt;color:#5a6478;text-transform:uppercase;letter-spacing:.5px;margin-top:2px;">Peminjaman</div>
    </td>
    <td width="25%" style="text-align:center;border-right:1px solid #e6eaf2;">
      <div style="font-size:22pt;font-weight:700;color:#dc2626;">{{ $fines->count() }}</div>
      <div style="font-size:7.5pt;color:#5a6478;text-transform:uppercase;letter-spacing:.5px;margin-top:2px;">Kasus Denda</div>
    </td>
    <td width="25%" style="text-align:center;border-right:1px solid #e6eaf2;">
      <div style="font-size:22pt;font-weight:700;color:#7c3aed;">{{ $sanksis->count() }}</div>
      <div style="font-size:7.5pt;color:#5a6478;text-transform:uppercase;letter-spacing:.5px;margin-top:2px;">Sanksi Buku</div>
    </td>
    <td width="25%" style="text-align:center;">
      <div style="font-size:22pt;font-weight:700;color:#16a34a;">{{ $visits->count() }}</div>
      <div style="font-size:7.5pt;color:#5a6478;text-transform:uppercase;letter-spacing:.5px;margin-top:2px;">Kunjungan</div>
    </td>
  </tr>
</table>

{{-- =============================================
     SEKSI 1: PEMINJAMAN
============================================= --}}
<div class="sec-head">
  <div class="sec-head-title">1. Rekap Peminjaman Buku</div>
  <div class="sec-head-sub">
    Total: {{ $loans->count() }} &nbsp;|&nbsp;
    Dipinjam: {{ $loans->where('status','dipinjam')->count() }} &nbsp;|&nbsp;
    Terlambat: {{ $loans->where('status','terlambat')->count() }} &nbsp;|&nbsp;
    Dikembalikan: {{ $loans->where('status','dikembalikan')->count() }}
  </div>
</div>
<table class="tbl">
  <thead>
    <tr>
      <th style="width:22px">No</th>
      <th>Anggota</th>
      <th>Judul Buku</th>
      <th>Tgl Pinjam</th>
      <th>Batas Kembali</th>
      <th>Tgl Kembali</th>
      <th class="ta-c">Status</th>
      <th class="ta-r">Denda</th>
    </tr>
  </thead>
  <tbody>
    @forelse($loans as $i => $loan)
    <tr>
      <td class="ta-c num">{{ $i+1 }}</td>
      <td>
        <span class="bold">{{ $loan->member?->nama ?? '—' }}</span><br>
        <span class="sub mono">{{ $loan->member?->kode_anggota }}</span>
      </td>
      <td>
        {{ \Illuminate\Support\Str::limit($loan->book?->judul ?? '—', 42) }}<br>
        <span class="sub mono">{{ $loan->book?->kode_buku }}</span>
      </td>
      <td style="white-space:nowrap">{{ $loan->tgl_pinjam?->format('d M Y') ?? '—' }}</td>
      <td style="white-space:nowrap;{{ in_array($loan->status,['terlambat']) ? 'color:#b91c1c;font-weight:700' : '' }}">
        {{ $loan->tgl_batas_kembali?->format('d M Y') ?? '—' }}
      </td>
      <td style="white-space:nowrap">{{ $loan->tgl_kembali?->format('d M Y') ?? '—' }}</td>
      <td class="ta-c">
        @php $s = $loan->status; @endphp
        <span class="badge {{ match($s) { 'dipinjam'=>'b-warn','dikembalikan'=>'b-ok','terlambat'=>'b-red',default=>'b-gray' } }}">
          {{ match($s) { 'dipinjam'=>'Dipinjam','dikembalikan'=>'Kembali','terlambat'=>'Terlambat',default=>$s } }}
        </span>
      </td>
      <td class="ta-r">
        @if($loan->fine)
          <span class="{{ $loan->fine->status_bayar==='lunas' ? 'ok' : 'red' }}">
            Rp {{ number_format($loan->fine->nominal,0,',','.') }}
          </span>
        @else
          <span style="color:#94a3b8">—</span>
        @endif
      </td>
    </tr>
    @empty
    <tr class="empty-row"><td colspan="8">Tidak ada data peminjaman pada periode ini.</td></tr>
    @endforelse
  </tbody>
  @if($loans->count())
  <tfoot>
    <tr>
      <td colspan="7">Total Denda (semua status)</td>
      <td class="ta-r">Rp {{ number_format($loans->sum(fn($l)=>$l->fine?->nominal ?? 0),0,',','.') }}</td>
    </tr>
  </tfoot>
  @endif
</table>

<div class="divider"></div>

{{-- =============================================
     SEKSI 2: DENDA
============================================= --}}
<div class="sec-head">
  <div class="sec-head-title">2. Rekap Denda Keterlambatan</div>
  <div class="sec-head-sub">
    Total: {{ $fines->count() }} kasus &nbsp;|&nbsp;
    Belum Lunas: {{ $fines->where('status_bayar','belum_lunas')->count() }}
    (Rp {{ number_format($fines->where('status_bayar','belum_lunas')->sum('nominal'),0,',','.') }}) &nbsp;|&nbsp;
    Lunas: {{ $fines->where('status_bayar','lunas')->count() }}
    (Rp {{ number_format($fines->where('status_bayar','lunas')->sum('nominal'),0,',','.') }})
  </div>
</div>
<table class="tbl">
  <thead>
    <tr>
      <th style="width:22px">No</th>
      <th>Anggota</th>
      <th>Judul Buku</th>
      <th>Tgl Kembali</th>
      <th class="ta-c">Terlambat</th>
      <th class="ta-r">Nominal</th>
      <th class="ta-c">Status</th>
      <th>Tgl Lunas</th>
    </tr>
  </thead>
  <tbody>
    @forelse($fines as $i => $fine)
    <tr>
      <td class="ta-c num">{{ $i+1 }}</td>
      <td>
        <span class="bold">{{ $fine->loan?->member?->nama ?? '—' }}</span><br>
        <span class="sub mono">{{ $fine->loan?->member?->kode_anggota }}</span>
      </td>
      <td>{{ \Illuminate\Support\Str::limit($fine->loan?->book?->judul ?? '—', 38) }}</td>
      <td style="white-space:nowrap">{{ $fine->loan?->tgl_kembali?->format('d M Y') ?? '—' }}</td>
      <td class="ta-c red">{{ $fine->jumlah_hari }} hari</td>
      <td class="ta-r bold">Rp {{ number_format($fine->nominal,0,',','.') }}</td>
      <td class="ta-c">
        <span class="badge {{ $fine->status_bayar==='lunas' ? 'b-ok' : 'b-red' }}">
          {{ $fine->status_bayar==='lunas' ? 'Lunas' : 'Belum Lunas' }}
        </span>
      </td>
      <td style="white-space:nowrap">{{ $fine->tgl_bayar?->format('d M Y') ?? '—' }}</td>
    </tr>
    @empty
    <tr class="empty-row"><td colspan="8">Tidak ada data denda pada periode ini.</td></tr>
    @endforelse
  </tbody>
  @if($fines->count())
  <tfoot>
    <tr>
      <td colspan="5">Total Nominal Denda</td>
      <td class="ta-r">Rp {{ number_format($fines->sum('nominal'),0,',','.') }}</td>
      <td colspan="2"></td>
    </tr>
  </tfoot>
  @endif
</table>

<div class="divider page-break"></div>

{{-- =============================================
     SEKSI 3: SANKSI BUKU PAKET
============================================= --}}
<div class="sec-head">
  <div class="sec-head-title">3. Rekap Sanksi Buku Paket</div>
  <div class="sec-head-sub">
    Total: {{ $sanksis->count() }} kasus &nbsp;|&nbsp;
    Belum Lunas: {{ $sanksis->where('status_sanksi','belum_lunas')->count() }} &nbsp;|&nbsp;
    Lunas: {{ $sanksis->where('status_sanksi','lunas')->count() }} &nbsp;|&nbsp;
    Rusak: {{ $sanksis->where('kondisi_kembali','rusak')->count() }} &nbsp;|&nbsp;
    Hilang: {{ $sanksis->where('kondisi_kembali','hilang')->count() }}
  </div>
</div>
<table class="tbl">
  <thead>
    <tr>
      <th style="width:22px">No</th>
      <th>Anggota</th>
      <th>Buku Paket</th>
      <th>Tahun Ajaran</th>
      <th class="ta-c">Kondisi</th>
      <th>Jenis Sanksi</th>
      <th class="ta-c">Status</th>
      <th>Tgl Kembali</th>
    </tr>
  </thead>
  <tbody>
    @forelse($sanksis as $i => $sanksi)
    <tr>
      <td class="ta-c num">{{ $i+1 }}</td>
      <td>
        <span class="bold">{{ $sanksi->member?->nama ?? '—' }}</span><br>
        <span class="sub mono">{{ $sanksi->member?->kode_anggota }}</span>
      </td>
      <td>
        {{ \Illuminate\Support\Str::limit($sanksi->textbookItem?->textbook?->judul ?? '—', 32) }}<br>
        <span class="sub mono">{{ $sanksi->textbookItem?->kode_item }}</span>
      </td>
      <td>
        {{ $sanksi->loan?->tahun_ajaran ?? '—' }}<br>
        <span class="sub">Kelas {{ $sanksi->loan?->untuk_tingkat }}</span>
      </td>
      <td class="ta-c">
        @php $k = $sanksi->kondisi_kembali; @endphp
        <span class="badge {{ match($k) { 'baik'=>'b-ok','rusak'=>'b-warn','hilang'=>'b-red',default=>'b-gray' } }}">
          {{ match($k) { 'baik'=>'Baik','rusak'=>'Rusak','hilang'=>'Hilang',default=>'—' } }}
        </span>
      </td>
      <td>
        @php $js = $sanksi->jenis_sanksi; @endphp
        @if($js)
        <span class="badge {{ $js==='ganti_buku' ? 'b-warn' : 'b-red' }}">
          {{ $js==='ganti_buku' ? 'Ganti Buku' : 'Bayar Harga' }}
        </span>
        @else
        <span style="color:#94a3b8">—</span>
        @endif
      </td>
      <td class="ta-c">
        @php $ss = $sanksi->status_sanksi; @endphp
        <span class="badge {{ $ss==='lunas' ? 'b-ok' : 'b-red' }}">
          {{ $ss==='lunas' ? 'Lunas' : 'Belum Lunas' }}
        </span>
      </td>
      <td style="white-space:nowrap">{{ $sanksi->tgl_kembali_aktual?->format('d M Y') ?? '—' }}</td>
    </tr>
    @empty
    <tr class="empty-row"><td colspan="8">Tidak ada data sanksi buku paket pada periode ini.</td></tr>
    @endforelse
  </tbody>
</table>

<div class="divider"></div>

{{-- =============================================
     SEKSI 4: KUNJUNGAN
============================================= --}}
<div class="sec-head">
  <div class="sec-head-title">4. Rekap Kunjungan Perpustakaan</div>
  <div class="sec-head-sub">
    Total: {{ $visits->count() }} kunjungan &nbsp;|&nbsp;
    Siswa: {{ $visits->where('jenis_pengunjung','siswa')->count() }} &nbsp;|&nbsp;
    Guru/Staf: {{ $visits->where('jenis_pengunjung','guru')->count() }} &nbsp;|&nbsp;
    Tamu: {{ $visits->where('jenis_pengunjung','umum')->count() }}
  </div>
</div>
<table class="tbl">
  <thead>
    <tr>
      <th style="width:22px">No</th>
      <th>Nama</th>
      <th class="ta-c">Jenis</th>
      <th>Kelas</th>
      <th>Keperluan</th>
      <th>Tanggal</th>
      <th>Jam</th>
    </tr>
  </thead>
  <tbody>
    @forelse($visits as $i => $visit)
    <tr>
      <td class="ta-c num">{{ $i+1 }}</td>
      <td class="bold">{{ $visit->nama }}</td>
      <td class="ta-c">
        @php $jp = $visit->jenis_pengunjung; @endphp
        <span class="badge {{ match($jp) { 'siswa'=>'b-pri','guru'=>'b-warn',default=>'b-gray' } }}">
          {{ match($jp) { 'siswa'=>'Siswa','guru'=>'Guru','umum'=>'Tamu',default=>$jp } }}
        </span>
      </td>
      <td style="color:#64748b">{{ ($jp==='siswa' && $visit->kelas) ? $visit->kelas : '—' }}</td>
      <td>{{ $visit->keperluan ?? '—' }}</td>
      <td style="white-space:nowrap">{{ $visit->tgl_kunjungan?->format('d M Y') ?? '—' }}</td>
      <td>{{ $visit->jam_kunjungan ? substr($visit->jam_kunjungan,0,5) : '—' }}</td>
    </tr>
    @empty
    <tr class="empty-row"><td colspan="7">Tidak ada data kunjungan pada periode ini.</td></tr>
    @endforelse
  </tbody>
</table>

<div style="height:30px;"></div>

{{-- TANDA TANGAN --}}
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" valign="top" style="padding-right:20px;">
      <div style="font-size:8pt;color:#5a6478;">Dibuat oleh,</div>
      <div style="margin-top:44px;border-top:1px solid #0f172a;padding-top:4px;">
        <div style="font-size:8.5pt;font-weight:700;">Petugas Perpustakaan</div>
        <div style="font-size:7.5pt;color:#5a6478;margin-top:2px;">( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )</div>
      </div>
    </td>
    <td width="50%" valign="top" style="padding-left:20px;text-align:right;">
      <div style="font-size:8pt;color:#5a6478;">Ajibarang, {{ now()->locale('id')->translatedFormat('d F Y') }}</div>
      <div style="margin-top:44px;border-top:1px solid #0f172a;padding-top:4px;">
        <div style="font-size:8.5pt;font-weight:700;">Kepala Sekolah</div>
        <div style="font-size:8.5pt;font-weight:700;margin-top:2px;">Suhriyanto, S.Pd., M.Pd.</div>
        <div style="font-size:7.5pt;color:#5a6478;">NIP. 196812211995121003</div>
      </div>
    </td>
  </tr>
</table>

</body>
</html>
