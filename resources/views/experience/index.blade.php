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
        aspect-ratio: 16 / 9;
        min-height: 250px;
    }
    .iframe-fullscreen {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        z-index: 10000 !important;
        border: none !important;
    }

    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 0 0 rgba(242, 83, 182, 0.4); }
        50% { box-shadow: 0 0 0 12px rgba(242, 83, 182, 0); }
    }
    .podium-1 { animation: pulse-glow 2s ease-in-out infinite; }

    @keyframes float-trophy {
        0%, 100% { transform: translateY(0) rotate(-5deg); }
        50% { transform: translateY(-8px) rotate(-3deg); }
    }
    .trophy-float { animation: float-trophy 3s ease-in-out infinite; }
</style>
@endpush

@section('content')
<div class="bg-secondary min-h-screen relative overflow-hidden">
    {{-- Halftone dots --}}
    <div class="absolute inset-0 z-0 opacity-[0.05] pointer-events-none"
         style="background-image: radial-gradient(circle, #9A94CC 1px, transparent 1px); background-size: 20px 20px;">
    </div>

    {{-- Diagonal accents --}}
    <div class="absolute top-16 -left-16 w-64 h-6 bg-highlight rotate-[-8deg] border-2 border-black opacity-30 z-0"></div>
    <div class="absolute bottom-32 -right-16 w-80 h-8 bg-accent rotate-[6deg] border-2 border-black opacity-30 z-0"></div>

    <div class="container mx-auto px-5 xl:px-12 pt-28 pb-20 relative z-10">

        {{-- HEADER --}}
        <div class="flex flex-col items-center mb-10 lg:mb-14">
            <div class="bg-primary border-3 border-black shadow-brutal px-6 py-3 sm:px-10 sm:py-4 rotate-[-1deg] mb-3">
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold uppercase text-black text-center leading-none">
                    IGX Fusion
                </h1>
            </div>
            <div class="bg-accent border-3 border-black shadow-brutal px-6 py-3 sm:px-10 sm:py-4 rotate-[1deg]">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold uppercase text-black text-center leading-none"
                    style="text-shadow: 3px 3px 0px #F2D62D;">
                    Celebration!
                </h1>
            </div>
        </div>

        {{-- ==================== LEADERBOARD ==================== --}}
        <div class="mb-16">
            {{-- Leaderboard title badge --}}
            <div class="flex justify-center mb-8">
                <div class="relative">
                    <div class="bg-highlight border-3 border-black shadow-brutal px-8 py-3 rotate-[-0.5deg]">
                        <h2 class="text-lg sm:text-xl md:text-2xl font-extrabold uppercase text-black flex items-center gap-3">
                            <span class="text-2xl">🏆</span>
                            Weekly Ranking
                            <span class="text-2xl">🏆</span>
                        </h2>
                    </div>
                    {{-- COMBO badge --}}
                    <div class="absolute -top-3 -right-4 bg-crimson border-2 border-black px-2 py-0.5 shadow-brutal-sm rotate-[6deg]">
                        <span class="text-[10px] sm:text-xs font-extrabold text-white uppercase">TOP 10</span>
                    </div>
                </div>
            </div>

            @if($leaderboard->isNotEmpty())
                {{-- TOP 3 PODIUM --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-8 max-w-4xl mx-auto">
                    @php
                        $medals = ['🥇', '🥈', '🥉'];
                        $podiumColors = ['bg-highlight', 'bg-surface', 'bg-primary'];
                        $tierColors = ['bg-highlight text-black', 'bg-surface text-black', 'bg-primary text-black'];
                        $tiers = ['S', 'A', 'B'];
                    @endphp

                    {{-- Render in podium order: 2nd, 1st, 3rd --}}
                    @foreach([1, 0, 2] as $podiumPos)
                        @php $entry = $leaderboard[$podiumPos]; $index = $podiumPos; @endphp
                        <div class="card-brutal {{ $podiumColors[$index] }} {{ $index == 0 ? 'podium-1 md:scale-110 z-10' : '' }} {{ $index == 0 ? 'md:-mt-4' : ($index == 1 ? 'md:mt-6' : 'md:mt-6') }} overflow-hidden">
                            {{-- Tier badge --}}
                            <div class="bg-black px-3 py-1.5 flex items-center justify-between">
                                <span class="text-[10px] sm:text-xs font-extrabold {{ $tierColors[$index] }} px-2 py-0.5 border border-current">
                                    TIER {{ $tiers[$index] }}
                                </span>
                                <span class="text-2xl">{{ $medals[$index] }}</span>
                            </div>

                            <div class="p-4 sm:p-5 text-center">
                                {{-- Crown for #1 --}}
                                @if($index == 0)
                                    <div class="text-4xl trophy-float mb-1">👑</div>
                                @endif

                                {{-- Avatar placeholder --}}
                                <div class="w-14 h-14 sm:w-16 sm:h-16 mx-auto mb-3 border-3 border-black {{ $index == 0 ? 'bg-highlight' : ($index == 1 ? 'bg-surface-dark' : 'bg-primary-dark') }} flex items-center justify-center shadow-brutal-sm">
                                    <span class="text-2xl sm:text-3xl font-extrabold text-black">
                                        {{ strtoupper(substr($entry->username, 0, 1)) }}
                                    </span>
                                </div>

                                <h3 class="font-extrabold text-base sm:text-lg uppercase text-black mb-1 truncate">{{ $entry->username }}</h3>

                                {{-- Score with XP bar --}}
                                <div class="mt-3">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-[10px] font-extrabold uppercase text-black/60">SCORE</span>
                                        <span class="text-sm font-extrabold text-black">{{ number_format($entry->score) }} XP</span>
                                    </div>
                                    <div class="h-3 border-2 border-black bg-black/10 overflow-hidden">
                                        @php
                                            $maxScore = $leaderboard->first()->score ?: 1;
                                            $pct = min(($entry->score / $maxScore) * 100, 100);
                                        @endphp
                                        <div class="h-full {{ $index == 0 ? 'bg-highlight' : ($index == 1 ? 'bg-primary' : 'bg-accent') }}"
                                             style="width: {{ $pct }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- RANK 4-10 TABLE --}}
                <div class="max-w-2xl mx-auto">
                    <div class="card-brutal bg-surface overflow-hidden">
                        <div class="bg-black px-4 py-2">
                            <span class="text-xs font-extrabold text-highlight uppercase tracking-wider">Rank 4-10</span>
                        </div>
                        <div class="divide-y-2 divide-black">
                            @foreach($leaderboard->slice(3) as $index => $entry)
                                @php $rank = $index + 4; @endphp
                                <div class="flex items-center gap-3 px-4 py-3 hover:bg-highlight/20 transition-colors group">
                                    {{-- Rank number --}}
                                    <span class="w-8 h-8 border-2 border-black flex items-center justify-center font-extrabold text-sm shrink-0
                                        {{ $rank == 4 ? 'bg-highlight text-black' : 'bg-surface-dark text-black/60' }}">
                                        #{{ $rank }}
                                    </span>

                                    {{-- Username --}}
                                    <span class="flex-1 font-bold text-sm sm:text-base text-black uppercase truncate">
                                        {{ $entry->username }}
                                    </span>

                                    {{-- Score --}}
                                    <span class="font-extrabold text-sm text-black shrink-0">
                                        {{ number_format($entry->score) }}
                                        <span class="text-[10px] text-black/40">XP</span>
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                {{-- Empty state --}}
                <div class="card-brutal bg-surface max-w-lg mx-auto p-10 text-center">
                    <div class="text-5xl mb-4">🎮</div>
                    <h3 class="text-xl font-extrabold text-black uppercase mb-2">No Scores Yet!</h3>
                    <p class="text-sm font-bold text-black/60">Be the first to play and claim the #1 spot!</p>
                </div>
            @endif
        </div>

        {{-- ==================== GAME IFRAME SECTION ==================== --}}
        <div class="max-w-4xl mx-auto">
            {{-- Game title bar --}}
            <div class="flex items-center justify-between mb-4">
                <div class="bg-accent border-3 border-black shadow-brutal-sm px-5 py-2 rotate-[-1deg]">
                    <span class="text-lg sm:text-xl font-extrabold uppercase text-black flex items-center gap-2">
                        🕹️ PLAY NOW
                    </span>
                </div>
                <div class="bg-black border-2 border-highlight px-3 py-1 shadow-brutal-sm">
                    <span class="text-[10px] sm:text-xs font-extrabold text-highlight uppercase">v{{ $gameVersion }}</span>
                </div>
            </div>

            {{-- Game wrapper --}}
            <div class="card-brutal bg-black overflow-hidden">
                <div id="main" class="w-full"></div>
            </div>

            {{-- Fullscreen button --}}
            <div class="flex justify-center mt-6">
                <button id="fullscreenBtn"
                    class="btn-brutal-yellow text-lg px-8 py-4 inline-flex items-center gap-3 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"/>
                    </svg>
                    <span class="font-extrabold uppercase">Fullscreen</span>
                </button>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
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
        const src = mobileAndTabletCheck()
          ? `https://experience.igx.co.id/${version}-mob`
          : `https://experience.igx.co.id/${version}`;
        container.innerHTML = `<iframe src="${src}" style="width: 100%; border: none;"></iframe>`;
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
