<div>
    <form wire:submit="addFeature" class="grid grid-cols-1 md:grid-cols-[auto_80px] gap-4 sm:gap-2 {{ $productType == 1 ? 'mt-3' : 'mt-1' }}">
        <div class="">
            <label for="" class="text-sm text-gray-700 dark:text-gray-200 mb-1">Valor</label>
            <x-cstm-select wire:model.live="featureSelected" class="py-1.5 px-2 text-sm text-gray-700">
                <option value="">Seleccione un valor</option>
                @foreach ($featuresFree as $item)
                    <option value="{{ $item['id'] }}">{{ $item['value'] }} - {{ $item['description'] }}</option>
                @endforeach
            </x-cstm-select>
        </div>
        <div class="xs:flex xs:justify-end md:relative">
            <button class="w-full xs:w-auto md:absolute md:bottom-0 text-sm flex justify-center xs:inline-flex btn-square btn-blue hover:cursor-pointer py-1.5"
                title="Agregar valor"
                @disabled( $this->isDisabled($featureSelected) )>
                Agregar
            </button>
        </div>
    </form>
    <x-input-error for="featureSelected"  class="mt-1"/>
</div>
