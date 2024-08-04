@php
    
$links = [
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
        'icon' => 'fa-solid fa-gauge-high',
        'active' => request()->routeIs('admin.dashboard'),
    ],
    [
        'name' => 'Familias',
        'url' => route('admin.families.index'),
        'icon' => 'fa-solid fa-box-open',
        'active' => request()->routeIs('admin.families.*'),
    ],
    [
        'name' => 'Categorías',
        'url' => route('admin.categories.index'),
        'icon' => 'fa-solid fa-tags',
        'active' => request()->routeIs('admin.categories.*'),
    ],
    [
        'name' => 'Subcategorías',
        'url' => route('admin.subcategories.index'),
        'icon' => 'fa-solid fa-bars-staggered',
        'active' => request()->routeIs('admin.subcategories.*'),
    ],
];
@endphp

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-[100dvh] pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    :class="{
        'translate-x-0 ease-out': showSidebar,
        '-translate-x-full ease-in': !showSidebar,
    }"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                <li>
                    <a href="{{ $link['url'] }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <i class="{{ $link['icon'] }} text-gray-500"></i>
                        <span class="ms-3">{{ $link['name'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>

{{-- class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700 -translate-x-full" --}}

{{-- class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700 transform-none" --}}