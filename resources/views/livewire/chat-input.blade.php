<div>
    
    
    
    <div class="input-group mb-3" style="height: 50px;">
        <input wire:model="out_message" type="text" class="form-control" placeholder="Message..."  aria-describedby="button-addon2">
        <button wire:click="submit" wire:keydown.enter="submit" class="btn btn-outline-secondary" type="button" id="button-addon2" style="color: white; width: 60px; width: 80px;">Send</button>
    </div>
</div>
