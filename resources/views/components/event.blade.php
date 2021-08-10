@props(['event' => $event])

<div class="mb-4">
    <a href="#" class="font-bold">{{ $event->eventName }}</a> <span class="text-gray-600 text-sm">{{ date('d-m-Y', strtotime($event->startDate)) }} @if($event->endDate) {{ "to ".date('d-m-Y',strtotime($event->endDate)) }} @endif @if($event->time)Set at {{ date('H:i',strtotime($event->time)) }}@endif</span>
    <p>{{$event->details}}</p>
    @can('delete',$event)
        <form action="{{ route('events.destroy',$event) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-blue-500">Delete</button>
        </form>
    @endcan
</div>
