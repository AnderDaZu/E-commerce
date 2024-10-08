<div class="card">

    {{-- @dump( $image ) --}}

    <form wire:submit="store">
        <div class="mb-4 w-full">
            <figure class="relative">
                <img class="aspect-[16/9] object-cover object-center w-full sm:max-w-64 md:max-w-96 rounded-lg border-gray-400 border-dashed border-2 border-opacity-60"
                    src="{{ $image ? $image->temporaryUrl() : asset('app/imgs/default-image-min.webp') }}" id="imgPreview"
                    alt="image description">

                <div class="absolute left-4 top-4">
                    <label
                        class="cursor-pointer bg-slate-200 text-gray-800 dark:text-gray-700 py-1 sm:py-2 px-2 sm:px-4 rounded-md shadow-md text-sm sm:text-base"
                        title="Imagen principal del producto">
                        <i class="fa-solid fa-camera mr-2"></i> Subir Imagen*

                        <input type="file" accept="image/*" wire:model="image" class="hidden">
                    </label>
                </div>
            </figure>
            <x-input-error for="image" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-label class="mb-1 hover:cursor-pointer" title="Código sku del producto, este campo es obligatorío." for="sku">Código*</x-label>
            <x-input class="w-full" type="text" wire:model="product.sku" placeholder="Ingrese código del producto" id="sku" />
            <x-input-error for="product.sku" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-label class="mb-1 hover:cursor-pointer" title="Nombre del producto, este campo es obligatorío." for="name">Nombre*</x-label>
            <x-input class="w-full" type="text" wire:model="product.name"
                placeholder="Ingrese nombre del producto" id="name" />
            <x-input-error for="product.name" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-label class="mb-1 hover:cursor-pointer" title="Descripción del producto." for="description">Descripción</x-label>
            <x-cstm-textarea class="w-full" type="text" wire:model="product.description" id="description"
                placeholder="Ingrese descripción del producto">
                {{ old('product.description') }}
            </x-cstm-textarea>
            <x-input-error for="product.description" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-label class="hover:cursor-pointer" for="family_id" value="Familias*" title="Familias para asociar a productos, este campo es obligatorío" />
            <x-cstm-select wire:model.live="family_id" class="mt-1" id="family_id">
                <option value="" disabled>Selecciona una familia</option>
                @foreach ($families as $family)
                    <option value="{{ $family->id }}">{{ $family->name }}</option>
                @endforeach
            </x-cstm-select>
            <x-input-error for="family_id" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-label class="hover:cursor-pointer" for="category_id" value="Categorías*" title="Categorías para asociar a productos, primero debes seleccionar una familia, este campo es obligatorío" />
            <x-cstm-select wire:model.live="category_id" class="mt-1" id="category_id">
                <option value="" disabled>Selecciona una categoría</option>
                @foreach ($this->categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </x-cstm-select>
            <x-input-error for="category_id" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-label class="hover:cursor-pointer" for="subcategory_id" value="Subcategorías*" title="Subcategorías para asociar a productos, primero debes seleccionar una categoría, este campo es obligatorío" />
            <x-cstm-select wire:model.live="product.subcategory_id" class="mt-1" id="subcategory_id">
                <option value="" disabled>Selecciona una subcategoría</option>
                @foreach ($this->subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
            </x-cstm-select>
            <x-input-error for="product.subcategory_id" class="mt-2" />
        </div>

        <div class="mt-4">  
            <x-label class="hover:cursor-pointer" for="price" value="Precio*" title="Precio del producto, este campo es obligatorío" />
            <x-input class="w-full" type="number" step="0.01" wire:model="product.price"
                placeholder="Ingrese precio del producto" id="price" />
            <x-input-error for="product.price" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-button class="w-full sm:w-auto flex justify-center">
                Crear
            </x-button>
        </div>
    </form>
</div>
