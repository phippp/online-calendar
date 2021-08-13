<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use App\Mail\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CalendarController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }
    //
    public function index()
    {
        $date = Carbon::now();
        //Note 0 = Sunday, 6 = Saturday
        $events = Event::where(['user_id' => auth()->user()->id])->whereBetween('created_at', [$date->firstOfMonth()->format('Y-m-d'),$date->lastOfMonth()->format('Y-m-d')])->orderBy('startDate','asc')->get();
        return view('calendar',[
            'headers' => ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            'month' => $date->format('F'),
            'days' => $date->daysInMonth,
            'start' => $date->startOfMonth()->dayOfWeek,
            'first' => $date->startOfMonth(),
            'events' => $events
        ]);
    }
}
