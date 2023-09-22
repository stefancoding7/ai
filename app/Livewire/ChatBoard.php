<?php

namespace App\Livewire;

use Livewire\Component;

use OpenAI;
class ChatBoard extends Component
{

    public $out_message;
    public $in_message;
    public $selected_gpt = 'gpt-4';


    public function render()
    {
        return view('livewire.chat-board');
    }

    public function setSelected_gpt($type)
    {
        $this->selected_gpt = $type;
    }

    public function submit()
    {
        $apikey = auth()->user()->api_key;
        
        


        $client = OpenAI::factory()
            ->withApiKey($apikey)
            
            //->withBaseUri('api.openai.com/v1/chat') // default: api.openai.com/v1
           
           
    
            ->make();

        $response = $client->chat()->create([
            'model' => $this->selected_gpt,
            'messages' => [
                ['role' => 'user', 'content' => $this->out_message],
            ],
        ]);

        $response->id; // 'chatcmpl-6pMyfj1HF4QXnfvjtfzvufZSQq6Eq'
        $response->object; // 'chat.completion'
        $response->created; // 1677701073
        $response->model; // 'gpt-3.5-turbo-0301'

        foreach ($response->choices as $result) {
            $result->index; // 0
            $result->message->role; // 'assistant'
            $result->message->content; // '\n\nHello there! How can I assist you today?'
            $result->finishReason; // 'stop'
        }

        $response->usage->promptTokens; // 9,
        $response->usage->completionTokens; // 12,
        $response->usage->totalTokens; // 21
        $this->in_message = $response->toArray()['choices'][0]['message']['content'];
       // dd($response->toArray()); // ['id' => 'chatcmpl-6pMyfj1HF4QXnfvjtfzvufZSQq6Eq', ...]

        // $result = $client->completions()->create([
        //     'model' => 'gpt-4',
        //     'prompt' => $this->out_message,
        // ]);

        //$this->in_message = $result['choices'][0]['text'];


        
    }
}
