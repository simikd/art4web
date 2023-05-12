<x-app-layout>
    <div>
        <x-slot name="header">
            @if($post->user_id === Auth::id())
                <a class="mr-4" href="{{ route('post.edit', ['post' => $post]) }}" >
                    <x-button.primary class="ml-4 float-right">
                        {{ __('Edit post') }}
                    </x-button.primary>
                </a>
            @endif
        </x-slot>
        <div class="py-12">
            <div class="bg-white w-3/4 mx-auto sm:px-6 lg:px-8">
                <h1 class="text-4xl font-extrabold py-6 text-center">
                    {{ $post->title }}
                </h1>
                <div class="py-6">
                    {!! $post->body !!}
                </div>
                <div class="px-6 pt-4 pb-2">
                    @foreach($post->tags as $tag)
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                            {{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>