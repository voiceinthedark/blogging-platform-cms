<?php

namespace App\Http\Livewire\User\Messages;

use Illuminate\Support\Str;
use Livewire\Component;

class InboxMessage extends Component
{

    protected $listeners = [
        'updatedMessageReply' => 'updatedMessageReply',
        'messageRead' => 'messageRead',
    ];

    protected $rules = [
        'message_reply' => 'required|string|min:2|max:255',
    ];

    public $message;
    public $message_sender;
    public $message_recipient;
    public $message_subject;
    public $message_content;
    public $message_reply;
    public $message_is_read;

    public function mount($message){
        $this->message = $message;
        $this->message_sender = $message->sender->id;
        $this->message_recipient = $message->recipient->id;
        $this->message_subject = $message->subject;
        $this->message_content = $message->content;
        $this->message_reply = '';
        $this->message_is_read = $message->is_read;
    }

    public function updatedMessageReply($message){
        $this->message_reply = $message;
    }

    public function messageRead(){
        // dd($this->message_is_read);
        $this->message_is_read = 1;
        $this->message->update([
            'is_read' => 1,
        ]);
        // dd($this->message);
        // $this->message->save();
    }
    public function reply(){

        $this->validate($this->rules);


        $this->message_content .= '<br/>' . $this->message_reply;

        // dd($this->message_sender, $this->message_recipient, $this->message_subject, $this->message_content);

        $this->message->update([
            'sender_id' => $this->message_recipient,
            'recipient_id' => $this->message_sender,
            'subject' => $this->message_subject,
            'content' => Str::of($this->message_content)->toHtmlString(),
        ]);

        $this->emitUp('replySent');
    }
    public function render()
    {
        return view('livewire.user.messages.inbox-message');
    }
}
