<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'opciones',
    ],
]">

    @livewire('admin.options.manage-options')

</x-admin-layout>