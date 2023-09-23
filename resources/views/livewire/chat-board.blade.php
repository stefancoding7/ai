<div class="card " >
        <div class="card-header msg_head">
            <div class="bd-highlight">
                <div class="row">
                    <div class="col-6">
                        <div class="d-grid gap-2">
                            <button wire:click="setSelected_gpt('gpt-4')" class="btn btn-{{$selected_gpt != 'gpt-4' ? 'outline-' : ''}}danger">GPT 4</button>
                        </div>
                        
                    </div>
                    
                    <div class="col-6">
                        <div class="d-grid gap-2">
                            <button wire:click="setSelected_gpt('gpt-3.5-turbo')" class="btn btn-{{$selected_gpt != 'gpt-3.5-turbo' ? 'outline-' : ''}}danger">GPT 3.5</button>
                        </div>
                        
                    </div>
                    <div class="col-6">
                        <div class="d-grid gap-2 mt-3">
                            <button wire:click="setSelected_gpt('create-image')" class="btn btn-{{$selected_gpt != 'create-image' ? 'outline-' : ''}}danger">Create Image</button>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            
        </div>
        <div class="card-body msg_card_body">
            @if($out_message)
                <div class="d-flex justify-content-start mb-4">
                    {{-- <div class="img_cont_msg">
                        <img src=""
                            class="rounded-circle user_img_msg">
                    </div> --}}
                    <div class="msg_cotainer">
                        {{$out_message}}
                        
                    </div>
                </div>
            @endif
            @if($in_message)
                <div class="d-flex justify-content-end mb-4">
                    <div class="msg_cotainer_send">
                        @if($selected_gpt == 'create-image')
                            <img src="{{$in_message}}" alt="ttt">
                        @else
                            {{$in_message}}
                        @endif
                        
                    </div>
                    {{-- <div class="img_cont_msg">
                        <img src="" class="rounded-circle user_img_msg">
                    </div> --}}
                </div>
            @endif

        </div>
        <div class="card-footer">
            <div class="input-group mb-3">
            <input wire:model="out_message" type="text" class="form-control" placeholder="Message..."  aria-describedby="button-addon2">
            <button wire:click="submit" wire:keydown.enter="submit" class="btn btn-outline-secondary" type="button" id="button-addon2">Send</button>
            </div>

        </div>
    </div>
