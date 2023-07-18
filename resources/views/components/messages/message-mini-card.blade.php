<div x-data="{showModal: false}" >
    <div class="flex flex-col w-full p-2 mt-1 bg-white border border-black rounded-lg cursor-pointer"
        @click="showModal = true" wire:key="message-{{ $message->id }}">
        <span class="font-semibold">{{ $message->subject }}</span>
        <div class="flex justify-between gap-1">
            <span>to: {{ $message->recipient->userprofile->username }}</span>
            <span>{{ $message->created_at->diffForHumans() }}</span>
        </div>
    </div>

    <!-- Sent message modal -->
    <div id="show-sent-message-{{ $message->id }}"
        class="fixed top-0 bottom-0 left-0 right-0 z-10 p-2 mx-auto my-auto border border-black rounded-lg shadow-sm w-[500px] h-[500px] overflow-x-hidden overflow-y-auto bg-white"
        x-cloak x-show="showModal">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="col-span-1 sm:col-span-2">
                <x-input-wireui id="message_recipient-{{ $message->recipient_id }}" label="Recipient"
                    value="{{ $message->recipient->email }}" disabled />
                <x-input-wireui id="message_subject-{{ $message->recipient_id }}" label="Subject"
                    value="{{ $message->subject }}" disabled />
            </div>
            <div class="w-full col-span-2 rounded-sm">
                <x-textarea-wireui id="message_content-{{ $message->id }}" name="message" label="Message" class="h-[260px]"
                    disabled>{{ Str::of($message->content)->toHtmlString() }}</x-textarea-wireui>
            </div>
        </div>
        <div id="footer">
            <div class="flex justify-between gap-x-4">
                <div class="flex gap-1">
                    <x-button-wireui secondary label="Cancel" x-on:click="showModal = false" />
                </div>
            </div>
        </div>
    </div>
</div>
