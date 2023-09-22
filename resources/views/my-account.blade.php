@extends('layouts.app')

@section('content')
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100">

            <div class="col-md-8 col-xl-6 chat">
                <form action="{{route('my-account-post')}}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header msg_head">
                            <label>GPT API Key</label>
                            <input name="apiKey" type="text" class="form-control" value="{{auth()->user()->api_key}}"> 
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