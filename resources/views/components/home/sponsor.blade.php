@php
    $sponsors = [
        [
            'name' => 'Ciracle Indonesia',
            'logo' => 'ciracle.webp',
        ],
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
<div class="bg-white">
  <div class="text-center container pt-20 px-5 xl:pt-28 mx-auto flex flex-col items-center justify-center">
    <h1 class="font-extrabold text-3xl sm:text-4xl lg:text-5xl text-center mb-12 lg:mb-20">Sponsored By:</h1>
    <div class="flex gap-8 md:gap-10 lg:gap-12 2xl:gap-16 flex-wrap justify-center">
        @foreach($sponsors as $sponsor)
          <img src="{{ asset('media/images/logos/' . $sponsor['logo']) }}" alt="{{ $sponsor['name'] }}" class="size-30 md:size-32 lg:size-40 object-contain transition-transform duration-300 hover:scale-105" title="{{ $sponsor['name'] }}">
        @endforeach
    </div>
  </div>
</div>
