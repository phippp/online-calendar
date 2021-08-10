@extends('app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 flex bg-white p-6 rounded-lg justify-center mb-4">
            <div class="w-6/12">
                <form action="{{ route('events') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="mb-4">
                        <label for="eventName" class="sr-only">Event name</label>
                        <input class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('eventName') border-red-500 @enderror" name="eventName" type="text" id="eventName" placeholder="Event name" value="{{ old('eventName') }}">

                        @error('eventName')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                    <div class="mb-4">
                        <label for="details" class="sr-only">Event name</label>
                        <textarea name="details" id="details" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('details') border-red-500 @enderror" placeholder="Post something!"></textarea>

                        @error('details')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                    <div class="w-full flex justify-between">
                        <p class="w-4/12 float-left">Start Date:</a>
                        <p class="w-4/12 float-left">End Date:</a>
                        <p class="w-3/12 float-left">Time:</a>
                    </div>
                    <div class="mb-4 w-full flex justify-between">
                        <label for="startDate" class="sr-only">Event name</label>
                        <input class="bg-gray-100 border-2 w-4/12 p-4 rounded-lg" name="startDate" type="date" id="startDate" value="{{ old('startDate') }}">
                        <label for="endDate" class="sr-only">Event name</label>
                        <input class="bg-gray-100 border-2 w-4/12 p-4 rounded-lg" name="endDate" type="date" id="endDate" value="{{ old('endDate') }}">
                        <label for="time" class="sr-only">Event name</label>
                        <input class="bg-gray-100 border-2 w-3/12 p-4 rounded-lg" name="time" type="time" id="time" value="{{ old('time') }}">

                    </div>

                    @error('startDate')
                        <div class="text-red-500 mt-2 text-sm mb-4">
                            {{ $message }}
                        </div>
                    @enderror
                    @error('endDate')
                        <div class="text-red-500 mt-2 text-sm mb-4">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-4">
                        <select class="bg-gray-100 border-2 w-6/12 p-4 rounded-lg" name="repeat" id="repeat">
                            <option value="none">No repeat</option>
                            <option value="daily">Repeat daily</option>
                            <option value="weekly">Repeat weekly</option>
                            <option value="monthly">Repeat monthly</option>
                            <option value="annualy">Repeat yearly</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
