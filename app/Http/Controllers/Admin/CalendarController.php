<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Booking;
use App\Room;
use App\CustomClass\Calendar;

class CalendarController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.calendar.index');
    }

    public function getallbookings(Request $request)
    {
        $rooms = Room::all();

        $output = '';
        $list = array();
        
        foreach($rooms as $room)
        {
            $bookings = Booking::where('room_id', $room->id)
                                ->orderBy('time_from', 'asc')
                                ->get(); 

            $previous_booking = '';

            foreach($bookings as $booking)
            {

                $time_from = $booking->time_from;
                $time_to = $booking->time_to;

                $booking_days = Calendar::date_range($time_from, $time_to);

                foreach ($booking_days as $in_booking_date)
                {
                    $add_divider = 'full';
                    if($in_booking_date === reset($booking_days)) $add_divider = 'start';
                    if($in_booking_date === end($booking_days)) $add_divider = 'end';

                    $year = date('Y', strtotime($in_booking_date));
                    $month = date('m', strtotime($in_booking_date));
                    $day = ltrim(date('d', strtotime($in_booking_date)), '0');
                    
                    if($previous_booking == date('d-m-Y', strtotime($time_from))) $add_divider = 'changeover';

                    $list[$room->room_number][$year][$month][$day] = $add_divider;

                    $previous_booking = date('d-m-Y', strtotime($booking->time_to));

                }
            }
        }

        $years = [$request->year];
        $months = [$request->month];

        foreach($rooms as $room)
        {
            foreach($years as $year)
            {
                foreach($months as $month)
                {
                    $in_month_days = cal_days_in_month(CAL_GREGORIAN, $month , $year);

                    for($i=1; $i<=$in_month_days; $i++)
                    {
                        if(isset($list[$room->room_number][$year][$month][$i]))
                        {
                            $full_list[$room->room_number][$year][$month][$i] = $list[$room->room_number][$year][$month][$i];
                        }
                        else
                        {
                            $full_list[$room->room_number][$year][$month][$i] = 'available';
                        }
                    }
                }
            }
        }
        
        $output = '';   

        $in_month_days = cal_days_in_month(CAL_GREGORIAN, $month , $year);

        foreach($rooms as $room)
        {
            $output .= '<div class="title">';
            $output .= 'Room '. $room->room_number;
            $output .= '</div>';

            $output .= '<div class="dayweekcontainer">';

                $output .= '<div class="names">';
                for($i=1; $i<=$in_month_days; $i++)
                {
                    if($full_list[$room->room_number][$year])
                    {
                        $date = $i .'-'. $month .'-'. $year;
                        $output .= '<div class="weekdays">'. date('D', strtotime($date)) .'</div>';
                    }
                }
                $output .= '</div>';

                $output .= '<div class="days">';
                for($i=1; $i<=$in_month_days; $i++)
                {
                    if($full_list[$room->room_number][$year])
                    {
                        $output .= '<div class="day '. $full_list[$room->room_number][$year][$month][$i] .'">'. $i .'</div>';
                    }
                }
                $output .= '</div>';
            $output .= '</div>';
            $output .= '<hr>';
        }
        return $output;
    }
}
