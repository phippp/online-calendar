<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'eventName',
        'startDate',
        'endDate',
        'time',
        'details',
        'repeat'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function days()
    {
        if($this->endDate == null){
            return 1;
        }
        $start = Carbon::parse($this->startDate);
        $end = Carbon::parse($this->endDate);
        return $start->diffInDays($end) + 1;
    }
}
