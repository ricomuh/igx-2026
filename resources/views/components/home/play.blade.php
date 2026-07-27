{{-- Play Section — Neo-Brutalism --}}
<section class="bg-surface border-t-4 border-b-4 border-black">
  <div class="container px-5 mx-auto lg:px-12 xl:px-20 py-20 xl:py-28">
    {{-- Header with halftone accent --}}
    <div class="flex flex-col items-center text-center justify-center gap-4 mb-12">
      <div class="bg-bg border-3 border-black p-4 shadow-brutal rotate-[-1deg] inline-block">
        <img src="{{ asset('media/images/logos/logo.png')}}" class="h-20 sm:h-24" alt="IGX Logo">
      </div>
      <h2 class="text-2xl md:text-3xl lg:text-4xl font-extrabold uppercase text-black">
        Play The <span class="inline-block bg-highlight border-2 border-black px-3 -rotate-1">IGX Fusion</span>
        <br>Win <span class="inline-block bg-primary border-2 border-black px-3 rotate-1">Free Tickets!</span>
      </h2>
    </div>

    {{-- Content --}}
    <div class="grid lg:grid-cols-2 gap-8 md:gap-12 items-center">
      {{-- Game Image --}}
      <div class="col">
        <div class="relative">
          <div class="absolute inset-0 bg-primary border-3 border-black rotate-3 -z-10 rounded-2xl"></div>
          <img src="{{ asset('media/images/illustrations/game1.jpg')}}"
               class="w-full md:aspect-video lg:aspect-auto h-full object-cover border-3 border-black rounded-2xl relative z-10"
               alt="IGX Game">
        </div>
      </div>

      {{-- Info --}}
      <div class="col space-y-6">
        <ul class="space-y-4">
          <li class="flex gap-3 items-start">
            <span class="bg-highlight border-2 border-black px-2 py-1 font-extrabold text-sm shrink-0">MON</span>
            <p class="text-lg md:text-xl font-bold text-black">Free ticket every <span class="bg-accent border-2 border-black px-2">Monday 10:00 AM WIB</span> for the top winners on the leaderboard.</p>
          </li>
          <li class="flex gap-3 items-start">
            <span class="bg-cyan border-2 border-black px-2 py-1 font-extrabold text-sm shrink-0">T&C</span>
            <p class="text-lg md:text-xl font-bold text-black">Previous winners are <span class="underline decoration-accent decoration-4">not eligible</span> to win again.</p>
          </li>
          <li class="flex gap-3 items-start">
            <span class="bg-accent border-2 border-black px-2 py-1 font-extrabold text-sm shrink-0">3x</span>
            <p class="text-lg md:text-xl font-bold text-black"><span class="bg-highlight border-2 border-black px-1">3 winners every Monday</span> — will you be next?</p>
          </li>
        </ul>

        <a href="{{ route("experiences") }}" class="btn-brutal-yellow text-lg px-8 py-4 inline-flex gap-3 items-center">
          START NOW
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
        </a>
      </div>
    </div>
  </div>
</section>
