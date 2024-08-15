<div>
    <div class="bg-gray-50 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
        <header class="border-b-2 border-gray-200 dark:border-gray-700 p-3 sm:p-4 md:p-6">
            <h2 class="text-base sm:text-lg font-semibold text-gray-700 dark:text-gray-200 uppercase">Opciones</h2>
        </header>

        <div class="p-6">
            <div class="space-y-6">
                @foreach ($options as $option)
                    <div class="relative p-3 sm:p-4 md:p-5 rounded-lg border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200">
                        <div class="absolute -top-3 bg-gray-100 dark:bg-gray-700 rounded-md px-2 text-xs sm:text-sm font-semibold border-2 dark:border-[1px] border-gray-200 dark:border-gray-600"> 
                            {{ $option->name }}
                        </div>

                        {{-- valores --}}
                        <div class="flex flex-wrap gap-2">
                        {{-- <div class="grid grid-cols-[repeat(auto-fit,minmax(120px,1fr))] gap-2 justify-center items-center text-center"> --}}
                            @foreach ($option->features as $feature)
                                @switch($option->type)
                                    @case(1)
                                        <span class="bg-gray-200 text-gray-800 text-xs font-medium capitalize me-2 px-1 sm:px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-400">{{ $feature->description }}</span>
                                        @break
                                    @case(2)
                                        <span class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-300 dark:border-gray-700" style="background-color: {{ $feature->value }}" title="{{ $feature->description }}"></span>
                                        @break
                                    @case(3)
                                        <span class="bg-gray-200 text-gray-800 text-xs font-medium capitalize me-2 px-1 sm:px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-400">{{ $feature->description }}</span>
                                        @break
                                    @default
                                        
                                @endswitch
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>