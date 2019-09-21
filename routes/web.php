<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/calendar', 'CalendarController@index')->name('calendar');

Route::prefix('admin')->middleware('admin')->group(function(){
    Route::resource('booking', 'Admin\BookingController');
    Route::resource('room', 'Admin\RoomController');
    Route::resource('customer', 'Admin\CustomerController');
});