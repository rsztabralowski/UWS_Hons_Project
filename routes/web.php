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
    Route::get('bookings', 'Admin\BookingController@index')->name('bookings');
    Route::get('bookings/getdata', 'Admin\BookingController@getdata')->name('bookings.getdata');
    Route::get('customers/getdata', 'Admin\UserController@getdata')->name('customers.getdata');
    Route::get('rooms/getdata', 'Admin\RoomController@getdata')->name('rooms.getdata');
    Route::get('dashboard', 'Admin\DashboardController@index');
    Route::resource('bookings', 'Admin\BookingController');
    Route::resource('rooms', 'Admin\RoomController');
    Route::resource('customers', 'Admin\UserController');
});