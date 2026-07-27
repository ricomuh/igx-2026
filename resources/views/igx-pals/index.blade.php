@extends('layouts.main', [
    'title' => 'IGX Pals',
])

@push('style')
<style>
  body {
    background-color: #322366 !important;
  }
  .char-bg-pattern {
    background-image: radial-gradient(circle, #9A94CC 1px, transparent 1px);
    background-size: 20px 20px;
  }
</style>
@endpush

@section('content')
<div class="bg-secondary min-h-screen relative overflow-hidden char-bg-pattern">
    {{-- Diagonal accent stripes --}}
    <div class="absolute top-10 -left-20 w-80 h-20 bg-highlight rotate-[-8deg] border-3 border-black opacity-30 z-0"></div>
    <div class="absolute bottom-20 -right-20 w-96 h-16 bg-accent rotate-[6deg] border-3 border-black opacity-30 z-0"></div>

    <div class="container mx-auto px-4 sm:px-5 xl:px-12 pt-20 sm:pt-28 pb-12 sm:pb-16 relative z-10" x-data="characterCarousel()">

        {{-- CHOOSE YOUR FIGHTER Header --}}
        <div class="flex flex-col items-center mb-6 sm:mb-8 lg:mb-12">
            <div class="bg-accent border-3 border-black shadow-brutal px-4 py-2 sm:px-10 sm:py-4 rotate-[-1.5deg] mb-2 sm:mb-3">
                <h1 class="text-lg sm:text-3xl md:text-4xl lg:text-5xl font-extrabold uppercase text-black text-center leading-none">
                    CHOOSE YOUR
                </h1>
            </div>
            <div class="bg-highlight border-3 border-black shadow-brutal px-4 py-2 sm:px-10 sm:py-4 rotate-[1deg]">
                <h1 class="text-xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold uppercase text-black text-center leading-none"
                    style="text-shadow: 3px 3px 0px #F253B6;">
                    FIGHTER!
                </h1>
            </div>
        </div>

        {{-- Main Carousel --}}
        <div class="flex items-center w-full justify-center relative gap-1 sm:gap-4">
            {{-- LEFT Arrow --}}
            <button @click="prev"
                class="btn-brutal shrink-0 text-lg sm:text-3xl lg:text-4xl px-1.5 sm:px-4 py-2 sm:py-4 z-20 cursor-pointer select-none"
                aria-label="Previous character">
                &#x276E;
            </button>

            {{-- Character Card --}}
            <div class="flex-1 max-w-3xl xl:max-w-5xl h-auto md:h-[360px] lg:h-[380px]">
                <template x-for="character in characters" :key="character.name">
                    <div class="card-brutal bg-surface overflow-hidden"
                         x-show="character === characters[current]"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-90 translate-x-8"
                         x-transition:enter-end="opacity-100 transform scale-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200 absolute inset-0"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-90 -translate-x-8">

                        <div class="flex flex-col md:grid md:grid-cols-2 gap-0">
                            {{-- LEFT: Character Image --}}
                            <div class="relative bg-secondary-lighter/20 flex items-center justify-center p-3 sm:p-6 md:p-8 border-b-3 md:border-b-0 md:border-r-3 border-black">
                                {{-- Level badge --}}
                                <div class="absolute top-2 left-2 sm:top-3 sm:left-3 bg-accent border-2 border-black px-2 py-0.5 sm:px-3 sm:py-1 shadow-brutal-sm rotate-[-2deg]">
                                    <span class="text-[10px] sm:text-sm font-extrabold text-black uppercase"
                                          x-text="'Lv.' + (characters.indexOf(character) + 1)">
                                    </span>
                                </div>
                                <img loading="lazy" :src="character.image"
                                     alt="Character"
                                     class="h-36 sm:h-48 md:h-56 lg:h-64 w-full object-contain drop-shadow-[4px_4px_0px_rgba(0,0,0,0.2)]">
                            </div>

                            {{-- RIGHT: Character Info --}}
                            <div class="p-4 sm:p-6 lg:p-8 flex flex-col justify-center">
                                {{-- Name banner --}}
                                <div class="bg-highlight border-2 border-black px-3 py-1 sm:px-4 sm:py-1.5 inline-block w-max shadow-brutal-sm rotate-[-1deg] mb-2 sm:mb-3">
                                    <h2 class="text-base sm:text-2xl lg:text-3xl font-extrabold text-black uppercase"
                                        x-text="character.name"></h2>
                                </div>

                                {{-- Subtitle --}}
                                <p class="text-[11px] sm:text-sm lg:text-base font-bold text-secondary uppercase tracking-wider mb-3 sm:mb-4"
                                   x-text="character.as"></p>

                                {{-- Divider --}}
                                <div class="border-t-2 border-black w-full mb-3 sm:mb-4"></div>

                                {{-- Description --}}
                                <div class="bg-secondary-lighter/10 border-2 border-black p-2 sm:p-4 mb-3 sm:mb-4 h-auto max-h-[60px] sm:max-h-none overflow-hidden">
                                    <p class="text-[11px] sm:text-sm lg:text-base text-black font-bold leading-relaxed"
                                       x-text="character.description"></p>
                                </div>

                                {{-- Stats --}}
                                <div class="space-y-1.5 sm:space-y-2">
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] sm:text-xs font-extrabold uppercase text-black w-10 sm:w-16">ATK</span>
                                        <div class="flex-1 h-2.5 sm:h-3 border-2 border-black bg-surface-dark">
                                            <div class="h-full bg-primary" :style="'width:' + Math.min(95, Math.max(5, 60 + (characters.indexOf(character) * 8))) + '%'"></div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] sm:text-xs font-extrabold uppercase text-black w-10 sm:w-16">DEF</span>
                                        <div class="flex-1 h-2.5 sm:h-3 border-2 border-black bg-surface-dark">
                                            <div class="h-full bg-cyan" :style="'width:' + Math.min(95, Math.max(5, 80 - (characters.indexOf(character) * 10))) + '%'"></div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] sm:text-xs font-extrabold uppercase text-black w-10 sm:w-16">SPD</span>
                                        <div class="flex-1 h-2.5 sm:h-3 border-2 border-black bg-surface-dark">
                                            <div class="h-full bg-accent" :style="'width:' + Math.min(95, Math.max(5, 45 + (characters.indexOf(character) * 12))) + '%'"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            {{-- RIGHT Arrow --}}
            <button @click="next"
                class="btn-brutal shrink-0 text-lg sm:text-3xl lg:text-4xl px-1.5 sm:px-4 py-2 sm:py-4 z-20 cursor-pointer select-none"
                aria-label="Next character">
                &#x276F;
            </button>
        </div>

        {{-- SELECT CHARACTER divider --}}
        <div class="relative w-full my-6 sm:my-8 text-center">
            <div class="border-t-3 border-highlight/50"></div>
            <div class="absolute -top-3 left-1/2 -translate-x-1/2">
                <span class="bg-accent border-2 border-black px-4 sm:px-5 py-1 text-[10px] sm:text-sm font-extrabold text-black uppercase shadow-brutal-sm text-nowrap">
                    SELECT CHARACTER
                </span>
            </div>
        </div>

        {{-- Thumbnail Roster — scrollable on mobile --}}
        <div class="overflow-x-auto pb-2 -mx-4 px-4 sm:overflow-visible sm:pb-0 sm:mx-0 sm:px-0">
            <div class="flex justify-start sm:justify-center gap-1.5 sm:gap-4 md:gap-6 min-w-max sm:min-w-0">
                <template x-for="(char, index) in characters" :key="index">
                    <div class="flex flex-col items-center gap-0.5 sm:gap-1 cursor-pointer group w-14 sm:w-20 md:w-24 shrink-0"
                         @click="select(index)">
                        <div class="relative border-2 sm:border-3 border-black transition-all duration-200 overflow-hidden w-full aspect-square"
                             :class="{
                               'bg-highlight shadow-brutal scale-110 z-10': index === current,
                               'bg-surface-dark opacity-50 grayscale hover:opacity-80 hover:grayscale-0': index !== current
                             }">
                            <img :src="char.image"
                                 class="w-full h-full object-contain p-0.5 sm:p-1"
                                 alt="Thumbnail">
                            <div x-show="index === current"
                                 class="absolute -bottom-1.5 sm:-bottom-2 left-1/2 -translate-x-1/2">
                                <div class="w-0 h-0 border-l-[6px] sm:border-l-8 border-r-[6px] sm:border-r-8 border-t-[6px] sm:border-t-8 border-l-transparent border-r-transparent border-t-black"></div>
                            </div>
                        </div>
                        <span class="text-[8px] sm:text-xs font-extrabold uppercase text-surface text-center leading-tight"
                              :class="{ 'text-highlight': index === current }"
                              x-text="char.name.split(' ')[0]"></span>
                    </div>
                </template>
            </div>
        </div>

        {{-- Player count / hint --}}
        <div class="text-center mt-6 sm:mt-8">
            <span class="text-surface/60 text-[10px] sm:text-xs font-bold uppercase tracking-widest">
                &#x25C0; &#x25B6; Navigate &nbsp;|&nbsp; 7 Characters Available
            </span>
        </div>
    </div>
</div>
@endsection

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
        description: `Bubbly and full of energy, Nitari is a Gamer and Streamer with high followers number. Whenever she's online, people will tune in droves just to watch her play. She is constantly fall asleep live even during a competition.`,
        image: '/media/images/chars/Nitari.webp',
        thumb: '/media/images/chars/Nitari2.webp',
      },
      {
        name: 'DrewCat',
        as: 'TCG & Boardgame Player, Collector & Trainer',
        description: `A part time moderator for a TCG forum that conducts boardgame and TCG workshops in his advanced trainer bot TC-6, DrewCat often interacts with people who are converted by \"Cooper\" into TCG, joining their unboxing parties. Every box he opens for them will be blessed with a \"hit\" but never the ones he opened for himself.`,
        image: '/media/images/chars/Drewcat.webp',
        thumb: '/media/images/chars/Drewcat2.webp',
      },
      {
        name: 'Cooper',
        as: 'Weeb & Collector',
        description: `A Pop culture loving, highly intelligent Nerd who reads comics and collects toys, it likes to passionately share its interest (sometimes aggressively) to others. Whenever it's successfully done so, it will lay an egg which hatches into a clone of itself!`,
        image: '/media/images/chars/Cooper.webp',
        thumb: '/media/images/chars/Cooper2.webp',
      },
      {
        name: 'P.Orter',
        as: 'Gamer, Retro Collector',
        description: `An old soul trapped in a constantly changing outer shell, he loves everything vintage but also a perfectionist. Everything has to be in pristine condition and complete with box, he can't sleep until his collection is complete.`,
        image: '/media/images/chars/Orter.webp',
        thumb: '/media/images/chars/Orter2.webp',
      },
      {
        name: 'Pitari',
        as: 'Nitari AI Hologram',
        description: `Pitari is AI version of Nitari, Appears whenever Nitari falls asleep...`,
        image: '/media/images/chars/Pitari.webp',
        thumb: '/media/images/chars/Pitari2.webp',
      },
      {
        name: 'Suga',
        as: 'Superhero from SSS!',
        description: `A superhero from the popular TV series "SSS! Super Spectacular Suga." Along with his great physical strength, he also wields heat-based powers.`,
        image: '/media/images/chars/Suga.webp',
        thumb: '/media/images/chars/Suga.webp',
      },
      {
        name: 'Lord Xcape',
        as: 'Internet Troublemaker',
        description: `Lord Xcape is the nickname of a user who often causes trouble on social media and the internet. Xcape has a buzzer group called TGZ (Team Gazzlight).`,
        image: '/media/images/chars/Xcape.webp',
        thumb: '/media/images/chars/Xcape.webp',
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
