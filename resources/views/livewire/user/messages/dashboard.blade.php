<div class="flex flex-col items-center justify-center px-4 py-4" x-data="{
    search: @entangle('search'),
    showCreateModal: false,
    showReceivedMessage: false,
    users: {{ $users }},
    filteredUsers: [],
    selectedUser: {},
    message_recipient: '',
    message_content: '',
    message_subject: '',
    message_sender: '',
    CreateModal(){
        this.showCreateModal = !this.showCreateModal;
        // console.log(this.users.map(user => user.email));
    },
    filterUsers(){
        const searchValue = this.search.trim().toLowerCase();

        if (searchValue === '') {
            this.filteredUsers = [];
            return;
        }
        this.filteredUsers = this.users.filter(user => {
            return user.email.toLowerCase().includes(searchValue.toLowerCase());
        });
    },
    selectUser(user){
        this.selectedUser = user;
        // console.log(this.selectedUser);
        this.search = user.email;
        console.log(this.search);
        const msg_rec = document.querySelector('#message_recipient');
        msg_rec.value = user.email;
        console.log(msg_rec.value);
        this.filteredUsers = [];
        console.log(this.filteredUsers);
        $refs.search.blur();
    },
}">

    <x-button @click="CreateModal()">Compose new Message</x-button>

    <!-- Create Message -->
    <div id="create-message-modal"
        class="fixed top-0 bottom-0 left-0 right-0 z-10 p-2 mx-auto my-auto border border-blue-700 w-[500px] h-[500px] overflow-x-hidden overflow-y-auto bg-white"
        x-cloak x-show="showCreateModal" :class="{'blur-sm': !showCreateModal}">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="col-span-1 sm:col-span-2">
                <!-- Recipient -->
                <x-input-wireui id="message_recipient" label="Recipient" placeholder="Send a message to"
                    x-model="search" wire:model="message_recipient" x-ref="search" @input="filterUsers" />
                <x-input-error for="message_recipient" class="mt-2" />

                <!-- Users Lookup Search -->
                <div class="relative z-20 bg-gray-50" x-show="search.length > 0 && filteredUsers.length > 0" x-cloak>
                    <div class="absolute top-0 z-30 flex items-center w-full pl-3 rounded-sm bg-gray-50">
                        <div class="flex flex-col flex-shrink-0">
                            <ul class="pl-2">

                                <template x-if="filteredUsers != []">
                                    <template x-for="user in filteredUsers" :key="user.email">
                                        <li class="cursor-pointer hover:bg-gray-100 text-slate-900" x-text="user.email"
                                            @click="selectUser(user)"></li>
                                    </template>
                                </template>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Subject -->
                <x-input-wireui id="message_subject" label="Subject" placeholder="Subject"
                    wire:model.debounce.500ms="message_subject" />
                <x-input-error for="message_subject" class="mt-2" />
            </div>
            <!-- Message -->
            <div class="w-full col-span-2 rounded-sm">
                <x-textarea-wireui id="message_content" name="message" label="Message" placeholder="Message"
                    class="h-[260px]" wire:model.debounce.500ms="message_content" />
                <x-input-error for="message_content" class="mt-2" />
            </div>
        </div>
        <div id="footer">
            <div class="flex justify-between gap-x-4">
                <div class="flex gap-1">
                    <x-button-wireui secondary label="Cancel" x-on:click="showCreateModal = false" />
                    <x-button-wireui primary label="Send" wire:click="save" />
                </div>
            </div>
        </div>
    </div>

    <!-- Received Messages -->
    <div class="grid w-full grid-cols-2 gap-4">
        <div class="w-full place-self-start">
            <div class="text-xl">Inbox</div>
            @forelse ($inboxMessages as $message)
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
                        <x-input-wireui id="message_sender-{{ $message->id }}" label="Sender"
                            value="{{ $message->sender->email }}" disabled />
                        <x-input-wireui id="message_subject-{{ $message->sender_id }}" label="Subject"
                            value="{{ $message->subject }}" disabled />
                    </div>
                    <div class="w-full col-span-2 rounded-sm">
                        <x-textarea-wireui id="message_content-{{ $message->id }}" name="message" label="Message"
                            class="h-[260px]" disabled>{{
                            $message->content }}</x-textarea-wireui>
                    </div>
                </div>
                <div id="footer">
                    <div class="flex justify-between gap-x-4">
                        <div class="flex gap-1">
                            <x-button-wireui secondary label="Cancel" x-on:click="showReceivedMessage = false" />
                        </div>
                    </div>
                </div>
            </div>

            @empty
            <span>No messages yet</span>
            @endforelse
        </div>
        <!-- Sent Messages -->
        <div class="w-full place-self-start">
            <div class="text-xl">Outbox</div>
            @forelse ($outboxMessages as $message)
                <x-messages.message-mini-card :message="$message" />
            @empty
            <span>No messages yet</span>
            @endforelse

        </div>
    </div>
</div>
