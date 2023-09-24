<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Conversation;
use App\Models\MessageAI;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;

use Str;
use Image;
use Storage;

class ChatInput extends Component
{
    use WithFileUploads;

    public $out_message;
    public $selected_gpt = 'gpt-4';
    public $slug;

    #[Rule('image|max:1024')]
    public $photo;

    
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
            

            if($this->photo){
                $contents = Image::make($this->photo->getRealPath())->encode('png', 75);;
            
                
                $filename = Str::random(20).'.png';

                
                                                
                                                
                $contents->resize(256, 256, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->stream();

                
                Storage::disk('ftp_images')->put('chat-images/user-images/'.$conversation->long_id.'/'.$filename, $contents );
                $message->image = $filename;
                $message->save();
            }
            $this->out_message = '';
            $this->photo = null;
            $this->dispatch('update-chat-board', $message->model);
        } else {
            dd('type not');
        }
        
    }



    
}
