@extends('layouts.main', ['title' => 'Home'])
@section('content')
<div class="bg-bg">
    @include('components.home.banner')
    @include('components.home.play')

    {{-- ===== MISSION BOARD GRID ===== --}}
    <div class="bg-bg border-t-4 border-black relative overflow-hidden">
        {{-- Halftone bg --}}
        <div class="absolute inset-0 z-0 pointer-events-none opacity-[0.06]"
             style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 18px 18px;">
        </div>

        <div class="container mx-auto px-5 xl:px-12 py-20 xl:py-28 relative z-10">
            {{-- Header --}}
            <div class="flex items-center gap-4 mb-12 lg:mb-16">
                <div class="bg-black border-2 border-highlight px-4 py-2 shadow-brutal-sm rotate-[-1deg]">
                    <h2 class="text-lg sm:text-xl lg:text-2xl font-extrabold uppercase text-highlight tracking-wider flex items-center gap-2">
                        <x-heroicon-o-squares-2x2 class="w-5 h-5 sm:w-6 sm:h-6" />
                        MISSION BOARD
                    </h2>
                </div>
                <div class="h-0.5 flex-1 bg-white/10"></div>
                <span class="text-[10px] font-extrabold text-surface/30 uppercase tracking-[0.3em] hidden sm:block">SELECT STAGE</span>
            </div>

            {{-- Grid: 3 cols desktop, 1 col mobile --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6">

                {{-- CARD 1: COUNTDOWN (BOSS TIMER) --}}
                <div class="card-brutal bg-surface group hover:shadow-brutal-lg hover:-translate-y-1 transition-all duration-200 overflow-hidden flex flex-col">
                    <div class="bg-crimson border-b-3 border-black px-4 py-2.5 flex items-center justify-between">
                        <span class="text-xs font-extrabold uppercase text-white tracking-wider flex items-center gap-2">
                            <x-heroicon-o-clock class="w-4 h-4" /> MISSION 02
                        </span>
                        <span class="text-[9px] font-bold text-white/60 uppercase">URGENT</span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg sm:text-xl font-extrabold uppercase text-black mb-3">Boss Encounter</h3>
                            <div class="flex gap-2 sm:gap-3 text-center mb-4">
                                <div class="flex-1 bg-black border-2 border-black px-2 py-2">
                                    <span class="text-xl sm:text-2xl font-extrabold text-highlight block countdown days" data-countdown="2026-10-24T00:00:00Z">--</span>
                                    <span class="text-[9px] font-bold text-white/40 uppercase">Days</span>
                                </div>
                                <div class="flex-1 bg-black border-2 border-black px-2 py-2">
                                    <span class="text-xl sm:text-2xl font-extrabold text-highlight block countdown hours" data-countdown="2026-10-24T00:00:00Z">--</span>
                                    <span class="text-[9px] font-bold text-white/40 uppercase">Hrs</span>
                                </div>
                                <div class="flex-1 bg-black border-2 border-black px-2 py-2">
                                    <span class="text-xl sm:text-2xl font-extrabold text-highlight block countdown minutes" data-countdown="2026-10-24T00:00:00Z">--</span>
                                    <span class="text-[9px] font-bold text-white/40 uppercase">Min</span>
                                </div>
                            </div>
                            <p class="text-xs font-bold text-black/60 uppercase leading-relaxed">24-25 October 2026<br>ICE BSD — HALL 09-10</p>
                        </div>
                        <a href="#map" class="mt-4 inline-flex items-center gap-1.5 text-xs font-extrabold uppercase text-secondary-lighter hover:text-accent transition-colors group/link">
                            VIEW LOCATION
                            <svg class="w-3 h-3 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                    </div>
                </div>

                {{-- CARD 2: G.I.X SQUAD (Pals) --}}
                <div class="card-brutal bg-surface group hover:shadow-brutal-lg hover:-translate-y-1 transition-all duration-200 overflow-hidden flex flex-col">
                    <div class="bg-accent border-b-3 border-black px-4 py-2.5 flex items-center justify-between">
                        <span class="text-xs font-extrabold uppercase text-black tracking-wider flex items-center gap-2">
                            <x-heroicon-o-user-group class="w-4 h-4" /> MISSION 03
                        </span>
                        <span class="text-[9px] font-bold text-black/60 uppercase">SQUAD</span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg sm:text-xl font-extrabold uppercase text-black mb-3">G.I.X Squad</h3>
                            <p class="text-xs font-bold text-black/60 uppercase leading-relaxed mb-3">Choose your fighter from 5 unique characters — each with their own stats & backstory.</p>
                            {{-- Mini character preview --}}
                            <div class="flex gap-1">
                                @foreach(['N','D','C','O','P'] as $init)
                                    <div class="w-8 h-8 border-2 border-black bg-surface-dark flex items-center justify-center {{ $loop->first ? 'bg-highlight' : '' }}">
                                        <span class="text-[10px] font-extrabold text-black">{{ $init }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <a href="{{ route('pals') }}" class="mt-4 inline-flex items-center gap-1.5 text-xs font-extrabold uppercase text-accent hover:text-highlight transition-colors group/link">
                            CHOOSE FIGHTER
                            <svg class="w-3 h-3 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                    </div>
                </div>

                {{-- CARD 3: GALLERY --}}
                <div class="card-brutal bg-surface group hover:shadow-brutal-lg hover:-translate-y-1 transition-all duration-200 overflow-hidden flex flex-col">
                    <div class="bg-primary border-b-3 border-black px-4 py-2.5 flex items-center justify-between">
                        <span class="text-xs font-extrabold uppercase text-black tracking-wider flex items-center gap-2">
                            <x-heroicon-o-photo class="w-4 h-4" /> MISSION 04
                        </span>
                        <span class="text-[9px] font-bold text-black/60 uppercase">ARCHIVE</span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg sm:text-xl font-extrabold uppercase text-black mb-3">Stage 02 Gallery</h3>
                            <div class="grid grid-cols-3 gap-1.5 mb-3">
                                @foreach(range(1,3) as $i)
                                    <div class="aspect-square border-2 border-black overflow-hidden bg-surface-dark">
                                        <img src="{{ asset('media/images/gallery/' . $i . '.png') }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                             alt="Gallery {{ $i }}">
                                    </div>
                                @endforeach
                            </div>
                            <p class="text-[10px] font-bold text-black/40 uppercase">+ more from IGX Stage 02: Fusion!</p>
                        </div>
                        <a href="{{ route('gallery') }}" class="mt-4 inline-flex items-center gap-1.5 text-xs font-extrabold uppercase text-primary-dark hover:text-accent transition-colors group/link">
                            VIEW GALLERY
                            <svg class="w-3 h-3 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                    </div>
                </div>

                {{-- CARD 4: GUESTS --}}
                <a href="{{ route('guests') }}"
                   class="card-brutal bg-secondary group hover:shadow-brutal-lg hover:-translate-y-1 transition-all duration-200 overflow-hidden flex flex-col no-underline">
                    <div class="bg-highlight border-b-3 border-black px-4 py-2.5 flex items-center justify-between">
                        <span class="text-xs font-extrabold uppercase text-black tracking-wider flex items-center gap-2">
                            <x-heroicon-o-star class="w-4 h-4" /> MISSION 05
                        </span>
                        <span class="text-[9px] font-bold text-black/60 uppercase">SPECIAL</span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg sm:text-xl font-extrabold uppercase text-surface mb-3">Special Guests</h3>
                            <p class="text-xs font-bold text-surface/60 uppercase leading-relaxed">Meet our lineup of gaming legends, cosplayers, and industry icons.</p>
                        </div>
                        <span class="mt-4 inline-flex items-center gap-1.5 text-xs font-extrabold uppercase text-highlight group-hover/link:text-accent transition-colors">
                            MEET THEM
                            <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </span>
                    </div>
                </a>

                {{-- CARD 5: RUNDOWN --}}
                <a href="{{ route('rundown') }}"
                   class="card-brutal bg-secondary group hover:shadow-brutal-lg hover:-translate-y-1 transition-all duration-200 overflow-hidden flex flex-col no-underline">
                    <div class="bg-cyan border-b-3 border-black px-4 py-2.5 flex items-center justify-between">
                        <span class="text-xs font-extrabold uppercase text-black tracking-wider flex items-center gap-2">
                            <x-heroicon-o-calendar-days class="w-4 h-4" /> MISSION 06
                        </span>
                        <span class="text-[9px] font-bold text-black/60 uppercase">SCHEDULE</span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg sm:text-xl font-extrabold uppercase text-surface mb-3">Event Rundown</h3>
                            <p class="text-xs font-bold text-surface/60 uppercase leading-relaxed">Full schedule of tournaments, panels, performances, and activities.</p>
                        </div>
                        <span class="mt-4 inline-flex items-center gap-1.5 text-xs font-extrabold uppercase text-cyan group-hover/link:text-highlight transition-colors">
                            VIEW SCHEDULE
                            <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </span>
                    </div>
                </a>

                {{-- CARD 6: SPONSORS --}}
                <div class="card-brutal bg-surface group hover:shadow-brutal-lg hover:-translate-y-1 transition-all duration-200 overflow-hidden flex flex-col">
                    <div class="bg-crimson border-b-3 border-black px-4 py-2.5 flex items-center justify-between">
                        <span class="text-xs font-extrabold uppercase text-white tracking-wider flex items-center gap-2">
                            <x-heroicon-o-bolt class="w-4 h-4" /> POWER-UPS
                        </span>
                        <span class="text-[9px] font-bold text-white/60 uppercase">SPONSORS</span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg sm:text-xl font-extrabold uppercase text-black mb-3">Powered By</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach(['Langgeng', 'AKG', 'Dewa Utd', 'BOTT', 'Blibli'] as $s)
                                    <span class="text-[10px] font-extrabold uppercase text-black/50 border-2 border-black/20 px-2 py-1">{{ $s }}</span>
                                @endforeach
                            </div>
                        </div>
                        <span class="mt-4 inline-flex items-center gap-1.5 text-xs font-extrabold uppercase text-crimson/60">5 SPONSORS ACTIVE</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@vite('resources/js/countdown.js')
@endpush
