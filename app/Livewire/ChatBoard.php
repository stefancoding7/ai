<?php

namespace App\Livewire;

use Livewire\Component;

use OpenAI;
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

        
        $client = OpenAI::client(auth()->user()->api_key);

        $result = $client->completions()->create([
            'model' => 'gpt-3.5-turbo-instruct',
            'prompt' => $this->out_message,
        ]);

        $this->in_message = $result['choices'][0]['text'];


        
    }
}
