<div class="card " >
        <div class="card-header msg_head">
            <div class="bd-highlight">
                <div class="row">
                    <div class="col-6">
                        <div class="d-grid gap-2">
                            <button wire:click="setSelected_gpt('gpt-4')" class="btn btn-{{$selected_gpt != 'gpt-4' ? 'outline-' : ''}}success">GPT 4</button>
                        </div>
                        
                    </div>
                    
                    <div class="col-6">
                        <div class="d-grid gap-2">
                            <button wire:click="setSelected_gpt('gpt-3.5-turbo')" class="btn btn-{{$selected_gpt != 'gpt-3.5-turbo' ? 'outline-' : ''}}success" style="{{$selected_gpt != 'gpt-3.5-turbo' ? 'color: black;' : ''}}">GPT 3.5</button>
                        </div>
                        
                    </div>
                    <div class="col-6">
                        <div class="d-grid gap-2 mt-3">
                            <button wire:click="setSelected_gpt('create-image')" class="btn btn-{{$selected_gpt != 'create-image' ? 'outline-' : ''}}danger" style="{{$selected_gpt != 'create-image' ? 'color: black;' : ''}}">Create Image</button>
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
                                {{$m->content}}
                                
                            </div>
                            
                        </div>
                    @endif
                    
                @endforeach
            @endif
            
            

        </div>
        <div class="card-footer">
            <div wire:loading  style="height: 30px; text-align: center;">
                <p style="">
                    <div class="spinner-grow spinner-grow-sm" role="status">
                        <span class="visually-hidden">Loading...</span> 
                    </div>
                    Generate Response
                </p>
            </div>
            @livewire('chat-input')

        </div>
    </div>
