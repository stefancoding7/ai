<div>
    <style>
        .chat__image { 
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
    @if ($photo) 
        <div class="chat__image" style="height: 100px; margin-bottom: 10px; text-align: center;">
            <img src="{{ $photo->temporaryUrl() }}" class="img-fluid" style="height: 100px; border-radius: 10px;">
        </div>
        
    @endif
    
    <form wire:submit.prevent="submit">
        <div class="input-group mb-3" style="height: 40px;">
            
                <input wire:model="out_message" type="text" class="form-control" placeholder="Message..."  aria-describedby="button-addon2" style="border-radius: 20px 0 3px 20px;">
                @if($selected_gpt == 'create-image')
                    <span class="input-group-text btn btn-outline-secondary" ><label><input type="file" wire:model="photo" style="display: none;"><i class="bi bi-image" style="font-size: 25px; color: white; margin-top: 15px; padding: 10px;"></label></i></span>
                @endif
                <button  class="btn btn-outline-secondary" type="submit" id="button-addon2" style="color: white; width: 60px; width: 80px; border-radius: 0px 20px 20px 0px;"><i class="bi bi-send"></i></button>
            
        </div>
    </form>
</div>
