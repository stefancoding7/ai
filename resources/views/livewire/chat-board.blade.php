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
                <div class="row">
                    <div class="col-2">
                        <div class="d-grid gap-2">
                            <a href="{{route('conversations')}}" class="btn btn-info" style="border-radius: 20px;"> <i class="bi bi-arrow-90deg-left"></i></a>
                        </div>
                        
                    </div>
                    <div class="col-2">
                        <div class="d-grid gap-2 mb-2">
                            <button wire:click="setSelected_gpt('create-image')" class="btn btn-{{$selected_gpt != 'create-image' ? 'outline-' : ''}}success" style="border-radius: 20px; {{$selected_gpt != 'create-image' ? 'color: black;' : ''}}" ><i class="bi bi-image"></i></button>
                        </div>
                        
                    </div>
                    
                    <div class="col-4">
                        <div class="d-grid gap-2">
                            <button wire:click="setSelected_gpt('gpt-4')" class="btn btn-{{$selected_gpt != 'gpt-4' ? 'outline-' : ''}}success" style="border-radius: 20px; {{$selected_gpt != 'gpt-4' ? 'color: black;' : ''}}">GPT 4</button>
                        </div>
                        
                    </div>
                    
                    <div class="col-4">
                        <div class="d-grid gap-2">
                            <button wire:click="setSelected_gpt('gpt-3.5-turbo')" class="btn btn-{{$selected_gpt != 'gpt-3.5-turbo' ? 'outline-' : ''}}success" style="border-radius: 20px; {{$selected_gpt != 'gpt-3.5-turbo' ? 'color: black;' : ''}}">GPT 3.5</button>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        <div class="card-body msg_card_body " style="">
            @if($messages->count() > 0)
                @foreach($messages as $m)
                    @if($m->role == 'user')
                        <div class="d-flex justify-content-start mb-4">
                            
                            <div class="msg_cotainer chat__message  chat__message_A">
                                {{$m->content}}

                            </div>
                        </div>
                    @else
                        <div class="d-flex justify-content-end mb-4">
                            <div class="msg_cotainer_send chat__message  chat__message_A">
                                @if($m->model == 'create-image')
                                    <img src="{{$m->content}}" alt="image">
                                    <p style="text-align: right; font-size: 10px; margin-top: 10px;">Total tokens used: <b>{{$m->total_tokens}}</b></p>
                                @else
                                    
                                        {!! nl2br($m->styledContent()) !!}
                                    
                                    
                                    <p style="text-align: right; font-size: 10px; margin-top: 10px;">Total tokens used: <b>{{$m->total_tokens}}</b></p>
                                @endif
                                
                            </div>
                            
                        </div>
                    @endif
                    
                @endforeach
            @endif
            
            

        </div>
        <div class="card-footer">
            @livewire('get-a-i-content', ['slug' => $slug])
            
            @livewire('chat-input', ['slug' => $slug])

        </div>
        
    </div>
