<div>
    <x-slot name="header">
        <a href="{{ route('post.create') }}">
            <x-button.primary class="ml-4 float-right">
                {{ __('Create new post') }}
            </x-button.primary>
        </a>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Most recent posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-1/2 mx-auto sm:px-6 lg:px-8">
            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 my-4 rounded relative" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            @foreach($posts as $post)
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
                            <div class="ml-auto flex">
                                @if($post->user_id === Auth::id())
                                    <a class="mr-4" href="{{ route('post.edit', ['post' => $post]) }}" >
                                        @svg('heroicon-o-pencil', 'w-5 h-5')
                                    </a>
                                    <a href="#" wire:click="$emit('triggerDelete',{{ $post->id }})">
                                       @svg('heroicon-o-trash', 'w-5 h-5')
                                    </a >
                                @endif
                            </div>
                        </div>
                        <div class="text-gray-700 text-base">{{ Str::of(strip_tags($post->body))->words(50) }}</div>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        @foreach($post->tags as $tag)
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                            {{ $tag->name }}
                        </span>
                        @endforeach
                    </div>
                    <div class="text-right m-4">
                        <a href="{{ route('post.show', ['post' => $post]) }}">
                            <x-button.secondary class="ml-4">
                                {{ __('Read more...') }}
                            </x-button.secondary>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <x-alerts.delete-confirm></x-alerts.delete-confirm>
</div>
