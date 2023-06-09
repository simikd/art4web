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

                <x-tags :tags="$post->tags" :filter="false"></x-tags>

            </div>
        </div>

        @if(!empty($similarPosts))
            <div class="w-1/2 mx-auto sm:px-6 lg:px-8">
                <div class="text-center mb-4">
                    <h2 class="text-2xl font-bold leading-none tracking-tight text-gray-900 " >Check out these similar posts as well!</h2>
                </div>
                @foreach($similarPosts as $post)
                    <x-post-card :post="$post" :hideIcons="true" :filter="false"></x-post-card>
                @endforeach
            </div>
        @endif

    </div>
</x-app-layout>
