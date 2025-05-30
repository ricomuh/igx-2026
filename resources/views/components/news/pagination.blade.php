@if ($paginator->lastPage() > 1)
    <div class="flex flex-wrap justify-center mt-6 lg:mt-12 gap-2">
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

        {{-- Nomor Halaman dengan Ellipsis --}}
        @php
            $current = $paginator->currentPage();
            $last = $paginator->lastPage();
            $range = 2;
            $showPages = [];
            $showPages[] = 1;
            for ($i = max(2, $current - $range); $i <= min($last - 1, $current + $range); $i++) {
                $showPages[] = $i;
            }
            if ($last > 1) $showPages[] = $last;
            $showPages = array_unique($showPages);
            sort($showPages);
        @endphp
        @php $prev = 0; @endphp
        @foreach ($showPages as $page)
            @if ($prev && $page - $prev > 1)
                <span class="flex items-center px-2 text-gray-400 select-none">...</span>
            @endif
            @if ($page == $current)
                <button
                    class="flex items-center justify-center px-3 md:px-4 py-1 border border-background-footer rounded bg-background-footer text-white font-bold"
                    aria-current="page"
                >
                    {{ $page }}
                </button>
            @else
                <a
                    href="{{ $paginator->url($page) }}"
                    class="flex items-center justify-center px-3 md:px-4 py-1 border border-background-footer rounded hover:bg-gray-200 text-background-footer cursor-pointer text-sm md:text-lg"
                    aria-label="Go to page {{ $page }}"
                >
                    {{ $page }}
                </a>
            @endif
            @php $prev = $page; @endphp
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