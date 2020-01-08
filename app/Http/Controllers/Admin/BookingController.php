<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Booking;
use App\Room;
use App\User;
use App\Payment;
use App\CustomClass\Calendar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\CheckRoomNumber;
use DB;


class BookingController extends Controller
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
    
        return view('admin.bookings.index'); 

    }

     /**
     * Get data to check room availability.
     *
     * @return JSON
     */
    public function checkavail(Request $request)
    {

        function testRange($s1,$e1,$s2,$e2)
        {
            return ($e1 < $s2 || $s1 > $e2);
        }
        
        $room_available = array();
        $rooms = Room::all('id', 'room_number');
        $output = '';

        foreach($rooms as $room)
        {
            $bookings = Booking::where('room_id', $room->id)->get();

            $room_available[$room->room_number] = 'Room available';

            foreach ($bookings as $booking)
            {
                $room_available[$room->room_number] = 'Room available';

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

        $count = 0;

        foreach($room_available as $key => $value)
        {
            if($value == 'Room available')
                $output .= '<option value="' .$key. '">' .$key. '</option>';

            if($value == 'Room not available')
                $count ++;

        }

        if($count == $rooms->count())
            $output .= '<option value="">No rooms available</option>';
        
        echo json_encode($output);
    }

     /**
     * Get data to be displayed in DataTables.
     *
     * @return DataTables
     */
    public function getdata()
    {

        $response = array();

        if (request('show_all') == 1) 
        {
            $bookings = Booking::all();
        }
        elseif (request('show_past') == 1) 
        {
            $bookings = Booking::where('time_to', '<', date('Y-m-d'))
                                 ->get();
        }
        else 
        {
            $bookings = Booking::where('time_to', '>', date('Y-m-d'))
                                 ->get();
        }

         
        foreach($bookings as $booking)
        {
            $time_from = date('Y-m-d', strtotime( $booking->time_from));
            $time_to = date('Y-m-d', strtotime( $booking->time_to));
            $nights = count(Calendar::date_range($time_from, $time_to)) -1;
            $price =  round($booking->room->price * $nights, 2);
            $deposit = round(($price * 0.2), 2);

            if (isset($booking->payment->id))
            {
                if ($booking->payment->payment_status == 'Completed')
                    $status = '<button class="btn btn-sm" style="background-color: lightgreen">'. $booking->payment->payment_status .'</button>';
                elseif ($booking->payment->payment_status == 'Pending')
                    $status = '<button class="btn btn-sm" style="background-color: orange">'. $booking->payment->payment_status .'</button>';
                elseif ($booking->payment->payment_status == 'Not Paid')
                    $status = '<button class="btn btn-sm" style="background-color: #ff7f7f">'. $booking->payment->payment_status .'</button>';
                else
                    $status = $booking->payment->payment_status;
            }
            else
            {
                $status = '<button class="btn btn-sm" style="background-color: #ff7f7f">Not Paid</button>';
            }

            $response['data'][] = array(
                'id' => $booking->id,
                'username' => $booking->user->username,
                'email' => $booking->user->email,
                'time_from' => $time_from,
                'time_to' => $time_to,
                'room_number' => $booking->room->room_number,
                'nights' => $nights,
                'price' => '&pound;'. $price,
                'deposit' => '&pound;'. $deposit,
                'status' => $status,
                'action' => '<a href="bookings/'.$booking->id.'/edit" class="btn btn-primary edit" id="'.$booking->id.'"><i class="fas fa-edit"></i></a>'           
            );
        }

        echo json_encode($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::all('id', 'username', 'first_name', 'last_name', 'email');
        $user_list = '';

        foreach($users as $user)
        {
            if($user->first_name === null)
            {
                $user_list .= '<option value="'.$user->id.'">'.$user->username.'</option>';
            }
            else
            {
                $user_list .= '<option value="'.$user->id.'">'.$user->first_name.' '.$user->last_name.'</option>';
            }

        }

        $rooms = Room::all();
        $room_options = '';

        foreach($rooms as $room)
        {
            $room_options .= '<option value="' .$room->room_number. '">' .$room->room_number. '</option>';
        }

        return view('admin.bookings.create')->with('room_options', $room_options)
                                            ->with('user_list', $user_list); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'time_from' =>  'required',
            'time_to' =>  'required',
            'room_number' => ['required', new CheckRoomNumber ]
        ]);

        $room = Room::where('room_number', $request->input('room_number'))->get();

        $room_id = '';
        if (isset($room[0]))
        {
            $room_id = $room[0]->id;
        }

        $booking = new Booking([
            'time_from' => $request->get('time_from'). ' 15:00:00',
            'time_to' => $request->get('time_to'). ' 12:00:00',
            'more_info' => $request->get('more_info'),
            'user_id' => $request->get('user_name'),
            'room_id' => $room_id
        ]);

        $booking->save();
        
        return redirect('/admin/bookings')->with('success', 'Booking Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        return view('admin.bookings.show')->with('booking', $booking);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {

        $rooms = Room::all();
        $room_options = '';

        foreach($rooms as $room)
        {
            if($room->room_number == $booking->room['room_number'])
            {
                $room_options .= '<option value="' .$room->room_number. '" selected>' .$room->room_number. '</option>';
            }
            else
            {
                $room_options .= '<option value="' .$room->room_number. '">' .$room->room_number. '</option>';
            }
        }

        $day_from = date('Y-m-d', strtotime( $booking->time_from));
        $day_to = date('Y-m-d', strtotime( $booking->time_to));

        return view('admin.bookings.edit')->with('booking', $booking)
                                          ->with('room_options', $room_options)
                                          ->with('day_from', $day_from)
                                          ->with('day_to', $day_to);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {

        $this->validate($request, [
            'time_from' =>  'required',
            'time_to' =>  'required',
            'room_number' => [new CheckRoomNumber]
        ]);

        $user = User::find($booking->user_id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');

        $update_booking = Booking::find($booking->id);
        $update_booking->time_from = $request->input('time_from'). ' 15:00:00';
        $update_booking->time_to = $request->input('time_to'). ' 12:00:00';
        $update_booking->more_info = $request->input('more_info');

        if($request->input('status') != 'null' && Payment::find($booking->payment_id) != null)
        {
            $payment = Payment::find($booking->payment_id);
            $payment->payment_status = $request->input('status');
            $payment->save();
        }

        $room = Room::where('room_number', $request->input('room_number'))->get();

        if (isset($room[0]))
        {
            $update_booking->room_id = $room[0]->id;
        }

        $update_booking->save();
        $user->save();

        return redirect('/admin/bookings')->with('success', 'Booking Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect('/admin/bookings')->with('success', 'Booking Removed');
    }
}
