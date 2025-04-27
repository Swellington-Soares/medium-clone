@props(['category'])

<div class="flex gap-4 mt-4">
    <a href="{{ route('posts.ByCategory', $category) }}" class="mt-4  items-center bg-gray-500 text-white rounded-full px-4 py-2">
        {{ $category->name }}
    </a>
</div>
