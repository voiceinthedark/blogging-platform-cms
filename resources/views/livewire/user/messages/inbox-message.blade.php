<div>
    <div class="flex flex-col w-full p-2 mt-1 bg-white border border-black rounded-lg cursor-pointer"
        @click="showReceivedMessage = true">
        <span class="font-semibold">{{ $message->subject }}</span>
        <div class="flex justify-between">
            <span>From: {{ $message->sender->userprofile->username }}</span>
            <span>{{ $message->created_at->diffForHumans() }}</span>
        </div>
    </div>
    <!-- Received message modal -->
    <div id="show-received-message-{{ $message->id }}"
        class="fixed top-0 bottom-0 left-0 right-0 z-10 p-2 mx-auto my-auto border border-blue-700 w-[500px] h-[500px] overflow-x-hidden overflow-y-auto bg-white"
        x-cloak x-show="showReceivedMessage">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="col-span-1 sm:col-span-2">
                <x-input-wireui id="message_sender-{{ $message->id }}" label="Sender" value="{{ $message->sender->email }}"
                    disabled />
                <x-input-wireui id="message_subject-{{ $message->sender_id }}" label="Subject"
                    value="{{ $message->subject }}" disabled />
            </div>
            <div class="w-full col-span-2 rounded-sm">
                <div class="h-[250px] w-full bg-white rounded-lg border border-gray-400 p-2 font-extralight text-gray-600" wire:model='message_content' disabled>
                    {{ $message->content }}
                </div>
            </div>
            <div class="w-full col-span-2 rounded-sm">
                <x-input-wireui id="message_reply-{{ $message->id }}" label="Reply" wire:model='message_reply' placeholder="Reply to {{ $message->sender->email }}" />
            </div>
        </div>
        <div id="footer">
            <div class="flex justify-between gap-x-4">
                <div class="flex gap-1">
                    <x-button-wireui secondary label="Cancel" x-on:click="showReceivedMessage = false" />
                    <x-button-wireui primary label="Reply" wire:click="reply" />
                </div>
            </div>
        </div>
    </div>
</div>
