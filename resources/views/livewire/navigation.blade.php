<div>
    <header class="bg-blue-600">
        <x-cstm-container class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-6">
            <div class="flex justify-between sm:justify-start sm:gap-6">
                <button class="text-2xl">
                    <i class="fa-solid fa-bars text-gray-200 hover:cursor-pointer" title="Menu"></i>
                </button>
                <div class="flex gap-3">
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('app/icons/1-min.webp') }}" alt="logo" class="h-9 w-auto">
                    </a>
                    <h2 class="text-white text-center xs:text-left hidden xs:block">
                        <a href="/" class="inline-flex flex-col items-start">
                            <span class="text-lg sm:text-xl md:text-2xl lg:text-3xl leading-6 sm:leading-6 md:leading-6 lg:leading-6" style="text-shadow: 1px 1px 6px #1e3a8a;">Andershopy</span>
                            <span class="text-sm sm:base">Tienda <span class="bg-gray-200 text-blue-700 font-medium rounded-md px-1">Online</span></span>
                        </a>
                    </h2>
                </div>
                <div class="flex items-center gap-2 sm:hidden">
                    <button class="text-2xl md:text-3xl">
                        <i class="fa-solid fa-user text-gray-200"></i>
                    </button>
                    <button class="text-2xl md:text-3xl">
                        <i class="fa-solid fa-cart-shopping text-gray-200"></i>
                    </button>
                </div>
            </div>
            <div class="flex-1 flex">
                <label class="inline-flex items-center px-2 md:px-3 text-sm text-gray-500 bg-gray-300 border rounded-e-0 border-gray-400 border-e-0 rounded-s-md hover:cursor-pointer" 
                    for="search"
                    title="Buscar producto">
                    <i class="fa-solid fa-magnifying-glass w-4 h-4"></i>
                </label>
                <x-input type="text" class="w-full rounded-none rounded-e-lg" 
                    wire:model="search"
                    placeholder="Buscar por producto, tienda o marca"
                    id="search" />
            </div>
            <div class="hidden sm:flex sm:items-center sm:gap-2 md:gap-3">
                <button class="text-2xl md:text-3xl">
                    <i class="fa-solid fa-user text-gray-200"></i>
                </button>
                <button class="text-2xl md:text-3xl">
                    <i class="fa-solid fa-cart-shopping text-gray-200"></i>
                </button>
            </div>
        </x-cstm-container>
    </header>
</div>