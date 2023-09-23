<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Conversation;
use App\Models\MessageAi;

class ChatInput extends Component
{

    public $out_message;
    protected $listeners = ['chat-input' => 'render'];

    public function render()
    {
        return view('livewire.chat-input');
    }

    public function submit()
    {
        //dd('test');
        $message = new MessageAi;
        $message->conversation_id = 1;
        $message->user_id = auth()->user()->id;
        $message->role = 'user';
        $message->model = 'gpt-4';
        $message->content = $this->out_message;
        $message->save();
        $this->out_message = '';
        $this->dispatch('update-chat-board');
    }



    
}
