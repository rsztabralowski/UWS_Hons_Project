<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Room;

class UserCalendarController extends Controller
{
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

                if(!testRange($s1, $e1, $s2, $e2) && $booking->id != $request->booking_id)
                {
                    $room_available[$room->room_number] = 'Room not available';
                    break;
                }
            }
        }

        echo json_encode($room_available);
    }
}
