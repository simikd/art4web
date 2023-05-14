<div class="bg-white rounded overflow-hidden shadow-lg mb-10">
    @if($post->file)
        <a href="{{ route('post.show', ['post' => $post]) }}">
            <img class="w-full"
                 src="{{ $post->file->path }}"
                 alt="{{ $post->title }}"
            >
        </a>
    @endif
    <div class="px-6 py-4">
        <div class="flex">
            <h2 class="font-bold text-xl mb-2">
                <a href="{{ route('post.show', ['post' => $post]) }}">{{ $post->title }}</a>
            </h2>
            @if((!isset($hideIcons) || !$hideIcons) && $post->user_id === Auth::id())
                <div class="ml-auto flex">
                    <a class="mr-4" href="{{ route('post.edit', ['post' => $post]) }}" >
                        @svg('heroicon-o-pencil', 'w-5 h-5')
                    </a>
                    <a href="#" wire:click="$emit('triggerDelete',{{ $post->id }})">
                        @svg('heroicon-o-trash', 'w-5 h-5')
                    </a >
                </div>
            @endif
        </div>
        <div class="text-gray-700 text-base">{{ $post->description }}</div>
    </div>

    <x-tags :tags="$post->tags" :filter="true" :tagFilter="$tagFilter"></x-tags>

    <div class="text-right m-4">
        <a href="{{ route('post.show', ['post' => $post]) }}">
            <x-button.secondary class="ml-4">
                {{ __('Read more...') }}
            </x-button.secondary>
        </a>
    </div>
</div>
