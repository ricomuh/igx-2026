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
                            <p class="text-xs font-bold text-black/60 uppercase leading-relaxed mb-3">Choose your fighter from 7 unique characters — each with their own stats & backstory.</p>
                            {{-- Mini character preview --}}
                            <div class="flex gap-1">
                                @foreach(['N','D','C','O','P','S','X'] as $init)
                                    <div class="w-7 h-7 border-2 border-black bg-surface-dark flex items-center justify-center {{ $loop->first ? 'bg-highlight' : '' }}">
                                        <span class="text-[8px] font-extrabold text-black">{{ $init }}</span>
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
                            <h3 class="text-lg sm:text-xl font-extrabold uppercase text-black mb-3">Gallery</h3>
                            <div class="grid grid-cols-3 gap-1.5 mb-3">
                                @php $homeGalleries = \App\Models\Gallery::where('is_active', true)->orderBy('sort_order')->limit(3)->get(); @endphp
                                @forelse($homeGalleries as $g)
                                    <div class="aspect-square border-2 border-black overflow-hidden bg-surface-dark">
                                        <img src="{{ Storage::disk('public')->url($g->image) }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                             alt="{{ $g->title }}">
                                    </div>
                                @empty
                                    @foreach(range(1,3) as $i)
                                        <div class="aspect-square border-2 border-black overflow-hidden bg-surface-dark flex items-center justify-center">
                                            <x-heroicon-o-photo class="w-6 h-6 text-black/20" />
                                        </div>
                                    @endforeach
                                @endforelse
                            </div>
                            <p class="text-[10px] font-bold text-black/40 uppercase">{{ \App\Models\Gallery::where('is_active', true)->count() }} photos in gallery</p>
                        </div>
                        <a href="{{ route('gallery') }}" class="mt-4 inline-flex items-center gap-1.5 text-xs font-extrabold uppercase text-primary-dark hover:text-accent transition-colors group/link">
                            VIEW GALLERY
                            <svg class="w-3 h-3 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                    </div>
                </div>

                {{-- CARD 5: RUNDOWN — COMING SOON --}}
                <div class="card-brutal bg-secondary group hover:shadow-brutal-lg hover:-translate-y-1 transition-all duration-200 overflow-hidden flex flex-col">
                    <div class="bg-cyan border-b-3 border-black px-4 py-2.5 flex items-center justify-between">
                        <span class="text-xs font-extrabold uppercase text-black tracking-wider flex items-center gap-2">
                            <x-heroicon-o-calendar-days class="w-4 h-4" /> MISSION 06
                        </span>
                        <span class="text-[9px] font-bold text-black/60 uppercase">SCHEDULE</span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between items-center text-center">
                        <div>
                            <h3 class="text-lg sm:text-xl font-extrabold uppercase text-surface mb-2">Event Rundown</h3>
                            <div class="bg-highlight border-3 border-black inline-block px-4 py-2 shadow-brutal-sm rotate-[-1deg] mb-3">
                                <span class="text-xl sm:text-2xl font-extrabold uppercase text-black">Coming Soon</span>
                            </div>
                            <p class="text-[10px] font-bold text-surface/50 uppercase">2026</p>
                        </div>
                        <div class="flex items-center gap-2 mt-3">
                            <div class="w-2 h-2 bg-highlight border-2 border-black animate-pulse"></div>
                            <div class="w-2 h-2 bg-accent border-2 border-black animate-pulse" style="animation-delay: 0.2s"></div>
                            <div class="w-2 h-2 bg-primary border-2 border-black animate-pulse" style="animation-delay: 0.4s"></div>
                        </div>
                    </div>
                </div>

                {{-- CARD 6: SPONSOR — LANGGENG PARIWARA --}}
                <div class="card-brutal bg-surface group hover:shadow-brutal-lg hover:-translate-y-1 transition-all duration-200 overflow-hidden flex flex-col">
                    <div class="bg-crimson border-b-3 border-black px-4 py-2.5 flex items-center justify-between">
                        <span class="text-xs font-extrabold uppercase text-white tracking-wider flex items-center gap-2">
                            <x-heroicon-o-bolt class="w-4 h-4" /> POWER-UPS
                        </span>
                        <span class="text-[9px] font-bold text-white/60 uppercase">SPONSOR</span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between items-center text-center">
                        <div>
                            <h3 class="text-lg sm:text-xl font-extrabold uppercase text-black mb-3">organized by Langgeng Pariwara</h3>
                            <img src="{{ asset('media/images/logos/langgeng.webp') }}"
                                 alt="Langgeng Pariwara"
                                 class="h-16 md:h-20 object-contain mx-auto mb-3">
                            <p class="text-sm font-extrabold uppercase text-black">Langgeng Pariwara</p>
                        </div>
                        <span class="mt-4 inline-flex items-center gap-1.5 text-xs font-extrabold uppercase text-crimson/60">1 SPONSOR ACTIVE</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ===== BOSS LOCATION: Map + How To Get Here ===== --}}
    <div id="map" class="bg-surface border-t-4 border-black relative overflow-hidden">
        <div class="container mx-auto px-5 xl:px-12 py-20 xl:py-28">
            <div class="flex items-center gap-4 mb-12">
                <div class="bg-black border-2 border-cyan px-4 py-2 shadow-brutal-sm rotate-[-1deg]">
                    <h2 class="text-lg sm:text-xl lg:text-2xl font-extrabold uppercase text-cyan tracking-wider flex items-center gap-2">
                        <x-heroicon-o-map-pin class="w-5 h-5 sm:w-6 sm:h-6" />
                        BOSS LOCATION
                    </h2>
                </div>
                <div class="h-0.5 flex-1 bg-black/10"></div>
            </div>

            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-stretch">
                {{-- Google Map --}}
                <div class="card-brutal bg-black overflow-hidden h-64 sm:h-80 lg:h-full min-h-[300px]">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.720459553029!2d106.6338767751508!3d-6.300414861662221!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fb535f152305%3A0x34406ed8b098f478!2sIndonesia%20Convention%20Exhibition%20(ICE)%20BSD%20City!5e0!3m2!1sen!2sid!4v1724163747000!5m2!1sen!2sid"
                        class="w-full h-full border-none"
                        allowFullScreen
                        loading="lazy"
                        referrerPolicy="no-referrer-when-downgrade"
                        title="ICE BSD Map">
                    </iframe>
                </div>

                {{-- Venue Info --}}
                <div class="flex flex-col justify-between gap-6">
                    <div>
                        <div class="bg-accent border-3 border-black px-5 py-3 inline-block shadow-brutal-sm rotate-[-1deg] mb-5">
                            <h3 class="text-xl sm:text-2xl font-extrabold uppercase text-black">ICE BSD</h3>
                        </div>
                        <div class="space-y-4">
                            <div class="flex gap-3 items-start">
                                <div class="bg-cyan border-2 border-black p-2 shrink-0 mt-1">
                                    <x-heroicon-o-map-pin class="w-5 h-5 text-black" />
                                </div>
                                <div>
                                    <p class="text-sm font-extrabold uppercase text-black/40 mb-0.5">Location</p>
                                    <p class="text-base sm:text-lg font-bold text-black leading-relaxed">
                                        Indonesia Convention Exhibition (ICE)<br>
                                        Jl. BSD Grand Boulevard Raya No.1,<br>
                                        BSD City, Tangerang, 15339
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-3 items-start">
                                <div class="bg-primary border-2 border-black p-2 shrink-0 mt-1">
                                    <x-heroicon-o-calendar-days class="w-5 h-5 text-black" />
                                </div>
                                <div>
                                    <p class="text-sm font-extrabold uppercase text-black/40 mb-0.5">Date</p>
                                    <p class="text-base sm:text-lg font-bold text-black">24-25 October 2026</p>
                                </div>
                            </div>
                            <div class="flex gap-3 items-start">
                                <div class="bg-highlight border-2 border-black p-2 shrink-0 mt-1">
                                    <x-heroicon-o-building-office-2 class="w-5 h-5 text-black" />
                                </div>
                                <div>
                                    <p class="text-sm font-extrabold uppercase text-black/40 mb-0.5">Hall</p>
                                    <p class="text-base sm:text-lg font-bold text-black">Hall 09-10</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a target="_blank" rel="noreferrer"
                       href="https://ice-indonesia.com/en/visitice/getting_here"
                       class="btn-brutal w-full sm:w-max text-base sm:text-lg px-8 py-4 text-center inline-flex items-center justify-center gap-2 group">
                        HOW TO GET HERE
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection

@push('scripts')
@vite('resources/js/countdown.js')
@endpush
