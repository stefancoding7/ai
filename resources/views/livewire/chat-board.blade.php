<div class="card">
        <div class="card-header msg_head">
            <div class="d-flex bd-highlight">
                <div class="img_cont">
                    <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                        class="rounded-circle user_img">
                    <span class="online_icon"></span>
                </div>
                <div class="user_info">
                    <span>Stefan Caky</span>

                </div>
                <div class="video_cam">
                    <span><i class="fas fa-video"></i></span>
                    <span><i class="fas fa-phone"></i></span>
                </div>
            </div>
            <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
            <div class="action_menu">
                <ul>
                    <li><i class="fas fa-user-circle"></i> View profile</li>
                    <li><i class="fas fa-users"></i> Add to close friends</li>
                    <li><i class="fas fa-plus"></i> Add to group</li>
                    <li><i class="fas fa-ban"></i> Block</li>
                </ul>
            </div>
        </div>
        <div class="card-body msg_card_body">
            @if($out_message)
                <div class="d-flex justify-content-start mb-4">
                    <div class="img_cont_msg">
                        <img src=""
                            class="rounded-circle user_img_msg">
                    </div>
                    <div class="msg_cotainer">
                        {{$out_message}}
                        
                    </div>
                </div>
            @endif
            @if($in_message)
                <div class="d-flex justify-content-end mb-4">
                    <div class="msg_cotainer_send">
                        {{$in_message}}
                        
                    </div>
                    <div class="img_cont_msg">
                        <img src="" class="rounded-circle user_img_msg">
                    </div>
                </div>
            @endif

        </div>
        <div class="card-footer">
            <div class="input-group mb-3">
            <input wire:model="out_message" type="text" class="form-control" placeholder="Message..." aria-label="Recipient's username" aria-describedby="button-addon2">
            <button wire:click="submit" class="btn btn-outline-secondary" type="button" id="button-addon2">Send</button>
            </div>

        </div>
    </div>
