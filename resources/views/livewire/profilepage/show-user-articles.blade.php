<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-center justify-between px-4 py-2 bg-white dark:bg-gray-900">
        <label for="search-posts" class="sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" id="search-posts" wire:model="search"
                class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-fit bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search for posts">
        </div>

    </div>

    <!-- Get User's Posts -->
    <div class="flex flex-col items-start px-4 py-5 bg-white dark:bg-gray-900 sm:p-6">
        @foreach ($posts as $post)
        <div wire:key="post-{{ $post->id }}" class="w-full bg-white dark:bg-gray-900 flex flex-col">
            <a href="{{ route('posts.show', $post->slug) }}" class=" text-gray-950 hover:text-gray-800 transition-colors">
                <span class="font-bold text-ellipsis">{{ $post->title }}</span>
            </a>
            <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>

            <hr class="bg-gray-500 my-5">
        </div>
        @endforeach
        {{ $posts->links() }}
    </div>
