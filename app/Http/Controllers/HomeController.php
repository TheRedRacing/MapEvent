<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        App::setLocale(Auth::user()->language);
        
        $mapsettings = json_decode(Auth::user()->mapview);
        return view('home',compact('mapsettings'));
    }

    public function detail($uuid)
    {
        $event = DB::table('events')
        ->where('uuid','=',$uuid)
        ->where('startDateTime','>',Carbon::now())
        ->limit(1)
        ->first();

        $otherEvents = DB::table('events')
        ->where('fullAddress','=',$event->fullAddress)
        ->where('startDateTime','>',Carbon::now())
        ->where('uuid', '!=', $event->uuid)
        ->orderBy('startDateTime','asc')
        ->limit(4)
        ->get();

        $fullDate = Carbon::create($event->startDateTime);
        $event->startDateTime = $fullDate->format('jS F Y h:i A');

        $event->latitude = $event->latitude - 0.001;

        $mapsettings = json_decode('{"lat":"'.$event->latitude.'","lng":"'.$event->longitude.'","zoom":"16.0"}');

        return view('home', compact('event','otherEvents','mapsettings'));
    }
}
