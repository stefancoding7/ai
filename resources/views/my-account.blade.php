@extends('layouts.app')

@section('content')
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100">

            <div class="col-md-8 col-xl-6 chat">
                <form action="{{route('my-account-post')}}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header msg_head">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">
                                {{Session::get('message')}}
                                </div>

                            @endif
                            <label>GPT API Key</label>
                            <input name="api_key" type="text" class="form-control" value="{{auth()->user()->api_key}}" autocomplete="off"> 
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                        
                    </div>
                </form>
                
            </div>
        </div>
    </div>
@endsection