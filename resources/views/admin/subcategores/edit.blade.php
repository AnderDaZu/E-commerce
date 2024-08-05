<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Subcategorías',
        'route' => route('admin.subcategories.index'),
    ],
    [
        'name' => 'Editar Subcategoría',
        'focus' => 'Editar Subcategoría: ' . $subcategory->name,
    ],
]">

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    <div class="card">

        @livewire('admin.subcategories.subcategory-edit', compact('subcategory'))

    </div>
    
</x-admin-layout>
