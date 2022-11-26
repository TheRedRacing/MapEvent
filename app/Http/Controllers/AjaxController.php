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

    public function getAllEventFromAddress($id){
        $event = DB::table('events')
        ->where('id','=',$id)
        ->where('startDateTime','>',Carbon::now())
        ->limit(1)
        ->get();

        $allEventAddress = DB::table('events')
        ->where('fullAddress','=',$event[0]->fullAddress)
        ->where('startDateTime','>',Carbon::now())
        ->orderBy('startDateTime','asc')
        ->limit(4)
        ->get();

        return response()->json($allEventAddress,200);
    }
}
