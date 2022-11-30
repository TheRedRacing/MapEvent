<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function index() {
        $msg = "This is a simple message.";
        return response()->json(array('msg'=> $msg), 200);
    }

    public function getAllValidEvent() {
        
        $events = DB::table('events')
                    ->where('startDateTime','>',Carbon::now())
                    ->orderBy('startDateTime','asc')
                    ->groupBy('fullAddress')
                    ->get();

        return response()->json($events,200);
    }

    public function getAllEventFromAddress($uuid){

        $event = DB::table('events')
        ->where('uuid','=',$uuid)
        ->where('startDateTime','>',Carbon::now())
        ->limit(1)
        ->first();
        
        $fullDate = Carbon::create($event->startDateTime);
        $event->startDateTime = $fullDate->format('jS F Y h:i A');
        
        $otherEvent = $otherEvents = DB::table('events')
        ->where('fullAddress','=',$event->fullAddress)
        ->where('startDateTime','>',Carbon::now())
        ->where('uuid', '!=', $event->uuid)
        ->orderBy('startDateTime','asc')
        ->limit(4)
        ->get();

        return response()->json(array(
            "event" => $event,
            "otherEvents" => $otherEvent
        ),200);
    }
}
