@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center">
        <ul class="flex">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @php
                        $currentPage = $paginator->currentPage();
                        $lastPage = $paginator->lastPage();
                        $start = max($currentPage - 1, 1);
                        $end = min($currentPage + 1, $lastPage);

                        $showFirst = $currentPage > 3;
                        $showLast = $currentPage < $lastPage - 2;
                    @endphp

                    {{-- Show first page and dots --}}
                    @if ($showFirst)
                        <li><a href="{{ $element[1] }}">1</a></li>
                        @if ($currentPage > 4)
                            <li class="disabled" aria-disabled="true"><span>...</span></li>
                        @endif
                    @endif

                    {{-- Main loop --}}
                    @foreach (range($start, $end) as $page)
                        @if ($page == $currentPage)
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $element[$page] }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Show last page and dots --}}
                    @if ($showLast)
                        @if ($currentPage < $lastPage - 3)
                            <li class="disabled" aria-disabled="true"><span>...</span></li>
                        @endif
                        <li><a href="{{ $element[$lastPage] }}">{{ $lastPage }}</a></li>
                    @endif
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
