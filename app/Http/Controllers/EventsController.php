<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){

        $events = Event::where('user_id',auth()->user()->id)->orderBy('startDate','asc')->paginate(5);

        return view('events', [
            'events' => $events
        ]);

    }

    public function store(Request $request){

        $this->validate($request,[
            'eventName' => 'required|max:255',
            'startDate' => 'required|date',
            'endDate' => 'date|nullable|after_or_equal:startDate',
            'time' => 'nullable|date_format:H:i',
            'repeat' => 'required',
            'details' => 'required'
        ]);

        auth()->user()->events()->create([
            'eventName' => $request->eventName,
            'startDate' => Carbon::parse($request->startDate),
            'endDate' => ($request->endDate != null)?Carbon::parse($request->endDate):null,
            'time' => $request->time,
            'repeat' => $request->repeat,
            'details' => $request->details
        ]);
        //$request->only('eventName','startDate','endDate','time','repeat','details'));

        return back();

    }

    public function destroy(Event $event)
    {
        $this->authorize('delete',$event);
        $event->delete();
        return back();
    }
}
