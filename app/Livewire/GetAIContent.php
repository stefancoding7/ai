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
    public $image_url = 'https://images.stefancoding.com/ai/chat-images/user-images';


    public function render()
    {
        return view('livewire.get-a-i-content');
    }

    #[On('get-ai-content-image')] 
    public function createImage($selected_gpt)
    {
        $conversation = Conversation::where('user_id', auth()->user()->id)->where('long_id', $this->slug)->first();
        
        $messages = MessageAI::where('user_id', auth()->user()->id)->where('conversation_id', $conversation->id)->where('model', $selected_gpt)->orderBy('id', 'desc')->first();
        $apikey = auth()->user()->api_key;
        $client = OpenAI::factory()
            ->withApiKey($apikey)
            //->withBaseUri('api.openai.com/v1/chat') // default: api.openai.com/v1
            ->make();

        if(is_null($messages->image)){
            $response = $client->images()->create([
                'prompt' => $messages->content,
                'n' => 1,
                'size' => '256x256',
                'response_format' => 'url',
            ]);

        } else {
            $response = $client->images()->edit([
                'image' => fopen($this->image_url.'/'.$conversation->long_id.'/'.$messages->image, 'r'),
                // 'mask' => fopen($this->image_url.'/'.$conversation->long_id.'/'.$messages->image, 'r'),
                'prompt' => $messages->content,
                'n' => 1,
                'size' => '256x256',
                'response_format' => 'url',
            ]);

        }
        

        $response->created; // 1589478378

        foreach ($response->data as $data) {
            $data->url; // 'https://oaidalleapiprodscus.blob.core.windows.net/private/...'
            $data->b64_json; // null
        }

        $response->toArray();
        
        
        $message = new MessageAi;
        $message->conversation_id = $conversation->id;
        $message->user_id = auth()->user()->id;
        $message->role = 'assistant';
        $message->model = 'create-image';
        $message->content = $response['data'][0]['url'];
        // $message->prompt_tokens = $response->usage->promptTokens;
        // $message->completion_tokens = $response->usage->completionTokens;
        // $message->total_tokens = $response->usage->totalTokens;
        $message->save();

        if(is_null($conversation->name)){
            $conversation->name = strlen($messages->content) > 50 ? substr($messages->content,0,50)."..." : $messages->content;
            $conversation->save();
        }

        $this->dispatch('update-chat-board', $message->model);
    }

    #[On('get-ai-content-gpt')] 
    public function createGpt($selected_gpt)
    {
        
        
        $conversation = Conversation::where('user_id', auth()->user()->id)->where('long_id', $this->slug)->first();
        if(auth()->user()->saver_mode == 'Extra Save'){
            $messages = MessageAI::where('user_id', auth()->user()->id)->where('conversation_id', $conversation->id)->where('model', $selected_gpt)->orderBy('id', 'desc')->take(3)->get();
        } elseif(auth()->user()->saver_mode == 'Saver'){
            $messages = MessageAI::where('user_id', auth()->user()->id)->where('conversation_id', $conversation->id)->where('model', $selected_gpt)->orderBy('id', 'desc')->take(5)->get();
        }else {
            $messages = MessageAI::where('user_id', auth()->user()->id)->where('conversation_id', $conversation->id)->where('model', $selected_gpt)->get();
        }
        
        $model = $messages->last()->model;
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
        $message->prompt_tokens = $response->usage->promptTokens;
        $message->completion_tokens = $response->usage->completionTokens;
        $message->total_tokens = $response->usage->totalTokens;
        $message->save();

        if(is_null($conversation->name)){
            $conversation->name = strlen($messages->first()->content) > 50 ? substr($messages->first()->content,0,50)."..." : $messages->first()->content;
            $conversation->save();
        }

        
        $this->dispatch('update-chat-board', $message->model);


    }

    
}
