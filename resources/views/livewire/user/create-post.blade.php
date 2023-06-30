<div class="flex flex-row justify-start" x-data="dataHandler()" x-init=" /* Watch the tags array if it changes console it */
 $watch('tags', () => {
     console.log(tags.toString());
     console.log($wire.tagCollection)
     $wire.set('tagCollection', tagsId);
 });
 /* Watch the categories array if it changes console it */
 $watch('categories', () => {
     console.log(categories.toString());
     console.log($wire.categoryCollection);
     $wire.set('categoryCollection', categoriesId);
 });" wire:ignore>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dataHandler', () => {
                return {
                    openTag: false,
                    openCategory: false,
                    tags: [],
                    tagsId: [],
                    categories: [],
                    categoriesId: [],
                    toggle(type) {
                        switch (type) {
                            case 'tag':
                                this.openTag ? this.close('tag') : this.openTag = true;
                                break;
                            case 'category':
                                this.openCategory ? this.close('category') : this.openCategory = true;
                                break;
                        }
                    },
                    close(type) {
                        switch (type) {
                            case 'tag':
                                this.openTag = false;
                                break;
                            case 'category':
                                this.openCategory = false;
                                break;
                        }
                    },
                    // push checked tags to the array
                    toggleCollection(tag, callingAction) {
                        // if tag is not in the array, add it else remove it
                        callingAction == 'tag' ? this.tags.includes(tag) ? this.tags.splice(this.tags
                                .indexOf(tag), 1) : this.tags.push(tag) : this.categories.includes(tag) ?
                            this.categories.splice(this.categories.indexOf(tag), 1) : this.categories.push(
                                tag);
                    },
                    toggleCollectionId(tag, callingAction) {
                        // if tag is not in the array, add it else remove it
                        callingAction == 'tag' ? this.tagsId.includes(tag) ? this.tagsId.splice(this.tagsId
                                .indexOf(tag), 1) : this.tagsId.push(tag) : this.categoriesId.includes(
                                tag) ? this.categoriesId.splice(this.categoriesId.indexOf(tag), 1) : this
                            .categoriesId.push(tag);
                    },
                }
            })
        });
    </script>
    <div class="flex flex-col justify-start items-center w-[90%]" wire:ignore>

        <x-banner />

        <div class="w-[71%] flex flex-col">
            <x-input-error for="title" />
            <x-label for="title" value="Title" />
            <x-input id="title" type="text" wire:model="title" />
        </div>
        {{-- <div id="toolbar"></div> --}}
        <div class="w-[71%] min-h-[500px] flex flex-col bg-white rounded-lg shadow-sm" id="quill-editor">



        </div>
        <x-input-error for="quill-editor" />


        <div class="w-8/12 flex justify-between">
            <div class="flex flex-row justify-evenly gap-2" wire:ignore>
                <!-- Tags Dropdown Menu -->
                <div class="w-8/12 mt-2 flex flex-col justify-between relative"
                    x-on:keydown.escape.prevent.stop="close('tag')">
                    <button id="dropdownTagSearchButton" x-on:click="toggle('tag')"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">Tag search <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdownTagSearch" class="absolute left-0 bottom-14 z-10 mt-2 w-56 rounded-md shadow-lg"
                        style="display: none;" x-show="openTag" x-on:click.outside="close('tag')">
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
                                <input type="text" id="input-tag-search"
                                    wire:model.debounce.500ms.prevent="tagSearch"
                                    class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search tags" autocomplete="off">
                            </div>
                        </div>
                        <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownTagSearchButton">
                            @foreach ($tags as $tag)
                                <li>
                                    <div
                                        class="flex items-center pl-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <input id="tag-{{ $tag->id }}" type="checkbox" value="{{ $tag->slug }}"
                                            x-on:click="toggleCollection('{{ $tag->slug }}', 'tag');
                                            toggleCollectionId('{{ $tag->id }}', 'tag')"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="tag-{{ $tag->id }}"
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
                </div>

                <!-- Category Dropdown Menu -->
                <div class="w-8/12 mt-2 flex justify-between relative"
                    x-on:keydown.escape.prevent.stop="close('category')" wire:ignore>
                    <button id="dropdownCategorySearchButton" x-on:click="toggle('category')"
                        class="w-44 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">Category search <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdownCategorySearch"
                        class="absolute left-0 bottom-14 z-10 mt-2 w-56 rounded-md shadow-lg" style="display: none;"
                        x-show="openCategory" x-on:click.outside="close('category')">
                        <div class="p-3">
                            <label for="input-category-search" class="sr-only">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-4 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"></path>
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
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
                                    <div
                                        class="flex items-center pl-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <input id="category-{{ $category->id }}" type="checkbox"
                                            value="{{ $category->slug }}"
                                            x-on:click="toggleCollection('{{ $category->slug }}', 'category');
                                            toggleCollectionId('{{ $category->id }}', 'category')"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="category-{{ $category->id }}"
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

            <div class="mt-2">
                <x-button wire:click="resetFields">Cancel</x-button>
                <x-button type="submit" wire:click.prevent="create">Submit</x-button>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="mt-4 -ml-48 flex flex-col">
        <span class="text-xl">Tags</span>
        <hr class="border-gray-300">
        <!-- Tags Selection -->
        <div class="flex flex-col flex-wrap gap-2 h-[50%] text-blue-500">
            <template x-for="tag in tags">
                <span class="text-xl leading-6" x-text="tag"></span>
            </template>
        </div>
        <!-- Category Selection -->
        <span class="text-xl">Categories</span>
        <hr class="border-gray-300">
        <div class="flex flex-col gap-2 text-sky-500">
            <template x-for="category in categories">
                <span class="text-xl leading-6" x-text="category"></span>
            </template>
        </div>
    </div>
    <!-- Add Quill Editor script -->
    {{-- <script src="//cdn.quilljs.com/1.3.6/quill.js"></script> --}}
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>

        const toolbarOptions = [
                     ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],

                    [{'header': 1}, {'header': 2}],
                    [{'list': 'ordered'}, {'list': 'bullet'}],
                    [{'script': 'sub'}, {'script': 'super'}],
                    [{'indent': '-1'}, {'indent': '+1'}],
                    [{'direction': 'rtl'}],

                    [{'size': ['small', false, 'large', 'huge']}],
                    [{'header': [1, 2, 3, 4, 5, 6, false]}],

                    [{'color': []}, {'background': []}],
                    [{'align': []}],
                    ['link', 'image', 'video'],
                    ['clean'],
                ];

        var quill = new Quill('#quill-editor', {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions,
            },
            placeholder: 'Type something...',

        });

        /* Capture text-change event on the quill editor and send it to livewire component CreatePost */
        quill.on('text-change', function() {
            let value = document.getElementById('quill-editor').innerHTML;
            @this.set('content', value);
        });
    </script>
</div>
