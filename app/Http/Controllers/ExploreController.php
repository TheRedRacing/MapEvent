<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExploreController extends Controller
{
    public function create()
    {
        $events = DB::table('events')
        ->where('startDateTime', '>', Carbon::now())
        ->orderBy('startDateTime','asc')
        ->groupBy('fullAddress')
        ->get();

        return view('explore', compact('events'));
    }
}
