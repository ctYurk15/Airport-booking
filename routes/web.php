<?php

use Illuminate\Support\Facades\Route;

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

//auth
Route::get('/', function () { //login page
    return view('auth.login');
})->name('login');

Route::get('/reg', function () { //register page
    return view('auth.register');
})->name('register');

//login route
Route::post('/authorize', 'App\Http\Controllers\AuthController@authorizeUser')->name('authorize');

//main
Route::get('/flights', function () { //buy ticket
    return view('main.flights');
})->name('flights');

Route::get('/hotels', function () { //buy ticket
    return view('main.hotels');
})->name('hotels');

Route::get('/private', function () { //buy ticket
    return view('main.private');
})->name('private');

Route::get('/account', function () { //buy ticket
    return view('main.account');
})->name('account');
