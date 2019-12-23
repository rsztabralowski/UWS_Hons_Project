<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Booking;
use App\Room;
use App\User;
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
     * Get data to be displayed in DataTables.
     *
     * @return DataTables
     */
    public function getdata()
    {
        $bookings = Booking::with('user', 'room', 'payment')->get();
        foreach($bookings as $booking)
        {
            $re = '/\d{4}-\d{2}-\d{2}/';
            $str_from = $booking->time_from;
            $str_to = $booking->time_to;

            preg_match($re, $str_from, $day_from, PREG_OFFSET_CAPTURE, 0);
            preg_match($re, $str_to, $day_to, PREG_OFFSET_CAPTURE, 0);

            $response['data'][] = array(
                'username' => $booking->user->username,
                'email' => $booking->user->email,
                'time_from' => $day_from[0][0],
                'time_to' => $day_to[0][0],
                'room_number' => $booking->room->room_number,
                'id' => $booking->id,
                'action' => '<a href="bookings/'.$booking->id.'" class="btn btn-primary edit" id="'.$booking->id.'"><i class="fas fa-eye"></i></a>'           
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
            'room_number' => new CheckRoomNumber
        ]);

        $room = Room::where('room_number', $request->input('room_number'))->get();

        $room_id = '';
        if (isset($room[0]))
        {
            $room_id = $room[0]->id;
        }

        $booking = new Booking([
            'time_from' => $request->get('time_from'),
            'time_to' => $request->get('time_to'),
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

        $re = '/\d{4}-\d{2}-\d{2}/';
                    $str_from = $booking->time_from;
                    $str_to = $booking->time_to;

                    preg_match($re, $str_from, $day_from, PREG_OFFSET_CAPTURE, 0);
                    preg_match($re, $str_to, $day_to, PREG_OFFSET_CAPTURE, 0);

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
            'room_number' => new CheckRoomNumber
        ]);

        $user = User::find($booking->user_id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');

        $update_booking = Booking::find($booking->id);
        $update_booking->time_from = $request->input('time_from');
        $update_booking->time_to = $request->input('time_to');
        $update_booking->more_info = $request->input('more_info');
        
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
