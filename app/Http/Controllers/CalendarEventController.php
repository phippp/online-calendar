<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class CalendarEventController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    //
    public function index(Event $event)
    {
        return view('calendar-event',[
            'event' => $event,
        ]);
    }
}
