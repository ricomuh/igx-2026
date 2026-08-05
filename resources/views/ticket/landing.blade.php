@extends('layouts.ticket', ['title' => 'Tiket'])

@section('content')
{{-- ===== FULL-HEIGHT HERO — logo + countdown + tickets in one viewport ===== --}}
<section class="relative flex-1 flex flex-col justify-center overflow-hidden">
    {{-- Graphic layer --}}
    <div class="absolute inset-0 z-0 pointer-events-none">
        <img src="{{ asset('media/images/illustrations/hero-bg.webp') }}"
             class="w-full h-full object-cover opacity-40"
             alt="">
        <img src="{{ asset('media/images/illustrations/hero-front.webp') }}"
             class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[85%] max-w-4xl opacity-50 pointer-events-none"
             alt="">
    </div>
    {{-- Scanline overlay --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-[0.04]"
         style="background: repeating-linear-gradient(0deg, transparent, transparent 2px, #000 2px, #000 4px);"></div>

    <div class="container mx-auto px-5 xl:px-12 py-6 sm:py-8 text-center relative z-10">
        {{-- Logo --}}
        <div class="bg-surface border-3 border-black p-1.5 sm:p-2 shadow-brutal inline-block rotate-[-0.5deg] mb-3 sm:mb-4">
            <img src="{{ asset('media/images/logos/logo-stage03-v3.webp') }}" class="h-9 sm:h-12 lg:h-14" alt="IGX Logo">
        </div>

        {{-- Event banner --}}
        <div class="bg-accent border-3 border-black shadow-brutal inline-block px-4 sm:px-6 py-1.5 sm:py-2 rotate-[0.5deg] mb-4 sm:mb-5">
            <span class="font-extrabold uppercase text-black text-xs sm:text-sm lg:text-base tracking-wider">ICE BSD · Hall 9-10 / 24-25 October 2026</span>
        </div>

        {{-- Headline --}}
        <h1 class="text-lg sm:text-2xl lg:text-3xl font-extrabold uppercase text-white mb-3 sm:mb-4">
            The Event Starts In
        </h1>

        {{-- Countdown --}}
        <div class="flex flex-wrap gap-2 sm:gap-4 items-center justify-center text-center mb-4 sm:mb-5">
            @foreach ([
                'days' => 'Days',
                'hours' => 'Hours',
                'minutes' => 'Minutes',
                'seconds' => 'Seconds',
            ] as $unit => $label)
                <div class="bg-surface border-3 border-black shadow-brutal px-3.5 sm:px-6 py-2 sm:py-3.5 min-w-[68px] sm:min-w-[100px]">
                    <span class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-black countdown {{ $unit }} block" data-countdown="2026-10-24T00:00:00Z">--</span>
                    <span class="text-[9px] sm:text-xs font-extrabold uppercase text-accent block mt-0.5 tracking-widest">{{ $label }}</span>
                </div>
                @if (! $loop->last)
                    <span class="text-2xl sm:text-4xl font-extrabold text-accent" style="text-shadow: 2px 2px 0px #000000;">:</span>
                @endif
            @endforeach
        </div>

        {{-- Announcement --}}
        <h2 class="text-base sm:text-2xl lg:text-3xl font-extrabold uppercase text-white mb-1">Ticket Will be Available Soon!</h2>
        <p class="text-[11px] sm:text-sm font-bold text-white/60 mb-4 sm:mb-5">Various options are not available right now.</p>

        {{-- Tickets --}}
        @if ($ticketTypes->isEmpty())
            <div class="card-brutal bg-surface p-8 text-center max-w-xl mx-auto">
                <p class="font-extrabold uppercase text-lg">Tiket belum dibuka</p>
                <p class="text-sm font-bold text-black/50 mt-2">Pantau terus website ini ya!</p>
            </div>
        @else
            <div class="grid sm:grid-cols-2 gap-3 sm:gap-5 max-w-2xl mx-auto">
                @foreach ($ticketTypes as $type)
                    <div class="bg-surface border-3 border-black shadow-brutal p-4 sm:p-5 flex flex-col gap-2 text-left transition-all duration-200 hover:shadow-brutal-lg hover:-translate-y-0.5">
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-sm sm:text-base font-extrabold uppercase text-black">{{ $type->name }}</span>
                            @if ($type->isSoldOut())
                                <span class="bg-crimson text-white text-[9px] font-extrabold uppercase px-2 py-0.5 border-2 border-black shrink-0">Habis</span>
                            @endif
                        </div>
                        <div class="flex items-baseline justify-between gap-2">
                            <span class="text-lg sm:text-2xl font-extrabold text-accent">IDR {{ number_format($type->price, 0, ',', '.') }}</span>
                            @if ($type->capacity)
                                <span class="text-[9px] font-bold uppercase text-black/40">Kuota {{ $type->soldCount() }}/{{ $type->capacity }}</span>
                            @endif
                        </div>
                        @if ($type->description)
                            <p class="text-[11px] sm:text-xs font-bold text-black/50 leading-snug">{{ $type->description }}</p>
                        @endif
                        <div class="mt-auto pt-1">
                            @if ($type->isSoldOut())
                                <div class="bg-black/5 border-3 border-black/30 px-3 py-2 text-center font-extrabold uppercase text-black/30 text-xs">Sold Out</div>
                            @else
                                <div class="flex items-center gap-2" x-data="{ qty: 1 }">
                                    <button @click="qty = Math.max(1, qty - 1)"
                                            class="bg-bg border-3 border-black w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center font-extrabold shadow-brutal-sm hover:bg-black/5 transition-colors shrink-0">-</button>
                                    <span x-text="qty" class="w-7 text-center font-extrabold text-black text-base"></span>
                                    <button @click="qty = Math.min(10, qty + 1)"
                                            class="bg-bg border-3 border-black w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center font-extrabold shadow-brutal-sm hover:bg-black/5 transition-colors shrink-0">+</button>
                                    <button @click="addToCart({{ $type->id }}, '{{ addslashes($type->name) }}', {{ $type->price }}, qty)"
                                            class="flex-1 bg-accent border-3 border-black px-3 py-2 text-[11px] sm:text-xs font-extrabold uppercase text-black shadow-brutal-sm hover:bg-highlight hover:shadow-brutal transition-all">
                                        + Keranjang
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
