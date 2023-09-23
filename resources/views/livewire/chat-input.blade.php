<div>
    <div class="input-group mb-3" style="height: 50px;">
        <input wire:model="out_message" type="text" class="form-control" placeholder="Message..."  aria-describedby="button-addon2" style="border-radius: 20px 0 3px 20px;">
        <button wire:click="submit" wire:keydown.enter="submit" class="btn btn-outline-secondary" type="button" id="button-addon2" style="color: white; width: 60px; width: 80px; border-radius: 0px 20px 20px 0px;">Send</button>
    </div>
</div>
