@props([
  'route' => request()->url(),
  'placeholder' => 'Search',
  'name' => 'search',
  'value' => request('search'),
])

<form method="GET" action="{{ $route }}" class="flex items-center gap-2 w-full sm:w-auto">
  <div class="flex items-center gap-2 bg-white rounded-lg px-4 py-2 text-black ring ring-primary flex-grow h-10">
    <img src="{{ asset('media/images/icons/search.svg') }}" width="16" alt="Search Icon" />
    <input
      type="search"
      name="{{ $name }}"
      placeholder="{{ $placeholder }}"
      value="{{ $value }}"
      class="outline-none w-full text-base leading-6 bg-transparent"
    />
  </div>

  <button type="submit" class="btn-primary py-2 px-6 font-bold rounded-lg h-10 whitespace-nowrap">
    Search
  </button>
</form>
