@extends('app')

@section('content')

<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        @if ($events->count())
            @foreach ($events as $event)
                <x-event :event="$event"/>
            @endforeach
            {{ $events->links()}}
        @else
            <p> There are no events </p>
        @endif
    </div>
</div>

@endsection
