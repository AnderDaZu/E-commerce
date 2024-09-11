<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Portadas',
        'route' => route('admin.covers.index'),
    ],
    [
        'name' => 'Editar Portada',
        'focus' => 'Editar: ' . $cover->title,
    ]
]">

<form action="{{ route('admin.covers.update', $cover) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <figure class="relative mb-4">
        <img src="{{ $cover->image }}" class="aspect-[3/1] object-cover object-center w-full rounded-md border-2 border-dashed border-opacity-60" alt="no image" id="imgPreview">
        <div class="absolute left-4 top-4">
            <label
                class="cursor-pointer bg-slate-300 text-gray-800 dark:text-gray-700 py-1 sm:py-2 px-2 sm:px-4 rounded-md shadow-md text-sm sm:text-base"
                title="Imagen principal del producto">
                <i class="fa-solid fa-camera mr-2"></i> Subir Imagen*

                <input type="file" accept="image/*" name="image" class="hidden"
                    onchange="previewImage(event, '#imgPreview')">
            </label>
        </div>
    </figure>

    <div class="mb-4">
        <x-label class="mb-1" title="Título de portada." for="title" >
            Título
        </x-label>
        <x-input name="title" type="text" value="{{ old('title', $cover->title) }}" id="title" class="w-full" placeholder="Ingrese título de portada" />
        <x-input-error for="title" class="mt-2" />
    </div>

    <div class="mb-4">
        <x-label class="mb-1" title="Fecha inicio de publicación de portada." for="start_at" >
            Fecha de inicio
        </x-label>
        <x-input name="start_at" type="date" value="{{ old('start_at', $cover->start_at->format('Y-m-d')) }}" id="start_at" class="w-full" />
        <x-input-error for="start_at" class="mt-2" />
    </div>

    <div class="mb-4">
        <x-label class="mb-1" title="Fecha fin de publicación de portada." for="end_at" >
            Fecha fin (opcional)
        </x-label>
        <x-input name="end_at" type="date" value="{{ old('end_at', $cover->end_at ? $cover->end_at->format('Y-m-d') : '') }}" id="end_at" class="w-full" />
        <x-input-error for="end_at" class="mt-2" />
    </div>

    <div class="mb-6 flex space-x-4">
        <label class="flex items-center space-x-1 hover:cursor-pointer">
            <x-input class="mr-0.5 hover:cursor-pointer" type="radio" name="is_active" value="1" :checked="$cover->is_active == 1" />
            <span>Activo</span>
        </label>
        <label class="flex items-center space-x-1 hover:cursor-pointer">
            <x-input class="mr-0.5 hover:cursor-pointer" type="radio" name="is_active" value="0" :checked="$cover->is_active == 0" />
            <span>Inactivo</span>
        </label>
    </div>
    <div class="flex justify-end">
        <x-button class="w-full sm:w-auto flex justify-center">
            Actualizar
        </x-button>
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
