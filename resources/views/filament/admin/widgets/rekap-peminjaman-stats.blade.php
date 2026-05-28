<div>
<style>
.rk-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:4px;}
.rk-stat{background:#fff;border:1px solid #e6eaf2;border-radius:12px;padding:16px 18px 14px;box-shadow:0 1px 2px rgba(15,23,42,.04);}
.rk-stat-head{display:flex;align-items:center;justify-content:space-between;}
.rk-stat-lbl{font-size:11px;color:#8b94a6;letter-spacing:.06em;text-transform:uppercase;font-weight:700;}
.rk-stat-ico{width:34px;height:34px;border-radius:9px;display:grid;place-items:center;}
.rk-stat-val{font-size:28px;font-weight:700;letter-spacing:-.02em;margin:12px 0 3px;color:#0f172a;}
.rk-stat-sub{font-size:11.5px;color:#5a6478;}
</style>
<div class="rk-stats">

  <div class="rk-stat">
    <div class="rk-stat-head">
      <span class="rk-stat-lbl">Total Peminjaman</span>
      <div class="rk-stat-ico" style="background:#eef2ff;">
        <svg width="16" height="16" fill="none" stroke="#1e3a8a" stroke-width="1.8" viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
      </div>
    </div>
    <div class="rk-stat-val">{{ $total }}</div>
    <div class="rk-stat-sub">semua transaksi</div>
  </div>

  <div class="rk-stat">
    <div class="rk-stat-head">
      <span class="rk-stat-lbl">Sedang Dipinjam</span>
      <div class="rk-stat-ico" style="background:#fffbeb;">
        <svg width="16" height="16" fill="none" stroke="#f59e0b" stroke-width="1.8" viewBox="0 0 24 24"><path d="M12 22V12"/><path d="M20 16.58A5 5 0 0018 7h-1.26A8 8 0 104 15.25"/></svg>
      </div>
    </div>
    <div class="rk-stat-val">{{ $dipinjam }}</div>
    <div class="rk-stat-sub">belum dikembalikan</div>
  </div>

  <div class="rk-stat">
    <div class="rk-stat-head">
      <span class="rk-stat-lbl">Terlambat</span>
      <div class="rk-stat-ico" style="background:#fee2e2;">
        <svg width="16" height="16" fill="none" stroke="#dc2626" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
      </div>
    </div>
    <div class="rk-stat-val">{{ $terlambat }}</div>
    <div class="rk-stat-sub">melewati batas kembali</div>
  </div>

  <div class="rk-stat">
    <div class="rk-stat-head">
      <span class="rk-stat-lbl">Bulan Ini</span>
      <div class="rk-stat-ico" style="background:#e6f7ed;">
        <svg width="16" height="16" fill="none" stroke="#16a34a" stroke-width="1.8" viewBox="0 0 24 24"><path d="M9 17H5a2 2 0 01-2-2V5a2 2 0 012-2h11a2 2 0 012 2v5"/><polyline points="9 11 12 14 22 4"/></svg>
      </div>
    </div>
    <div class="rk-stat-val">{{ $bulanIni }}</div>
    <div class="rk-stat-sub">{{ now()->locale('id')->translatedFormat('F Y') }}</div>
  </div>

</div>
</div>
