<div x-data="{
    open: false,
}">
    <header class="bg-blue-600">
        <x-cstm-container class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-6">
            <div class="flex justify-between sm:justify-start sm:gap-6">
                <button x-on:click="open = true" class="text-2xl">
                    <i class="fa-solid fa-bars text-gray-200 hover:cursor-pointer" title="Menu"></i>
                </button>
                <div class="flex gap-3">
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('app/icons/1-min.webp') }}" alt="logo" class="h-9 w-auto">
                    </a>
                    <h2 class="text-white text-center xs:text-left hidden xs:block">
                        <a href="/" class="inline-flex flex-col items-start">
                            <span class="text-lg sm:text-xl md:text-2xl lg:text-3xl leading-6 sm:leading-6 md:leading-6 lg:leading-6" style="text-shadow: 1px 1px 6px #1e3a8a;">Andershopy</span>
                            <span class="text-sm sm:base">Tienda <span class="bg-gray-200 text-blue-700 font-semibold rounded-md px-1">Online</span></span>
                        </a>
                    </h2>
                </div>
                <div class="flex items-center gap-2 sm:hidden">
                    <x-dropdown>
                        <x-slot name="trigger">
                            @auth
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <button class="text-2xl md:text-3xl">
                                    <i class="fa-solid fa-user text-gray-200"></i>
                                </button>
                            @endauth
                        </x-slot>
                        <x-slot name="content">
                            @guest {{-- Si el usuario no ha iniciado sesión --}}
                                <div class="px-4 py-2">
                                    <div class="flex justify-center">
                                        <a href="{{ route('login') }}" class="px-2 py-1.5 w-full text-center font-semibold sm:px-3 rounded-md hover:bg-blue-500 hover:text-white">Iniciar sesión</a>
                                    </div>
                                    <div class="flex justify-center">
                                        <a href="{{ route('register') }}" class="py-1.5 hover:text-blue-500 hover:underline font-medium hover:font-semibold text-center">Registrarse</a>
                                    </div>
                                </div>
                            @else {{-- Si el usuario ha iniciado sesión --}}
                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    Pérfil
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}"
                                            @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>

                                <div class="border-t border-gray-200"></div>
                            @endguest
                        </x-slot>
                    </x-dropdown>
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
                    {{-- wire:model="search" --}}
                    placeholder="Buscar por producto, tienda o marca"
                    id="search" />
            </div>
            <div class="hidden sm:flex sm:items-center sm:gap-2 md:gap-3">
                <x-dropdown>
                    <x-slot name="trigger">
                        @auth
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        @else
                            <button class="text-2xl md:text-3xl">
                                <i class="fa-solid fa-user text-gray-200"></i>
                            </button>
                        @endauth
                    </x-slot>
                    <x-slot name="content">
                        @guest {{-- Si el usuario no ha iniciado sesión --}}
                            <div class="px-4 py-2">
                                <div class="flex justify-center">
                                    <a href="{{ route('login') }}" class="px-2 py-1.5 w-full text-center font-semibold sm:px-3 rounded-md hover:bg-blue-500 hover:text-white">Iniciar sesión</a>
                                </div>
                                <div class="flex justify-center">
                                    <a href="{{ route('register') }}" class="py-1.5 hover:text-blue-500 hover:underline font-medium hover:font-semibold text-center">Registrarse</a>
                                </div>
                            </div>
                        @else {{-- Si el usuario ha iniciado sesión --}}
                            <x-dropdown-link href="{{ route('profile.show') }}">
                                Pérfil
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>

                            <div class="border-t border-gray-200"></div>
                        @endguest
                    </x-slot>
                </x-dropdown>
                <button class="text-2xl md:text-3xl">
                    <i class="fa-solid fa-cart-shopping text-gray-200"></i>
                </button>
            </div>
        </x-cstm-container>
    </header>

    <div x-show="open" x-on:click="open = false" style="display: none;" class="fixed top-0 left-0 inset-0 bg-gray-700 bg-opacity-50 z-10"></div>

    <div x-show="open" style="display: none;" class="fixed top-0 left-0 z-20"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 transform -translate-x-full"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform -translate-x-full">
        <div class="flex">
            <div class="w-60 sm:w-72 md:w-80 h-screen bg-gray-100">
                <div class="flex justify-between items-center bg-blue-600 px-4 py-3 text-gray-200">
                    <img src="{{ asset('app/icons/1-min.webp') }}" alt="logo" class="h-8 w-auto">
                    <button x-on:click="open = false" title="cerrar">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="h-[calc(100vh-52px)] overflow-auto">
                    <ul>
                        @foreach ($families as $family)
                            <li wire:mouseover="$set('family_id', {{ $family->id }})">
                                <a href="{{ route('families.show', $family) }}" class="flex items-center p-4 hover:bg-blue-500 hover:text-white hover:font-semibold hover:border-y hover:border-y-blue-600 text-shadow-blue-4 {{ $family->id == $family_id ? 'bg-blue-500 text-white font-semibold border-r-[3px] border-r-blue-600 text-shadow-blue-4' : 'text-gray-700' }}">
                                    {{ $family->name }}
                                    <i class="fa-solid fa-angle-right ml-auto"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="hidden md:block w-80 xl:w-[57rem] pt-[56px]">
                <div class="bg-gray-50 h-[calc(100vh-56px)] px-6 py-8 overflow-auto">
                    <div class="flex justify-between mb-4 md:text-lg uppercase font-semibold bg-blue-500 py-2 px-4 rounded-sm">
                        <h3 class="text-gray-50">{{ $this->familyName }}</h3>
                        <a href="{{ route('families.show', $family_id) }}" class="text-lg text-gray-50 hover:text-white">
                            <i class="fa-solid fa-angle-right"></i>
                        </a>
                    </div>
                    <ul class="grid gap-6 divide-y-2 xl:divide-y-0 md:grid-cols-1 xl:grid-cols-3">
                        @foreach ($this->categories as $category)
                            <li class="leading-5">
                                <a href="" class="text-blue-500 font-semibold uppercase inline-block pt-4">
                                    {{ $category->name }}
                                </a>
                                <ul class="mt-4 space-y-1">
                                    @foreach ($category->subcategories as $subcategory)
                                        <li class="text-sm">{{ $subcategory->name }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
