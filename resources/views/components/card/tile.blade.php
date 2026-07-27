@props(['data'])

<div class="card-brutal bg-surface overflow-hidden group/item transition-all duration-200 hover:shadow-brutal-lg hover:-translate-y-1">
    {{-- Image --}}
    <div class="relative aspect-4/5 overflow-hidden border-b-3 border-black bg-secondary">
        @php $img = $data->full_image_url; @endphp
        <img
            src="{{ $img }}"
            alt="{{ $data->name }}"
            loading="lazy"
            class="object-cover w-full h-full transition-transform duration-500 group-hover/item:scale-110"
            onerror="this.onerror=null;this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 300 375%22><rect fill=%22%23322366%22 width=%22300%22 height=%22375%22/><text x=%22150%22 y=%22195%22 text-anchor=%22middle%22 fill=%22%239A94CC%22 font-family=%22sans-serif%22 font-size=%2216%22 font-weight=%22bold%22>NO IMAGE</text></svg>';"
        />

        @if ($data->url)
            <a href="{{ $data->url }}" target="_blank" rel="noopener noreferrer" class="absolute inset-0 z-10">
                <span class="sr-only">Visit {{ $data->name }}</span>
            </a>
        @endif

        {{-- Name badge at bottom --}}
        <div class="absolute bottom-0 left-0 right-0 bg-black/90 border-t-3 border-black px-3 py-2">
            <h3 class="text-sm sm:text-base font-extrabold uppercase text-surface truncate">{{ $data->name }}</h3>
        </div>
    </div>
</div>
