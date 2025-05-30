@extends('layouts.main', [
    'title' => 'IGX Pals',
])

@push('style')
<style>
  body {
    background-color: var(--color-primary) !important;
  }
  .terms-bg {
    position: fixed;
    inset: 0;
    z-index: 0;
    pointer-events: none;
    background: url('/media/images/illustrations/banner.webp') no-repeat center center;
    background-size: contain;
    opacity: 0.08;
  }
</style>
@endpush

@section('content')
<div class="terms-bg"></div>
<div class="container mx-auto px-5 xl:px-12 pt-28 relative z-10" x-data="characterCarousel()">
  <div class="flex flex-col items-center space-y-6 bg-white/20 backdrop-blur-sm p-6 sm:p-8 md:p-10 lg:p-12 xl:p-14 rounded-2xl xl:rounded-4xl shadow-lg mx-auto">
    {{-- Carousel --}}
    <div class="flex items-center w-full justify-center relative">
      <button @click="prev" class="text-xl md:text-2xl lg:text-3xl cursor-pointer xl:text-4xl absolute -left-3 md:-left-6 max-w-sm:top-1/4 text-black hover:scale-125 transition min-w-[48px]">&#x276E;</button>

      <div class="flex flex-col items-center w-full max-w-2xl xl:max-w-5xl">
        <div class="grid md:grid-cols-2 gap-4 xl:gap-8 w-full items-center justify-center">
          <img loading="lazy" :src="characters[current].image" alt="Karakter" class="h-56 md:h-auto w-full lg:h-96 mb-2 object-contain drop-shadow-lg mx-auto">
          
          {{-- Desc --}}
          <div class="xl:text-left">
            <template x-if="characters[current].thumb">
              <img loading="lazy" :src="characters[current].thumb" alt="Banner" class="h-24 w-auto mx-auto md:mx-0 object-contain mb-2">
            </template>
            <h2 class="text-xl md:text-2xl xl:text-3xl mb-1 font-bold text-black text-center md:text-left">
              <span x-text="characters[current].name">Character Name</span>
            </h2>
            <p class="text-sm lg:text-base italic text-gray-700 mb-4 text-center md:text-left" x-text="characters[current].as"></p>
            <p class="mt-2 text-gray-800 text-sm xl:text-base leading-relaxed" x-text="characters[current].description"></p>
          </div>
        </div>
      </div>

      <button @click="next" class="text-xl md:text-2xl lg:text-3xl cursor-pointer xl:text-4xl absolute -right-3 md:-right-6 max-w-sm:top-1/4 text-black hover:scale-125 transition min-w-[48px]">&#x276F;</button>
    </div>
    <div class="relative w-full my-6 text-center">
      <div class="border-t border-white/20"></div>
      <span class="absolute -top-2 left-1/2 -translate-x-1/2 py-0.5 px-4 bg-white/10 text-white text-[10px] md:text-xs rounded-full backdrop-blur-sm text-nowrap">SELECT CHARACTER</span>
    </div>
    
    {{-- Thumbnail Selector --}}
    <div class="grid grid-cols-5 gap-2 md:gap-4 mt-4 lg:mt-6 w-full">
      <template x-for="(char, index) in characters" :key="index">
        <div class="flex justify-center">
          <img
            :src="char.image"
            @click="select(index)"
            class="cursor-pointer w-full h-full object-contain transition-all duration-300"
            :class="{
              'opacity-100 scale-110': index === current,
              'opacity-40 grayscale': index !== current
            }"
            alt="Thumbnail"
          >
        </div>
      </template>
    </div>
  </div>
</div>
@endsection

{{-- Alpine.js Carousel Logic --}}
@push('scripts')
<script src="//unpkg.com/alpinejs" defer></script>

<script>
function characterCarousel() {
  return {
    current: 0,
    characters: [
      {
        name: 'Nitari',
        as: 'Gamer, Influencer & Streamer',
        description: `Bubbly and full of energy, Nitari is a Gamer and Streamer with high followers number. Whenever she’s online, people will tune in droves just to watch her play. She is constantly fall asleep live even during a competition.`,
        image: '/media/images/chars/Nitari.webp',
        thumb: '/media/images/chars/Nitari2.webp',
      },
      {
        name: 'DrewCat',
        as: 'TCG & Boardgame Player, Collector & Trainer',
        description: `A part time moderator for a TCG forum that conducts boardgame and TCG workshops in his advanced trainer bot TC-6, DrewCat often interacts with people who are converted by “Cooper”into TCG, joining their unboxing parties. Every box he opens for them will be blessed with a “hit” but never the ones he opened for himself….`,
        image: '/media/images/chars/Drewcat.webp',
        thumb: '/media/images/chars/Drewcat2.webp',
      },
      {
        name: 'Cooper',
        as: 'Weeb & Collector',
        description: `A Pop culture loving, highly intelligent Nerd who reads comics and collects toys, it likes to passionately share its interest (sometimes aggressively) to others. Whenever it’s successfully done so, it will lay an egg which hatches into a clone of itself!`,
        image: '/media/images/chars/Cooper.webp',
        thumb: '/media/images/chars/Cooper2.webp',
      },
      {
        name: 'P.Orter',
        as: 'Gamer, Retro Collector',
        description: `An old soul trapped in a constantly changing outer shell, he loves everything vintage but also a perfectionist. Everything has to be in pristine condition and complete with box, he can’t sleep until his collection is complete.`,
        image: '/media/images/chars/Orter.webp',
        thumb: '/media/images/chars/Orter2.webp',
      },
      {
        name: 'Pitari',
        as: 'Nitari AI Hologram',
        description: `Pitari is AI version of Nitari, Appears whenever Nitari falls asleep…`,
        image: '/media/images/chars/Pitari.webp',
        thumb: '/media/images/chars/Pitari2.webp',
      },
    ],
    next() {
      this.current = (this.current + 1) % this.characters.length;
    },
    prev() {
      this.current = (this.current - 1 + this.characters.length) % this.characters.length;
    },
    select(index) {
      this.current = index;
    }
  }
}
</script>
@endpush
