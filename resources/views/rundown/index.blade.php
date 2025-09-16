@extends('layouts.main', [
    'title' => 'Rundown',
])

@push('style')
<style>
body {
    background-color: var(--color-primary) !important;
}
#imageModal {
    z-index: 99999 !important;
}
</style>
@endpush

@section('content')
<div class="container mx-auto px-5 xl:px-12 pt-28 pb-20 relative z-10">
    <h1 class="text-2xl lg:text-3xl xl:text-4xl font-extrabold mb-8 md:mb-10 text-white text-center">IGX Rundown</h1>
    
    @php
        $rundownImages = [
            'rundown1.jpg',
            'rundown2.jpg',
            'rundown3.jpg',
            'rundown.jpg',
            'rundown4.jpg',
            'rundown5.jpg',
            'rundown6.jpg',
            'rundown7.jpg',
        ];
    @endphp
    
    <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-4 md:gap-8">
        @foreach($rundownImages as $index => $image)
            <button class="rounded-xl overflow-hidden shadow-xl aspect-3/4 cursor-pointer hover:shadow-2xl transition-shadow" onclick="showImage('{{ asset('media/images/rundown/' . $image) }}')">
                <img src="{{ asset('media/images/rundown/' . $image) }}" alt="Rundown {{ $index + 1 }}" class="rundown-image w-full h-full object-cover hover:scale-105 transition-transform">
            </button>
        @endforeach
    </div>
</div>

<div id="imageModal" class="fixed inset-0 bg-black/80 hidden items-center justify-center p-4" onclick="hideImage()">
    <div class="relative inline-block">
        <img id="modalImage" src="" alt="" class="max-w-[95vw] max-h-[95vh] object-contain rounded-lg shadow-2xl" onclick="event.stopPropagation()">
        <button onclick="hideImage()" class="absolute -top-3 -right-3 text-white text-2xl hover:text-gray-300 bg-black/90 rounded-full w-8 h-8 flex items-center justify-center border border-white/20">&times;</button>
    </div>
</div>

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
@endsection