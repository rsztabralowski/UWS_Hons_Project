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

Route::get('/home', 'UserAccount\UserAccountController@index')->name('home');

// ################
// USER
// ################
Route::get('/make_reservation', 'UserAccount\UserAccountController@make_reservation')->name('make.reservation');
Route::get('/bookings', 'UserAccount\UserAccountController@bookings')->name('user.bookings');
Route::get('/account', 'UserAccount\UserAccountController@account')->name('user.account');
Route::get('user/checkavail', 'UserCalendarController@checkavail')->name('user.checkavail');
Route::get('user/session', 'UserCalendarController@session')->name('user.session');
Route::put('/account/{user}', 'UserAccount\UserAccountController@update')->name('user.update');

// ################
// PAYPAL
// ################
Route::get('paypal/express-checkout', 'PaypalController@expressCheckout')->name('paypal.express-checkout');
Route::get('paypal/express-checkout-success', 'PaypalController@expressCheckoutSuccess');
Route::get('paypal/cancelled', 'PaypalController@cancelled');
Route::post('paypal/notify', 'PaypalController@notify');

// ################
// ADMIN
// ################
Route::prefix('admin')->middleware('admin')->group(function(){
    Route::get('bookings', 'Admin\BookingController@index')->name('bookings');
    Route::get('calendar', 'Admin\CalendarController@index')->name('calendar');
    Route::get('bookings/getdata', 'Admin\BookingController@getdata')->name('bookings.getdata');
    Route::get('users/getdata', 'Admin\UserController@getdata')->name('users.getdata');
    Route::get('rooms/getdata', 'Admin\RoomController@getdata')->name('rooms.getdata');
    Route::get('rooms/photodestroy', 'Admin\RoomController@photodestroy')->name('rooms.photodestroy');
    Route::post('rooms/addphoto', 'Admin\RoomController@addphoto')->name('rooms.addphoto');
    Route::get('rooms/checkavail', 'Admin\BookingController@checkavail')->name('rooms.checkavail');
    Route::get('calendar/getallbookings', 'Admin\CalendarController@getallbookings')->name('calendar.getallbookings');
    Route::get('dashboard', 'Admin\DashboardController@index');
    Route::resource('bookings', 'Admin\BookingController');
    Route::resource('rooms', 'Admin\RoomController');
    Route::resource('users', 'Admin\UserController');
});