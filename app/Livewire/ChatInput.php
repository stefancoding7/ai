<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Conversation;
use App\Models\MessageAI;
use Livewire\Attributes\On;

use Str;

class ChatInput extends Component
{

    public $out_message;
    public $selected_gpt = 'gpt-4';
    public $slug;

    
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
        // $conversation = new Conversation;
        // $conversation->name = 'test';
        // $conversation->user_id = auth()->user()->id;
        // $conversation->save();
        

        if($this->selected_gpt){
            
            $conversation = Conversation::where('user_id', auth()->user()->id)->where('long_id', $this->slug)->first();
            $message = new MessageAI;
            $message->conversation_id = $conversation->id;
            $message->user_id = auth()->user()->id;
            $message->role = 'user';
            $message->model = $this->selected_gpt;
            $message->content = $this->out_message;
            $message->save();
            $this->out_message = '';
            $this->dispatch('update-chat-board', [$message->model]);
        } else {
            dd('type not');
        }
        
    }



    
}
