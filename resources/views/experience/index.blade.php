@extends('layouts.main', [
    'title' => 'Experience',
])

@push('style')
<style>
    body {
        background-color: #322366 !important;
    }
    iframe {
        display: block;
        border: none !important;
    }
    .iframe-fullscreen {
        position: fixed !important;
        top: 0 !important; left: 0 !important;
        width: 100vw !important; height: 100vh !important;
        z-index: 10000 !important;
    }

    .game-bg {
        background-color: #322366;
        background-image: radial-gradient(circle, rgba(255,255,255,0.15) 1px, transparent 1px);
        background-size: 16px 16px;
    }

    /* Sidebar */
    .lb-sidebar {
        position: fixed;
        top: 72px;
        left: 0;
        bottom: 0;
        z-index: 20;
        transform: translateX(-100%);
        transition: transform 0.3s ease;
        width: 280px;
        max-width: 80vw;
    }
    .lb-sidebar.open {
        transform: translateX(0);
    }
    @media (min-width: 768px) {
        .lb-sidebar {
            position: relative;
            top: 0;
            width: 288px;
            transform: translateX(0);
            flex-shrink: 0;
        }
        .lb-sidebar.collapsed {
            width: 56px;
        }
    }

    .lb-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.6);
        z-index: 15;
    }
    .lb-overlay.active {
        display: block;
    }

    .lb-scroll::-webkit-scrollbar { width: 6px; }
    .lb-scroll::-webkit-scrollbar-track { background: #1A1040; }
    .lb-scroll::-webkit-scrollbar-thumb { background: #F88832; border-radius: 3px; }
</style>
@endpush

@section('content')
<div class="game-bg flex flex-col md:flex-row relative" style="min-height: calc(100vh - 72px);" x-data="{ sidebarOpen: window.innerWidth >= 768, mobileOpen: false }" @resize.window="sidebarOpen = window.innerWidth >= 768">

    {{-- Mobile overlay --}}
    <div class="lb-overlay" :class="mobileOpen ? 'active' : ''" @click="mobileOpen = false"></div>

    {{-- Mobile toggle button --}}
    <button @click="mobileOpen = !mobileOpen"
            class="md:hidden fixed bottom-20 left-3 z-40 bg-accent border-3 border-black shadow-brutal-sm w-12 h-12 flex items-center justify-center cursor-pointer"
            aria-label="Toggle leaderboard">
        <x-heroicon-o-trophy class="w-6 h-6 text-black" />
    </button>

    {{-- ========== LEFT SIDEBAR LEADERBOARD ========== --}}
    <div class="lb-sidebar bg-black/90 border-r-4 border-black overflow-hidden flex flex-col"
         :class="{
             'open': mobileOpen,
             'collapsed': !sidebarOpen && window.innerWidth >= 768
         }"
         style="min-height: calc(100vh - 72px); max-height: calc(100vh - 72px);">

        {{-- Toggle button (desktop only) --}}
        <button @click="sidebarOpen = !sidebarOpen"
                class="hidden md:flex absolute -right-0 top-1/2 -translate-y-1/2 translate-x-full bg-accent border-3 border-black border-l-0 shadow-brutal-sm px-1.5 py-4 z-30 cursor-pointer hover:bg-highlight transition-colors"
                aria-label="Toggle leaderboard">
            <svg class="w-4 h-4 text-black transition-transform duration-300" :class="sidebarOpen ? '' : 'rotate-180'"
                 fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

        {{-- Collapsed view (desktop) --}}
        <div class="hidden md:flex flex-col items-center gap-1 py-4 overflow-y-auto lb-scroll flex-1" x-show="!sidebarOpen">
            <span class="text-[10px] font-extrabold text-highlight/60 uppercase mb-1">TOP</span>
            @foreach($leaderboard->take(10) as $index => $entry)
                <span class="text-xs font-extrabold w-8 h-8 flex items-center justify-center border border-white/20
                    {{ $index == 0 ? 'text-highlight bg-highlight/20' : 'text-white/50' }}">
                    {{ $index + 1 }}
                </span>
            @endforeach
        </div>

        {{-- Expanded view --}}
        <div class="flex flex-col" style="max-height: calc(100vh - 72px);" x-show="sidebarOpen || window.innerWidth < 768">
            {{-- Header --}}
            <div class="bg-accent border-b-3 border-black px-4 py-3 shrink-0">
                <h3 class="text-sm font-extrabold uppercase text-black flex items-center gap-2">
                    <x-heroicon-o-trophy class="w-4 h-4 text-black" />
                    Leaderboard
                </h3>
                <p class="text-[10px] font-bold text-black/60 uppercase mt-0.5">Weekly Ranking</p>
            </div>

            {{-- Top 3 mini podium --}}
            <div class="flex gap-1 px-3 py-3 border-b-2 border-white/10 shrink-0">
                @foreach($leaderboard->take(3) as $index => $entry)
                    @php
                        $medalBg = ['bg-highlight', 'bg-surface-dark', 'bg-primary'];
                        $medalBorder = ['border-highlight', 'border-white/30', 'border-primary'];
                        $scoreColor = ['text-highlight', 'text-white/50', 'text-primary'];
                    @endphp
                    <div class="flex-1 text-center {{ $index == 0 ? '-mt-1' : '' }}">
                        <div class="w-8 h-8 mx-auto mb-1 border-2 {{ $medalBorder[$index] }} flex items-center justify-center {{ $medalBg[$index] }}">
                            <span class="text-xs font-extrabold {{ $index == 0 ? 'text-black' : 'text-white' }}">#{{ $index + 1 }}</span>
                        </div>
                        <p class="text-[10px] font-bold text-white/70 truncate">{{ $entry->username }}</p>
                        <p class="text-[9px] font-extrabold {{ $scoreColor[$index] }}">{{ number_format($entry->score) }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Rank 4-10 list --}}
            <div class="flex-1 overflow-y-auto lb-scroll px-2 py-2">
                @foreach($leaderboard->slice(3) as $index => $entry)
                    @php $rank = $index + 4; @endphp
                    <div class="flex items-center gap-2 px-2 py-1.5 hover:bg-white/5 transition-colors">
                        <span class="text-[10px] font-extrabold w-5 text-white/30 text-right">#{{ $rank }}</span>
                        <span class="flex-1 text-[11px] font-bold text-white/80 truncate">{{ $entry->username }}</span>
                        <span class="text-[10px] font-extrabold text-primary">{{ number_format($entry->score) }}</span>
                    </div>
                @endforeach
                @if($leaderboard->isEmpty())
                    <p class="text-[11px] text-white/40 text-center py-8">No scores yet. Be the first!</p>
                @endif
            </div>

            {{-- Footer --}}
            <a href="{{ route('experiences.leaderboard') }}"
               class="block bg-highlight border-t-3 border-black px-4 py-2.5 text-center hover:bg-accent transition-colors group shrink-0">
                <span class="text-xs font-extrabold uppercase text-black flex items-center justify-center gap-2">
                    Full Leaderboard
                    <svg class="w-3 h-3 text-black group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </span>
            </a>
        </div>
    </div>

    {{-- ========== MAIN GAME AREA ========== --}}
    <div class="flex-1 flex flex-col min-w-0">
        {{-- Top bar --}}
        <div class="flex items-center justify-between px-3 sm:px-5 py-2 sm:py-3 border-b-2 border-white/10 bg-black/40 shrink-0">
            <div class="bg-primary border-2 border-black shadow-brutal-sm px-3 sm:px-4 py-1 rotate-[-1deg]">
                <h1 class="text-xs sm:text-sm lg:text-base font-extrabold uppercase text-black flex items-center gap-1.5 sm:gap-2">
                    <x-heroicon-o-play-circle class="w-4 h-4 sm:w-5 sm:h-5 text-black" />
                    <span class="hidden sm:inline">IGX Fusion Celebration</span>
                    <span class="sm:hidden">IGX Game</span>
                </h1>
            </div>
            <div class="flex items-center gap-2 sm:gap-3">
                <div class="bg-accent border-2 border-black px-2 py-1">
                    <span class="text-[10px] sm:text-xs font-extrabold text-black uppercase">Stage 02 · Past</span>
                </div>
                <span class="text-[9px] sm:text-xs font-extrabold text-white/40 uppercase">v{{ $gameVersion }}</span>
                <button onclick="toggleFullscreen()"
                    class="bg-highlight border-2 border-black shadow-brutal-sm px-2 sm:px-3 py-1.5 cursor-pointer hover:bg-accent transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Game iframe --}}
        <div class="flex-1 flex items-center justify-center p-1 sm:p-4">
            <div id="gameContainer" class="w-full h-full max-w-5xl border-3 border-black shadow-brutal-lg bg-black" style="min-height: 500px;">
                <iframe src="https://experience.igx.co.id/{{ $gameVersion }}"
                        style="width: 100%; height: 100%; min-height: 500px; border: none;"
                        allow="autoplay; fullscreen"
                        allowfullscreen
                        id="gameIframe"></iframe>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="//unpkg.com/alpinejs" defer></script>
<script>
let isFullscreen = false;

function toggleFullscreen() {
    const container = document.getElementById('gameContainer');
    const iframe = document.getElementById('gameIframe');

    if (!isFullscreen) {
        iframe.classList.add('iframe-fullscreen');
        document.body.style.overflow = 'hidden';
        isFullscreen = true;
        if (iframe.requestFullscreen) {
            iframe.requestFullscreen().catch(function(){});
        } else if (iframe.webkitRequestFullscreen) {
            iframe.webkitRequestFullscreen();
        } else if (iframe.msRequestFullscreen) {
            iframe.msRequestFullscreen();
        }
    } else {
        exitFullscreen();
    }
}

function exitFullscreen() {
    const iframe = document.getElementById('gameIframe');
    iframe.classList.remove('iframe-fullscreen');
    document.body.style.overflow = 'auto';
    isFullscreen = false;
    if (document.exitFullscreen) {
        document.exitFullscreen().catch(function(){});
    } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
    }
}

document.addEventListener('fullscreenchange', function() {
    if (!document.fullscreenElement && isFullscreen) exitFullscreen();
});
document.addEventListener('webkitfullscreenchange', function() {
    if (!document.webkitFullscreenElement && isFullscreen) exitFullscreen();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && isFullscreen) exitFullscreen();
});
</script>
@endpush
