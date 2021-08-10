@extends('app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">

            <h1 class="text-3xl font-bold mb-6">{{$month}}</h1>

            <table class="table-fixed w-full p-8"><thead><tr>
            @foreach($headers as $header)
                <th>{{$header}}</th>
            @endforeach
            </tr></thead>
            <tbody>
                @php
                    $count = 0;
                    $display = array(-1,-1,-1);
                    $e = array();
                @endphp
                <tr>
                    @for($i = 0; $i < $start; $i++)
                        @php($count++)
                        <td><div class="h-24 rounded-lg bg-gray-400"></div></td>
                    @endfor
                    @for($i = 1; $i <= $days; $i++)
                        @php($count++)
                        <td><div class="h-24 rounded-lg bg-gray-50">
                            <div>{{$i}}</div>
                            @foreach($events as $event)
                                @if($event->startDate == $first->format('Y-m-d'))
                                    @php($e[] = $event->id)
                                    @php($c = 0)
                                    @while($display[$c] != -1)
                                        @php($c++)
                                        @if($c == count($display))
                                            @break
                                        @endif
                                    @endwhile
                                    @if($c < count($display))
                                        @php($display[$c] = $event->id)
                                        <div style="background:#6e5a5a;border-radius: 25px 0 0 25px;padding:3px">{{$event->eventName}}</div>
                                    @endif
                                @elseif($event->endDate == $first->format('Y-m-d'))
                                    <div style="background:#6e5a5a;color:#6e5a5a;border-radius: 0 25px 25px 0;padding:3px">TEXT</div>
                                @endif
                            @endforeach
                        </div></td>
                        @if($count % 7 == 0)
                            </tr></tr>
                        @endif
                        @php( $first->addDay() )
                    @endfor
                    @while($count % 7 != 0)
                        @php($count++)
                        <td><div class="h-24 rounded-lg bg-gray-400"></div></td>
                    @endwhile
                <tr>
            </tbody>
            </table>
        </div>
    </div>
@endsection
