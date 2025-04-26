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
                        <x-user-avatar :user="$user" :size="'w-14 h-14'"/>
                        <h3>{{ $user->name }}</h3>
                        <p class="text-gray-500"> 26k Followers</p>
                        <p>{{ $user->bio }}</p>
                        <div>
                            <button class="bg-emerald-600 rounded-xl px-4 py-2  text-white">
                                Follow
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
