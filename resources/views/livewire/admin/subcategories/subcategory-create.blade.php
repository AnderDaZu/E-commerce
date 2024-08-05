<div>
    <form  wire:submit="save">
        <div>
            <x-label for="name" value="Nombre" />
            <x-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="subcategory.name" required autofocus
                placeholder="Ingrese nombre de la subcategoría" />
            <x-input-error for="subcategory.name" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-label for="family_id" value="Familias" />
            <x-cstm-select wire:model.live="subcategory.family_id" class="mt-1" name="family_id">
                <option value="" disabled>Selecciona una familia</option>
                @foreach ($families as $family)
                    <option value="{{ $family->id }}">{{ $family->name }}</option>
                @endforeach
            </x-cstm-select>
            <x-input-error for="subcategory.family_id" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-label for="category_id" value="Categorías" />
            <x-cstm-select wire:model.live="subcategory.category_id" class="mt-1" name="category_id">
                <option value="" disabled>Selecciona una categoría</option>
                @foreach ($this->categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </x-cstm-select>
            <x-input-error for="subcategory.category_id" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-button class="w-full sm:w-auto flex justify-center">
                Crear
            </x-button>
        </div>
    </form>
</div>
