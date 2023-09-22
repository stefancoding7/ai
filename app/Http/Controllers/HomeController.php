<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function myAccount()
    {
        return view('my-account');
    }

    public function myAccountPost(Request $request)
    {

        $user = User::find(auth()->user()->id);
        $user->api_key = $request->api_key;
        $user->save();

        return redirect()->back();
    }
}
