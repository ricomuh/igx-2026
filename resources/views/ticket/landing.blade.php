@extends('layouts.ticket', ['title' => 'Tiket'])

@section('content')
{{-- ===== TICKET HERO — logo + graphic + countdown (neo-brutalism) ===== --}}
<section class="bg-secondary border-b-4 border-black relative overflow-hidden">
    {{-- Graphic layer --}}
    <div class="absolute inset-0 z-0 pointer-events-none">
        <img src="{{ asset('media/images/illustrations/hero-bg.webp') }}"
             class="w-full h-full object-cover opacity-40"
             alt="">
        <img src="{{ asset('media/images/illustrations/hero-front.webp') }}"
             class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[90%] max-w-5xl opacity-60 pointer-events-none"
             alt="">
    </div>
    {{-- Scanline overlay --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-[0.04]"
         style="background: repeating-linear-gradient(0deg, transparent, transparent 2px, #000 2px, #000 4px);"></div>

    <div class="container mx-auto px-5 xl:px-12 py-16 sm:py-20 xl:py-28 text-center relative z-10">
        {{-- Logo --}}
        <div class="bg-surface border-3 border-black p-3 shadow-brutal inline-block rotate-[-0.5deg] mb-8">
            <img src="{{ asset('media/images/logos/logo-stage03-v3.webp') }}" class="h-16 sm:h-20 lg:h-28" alt="IGX Logo">
        </div>

        {{-- Event banner --}}
        <div class="bg-accent border-3 border-black shadow-brutal inline-block px-5 sm:px-8 py-2.5 sm:py-3 rotate-[0.5deg] mb-10">
            <span class="font-extrabold uppercase text-black text-sm sm:text-base lg:text-xl tracking-wider">ICE BSD · Hall 9-10</span>
            <span class="mx-1 sm:mx-2 font-extrabold text-black">/</span>
            <span class="font-extrabold uppercase text-black text-sm sm:text-base lg:text-xl tracking-wider">24-25 October 2026</span>
        </div>

        {{-- Headline --}}
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold uppercase text-white mb-10 drop-shadow-brutal">
            The Event Starts In
        </h1>

        {{-- Countdown --}}
        <div class="flex flex-wrap gap-3 sm:gap-5 items-center justify-center text-center mb-8">
            @foreach ([
                'days' => 'Days',
                'hours' => 'Hours',
                'minutes' => 'Minutes',
                'seconds' => 'Seconds',
            ] as $unit => $label)
                <div class="bg-surface border-3 border-black shadow-brutal px-5 sm:px-8 py-4 sm:py-6 min-w-[90px] sm:min-w-[120px]">
                    <span class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-black countdown {{ $unit }} block" data-countdown="2026-10-24T00:00:00Z">--</span>
                    <span class="text-xs sm:text-sm font-extrabold uppercase text-accent block mt-1 tracking-widest">{{ $label }}</span>
                </div>
                @if (! $loop->last)
                    <span class="text-3xl sm:text-5xl font-extrabold text-accent" style="text-shadow: 3px 3px 0px #000000;">:</span>
                @endif
            @endforeach
        </div>
    </div>
</section>

{{-- ===== TICKET TYPES — add to cart (interactive) ===== --}}
<section class="bg-bg border-b-4 border-black">
    <div class="container mx-auto px-5 xl:px-12 py-20 xl:py-28">
        <div class="flex items-center gap-4 mb-12">
            <div class="bg-highlight border-3 border-black px-4 py-2 shadow-brutal-sm rotate-[-1deg]">
                <h2 class="text-lg sm:text-xl lg:text-2xl font-extrabold uppercase text-black tracking-wider">Pilih Tiket</h2>
            </div>
            <div class="h-0.5 flex-1 bg-black/10"></div>
        </div>

        @if ($ticketTypes->isEmpty())
            <div class="card-brutal bg-surface p-10 text-center">
                <p class="font-extrabold uppercase text-lg">Tiket belum dibuka</p>
                <p class="text-sm font-bold text-black/50 mt-2">Pantau terus website ini ya!</p>
            </div>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach ($ticketTypes as $type)
                    <div class="bg-surface border-3 border-black shadow-brutal overflow-hidden flex flex-col transition-all duration-200 hover:shadow-brutal-lg hover:-translate-y-1">
                        {{-- Pink top trim --}}
                        <div class="bg-accent border-b-3 border-black px-4 py-2 flex items-center justify-between">
                            <span class="text-xs font-extrabold uppercase text-black tracking-wider">{{ $type->name }}</span>
                            @if ($type->isSoldOut())
                                <span class="bg-crimson text-white text-[10px] font-extrabold uppercase px-2 py-0.5 border-2 border-black">Habis</span>
                            @endif
                        </div>
                        <div class="p-6 sm:p-8 flex flex-col flex-1">
                            @if ($type->description)
                                <p class="text-sm font-bold text-black/60 mb-4">{{ $type->description }}</p>
                            @endif
                            <div class="bg-secondary border-3 border-black px-4 py-3 shadow-brutal-sm mb-4">
                                <span class="text-2xl sm:text-3xl font-extrabold text-accent">IDR {{ number_format($type->price, 0, ',', '.') }}</span>
                            </div>
                            @if ($type->capacity)
                                <p class="text-[10px] font-bold uppercase text-black/40 mb-4">
                                    Kuota {{ $type->soldCount() }}/{{ $type->capacity }} terjual
                                </p>
                            @endif
                            <div class="mt-auto">
                                @if ($type->isSoldOut())
                                    <div class="bg-black/5 border-3 border-black/30 px-4 py-3 text-center font-extrabold uppercase text-black/30">Sold Out</div>
                                @else
                                    {{-- Interactive Add-to-Cart with qty stepper --}}
                                    <div class="flex items-center gap-2 mb-3" x-data="{ qty: 1 }">
                                        <button @click="qty = Math.max(1, qty - 1)"
                                                class="bg-surface border-3 border-black w-10 h-10 flex items-center justify-center font-extrabold shadow-brutal-sm hover:bg-black/5 transition-colors">-</button>
                                        <span x-text="qty" class="w-10 text-center font-extrabold text-black text-lg"></span>
                                        <button @click="qty = Math.min(10, qty + 1)"
                                                class="bg-surface border-3 border-black w-10 h-10 flex items-center justify-center font-extrabold shadow-brutal-sm hover:bg-black/5 transition-colors">+</button>
                                        <span class="text-[10px] font-bold uppercase text-black/40 ml-auto">Qty</span>
                                    </div>
                                    <button @click="addToCart({{ $type->id }}, '{{ addslashes($type->name) }}', {{ $type->price }}, qty)"
                                            class="block w-full bg-accent border-3 border-black px-4 py-3 text-center font-extrabold uppercase text-black shadow-brutal-sm hover:bg-highlight hover:shadow-brutal hover:-translate-y-0.5 transition-all">
                                        + Tambah ke Keranjang
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
