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

    /* Sidebar transition */
    .lb-sidebar { transition: width 0.3s ease; }
    .lb-sidebar.collapsed .lb-content { display: none; }
    .lb-sidebar.collapsed .lb-collapsed-view { display: flex; }
    .lb-sidebar.expanded .lb-collapsed-view { display: none; }

    /* Hide sidebar on mobile by default */
    @media (max-width: 767px) {
        .lb-sidebar { width: 0 !important; border: none !important; box-shadow: none !important; }
        .lb-sidebar .lb-collapsed-view { display: none !important; }
        .lb-sidebar .lb-content { display: none !important; }
        .lb-sidebar.mobile-open { width: 72vw !important; max-width: 280px !important; border-right: 4px solid black !important; box-shadow: 4px 0 0 rgba(242,83,182,0.3) !important; }
        .lb-sidebar.mobile-open .lb-content { display: flex !important; }
        .lb-sidebar.mobile-open .lb-collapsed-view { display: none !important; }

        /* Mobile overlay */
        .lb-overlay { display: none; }
        .lb-overlay.active { display: block; position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 15; }
    }

    .lb-scroll::-webkit-scrollbar { width: 6px; }
    .lb-scroll::-webkit-scrollbar-track { background: #1A1040; }
    .lb-scroll::-webkit-scrollbar-thumb { background: #F88832; border-radius: 3px; }
</style>
@endpush

@section('content')
<div class="game-bg flex flex-col md:flex-row relative" style="min-height: calc(100vh - 72px);" x-data="{ sidebarOpen: window.innerWidth >= 768, mobileSidebar: false }" @resize.window="sidebarOpen = window.innerWidth >= 768">

    {{-- Mobile leaderboard toggle button --}}
    <button @click="mobileSidebar = !mobileSidebar"
            class="md:hidden fixed bottom-20 left-3 z-40 bg-accent border-3 border-black shadow-brutal-sm w-12 h-12 flex items-center justify-center cursor-pointer"
            aria-label="Toggle leaderboard">
        <x-heroicon-o-trophy class="w-6 h-6 text-black" />
    </button>

    {{-- Mobile overlay --}}
    <div class="lb-overlay md:hidden" :class="mobileSidebar ? 'active' : ''" @click="mobileSidebar = false"></div>

    {{-- ========== LEFT SIDEBAR LEADERBOARD ========== --}}
    <div class="lb-sidebar expanded shrink-0 relative z-20 border-r-4 border-black bg-black/90 overflow-hidden flex flex-col"
         :class="{
             'w-72 lg:w-80': sidebarOpen && window.innerWidth >= 768,
             'w-14': !sidebarOpen && window.innerWidth >= 768,
             'mobile-open': mobileSidebar
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
        <div class="lb-collapsed-view hidden flex-col items-center gap-1 py-4 overflow-y-auto lb-scroll flex-1">
            <span class="text-[10px] font-extrabold text-highlight/60 uppercase mb-1">TOP</span>
            @foreach($leaderboard->take(10) as $index => $entry)
                <span class="text-xs font-extrabold w-8 h-8 flex items-center justify-center border border-white/20
                    {{ $index == 0 ? 'text-highlight bg-highlight/20' : 'text-white/50' }}">
                    {{ $index + 1 }}
                </span>
            @endforeach
        </div>

        {{-- Expanded view --}}
        <div class="lb-content flex flex-col" style="max-height: calc(100vh - 72px);">
            {{-- Header --}}
            <div class="bg-accent border-b-3 border-black px-4 py-3">
                <h3 class="text-sm font-extrabold uppercase text-black flex items-center gap-2">
                    <x-heroicon-o-trophy class="w-4 h-4 text-black" />
                    Leaderboard
                </h3>
                <p class="text-[10px] font-bold text-black/60 uppercase mt-0.5">Weekly Ranking</p>
            </div>

            {{-- Top 3 mini podium --}}
            <div class="flex gap-1 px-3 py-3 border-b-2 border-white/10">
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
                <span class="text-[9px] sm:text-xs font-extrabold text-white/40 uppercase">v{{ $gameVersion }}</span>
                <button id="fullscreenBtn"
                    class="bg-highlight border-2 border-black shadow-brutal-sm px-2 sm:px-3 py-1.5 cursor-pointer hover:bg-accent transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Game iframe --}}
        <div class="flex-1 flex items-center justify-center p-1 sm:p-4">
            <div id="main" class="w-full h-full max-w-5xl border-3 border-black shadow-brutal-lg bg-black" style="min-height: 400px;"></div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="//unpkg.com/alpinejs" defer></script>
<script>
    window.mobileAndTabletCheck = function () {
        let check = false;
        (function (a) {
          if (/(android|bb\\d+|meego).+mobile|avantgo|bada\\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a) ||
            /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\\-(n|u)|c55\\/|capi|ccwa|cdm\\-|cell|chtm|cldc|cmd\\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\\-s|devi|dica|dmob|do(c|p)o|ds(12|\\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\\-|_)|g1 u|g560|gene|gf\\-5|g\\-mo|go(\\.w|od)|gr(ad|un)|haie|hcit|hd\\-(m|p|t)|hei\\-|hi(pt|ta)|hp( i|ip)|hs\\-c|ht(c(\\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\\-(20|go|ma)|i230|iac( |\\-|\\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\\/)|klon|kpt |kwc\\-|kyo(c|k)|le(no|xi)|lg( g|\\/(k|l|u)|50|54|\\-[a-w])|libw|lynx|m1\\-w|m3ga|m50\\/|ma(te|ui|xo)|mc(01|21|ca)|m\\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\\-2|po(ck|rt|se)|prox|psio|pt\\-g|qa\\-a|qc(07|12|21|32|60|\\-[2-7]|i\\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\\-|oo|p\\-)|sdk\\/|se(c(\\-|0|1)|47|mc|nd|ri)|sgh\\-|shar|sie(\\-|m)|sk\\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\\-|v\\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\\-|tdg\\-|tel(i|m)|tim\\-|t\\-mo|to(pl|sh)|ts(70|m\\-|m3|m5)|tx\\-9|up(\\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\\-|your|zeto|zte\\-/i.test(a.substr(0, 4)))
          ) check = true;
        })(navigator.userAgent || navigator.vendor || window.opera);
        return check;
    };

    const version = "{{ $gameVersion }}";
    let isFullscreen = false;

    const createIframe = (container) => {
        const isMobile = mobileAndTabletCheck();
        const src = `https://experience.igx.co.id/${version}`;
        container.innerHTML = `<iframe src="${src}" style="width: 100%; height: 100%; min-height: 500px; border: none;" allow="autoplay; fullscreen" allowfullscreen></iframe>`;
    }

    const enterFullscreen = () => {
        const mainDiv = document.getElementById("main");
        const iframe = mainDiv.querySelector('iframe');
        if (iframe) {
          iframe.classList.add('iframe-fullscreen');
          document.body.style.overflow = "hidden";
          isFullscreen = true;
          if (iframe.requestFullscreen) {
            iframe.requestFullscreen().catch(err => {});
          } else if (iframe.webkitRequestFullscreen) {
            iframe.webkitRequestFullscreen();
          } else if (iframe.msRequestFullscreen) {
            iframe.msRequestFullscreen();
          }
        }
    }

    const exitFullscreen = () => {
        const mainDiv = document.getElementById("main");
        const iframe = mainDiv.querySelector('iframe');
        if (iframe) {
          iframe.classList.remove('iframe-fullscreen');
          document.body.style.overflow = "auto";
          isFullscreen = false;
        }
        if (document.exitFullscreen) {
          document.exitFullscreen().catch(err => {});
        } else if (document.webkitExitFullscreen) {
          document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) {
          document.msExitFullscreen();
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        const mainDiv = document.getElementById("main");
        const fullscreenBtn = document.getElementById("fullscreenBtn");
        createIframe(mainDiv);
        fullscreenBtn.addEventListener("click", enterFullscreen);
        document.addEventListener("keydown", function(event) {
          if (event.key === "Escape" && isFullscreen) exitFullscreen();
        });
        document.addEventListener("fullscreenchange", function() {
          if (!document.fullscreenElement && isFullscreen) exitFullscreen();
        });
        document.addEventListener("webkitfullscreenchange", function() {
          if (!document.webkitFullscreenElement && isFullscreen) exitFullscreen();
        });
        document.addEventListener("msfullscreenchange", function() {
          if (!document.msFullscreenElement && isFullscreen) exitFullscreen();
        });
    });
</script>
@endpush
