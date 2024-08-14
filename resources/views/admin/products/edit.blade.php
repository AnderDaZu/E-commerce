<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Productos',
        'route' => route('admin.products.index'),
    ],
    [
        'name' => 'Editar Producto',
        'focus' => 'Editar Producto: ' . $product->name,
    ],
]">

    @livewire('admin.products.product-edit', compact('product'))

</x-admin-layout>