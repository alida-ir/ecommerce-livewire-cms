<!-- BEGIN: Pagination -->
@if ($paginator->hasPages())

<div style="display: flex;flex-direction: row-reverse;" class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
    @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)

    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            @else
                <li class="page-item link_paginate">
                    <button type="button" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="page-link " wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</button>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item link_paginate disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif
                <style>
                    .first_paginate > button{
                        width: 100%;
                        /*height: 100%;*/
                        padding: 10px 15px;
                    }
                    .link_active{
                        box-shadow: 0px 3px 20px #0000000b;
                        --bg-opacity: 1;
                        background-color: #fff;
                        background-color: rgba(255, 255, 255, var(--bg-opacity));
                        border-radius: 0.375rem;
                        position: relative;
                        font-weight: 500;
                    }
                    .link_paginate{
                        min-width: 40px;
                        margin-top: 0.5rem;
                        margin-bottom: 0.5rem;
                        margin-left: 0.75rem;
                        margin-right: 0.75rem;
                        border-radius: 0.375rem;
                        font-weight: 500;
                        cursor: pointer;
                        font-weight: 400;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border-color: transparent;
                        --text-opacity: 1;
                        color: #2d3748;
                        color: rgba(45, 55, 72);
                        margin-right: 0.5rem;
                    }
                    .link_paginate > button{
                        width: 100%;
                        height: 100%;
                        padding: 10px 15px;
                    }
                </style>
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item link_paginate link_active" wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item link_paginate" wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}"><button type="button" class="page-link" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</button></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item link_paginate">
                    <button type="button" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="page-link " wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</button>
                </li>
            @else
{{--                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">--}}
{{--                    <span class="page-link" aria-hidden="true">&rsaquo;</span>--}}
{{--                </li>--}}
            @endif
        </ul>
    </nav>
    <select wire:model="perPagePaginate" class="w-20 input box mt-3 sm:mt-0">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="50">50</option>
    </select>
</div>
@endif
<!-- END: Pagination -->
