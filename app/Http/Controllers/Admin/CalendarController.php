<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Booking;
use App\Room;

class CalendarController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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

                $temp_divider = '';
                $previous_booking = '';

                foreach($bookings as $booking)
                {

                    $year = strtotime($booking->time_from);
                    $year = date('Y', $year);

                    $year_end = strtotime($booking->time_to);
                    $year_end = date('Y', $year_end);

                    $month = strtotime($booking->time_from);
                    $month = date('m', $month);

                    $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month , $year);

                    $date1 = date_create($booking->time_from);
                    $date2 = date_create($booking->time_to);
                    $diff = date_diff($date1,$date2);

                    $start_date = strtotime($booking->time_from);
                    $start_day = date('d', $start_date);

                    $count = 0;
                    
                    for ($i=$start_day; $i<=($start_day + $diff->format("%a") + 1); $i++)
                    {
                        $add_divider = 'full';
                        if($i == $start_day) $add_divider = 'start';
                        if($i == ($start_day + $diff->format("%a") + 1)) $add_divider = 'end';


                        $day = ltrim($i,"0");

                        if($day > $days_in_month)
                        {
                            $day = 1 + $count;
                            $count++;
                        }

                        if($count > 0)
                        {
                            $month = date('m', strtotime($booking->time_from)) + 1;

                            if($month > 12) 
                            {
                                $month = 1;

                                if($year != $year_end)
                                {
                                    $year = $year_end;
                                }
                            }

                            $month = str_pad($month, 2, '0', STR_PAD_LEFT);
                        }
                        else
                        {
                            $month = date('m', strtotime($booking->time_from));
                        }

                        if($previous_booking == $start_day) $add_divider = 'changeover';

                        $list[$room->room_number][$year][$month][$day] = $add_divider;

                        $temp_divider = $list[$room->room_number][$year][$month][$day] = $add_divider;

                        $previous_booking = strtotime($booking->time_to);
                        $previous_booking = date('d', $previous_booking);

                    }
                }
            }

            $full_list = array();

            $years = [$request->year];
            $months = [$request->month];
            $rooms_list = array_keys($list);

            foreach($rooms_list as $room)
            {
                foreach($years as $year)
                {
                    foreach($months as $month)
                    {
                        $in_month_days = cal_days_in_month(CAL_GREGORIAN, $month , $year);

                        for($i=1; $i<=$in_month_days; $i++)
                        {

                            if(isset($list[$room][$year][$month][$i]))
                            {
                                $full_list[$room][$year][$month][$i] = $list[$room][$year][$month][$i];
                            }
                            else
                            {
                                $full_list[$room][$year][$month][$i] = 'available';
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

                $output .= '<div class="days">';

                for($i=1; $i<=$in_month_days; $i++)
                {
                    if($full_list[$room->room_number][$year])
                    $output .= '<div class="day '. $full_list[$room->room_number][$year][$month][$i] .'">'. $i .'</div>';
                }

                $output .= '</div><hr>';

            }
            return $output;
        }
             
    

    public function index()
    {
        return view('admin.calendar.index');
    }
}
