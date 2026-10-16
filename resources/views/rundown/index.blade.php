@extends('layouts.main', [
    'title' => 'Rundown',
    'description' => 'Official full rundown IGX Main Stage, Indonesia Game Expo 2026 di ICE BSD Hall 9-10, 24-25 Oktober 2026.'
])

@php
    // Parsed from the official full rundown poster (media/images/rundown/official-rundown-2026.webp).
    // [start, end, title, subtitle]; a null subtitle with 'mc' => true renders as a host segment.
    $days = [
        [
            'key' => 'day-1',
            'label' => 'Day 1',
            'date' => '2026-10-24',
            'dateLabel' => 'Saturday, 24 October 2026',
            'short' => 'Sat · 24 Oct',
            'items' => [
                ['10:00', '10:30', "Let's Fight Together!", 'Opening Ceremony'],
                ['10:45', '11:15', 'Chiitan Mania!', 'Adventures in Indonesia'],
                ['11:30', '12:15', 'The Origin of Jugglus Juggler', 'with Takaya Aoyagi'],
                ['12:30', '13:15', 'Illustrator Battle feat. A Night to Remember', 'Simone Legno (Tokidoki), Hitoshi Ariga, Kirisaki feat. Adam Putra'],
                ['13:30', '14:15', 'Bizzare Adventure of Street Fighter', 'with Takayuki Nakayama'],
                ['14:30', '15:15', 'Dungeon & Dragons', 'by Midnight Misfits'],
                ['15:30', '16:15', 'International Cosplay All-Star', 'Peach Milky · Shookoboo · Nekonoi Katsu'],
                ['16:30', '17:00', 'Exclusive IGX Kamen Rider Live Show', null],
                ['17:15', '18:00', 'Episode True', 'with Takamasa Suga & Satoshi Matsuda'],
                ['18:30', '20:00', 'Elite Wars', 'Cosplay Team Competition'],
                ['20:00', '20:30', 'Akari Akase Special Talk Show & Concert', null],
                ['20:30', '20:45', 'Elite Wars', 'Cosplay Team Award Ceremony'],
                ['20:45', '21:00', 'Closing by MC', null, 'mc' => true],
            ],
        ],
        [
            'key' => 'day-2',
            'label' => 'Day 2',
            'date' => '2026-10-25',
            'dateLabel' => 'Sunday, 25 October 2026',
            'short' => 'Sun · 25 Oct',
            'items' => [
                ['10:00', '10:15', 'Opening by MC', null, 'mc' => true],
                ['10:15', '10:45', 'Cosplay Creator All-Stars', null],
                ['11:00', '11:30', 'Chiitan Mania!', 'Adventures in Indonesia'],
                ['11:45', '12:15', 'Video Game on the Big Screen', 'with Takayuki Nakayama'],
                ['12:30', '13:15', 'Illustrator Battle feat. Piano Monster', 'Presented by Cosmonauts · Simone Legno (Tokidoki), Hitoshi Ariga, Kirisaki feat. Kevin Aprilio & Punipun'],
                ['13:30', '14:00', 'Exclusive IGX Kamen Rider Live Show', null],
                ['14:15', '14:45', 'Survive Final', 'with Takamasa Suga & Satoshi Matsuda'],
                ['15:00', '15:30', 'The Popularity of Jugglus Juggler', 'with Takaya Aoyagi'],
                ['15:45', '17:00', 'Elite Wars', 'Coswalk Competition'],
                ['17:15', '17:45', 'Beyond Cosplay!', 'with Peach Milky'],
                ['18:00', '18:45', 'Dungeon & Dragons', 'by Midnight Misfits'],
                ['19:00', '20:45', 'Elite Wars', 'Single Cosplay Competition'],
                ['20:45', '21:15', 'Akari Akase Special Talk Show & Concert', null],
                ['21:15', '21:30', 'Elite Wars', 'Cosplay Single Award Ceremony'],
                ['21:30', '21:45', 'Closing by MC', null, 'mc' => true],
            ],
        ],
    ];

    $toMinutes = fn (string $t) => ((int) substr($t, 0, 2)) * 60 + (int) substr($t, 3, 2);
    $dot = fn (string $t) => str_replace(':', '.', $t);
    $duration = function (string $start, string $end) use ($toMinutes) {
        $m = $toMinutes($end) - $toMinutes($start);
        if ($m < 60) return $m . ' mnt';
        return intdiv($m, 60) . ' jam' . ($m % 60 ? ' ' . ($m % 60) . ' mnt' : '');
    };

    $poster = asset('media/images/rundown/official-rundown-2026.webp');
    $posterThumb = asset('media/images/rundown/official-rundown-2026-thumb.webp');
@endphp

@push('style')
<style>
    body { background-color: #322366 !important; }

    /* Session colours sampled from the poster: Day 1 magenta, Day 2 orange,
       each alternating a lighter and a deeper shade like the printed grid. */
    .rundown-day-1 { --tone-a: #E24ADB; --tone-b: #B5139E; --tone-head: #F253B6; }
    .rundown-day-2 { --tone-a: #F0904A; --tone-b: #D9560B; --tone-head: #F88832; }

    .session-card { background: var(--tone-a); color: #000; }
    .session.is-alt .session-card { background: var(--tone-b); color: #fff; }
    .session.is-alt .session-card .session-sub { color: rgba(255, 255, 255, .85); }
    .session-head { background: var(--tone-head); }

    /* Mobile shows one day at a time (tabs); from lg both days sit side by side like the poster. */
    .day-panel { display: none; }
    .day-panel.is-active { display: block; }
    @media (min-width: 1024px) { .day-panel { display: block; } }

    .session.is-past { opacity: .5; }
    .session.is-live .session-card { outline: 4px solid #F2D62D; outline-offset: 3px; }
    .live-dot { animation: live-pulse 1.2s ease-in-out infinite; }
    @keyframes live-pulse { 50% { opacity: .35; } }
    @media (prefers-reduced-motion: reduce) { .live-dot { animation: none; } }

    #posterModal { z-index: 99999 !important; }
</style>
@endpush

@section('content')
<div class="bg-secondary min-h-screen relative overflow-hidden pb-16 font-moon">
    {{-- Background dot grid --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-[0.06]"
         style="background-image: radial-gradient(circle, #fff 1.5px, transparent 1.5px); background-size: 20px 20px;">
    </div>

    <div class="container mx-auto px-4 sm:px-6 xl:px-12 pt-6 sm:pt-8 relative z-10">

        {{-- Header + poster --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-5 mb-6 sm:mb-8">
            <div class="min-w-0">
                <div class="flex items-center gap-2 mb-2 flex-wrap">
                    <span class="bg-mint text-black border-2 border-black shadow-brutal-sm text-[10px] sm:text-xs font-black uppercase px-2.5 py-0.5 rotate-[-1deg]">
                        ICE BSD · HALL 9-10
                    </span>
                    <span class="bg-highlight text-black border-2 border-black shadow-brutal-sm text-[10px] sm:text-xs font-black uppercase px-2.5 py-0.5 rotate-[1deg]">
                        24-25 OCTOBER 2026
                    </span>
                </div>

                <div class="bg-surface border-3 border-black shadow-brutal px-5 py-2 sm:py-3 inline-block rotate-[-0.5deg]">
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold uppercase text-black leading-tight">
                        Official Full Rundown
                    </h1>
                </div>
                <p class="text-xs sm:text-sm font-bold text-surface/70 mt-3 uppercase tracking-wide flex items-center gap-2">
                    <x-heroicon-o-musical-note class="w-4 h-4 shrink-0" />
                    IGX Main Stage · Semua waktu dalam WIB
                </p>

                {{-- Live strip, filled by script during the event --}}
                <div id="nowPlaying" hidden
                     class="mt-4 bg-black text-white border-3 border-black shadow-brutal-sm px-3 py-2 inline-flex items-center gap-2 max-w-full">
                    <span class="live-dot w-2.5 h-2.5 bg-crimson rounded-full shrink-0"></span>
                    <span class="text-[10px] sm:text-xs font-black uppercase text-highlight shrink-0">Live di Main Stage</span>
                    <span id="nowPlayingTitle" class="text-xs sm:text-sm font-extrabold uppercase truncate"></span>
                </div>
            </div>

            {{-- Poster thumbnail: tap to view the original full screen --}}
            <button type="button" onclick="openPoster()"
                    class="group self-start md:self-auto shrink-0 flex items-center gap-3 bg-surface border-3 border-black shadow-brutal-sm hover:shadow-brutal hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all p-2 pr-4 text-left cursor-pointer">
                <img src="{{ $posterThumb }}" alt="Poster official full rundown IGX 2026"
                     width="72" height="91" loading="lazy"
                     class="w-14 sm:w-[72px] h-auto border-2 border-black">
                <span class="flex flex-col">
                    <span class="text-xs sm:text-sm font-black uppercase text-black flex items-center gap-1.5">
                        <x-heroicon-o-arrows-pointing-out class="w-4 h-4" />
                        Lihat poster
                    </span>
                    <span class="text-[10px] sm:text-xs font-bold text-black/60 uppercase">Versi gambar resmi</span>
                </span>
            </button>
        </div>

        {{-- Day tabs (mobile & tablet) --}}
        <div class="lg:hidden grid grid-cols-2 gap-3 mb-5" role="tablist" aria-label="Pilih hari">
            @foreach ($days as $i => $day)
                <button type="button" role="tab" id="tab-{{ $day['key'] }}" data-day-tab="{{ $day['key'] }}"
                        aria-controls="{{ $day['key'] }}" aria-selected="{{ $i === 0 ? 'true' : 'false' }}"
                        class="day-tab rundown-{{ $day['key'] }} session-head border-3 border-black px-3 py-2.5 text-left transition-all cursor-pointer
                               aria-selected:shadow-brutal aria-selected:-translate-x-0.5 aria-selected:-translate-y-0.5
                               aria-[selected=false]:opacity-60 aria-[selected=false]:shadow-none">
                    <span class="block text-base sm:text-lg font-black uppercase text-black leading-none">{{ $day['label'] }}</span>
                    <span class="block text-[10px] sm:text-xs font-bold uppercase text-black/70 mt-1">{{ $day['short'] }}</span>
                </button>
            @endforeach
        </div>

        {{-- Schedule --}}
        <div class="grid lg:grid-cols-2 gap-6 lg:gap-8 items-start">
            @foreach ($days as $i => $day)
                <section id="{{ $day['key'] }}" role="tabpanel" aria-labelledby="tab-{{ $day['key'] }}"
                         class="day-panel rundown-{{ $day['key'] }} {{ $i === 0 ? 'is-active' : '' }}"
                         data-date="{{ $day['date'] }}">
                    {{-- Day heading --}}
                    <div class="session-head border-3 border-black shadow-brutal px-4 py-3 mb-4 flex items-center justify-between gap-3">
                        <h2 class="text-lg sm:text-xl xl:text-2xl font-black uppercase text-black leading-tight">
                            {{ $day['label'] }}, {{ $day['dateLabel'] }}
                        </h2>
                        <x-heroicon-o-calendar-days class="w-6 h-6 text-black shrink-0 hidden sm:block" />
                    </div>

                    <ol class="flex flex-col gap-3">
                        @php $sessionIndex = 0; @endphp
                        @foreach ($day['items'] as $item)
                            @php [$start, $end, $title, $sub] = $item; @endphp

                            @if (!empty($item['mc']))
                                <li class="session-mc flex items-center gap-3"
                                    data-start="{{ $start }}" data-end="{{ $end }}" data-title="{{ $title }}">
                                    <span class="w-[76px] sm:w-[88px] shrink-0 text-center text-sm font-black text-surface tabular-nums">{{ $dot($start) }}</span>
                                    <span class="flex-1 border-2 border-dashed border-surface/40 px-3 py-1.5 text-[11px] sm:text-xs font-black uppercase tracking-wider text-surface/80">
                                        {{ $title }}
                                    </span>
                                </li>
                            @else
                                <li class="session flex items-stretch gap-3 {{ $sessionIndex++ % 2 ? 'is-alt' : '' }}"
                                    data-start="{{ $start }}" data-end="{{ $end }}" data-title="{{ $title }}{{ $sub && $title === 'Elite Wars' ? ': ' . $sub : '' }}">
                                    {{-- Time --}}
                                    <div class="w-[76px] sm:w-[88px] shrink-0 bg-black text-surface border-3 border-black flex flex-col items-center justify-center py-2 tabular-nums">
                                        <span class="text-base sm:text-lg font-black leading-none">{{ $dot($start) }}</span>
                                        <span class="text-[10px] sm:text-xs font-bold text-surface/60 mt-1">s/d {{ $dot($end) }}</span>
                                    </div>

                                    {{-- Session --}}
                                    <div class="session-card flex-1 min-w-0 border-3 border-black shadow-brutal-sm px-3 sm:px-4 py-2.5 relative">
                                        <span class="live-badge hidden absolute -top-3 right-3 bg-highlight text-black border-2 border-black text-[10px] font-black uppercase px-2 py-0.5 items-center gap-1">
                                            <span class="live-dot w-2 h-2 bg-crimson rounded-full"></span> Live
                                        </span>
                                        <h3 class="text-sm sm:text-base font-black uppercase leading-snug text-balance">{{ $title }}</h3>
                                        @if ($sub)
                                            <p class="session-sub text-[11px] sm:text-xs font-bold uppercase text-black/75 mt-0.5 leading-snug">{{ $sub }}</p>
                                        @endif
                                        <p class="session-sub text-[10px] font-bold uppercase text-black/55 mt-1 flex items-center gap-1">
                                            <x-heroicon-o-clock class="w-3 h-3" /> {{ $duration($start, $end) }}
                                        </p>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </section>
            @endforeach
        </div>

        <p class="text-[11px] sm:text-xs font-bold text-surface/50 uppercase mt-8 text-center">
            Jadwal dapat berubah sewaktu-waktu. Pantau update di Instagram @indonesiagameexpo.
        </p>
    </div>
</div>

{{-- Poster lightbox --}}
<div id="posterModal" class="fixed inset-0 bg-black/90 hidden flex-col items-center justify-center p-4 gap-3" onclick="closePoster()" role="dialog" aria-modal="true" aria-label="Poster official full rundown">
    <div class="relative" onclick="event.stopPropagation()">
        <img id="posterImage" src="" alt="Poster official full rundown IGX 2026"
             class="max-w-[95vw] max-h-[82vh] sm:max-h-[86vh] object-contain border-3 border-highlight shadow-brutal-lg bg-white">
        <button type="button" onclick="closePoster()" aria-label="Tutup"
                class="absolute -top-4 -right-4 bg-crimson border-3 border-black shadow-brutal-sm w-10 h-10 flex items-center justify-center hover:bg-accent transition-colors cursor-pointer">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    <div class="flex items-center gap-2 sm:gap-3 flex-wrap justify-center" onclick="event.stopPropagation()">
        <a href="{{ $poster }}" target="_blank" rel="noopener"
           class="bg-cyan text-black border-3 border-black shadow-brutal-sm px-3 py-2 font-black uppercase text-xs sm:text-sm flex items-center gap-2">
            <x-heroicon-o-magnifying-glass-plus class="w-4 h-4" /> Buka ukuran asli
        </a>
        <a href="{{ $poster }}" download="IGX-2026-Official-Rundown.webp"
           class="bg-highlight text-black border-3 border-black shadow-brutal-sm px-3 py-2 font-black uppercase text-xs sm:text-sm flex items-center gap-2">
            <x-heroicon-o-arrow-down-tray class="w-4 h-4" /> Download
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    // ----- Day tabs (below lg) -----
    const tabs = document.querySelectorAll('[data-day-tab]');
    const panels = document.querySelectorAll('.day-panel');

    function selectDay(key) {
        tabs.forEach(t => t.setAttribute('aria-selected', String(t.dataset.dayTab === key)));
        panels.forEach(p => p.classList.toggle('is-active', p.id === key));
    }
    tabs.forEach(t => t.addEventListener('click', () => {
        selectDay(t.dataset.dayTab);
        history.replaceState(null, '', '#' + t.dataset.dayTab);
    }));

    // ----- Live / past state, in Jakarta time -----
    function nowInJakarta() {
        const parts = Object.fromEntries(new Intl.DateTimeFormat('en-CA', {
            timeZone: 'Asia/Jakarta', year: 'numeric', month: '2-digit', day: '2-digit',
            hour: '2-digit', minute: '2-digit', hourCycle: 'h23'
        }).formatToParts(new Date()).map(p => [p.type, p.value]));
        return { date: `${parts.year}-${parts.month}-${parts.day}`, minutes: (+parts.hour) * 60 + (+parts.minute) };
    }
    const toMinutes = t => (+t.slice(0, 2)) * 60 + (+t.slice(3, 5));

    function updateLive() {
        const now = nowInJakarta();
        let live = null;
        panels.forEach(panel => {
            const date = panel.dataset.date;
            panel.querySelectorAll('[data-start]').forEach(row => {
                const start = toMinutes(row.dataset.start), end = toMinutes(row.dataset.end);
                const past = date < now.date || (date === now.date && now.minutes >= end);
                const isLive = date === now.date && now.minutes >= start && now.minutes < end;
                row.classList.toggle('is-past', past);
                row.classList.toggle('is-live', isLive);
                const badge = row.querySelector('.live-badge');
                if (badge) { badge.classList.toggle('hidden', !isLive); badge.classList.toggle('inline-flex', isLive); }
                if (isLive) live = row;
            });
        });
        const strip = document.getElementById('nowPlaying');
        strip.hidden = !live;
        if (live) document.getElementById('nowPlayingTitle').textContent = live.dataset.title;
        return now;
    }

    // Open on the requested day (#day-2), otherwise on today's day during the event.
    const now = updateLive();
    const fromHash = location.hash.slice(1);
    const today = [...panels].find(p => p.dataset.date === now.date);
    selectDay(document.getElementById(fromHash)?.classList.contains('day-panel') ? fromHash : (today ? today.id : panels[0].id));
    setInterval(updateLive, 30000);
})();

// ----- Poster lightbox -----
function openPoster() {
    const modal = document.getElementById('posterModal');
    document.getElementById('posterImage').src = @json($poster);
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}
function closePoster() {
    const modal = document.getElementById('posterModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closePoster(); });
</script>
@endpush
