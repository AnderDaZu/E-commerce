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

    @livewire('admin.products.product-edit', compact('product'), key('product-edit' . $product->id))
    @livewire('admin.products.product-variants', compact('product'), key('product-variants' . $product->id))

</x-admin-layout>