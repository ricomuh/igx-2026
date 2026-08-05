@extends('layouts.ticket', ['title' => 'Tiket'])

@section('content')
{{-- ===== COUNTDOWN ===== --}}
<section class="relative overflow-hidden">
    <div class="container mx-auto px-5 xl:px-12 py-14 sm:py-20 text-center relative z-10">
        <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold uppercase text-white mb-8 tracking-wide">
            The Event Starts In
        </h1>
        <div class="flex flex-wrap gap-3 sm:gap-5 items-center justify-center text-center">
            @foreach ([
                'days' => 'Days',
                'hours' => 'Hours',
                'minutes' => 'Minutes',
                'seconds' => 'Seconds',
            ] as $unit => $label)
                <div class="bg-accent rounded-2xl border-2 border-black/30 px-5 sm:px-8 py-4 sm:py-6 min-w-[85px] sm:min-w-[115px] shadow-[0_6px_0_rgba(0,0,0,0.3)]">
                    <span class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white countdown {{ $unit }} block" data-countdown="2026-10-24T00:00:00Z">--</span>
                    <span class="text-[10px] sm:text-xs font-extrabold uppercase text-white/85 block mt-1 tracking-widest">{{ $label }}</span>
                </div>
                @if (! $loop->last)
                    <span class="text-3xl sm:text-5xl font-extrabold text-accent">:</span>
                @endif
            @endforeach
        </div>
    </div>
</section>

{{-- ===== ANNOUNCEMENT ===== --}}
<section class="relative">
    <div class="container mx-auto px-5 xl:px-12 pb-2 text-center">
        <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold uppercase text-white">Ticket Will be Available Soon!</h2>
        <p class="text-sm sm:text-base font-bold text-white/60 mt-3">Various options are not available right now.</p>
    </div>
</section>

{{-- ===== TICKET TYPES ===== --}}
<section class="relative pb-20 sm:pb-28">
    <div class="container mx-auto px-5 xl:px-12 pt-10">
        @if ($ticketTypes->isEmpty())
            <div class="max-w-xl mx-auto rounded-2xl border-2 border-white/10 bg-info-dark p-10 text-center">
                <p class="font-extrabold uppercase text-white text-lg">Tiket belum dibuka</p>
                <p class="text-sm font-bold text-white/50 mt-2">Pantau terus website ini ya!</p>
            </div>
        @else
            <div class="grid sm:grid-cols-2 gap-6 lg:gap-8 max-w-3xl mx-auto">
                @foreach ($ticketTypes as $type)
                    <div class="bg-info-dark rounded-2xl border-2 border-white/10 p-6 sm:p-8 text-center flex flex-col shadow-[0_10px_30px_rgba(0,0,0,0.35)]">
                        <h3 class="text-xl sm:text-2xl font-extrabold uppercase text-accent mb-1">{{ $type->name }}</h3>
                        <p class="text-3xl sm:text-4xl font-extrabold text-white mt-2 mb-3">IDR {{ number_format($type->price, 0, ',', '.') }}</p>
                        @if ($type->description)
                            <p class="text-xs sm:text-sm font-bold text-white/55 mb-6 leading-relaxed">{{ $type->description }}</p>
                        @endif
                        <div class="mt-auto">
                            @if ($type->isSoldOut())
                                <div class="inline-block rounded-full bg-black/40 text-white/50 font-extrabold uppercase text-sm px-8 py-3">Sold Out</div>
                            @else
                                <a href="{{ route('ticket.checkout', ['type' => $type->slug]) }}"
                                   class="inline-block w-full bg-gradient-to-r from-accent to-[#C9338F] text-white font-extrabold uppercase text-sm tracking-wider rounded-full px-8 py-3.5 transition-all duration-150 hover:brightness-110 hover:-translate-y-0.5">
                                    Buy Ticket
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
