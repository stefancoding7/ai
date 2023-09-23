@extends('layouts.app')

@section('content')
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100">

            <div class="col-md-8 col-xl-8 chat">
                @livewire('chat-board', ['slug' => $slug])
            </div>
        </div>
    </div>
@endsection
