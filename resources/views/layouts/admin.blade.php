@props(['breadcrumbs' => []])

<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('app/icons/1-min.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Icons -> Font Awesome --}}
    <script src="https://kit.fontawesome.com/69430ceab9.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    @livewireStyles

    @stack('css')

</head>

<body class="font-sans antialiased" x-data="{
    showSidebar: false
}" :class="{
    'overflow-y-hidden': showSidebar
}">

    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 sm:hidden" style="display: none;" x-show="showSidebar"
        x-on:click="showSidebar = false">
    </div>

    @include('layouts.partials.admin.navigation')

    @include('layouts.partials.admin.sidebar')

    <div class="p-4 sm:ml-64">
        <div class="mt-14">
            <div class="md:relative flex flex-col gap-1">
                @include('layouts.partials.admin.breadcrumb')

                @isset($action)
                    <div class="md:absolute md:right-0 md:top-0 md:bottom-0 flex items-center justify-end pr-4 mb-4">
                        {{ $action }}
                        {{-- <a href="{{ route('admin.families.create') }}" class="py px-2 sm:py-1 sm:px-3 bg-blue-500 rounded-full text-2xl text-white font-bold">+</a> --}}
                    </div>
                @endisset
            </div>
            <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-700">
                {{ $slot }}
            </div>
        </div>
    </div>

    @livewireScripts

    @stack('js')

    {{-- escucha la variable de sesión que se manda --}}
    @if (session('swal'))
        <script>
            setTimeout(() => {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire(@json(session('swal')));
            }, 100);
        </script>
    @endif

    {{-- escucha los eventos que se emiten con livewire --}}
    <script>
        Livewire.on('swal', data => {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire(data[0]);
        })
    </script>
</body>

</html>
