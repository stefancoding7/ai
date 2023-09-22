<?php

namespace App\Livewire;

use Livewire\Component;

class ChatBoard extends Component
{

    public $out_message;


    public function render()
    {
        return view('livewire.chat-board');
    }

    public submit()
    {
        dd($this->out_message);
    }
}
