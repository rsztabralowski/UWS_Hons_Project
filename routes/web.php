<?php

use Illuminate\Http\Request;

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
    return view('calendar');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/make_reservation', 'HomeController@make_reservation')->name('make.reservation');
Route::get('/bookings', 'HomeController@bookings')->name('user.bookings');
Route::get('/account', 'HomeController@account')->name('user.account');

Route::prefix('admin')->middleware('admin')->group(function(){
    Route::get('bookings', 'Admin\BookingController@index')->name('bookings');
    Route::get('calendar', 'Admin\CalendarController@index')->name('calendar');
    Route::get('bookings/getdata', 'Admin\BookingController@getdata')->name('bookings.getdata');
    Route::get('users/getdata', 'Admin\UserController@getdata')->name('users.getdata');
    Route::get('rooms/getdata', 'Admin\RoomController@getdata')->name('rooms.getdata');
    Route::get('rooms/checkavail', 'Admin\BookingController@checkavail')->name('rooms.checkavail');
    Route::get('calendar/getallbookings', 'Admin\CalendarController@getallbookings')->name('calendar.getallbookings');
    Route::get('dashboard', 'Admin\DashboardController@index');
    Route::resource('bookings', 'Admin\BookingController');
    Route::resource('rooms', 'Admin\RoomController');
    Route::resource('users', 'Admin\UserController');
});