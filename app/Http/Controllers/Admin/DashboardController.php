<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Booking;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sunday = '';
        $starting = array();
        $ending = array();

        if(date('D') == 'Sun')
        {
            $sunday = date('Y-m-d');
        }
        else
        {
            $sunday = date('Y-m-d', strtotime('last sunday')) ;
        }

        $saturday = date('Y-m-d', strtotime($sunday .' + 6 days')) ;

        $bookings_starting = Booking::with('room')
                                                ->whereBetween('time_from', [$sunday, $saturday])
                                                ->orderBy('time_from', 'asc')
                                                ->get();

        foreach($bookings_starting as $booking)
        {
            $bookings['starting'][date('d-m-Y', strtotime($booking->time_from))][$booking->id] = $booking->room->room_number;
        }

        $bookings_ending = Booking::with('room')
                                                ->whereBetween('time_to', [$sunday, $saturday])
                                                ->orderBy('time_to', 'asc')
                                                ->get();

        foreach($bookings_ending as $booking)
        {
            $bookings['ending'][date('d-m-Y', strtotime($booking->time_to))][$booking->id] = $booking->room->room_number;
        }

        return view('admin.dashboard.index')->with('bookings', $bookings); 
    }
}
