<div class="px-6 pt-4 pb-2">
    @foreach($tags as $tag)
        <span
{{--                Filter by tag if clicked --}}
            @if($filter) wire:click="filterByTag('{{ $tag->name }}')" @endif
            class="
                @if ($filter)
                    @if ($tagFilter === $tag->name)
                    border border-gray-900
                    @endif
                    cursor-pointer
                @endif
                inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2
            ">
            {{ $tag->name }}
        </span>
    @endforeach
        @if($filter && $tagFilter)
{{--            Reset tag filter --}}
            <span
                wire:click="filterByTag('')"
                class="cursor-pointer inline-block bg-gray-900 rounded-full px-3 py-1 text-sm font-semibold text-gray-100 mr-2 mb-2
            ">
            show all
        </span>
        @endif
</div>
