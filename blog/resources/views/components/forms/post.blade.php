<form method="POST" action="{{ route($route, $post ?? null) }}">
    @csrf
    @if(isset($method))
        @method($method)
    @endif
    <div class="pt-8">
        <x-label :label="'title'"></x-label>
        <input
                id="title"
                autocomplete="off"
                class="block mt-1 w-full focus:outline-none focus:ring-0 border
                                border-gray-300 bg-gray-50 rounded-lg"
                placeholder="Post title"
                type="text"
                name="title"
                value="{{ $post->title ?? old('title')}}"
                autofocus
        >
        @error('title')
        <div class="mt-2 ml-2 text-sm text-red-800 " role="alert">
            <span class="font-medium">{{ $message }}</span>
        </div>
        @enderror
    </div>

    <div class="py-8">
        <x-label :label="'description'"></x-label>
        <textarea
                placeholder="Describe your post's content. (To be shown in post's card on main page)"
                id="description"
                class="block p-2.5 w-full bg-gray-50 rounded-lg border
                            border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                name="description"
        >{{ $post->description ?? old('description') }}</textarea>
        @error('description')
        <div class="mt-2 ml-2 text-sm text-red-800 " role="alert">
            <span class="font-medium">{{ $message }}</span>
        </div>
        @enderror
    </div>

    <div>
        <x-input.tinymce placeholder="Post content" value="{{ $post->body ?? old('body') }}" name="body" />
    </div>

    @error('body')
    <div class="mt-2 ml-2 text-sm text-red-800 " role="alert">
        <span class="font-medium">{{ $message }}</span>
    </div>
    @enderror

    <div class="py-5">
        <x-label :label="'Select or create new tags.'" :for="'tags'"></x-label>
        <select class="w-full bg-gray-50 rounded-lg border border-gray-300"
                id="tags" name="tags[]" multiple
        >
{{--            For creating post--}}
            @if(old('tags')))
                @foreach((old('tags')) as $tag)
                    <option value="{{ $tag }}" selected>
                        {{ $tag }}
                    </option>
                @endforeach
            @endif

{{--            For editing post--}}
            @if(isset($post) && empty(old('tags')))
                @foreach($post->tags as $tag)--}}
                <option value="{{ $tag->name }}" selected>
                    {{ $tag->name }}
                </option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="flex flex-row-reverse p-4">
        <x-button.submit class="ml-4" >
            {{ __('Save post') }}
        </x-button.submit>
        <a href="{{ route('dashboard') }}">
            <x-button.secondary>
                {{ __('Cancel') }}
            </x-button.secondary>
        </a>
    </div>
</form>
