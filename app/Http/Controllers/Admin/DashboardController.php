<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Booking;
use App\CustomClass\Calendar;

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
        ///////////////////////
        // BOOKING STARTING AND ENDIG THIS WEEK
        ///////////////////////

        $today = date('Y-m-d');
        $start_count = 0;
        $end_count = 0;
        $starting = array();
        $ending = array();
        $bookings = array();
        $next_week = date('Y-m-d', strtotime($today .' + 7 days')) ;

        $bookings_starting = Booking::with('room')->whereBetween('time_from', [$today, $next_week])
                                                  ->orderBy('time_from', 'asc')
                                                  ->get();

        if(count($bookings_starting) > 0)
        {   
            $previous_date = '';    

            foreach($bookings_starting as $booking)
            {
                if($previous_date != date('d-m-Y', strtotime($booking->time_from)) && $previous_date != '') 
                {
                    $bookings['starting'][] = '<hr>';
                }

                $bookings['starting'][] = '<li><a href="bookings/'.$booking->id.'">'. date('D', strtotime($booking->time_from)) .'<strong> '. date('d-m-Y', strtotime($booking->time_from)) .'</strong> - '. $booking->room->room_number .'</a></li>';
                $start_count++;
                $previous_date = date('d-m-Y', strtotime($booking->time_from));
            }
        }
        else
        {
            $bookings['starting'][] = "";
        }

        $bookings_ending = Booking::with('room')->whereBetween('time_to', [$today, $next_week])
                                                ->orderBy('time_to', 'asc')
                                                ->get();
        
        if(count($bookings_ending) > 0)
        {
            $previous_date = '';                                             

            foreach($bookings_ending as $booking)
            {
                if($previous_date != date('d-m-Y', strtotime($booking->time_to)) && $previous_date != '') 
                {
                    $bookings['ending'][] = '<hr>';
                }

                $bookings['ending'][] = '<li><a href="bookings/'.$booking->id.'">'. date('D', strtotime($booking->time_to)) .'<strong> '. date('d-m-Y', strtotime($booking->time_to)) .'</strong> - '. $booking->room->room_number .'</a></li>';
                $end_count++;
                $previous_date = date('d-m-Y', strtotime($booking->time_to));
            }
        }
        else
        {
            $bookings['ending'][] = "";
        }

        $bookings['count']['starting'] = $start_count;
        $bookings['count']['ending'] = $end_count;

        ///////////////////////
        // MONTHLY INCOME
        ///////////////////////

        $this_month_bookings = Booking::whereMonth('time_to', '=', date('m'))->with('room')->get();
        $this_month_bookings_count = $this_month_bookings->count();
        $this_month_income = 0;
        foreach($this_month_bookings as $booking)
        {
            $time_from = date('Y-m-d', strtotime( $booking->time_from));
            $time_to = date('Y-m-d', strtotime( $booking->time_to));
            $nights = count(Calendar::date_range($time_from, $time_to)) -1;
            $price =  round($booking->fullprice, 2);
            $this_month_income += $price;
        }

        ///////////////////////
        // ANNUAL INCOME
        ///////////////////////

        $this_year_bookings = Booking::whereYear('time_to', '=', date('Y'))->with('room')->get();
        $this_year_bookings_count = $this_year_bookings->count();
        $this_year_income = 0;
        foreach($this_year_bookings as $booking)
        {
            $time_from = date('Y-m-d', strtotime( $booking->time_from));
            $time_to = date('Y-m-d', strtotime( $booking->time_to));
            $nights = count(Calendar::date_range($time_from, $time_to)) -1;
            $price =  round($booking->fullprice, 2);
            $this_year_income += $price;
        }


        return view('admin.dashboard.index')->with('bookings', $bookings)
                                            ->with('this_month_income', $this_month_income)
                                            ->with('this_year_income', $this_year_income)
                                            ->with('this_month_bookings_count', $this_month_bookings_count)
                                            ->with('this_year_bookings_count', $this_year_bookings_count);

    }
}
