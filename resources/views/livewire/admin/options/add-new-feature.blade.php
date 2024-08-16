<div>
    {{-- @dump($newFeature['value'])
    @dump($newFeature['description']) --}}

    <form wire:submit="addFeature" class="grid grid-cols-1 md:grid-cols-[auto_auto_80px] gap-4 sm:gap-2 mt-2">
        <div class="">
            <label for="" class="text-sm">Valor</label>
            @switch($option->type)
                @case(1)
                    <x-input class="w-full py-1.5 px-2 text-sm text-gray-700" wire:model.live="newFeature.value"
                        placeholder="Ingrese el valor de la opción" />
                @break
    
                @case(2)
                    <div class="border w-full bg-white h-[34px] rounded-md px-2 flex items-center justify-between gap-6">
                        <span class="text-sm sm:text-[12px] lg:text-sm text-gray-500 leading-[12px]">{{ $newFeature['value'] ?: 'Sel. un color' }}</span>
                        <input type="color" class="" wire:model.live="newFeature.value"
                            placeholder="Ingrese el valor de la opción" />
                    </div>
                @break
    
                @default
            @endswitch
        </div>
        <div>
            <label for="" class="text-sm">Descripción</label>
            <x-input type="text" class="w-full py-1.5 px-2 text-sm text-gray-700"
                placeholder="Ingrese la descripción de la función" wire:model.live="newFeature.description" />
        </div>
        <div class="xs:flex xs:justify-end md:relative">
            <button class="w-full xs:w-auto md:absolute md:bottom-0 text-sm flex justify-center xs:inline-flex btn-square btn-blue hover:cursor-pointer py-1.5  "
                title="Agregar valor"
                @disabled( $this->isDisabled($newFeature['value'], $newFeature['description']) ) >
                Agregar
            </button>
        </div>
    </form>
</div>
