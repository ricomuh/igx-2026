@props([
  'route' => request()->url(),
  'placeholder' => 'Search',
  'name' => 'search',
  'value' => request('search'),
])

<form method="GET" action="{{ $route }}" class="flex items-center gap-2 w-full sm:w-auto">
  <div class="flex items-center gap-2 bg-surface border-3 border-black shadow-brutal-sm px-4 py-2 flex-grow h-10">
    <svg class="w-4 h-4 text-black/40 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
        <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
    </svg>
    <input type="search" name="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ $value }}"
           class="outline-none w-full text-sm font-bold bg-transparent text-black placeholder:text-black/30" />
  </div>
  <button type="submit" class="btn-brutal py-2 px-4 text-sm h-10 whitespace-nowrap">Search</button>
</form>
