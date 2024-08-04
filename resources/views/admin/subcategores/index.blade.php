<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Subcategorías',
    ],
]">

    <x-slot name="action">
        <a href="{{ route('admin.subcategories.create') }}" class="btn btn-blue">+</a>
    </x-slot>

    @if ( $subcategoriesCount )
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="min-w-[300px] w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 sm:px-6 py-3">
                            Id
                        </th>
                        <th scope="col" class="px-4 sm:px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-4 sm:px-6 py-3">
                            Categoría
                        </th>
                        <th scope="col" class="px-4 sm:px-6 py-3">
                            Familia
                        </th>
                        <th scope="col" class="px-1 sm:px-6 py-3 w-24 sm:w-28">
                            <span class="sr-only"></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subcategories as $subcategory)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-4 sm:px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $subcategory->id }}
                            </th>
                            <td class="px-4 sm:px-6 py-4">
                                {{ $subcategory->name }}
                            </td>
                            <td class="px-4 sm:px-6 py-4">
                                {{ $subcategory->category->name }}
                            </td>
                            <td class="px-4 sm:px-6 py-4">
                                {{ $subcategory->category->family->name }}
                            </td>
                            <td class="px-1 flex sm:px-6 py-4 w-24 sm:w-28">
                                <a href="{{ route('admin.subcategories.edit', $subcategory) }}" class="mr-2">🖋️</a>
                                <form action="{{ route('admin.subcategories.destroy', $subcategory) }}" method="POST" id="formDelete-{{ $subcategory->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="event.preventDefault(); deleteSubcategory({{ $subcategory }})" class="font-medium text-red-600 dark:text-red-500">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="my-4">
            {{ $subcategories->links() }}
        </div>
    @else
        <div class="flex items-center p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Información:</span> Aún no hay subcategorías registradas.
            </div>
        </div>
    @endif

    @push('js')
        <script>
            function deleteSubcategory(subcategory) {
                Swal.fire({
                    title: `¿Deseas borrar esta subcategoría "${subcategory.name}"?`,
                    text: "No podras revertir esto!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, borrar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('formDelete-' + subcategory.id).submit();
                    }
                });
            }
        </script>
    @endpush

</x-admin-layout>
