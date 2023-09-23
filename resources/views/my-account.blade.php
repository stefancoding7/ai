@extends('layouts.app')

@section('content')
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100">

            <div class="col-md-8 col-xl-6 chat">
                <form action="{{route('my-account-post')}}" method="post">
                    @csrf
                    <div class="card" style="height: 100vh">
                        <div class="card-header msg_head">
                            <p>My Account</p>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">
                                {{Session::get('message')}}
                                </div>

                            @endif
                            <h3 class="text-center mb-5"  style="color:white;"><i class="bi bi-pie-chart-fill"></i> Usage</h3>
                            <div class="row">
                                
                               
                                <div class="col-md-4">
                                    <div class="text-center mb-5">
                                        <button type="button" class="btn btn-info position-relative" style="border-radius: 20px;">
                                        {{$gpt4TotalTokens}} tokens
                                            <br>
                                            ${{number_format($gpt4Price, 2)}}
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            GPT 4
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                        </button>
                                    </div>
                                    
                                    
                                </div>

                                <div class="col-md-4">
                                    <div class="text-center mb-5">
                                        <button type="button" class="btn btn-info position-relative" style="border-radius: 20px;">
                                            {{$gpt35TotalTokens}} tokens
                                            <br>
                                            ${{number_format($gpt35Price, 2)}}
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            GPT 3.5
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="text-center mb-5">
                                        <button type="button" class="btn btn-info position-relative" style="border-radius: 20px;">
                                            {{$createImageTotalTokens}} tokens
                                            <br>
                                            ${{number_format($imagePrice, 2)}}
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            Image Creation
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                        </button>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="text-center mb-5">
                                        <button type="button" class="btn btn-info position-relative" style="border-radius: 20px;">
                                            ${{number_format($gpt4Price + $gpt35Price + $imagePrice, 2)}}
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            Total
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                        </button>
                                    </div>
                                </div> --}}
                                   
                            </div>
                            
                            <hr>
                            <label>GPT API Key</label>
                            <input name="api_key" type="text" class="form-control" value="{{auth()->user()->api_key}}" autocomplete="off"> 
                            <br>
                            <label>Saver Mode</label>
                            <select name="saver_mode" class="form-control">
                                <option value="Extra Saver" {{auth()->user()->saver_mode == 'Extra Saver' ? 'selected' : ''}}>Extra Saver</option>
                                <option value="Saver" {{auth()->user()->saver_mode == 'Saver' ? 'selected' : ''}}>Saver</option>
                                <option value="No Saver" {{auth()->user()->saver_mode == 'No Saver' ? 'selected' : ''}}>No Saver</option>
                            </select>
                            <button class="btn btn-primary mt-3" type="submit" style="border-radius: 20px;">Update</button>
                        </div>
                        
                    </div>
                </form>
                
            </div>
        </div>
    </div>
@endsection