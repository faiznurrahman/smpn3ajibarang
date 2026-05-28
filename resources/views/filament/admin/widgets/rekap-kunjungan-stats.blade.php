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
      <span class="rk-stat-lbl">Hari Ini</span>
      <div class="rk-stat-ico" style="background:#e8efff;">
        <svg width="16" height="16" fill="none" stroke="#2563eb" stroke-width="1.8" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
      </div>
    </div>
    <div class="rk-stat-val">{{ $hariIni }}</div>
    <div class="rk-stat-sub">{{ now()->locale('id')->translatedFormat('d F Y') }}</div>
  </div>

  <div class="rk-stat">
    <div class="rk-stat-head">
      <span class="rk-stat-lbl">Minggu Ini</span>
      <div class="rk-stat-ico" style="background:#e6f7ed;">
        <svg width="16" height="16" fill="none" stroke="#16a34a" stroke-width="1.8" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
      </div>
    </div>
    <div class="rk-stat-val">{{ $mingguIni }}</div>
    <div class="rk-stat-sub">{{ now()->startOfWeek()->locale('id')->translatedFormat('d') }}–{{ now()->endOfWeek()->locale('id')->translatedFormat('d M') }}</div>
  </div>

  <div class="rk-stat">
    <div class="rk-stat-head">
      <span class="rk-stat-lbl">Bulan Ini</span>
      <div class="rk-stat-ico" style="background:#fff4ea;">
        <svg width="16" height="16" fill="none" stroke="#ef7c2a" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
      </div>
    </div>
    <div class="rk-stat-val">{{ $bulanIni }}</div>
    <div class="rk-stat-sub">{{ now()->locale('id')->translatedFormat('F Y') }}</div>
  </div>

  <div class="rk-stat">
    <div class="rk-stat-head">
      <span class="rk-stat-lbl">Total Kunjungan</span>
      <div class="rk-stat-ico" style="background:#eef2ff;">
        <svg width="16" height="16" fill="none" stroke="#1e3a8a" stroke-width="1.8" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
      </div>
    </div>
    <div class="rk-stat-val">{{ $total }}</div>
    <div class="rk-stat-sub">{{ $siswa }} siswa · {{ $guru }} guru bulan ini</div>
  </div>

</div>
</div>
