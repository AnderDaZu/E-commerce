<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Portadas',
        'route' => route('admin.covers.index'),
    ],
    [
        'name' => 'Editar Portada',
        'focus' => 'Editar Portada: ' . $cover->name,
    ]
]">

</x-admin-layout>
