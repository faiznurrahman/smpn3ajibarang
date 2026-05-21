<div>
    {{-- Header info distribusi --}}
    <div style="background:white; border-radius:12px; border:1px solid #e5e7eb; padding:20px 24px; margin-bottom:24px; display:grid; grid-template-columns:repeat(3,1fr); gap:16px 24px;">
        <div>
            <div style="font-size:11px;color:#6b7280;font-weight:600;text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px;">Tahun Ajaran</div>
            <div style="font-size:15px;font-weight:700;color:#1e3a8a;">{{ $this->loan->tahun_ajaran }}</div>
        </div>
        <div>
            <div style="font-size:11px;color:#6b7280;font-weight:600;text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px;">Untuk Tingkat</div>
            <div style="font-size:15px;font-weight:700;color:#111827;">Kelas {{ $this->loan->untuk_tingkat }}</div>
        </div>
        <div>
            <div style="font-size:11px;color:#6b7280;font-weight:600;text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px;">Status</div>
            @if($this->loan->status === 'aktif')
                <span style="font-size:13px;font-weight:600;padding:3px 10px;border-radius:20px;background:#fef3c7;color:#92400e;">Aktif</span>
            @else
                <span style="font-size:13px;font-weight:600;padding:3px 10px;border-radius:20px;background:#d1fae5;color:#065f46;">Selesai</span>
            @endif
        </div>
        <div>
            <div style="font-size:11px;color:#6b7280;font-weight:600;text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px;">Tanggal Distribusi</div>
            <div style="font-size:14px;color:#374151;">{{ $this->loan->tgl_distribusi?->format('d M Y') ?? '—' }}</div>
        </div>
        <div>
            <div style="font-size:11px;color:#6b7280;font-weight:600;text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px;">Rencana Kembali</div>
            <div style="font-size:14px;color:#374151;">{{ $this->loan->tgl_kembali?->format('d M Y') ?? '—' }}</div>
        </div>
        <div>
            <div style="font-size:11px;color:#6b7280;font-weight:600;text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px;">Petugas</div>
            <div style="font-size:14px;color:#374151;">{{ $this->loan->petugas?->name ?? '—' }}</div>
        </div>
    </div>

    {{ $this->table }}
</div>
