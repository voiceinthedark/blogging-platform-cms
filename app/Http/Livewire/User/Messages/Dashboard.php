<?php

namespace App\Http\Livewire\User\Messages;

use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{

    protected $listeners = [
        'replySent' => 'updateInboxMessages',
    ];
    protected $rules = [
            'message_recipient' => 'bail|required|exists:users,email|email',
            'message_subject' => 'required|string|min:5|max:25',
            'message_content' => 'required|string|min:5|max:255',
    ];

    public $inboxMessages;
    public $outboxMessages;
    public $message_sender;
    public $message_recipient;
    public $message_subject;
    public $message_content;
    public $users;
    public $search;
    public $message_reply;
    public $message_is_read;

    public function mount(){
        $this->inboxMessages = auth()->user()->received_messages ;
        $this->outboxMessages = auth()->user()->sent_messages;
        $this->users = User::all();
        $this->search = '';
        $this->message_is_read = 0;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedMessageReply($message){
        $this->emitTo('messages.inbox-message', 'updatedMessageReply', $message);
    }

    public function updateInboxMessages(){
        $this->inboxMessages = auth()->user()->received_messages;
        $this->outboxMessages = auth()->user()->sent_messages;
        $this->message_is_read = 0;
    }

    public function save(){
        $this->validate($this->rules, [
            'message_recipient.required' => 'You must enter a recipient.',
            'message_subject.required' => 'You must enter a subject.',
            'message_content.required' => 'You must enter a content.',
        ], [
            'message_recipient' => 'Recipient',
            'message_subject' => 'Subject',
            'message_content' => 'Content',
        ]);

        // dd($this->search, $this->message_recipient, $this->message_subject, $this->message_content);
        $recipient = User::firstWhere('email', $this->message_recipient);
        // dd($recipient->id);

        Message::updateOrCreate([
            'subject' => $this->message_subject,
            'sender_id' => auth()->user()->id,
            'recipient_id' => $recipient->id,
            ],[
            'content' => $this->message_content,
            'is_read' => !$this->message_is_read,
            'updated_at' => now(),
        ]);

        $this->reset(['message_recipient', 'message_subject', 'message_content']);
        $this->updateInboxMessages();
    }


    public function render()
    {
        return view('livewire.user.messages.dashboard');
    }
}
