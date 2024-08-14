@if (count($breadcrumbs))
    <nav class="flex flex-col mb-2 md:mb-6 items-start sm:items-center justify-center" aria-label="Breadcrumb">
        <ol class="flex flex-wrap items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            @foreach ($breadcrumbs as $breadcrumb)
                <li class="{{ !$loop->first ? "inline-flex items-center pl-2 before:float-left before:mr-2 before:content-['>']" : 'inline-flex items-center' }}">
                    @isset($breadcrumb['route'])
                        <a href="{{ $breadcrumb['route'] }}"
                            class="inline-flex items-center justify-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400">
                            @if ( $loop->first )
                                <svg class="w-3 h-3 mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                </svg>
                            @endif
                            {{ $breadcrumb['name'] }}
                        </a>
                    @else
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                            {{ $breadcrumb['name'] }}
                        </span>
                    @endisset
                </li>
            @endforeach
        </ol>

        @if ( count($breadcrumbs) > 1 )
            <h6 class="text-xs sm:text-sm font-bold uppercase">{{ ( isset(end($breadcrumbs)['focus']) && end($breadcrumbs)['focus'] ) ? end($breadcrumbs)['focus'] : end($breadcrumbs)['name'] }}</h6>
        @endif
    </nav>
@endif