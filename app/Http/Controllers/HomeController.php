<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Payment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user_account.home');
    }

    public function make_reservation()
    { 
        return view('user_account.make_reservation');
    }

    public function bookings()
    { 
        return view('user_account.bookings');
    }

    public function account()
    { 
        return view('user_account.account');
    }
}
