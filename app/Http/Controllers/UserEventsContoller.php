<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;

class UserEventsContoller extends Controller
{
    public function index(User $user)
    {
        $events = Event::where('user_id',$user->id)->orderBy('startDate','asc')->paginate(15);
        return view('user', ['events' => $events]);
    }
}
