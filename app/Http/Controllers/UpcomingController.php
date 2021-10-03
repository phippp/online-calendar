<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpcomingController extends Controller
{

    public function index(){

        if(Auth::guest())
            return view('index');

        $date = Carbon::now();
        $upcoming = Event::where(['user_id' => auth()->user()->id])->whereBetween('startDate', [$date->format('Y-m-d'),$date->addDays(14)->format('Y-m-d')])->orderBy('startDate', 'asc')->get();
        return view('index', [
            'events' => $upcoming
        ]);


    }


}
