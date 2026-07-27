@php
    $sponsors = [
        [
            'name' => 'Langgeng Pariwara',
            'logo' => 'langgeng.webp',
        ],
        [
            'name' => 'AKG Entertainment',
            'logo' => 'akg.webp',
        ],
        [
            'name' => 'Dewa United',
            'logo' => 'dewa.webp',
        ],
        [
            'name' => 'Battle Of The Toys',
            'logo' => 'bott.webp',
        ],
        [
            'name' => 'Blibli',
            'logo' => 'blibli.webp',
        ],
    ];
@endphp

{{-- Sponsor Section — Neo-Brutalism --}}
<div class="bg-bg border-t-4 border-black">
  <div class="text-center container pt-20 pb-28 xl:pt-28 xl:pb-36 px-5 mx-auto flex flex-col items-center justify-center">
    <div class="bg-highlight border-3 border-black shadow-brutal px-8 py-4 mb-14 lg:mb-20 rotate-[0.5deg]">
        <h1 class="font-extrabold text-3xl sm:text-4xl lg:text-5xl text-center text-black uppercase">Sponsored By:</h1>
    </div>

    <div class="flex gap-6 md:gap-8 lg:gap-10 2xl:gap-14 flex-wrap justify-center">
        @foreach($sponsors as $sponsor)
          <div class="bg-surface border-3 border-black shadow-brutal-sm p-4 sm:p-5 transition-all duration-200 hover:shadow-brutal hover:-translate-y-1">
              <img src="{{ asset('media/images/logos/' . $sponsor['logo']) }}"
                   alt="{{ $sponsor['name'] }}"
                   class="size-24 md:size-28 lg:size-36 object-contain"
                   title="{{ $sponsor['name'] }}">
          </div>
        @endforeach
    </div>
  </div>
</div>
