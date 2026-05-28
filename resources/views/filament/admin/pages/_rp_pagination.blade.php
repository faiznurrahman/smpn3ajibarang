@if($records->lastPage() > 1)
<div class="rp-pagination">
  <div class="rp-pagination-info">
    Menampilkan {{ $records->firstItem() }}–{{ $records->lastItem() }} dari {{ number_format($records->total()) }} data
  </div>
  <div class="rp-pagination-nav">
    <button class="rp-pg-btn" wire:click="goPage('{{ $tabKey }}', {{ $records->currentPage() - 1 }})" @disabled($records->onFirstPage())>
      <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
    </button>

    @php
      $current = $records->currentPage();
      $last    = $records->lastPage();
      $pages   = collect();
      // selalu tampilkan hal 1, last, dan 2 di kiri-kanan current
      for ($p = max(1, $current - 2); $p <= min($last, $current + 2); $p++) {
          $pages->push($p);
      }
      if (!$pages->contains(1))   { $pages->prepend('...')->prepend(1); }
      if (!$pages->contains($last)) { $pages->push('...')->push($last); }
    @endphp

    @foreach($pages as $p)
      @if($p === '...')
        <span class="rp-pg-btn" style="cursor:default;color:var(--t3)">…</span>
      @else
        <button class="rp-pg-btn {{ $p == $current ? 'active' : '' }}"
          wire:click="goPage('{{ $tabKey }}', {{ $p }})">{{ $p }}</button>
      @endif
    @endforeach

    <button class="rp-pg-btn" wire:click="goPage('{{ $tabKey }}', {{ $records->currentPage() + 1 }})" @disabled(!$records->hasMorePages())>
      <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
    </button>
  </div>
</div>
@else
<div class="rp-pagination">
  <div class="rp-pagination-info">{{ number_format($records->total()) }} data ditampilkan</div>
</div>
@endif
