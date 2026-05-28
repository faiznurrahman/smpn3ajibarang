@php
use Illuminate\Support\Carbon;
use App\Models\Message;
use App\Models\Post;
use App\Filament\Resources\Messages\MessageResource;
use App\Filament\Resources\Posts\PostResource;

$unreadMessages = Message::where('is_read', false)->latest()->take(4)->get();

$staleDrafts = Post::where('status', 'draft')
    ->where('updated_at', '<', now()->subDays(7))
    ->orderBy('updated_at')
    ->take(3)
    ->get();

$tomorrowAgenda = Post::where('type', 'pengumuman')
    ->where('status', 'published')
    ->whereDate('start_date', Carbon::tomorrow())
    ->take(3)
    ->get();

$hasAny = $unreadMessages->isNotEmpty() || $staleDrafts->isNotEmpty() || $tomorrowAgenda->isNotEmpty();
$messagesUrl   = MessageResource::getUrl('index');
$postsUrl      = PostResource::getUrl('index');
@endphp

<div
    x-data="{ open: false }"
    x-on:click.outside="open = false"
    class="nbb-wrap"
>
    {{-- Bell trigger --}}
    <button
        type="button"
        x-on:click="open = !open"
        class="nbb-btn"
        :class="{ 'nbb-btn-active': open }"
        title="{{ $hasAny ? 'Ada notifikasi baru' : 'Tidak ada notifikasi baru' }}"
    >
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
        </svg>
        @if ($hasAny)
            <span class="nbb-dot"></span>
        @endif
    </button>

    {{-- Dropdown panel --}}
    <div
        x-cloak
        x-show="open"
        x-transition:enter="nbb-enter"
        x-transition:enter-start="nbb-enter-start"
        x-transition:enter-end="nbb-enter-end"
        x-transition:leave="nbb-leave"
        x-transition:leave-start="nbb-leave-start"
        x-transition:leave-end="nbb-leave-end"
        class="nbb-panel"
    >
        {{-- Header --}}
        <div class="nbb-panel-head">
            <span class="nbb-panel-title">Notifikasi</span>
            @if ($hasAny)
                <span class="nbb-panel-badge">
                    {{ $unreadMessages->count() + $staleDrafts->count() + $tomorrowAgenda->count() }}
                </span>
            @endif
        </div>

        <div class="nbb-body">
            @if (! $hasAny)
                <div class="nbb-empty">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="1.5">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                    </svg>
                    <p>Semua sudah beres!</p>
                </div>
            @endif

            {{-- Section: Pesan masuk --}}
            @if ($unreadMessages->isNotEmpty())
                <div class="nbb-section">
                    <div class="nbb-section-label">
                        <span class="nbb-dot-sm nbb-dot-red"></span>
                        Pesan belum dibaca
                    </div>
                    @foreach ($unreadMessages as $msg)
                        <a href="{{ MessageResource::getUrl('view', ['record' => $msg->id]) }}" class="nbb-item" x-on:click="open = false">
                            <span class="nbb-icon nbb-icon-red">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                </svg>
                            </span>
                            <div class="nbb-item-body">
                                <span class="nbb-item-title">{{ \Illuminate\Support\Str::limit($msg->nama, 28) }}</span>
                                <span class="nbb-item-sub">{{ \Illuminate\Support\Str::limit($msg->subjek ?: 'Tanpa subjek', 40) }}</span>
                            </div>
                            <span class="nbb-item-time">{{ $msg->created_at->diffForHumans(short: true) }}</span>
                        </a>
                    @endforeach
                    @if ($unreadMessages->count() >= 4)
                        <a href="{{ $messagesUrl }}" class="nbb-see-all" x-on:click="open = false">Lihat semua pesan →</a>
                    @endif
                </div>
            @endif

            {{-- Section: Draft lama --}}
            @if ($staleDrafts->isNotEmpty())
                <div class="nbb-section">
                    <div class="nbb-section-label">
                        <span class="nbb-dot-sm nbb-dot-orange"></span>
                        Draft belum diterbitkan (7+ hari)
                    </div>
                    @foreach ($staleDrafts as $post)
                        <a href="{{ PostResource::getUrl('edit', ['record' => $post->id]) }}" class="nbb-item" x-on:click="open = false">
                            <span class="nbb-icon nbb-icon-orange">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                            </span>
                            <div class="nbb-item-body">
                                <span class="nbb-item-title">{{ \Illuminate\Support\Str::limit($post->judul, 38) }}</span>
                                <span class="nbb-item-sub">Draf sejak {{ $post->updated_at->diffForHumans() }}</span>
                            </div>
                        </a>
                    @endforeach
                    @if ($staleDrafts->count() >= 3)
                        <a href="{{ $postsUrl }}" class="nbb-see-all" x-on:click="open = false">Lihat semua berita →</a>
                    @endif
                </div>
            @endif

            {{-- Section: Agenda besok --}}
            @if ($tomorrowAgenda->isNotEmpty())
                <div class="nbb-section">
                    <div class="nbb-section-label">
                        <span class="nbb-dot-sm nbb-dot-blue"></span>
                        Pengumuman mulai besok
                    </div>
                    @foreach ($tomorrowAgenda as $post)
                        <a href="{{ PostResource::getUrl('edit', ['record' => $post->id]) }}" class="nbb-item" x-on:click="open = false">
                            <span class="nbb-icon nbb-icon-blue">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                            </span>
                            <div class="nbb-item-body">
                                <span class="nbb-item-title">{{ \Illuminate\Support\Str::limit($post->judul, 38) }}</span>
                                <span class="nbb-item-sub">Mulai besok, {{ \Carbon\Carbon::parse($post->start_date)->isoFormat('D MMM') }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* ---- wrapper ---- */
    .nbb-wrap {
        position: relative;
        display: inline-flex;
        align-items: center;
    }

    /* ---- bell button ---- */
    .nbb-btn {
        position: relative;
        width: 36px; height: 36px;
        border-radius: 10px;
        background: white;
        border: 1px solid #e6eaf2;
        color: #5a6478;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: color 120ms, border-color 120ms, background 120ms;
    }
    .nbb-btn:hover, .nbb-btn-active {
        color: #1e3a8a;
        border-color: #c7d2fe;
        background: #eef2ff;
    }

    /* ---- orange dot indicator ---- */
    .nbb-dot {
        position: absolute;
        top: 7px; right: 7px;
        width: 7px; height: 7px;
        background: #ef7c2a;
        border-radius: 50%;
        border: 2px solid white;
        box-sizing: content-box;
    }

    /* ---- dropdown panel ---- */
    .nbb-panel {
        position: absolute;
        top: calc(100% + 8px);
        right: -8px;
        width: 320px;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 13px;
        box-shadow: 0 4px 20px rgba(15,23,42,0.10), 0 1px 3px rgba(15,23,42,0.06);
        z-index: 9999;
        overflow: hidden;
    }
    .nbb-panel-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 13px 16px 11px;
        border-bottom: 1px solid #f1f3f8;
    }
    .nbb-panel-title {
        font-size: 13px;
        font-weight: 700;
        color: #0f172a;
    }
    .nbb-panel-badge {
        background: #fee2e2;
        color: #b91c1c;
        font-size: 10.5px;
        font-weight: 700;
        padding: 1px 7px;
        border-radius: 999px;
    }

    /* ---- body ---- */
    .nbb-body {
        max-height: 380px;
        overflow-y: auto;
    }
    .nbb-body::-webkit-scrollbar { width: 4px; }
    .nbb-body::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 4px; }

    .nbb-empty {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        padding: 28px 16px;
        color: #9ca3af;
        font-size: 12.5px;
    }
    .nbb-empty p { margin: 0; }

    /* ---- section ---- */
    .nbb-section {
        padding: 8px 0 4px;
        border-bottom: 1px solid #f1f3f8;
    }
    .nbb-section:last-child { border-bottom: none; }

    .nbb-section-label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #9ca3af;
        padding: 4px 16px 6px;
    }
    .nbb-dot-sm {
        width: 6px; height: 6px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .nbb-dot-red   { background: #ef4444; }
    .nbb-dot-orange{ background: #f97316; }
    .nbb-dot-blue  { background: #3b82f6; }

    /* ---- notification item ---- */
    .nbb-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 8px 16px;
        text-decoration: none;
        transition: background 100ms;
    }
    .nbb-item:hover { background: #f8fafc; }

    .nbb-icon {
        width: 28px; height: 28px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 1px;
    }
    .nbb-icon-red    { background: #fee2e2; color: #dc2626; }
    .nbb-icon-orange { background: #fff3e0; color: #ea580c; }
    .nbb-icon-blue   { background: #eff6ff; color: #2563eb; }

    .nbb-item-body {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
        gap: 1px;
    }
    .nbb-item-title {
        font-size: 12.5px;
        font-weight: 600;
        color: #111827;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .nbb-item-sub {
        font-size: 11.5px;
        color: #6b7280;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .nbb-item-time {
        font-size: 11px;
        color: #9ca3af;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .nbb-see-all {
        display: block;
        padding: 6px 16px 8px;
        font-size: 11.5px;
        font-weight: 600;
        color: #1e3a8a;
        text-decoration: none;
        transition: color 100ms;
    }
    .nbb-see-all:hover { color: #2746a4; }

    /* ---- mobile: dropdown jadi fixed overlay ---- */
    @media (max-width: 639px) {
        .nbb-panel {
            position: fixed;
            top: 58px;
            left: 8px;
            right: 8px;
            width: auto;
            max-height: calc(100dvh - 80px);
        }
        .nbb-body {
            max-height: calc(100dvh - 170px);
        }
    }

    /* ---- transitions ---- */
    .nbb-enter { transition: opacity 120ms ease, transform 120ms ease; }
    .nbb-enter-start { opacity: 0; transform: translateY(-6px) scale(0.97); }
    .nbb-enter-end   { opacity: 1; transform: translateY(0) scale(1); }
    .nbb-leave { transition: opacity 80ms ease, transform 80ms ease; }
    .nbb-leave-start { opacity: 1; transform: translateY(0) scale(1); }
    .nbb-leave-end   { opacity: 0; transform: translateY(-4px) scale(0.97); }
</style>
