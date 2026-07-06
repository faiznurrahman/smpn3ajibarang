<div>
<style>
.vs-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    margin-bottom: 4px;
}
.vs-card {
    background: #fff;
    border: 1px solid #e6eaf2;
    border-radius: 14px;
    padding: 18px 20px;
    box-shadow: 0 1px 2px rgba(15,23,42,.04);
    display: flex;
    flex-direction: column;
    gap: 0;
}
.vs-card-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 14px;
}
.vs-lbl {
    font-size: 11px;
    font-weight: 700;
    color: #8b94a6;
    text-transform: uppercase;
    letter-spacing: .07em;
}
.vs-ico {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.vs-val {
    font-size: 32px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1;
}
.vs-sub {
    font-size: 12px;
    color: #8b94a6;
    margin-top: 5px;
}

@media (max-width: 640px) {
    .vs-grid  { grid-template-columns: repeat(3, 1fr); gap: 8px; }
    .vs-card  { padding: 12px 12px 10px; border-radius: 12px; }
    .vs-card-head { margin-bottom: 8px; }
    .vs-ico   { width: 28px; height: 28px; border-radius: 8px; }
    .vs-ico svg { width: 14px; height: 14px; }
    .vs-lbl   { font-size: 9.5px; }
    .vs-val   { font-size: clamp(18px, 5vw, 26px); }
    .vs-sub   { font-size: 10.5px; white-space: normal; line-height: 1.3; }
}
@media (max-width: 400px) {
    .vs-grid { gap: 6px; }
    .vs-val  { font-size: 16px; }
    .vs-card { padding: 10px 10px 8px; }
}
</style>

<div class="vs-grid">

  {{-- Hari Ini --}}
  <div class="vs-card">
    <div class="vs-card-head">
      <span class="vs-lbl">Hari Ini</span>
      <div class="vs-ico" style="background:#e8efff;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="1.8" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
      </div>
    </div>
    <div class="vs-val">{{ $hariIniTotal }}</div>
    <div class="vs-sub">
      {{ $hariIniSiswa }} Siswa &middot; {{ $hariIniGuru }} Guru &middot; {{ $hariIniTamu }} Tamu
    </div>
  </div>

  {{-- Minggu Ini --}}
  <div class="vs-card">
    <div class="vs-card-head">
      <span class="vs-lbl">Minggu Ini</span>
      <div class="vs-ico" style="background:#e6f7ed;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="1.8" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><line x1="8" y1="14" x2="16" y2="14"/></svg>
      </div>
    </div>
    <div class="vs-val">{{ $mingguIniTotal }}</div>
    <div class="vs-sub">{{ $mingguIniRange }}</div>
  </div>

  {{-- Bulan Ini --}}
  <div class="vs-card">
    <div class="vs-card-head">
      <span class="vs-lbl">Bulan Ini</span>
      <div class="vs-ico" style="background:#fff4ea;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ef7c2a" stroke-width="1.8" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><line x1="8" y1="14" x2="16" y2="14"/><line x1="8" y1="18" x2="12" y2="18"/></svg>
      </div>
    </div>
    <div class="vs-val">{{ $bulanIniTotal }}</div>
    <div class="vs-sub">{{ $bulanIniLabel }}</div>
  </div>

</div>
</div>
