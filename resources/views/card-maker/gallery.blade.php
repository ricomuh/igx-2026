@extends('layouts.main', [
    'title' => 'Card Gallery',
    'description' => 'IGX 2026 Card Gallery — see who\'s coming to IGX!',
])

@push('style')
<style>
body { background-color: #322366 !important; }
.char-bg-pattern {
    background-image: radial-gradient(circle, #9A94CC 1px, transparent 1px);
    background-size: 20px 20px;
}
</style>
@endpush

@section('content')
<div class="bg-secondary min-h-screen relative overflow-hidden char-bg-pattern">
    {{-- Decorative stripes --}}
    <div class="absolute top-10 -left-20 w-80 h-20 bg-highlight rotate-[-8deg] border-3 border-black opacity-30 z-0"></div>
    <div class="absolute bottom-20 -right-20 w-96 h-16 bg-accent rotate-[6deg] border-3 border-black opacity-30 z-0"></div>

    <div class="container mx-auto px-4 sm:px-5 xl:px-12 pt-20 sm:pt-28 pb-16 relative z-10">

        {{-- Header --}}
        <div class="flex flex-col items-center mb-10">
            <div class="bg-accent border-3 border-black shadow-brutal px-4 py-2 sm:px-10 sm:py-4 rotate-[-1.5deg] mb-2">
                <h1 class="text-lg sm:text-3xl md:text-4xl font-extrabold uppercase text-black text-center leading-none">
                    IGX CARD
                </h1>
            </div>
            <div class="bg-highlight border-3 border-black shadow-brutal px-4 py-2 sm:px-10 sm:py-4 rotate-[1deg]">
                <h1 class="text-xl sm:text-4xl md:text-5xl font-extrabold uppercase text-black text-center leading-none"
                    style="text-shadow: 3px 3px 0px #F253B6;">
                    GALLERY!
                </h1>
            </div>
            <p class="mt-4 text-surface/70 font-bold text-sm uppercase tracking-wider text-center">
                {{ $submissions->total() }} cards submitted
            </p>
        </div>

        {{-- CTA: Make your own --}}
        <div class="flex justify-center mb-10">
            <a href="{{ route('card-maker') }}"
               class="btn-brutal px-6 py-3 text-sm font-extrabold uppercase bg-accent border-3 border-black shadow-brutal hover:shadow-brutal-lg hover:-translate-y-0.5 transition-all">
                ✦ Create Your Own Card
            </a>
        </div>

        {{-- Grid --}}
        @if($submissions->isEmpty())
            <div class="flex flex-col items-center justify-center py-24">
                <div class="bg-surface border-3 border-black shadow-brutal px-8 py-8 text-center max-w-sm">
                    <p class="text-4xl mb-3">🃏</p>
                    <p class="font-extrabold uppercase text-black text-lg">No cards yet!</p>
                    <p class="text-xs font-bold text-black/50 uppercase mt-1">Be the first to submit yours.</p>
                </div>
            </div>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-6 gap-4 sm:gap-5">
                @foreach($submissions as $submission)
                <div class="group flex flex-col">
                    <div class="card-brutal overflow-hidden border-3 border-black shadow-brutal transition-transform group-hover:-translate-y-1">
                        <img
                            src="{{ $submission->card_image_url }}"
                            alt="IGX Card — {{ e($submission->name) }}"
                            loading="lazy"
                            class="w-full h-auto block"
                        >
                    </div>
                    <div class="mt-2 px-1">
                        <p class="text-xs font-extrabold uppercase text-surface truncate">{{ $submission->name }}</p>
                        @if($submission->approved_at)
                        <p class="text-[10px] font-bold text-surface/40 uppercase">{{ $submission->approved_at->format('d M Y') }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($submissions->hasPages())
            <div class="mt-10 flex justify-center">
                {{ $submissions->links() }}
            </div>
            @endif
        @endif

    </div>
</div>
@endsection
