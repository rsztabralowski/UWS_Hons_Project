<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $bookings = Booking::where('user_id', Auth::id())
                            ->orderBy('time_from')
                            ->orderBy('time_to')
                            ->get();

        return view('user_account.bookings')->with('bookings', $bookings);
    }

    public function account()
    { 
        return view('user_account.account');
    }
}
