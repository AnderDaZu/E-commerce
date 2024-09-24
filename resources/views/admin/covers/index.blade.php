<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Portadas',
    ],
]">

<x-slot name="action">
    <a href="{{ route('admin.covers.create') }}" class="btn btn-blue">+</a>
</x-slot>

@if ( $covers->count() )
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="min-w-[300px] w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 overflow-auto">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 sm:px-6 py-3 w-8">
                            #
                        </th>
                        <th scope="col" class="px-4 sm:px-6 py-3 w-4">
                            <span class="sr-only"></span>
                        </th>
                        <th class="w-28 px-4">
                            Imagen
                        </th>
                        <th scope="col" class="px-4 sm:px-6 py-3">
                            Título
                        </th>
                        <th scope="col" class="px-4 sm:px-6 py-3 min-w-28">
                            Fecha Inicio
                        </th>
                        <th scope="col" class="px-4 sm:px-6 py-3 min-w-36">
                            Fecha Finalización
                        </th>
                        <th scope="col" class="px-2 sm:px-6 py-3 w-24 sm:w-28">
                            <span class="sr-only"></span>
                        </th>
                    </tr>
                </thead>
                <tbody id="covers">
                    @foreach ($covers as $cover)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 cursor-move"
                            data-id="{{ $cover->id }}">
                            <th scope="row" class="px-4 sm:px-6 py-4 w-8 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $cover->order }}
                            </th>
                            <td class="px-2 py-4 w-4" title="{{ $cover->is_active ? 'Activo' : 'Inactivo' }}">
                                <span class="hover:cursor-pointer">
                                    @if ( $cover->is_active )
                                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Activo</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Inactivo</span>
                                    @endif

                                </span>
                            </td>
                            <td class="py-1.5 w-28 px-4 relative">
                                <img src="{{ $cover->image }}" class="max-w-36 object-cover object-center rounded-lg">
                            </td>
                            <td class="px-4 sm:px-6 py-4 leading-6 text-base font-semibold">
                                <a href="{{ route('admin.covers.edit', $cover) }}">
                                    {{ $cover->title }}
                                </a>
                            </td>
                            <td class="px-4 sm:px-6 py-4 leading-[18px] min-w-28">
                                {{ $cover->start_at->format('d M Y') }}
                            </td>
                            <td class="px-4 sm:px-6 py-4 leading-[18px] min-w-36">
                                {{ $cover->end_at ? $cover->end_at->format('d M Y') : 'No definida' }}
                            </td>
                            <td class="px-2 sm:px-6 py-4 w-24 sm:w-28">
                                <div class="flex items-center">
                                    <a href="{{ route('admin.covers.edit', $cover) }}" class="mr-2">🖋️</a>
                                    <form action="{{ route('admin.covers.destroy', $cover) }}" method="POST" id="formDelete-{{ $cover->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="event.preventDefault(); deleteCover({{ $cover }})" class="font-medium text-red-600 dark:text-red-500">🗑️</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="my-4">
            {{ $covers->links() }}
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
                <span class="font-medium">Información:</span> Aún no hay portadas registradas.
            </div>
        </div>
    @endif

    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.3/Sortable.min.js"></script>
        <script>
            function deleteCover(cover) {
                Swal.fire({
                    title: `¿Deseas borrar esta portada "${cover.title}"?`,
                    text: "No podras revertir esto!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, borrar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('formDelete-' + cover.id).submit();
                    }
                });
            }

            new Sortable(covers, {
                animation: 150,
                ghostClass: 'bg-blue-100',
                store: {
                    set: (sortable) => {
                        const sorts = sortable.toArray();

                        axios.post("{{ route('api.sort.covers') }}", {
                            sorts: sorts
                        }).catch((error) => {
                            console.log(error);
                        });
                    }
                }
            });

        </script>
    @endpush

</x-admin-layout>
