<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex">
                    <div class="flex-1">
                        <h1 class="text-5xl">{{ $user->name }}</h1>
                        <div class="mt-8">
                            @forelse ($posts as $post)
                                <x-post-item :post="$post" />
                            @empty
                                <p>No post avaiable</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="flex flex-col px-8">
                        <x-follow-container :user="$user">
                            <x-user-avatar :user="$user" :size="'w-14 h-14'"/>
                            <h3>{{ $user->name }}</h3>
                            <p class="text-gray-400">
                                <span x-text="followerCount"></span> followers
                            </p>

                            <p class="mt-4">{{ $user->bio }}</p>
                            @if (auth()->user() && auth()->user()->id !== $user->id)
                                <div class="w-full mt-4">
                                    <button @click="follow"
                                    :class="following
                                        ? 'bg-red-600 text-white'
                                        : 'bg-emerald-600 text-white'"
                                    class=" rounded-xl px-4 py-2  text-white w-full"
                                    x-text="following ? 'Unfollow' : 'Follow'">

                                    </button>
                                </div>
                            @endif
                        </x-follow-container>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
