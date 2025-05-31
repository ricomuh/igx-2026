<section id="popular" class="mb-12 md:mb-16 overflow-hidden">
    <h1 class="text-3xl md:text-4xl xl:text-5xl font-extrabold mb-8 md:mb-10 xl:mb-12 text-gray-800">Popular News</h1>

    <!-- Wrapper Swiper -->
    <div id="popular-carousel-wrapper">
        <!-- Navigation Buttons -->
        <div class="swiper-button-prev !-left-1 !size-6 after:!text-sm bg-white rounded-full !text-black lg:!hidden"></div>
        <div class="swiper-button-next !-right-1 !size-6 after:!text-sm bg-white rounded-full !text-black lg:!hidden"></div>

        <div id="popular-carousel" class="grid grid-cols-6 gap-5">
            @foreach ($popular_posts as $index => $post)
                @php
                    $colSpan = in_array($index, [0, 1]) ? 'col-span-3' : 'col-span-2';
                    $sizeTitle = in_array($index, [0, 1]) ? 'text-xl lg:text-2xl xl:text-3xl 2xl:text-4xl' : 'text-xl xl:text-xl 2xl:text-2xl';
                @endphp

                <div class="{{ $colSpan }} px-2"> {{-- px-2 untuk beri ruang saat mobile swiper --}}
                    <a href="{{ route('news.show', ['post' => $post['slug']]) }}" class="block">
                        <div class="aspect-video rounded-2xl lg:rounded-3xl overflow-hidden group relative">
                            <img
                                src="{{ $post['image_url'] }}"
                                alt="{{ $post['title'] }}"
                                class="w-full h-full object-cover transition duration-300 group-hover:scale-110"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/60 to-transparent opacity-100 transition duration-300 group-hover:opacity-80"></div>
                            <div class="absolute bottom-0 left-0 p-4 xl:p-6 text-white">
                                <h1 class="{{ $sizeTitle }} font-extrabold leading-snug">
                                    {{ Str::limit($post['title'], 20, '...') }}
                                </h1>
                                <div class="flex items-center gap-2 opacity-90 mt-2">
                                    <img src="{{ asset('media/images/icons/calendar.svg') }}" class="w-3 md:w-4 invert brightness-0" alt="Calendar">
                                    <p class="font-medium text-white text-sm md:text-base">{{ \Carbon\Carbon::parse($post['created_at'])->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const carouselWrapper = document.getElementById('popular-carousel-wrapper');
    const carousel = document.getElementById('popular-carousel');
    let swiperInstance = null;

    const isDesktop = () => window.innerWidth >= 1024;

    const initSwiper = () => {
        if (swiperInstance || isDesktop()) return;

        carouselWrapper.classList.add('swiper');
        carousel.classList.remove('grid', 'grid-cols-6', 'gap-5');
        carousel.classList.add('swiper-wrapper');

        Array.from(carousel.children).forEach(child => {
            child.classList.remove('col-span-3', 'col-span-2');
            child.classList.add('swiper-slide', 'w-full', 'px-2');
        });

        swiperInstance = new Swiper(carouselWrapper, {
            loop: false,
            spaceBetween: 16,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 1.5,
                }
            },
        });
    };

    const destroySwiper = () => {
        if (!swiperInstance) return;

        swiperInstance.destroy(true, true);
        swiperInstance = null;

        carouselWrapper.classList.remove('swiper');
        carousel.classList.remove('swiper-wrapper');
        carousel.classList.add('grid', 'grid-cols-6', 'gap-5');

        Array.from(carousel.children).forEach((child, index) => {
            child.classList.remove('swiper-slide', 'w-full', 'px-2');
            child.classList.add(index === 0 || index === 1 ? 'col-span-3' : 'col-span-2');
        });
    };

    const handleResize = () => {
        if (isDesktop()) {
            destroySwiper();
        } else {
            initSwiper();
        }
    };

    handleResize();
    window.addEventListener('resize', handleResize);
});
</script>
@endpush


