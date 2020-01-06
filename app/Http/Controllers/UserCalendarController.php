<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Room;
use App\CustomClass\Calendar;
use App\CustomClass\Functions;

class UserCalendarController extends Controller
{
    public function session(Request $request)
    {
        session(Functions::unserialize_from_base64($request->booking));
    }

    public function checkavail(Request $request)
    {
        function testRange($s1,$e1,$s2,$e2)
        {
            return ($e1 < $s2 || $s1 > $e2);
        }
        
        $room_available = array();
        $rooms = Room::all('id', 'room_number', 'price', 'description');
        $output = '';

        foreach($rooms as $room)
        {
            $bookings = Booking::where('room_id', $room->id)->get();

            $room_available[$room->room_number] = $room;

            foreach ($bookings as $booking)
            {
                $room_available[$room->room_number] = $room;

                $s1 = strtotime($request->time_from);
                $e1 = strtotime($request->time_to);
                $s2 = strtotime($booking->time_from);
                $e2 = strtotime($booking->time_to);

                if(!testRange($s1, $e1, $s2, $e2))
                {
                    $room_available[$room->room_number] = 'Room not available';
                    break;
                }
            }
        }

        $count = 0;
        $html = '';
        $session = array();
        $html .= '<div class="row justify-content-center">';

        foreach($room_available as $key_rooms => $room_array)
        {
            if(is_object($room_array))
            {
                $booking_days = Calendar::date_range($request->time_from, $request->time_to);
                $nights = count($booking_days) -1;
                $price = $nights * $room_array->price;

                $session = [
                    'room' => $room_array->room_number,
                    'time_from' => $request->time_from,
                    'time_to' => $request->time_to,
                    'nights' => $nights,
                    'price' => $price
                ];

                $session = Functions::serialize_to_base64($session);

                $html .= '
                    <div class="col-md-8 mt-4">
                        <div class="card">
                            <div class="card-header">Room '. $room_array->room_number .'</div>
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <a href="'. route("make.reservation") .'">
                                        <button class="btn btn-primary session"
                                                data-booking = "'. $session .'"
                                            >Make reservation
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
                $count++;
            }
            else
            {
                continue;
            }
        }
            $html .= '</div>';

        if($count == 0)
        {
            $html = '
                <div class="row justify-content-center">
                    <div class="col-md-8 mt-4">
                        <div class="card">
                            <div class="card-header">Sorry</div>
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <p>We have no rooms available on selected dates</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }

        return ($html);
    }
}
