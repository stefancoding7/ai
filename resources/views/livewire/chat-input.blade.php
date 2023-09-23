<div>
    <form wire:submit.prevent="submit">
        <div class="input-group mb-3" style="height: 50px;">
            
                <input wire:model="out_message" type="text" class="form-control" placeholder="Message..."  aria-describedby="button-addon2" style="border-radius: 20px 0 3px 20px;">
                <button  class="btn btn-outline-secondary" type="submit" id="button-addon2" style="color: white; width: 60px; width: 80px; border-radius: 0px 20px 20px 0px;"><i class="bi bi-send"></i> Send</button>
            
        </div>
    </form>
</div>
