<div>
    @if ($paginator->hasPages())
        <div class="pagination">
            @if ($paginator->onFirstPage())
                <a class="page-number prev disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <i class="fa fa-angle-left"></i>
                </a>
            @else
                <a dusk="previousPage" class="page-number prev disabled" wire:click="previousPage" wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="fa fa-angle-left"></i>
                </a>
            @endif

            {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="page-number current">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="page-number current" wire:key="paginator-page-{{ $page }}" aria-current="page">{{ $page }}</span>
                            @else
                                <a class="page-number" wire:key="paginator-page-{{ $page }}" wire:click="gotoPage({{ $page }})">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a dusk="nextPage" class="page-number next" wire:click="nextPage" wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')">
                        <i class="fa fa-angle-right"></i>
                    </a>
                @else
                    <a class="page-number next disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <i class="fa fa-angle-right"></i>
                    </a>
                @endif
        </div>
    @endif
</div>
