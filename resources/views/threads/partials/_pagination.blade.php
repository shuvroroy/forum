@if ($paginator->hasPages())
    <ul class="flex list-reset rounded" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="block text-indigo bg-grey-light px-4 py-3 rounded-l border border-indigo" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li>
                <a class="block no-underline bg-white text-indigo hover:bg-indigo hover:text-white px-4 py-3 rounded-l border border-indigo" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="block text-indigo bg-grey-light px-4 py-3 rounded-r border border-indigo" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="block no-underline bg-indigo text-white px-4 py-3 border border-indigo" aria-current="page"><span>{{ $page }}</span></li>
                    @else
                        <li><a class="block no-underline bg-white text-indigo hover:bg-indigo hover:text-white px-4 py-3 border border-indigo" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a class="block no-underline bg-white text-indigo hover:bg-indigo hover:text-white px-4 py-3 border border-indigo" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="block text-indigo bg-grey-light px-4 py-3 rounded-r border border-indigo" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
@endif
