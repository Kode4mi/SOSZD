@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="table-footer--links page-navigator">
        <ul class="page-navigator__links-list">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-navigator__link" aria-disabled="true">
                    <span>
                        <i class="fa-solid fa-angle-left"></i>
                    </span>
                </li>
            @else
                <li class="page-navigator__link page-navigator__link--active">
                    <a class="page-navigator__inner-link main-window__a" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fa-solid fa-angle-left"></i>
                    </a>
                </li>
                <span class="page-navigator__dot"></span>
            @endif

                <li class="page-navigator__current-page">
                    <span>
                        {{$paginator->currentPage()}}
                    </span>
                </li>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <span class="page-navigator__dot"></span>
                <li class="page-navigator__link page-navigator__link--active">
                    <a class="page-navigator__inner-link main-window__a" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                </li>
            @else
                <li class="page-navigator__link" aria-disabled="true">
                    <span>
                        <i class="fa-solid fa-angle-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
