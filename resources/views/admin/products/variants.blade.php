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
        'name' => $product->name,
        'route' => route('admin.products.edit', $product),
    ],
    [
        'name' => 'Editar variante',
        'focus' => $variant->features->pluck('description')->implode(' - '),
    ]
]">

    <form action="{{ route('admin.products.variantsUpdate', [$product, $variant]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <figure class="relative">
            <img src="{{ $variant->image }}" alt="" 
                class="aspect-[16/9] object-cover object-center w-full rounded-lg border-gray-400 border-dashed border-2 border-opacity-60"
                id="imgPreview">
            
            <div class="absolute top-4 left-4">
                <label class="cursor-pointer bg-slate-200 text-gray-800 dark:text-gray-700 py-1 sm:py-2 px-2 sm:px-4 rounded-md shadow-md text-sm sm:text-base"
                title="Imagen principal del producto">
                <i class="fa-solid fa-camera mr-2"></i> 
                Actualizar Imagen*

                <input type="file" accept="image/*" 
                    name="image" 
                    class="hidden" 
                    onchange="previewImage(event, '#imgPreview')">
            </label>
            </div>
        </figure>

        <x-input-error for="image" class="mt-2" />

        <div class="card mt-6 space-y-4">
            <div>
                <x-label class="text-sm sm:text-base uppercase hover:cursor-pointer inline-block"
                    title="Código SKU (Stock Keeping Unit)">
                    Código (SKU)
                </x-label>

                <x-input type="text" 
                    class="mt-1 w-full" 
                    placeholder="Ingrese código SKU" 
                    name="sku" 
                    value="{{ old('sku', $variant->sku) }}" />

                <x-input-error for="sku" class="mt-2" />
            </div>

            <div>
                <x-label class="text-sm sm:text-base uppercase hover:cursor-pointer inline-block"
                    title="Stock disponible del producto">
                    Stock
                </x-label>
    
                <x-input type="number"
                    min="0" 
                    class="mt-1 w-full" 
                    placeholder="Ingrese stock disponible" 
                    name="stock" 
                    value="{{ old('stock', $variant->stock) }}" />

                <x-input-error for="stock" class="mt-2" />
            </div>

            <div class="flex justify-end mt-4">
                <x-button class="w-full sm:w-auto flex justify-center">
                    Actualizar
                </x-button>
            </div>
        </div>

    </form>

    @push('js')
        <script>
            function previewImage(event, querySelector)
            {
                const input = event.target; // input que desencadeno la acción
                $imgPreview = document.querySelector(querySelector); // etiqueta img donde se cargara la imagen
                if ( !input.files.length ) return // validar si existe una imagen seleccionada
                file = input.files[0]; // obtener el archivo subido
                objectURL = URL.createObjectURL(file); // se crea la url
                $imgPreview.src = objectURL; // se modifica el atributo src de la etiqueta img
            }
        </script>
    @endpush

</x-admin-layout>