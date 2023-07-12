<div class="flex flex-col items-center justify-center w-full"  x-data="dataHandler()" x-init=" /* Watch the tags array if it changes console it */
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
                    wordCount: @entangle('wordCount'),
                    timeToRead: @entangle('timeToRead'),
                    tags: new Set(),
                    tagsArray: [],
                    tagInput: '',
                    categories: new Set(),
                    addTag() {
                        // get the tagInput array and insert the tag into the Set
                        this.tagInput.split(' ').forEach(tag => {
                            this.tags.add(tag);
                        });

                        this.tagsArray = Array.from(this.tags);

                        console.log(this.tagsArray);

                    },
                    removeTag(tag) {
                        console.log(tag);
                        this.tags.delete(tag);
                        this.tagsArray = Array.from(this.tags);
                    },
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

    <div class="flex flex-col items-center justify-center w-[80%]" wire:ignore>

        <x-banner />

        <div class="flex flex-col w-full">
            <x-label for="title" value="Title" />
            <x-input id="title" type="text" wire:model="title" />
            <x-input-error for="title" />
        </div>

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
            <div class="mt-2">
                <x-button type="submit" wire:click.prevent="create">Submit</x-button>
            </div>
        </div>
    </div>
    <!-- Tags and categories input -->
    <div class="w-[80%] flex flex-col">
        <x-input-wireui label='Tags' placeholder="input your tags" hint="Separate tags with spaces"
        x-on:keydown.enter="addTag" x-model="tagInput"/>
        <div class="flex flex-row gap-1">
            <template x-for="tag in tagsArray" :key="tag">
                <button type="button" x-on:click="removeTag(tag)">
                    <span name="tag" id="tag" class="p-1 text-xs font-semibold text-white bg-blue-500 rounded-lg bg-blend-lighten" x-text="tag"></span></button>
            </template>
        </div>

    </div>

    <!-- Add ToastUI Editor script -->
    <script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>
    <script>
        document.addEventListener('livewire:load', function() {
            const editor = new toastui.Editor({
                el: document.querySelector('#editor'),
                height: '500px',
                initialEditType: 'markdown',
                // previewStyle: 'vertical',
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
                    }
                }
            });

            // Loading data for editing

        });
    </script>
</div>
