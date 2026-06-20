@if ($paginator->hasPages())
    <div class="flex items-center justify-between w-full">
        {{-- Desktop Text --}}
        <span class="hidden sm:inline font-body-md text-body-md text-secondary text-sm">
            {!! __('Menampilkan') !!}
            @if ($paginator->firstItem())
                <span class="font-medium text-on-surface">{{ $paginator->firstItem() }}</span>
                {!! __('hingga') !!}
                <span class="font-medium text-on-surface">{{ $paginator->lastItem() }}</span>
            @else
                {{ $paginator->count() }}
            @endif
            {!! __('dari') !!}
            <span class="font-medium text-on-surface">{{ $paginator->total() }}</span>
            {!! __('data') !!}
        </span>
        
        {{-- Mobile Text (shorter) --}}
        <span class="sm:hidden font-body-md text-body-md text-secondary text-sm">
            {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
        </span>

        <div class="flex gap-xs items-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <button class="p-xs text-secondary hover:bg-surface-container-low rounded transition-colors disabled:opacity-50 flex items-center justify-center" disabled>
                    <span class="material-symbols-outlined text-sm">chevron_left</span>
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="p-xs text-secondary hover:bg-surface-container-low rounded transition-colors inline-flex items-center justify-center">
                    <span class="material-symbols-outlined text-sm">chevron_left</span>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-sm py-xs text-secondary font-label-md text-label-md cursor-default">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-sm py-xs bg-primary text-on-primary rounded font-label-md text-label-md cursor-default">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-sm py-xs text-secondary hover:bg-surface-container-low rounded font-label-md text-label-md transition-colors inline-flex items-center justify-center">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="p-xs text-secondary hover:bg-surface-container-low rounded transition-colors inline-flex items-center justify-center">
                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                </a>
            @else
                <button class="p-xs text-secondary hover:bg-surface-container-low rounded transition-colors disabled:opacity-50 flex items-center justify-center" disabled>
                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                </button>
            @endif
        </div>
    </div>
@endif
