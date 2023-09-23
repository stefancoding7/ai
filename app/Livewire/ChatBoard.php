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
    

    protected $listeners = ['update-chat-board' => 'updateChatBoard'];

    public function mount()
    {
        $this->messages = MessageAI::where('user_id', auth()->user()->id)->get();
    }

    #[On('update-chat-board')] 
    public function updateChatBoard()
    {
        $this->messages = MessageAI::where('user_id', auth()->user()->id)->get();
        // Transform the collection into the desired format
        $messageArray = $this->messages->map(function ($message) {
            // Define the structure for each message
            return [
                'role' => $message->role, // Replace with the actual column name from your database
                'content' => $message->content, // Replace with the actual column name from your database
            ];
        });

        // If you want to convert the result to a standard array
        $messageArray = $messageArray->toArray();
        
        
        $this->createGpt4($messageArray);
        $this->messages = MessageAI::where('user_id', auth()->user()->id)->get();

    }

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
