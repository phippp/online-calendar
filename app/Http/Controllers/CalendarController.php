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
    public function index($year = null,$month = null)
    {

        $date = Carbon::create((isset($year)?$year:Carbon::now()->year), (isset($month)?$month:Carbon::now()->month));

        //Note 0 = Sunday, 6 = Saturday
        $events = Event::where(['user_id' => auth()->user()->id])
        ->where(function($query) use ($date) {
            $query->whereBetween('startDate', [$date->firstOfMonth()->format('Y-m-d'),$date->lastOfMonth()->format('Y-m-d')])->orderBy('startDate','asc')
            ->orWhere(function($query) use ($date){
                $query->where('repeat', '=', 'annualy') ->whereRaw('MONTH(`startDate`) = ?', $date->month);
            })
            ->orWhere('repeat', '=', 'monthly');

        })->get();
        return view('calendar',[
            'headers' => ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            'month' => $date->format('F'),
            'year' => $date->year,
            'days' => $date->daysInMonth,
            'start' => $date->startOfMonth()->dayOfWeek,
            'first' => $date->startOfMonth(),
            'events' => $events
        ]);
    }
}
