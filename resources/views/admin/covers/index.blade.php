<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Portadas',
    ],
]">

<x-slot name="action">
    <a href="{{ route('admin.covers.create') }}" class="btn btn-blue">+</a>
</x-slot>

</x-admin-layout>
