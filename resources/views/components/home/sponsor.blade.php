@php
    $sponsors = [
        [
            'name' => 'Langgeng Pariwara',
            'logo' => 'langgeng.webp',
        ],
    ];
@endphp

{{-- Sponsor Section — Neo-Brutalism --}}
<div class="bg-bg border-t-4 border-black">
  <div class="text-center container pt-20 pb-28 xl:pt-28 xl:pb-36 px-5 mx-auto flex flex-col items-center justify-center">
    <div class="bg-highlight border-3 border-black shadow-brutal px-8 py-4 mb-14 lg:mb-20 rotate-[0.5deg]">
        <h1 class="font-extrabold text-3xl sm:text-4xl lg:text-5xl text-center text-black uppercase">Sponsored By:</h1>
        <p class="text-sm font-bold text-black/60 uppercase mt-1">Official Media Partner</p>
    </div>

    <div class="flex gap-6 md:gap-8 lg:gap-10 2xl:gap-14 flex-wrap justify-center">
        @foreach($sponsors as $sponsor)
          <div class="bg-surface border-3 border-black shadow-brutal p-6 sm:p-8 transition-all duration-200 hover:shadow-brutal-lg hover:-translate-y-1">
              <img src="{{ asset('media/images/logos/' . $sponsor['logo']) }}"
                   alt="{{ $sponsor['name'] }}"
                   class="h-28 md:h-36 lg:h-48 w-auto object-contain"
                   title="{{ $sponsor['name'] }}">
          </div>
        @endforeach
    </div>

    <p class="mt-10 text-xs font-bold text-black/40 uppercase tracking-wider">More sponsors to be announced</p>
  </div>
</div>
