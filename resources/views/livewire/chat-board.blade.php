<div>
    {{$in_message}}
    <div class="input-group mb-3">
        <input wire:model="out_message" type="text" class="form-control" placeholder="Message..." aria-label="Recipient's username" aria-describedby="button-addon2">
        <button class="btn btn-outline-secondary" type="button" id="button-addon2" wire:click="submit">Send</button>
    </div>

    
</div>
