@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="height: 100vh;">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @livewire('chat-board')

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
