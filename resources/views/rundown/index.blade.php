@extends('layouts.main', ['title' => 'Rundown'])

@push('style')
<style>
body { background-color: #322366 !important; }
#imageModal { z-index: 99999 !important; }
</style>
@endpush

@section('content')
<div class="bg-secondary min-h-screen relative overflow-hidden">
    <div class="absolute inset-0 z-0 pointer-events-none opacity-[0.05]"
         style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 18px 18px;">
    </div>

    <div class="container mx-auto px-5 xl:px-12 pt-28 pb-20 relative z-10">
        {{-- Header --}}
        <div class="flex flex-col items-center mb-10 lg:mb-14">
            <div class="bg-cyan border-3 border-black shadow-brutal px-6 py-3 sm:px-10 sm:py-4 rotate-[-1deg] mb-3">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold uppercase text-black flex items-center gap-2">
                    <x-heroicon-o-calendar-days class="w-6 h-6 sm:w-8 sm:h-8" />
                    Event Rundown
                </h1>
            </div>
            <p class="text-sm font-bold text-surface/60 uppercase">Click any image to expand</p>
        </div>

        @php
            $rundownImages = [
                'rundown0.jpg', 'rundown1.jpg', 'rundown2.jpg',
                'rundown3.jpg', 'rundown.jpg', 'rundown4.jpg',
                'rundown5.jpg', 'rundown6.jpg', 'rundown7.jpg',
            ];
        @endphp

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6">
            @foreach($rundownImages as $index => $image)
                <button onclick="showImage('{{ asset('media/images/rundown/' . $image) }}')"
                        class="card-brutal bg-surface-dark overflow-hidden group cursor-pointer transition-all duration-200 hover:shadow-brutal-lg hover:-translate-y-1 text-left">
                    {{-- Image frame --}}
                    <div class="relative aspect-3/4 overflow-hidden border-b-3 border-black">
                        <img src="{{ asset('media/images/rundown/' . $image) }}"
                             alt="Rundown {{ $index + 1 }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                        {{-- Hover overlay --}}
                        <div class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="bg-highlight border-3 border-black px-5 py-3 shadow-brutal rotate-[-1deg]">
                                <span class="text-sm font-extrabold uppercase text-black flex items-center gap-2">
                                    <x-heroicon-o-magnifying-glass-plus class="w-5 h-5" />
                                    VIEW
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Label --}}
                    <div class="px-4 py-3 flex items-center justify-between">
                        <span class="text-xs font-extrabold uppercase text-black/50">Day {{ $index + 1 }}</span>
                        <span class="text-[10px] font-bold uppercase text-black/30">Click to expand</span>
                    </div>
                </button>
            @endforeach
        </div>
    </div>
</div>

{{-- Lightbox Modal --}}
<div id="imageModal" class="fixed inset-0 bg-black/90 hidden items-center justify-center p-4" onclick="hideImage()" style="z-index: 99999;">
    <div class="relative inline-block">
        <img id="modalImage" src="" alt="" class="max-w-[95vw] max-h-[95vh] object-contain border-3 border-highlight shadow-brutal-lg" onclick="event.stopPropagation()">
        <button onclick="hideImage()"
                class="absolute -top-4 -right-4 bg-crimson border-3 border-black shadow-brutal-sm w-10 h-10 flex items-center justify-center hover:bg-accent transition-colors">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script>
const showImage = (src) => {
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').classList.remove('hidden');
    document.getElementById('imageModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}
const hideImage = () => {
    document.getElementById('imageModal').classList.add('hidden');
    document.getElementById('imageModal').classList.remove('flex');
    document.body.style.overflow = 'auto';
}
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') hideImage();
});
</script>
@endpush
