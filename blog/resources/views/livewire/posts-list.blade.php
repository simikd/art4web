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
                <x-post-card :post="$post"></x-post-card>
            @endforeach
        </div>
    </div>
    <x-alerts.delete-confirm></x-alerts.delete-confirm>
</div>
