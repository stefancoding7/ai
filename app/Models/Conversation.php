<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    
    use HasFactory;

    public function messagesAi()
    {
        return $this->hasMany('App\Models\MessageAI', 'conversation_id', 'id');
    }

    


}
