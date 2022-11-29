<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    public function create(){
        return view('events');
    }

    public function getOne($uuid){

        $event = DB::table('events')
            ->join('users', 'users.id', '=', 'events.user_id')
            ->where('events.uuid', '=', $uuid)            
            ->limit(1)
            ->first("*");

        $nbInterested = DB::table('events_users')->where('events_id','=', $event->id)->where('choice','=',0)->count();
        $nbGoing = DB::table('events_users')->where('events_id','=', $event->id)->where('choice','=',1)->count();
        $guests = [ $nbInterested, $nbGoing, $nbGoing + $nbInterested ]; 
        
        $allreadyJoined = (Auth::user()) ? DB::table('events_users')->where('events_id', '=', $event->id)->where('user_id','=',Auth::user()->id)->first('choice') : null ;
        

        $allParticipant = (Auth::user() && Auth::user()->id == $event->user_id) ?
             DB::table('events_users')
            ->join('users', 'users.id', '=', 'user_id')
            ->where('events_id','=', $event->id)->get() : null;
        
            

        $fullDate = Carbon::create($event->startDateTime);
        $date = $fullDate->format('jS F Y h:i A');

        return view('eventsOne',compact('event', 'date', 'allreadyJoined', 'guests', 'allParticipant'));
    }

    public function action($uuid, Request $request){

        $event = DB::table('events')->where('events.uuid', '=', $uuid)->limit(1)->first("id");
        $user_id = Auth::user()->id;

        $r = null;
        if($request->input('choice'))
        {
            //Join Events
            $choice = ($request->choice == "Going") ? 1 : 0;            

            DB::table('events_users')->insert(
                array(
                    'user_id' => $user_id,
                    'events_id' => $event->id,
                    'choice' => $choice,
                    'created_at' => Carbon::now(),
                )  
            );
            $r = ["type"=>"success", "message" => "You have joined the event as \"{$request->choice}\"."];
        }
        elseif($request->input('change'))
        {
            $choice = ($request->change == "Going") ? 1 : 0;

            DB::table('events_users')
            ->where('user_id', '=', $user_id)
            ->where('events_id', '=', $event->id)
            ->update(
                array(
                    'choice' =>  $choice,
                    'updated_at' => Carbon::now(),
                )
            );

            $r = ["type"=>"success", "message" => "Update done."];
        }
        elseif($request->input('leave')){
            DB::table('events_users')
            ->where('user_id', '=', $user_id)
            ->where('events_id', '=', $event->id)
            ->delete();

            $r = ["type"=>"success", "message" => "You have leave the event."];
        }

        
        return ($r != null) ? back()->with('alert', $r) : back();
        
    }
}
