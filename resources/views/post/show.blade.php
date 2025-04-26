<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-8 p-4">
                <h1 class="text-5xl mb-4 text-green">{{ $post->title }}</h1>


                <div class="flex gap-4">
                    <x-user-avatar :user="$post->user" />
                    <div>
                        <div class="flex gap-2">
                            <h3 class="hover:underline">
                                <a href="{{ route('profile.show', $post->user) }}">{{ $post->user->name }}</a>
                            </h3>
                            @if (!Auth::user()->is($post->user))
                                @auth
                                  <x-follow-container :user="$post->user">
                                    &middot;
                                    <button @click="follow"
                                    x-text="following ? 'Unfollow' : 'Follow'"
                                    class="cursor-pointer"
                                    :class="following ? 'text-red-500 hover:text-red-700' : 'text-emerald-500 hover:text-emerald-700'">
                                  </button>
                                </x-follow-container>
                                @endauth
                            @endif
                        </div>
                        <div class="flex gap-2 text-gray-500 text-sm">
                            {{ $post->readTime() }}
                            &middot;
                            {{ $post->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </div>


                <div class="flex mt-4 border-t-2 border-b-2 items-center">
                    <button
                        class="flex gap-2 items-center text-gray-500 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:ring-offset-2 rounded-full">
                        <x-like-icon class="w-5" />
                        3.2k
                    </button>
                </div>


                <div class="mt-4">
                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="w-full h-auto rounded-lg">
                </div>



                <div class="mt-4">
                    <p class="text-gray-700 text-lg">
                        {{ $post->content }}
                    </p>
                </div>

                <div class="flex gap-4 mt-4">
                    <div
                        class="mt-4  items-center bg-gray-500 text-white rounded-full px-4 py-2">
                        {{ $post->category->name }}
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
