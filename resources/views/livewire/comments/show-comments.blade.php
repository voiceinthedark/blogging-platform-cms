<div>
    <!-- Write comment on Post -->
    <div class="mb-14" wire:ignore>
        <x-textarea-wireui id="comment-{{Str::uuid()}}" name="comment" label="{{ auth()->user()->name}}" placeholder="Write your thoughts here..." wire:model="comment">

        </x-textarea-wireui>
        <x-button-wireui blue class="mt-2" wire:click="storeComment()" wire:keydown.enter="storeComment()">Reply</x-button-wireui>

    </div>
    @foreach ($post->comments as $comment)
        <div x-data="{commentShow: false}">
            <div class="flex flex-col items-start">
                <span class="font-bold">{{ $comment->user->name }}</span>
                <span class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <div class="p-4 bg-gray-100 m-2 text-secondary-800 border rounded border-l-slate-700">
                {{ $comment->content }}
            </div>
            <div class="flex flex-row justify-end">
                <button class="text-blue-600" @click="commentShow = !commentShow" >Reply</button>
            </div>
            <div class="mb-4 mt-2 ml-12" x-show="commentShow" wire:target="comment" x-transition:enter="transition ease-in duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"  x-transition:leave="transition ease-out duration-200"
             wire:ignore>
                <x-textarea-wireui id="comment-{{$comment->id}}" name="comment" label="{{ auth()->user()->name}}" wire:model="comment">
                </x-textarea-wireui>
                <x-button-wireui blue class="mt-2" wire:click="storeComment({{ $comment->id }})" wire:keydown.enter="storeComment({{ $comment->id }})">Reply</x-button-wireui>
            </div>
        </div>
    @endforeach
</div>
