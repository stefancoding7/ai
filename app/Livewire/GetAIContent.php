<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Conversation;
use App\Models\MessageAI;
use Livewire\Attributes\On; 

use OpenAI;

class GetAIContent extends Component
{


    public $slug;


    public function render()
    {
        return view('livewire.get-a-i-content');
    }

    #[On('get-ai-content-gpt')] 
    public function createGpt()
    {
        
        $messages = MessageAI::where('user_id', auth()->user()->id)->get();
        $model = $messages->last()->model;
        $conversation = Conversation::where('user_id', auth()->user()->id)->where('long_id', $this->slug)->first();
         // Transform the collection into the desired format
        $messageArray = $messages->map(function ($message) {
            // Define the structure for each message
            return [
                'role' => $message->role, // Replace with the actual column name from your database
                'content' => $message->content, // Replace with the actual column name from your database
            ];
        });

        // If you want to convert the result to a standard array
        $messagesArray = $messageArray->toArray();
        $apikey = auth()->user()->api_key;
        $client = OpenAI::factory()
            ->withApiKey($apikey)
            //->withBaseUri('api.openai.com/v1/chat') // default: api.openai.com/v1
            ->make();
        
        $response = $client->chat()->create([
            'model' => $model,
            'messages' => $messagesArray,
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

        $message = new MessageAi;
        $message->conversation_id = $conversation->id;
        $message->user_id = auth()->user()->id;
        $message->role = 'assistant';
        $message->model = $model;
        $message->content = $response->toArray()['choices'][0]['message']['content'];
        $message->save();

        if(is_null($conversation->name)){
            $conversation->name = strlen($messages->first()->content) > 50 ? substr($messages->first()->content,0,50)."..." : $messages->first()->content;
            $conversation->save();
        }

        
        $this->dispatch('update-chat-board', [$message->model]);


    }

    
}
