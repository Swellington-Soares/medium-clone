<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-8 p-4">
                <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf


                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="image" :value="__('Image')" />
                        <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" required autofocus />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="content" :value="__('Content')" />
                        <x-input-textarea id="content" class="block mt-1 w-full" name="content" :value="old('content')" required ></x-input-textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select name="category_id" id="category_id" class="block mt-1">
                            {{-- <x-text-input id="category_id" class="block mt-1 w-full" type="file" name="category_id" :value="old('category_id')" required autofocus /> --}}
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    @selected(old('category_id') == $category->id)
                                    >{{ $category->name }}</option>
                            @endforeach
                        </select>
                        {{-- <x-text-input id="category_id" class="block mt-1 w-full" type="file" name="category_id" :value="old('category_id')" required autofocus /> --}}
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <x-primary-button class="mt-4">
                        {{  __('Submit') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
