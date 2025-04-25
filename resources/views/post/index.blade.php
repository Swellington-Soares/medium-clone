<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x:category-tabs>
                        No categories
                    </x:category-tabs>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-8 p-4">

                @forelse ($posts as $post)
                    <x:post-item :post="$post" />
                @empty
                    <div class="flex flex-col items-center justify-center h-64">
                        <h2 class="text-gray-500">No posts available</h2>
                    </div>
                @endforelse

            </div>

            {{ $posts->onEachSide(1)->links() }}
        </div>
    </div>
</x-app-layout>
