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
})->name('registration');

Route::post('/authorize', 'App\Http\Controllers\AuthController@authorizeUser')->name('authorize'); //login route
Route::post('/register', 'App\Http\Controllers\AuthController@registerUser')->name('register'); //register route
Route::post('/loginStatus', 'App\Http\Controllers\AuthController@loginStatus')->name('loginStatus'); //check login status route
Route::post('/unlogin', 'App\Http\Controllers\AuthController@unlogin')->name('unlogin'); //unlogin route
Route::post('/passport_request', 'App\Http\Controllers\PassportRequestController@addPR')->name('passport_request'); //KYC verification 

//purchase
Route::post('/purchaseTickets', 'App\Http\Controllers\PurchaseController@purchaseTicket')->name('purchaseTickets'); //tickets
Route::post('/purchaseRooms', 'App\Http\Controllers\PurchaseController@purchaseRoom')->name('purchaseRooms'); //rooms

//main
Route::get('/flights', 'App\Http\Controllers\FlightsController@index')->name('flights'); //flights page
Route::get('/hotels', 'App\Http\Controllers\HotelsController@index')->name('hotels'); //hotels page

Route::get('/private', function () { //private reis page
    return view('main.private');
})->name('private');

Route::get('/account', 'App\Http\Controllers\AccountController@index')->name('account'); //account page

Route::get('/adminka', 'App\Http\Controllers\AccountController@adminka');
