<div class="self-center w-full px-4" x-data="searchBar()"
x-on:keyup.escape="dropdownOpen = false"
>
    <x-input-wireui icon="search" placeholder="Search for posts" class="text-gray-900"
        x-on:input.debounce.500ms="Livewire.emitTo('search.search-bar', 'searchValueChange', $event.target.value)"
        x-on:search.window="results = $event.detail.results" x-on:click="dropdownOpen = !dropdownOpen"
        >

    </x-input-wireui>

    <div x-show="dropdownOpen" class="relative" x-on:click.outside="dropdownOpen = false"
    >
        <div
            class="absolute left-0 z-20 w-full bg-white divide-y-2 divide-gray-400 rounded-lg shadow-lg shadow-slate-500 divide-dotted ">
            <template class="" x-for="(post, index) in paginatedResults" :key="index">
                <button x-on:click="$wire.emit('show-post', post)" class="flex">
                    <div class="flex flex-col py-2 hover:bg-gray-200">
                        <div class="py-1 mx-2 mt-1 text-xs " x-text="post.title"></div>
                        <div class="px-4 mx-2 text-xs" x-text="(post.excerpt).substring(0, 20)"></div>
                    </div>
                </button>
            </template>
            <div class="flex justify-start gap-2 mt-4 text-sm">
                <button type="button" class="text-gray-500 hover:underline" x-on:click="currentPage = currentPage - 1" :disabled="currentPage === 1">Previous</button>
                <button type="button" class="text-gray-500 hover:underline" x-on:click="currentPage = currentPage + 1"
                    :disabled="currentPage * itemsPerPage >= results.length">Next</button>
            </div>
        </div>

        <script>
            let searchBar = () => {
                return {
                    dropdownOpen: false,
                    results: [],
                    currentPage: 1,
                    itemsPerPage: 5,
                    get paginatedResults() {
                        const start = (this.currentPage - 1) * this.itemsPerPage;
                        const end = start + this.itemsPerPage;
                        return this.results.slice(start, end);
                    }
                }
            };
        </script>

    </div>

</div>
