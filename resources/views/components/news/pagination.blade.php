@if ($paginator->lastPage() > 1)
    <div class="flex justify-center mt-12 space-x-2 mb-24">
        {{-- Tombol Sebelumnya --}}
        @if ($paginator->onFirstPage())
            <button class="px-4 py-1 border border-gray-300 rounded text-gray-400 cursor-not-allowed">&laquo;</button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-1 border border-background-footer rounded hover:bg-gray-200 text-background-footer cursor-pointer text-lg">&laquo;</a>
        @endif

        {{-- Nomor Halaman --}}
        @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            @if ($page == $paginator->currentPage())
                <button class="px-4 py-1 border border-background-footer rounded bg-background-footer text-white font-bold">{{ $page }}</button>
            @else
                <a href="{{ $url }}" class="px-4 py-1 border border-background-footer rounded hover:bg-gray-200 text-background-footer cursor-pointer text-lg">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Tombol Berikutnya --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-1 border border-background-footer rounded hover:bg-gray-200 text-background-footer cursor-pointer text-lg">&raquo;</a>
        @else
            <button class="px-4 py-1 border border-gray-300 rounded text-gray-400 cursor-not-allowed">&raquo;</button>
        @endif
    </div>
@endif
