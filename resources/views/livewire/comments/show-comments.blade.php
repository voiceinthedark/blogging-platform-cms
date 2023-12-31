<div>
    <!-- Write comment on Post -->
    @if (Auth::check())
        <div class="mb-14" wire:ignore>
            <x-textarea-wireui id="comment-{{ Str::uuid() }}" name="comment"
                label="{{ '@' . auth()->user()->userprofile->username }}" placeholder="Write your thoughts here..."
                wire:model.debounce.500ms="comment">

            </x-textarea-wireui>
            <x-button-wireui blue class="mt-2" wire:click="storeComment()" wire:keydown.enter="storeComment()">Reply
            </x-button-wireui>

        </div>
    @endif

    @foreach ($comments as $comment)
        <div key="comment-{{ $comment->id }}" id="comment-{{ $comment->id }}" x-data="{
            commentShow: false,
            replyShow: false,
            }">
            <div class="flex flex-row items-start">
                <div class="mr-2">
                    <x-avatar md src="{{ url($comment->user->userprofile->profile_photo_url) }}" />
                </div>
                <div class="flex flex-col items-start">
                    <span class="font-bold">{{ '@' . $comment->user->userprofile->username }}</span>
                    <span class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
            </div>
            <div class="p-4 m-2 -mb-3 bg-gray-100 border rounded text-secondary-800 border-l-slate-700">
                {{ $comment->content }}
            </div>
            <livewire:post.comment-like-form :comment="$comment" key="comment-{{ $comment->id }}" />

            @auth
            <div class="flex flex-row justify-end -mt-3">
                <button class="text-blue-600" @click="commentShow = !commentShow">Reply</button>
            </div>
            @endauth
            <!-- If Comment has replies -->
            @if (!empty($comment->replies))
                @if (count($comment->replies) > 0)
                    <button type="button" class="mb-2 text-blue-600 transition-colors hover:text-blue-400"
                        x-on:click="replyShow = !replyShow"
                        x-text="replyShow ? 'hide ' + {{ count($comment->replies) }} + ' replies' : 'show ' + {{ count($comment->replies) }} + ' replies'"></button>
                @endif
                @foreach ($comment->replies as $reply)
                    <div key="reply-{{ $reply->id }}" id="reply-{{ $reply->id }}" x-data="{ replyTo: false, user: '@' + '{{ $reply->user->userprofile->username }}' }" x-show="replyShow" id="{{ $reply->id }}"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
                        <div class="ml-16">
                            <div class="flex flex-row items-start">
                                <div class="mr-2">
                                    <x-avatar md src="{{ url($reply->user->userprofile->profile_photo_url) }}" />
                                </div>
                                <div class="flex flex-col items-start">
                                    <span class="font-bold">{{ '@' . $reply->user->userprofile->username }}</span>
                                    <span class="text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div class="p-4 m-2 -mb-3 bg-gray-100 border rounded text-secondary-800 border-l-slate-700">
                                {{ $reply->content }}
                            </div>
                            <livewire:post.comment-like-form :comment="$reply" key="reply-{{ $reply->id }}" />

                            <div class="flex flex-row justify-end -mt-4">
                                <button type="button" class="text-blue-600" x-on:click="replyTo = !replyTo">
                                    Reply</button>
                            </div>


                            <div x-show="replyTo">
                                <x-textarea-wireui wire:model.debounce.500ms="comment" id="reply-{{ $reply->id }}"
                                    x-model="user" x-on:input="comment = user + $event.target.value"
                                    placeholder="Reply..." class="mt-2"></x-textarea-wireui>
                                <x-button-wireui blue class="mt-2"
                                    wire:click.prevent="storeComment({{ $comment->id }})"
                                    wire:keydown.enter.prevent="storeComment({{ $comment->id }})"
                                    x-on:click="replyTo = !replyTo">Reply</x-button-wireui>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="mt-2 mb-4 ml-12" x-show="commentShow" wire:target="comment"
                x-transition:enter="transition ease-in duration-200" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-200" wire:ignore>
                <x-textarea-wireui id="comment-{{ $comment->id }}" name="comment"
                    label="{{ Auth::check() ? auth()->user()->name : '' }}" wire:model.debounce.500ms="comment">
                </x-textarea-wireui>
                <x-button-wireui blue class="mt-2" wire:click="storeComment({{ $comment->id }})"
                    wire:keydown.enter="storeComment({{ $comment->id }})">Reply</x-button-wireui>
            </div>
        </div>
    @endforeach

    {{ $comments->links() }}
</div>
