@unless(request()->routeIs('map'))
<div id="mapWidgetContainer" class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-40 font-moon" style="display: none;">
    {{-- Expanded Mini Map Preview Card --}}
    <div id="mapWidgetExpanded" class="bg-surface border-3 border-black shadow-brutal w-48 sm:w-56 transition-transform duration-200 hover:-translate-x-1 hover:-translate-y-1">
        {{-- Header bar --}}
        <div class="bg-highlight border-b-3 border-black px-3 py-1.5 flex items-center justify-between">
            <div class="flex items-center gap-1.5">
                <span class="text-sm">🗺️</span>
                <span class="text-[11px] font-extrabold uppercase text-black tracking-wider">Event Map</span>
            </div>
            <button onclick="minimizeMapWidget()"
                    class="w-5 h-5 bg-black text-white hover:bg-accent flex items-center justify-center text-xs font-black transition-colors cursor-pointer"
                    title="Minimize Map"
                    aria-label="Minimize Map">
                &times;
            </button>
        </div>

        {{-- Preview Image linking to Full Map --}}
        <a href="{{ route('map') }}" class="block relative group overflow-hidden bg-black/10">
            <img src="{{ asset('media/images/map/map-thumb.webp') }}"
                 alt="IGX 2026 Event Floor Plan"
                 class="w-full h-auto block object-cover group-hover:scale-105 transition-transform duration-300"
                 loading="lazy">

            {{-- Hover overlay --}}
            <div class="absolute inset-0 bg-secondary/70 opacity-0 group-hover:opacity-100 flex flex-col items-center justify-center gap-1 transition-opacity duration-200 p-2 text-center">
                <span class="bg-primary text-black font-extrabold text-[10px] sm:text-xs uppercase px-2.5 py-1 border-2 border-black shadow-brutal-sm">
                    Buka Map &rarr;
                </span>
                <span class="text-[9px] text-white/80 font-bold">Interactive Zoom & Pan</span>
            </div>
        </a>

        {{-- Quick CTA bar --}}
        <a href="{{ route('map') }}"
           class="block bg-primary hover:bg-highlight border-t-3 border-black py-1.5 px-3 text-center transition-colors">
            <span class="text-[10px] sm:text-[11px] font-extrabold uppercase text-black flex items-center justify-center gap-1">
                <span>Lihat Floor Plan</span>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </span>
        </a>
    </div>

    {{-- Minimized Pill Button --}}
    <div id="mapWidgetMinimized" style="display: none;">
        <button onclick="expandMapWidget()"
                class="bg-highlight hover:bg-primary border-3 border-black shadow-brutal-sm hover:shadow-brutal px-3 py-2 flex items-center gap-2 cursor-pointer transition-all duration-150 group hover:-translate-x-0.5 hover:-translate-y-0.5"
                title="Buka Map IGX 2026">
            <span class="text-base group-hover:scale-110 transition-transform">🗺️</span>
            <span class="text-xs font-extrabold uppercase text-black tracking-wide">Floor Plan</span>
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('mapWidgetContainer');
    const expanded = document.getElementById('mapWidgetExpanded');
    const minimized = document.getElementById('mapWidgetMinimized');

    if (!container) return;

    const isMinimized = sessionStorage.getItem('igx_map_widget_minimized') === 'true';

    if (isMinimized) {
        expanded.style.display = 'none';
        minimized.style.display = 'block';
    } else {
        expanded.style.display = 'block';
        minimized.style.display = 'none';
    }

    container.style.display = 'block';
});

function minimizeMapWidget() {
    const expanded = document.getElementById('mapWidgetExpanded');
    const minimized = document.getElementById('mapWidgetMinimized');
    if (expanded && minimized) {
        expanded.style.display = 'none';
        minimized.style.display = 'block';
        sessionStorage.setItem('igx_map_widget_minimized', 'true');
    }
}

function expandMapWidget() {
    const expanded = document.getElementById('mapWidgetExpanded');
    const minimized = document.getElementById('mapWidgetMinimized');
    if (expanded && minimized) {
        minimized.style.display = 'none';
        expanded.style.display = 'block';
        sessionStorage.setItem('igx_map_widget_minimized', 'false');
    }
}
</script>
@endunless
