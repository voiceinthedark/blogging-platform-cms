
<div x-data="{
    isRead: @entangle('message_is_read'),
    showReceivedMessage: false,
    showMessage(){
        console.log(this.isRead);
        this.isRead = true;
        this.showReceivedMessage = !this.showReceivedMessage;
        Livewire.emitTo('user.messages.inbox-message', 'messageRead');

    } }">
    <div>
        {{-- <div class="relative top-4 right-5" x-show="!isRead">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
            </svg>
        </div> --}}
        <div class="flex flex-col w-full p-2 mt-1 bg-white border-2 border-green-600 rounded-lg cursor-pointer" :class="isRead ? 'isread' : ''"
            @click="showMessage()">
            <span class="font-semibold">{{ $message->subject }}</span>
            <div class="flex justify-between">
                <span>From: {{ $message->sender->userprofile->username }}</span>
                <span>{{ $message->updated_at->diffForHumans() }}</span>
            </div>
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
                    {{ Str::of($message->content)->toHtmlString() }}
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
    <style>
        .isread {
            background-color: #e4e4e4;
            border: 2px solid #000;
        }
    </style>
</div>
