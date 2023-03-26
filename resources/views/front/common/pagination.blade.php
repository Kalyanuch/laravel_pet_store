@if ($paginator->hasPages())
    <div class="product_pagination">
        <ul>
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled page-item" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span>0{{ $page }}.</span></li>
                        @else
                            <li><a href="{{ $url }}">0{{ $page }}.</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
    </div>
@endif

