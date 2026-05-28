<div>
<style>
.rk-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:4px;}
.rk-stat{background:#fff;border:1px solid #e6eaf2;border-radius:12px;padding:16px 18px 14px;box-shadow:0 1px 2px rgba(15,23,42,.04);}
.rk-stat-head{display:flex;align-items:center;justify-content:space-between;}
.rk-stat-lbl{font-size:11px;color:#8b94a6;letter-spacing:.06em;text-transform:uppercase;font-weight:700;}
.rk-stat-ico{width:34px;height:34px;border-radius:9px;display:grid;place-items:center;}
.rk-stat-val{font-size:28px;font-weight:700;letter-spacing:-.02em;margin:12px 0 3px;color:#0f172a;}
.rk-stat-sub{font-size:11.5px;color:#5a6478;}
.rk-stat-val.sm{font-size:20px;}
</style>
<div class="rk-stats">

  <div class="rk-stat">
    <div class="rk-stat-head">
      <span class="rk-stat-lbl">Total Denda</span>
      <div class="rk-stat-ico" style="background:#eef2ff;">
        <svg width="16" height="16" fill="none" stroke="#1e3a8a" stroke-width="1.8" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
      </div>
    </div>
    <div class="rk-stat-val">{{ $total }}</div>
    <div class="rk-stat-sub">kasus denda keterlambatan</div>
  </div>

  <div class="rk-stat">
    <div class="rk-stat-head">
      <span class="rk-stat-lbl">Belum Lunas</span>
      <div class="rk-stat-ico" style="background:#fee2e2;">
        <svg width="16" height="16" fill="none" stroke="#dc2626" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      </div>
    </div>
    <div class="rk-stat-val">{{ $belumLunas }}</div>
    <div class="rk-stat-sub">denda belum dibayar</div>
  </div>

  <div class="rk-stat">
    <div class="rk-stat-head">
      <span class="rk-stat-lbl">Nominal Belum Lunas</span>
      <div class="rk-stat-ico" style="background:#fff4ea;">
        <svg width="16" height="16" fill="none" stroke="#ef7c2a" stroke-width="1.8" viewBox="0 0 24 24"><path d="M12 1v22M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
      </div>
    </div>
    <div class="rk-stat-val sm">Rp {{ number_format($nominalBelumLunas, 0, ',', '.') }}</div>
    <div class="rk-stat-sub">perlu ditagih</div>
  </div>

  <div class="rk-stat">
    <div class="rk-stat-head">
      <span class="rk-stat-lbl">Sudah Lunas</span>
      <div class="rk-stat-ico" style="background:#e6f7ed;">
        <svg width="16" height="16" fill="none" stroke="#16a34a" stroke-width="1.8" viewBox="0 0 24 24"><path d="M9 17H5a2 2 0 01-2-2V5a2 2 0 012-2h11a2 2 0 012 2v5"/><polyline points="9 11 12 14 22 4"/></svg>
      </div>
    </div>
    <div class="rk-stat-val">{{ $lunas }}</div>
    <div class="rk-stat-sub">denda telah dibayar</div>
  </div>

</div>
</div>
