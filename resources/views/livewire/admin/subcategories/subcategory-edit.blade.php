<div>
    <form  wire:submit="save">
        <div>
            <x-label for="name" value="Nombre" />
            <x-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="subcategoryEdit.name" required autofocus
                placeholder="Ingrese nombre de la subcategoría" />
            <x-input-error for="subcategoryEdit.name" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-label for="family_id" value="Familias" />
            <x-cstm-select wire:model.live="subcategoryEdit.family_id" class="mt-1" name="family_id">
                <option value="" disabled>Selecciona una familia</option>
                @foreach ($families as $family)
                    <option value="{{ $family->id }}">{{ $family->name }}</option>
                @endforeach
            </x-cstm-select>
            <x-input-error for="subcategoryEdit.family_id" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-label for="category_id" value="Categorías" />
            <x-cstm-select wire:model.live="subcategoryEdit.category_id" class="mt-1" name="category_id">
                <option value="" disabled>Selecciona una categoría</option>
                @foreach ($this->categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </x-cstm-select>
            <x-input-error for="subcategoryEdit.category_id" class="mt-2" />
        </div>

        <div class="flex flex-col sm:flex-row gap-2 justify-end mt-4">
            <x-danger-button onclick="deleteSubcategory()">
                Eliminar
            </x-danger-button>
            <x-button class="w-full sm:w-auto flex justify-center">
                Actualizar
            </x-button>
        </div>
    </form>

    <form action="{{ route('admin.subcategories.destroy', $subcategory) }}" method="post" id="formDelete">
        @csrf
        @method('DELETE')
    </form>

    @push('js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            function deleteSubcategory() {
                Swal.fire({
                    title: '¿Deseas borrar esta subcategoría?',
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
