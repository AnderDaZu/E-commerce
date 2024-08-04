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
        'name' => 'Crear Categoría',
    ],
]">

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    <div class="card">
        <form action="{{ route('admin.categories.store') }}" method="post" class="">
            @csrf

            <div>
                <x-label for="name" value="Nombre" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus placeholder="Ingrese nombre de la categoría" />
                <x-input-error for="name" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-label for="family_id" value="Familia" />
                <select class="family-select w-full" name="family_id">
                    @if ( old('family_id') )
                        <option value="{{ old('family_id') }}">{{ old('family_id') }}</option>
                    @endif
                </select>
                <x-input-error for="family_id" class="mt-2" />
            </div>

            <div class="flex justify-end mt-4">
                <x-button class="w-full sm:w-auto flex justify-center">
                    Crear
                </x-button>
            </div>
        </form>
    </div>

    @push('js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
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
