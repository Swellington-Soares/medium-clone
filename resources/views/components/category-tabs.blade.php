
<ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400 justify-center">

    <li class="me-2">
        <a href="/" class="inline-block px-4 py-2 rounded-lg {{ request('category') ?: 'text-white bg-blue-600' }}" aria-current="page">All</a>
    </li>

    @forelse ($categories as $category)
        <li class="me-2">
            <a href="{{ route('posts.ByCategory', $category) }}" class="inline-block px-4 py-2  rounded-lg {{ Route::currentRouteNamed('posts.ByCategory') && request('category')->id == $category->id ? 'bg-blue-600 text-white active' : 'text-gray-400' }}"  aria-current="page">{{ $category->name }}</a>
        </li>
    @empty
        {{  $slot }}
    @endforelse
</ul>
