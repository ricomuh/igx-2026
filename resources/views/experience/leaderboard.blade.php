@extends('layouts.main', [
    'title' => 'Leaderboard',
])

@push('style')
<style>
    body {
        background-color: #322366 !important;
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
    {{-- White halftone dots — visible --}}
    <div class="absolute inset-0 z-0 pointer-events-none"
         style="background-image: radial-gradient(circle, rgba(255,255,255,0.15) 1px, transparent 1px); background-size: 16px 16px;">
    </div>

    {{-- Diagonal accents --}}
    <div class="absolute top-16 -left-16 w-64 h-6 bg-highlight rotate-[-8deg] border-2 border-black opacity-30 z-0"></div>
    <div class="absolute bottom-32 -right-16 w-80 h-8 bg-accent rotate-[6deg] border-2 border-black opacity-30 z-0"></div>

    <div class="container mx-auto px-5 xl:px-12 pt-28 pb-20 relative z-10">

        {{-- HEADER --}}
        <div class="flex flex-col items-center mb-6">
            <div class="bg-primary border-3 border-black shadow-brutal px-6 py-3 sm:px-10 sm:py-4 rotate-[-1deg] mb-3">
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold uppercase text-black text-center leading-none">
                    🏆 Leaderboard
                </h1>
            </div>
            <div class="bg-accent border-3 border-black shadow-brutal px-5 py-2 rotate-[1deg]">
                <p class="text-sm sm:text-base font-extrabold uppercase text-black">Weekly Ranking — Top 20</p>
            </div>
        </div>

        {{-- Back to game link --}}
        <div class="text-center mb-10">
            <a href="{{ route('experiences') }}"
               class="inline-flex items-center gap-2 text-sm font-extrabold uppercase text-highlight hover:text-accent transition-colors border-2 border-highlight/30 px-4 py-2 hover:border-accent">
                <span>&#x25C0;</span> Back to Game
            </a>
        </div>

        @if($leaderboard->isNotEmpty())
            {{-- TOP 3 PODIUM --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-10 max-w-4xl mx-auto">
                @php
                    $medals = ['🥇', '🥈', '🥉'];
                    $podiumColors = ['bg-highlight', 'bg-surface', 'bg-primary'];
                    $tierColors = ['bg-highlight text-black', 'bg-surface text-black', 'bg-primary text-black'];
                    $tiers = ['S', 'A', 'B'];
                    $maxScore = $leaderboard->first()->score ?: 1;
                @endphp

                @foreach([1, 0, 2] as $podiumPos)
                    @php $entry = $leaderboard[$podiumPos]; $index = $podiumPos; @endphp
                    <div class="card-brutal {{ $podiumColors[$index] }} {{ $index == 0 ? 'podium-1 md:scale-110 z-10' : '' }} {{ $index == 0 ? 'md:-mt-4' : 'md:mt-6' }} overflow-hidden">
                        <div class="bg-black px-3 py-1.5 flex items-center justify-between">
                            <span class="text-[10px] sm:text-xs font-extrabold {{ $tierColors[$index] }} px-2 py-0.5 border border-current">
                                TIER {{ $tiers[$index] }}
                            </span>
                            <span class="text-2xl">{{ $medals[$index] }}</span>
                        </div>

                        <div class="p-4 sm:p-5 text-center">
                            @if($index == 0)
                                <div class="text-4xl trophy-float mb-1">👑</div>
                            @endif

                            <div class="w-14 h-14 sm:w-16 sm:h-16 mx-auto mb-3 border-3 border-black {{ $index == 0 ? 'bg-highlight' : ($index == 1 ? 'bg-surface-dark' : 'bg-primary-dark') }} flex items-center justify-center shadow-brutal-sm">
                                <span class="text-2xl sm:text-3xl font-extrabold text-black">
                                    {{ strtoupper(substr($entry->username, 0, 1)) }}
                                </span>
                            </div>

                            <h3 class="font-extrabold text-base sm:text-lg uppercase text-black mb-1 truncate">{{ $entry->username }}</h3>

                            <div class="mt-3">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-[10px] font-extrabold uppercase text-black/60">SCORE</span>
                                    <span class="text-sm font-extrabold text-black">{{ number_format($entry->score) }} XP</span>
                                </div>
                                <div class="h-3 border-2 border-black bg-black/10 overflow-hidden">
                                    @php $pct = min(($entry->score / $maxScore) * 100, 100); @endphp
                                    <div class="h-full {{ $index == 0 ? 'bg-highlight' : ($index == 1 ? 'bg-primary' : 'bg-accent') }}"
                                         style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- RANK 4-20 TABLE --}}
            <div class="max-w-2xl mx-auto">
                <div class="card-brutal bg-surface overflow-hidden">
                    <div class="bg-black px-4 py-2 flex items-center justify-between">
                        <span class="text-xs font-extrabold text-highlight uppercase tracking-wider">Rank 4-20</span>
                        <span class="text-[10px] font-bold text-white/40 uppercase">SCORE</span>
                    </div>
                    <div class="divide-y-2 divide-black">
                        @foreach($leaderboard->slice(3) as $index => $entry)
                            @php $rank = $index + 4; @endphp
                            <div class="flex items-center gap-3 px-4 py-3 hover:bg-highlight/10 transition-colors group">
                                <span class="w-8 h-8 border-2 border-black flex items-center justify-center font-extrabold text-sm shrink-0
                                    {{ $rank == 4 ? 'bg-highlight text-black' : 'bg-surface-dark text-black/60' }}">
                                    #{{ $rank }}
                                </span>
                                <span class="flex-1 font-bold text-sm sm:text-base text-black uppercase truncate">{{ $entry->username }}</span>
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
            <div class="card-brutal bg-surface max-w-lg mx-auto p-10 text-center">
                <div class="text-5xl mb-4">🎮</div>
                <h3 class="text-xl font-extrabold text-black uppercase mb-2">No Scores Yet!</h3>
                <p class="text-sm font-bold text-black/60 mb-6">Be the first to play and claim the #1 spot!</p>
                <a href="{{ route('experiences') }}" class="btn-brutal inline-block">Play Now</a>
            </div>
        @endif
    </div>
</div>
@endsection
