<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Conversation;
use App\Models\MessageAI;
use Livewire\Attributes\On;

class ChatInput extends Component
{

    public $out_message;
    public $selected_gpt;

    protected $listeners = ['chat-input' => 'render'];

    public function render()
    {
        return view('livewire.chat-input');
    }

    #[On('set-selected-gpt')]  
    public function setSelected_gpt($type)
    {
        $this->selected_gpt = $type;
    }

    public function submit()
    {
        if($this->selected_gpt){
            $message = new MessageAI;
            $message->conversation_id = 1;
            $message->user_id = auth()->user()->id;
            $message->role = 'user';
            $message->model = $this->selected_gpt;
            $message->content = $this->out_message;
            $message->save();
            $this->out_message = '';
            $this->dispatch('update-chat-board', [$message->model]);
        }
        
    }



    
}
