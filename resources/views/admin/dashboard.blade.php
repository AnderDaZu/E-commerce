<x-admin-layout>
    <div class="grid lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-lg py-8 px-2 sm:px-4 md:px-6 lg:px-8">
            <div class="flex items-center justify-center">
                <img class="h-12 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                <div class="flex-1 ml-4">
                    <h2 class="uppercase text-base sm:text-lg md:text-xl font-medium">Bienvenido, {{ Auth::user()->name }}</h2>

                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="text-sm sm:text-sm md:text-base font-medium text-gray-600 hover:text-blue-900">Cerrar sesión</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg py-8 px-2 sm:px-4 md:px-6 lg:px-8 flex items-center justify-center">
            <h2 class="text-base sm:text-lg md:text-xl uppercase font-semibold p-2 border-y-2 border-y-blue-900 rounded-s-lg bg-blue-900 text-gray-50">
                {{ config('app.name') }}
            </h2> 
            <span class="text-base sm:text-lg md:text-xl uppercase font-normal p-2 border-y-2 border-y-blue-900 border-r-2 border-r-blue-900 rounded-e-lg">Ecommerce</span>
        </div>
    </div>
</x-admin-layout>