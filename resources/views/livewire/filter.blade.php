<div class="bg-white py-12">
    <x-cstm-container class="flex">
        <aside class="w-52 flex-shrink-0 mr-8">
            <ul class="space-y-4">
                @foreach ($options as $option)
                    <li x-data="{
                        open: true
                    }">
                        <button x-on:click="open = !open" class="w-full px-4 py-2 bg-gray-200 text-gray-700 font-medium text-left flex justify-between items-center rounded-sm">
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

        <div class="flex-1">

        </div>
    </x-cstm-container>
</div>
