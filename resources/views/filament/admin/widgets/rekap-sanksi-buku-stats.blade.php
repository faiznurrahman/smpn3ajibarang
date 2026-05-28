<div>
<style>
.rk-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:4px;}
.rk-stat{background:#fff;border:1px solid #e6eaf2;border-radius:12px;padding:16px 18px 14px;box-shadow:0 1px 2px rgba(15,23,42,.04);}
.rk-stat-head{display:flex;align-items:center;justify-content:space-between;}
.rk-stat-lbl{font-size:11px;color:#8b94a6;letter-spacing:.06em;text-transform:uppercase;font-weight:700;}
.rk-stat-ico{width:34px;height:34px;border-radius:9px;display:grid;place-items:center;}
.rk-stat-val{font-size:28px;font-weight:700;letter-spacing:-.02em;margin:12px 0 3px;color:#0f172a;}
.rk-stat-sub{font-size:11.5px;color:#5a6478;}
@media(max-width:640px){
  .rk-stats{grid-template-columns:repeat(2,1fr);gap:8px;}
  .rk-stat{padding:12px 12px 10px;border-radius:10px;}
  .rk-stat-ico{width:28px;height:28px;border-radius:7px;}
  .rk-stat-ico svg{width:13px;height:13px;}
  .rk-stat-lbl{font-size:9.5px;}
  .rk-stat-val{font-size:clamp(18px,5vw,24px);margin:8px 0 2px;}
  .rk-stat-sub{font-size:10.5px;white-space:normal;line-height:1.3;}
}
@media(max-width:400px){
  .rk-stats{gap:6px;}
  .rk-stat-val{font-size:16px;}
}
</style>
<div class="rk-stats">

  <div class="rk-stat">
    <div class="rk-stat-head">
      <span class="rk-stat-lbl">Total Sanksi</span>
      <div class="rk-stat-ico" style="background:#eef2ff;">
        <svg width="16" height="16" fill="none" stroke="#1e3a8a" stroke-width="1.8" viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
      </div>
    </div>
    <div class="rk-stat-val">{{ $total }}</div>
    <div class="rk-stat-sub">kasus sanksi buku paket</div>
  </div>

  <div class="rk-stat">
    <div class="rk-stat-head">
      <span class="rk-stat-lbl">Belum Lunas</span>
      <div class="rk-stat-ico" style="background:#fee2e2;">
        <svg width="16" height="16" fill="none" stroke="#dc2626" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      </div>
    </div>
    <div class="rk-stat-val">{{ $belumLunas }}</div>
    <div class="rk-stat-sub">sanksi belum diselesaikan</div>
  </div>

  <div class="rk-stat">
    <div class="rk-stat-head">
      <span class="rk-stat-lbl">Buku Rusak</span>
      <div class="rk-stat-ico" style="background:#fffbeb;">
        <svg width="16" height="16" fill="none" stroke="#f59e0b" stroke-width="1.8" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
      </div>
    </div>
    <div class="rk-stat-val">{{ $rusak }}</div>
    <div class="rk-stat-sub">kondisi rusak</div>
  </div>

  <div class="rk-stat">
    <div class="rk-stat-head">
      <span class="rk-stat-lbl">Buku Hilang</span>
      <div class="rk-stat-ico" style="background:#f1ebff;">
        <svg width="16" height="16" fill="none" stroke="#7c3aed" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/><path d="M11 8v6M8 11h6"/></svg>
      </div>
    </div>
    <div class="rk-stat-val">{{ $hilang }}</div>
    <div class="rk-stat-sub">buku dilaporkan hilang</div>
  </div>

</div>
</div>
