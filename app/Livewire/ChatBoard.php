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
        if($this->selected_gpt == 'gpt-4'){
            $this->createGpt4();
        }
         if($this->selected_gpt == 'gpt-3.5-turbo'){
            $this->createGpt3();
        }
         if($this->selected_gpt == 'create-image'){
            $this->createImage();
        }
     
    }

    public function createImage()
    {
        $apikey = auth()->user()->api_key;
        $client = OpenAI::factory()
            ->withApiKey($apikey)
            //->withBaseUri('api.openai.com/v1/chat') // default: api.openai.com/v1
            ->make();
        $response = $client->images()->create([
            'prompt' => $this->out_message,
            'n' => 1,
            'size' => '256x256',
            'response_format' => 'url',
        ]);

        $response->created; // 1589478378

        foreach ($response->data as $data) {
            $data->url; // 'https://oaidalleapiprodscus.blob.core.windows.net/private/...'
            $data->b64_json; // null
        }

        $response->toArray();
        $this->in_message = $response['data'][0]['url'];
    }

    public function createGpt4()
    {
        $apikey = auth()->user()->api_key;
        $client = OpenAI::factory()
            ->withApiKey($apikey)
            //->withBaseUri('api.openai.com/v1/chat') // default: api.openai.com/v1
            ->make();

        $response = $client->chat()->create([
            'model' => 'gpt-4',
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
    }

    public function createGpt3()
    {
         $apikey = auth()->user()->api_key;
        $client = OpenAI::factory()
            ->withApiKey($apikey)
            //->withBaseUri('api.openai.com/v1/chat') // default: api.openai.com/v1
            ->make();

        $response = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
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
    }
}
