<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 

use App\Models\Conversation;
use App\Models\MessageAI;

use OpenAI;

class ChatBoard extends Component
{

    public $out_message;
    public $in_message;
    public $selected_gpt = 'gpt-4';

    public $messages;
    public $slug;
    public $conversation;
    public $show_loading;

    //protected $listeners = ['update-chat-board' => 'updateChatBoard'];

    public function mount()
    {
        $this->conversation = Conversation::where('long_id', $this->slug)->first();

        if($this->conversation){
            
            $this->messages = MessageAI::where('user_id', auth()->user()->id)->where('model', $this->selected_gpt)->where('conversation_id', $this->conversation->id)->get();
            $this->dispatch('set-selected-gpt', $this->selected_gpt);
        }
       
    }

    #[On('set-show-loading')] 
    public function setShowLoading($loading)
    {
        
        if($loading){
            $this->show_loading = true;
        } else {
            $this->show_loading = false;
        }
        
    }

    #[On('update-chat-board')] 
    public function updateChatBoard($model)
    {
        $conversation = Conversation::where('long_id', $this->slug)->first();

        if($conversation){
            $this->messages = MessageAI::where('user_id', auth()->user()->id)->where('model', $model)->where('conversation_id', $conversation->id)->get();
        }
        

            if($this->messages->count() > 0){
                if($this->messages->last()->role == 'user'){
                    //dd($model);
                    if($model == 'create-image'){
                        //dd($model, '1');
                        $this->dispatch('get-ai-content-image', $model);
                    } else {
                        //dd($model, '2');
                        $this->dispatch('get-ai-content-gpt', $model);
                    }
                    
                }

                
            }
        
        
        

    }

    public function updateChatBoardNoAI($model)
    {
        $conversation = Conversation::where('long_id', $this->slug)->first();
       
        if($conversation){
            $this->messages = MessageAI::where('user_id', auth()->user()->id)->where('model', $model)->where('conversation_id', $conversation->id)->get();
        }
        
       
        
        

    }

    public function render()
    {

        $conversation = Conversation::where('long_id', $this->slug)->first();
       
        if($conversation){
            $this->messages = MessageAI::where('user_id', auth()->user()->id)->where('model', $this->selected_gpt)->where('conversation_id', $conversation->id)->get();
        }
        return view('livewire.chat-board');
    }

    public function setSelected_gpt($type)
    {
        $this->selected_gpt = $type;
        $this->dispatch('set-selected-gpt', $this->selected_gpt);
        $this->updateChatBoardNoAI($this->selected_gpt);
    }

    

    public function submit()
    {


        //$this->createConversation();

        

        // if($this->selected_gpt == 'gpt-4'){
        //     $this->createGpt4();
        // }
        //  if($this->selected_gpt == 'gpt-3.5-turbo'){
        //     $this->createGpt3();
        // }
        //  if($this->selected_gpt == 'create-image'){
        //     $this->createImage();
        // }
        
    }

    

    public function createConversation()
    {
        $conversation = new Conversation;
        $conversation->name = 'test';
        $conversation->user_id = auth()->user()->id;
        $conversation->save();
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

    public function createGpt4($messagesArray)
    {

        $apikey = auth()->user()->api_key;
        $client = OpenAI::factory()
            ->withApiKey($apikey)
            //->withBaseUri('api.openai.com/v1/chat') // default: api.openai.com/v1
            ->make();
        
        $response = $client->chat()->create([
            'model' => 'gpt-4',
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
        $message->conversation_id = 1;
        $message->user_id = auth()->user()->id;
        $message->role = 'assistant';
        $message->model = 'gpt-4';
        $message->content = $response->toArray()['choices'][0]['message']['content'];
        $message->save();
        


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
