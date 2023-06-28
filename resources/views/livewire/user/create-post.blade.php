<div class="flex flex-col items-center ">
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dataHandler', () => {
                return {
                    open: false,
                    tags: [],
                    categories: [],
                    toggle() {
                        this.open = this.open ? this.close() : true
                    },
                    close() {
                        this.open = false
                    },
                    // push checked tags to the array
                    toggleCollection(tag, callingAction) {
                        // if tag is not in the array, add it else remove it
                        callingAction == 'tag' ? this.tags.includes(tag) ? this.tags.splice(this.tags.indexOf(tag), 1) : this.tags.push(tag) : this.categories.includes(tag) ? this.categories.splice(this.categories.indexOf(tag), 1) : this.categories.push(tag)


                    },
                }
            })
        })
    </script>

    <x-banner />

    <div class="w-8/12 flex flex-col">
        <x-label for="title" value="Title" />
        <x-input id="title" type="text" wire:model="title" />
        <x-input-error for="title" />
    </div>
    <div class="w-8/12 flex flex-col">
        <x-label for="content" value="Content" />
        <x-textarea class="min-h-[400px]" id="content" wire:model="content"> </x-textarea>
        <x-input-error for="content" />
    </div>


    <div class="w-8/12 flex justify-between">
        <div class="flex flex-row justify-evenly gap-2">
            <!-- Tags Dropdown Menu -->

                <div class="w-8/12 mt-2 flex flex-col justify-between relative"      x-data="dataHandler()"
                    x-init=" /* Watch the tags array if it changes console it */
                    $watch('tags', () => {
                        console.log(tags.toString());
                        $wire.set('tagCollection', tags);
                    })"
                    x-on:keydown.escape.prevent.stop="close()">
                    <button id="dropdownTagSearchButton" x-on:click="toggle()"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">Tag search <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdownTagSearch" class="absolute left-0 bottom-14 mt-2 w-56 rounded-md shadow-lg"
                        style="display: none;" x-show="open" x-on:click.outside="close()">
                        <div class="p-3">
                            <label for="input-tag-search" class="sr-only">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-4 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" id="input-tag-search" wire:model.debounce.500ms.prevent="tagSearch"
                                    class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search tags" autocomplete="off">
                            </div>
                        </div>
                        <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownTagSearchButton">
                            @foreach ($tags as $tag)
                                <li>
                                    <div class="flex items-center pl-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <input id="tag-{{$tag->id}}" type="checkbox" value="{{ $tag->id }}"
                                        x-on:click="toggleCollection({{ $tag->id }}, 'tag')"

                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="tag-{{$tag->id}}"
                                            class="w-full py-2 ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                            <div class="flex">
                                                {{ $tag->slug }}
                                                <x-icons.tag class="w-5 h-5 ml-2" name="{{ $tag->slug }}" />
                                            </div>
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- List of selected tags -->
                    {{-- <div>
                        <template x-for="tag in tags">
                            <span x-text="tag"></span>
                        </template>
                    </div> --}}
                </div>

            <!-- Category Dropdown Menu -->
            <div class="w-8/12 mt-2 flex justify-between relative" x-data="dataHandler()"
                x-on:keydown.escape.prevent.stop="close()">
                <button id="dropdownCategorySearchButton" x-on:click="toggle()"
                    class="w-44 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">Category search <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg></button>
                <!-- Dropdown menu -->
                <div id="dropdownCategorySearch" class="absolute left-0 bottom-14 mt-2 w-56 rounded-md shadow-lg"
                    style="display: none;" x-show="open" x-on:click.outside="close()">
                    <div class="p-3">
                        <label for="input-category-search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-4 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" id="input-category-search"
                                wire:model.debounce.500ms.prevent="categorySearch"
                                class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search categories" autocomplete="off">
                        </div>
                    </div>
                    <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownCategorySearchButton">
                        @foreach ($categories as $category)
                            <li>
                                <div class="flex items-center pl-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input id="category-{{$category->id}}" type="checkbox" value="{{ $category->id }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="category-{{$category->id}}"
                                        class="w-full py-2 ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                        <div class="flex">
                                            {{ $category->slug }}
                                        </div>
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div>
            <x-button wire:click="resetFields">Cancel</x-button>
            <x-button type="submit" wire:click.prevent="create">Submit</x-button>
        </div>
    </div>
</div>
