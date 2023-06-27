<div class="flex flex-col items-center">
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

    <!-- Tags Dropdown Menu -->
    <div class="w-8/12 mt-2 flex justify-between relative"
    x-data="{
        open: false,
        toggle() {
            this.open = this.open ? this.close() : true
        },
        close() {
            this.open = false
        }
    }"
    x-on:keydown.escape.prevent.stop="close()"
    >

        <button id="dropdownTagSearchButton"
            x-on:click="toggle()"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">Tag search <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg></button>

        <!-- Dropdown menu -->
        <div id="dropdownTagSearch"
            class="absolute left-0 bottom-14 mt-2 w-56 rounded-md shadow-lg"
         x-show="open"
         x-on:click.outside="close()">
            <div class="p-3">
                <label for="input-group-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-4 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" id="input-group-search" wire:model.debounce.500ms.prevent="tagSearch"
                        class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search tags" autocomplete="off">
                </div>
            </div>
            <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
                aria-labelledby="dropdownTagSearchButton">

                @foreach ($tags as $tag)
                    <li>
                        <div class="flex items-center pl-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input id="checkbox-item-16" type="checkbox" value=""
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="checkbox-item-16"
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

        <div>
            <x-button wire:click="resetFields">Cancel</x-button>
            <x-button type="submit" wire:click.prevent="create">Submit</x-button>
        </div>
    </div>
</div>
