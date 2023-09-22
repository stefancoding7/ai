<?php

namespace App\Livewire;

use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;

class ChatBoard extends Component
{

    public $out_message;
    public $in_message;


    public function render()
    {
        return view('livewire.chat-board');
    }

    public function submit()
    {
        $result = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $this->out_message,
        ]);

        $this->in_message = $result['choices'][0]['text']; 
    }
}
