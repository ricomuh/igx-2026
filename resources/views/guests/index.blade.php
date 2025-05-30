@extends('layouts.main', [
    'title' => 'Guest',
])

@push('style')
<style>
  body {
    background-color: var(--color-primary) !important;
  }
  .pagination p.text-gray-700 {
    color: white !important;
  }
</style>
@endpush

@section('content')
<div class="container mx-auto px-5 xl:px-12 pt-28">
  @if ($guests->total() === 0 && !request('search'))
    <p class="text-white text-shadow-lg text-3xl md:text-4xl lg:text-5xl xl:text-6xl text-center mt-10 w-full md:w-4/5 xl:w-4/5 mx-auto text-wrap">
      Guest Announcements Are Coming Soon!
    </p>
  @else
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:justify-between gap-4 md:gap-8 md:items-center mb-8 md:mb-10 xl:mb-12">
      <h1 class="text-3xl md:text-4xl xl:text-5xl text-white font-extrabold text-shadow-lg">Guests</h1>

      <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 w-full md:w-auto">
        {{-- Search --}}
        <x-shared.search
          :route="route('guests')"
          placeholder="Search..."
          name="search"
          :value="request('search')"
        />
        
        {{-- Sorting --}}
        <x-shared.sort
          :route="route('guests')"
          :options="[
            'latest' => 'Newest First',
            'oldest' => 'Oldest First',
            'name_asc' => 'Name (A-Z)',
            'name_desc' => 'Name (Z-A)'
          ]"
          selected="{{ request('sort_by') }}"
          :additional="['search' => request('search')]"
        />
      </div>
    </div>

    {{-- Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 lg:gap-8 xl:gap-12 group">
      @forelse ($guests as $guest)
        <x-card.tile :data="$guest" />
      @empty
        <p class="text-white text-lg col-span-full">No guests found.</p>
      @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-10 pagination">
      {{ $guests->links() }}
    </div>
  @endif
</div>
@endsection
