@if ($paginator->lastPage() > 1)
    <div class="flex justify-center mt-6 lg:mt-12 space-x-2">
        {{-- Tombol Sebelumnya --}}
        @if ($paginator->onFirstPage())
            <button
                class="flex items-center justify-center px-3 md:px-4 py-1 border border-gray-300 rounded text-gray-400 cursor-not-allowed"
                aria-disabled="true"
                aria-label="Previous Page"
            >
                &laquo;
            </button>
        @else
            <a
                href="{{ $paginator->previousPageUrl() }}"
                class="flex items-center justify-center px-3 md:px-4 py-1 border border-background-footer rounded hover:bg-gray-200 text-background-footer cursor-pointer text-sm md:text-lg"
                aria-label="Previous Page"
            >
                &laquo;
            </a>
        @endif

        {{-- Nomor Halaman --}}
        @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            @if ($page == $paginator->currentPage())
                <button
                    class="flex items-center justify-center px-3 md:px-4 py-1 border border-background-footer rounded bg-background-footer text-white font-bold"
                    aria-current="page"
                >
                    {{ $page }}
                </button>
            @else
                <a
                    href="{{ $url }}"
                    class="flex items-center justify-center px-3 md:px-4 py-1 border border-background-footer rounded hover:bg-gray-200 text-background-footer cursor-pointer text-sm md:text-lg"
                    aria-label="Go to page {{ $page }}"
                >
                    {{ $page }}
                </a>
            @endif
        @endforeach

        {{-- Tombol Berikutnya --}}
        @if ($paginator->hasMorePages())
            <a
                href="{{ $paginator->nextPageUrl() }}"
                class="flex items-center justify-center px-3 md:px-4 py-1 border border-background-footer rounded hover:bg-gray-200 text-background-footer cursor-pointer text-sm md:text-lg"
                aria-label="Next Page"
            >
                &raquo;
            </a>
        @else
            <button
                class="flex items-center justify-center px-3 md:px-4 py-1 border border-gray-300 rounded text-gray-400 cursor-not-allowed"
                aria-disabled="true"
                aria-label="Next Page"
            >
                &raquo;
            </button>
        @endif
    </div>
@endif