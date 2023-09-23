<div class="card " >
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
        <div class="card-body msg_card_body">
            @if($messages->count() > 0)
                @foreach($messages as $m)
                    @if($m->role == 'user')
                        <div class="d-flex justify-content-start mb-4">
                            
                            <div class="msg_cotainer">
                                {{$m->content}}

                            </div>
                        </div>
                    @else
                        <div class="d-flex justify-content-end mb-4">
                            <div class="msg_cotainer_send">
                                @if($m->model == 'create-image')
                                    <img src="{{$m->content}}" alt="image">
                                    <p style="text-align: right; font-size: 10px; margin-top: 10px;">Total tokens used: <b>{{$m->total_tokens}}</b></p>
                                @else
                                    {!!$m->styledContent()!!}
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
