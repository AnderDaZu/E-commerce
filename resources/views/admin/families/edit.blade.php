<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Familias',
        'route' => route('admin.families.index'),
    ],
    [
        'name' => 'Editar ' . $family->name,
    ],
]">

    <div class="card">
        <form action="{{ route('admin.families.update', $family) }}" method="post">
            @csrf
            @method('PUT')

            <div>
                <x-label for="name" value="Nombre" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $family->name)" required
                    autofocus placeholder="Ingrese nombre de la familia" />
                <x-input-error for="name" class="mt-2" />
            </div>

            <div class="flex flex-col sm:flex-row gap-2 justify-end mt-4">
                <x-danger-button onclick="deleteCategory()">
                    Eliminar
                </x-danger-button>
                <x-button class="w-full sm:w-auto flex justify-center">
                    Actualizar
                </x-button>
            </div>
        </form>
    </div>

    <form action="{{ route('admin.families.destroy', $family) }}" method="post" id="formDelete">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id" value="{{ $family->id }}">
    </form>

    @push('js')
        <script>
            function deleteCategory() {
                // Swal.fire({
                //     title: '¿Deseas borrar esta categoría?',
                //     text: "No podras revertir esto!",
                //     icon: 'warning',
                //     showCancelButton: true,
                //     confirmButtonColor: '#3085d6',
                //     cancelButtonColor: '#d33',
                //     confirmButtonText: 'Si, borrar',
                //     cancelButtonText: 'Cancelar'
                // }).then((result) => {
                //     if (result.isConfirmed) {
                        document.getElementById('formDelete').submit();
                //     }
                // })
            }
        </script>
    @endpush
</x-admin-layout>
