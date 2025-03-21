<div class="card " >
    <style>
        /* .chat {
  display: flex;
  flex-direction: column-reverse;
  height: 20rem;
  border: 1px #9bc dashed;
  font: 1rem/1.5 "Open Sans", Arial;
  color: #313131;
  position: relative;
  overflow: hidden;
} */
/* .chat__inner {
  display: flex;
  flex-direction: column;
  padding: 0.75rem;
}
.chat::before {
  content: "";
  position: absolute;
  z-index: 1;
  top: 0;
  height: 40%;
  width: 100%;
  background: linear-gradient(to bottom, white 20%, rgba(255, 255, 255, 0)) repeat-x;
}

.chat p {
  margin: 0;
  padding: 0;
} */

    .chat__message {
    
    
    transform: scale(0);
    
    
    animation: message 0.25s ease-out 0s forwards;
    animation-delay: var(--timeline);
    
    }


    @keyframes message {
    0% {
        max-height: 100vmax;
    }
    80% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
        /* max-height: 100vmax; */
        overflow: visible;
        
    }
    }

    </style>
        <div class="card-header msg_head">
            <div class="bd-highlight">
                <div class="row ">
                    <div class="col-4">
                        <div class="row">
                             <div class="col-4 m-0 p-0">
                                {{-- <div class="d-grid gap-2"> --}}
                                    <a href="{{route('conversations')}}" class="btn btn-info" style="border-radius: 20px; font-size: 12px;" > <i class="bi bi-arrow-90deg-left"></i></a>
                                {{-- </div> --}}
                                
                            </div>
                            <div class="col-4 m-0 p-0">
                                    {{-- <div class="d-grid gap-2 mb-2"> --}}
                                        <div style="text-align: right;">
                                            <button  class="btn btn-outline-info" style="border-radius: 20px; font-size: 12px; " ><i class="bi bi-share"></i></button>
                                        </div>
                                        
                                    {{-- </div> --}}
                                    
                                </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="row">
                            @if(auth()->user()->create_image)
                                <div class="col-4 m-0 p-0">
                                    <div class="d-grid gap-2 mb-2">
                                        <button wire:click="setSelected_gpt('create-image')" class="btn btn-{{$selected_gpt != 'create-image' ? 'outline-' : ''}}info" style="border-radius: 20px; font-size: 12px; {{$selected_gpt != 'create-image' ? 'color: black;' : ''}}" ><i class="bi bi-image"></i></button>
                                    </div>
                                    
                                </div>
                            @endif
                            @if(auth()->user()->gpt_4)
                                <div class="col-4 m-0 p-0">
                                    <div class="d-grid gap-2">
                                        <button wire:click="setSelected_gpt('gpt-4.5-preview')" class="btn btn-{{$selected_gpt != 'gpt-4.5-preview' ? 'outline-' : ''}}info" style="border-radius: 20px; font-size: 12px; {{$selected_gpt != 'gpt-4.5-preview' ? 'color: black;' : ''}}">GPT 4.5</button>
                                    </div>
                                    
                                </div>
                            @endif

                            @if(auth()->user()->gpt_3_5)
                                <div class="col-4 m-0 p-0">
                                    <div class="d-grid gap-2">
                                        <button wire:click="setSelected_gpt('gpt-3.5-turbo')" class="btn btn-{{$selected_gpt != 'gpt-3.5-turbo' ? 'outline-' : ''}}info" style="border-radius: 20px; font-size: 12px; {{$selected_gpt != 'gpt-3.5-turbo' ? 'color: black;' : ''}}">GPT 3.5</button>
                                    </div>
                                    
                                </div>
                            @endif
                            
                            @if(auth()->user()->create_website == 1)
                                <div class="col-4 m-0 p-0">
                                    <div class="d-grid gap-2">
                                        <button wire:click="setSelected_gpt('create-website')" class="btn btn-{{$selected_gpt != 'create-website' ? 'outline-' : ''}}info" style="border-radius: 20px; font-size: 12px; {{$selected_gpt != 'create-website' ? 'color: black;' : ''}}">WEBSITE</button>
                                    </div>
                                    
                                </div>
                            @endif
                        </div>
                    </div>
                 
                    
                    
                    
                </div>
                
            </div>
            
        </div>
        <div wire:poll.10s class="card-body msg_card_body p-2" style="">
            @if($messages)
                @if($messages->count() > 0)
                    @foreach($messages as $m)
                        @if($m->role == 'user')
                            <div class="d-flex justify-content-start mb-2">
                                
                                <div class="msg_cotainer chat__message  chat__message_A" style="font-size: 13px; ">
                                    @if(!is_null($m->image))
                                        <img src="https://images.stefancoding.com/ai/chat-images/user-images/{{$conversation->long_id}}/{{$m->image}}" alt="image" style="border-radius: 15px;">
                                        {{$m->content}}
                                    @else
                                        {!! nl2br($m->content)!!}
                                    @endif
                                    

                                </div>
                            </div>
                        @else
                            <div class="d-flex justify-content-end mb-2">
                                <div class="msg_cotainer_send chat__message  chat__message_A" style="font-size: 13px; ">
                                    @if($m->model == 'create-image')
                                        <img src="{{$m->content}}" alt="image" style="border-radius: 15px;">
                                        
                                    @elseif($m->model == 'create-website')
                                        
                                        {!! nl2br($m->styledContent()) !!}

                                        {{-- <iframe src="{{route('create-website', [$m->conversation->long_id, $m->id])}}" title="stefancoding" style="width: 100%;"></iframe>  --}}
                                        <p style="text-align: right; font-size: 10px; margin-top: 10px;"> <span class="btn btn-outline-primary btn-sm" style="margin-right: 10px;"><a href="{{route('create-website', [$m->conversation->long_id, $m->id])}}" target="_blank">Create Website</a> </span><i class="bi bi-database-fill"></i> <b>{{$m->total_tokens}}</b></p>
                                    
                                        
                                    @else
                                        
                                        {!! nl2br($m->styledContent()) !!}
                                        
                                        
                                        <p style="text-align: right; font-size: 10px; margin-top: 10px;"><i class="bi bi-database-fill"></i> <b>{{$m->total_tokens}}</b></p>
                                    @endif
                                    
                                </div>
                                
                            </div>
                        @endif
                        
                    @endforeach
                    @if($show_loading)
                        <div class="d-flex justify-content-end mb-2">
                            <div class="msg_cotainer_send chat__message  chat__message_A" style="font-size: 13px; width: 45px; background: transparent;">
                                <a class="editInfo" style="margin-top: 20px;">
                                    <i class="icon-pencil"></i> 
                                </a>  
                            </div>
                            {{-- <div class="msg_cotainer_send chat__message  chat__message_A" style="font-size: 13px; width: 45px; background: white;">
                                <img src="{{ asset('icons/pencil.gif') }}" alt="" style="height: 20px; width: 20px;">
                            </div> --}}
                        </div>
                    @endif
                @endif
            @endif
            
            
            

        </div>
        <div class="card-footer" style="background: ">
            @livewire('get-a-i-content', ['slug' => $slug])
            
            @livewire('chat-input', ['slug' => $slug])

        </div>
        
    </div>
