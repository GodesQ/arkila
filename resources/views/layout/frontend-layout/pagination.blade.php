@if ($paginator->hasPages())
<div class="product-pagination">
    <div class="theme-paggination-block">
        <div class="row">
            <div class="col-xl-6 col-md-6 col-sm-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        @if ($paginator->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">Previous</a></li>
                        @endif

                        @foreach ($elements as $element)
                            @if (is_string($element))
                                <li class="page-item disabled">{{ $element }}</li>
                            @endif
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li class="page-item active">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        @if ($paginator->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
            <div class="col-xl-6 col-md-6 col-sm-12">
                {{-- <div class="product-search-count-bottom">
                    <h5>Showing Products 1-24 of 10 Result</h5>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endif
