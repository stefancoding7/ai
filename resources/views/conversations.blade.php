@extends('layouts.app')

@section('content')
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100">

            <div class="col-md-8 col-xl-6 chat">
                <ul class="list-group list-group-flush" style="border-radius: 20px;">
                    @foreach($conversations as $conv)
                        <li class="list-group-item"><a href="{{route('chat', $conv->long_id)}}">{{$conv->name}}</a></li>
                    @endforeach
                    
                    
                </ul>
                <div class="fixed-bottom">
                    <div class="d-grid gap-2 mb-2">
                        <a href="{{route('chat')}}" class="btn btn-primary" style="height: 50px;">New chat</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection