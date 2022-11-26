<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\newEventController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WelcomeController::class, 'create'])->name('welcome');
Route::post('/', [WelcomeController::class, 'store'])->name('welcome');

//Home get and post page
Route::get('/home', [HomeController::class, 'create'])->middleware(['auth', 'verified'])->name('home');
Route::post('/home', [HomeController::class, 'store'])->middleware(['auth', 'verified'])->name('home');


Route::get('/newevents', [newEventController::class, 'create'])->middleware(['auth', 'verified'])->name('newevents');

Route::get('/events', [EventsController::class, 'create'])->middleware(['auth', 'verified'])->name('events');
Route::get('/events/{uuid?}', [EventsController::class, 'getOne'])->name('events');

Route::get('/explore', [ExploreController::class, 'create'])->middleware(['auth', 'verified'])->name('explore');
Route::get('/news', function () { return view('news'); })->middleware(['auth', 'verified'])->name('news');


//Profile get and post page
Route::get('/@{username}', [ProfileController::class, 'create'])->middleware(['auth', 'verified'])->name('profile');
Route::post('/@{username}', [ProfileController::class, 'store'])->middleware(['auth', 'verified'])->name('profile');
Route::get('/admin', [ProfileController::class, 'admin'])->middleware(['auth', 'verified'])->name('admin');

// AJax Call
Route::post('/getEvents',[AjaxController::class, 'getAllValidEvent'])->middleware(['auth', 'verified']);
Route::post('/getEvents/{id}',[AjaxController::class, 'getAllEventFromAddress'])->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
