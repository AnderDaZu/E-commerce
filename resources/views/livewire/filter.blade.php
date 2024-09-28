<div class="">
    <x-cstm-container class="flex">
        @if (count($options))
            <aside class="w-52 flex-shrink-0 mr-8">
                <ul class="space-y-4">
                    @foreach ($options as $option)
                        <li x-data="{
                            open: true
                        }">
                            <button x-on:click="open = !open"
                                class="w-full px-4 py-2 bg-gray-200 text-gray-700 font-medium text-left flex justify-between items-center rounded-sm"
                                :class="{
                                    'shadow-none transition-shadow': !open,
                                    'shadow-md transition-shadow': open
                                }">
                                {{ $option->name }}
                                <i class="fa-solid transition-all" :class="{
                                    'fa-angle-right': !open,
                                    'fa-angle-down': open
                                }"></i>
                            </button>
                            <ul class="mt-2 space-y-1" x-show="open">
                                @foreach ($option->features as $feature)
                                    <li>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <x-checkbox class="mr-2 cursor-pointer" />
                                            <span>
                                                {{ $feature->description }}
                                            </span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </aside>
        @endif

        <div class="flex-1 space-y-6">
            <div class="flex items-center min-w-[250px] overflow-auto">
                <span class="min-w-[98px]">Ordenar por:</span>
                <x-cstm-select class="ml-4" wire:model="orderBy">
                    <option value="1">Relevancia</option>
                    <option value="2">Precio: mayor a menor</option>
                    <option value="3">Precio: menor a mayor</option>
                </x-cstm-select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                @foreach ($products as $product)
                    <article class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="{{ $product->image }}" class="h-56 object-cover object-center w-full" alt="">
                        <div class="w-full px-4 pb-5 pt-2 bg-gray-50">
                            <h3 class="text-base md:text-lg md:leading-5 font-semibold text-gray-700 hover:cursor-pointer line-clamp-2 min-h-[46px] flex items-center capitalize sm:mb-2"
                                title="{{ $product->name }}">
                                {{ $product->name }}
                            </h3>

                            <div class="flex justify-between">
                                <p class="text-sm"><span class="font-medium mr-2">COP</span> ${{ $product->price }}</p>
                                <a href="" class="text-sm italic text-blue-700 underline">Ver más</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            @if ( $products->hasPages() )
                <hr class="my-6">
            @endif

            <div>
                {{ $products->links() }}
            </div>
        </div>
    </x-cstm-container>
</div>
