<div class="self-center px-4" x-data="{ dropdownOpen: false, results: [], currentPage: 1, itemsPerPage: 5}">
    <x-input-wireui icon="search" placeholder="Search for posts" class="text-gray-900"
        x-on:input.debounce.500ms="Livewire.emitTo('search.search-bar', 'searchValueChange', $event.target.value)"
        x-on:search.window="results = $event.detail.results.data" x-on:click="dropdownOpen = !dropdownOpen">

    </x-input-wireui>

    <div x-show="dropdownOpen" class="relative">
        <div
            class="absolute left-0 z-20 w-[500px] rounded-lg shadow-lg shadow-slate-500 bg-white divide-y-2 divide-gray-400 divide-dotted">
            <template class="" x-for="(post, index) in results" :key="index">
                <div class="flex flex-col py-2">
                    <div class="py-4 mx-2 mt-2 text-sm hover:bg-gray-200" x-text="post.title"></div>
                    <div class="px-4 mx-2 text-xs" x-text="(post.content).substring(0, 20)"></div>
                </div>
            </template>

        </div>

    </div>

</div>
