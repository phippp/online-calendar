<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserEventsContoller;
use App\Http\Controllers\CalendarEventController;

Route::get('/calendar/{event:eventName}', [CalendarEventController::class, 'index'])->name('calendar.event');

Route::get('/calendar/{year?}/{month?}', [CalendarController::class, 'index'])->name('calendar');

Route::get('/user/{user:username}/events',[UserEventsContoller::class, 'index'])->name('user.events');

Route::get('/events', [EventsController::class, 'index'])->name('events');
Route::post('/events', [EventsController::class, 'store']);
Route::delete('/events/{event}', [EventsController::class, 'destroy'])->name('events.destroy');

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/', function () {
    return view('index');
})->name('index');
