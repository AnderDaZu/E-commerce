<div class="mt-4">
    <section class="bg-gray-50 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
        <div
            class="flex flex-col xs:flex-row xs:justify-between items-center border-b-2 border-gray-200 dark:border-gray-700">
            <header class="p-3 sm:p-4 md:p-6">
                <h2 class="text-base sm:text-lg font-semibold text-gray-700 dark:text-gray-200 uppercase">Opciones</h2>
            </header>

            <div class="pb-4 xs:pb-0 xs:pr-6">
                <button wire:click="$set('openModal', true)" class="btn btn-blue hover:cursor-pointer"
                    @disabled( $options->count() == 0 )
                    title="Agregar opción">+</button>
            </div>
        </div>

        <div class="p-6">
            @if ( $product->options->count() )
                <div class="space-y-6">
                    @foreach($product->options as $option)
                        {{-- @dump($option->toArray()) --}}
                        <div wir:key="product-option-{{ $option->id }}"
                            class="p-6 rounded-lg border border-gray-200 dark:border-gray-700 relative">
                            <div class="absolute -top-3 px-2 bg-gray-50 dark:bg-gray-800">
                                <button class="" title="Eliminar opción"
                                    onclick="confirmDelete({{ $option->id }}, {{ $option }}, 'option')">
                                    <i class="fa-solid fa-trash-can text-red-700 hover:text-red-900 dark:text-gray-400 dark:hover:text-gray-500 focus:outline-none font-medium text-sm text-center"></i>
                                </button>
                                <span class="ml-1 sm:ml-2 text-[10px] md:text-xs uppercase text-gray-700 dark:text-gray-200">{{ $option->name }}</span>
                            </div>
                            {{-- valores --}}
                            <div class="flex flex-wrap gap-2 mt-3">
                                {{-- <div class="grid grid-cols-[repeat(auto-fit,minmax(120px,1fr))] gap-2 justify-center items-center text-center"> --}}
                                    @foreach ($option->pivot->features as $feature)
                                        {{-- @dump($feature) --}}
                                        @switch($option->type)
                                            @case(1)
                                                <span class="bg-gray-200 text-gray-800 text-xs font-medium capitalize me-2 px-1 sm:pl-2.5 sm:pr-2 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-400 hover:cursor-pointer" title="{{ $option->name }}: {{ $feature['value'] }}">
                                                    {{ $feature['description'] }}
                                                    <button onclick="confirmDelete({{ $option->id }}, {{ $feature['id'] }}, 'feature', '{{ $option->name }}', '{{ $feature['value'] }}', '{{ $feature['description'] }}')">
                                                        <i class="fa-solid fa-circle-xmark ml-1 btn-delete" title="Eliminar valor"></i>
                                                    </button>
                                                </span>
                                                @break
                                            @case(2)
                                                <div class="relative">
                                                    <span class="inline-block h-7 w-7 xs:h-8 xs:w-8 shadow-lg rounded-full border-2 border-gray-300 dark:border-gray-700 hover:cursor-pointer" style="background-color: {{ $feature['value'] }}" title="{{ $feature['description'] }}"></span>
                                                    <button class="absolute z-10 right-3 -top-1 h-[15px] rounded-full" onclick="confirmDelete({{ $option->id }}, {{ $feature['id'] }}, 'feature', '{{ $option->name }}', '{{ $feature['value'] }}', '{{ $feature['description'] }}')">
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
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex items-center text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                      <span class="font-medium">Atención!</span> Aún no se han vinculado opciones.
                    </div>
                  </div>
            @endif
        </div>
    </section>

    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            <h3 class="uppercase text-base sm:text-lg md:text-xl font-semibold">
                Agregar Opción
            </h3>
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <label for="variant.option_id" title="Opción que se relaciona con el producto" class="text-base sm:text-lg font-medium">Opción</label>
                <x-cstm-select name="" id="variant.option_id" class="mt-1" wire:model.live="variant.option_id">
                    <option value="" disabled>Seleccione una opción</option>
                    @foreach($options as $option)
                        <option value="{{$option->id}}">{{$option->name}}</option>
                    @endforeach
                </x-cstm-select>
                <x-input-error for="variant.option_id" class="mt-2" /> 
            </div>

            <div class="flex items-center mb-4">
                <hr class="flex-1">
                <h4 class="mx-2 text-base sm:text-lg font-medium">Variantes</h4>
                <hr class="flex-1">
            </div>

            <x-input-error for="variant.features" class="mt-2" /> 

            <ul class="space-y-4">
                @foreach ($variant['features'] as $index => $feature)
                    <li wire:key="variant-feature-{{ $index }}"
                        class="border border-gray-200 rounded-lg p-6 relative">
                        <span class="absolute -top-2.5 px-2 bg-slate-300 hover:bg-slate-400 hover:text-gray-50 transition-all rounded-md hover:cursor-pointer font-bold text-sm" title="Valor #{{ $index + 1 }}">{{ $index + 1 }}</span>
                        <div class="grid grid-cols-1 @if ($loop->count > 1 && $loop->last) sm:grid-cols-[auto_80px] @else sm:grid-cols-[auto_40px] @endif gap-2 sm:gap-4">
                            <div>
                                <label class="mb-1" >Valores</label>
                                <x-cstm-select wire:model.live="variant.features.{{ $index }}.id"
                                    wire:change="featureChange({{ $index }})"
                                    name="variant.features.{{ $index }}.id">
                                    <option value="" disabled>Seleccione un valor</option>
                                    @foreach ($this->features as $feature)
                                        <option value="{{ $feature->id }}">{{ $feature->value }} - <span class="lowercase text-xs">{{ $feature->description }}</span></option>
                                    @endforeach
                                </x-cstm-select>
                            </div>
                            <div class="flex justify-end gap-2 sm:relative">
                                @if ( !$loop->last )
                                    <button wire:click="removeFeature({{ $index }})" class="btn-square btn-red hover:cursor-pointer sm:absolute sm:bottom-0 sm:start-0" title="Quitar valor"><span class="px-[1px]">-</span></button>
                                @else
                                    @if ( $loop->count > 1)
                                        <button wire:click="removeFeature({{ $index }})" class="btn-square btn-red hover:cursor-pointer sm:absolute sm:bottom-0 sm:start-0" title="Quitar valor"><span class="px-[1px]">-</span></button>
                                        <button wire:click="addFeature" 
                                        @disabled( $this->isDisabled($variant['features'][$index]['id']) )
                                        class="btn-square btn-blue hover:cursor-pointer sm:absolute sm:bottom-0" title="Agregar valor">+</button>
                                    @else
                                        <button wire:click="addFeature" 
                                        @disabled( $this->isDisabled($variant['features'][$index]['id']) )
                                        class="btn-square btn-blue hover:cursor-pointer sm:absolute sm:bottom-0" title="Agregar valor">+</button>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <x-input-error for="variant.features.{{ $index }}.id" class="mt-2" /> 
                    </li>
                @endforeach
            </ul>
        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-col xs:flex-row xs:justify-end gap-2 w-full xs:w-auto">
                <button wire:click="$set('openModal', false)" class="btn-square btn-cancel text-base">Cancelar</button>
                <button wire:click="save" class="btn-square btn-blue text-base">Guardar</button>
            </div>
        </x-slot>
    </x-dialog-modal>

    @push('js')
        <script>
            function confirmDelete(optionId, object, type, optionName, objectName = '', objectDescription = '') {
                Swal.fire({
                    title:
                        type == 'feature' 
                        ? `¿Deseas borrar de la opción "${optionName}" el valor: ${truncateString(objectDescription)}?`
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
                                @this.deleteFeature(object, optionId);   
                                break;
                            case 'option':
                                @this.deleteOption(object, optionId);   
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
