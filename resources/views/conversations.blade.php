@extends('layouts.app')

@section('content')
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100">

            <div class="col-md-8 col-xl-6 chat">
                <ol class="list-group list-group-numbered" style="border-radius: 20px; background-color: rgba(183, 206, 250, 0.4) !important;">
                    @foreach($conversations as $conv)
                        <a href="{{route('chat', $conv->long_id)}}"  class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                            <div class="fw-bold">{{$conv->name}}</div>
                                @php($model = $conv->messagesAI->groupBy('model'))
                                @foreach($model as $m)
                                    @if($m->first()->model == 'gpt-4o-2024-05-13')
                                        <span class="badge text-bg-light">GPT 4o</span>

                                        
                                    @endif
                                    @if($m->first()->model == 'gpt-3.5-turbo')
                                        <span class="badge text-bg-light">GPT 3</span>

                                        
                                    @endif
                                    
                                @endforeach
                            </div>
                            <span class="badge bg-info rounded-pill">{{$conv->messagesAI->count()}}</span>
                        </a>
                    @endforeach
                </ol>   
                <div class="fixed-bottom">
                    <div class="d-grid gap-2 mb-2">
                        <a href="{{route('chat')}}" class="btn btn-info" style="height: 50px; margin-left: 20px; margin-right: 20px; padding-top: 10px; border-radius: 22px;"> <i class="bi bi-plus" style="font-size: 15px;"></i>
                        New chat</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection