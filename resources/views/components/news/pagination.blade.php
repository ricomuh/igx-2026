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

        @php
            $current = $paginator->currentPage();
            $last = $paginator->lastPage();
            $isMobile = request()->header('sec-ch-ua-mobile') === '?1' || (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/Mobile|Android|iP(hone|od|ad)/i', $_SERVER['HTTP_USER_AGENT']));
            $range = $isMobile ? 0 : 1; // 3 items on mobile (first, current, last), 5 on desktop (first, current±1, last)
            $showPages = [];
            $showPages[] = 1;
            if ($current - $range > 2) $showPages[] = $current - $range;
            if ($current != 1 && $current != $last) $showPages[] = $current;
            if ($current + $range < $last) $showPages[] = $current + $range;
            if ($last > 1) $showPages[] = $last;
            $showPages = array_filter($showPages, function($v) use ($last) { return $v >= 1 && $v <= $last; });
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