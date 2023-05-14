<x-app-layout>
    <div class="py-12">
        <div class="bg-white w-3/4 mx-auto sm:px-6 lg:px-8">
            <x-forms.post
                    :route="'post.update'"
                    :post="$post"
                    :tags="$post->tags"
                    :message="$message ?? ''"
                    :method="'PUT'"
            ></x-forms.post>
{{--            <form method="POST" action="{{ route('post.update', $post) }}">--}}
{{--                @csrf--}}
{{--                @method('PUT')--}}
{{--                <div class="flex py-8">--}}
{{--                    <input--}}
{{--                            id="title"--}}
{{--                            autocomplete="off"--}}
{{--                            class="form-control @error('title') is-invalid @enderror--}}
{{--                                block mt-1 w-full focus:outline-none focus:ring-0 border-none bg-gray-100 rounded-lg"--}}
{{--                            placeholder="Post title"--}}
{{--                            type="text"--}}
{{--                            name="title"--}}
{{--                            value="{{ $post->title }}"--}}
{{--                            autofocus--}}
{{--                    >--}}
{{--                    @error('title')--}}
{{--                    <span class="text-danger">{{ $message }}</span>--}}
{{--                    @enderror--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    <x-input.tinymce placeholder="Post content" name="body" value="{{ $post->body }}"/>--}}
{{--                </div>--}}

{{--                <div class="flex py-5">--}}
{{--                    <label for="tags" hidden>Select or create new tags.</label>--}}

{{--                    <select--}}
{{--                           class="form-control w-full border-none bg-gray-100 rounded-lg"--}}
{{--                           id="tags"--}}
{{--                           name="tags[]"--}}
{{--                           multiple--}}
{{--                    >--}}
{{--                        @foreach($post->tags as $tag)--}}
{{--                            <option value="{{ $tag->name }}" selected>--}}
{{--                                {{ $tag->name }}--}}
{{--                            </option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}

{{--                <div class="flex flex-row-reverse p-4">--}}
{{--                    <x-button.submit class="ml-4" >--}}
{{--                        {{ __('Save post') }}--}}
{{--                    </x-button.submit>--}}

{{--                    <a href="{{ route('dashboard') }}">--}}
{{--                        <x-button.secondary>--}}
{{--                            {{ __('Cancel') }}--}}
{{--                        </x-button.secondary>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </form>--}}
        </div>
    </div>

    @push('scripts')
        <x-input.select2-tags></x-input.select2-tags>
    @endpush
</x-app-layout>

