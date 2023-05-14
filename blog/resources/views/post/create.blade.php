<x-app-layout>
    <div class="py-12">
        <div class="bg-white w-3/4 mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('post.store') }}">
                @csrf
                <div class="py-8">
                    <input
                            id="title"
                            autocomplete="off"
                            class="form-control @error('title') is-invalid @enderror
                                block mt-1 w-full focus:outline-none focus:ring-0 border-none bg-gray-100 rounded-lg"
                            placeholder="Post title"
                            type="text"
                            name="title"
                            value="{{old('title')}}"
                            autofocus
                    >
                    @error('title')
                    <div class="mt-2 ml-2 text-sm text-red-800 " role="alert">
                        <span class="font-medium">{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                <div>
                    <x-input.tinymce placeholder="Post content" value="{{old('body')}}" name="body" />
                </div>

                @error('body')
                <div class="mt-2 ml-2 text-sm text-red-800 " role="alert">
                    <span class="font-medium">{{ $message }}</span>
                </div>
                @enderror

                <div class="flex py-5">
                    <label for="tags" hidden>Select or create new tags.</label>
                    <select class="form-control w-full border-none bg-gray-100 rounded-lg" id="tags" name="tags[]" multiple>
                        @if(old('tags'))
                            @foreach(old('tags') as $tag)
                                <option value="{{ $tag }}" selected>
                                    {{ $tag }}
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
        </div>
    </div>

    @push('scripts')
        <x-input.select2-tags></x-input.select2-tags>
    @endpush
</x-app-layout>
