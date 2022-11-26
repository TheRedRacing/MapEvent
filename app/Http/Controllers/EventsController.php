<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class EventsController extends Controller
{
    public function create(){
        return view('events');
    }

    public function getOne($uuid){

        $db = DB::table('events')
            ->join('users', 'users.id', '=', 'events.user_id')
            ->where('events.uuid', '=', $uuid)            
            ->limit(1)
            ->get("*");

        $event = $db[0];

        $fullDate = Carbon::create($event->startDateTime);
        $date = $fullDate->format('jS F Y h:i A');

        return view('eventsOne',compact('event', 'date'));
    }
}
