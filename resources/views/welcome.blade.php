<x-app-layout>
    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <style>
            /* .swiper {
                width: 1080px;
                height: 300px;
            } */
        </style>
    @endpush


    <!-- Slider main container -->
    <div class="swiper mb-12">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">

            <!-- Slides -->
            @foreach ($covers as $cover)
                <div class="swiper-slide">
                    <img src="{{ $cover->image }}" class="w-full aspect-[3/1] object-cover object-center" alt="">
                </div>
            @endforeach

        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <!-- If we need scrollbar -->
        {{-- <div class="swiper-scrollbar"></div> --}}
    </div>

    <x-cstm-container>
        <h1 class="text-lg sm:text-xl md:text-2xl font-extrabold uppercase text-gray-700 mb-4">
            Últimos Productos
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
            @foreach ($lastProducts as $product)
                <article class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="{{ $product->image }}" class="h-56 object-cover object-center w-full" alt="">
                    <div class="w-full px-4 pb-5 pt-2 bg-gray-50">
                        <h3 class="text-base md:text-lg md:leading-5 font-semibold text-gray-700 hover:cursor-pointer line-clamp-2 min-h-[46px] flex items-center capitalize sm:mb-2"
                            title="{{ $product->name }}">
                            {{ $product->name }}
                        </h3>

                        <div class="flex justify-between">
                            <p class="text-sm"><span class="font-medium mr-2">COP</span> ${{ $product->price }}</p>
                            <a href="" class="text-sm italic text-blue-700 underline">Ver más</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </x-cstm-container>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <script>
            const swiper = new Swiper('.swiper', {
            // Optional parameters
            // direction: 'vertical',
            loop: true,

            autoplay: {
                delay: 4000,
            },

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // And if we need scrollbar
            scrollbar: {
                el: '.swiper-scrollbar',
            },
            });
        </script>
    @endpush
</x-app-layout>
