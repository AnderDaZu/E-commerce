<div>
    <div class="bg-gray-50 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col xs:flex-row xs:justify-between items-center border-b-2 border-gray-200 dark:border-gray-700">
            <header class="p-3 sm:p-4 md:p-6">
                <h2 class="text-base sm:text-lg font-semibold text-gray-700 dark:text-gray-200 uppercase">Opciones</h2>
            </header>
            
            <div class="pb-4 xs:pb-0 xs:pr-6">
                <a wire:click="$set('newOption.openModal', true)" class="btn btn-blue hover:cursor-pointer" title="Agregar opción">+</a>
            </div>
        </div>

        <div class="p-6">
            <div class="space-y-6">
                @foreach ($options as $option)
                    <div class="relative p-3 sm:p-4 md:p-5 rounded-lg border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200"
                        wire:key="{{ 'option-' . $option->id }}">
                        
                        <div class="absolute -top-3 bg-gray-100 dark:bg-gray-700 rounded-md px-2 text-xs sm:text-sm font-semibold border-2 dark:border-[1px] border-gray-200 dark:border-gray-600"> 
                            {{ $option->name }}
                            <button onclick="confirmDelete({{ $option }}, 'option')" class="ml-4" title="Eliminar opción"><i class="fa-solid fa-trash-can btn-delete"></i></button>
                        </div>

                        {{-- valores --}}
                        <div class="flex flex-wrap gap-2 mt-3">
                        {{-- <div class="grid grid-cols-[repeat(auto-fit,minmax(120px,1fr))] gap-2 justify-center items-center text-center"> --}}
                            @foreach ($option->features as $feature)
                                @switch($option->type)
                                    @case(1)
                                        <span class="bg-gray-200 text-gray-800 text-xs font-medium capitalize me-2 px-1 sm:pl-2.5 sm:pr-2 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-400 hover:cursor-pointer" title="{{ $option->name }}: {{ $feature->value }}">
                                            {{ $feature->description }}
                                            <button onclick="confirmDelete({{ $feature }}, 'feature', '{{ $option->name }}')">
                                                <i class="fa-solid fa-circle-xmark ml-1 btn-delete" title="Eliminar valor"></i>
                                            </button>
                                        </span>
                                        @break
                                    @case(2)
                                        <div class="relative">
                                            <span class="inline-block h-7 w-7 xs:h-8 xs:w-8 shadow-lg rounded-full border-2 border-gray-300 dark:border-gray-700 hover:cursor-pointer" style="background-color: {{ $feature->value }}" title="{{ $feature->description }}"></span>
                                            <button class="absolute z-10 right-3 -top-1 h-[15px] rounded-full" onclick="confirmDelete({{ $feature }}, 'feature', '{{ $option->name }}')">
                                                <div class="relative">
                                                    <i class="fa-solid fa-circle-xmark text-red-700 hover:text-red-900 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium text-sm text-center dark:text-gray-400 dark:hover:text-gray-500 dark:focus:ring-red-900 absolute -top-1.5 bg-gray-200 dark:bg-gray-800 rounded-full" title="Eliminar valor"></i>
                                                </div>
                                            </button>
                                        </div>
                                        @break
                                    @default
                                        
                                @endswitch
                            @endforeach
                        </div>

                        @livewire('admin.options.add-new-feature', compact('option'), key('add-new-feature-' . $option->id))
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <x-dialog-modal wire:model="newOption.openModal">

        <x-slot name="title">
            Crear opción
        </x-slot>
        
        <x-slot name="content">

            <x-validation-errors class="mb-4" />

            <div class="grid grid-cols-1 xs:grid-cols-2 gap-4 mb-4">
                <div> 
                    <label title="Nombre de la opción, campo requerido." for="newOption.name">Nombre*</label>
                    <x-input class="w-full mt-1" wire:model="newOption.name" id="newOption.name" placeholder="Por ejemplo: Tamaño, Color" />
                </div>
                <div>
                    <label title="Tipo de la opción, campo requerido." for="newOption.type">Tipo*</label>
                    <x-cstm-select class="mt-1" wire:model.live="newOption.type" id="newOption.type">
                        <option value="1">Texto</option>
                        <option value="2">Color</option>
                    </x-cstm-select>
                </div>
            </div>

            <div class="flex items-center mb-4">
                <hr class="flex-1">
                <span class="mx-4">Valores</span>
                <hr class="flex-1">
            </div>

            <div class="mb-4 space-y-4">
                @foreach ($newOption->features as $index => $feature)
                    <div class="p-6 rounded-lg border border-gray-200 relative" wire:key="{{ $index }}">
                        <span class="absolute -top-2.5 px-2 bg-slate-300 rounded-md hover:cursor-pointer font-bold text-sm" title="Valor #{{ $index + 1 }}">{{ $index + 1 }}</span>
                        <div class="grid grid-cols-1 @if ($loop->count > 1 && $loop->last) sm:grid-cols-[auto_auto_80px] @else sm:grid-cols-[auto_auto_40px] @endif gap-2 sm:gap-4">
                            <div>
                                <label class="mb-1" >Valor</label>
                                @switch($newOption->type)
                                    @case(1)
                                        <x-input class="w-full" 
                                            wire:model.live="newOption.features.{{ $index }}.value" 
                                            placeholder="Ingrese el valor de la opción" />                                        
                                        @break
                                    @case(2)
                                        <div class="border border-gray-200 h-[38px] sm:h-[42px] rounded-md px-2 flex items-center justify-between gap-6">
                                            <span class="w-[130px]">{{ $newOption->features[$index]['value'] ?: 'Selecciona un color'  }}</span>
                                            <input type="color" class="" 
                                                wire:model.live="newOption.features.{{ $index }}.value" 
                                                placeholder="Ingrese el valor de la opción" />
                                        </div>
                                        @break
                                    @default
                                        
                                @endswitch
                            </div>
                            <div>
                                <label class="mb-1" >Descripción</label>
                                <x-input class="w-full py-1.5 sm:py-2 px-2 sm:px-3" wire:model.live="newOption.features.{{ $index }}.description" placeholder="Ingrese la descripción de la opción" />
                            </div>
                            <div class="flex justify-end gap-2 sm:relative">
                                @if ( !$loop->last )
                                    <button wire:click="removeFeature({{ $index }})" class="btn-square btn-red hover:cursor-pointer sm:absolute sm:bottom-0 sm:start-0" title="Quitar valor"><span class="px-[1px]">-</span></button>
                                @else
                                    @if ( $loop->count > 1)
                                        <button wire:click="removeFeature({{ $index }})" class="btn-square btn-red hover:cursor-pointer sm:absolute sm:bottom-0 sm:start-0" title="Quitar valor"><span class="px-[1px]">-</span></button>
                                        <button wire:click="addFeature" 
                                        @disabled( $this->isDisabled($newOption->features[$index]['value'], $newOption->features[$index]['description']) )
                                        class="btn-square btn-blue hover:cursor-pointer sm:absolute sm:bottom-0" title="Agregar valor">+</button>
                                    @else
                                        <button wire:click="addFeature" 
                                        @disabled( $this->isDisabled($newOption->features[$index]['value'], $newOption->features[$index]['description']) )
                                        class="btn-square btn-blue hover:cursor-pointer sm:absolute sm:bottom-0" title="Agregar valor">+</button>
                                    @endif
                                @endif
                            </div>
                            <div class="flex justify-end sm:relative">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button class="w-full xs:w-auto flex justify-center" wire:click="addOption()">
                Crear
            </x-button>
        </x-slot>
    </x-dialog-modal>

    @push('js')
        <script>
            function confirmDelete(object, type, optionName) {
                Swal.fire({
                    title:
                        type == 'feature' 
                        ? `¿Deseas borrar de la opción "${optionName}" el valor: ${truncateString(object.description)}?`
                        : `¿Deseas borrar la opción: ${truncateString(object.name)}?`,
                    text: "No podras revertir esto!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, borrar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        switch (type) {
                            case 'feature':
                                @this.deleteFeature(object);   
                                break;
                            case 'option':
                                @this.deleteOption(object);   
                                break;
                        
                            default:
                                break;
                        }
                    }
                });
            }

            function truncateString(str) {
                if (str.length > 20) {
                    return str.slice(0, 20) + '...';
                }
                return str;
            }
        </script>
    @endpush
</div>