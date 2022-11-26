<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class WelcomeController extends Controller
{
    /**
    * Display the registration view.
    *
    * @return \Illuminate\View\View
    */
    public function create()
    {
        return view('welcome');
    }

    public function store(Request $request) 
    {
        App::setLocale($request->changeLanguage);
        return view('welcome');
    }
}
