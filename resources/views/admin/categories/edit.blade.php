<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorías',
        'route' => route('admin.categories.index'),
    ],
    [
        'name' => 'Editar Categoría',
        'focus' => 'Editar Categoría: ' . $category->name,
    ],
]">
    <x-slot name="action">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-blue">+</a>
    </x-slot>

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    <div class="card">
        <form action="{{ route('admin.categories.update', $category) }}" method="post" class="">
            @csrf
            @method('put')

            <div>
                <x-label for="name" value="Nombre" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $category->name)" required
                    autofocus placeholder="Ingrese nombre de la categoría" />
                <x-input-error for="name" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-label for="family_id" value="Familia" />
                <select class="family-select w-full" name="family_id">
                    @if ( old('family_id', $category->family->name) )
                        <option value="{{ old('family_id', $category->family->name) }}">{{ old('family_id', $category->family->name) }}</option>
                    @endif
                </select>
                <x-input-error for="family_id" class="mt-2" />
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

    <form action="{{ route('admin.categories.destroy', $category) }}" method="post" id="formDelete">
        @csrf
        @method('DELETE')
    </form>

    @push('js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            function deleteCategory() {
                Swal.fire({
                    title: '¿Deseas borrar esta categoría?',
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

            $(document).ready(function() {
                $('.family-select').select2({
                    tags: true,
                    tokenSeparators: [','],
                    ajax: {
                        url: "{{ route('api.families.index') }}",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                term: params.term
                            }
                        },
                        processResults: function(data, params) {
                            return {
                                results: data
                            }
                        }
                    }
                });
            });
        </script>
    @endpush

</x-admin-layout>
