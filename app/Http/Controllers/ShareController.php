<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\MessageAI;
use Str;

class ShareController extends Controller
{
    public function index($slug = null)
    {
        if(is_null($slug)){
            return redirect()->route('chat');
        }

        
    }
}
