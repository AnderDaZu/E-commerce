<div class="card">

    <form wire:submit="update">
        <div class="mb-4 w-full">
            <figure class="relative">
                <img class="aspect-[16/9] object-cover object-center w-full sm:max-w-64 md:max-w-96 rounded-lg border-gray-400 border-dashed border-2 border-opacity-60"
                    src="{{ $image ? $image->temporaryUrl() : $product->image }}"
                    alt="image description">

                <div class="absolute left-4 top-4">
                    <label
                        class="cursor-pointer bg-slate-200 text-gray-800 dark:text-gray-700 py-1 sm:py-2 px-2 sm:px-4 rounded-md shadow-md text-sm sm:text-base"
                        title="Imagen principal del producto">
                        <i class="fa-solid fa-camera mr-2"></i> Actualizar Imagen*

                        <input type="file" accept="image/*" wire:model="image" class="hidden">
                    </label>
                </div>
            </figure>
            <x-input-error for="image" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-label class="mb-1 hover:cursor-pointer" title="Código sku del producto, este campo es obligatorío." for="sku">Código*</x-label>
            <x-input class="w-full" type="text" wire:model="productEdit.sku" placeholder="Ingrese código del producto" id="sku" />
            <x-input-error for="productEdit.sku" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-label class="mb-1 hover:cursor-pointer" title="Nombre del producto, este campo es obligatorío." for="name">Nombre*</x-label>
            <x-input class="w-full" type="text" wire:model="productEdit.name"
                placeholder="Ingrese nombre del producto" id="name" />
            <x-input-error for="productEdit.name" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-label class="mb-1 hover:cursor-pointer" title="Descripción del producto." for="description">Descripción</x-label>
            <x-cstm-textarea class="w-full" type="text" wire:model="productEdit.description" id="description"
                placeholder="Ingrese descripción del producto">
                {{ old('productEdit.description') }}
            </x-cstm-textarea>
            <x-input-error for="productEdit.description" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-label class="hover:cursor-pointer" for="family_id" value="Familias*" title="Familias para asociar a productos, este campo es obligatorío" />
            <x-cstm-select wire:model.live="family_id" class="mt-1" id="family_id">
                <option value="" disabled>Selecciona una familia</option>
                @foreach ($families as $family)
                    <option value="{{ $family->id }}" @selected( $family->id == $family_id )>{{ $family->name }}</option>
                @endforeach
            </x-cstm-select>
            <x-input-error for="family_id" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-label class="hover:cursor-pointer" for="category_id" value="Categorías*" title="Categorías para asociar a productos, primero debes seleccionar una familia, este campo es obligatorío" />
            <x-cstm-select wire:model.live="category_id" class="mt-1" id="category_id">
                <option value="" disabled>Selecciona una categoría</option>
                @foreach ($this->categories as $category)
                    <option value="{{ $category->id }}" @selected( $category->id == $category_id )>{{ $category->name }}</option>
                @endforeach
            </x-cstm-select>
            <x-input-error for="category_id" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-label class="hover:cur   sor-pointer" for="subcategory_id" value="Subcategorías*" title="Subcategorías para asociar a productos, primero debes seleccionar una categoría, este campo es obligatorío" />
            <x-cstm-select wire:model.live="productEdit.subcategory_id" class="mt-1" id="subcategory_id">
                <option value="" disabled>Selecciona una subcategoría</option>
                @foreach ($this->subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}" @selected( $subcategory->id == $productEdit['subcategory_id'] )>{{ $subcategory->name }}</option>
                @endforeach
            </x-cstm-select>
            <x-input-error for="productEdit.subcategory_id" class="mt-2" />
        </div>

        <div class="mt-4">  
            <x-label class="hover:cursor-pointer" for="price" value="Precio*" title="Precio del producto, este campo es obligatorío" />
            <x-input class="w-full" type="number" step="0.01" wire:model="productEdit.price"
                placeholder="Ingrese precio del producto" id="price" />
            <x-input-error for="productEdit.price" class="mt-2" />
        </div>
        
        <div class="mt-4">  
            <x-label class="hover:cursor-pointer" for="stock" value="Stock*" title="Stock del producto, este campo es obligatorío" />
            @if ( $product->variants->count() == 0 )
                <x-input class="w-full" type="number" step="1" min="0" wire:model="productEdit.stock"
                    placeholder="Ingrese stock del producto" id="stock" />
                <x-input-error for="productEdit.stock" class="mt-2" />
            @else
                <x-input class="w-full read-only:bg-gray-300" type="number" step="1" min="0" 
                    readonly
                    wire:model="productEdit.stock"
                    id="stock" />
            @endif
        </div>


        <div class="flex flex-col sm:flex-row gap-2 sm:justify-end mt-4">
            <x-danger-button onclick="deleteProduct()">
                Eliminar
            </x-danger-button>
            <x-button class="w-full sm:w-auto flex justify-center">
                Actualizar
            </x-button>
        </div>
    </form>

    <form id="formDelete" action="{{ route('admin.products.destroy', $product) }}" method="POST">
        @method('DELETE')
        @csrf
    </form>

    @push('js')
        <script>
            function deleteProduct() {
                Swal.fire({
                    title: '¿Deseas borrar este producto?',
                    text: "No podras revertir esto!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, borrar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('formDelete').submit();
                    }
                })
            }
        </script>
    @endpush
</div>
