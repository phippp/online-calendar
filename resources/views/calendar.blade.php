@extends('app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <h1 class="text-3xl font-bold mb-6">{{$month}}</h1>
            <table class="table-fixed w-full p-8 calendar"><thead><tr>
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
                        <td><div class="h-36 rounded-lg bg-gray-400"></div></td>
                    @endfor
                    @for($i = 1; $i <= $days; $i++)
                        @php($count++)
                        <td><div class="h-36 rounded-lg bg-gray-50">
                            <div>{{$i}}</div>
                            {{-- Add if start --}}
                            @foreach($events as $event)
                                @if($first->format('Y-m-d') == $event->startDate)
                                    @php($c = 0)
                                    @while($display[$c] != -1)
                                        @php($c++)
                                        @if($c == count($display))
                                            @break
                                        @endif
                                    @endwhile
                                    @if($c < count($display))
                                        @php($display[$c] = $event->id)
                                    @endif
                                    @php($e[$event->id] = $event)
                                @endif
                            @endforeach
                            {{-- Display events --}}
                            @foreach($display as $item)
                                @if($item == -1)
                                    <div class="blank event"><br></div>
                                @else
                                    <div style="background:#8b5050;" class="event @if($count%7 == 1){{'new-line'}}@endif @if($e[$item]->startDate == $first->format('Y-m-d')){{'start'}}@endif @if($e[$item]->endDate == $first->format('Y-m-d') || $e[$item]->endDate == null){{'end'}}@endif">
                                        @if($e[$item]->startDate == $first->format('Y-m-d')) {{ $e[$item]->eventName }} @else <br> @endif
                                    </div>
                                @endif
                            @endforeach
                            @if(count($e) > count($display))
                                <div class="bg-gray-300" style="border-radius: 25px 25px 25px 25px;padding:3px;margin-top:3px;">+ {{ count($e) - count($display)}} more</div>
                            @endif
                            {{-- Remove events --}}
                            @foreach($events as $event)
                                @if($first->format('Y-m-d') == $event->endDate || $event->endDate == null)
                                    @if(in_array($event->id,$display))
                                        @php($ind = array_search($event->id,$display))
                                        @php($display[$ind] = -1)
                                        <?php
                                            unset($e[$event->id]);
                                        ?>
                                    @endif
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
                        <td><div class="h-36 rounded-lg bg-gray-400"></div></td>
                    @endwhile
                <tr>
            </tbody>
            </table>
        </div>
    </div>
@endsection
