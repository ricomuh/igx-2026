@extends('layouts.main', ['title' => 'Exhibitors'])

@push('style')
<style>
  body { background-color: #322366 !important; }
</style>
@endpush

@section('content')
<div class="bg-secondary min-h-screen relative overflow-hidden">
    <div class="absolute inset-0 z-0 pointer-events-none opacity-[0.05]"
         style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 18px 18px;">
    </div>

    <div class="container mx-auto px-5 xl:px-12 pt-28 pb-20 relative z-10">
        @if ($exhibitors->count() === 0 && !request('search'))
            <div class="card-brutal bg-surface max-w-lg mx-auto p-12 text-center mt-10">
                <x-heroicon-o-building-office-2 class="w-16 h-16 text-highlight mx-auto mb-4" />
                <h2 class="text-xl sm:text-2xl font-extrabold uppercase text-black mb-2">Coming Soon!</h2>
                <p class="text-sm font-bold text-black/60">Exhibitor announcements are on the way. Stay tuned!</p>
            </div>
        @else
            {{-- Header --}}
            <div class="flex flex-col lg:flex-row lg:justify-between gap-5 lg:gap-8 lg:items-end mb-8 lg:mb-12">
                <div>
                    <div class="bg-primary border-3 border-black shadow-brutal px-6 py-3 inline-block rotate-[-1deg] mb-3">
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold uppercase text-black flex items-center gap-2">
                            <x-heroicon-o-building-storefront class="w-6 h-6 sm:w-8 sm:h-8" />
                            Exhibitors
                        </h1>
                    </div>
                    <p class="text-sm font-bold text-surface/60 uppercase ml-1">Discover the showcase</p>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center gap-2 w-full lg:w-auto">
                    <x-shared.search :route="route('exhibitors')" placeholder="Search exhibitors..." name="search" :value="request('search')" />
                    <x-shared.sort :route="route('exhibitors')" :options="['latest' => 'Newest First','oldest' => 'Oldest First','name_asc' => 'Name (A-Z)','name_desc' => 'Name (Z-A)']" selected="{{ request('sort_by') }}" :additional="['search' => request('search')]" />
                </div>
            </div>

            {{-- Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 lg:gap-6">
                @forelse ($exhibitors as $exhibitor)
                    <x-card.tile :data="$exhibitor" />
                @empty
                    <div class="col-span-full card-brutal bg-surface p-8 text-center">
                        <p class="text-lg font-extrabold uppercase text-black/40">No exhibitors found.</p>
                    </div>
                @endforelse
            </div>
        @endif
    </div>
</div>
@endsection
