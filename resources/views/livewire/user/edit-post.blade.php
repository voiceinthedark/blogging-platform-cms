<div class="flex flex-col items-center justify-center w-full" x-data="dataHandler({{ $post->tags }}, {{ $post->categories }})" x-init=" /* Watch the tags array if it changes console it */
 $watch('tagsArray', () => {
     console.log(tagsArray);
     $wire.set('tags', tagsArray);
 });
 /* Watch the categories array if it changes console it */
 $watch('categoriesArray', () => {
     console.log(categoriesArray);
     $wire.set('categories', categoriesArray);
 });" wire:ignore>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dataHandler', (tags, categories) => {
                // console.log(tags, categories);
                const tagsNames = tags.map(tag => tag.name);
                const categoriesNames = categories.map(category => category.name);

                return {
                    wordCount: @entangle('wordCount'),
                    timeToRead: @entangle('timeToRead'),
                    tagsArray: @entangle('tags'),
                    tags: new Set(this.tagsArray),
                    categoriesArray: @entangle('categories'),
                    categories: new Set(this.categoriesArray),
                    tagInput: tagsNames.join(' '),
                    categoryInput: categoriesNames.join(' '),
                    addTag() {
                        // console.log(this.tagInput);
                        // get the tagInput array and insert the tag into the Set
                        this.tagInput?.toLowerCase().trim().split(/\s+/g).forEach(tag => {
                            this.tags.add(tag);
                        });
                        this.tagsArray = Array.from(this.tags);
                        // console.log(this.tagsArray);
                    },
                    removeTag(tag) {
                        this.tags = new Set(this.tagsArray);
                        // console.log(this.tags);
                        this.tags.delete(tag);
                        this.tagsArray = Array.from(this.tags);
                        // console.log(this.tagsArray);
                    },
                    addCategory() {
                        this.categoryInput.toLowerCase().trim().split(/\s+/g).forEach(category => {
                            this.categories.add(category);
                        });
                        this.categoriesArray = Array.from(this.categories);
                        console.log(this.categoriesArray);
                    },
                    removeCategory(category) {
                        this.categories = new Set(this.categoriesArray);
                        this.categories.delete(category);
                        this.categoriesArray = Array.from(this.categories);
                    },
                }
            })
        });
    </script>

    <div class="flex flex-col items-center justify-center w-[80%]" wire:ignore>

        <x-banner />

        <!-- Title -->
        <div class="flex flex-col w-full">
            <x-label for="title" value="Title" />
            <x-input id="title" type="text" wire:model="title" />
            <x-input-error for="title" />
        </div>

         <!-- description -->
        <div class="flex flex-col w-full">
            <x-textarea-wireui id="description" label="Description" hint="This will show up in the search results" wire:model="description">
                {{ $post->description }}
            </x-textarea-wireui>
            @error("description")
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Content -->
        <div class="flex flex-col w-full space-y-2">
            <label for="editor" class="font-semibold text-gray-600">Content</label>
            <div id="editor" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
            </div>
        </div>
        <x-input-error for="editor" />


        <div class="flex w-full justify-evenly">
            <div><span class="text-sm">Word Count: </span>
                <span class="text-sm" x-text="wordCount"></span>
            </div>
            <div>
                <span class="text-sm">Estimated time to read: </span>
                <span x-text="timeToRead"></span>
            </div>
        </div>
    </div>
    <!-- Tags and categories input -->
    <div class="w-[80%] flex flex-col">
        <x-input-wireui label='Tags' placeholder="input your tags"
            hint="Separate tags with spaces; you can click on a tag to remove it from the list"
            x-on:keydown.enter="addTag" x-model="tagInput" />
        <div class="flex flex-row gap-1">
            <template x-for="tag in tagsArray" :key="tag">
                <button type="button" x-on:click="removeTag(tag)">
                    <span name="tag" id="tag-{{ Str::uuid() }}"
                        class="p-1 text-xs font-semibold text-white bg-blue-500 rounded-lg bg-blend-lighten"
                        x-text="tag"></span>
                </button>
            </template>
        </div>
    </div>

    <div class="w-[80%] flex flex-col">
        <x-input-wireui label='Categories' placeholder="input your categories"
            hint="Separate categories with spaces; you can click on a category to remove it from the list"
            x-on:keydown.enter="addCategory" x-model="categoryInput" />
        <div class="flex flex-row gap-1">
            <template x-for="category in categoriesArray" :key="category">
                <button type="button" x-on:click="removeCategory(category)">
                    <span name="category" id="category"
                        class="p-1 text-xs font-semibold text-white bg-blue-500 rounded-lg bg-blend-lighten"
                        x-text="category"></span>
                </button>
            </template>
        </div>
    </div>

    <div class="flex justify-end w-[80%]">
        <div class="mt-2">
            <x-button type="submit" wire:click.prevent="update">Submit</x-button>
        </div>
    </div>

    <!-- Add ToastUI Editor script -->
    <!-- Chart plugin -->
    <script src="https://uicdn.toast.com/chart/latest/toastui-chart.min.js"></script>
    <!-- Editor -->
    <script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>
    <!-- Editor's chart Plugin -->
    <script src="https://uicdn.toast.com/editor-plugin-chart/latest/toastui-editor-plugin-chart.min.js"></script>
    <!-- Editor's syntax highlight Plugin -->
    <script
        src="https://uicdn.toast.com/editor-plugin-code-syntax-highlight/latest/toastui-editor-plugin-code-syntax-highlight-all.min.js">
    </script>
    <!-- Color Picker -->
    <script src="https://uicdn.toast.com/tui-color-picker/latest/tui-color-picker.min.js"></script>
    <!-- Editor's color Syntax Plugin -->
    <script src="https://uicdn.toast.com/editor-plugin-color-syntax/latest/toastui-editor-plugin-color-syntax.min.js">
    </script>
    <!-- Editor's table merged cell Plugin -->
    <script
        src="https://uicdn.toast.com/editor-plugin-table-merged-cell/latest/toastui-editor-plugin-table-merged-cell.min.js">
    </script>
    <!-- Editor's UML Plugin -->
    <script src="https://uicdn.toast.com/editor-plugin-uml/latest/toastui-editor-plugin-uml.min.js"></script>

    <script>
        const {
            Editor
        } = toastui;
        const {
            chart,
            codeSyntaxHighlight,
            colorSyntax,
            tableMergedCell,
            uml,

        } = Editor.plugin;

        const chartOptions = {
            minWidth: 100,
            maxWidth: 600,
            minHeight: 100,
            maxHeight: 300
        };

        document.addEventListener('livewire:load', function() {
            const editor = new toastui.Editor({
                el: document.querySelector('#editor'),
                height: '500px',
                initialEditType: 'markdown',
                // previewStyle: 'vertical',
                plugins: [
                    [chart, chartOptions],
                    [codeSyntaxHighlight, {
                        highlighter: Prism
                    }], colorSyntax, tableMergedCell, uml
                ],
                events: {
                    change: function() {
                        let value = editor.getMarkdown();
                        @this.set('content', value);
                        // Get the text from the editor and split it into an array by words
                        // then send it to livewire component CreatePost and entangle the value of wordCount with Alpinejs
                        let text = document.getElementById('editor').innerText;
                        let words = text.trim().split(/[\r\n\s]+/);
                        @this.set('wordCount', words.length);
                        Livewire.emit('getReadingTime', words.length);
                    },

                }
            });
            // console.log(content);
            editor.setMarkdown(@this.get('content'));
        });
    </script>
</div>
