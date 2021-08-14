@extends('app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <h1 class="text-3xl font-bold mb-6 w-max">{{ $event->eventName }}</h1>
            <p>Last edited: {{$event->updated_at->diffForHumans()}} </p>
        </div>
    </div>
@endsection
