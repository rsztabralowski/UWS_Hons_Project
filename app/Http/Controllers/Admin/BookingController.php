<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

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

    public function getdata()
    {
        // $bookings = Booking::select('time_from', 'time_to', 'more_info')->get();
        $bookings = Booking::with('customer', 'room', 'payment')->get();

        foreach($bookings as $booking)
        {
            $button = '
            <button type="button" name="edit" id="' .$booking->customer->id. '" class="btn btn-default btn-sm edit-btn edit"><span class="glyphicon glyphicon-edit"></span> Edit</button>
            <button type="button" name="delete" id="' .$booking->customer->id. '" class="btn btn-default btn-sm delete"><span class="glyphicon glyphicon-trash"></span> Delete </button>
            ';

            $response['data'][] = array(
                'time_from' => $booking->time_from,
                'time_to' => $booking->time_to,
                'last_name' => $booking->customer->last_name,
                'button' => $button
            );
        }

       

        // return DataTables::of($bookings)->make(true);
        // return DataTables::of($response)->make(true);
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        return view('admin.bookings.edit')->with('booking', $booking);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
