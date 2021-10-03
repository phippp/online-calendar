@extends('app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">

            @auth
                <h2 class="text-xl font-bold mb-6 w-max">Upcoming events</h2>
                <p class="mb-6">You have {{ count($events) }} events in the next 14 days</p>
                @foreach($events as $event)
                    <x-event :event="$event"/>
                @endforeach
            @endauth
            @guest
                <h2 class="text-xl font-bold mb-6 w-max">You currently aren't logged in</h2>
                Have an account? <a class="text-blue-400" href="{{route('login')}}">
                    <button class="btn">Login</button>
                </a>
                or, <a class="text-blue-400" href="{{route('register')}}">
                    <button class="btn"> Create one </button>
                </a>
            @endguest
        </div>
    </div>
@endsection
