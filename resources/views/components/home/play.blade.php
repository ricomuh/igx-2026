<section class="container px-5 mx-auto py-20 text-white">
  <div class="flex flex-col items-center text-center justify-center gap-4 mb-10">
    <img src="{{ asset('media/images/logos/logo.png')}}" class="h-24" alt="">
    <h2 class="text-4xl">PLAY THE <span class="text-secondary">IGX FUSION CELEBRATION,</span>
      <br>WIN <span class="text-secondary">FREE TICKETS!</span></h2>
  </div>
  <div class="grid grid-cols-2 gap-12 items-center">
    <div class="col">
      <img src="{{ asset('media/images/illustrations/game1.jpg')}}" class="w-full h-full object-cover rounded-2xl ring-5 ring-background-footer" alt="">
    </div>
    <div class="col space-y-5">
      <ul class="list-disc pl-5 text-xl leading-9">
        <li><span class="text-info">Free ticket every Monday at 10:00 AM WIB</span> for the top winners on the leaderboard.</li>
        <li><span class="text-info">Terms & Conditions</span>: Previous winners are not eligible to win again.</li>
        <li><span class="text-info">3 winners every Monday</span> - will you be next?</li>
      </ul>
      <a href="{{ route("experiences") }}" class="btn-primary font-extrabold lg:text-lg w-max px-5 sm:px-6 md:px-7 py-3 sm:py-4 rounded-lg uppercase flex gap-2 sm:gap-3">START
          <img src="{{ asset('media/images/icons/angles-right-solid.svg')}}" class="w-4 sm:w-5 md:w-6" alt="">
      </a>
    </div>
  </div>
</section>

