<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Conversation;
use App\Models\MessageAI;
use Str;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function createWebsite($slug, $messageId)
    {
        $checkPermission = Conversation::where('long_id', $slug)->where('user_id', auth()->user()->id)->first();

        if(!$checkPermission){
            return route('/');
        }

        $message = MessageAI::find($messageId);
        $c = explode('```', $message->content);
        $content = $c[1];

        return view('create-website', compact('content'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function chat($slug = null)
    {
        

        if(is_null($slug)){
            $conversation = new Conversation;
            $conversation->name = null;
            $conversation->user_id = auth()->user()->id;
            $conversation->long_id = Str::random(25);
            $conversation->save();

            return redirect()->route('chat', $conversation->long_id);
        }

        


        return view('home',compact('slug'));
    }

    public function myAccount()
    {
        $gpt4TotalTokens = MessageAI::where('user_id', auth()->user()->id)->where('model', 'gpt-4o-2024-05-13')->sum('total_tokens');
        $gpt35TotalTokens = MessageAI::where('user_id', auth()->user()->id)->where('model', 'gpt-3.5-turbo')->sum('total_tokens');
        $createImageTotalTokens = MessageAI::where('user_id', auth()->user()->id)->where('model', 'gpt-3.5-turbo')->sum('total_tokens');

        $gpt4Price = $this->calculatePrice(0.006, $gpt4TotalTokens);
        $gpt35Price = $this->calculatePrice(0.002, $gpt35TotalTokens);
        $imagePrice = $this->calculatePrice(0.016, $createImageTotalTokens);

        return view('my-account', compact('gpt4TotalTokens', 'gpt35TotalTokens', 'createImageTotalTokens', 'gpt4Price', 'gpt35Price', 'imagePrice'));
    }

    public function calculatePrice($tokenPrice, $tokens)
    {
        $rate_per_1000_tokens = $tokenPrice;

        // Specify the number of tokens you used
        $used_tokens = $tokens;

        // Calculate the price
        $price = ($used_tokens / 1000) * $rate_per_1000_tokens;

        return $price;
    }

    public function myAccountPost(Request $request)
    {

        $user = User::find(auth()->user()->id);
        $user->api_key = $request->api_key;
        $user->saver_mode = $request->saver_mode;
        $user->image_resolution = $request->image_resolution;
       
        if($request->create_image == 1){
            $user->create_image = $request->create_image;
        } else {
            $user->create_image = 0;
        }
        if($request->gpt_3_5 == 1){
            $user->gpt_3_5 = $request->gpt_3_5;
        } else {
            $user->gpt_3_5 = 0;
        }
        if($request->gpt_4 == 1){
            $user->gpt_4 = $request->gpt_4;
        } else {
            $user->gpt_4 = 0;
        }
        if($request->create_website == 1){
            $user->create_website = $request->create_website;
        } else {
            $user->create_website = 0;
        }
        
        $user->save();

        return redirect()->back()->with('message', 'Profile has ben updated');
    }

    public function conversations()
    {
        $conversations = Conversation::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        $deleted = false;
        foreach($conversations as $c){

            if(is_null($c->name) && is_null($c->image)){
                $c->delete();
                $deleted = true;
                
            }
        }
        if($deleted){
            return redirect()->route('conversations');
        }

        return view('conversations', compact('conversations'));
    }
}
