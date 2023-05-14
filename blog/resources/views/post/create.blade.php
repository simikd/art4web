<x-app-layout>
    <div class="py-12">
        <div class="bg-white w-3/4 mx-auto sm:px-6 lg:px-8">
           <x-forms.post :route="'post.store'" :tags="old('tags')" :message="$message ?? ''"></x-forms.post>
        </div>
    </div>

    @push('scripts')
        <x-input.select2-tags></x-input.select2-tags>
    @endpush
</x-app-layout>
