<?php

namespace App\Http\Livewire\User\Messages;

use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{

    protected $rules = [
            'message_recipient' => 'bail|required|exists:users,email|email',
            'message_subject' => 'required|string|min:5|max:25',
            'message_content' => 'required|string|min:5|max:255',
    ];

    public $directMessages;
    public $message_sender;
    public $message_recipient;
    public $message_subject;
    public $message_content;
    public $users;
    public $search;

    public function mount(){
        $this->directMessages = auth()->user()->received_messages ;
        $this->users = User::all();
        $this->search = '';
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
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

        dd($this->search, $this->message_recipient, $this->message_subject, $this->message_content);
        $recipient = User::find($this->message_recipient);

        Message::updateOrCreate([
            'sender_id' => auth()->user()->id,
            'recipient_id' => $this->message_recipient,
            'subject' => $this->message_subject,
            'content' => $this->message_content
        ]);

        $this->reset(['message_recipient', 'message_subject', 'message_content']);
    }


    public function render()
    {
        return view('livewire.user.messages.dashboard');
    }
}
