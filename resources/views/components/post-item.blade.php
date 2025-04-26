<div
    class="flex-nowrap mb-4 flex flex-col bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row hover:bg-gray-100 ">

    <div class="flex flex-col  p-4 leading-normal flex-1">
        <h5 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 ">
            <a href="{{ route(
    'posts.show',
    [
        'username' => $post->user->username,
        'post' => $post->slug
    ]
) }}">
                {{$post->title}}
            </a>
        </h5>
        <p class="mb-3 font-normal text-gray-700 ">{{ Str::words($post->content, 15) }}</p>
        <div class="flex">
            <a href="{{ route('posts.show', ['username' => $post->user->username, 'post' => $post->slug]) }}">
                <x-primary-button>
                    Read more
                </x-primary-button>
            </a>
        </div>
    </div>
    <img class="object-cover w-full h-48 md:w-40 md:rounded-r-lg" src="{{ Storage::url($post->image) }}"
        alt="Post Image">

</div>
