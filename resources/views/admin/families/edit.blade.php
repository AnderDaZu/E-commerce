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
        'name' => 'Editar ' . $family->name
    ]
]">

<div class="card">
    <form action="{{ route('admin.families.update', $family) }}" method="post">
        @csrf
        @method('PUT')

        <div>
            <x-label for="name" value="Nombre" />
            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $family->name)" required autofocus 
                placeholder="Ingrese nombre de la familia"/>
            <x-input-error for="name" class="mt-2" /> 
        </div>

        <div class="flex justify-end mt-4">
            <x-button class="w-full sm:w-auto flex justify-center">
                Actualizar
            </x-button>
        </div>
    </form>
</div>
    
</x-admin-layout>