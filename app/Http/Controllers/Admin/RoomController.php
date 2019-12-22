<?php

namespace App\Http\Controllers\Admin;

use App\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class RoomController extends Controller
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
        return view('admin.rooms.index'); 
    }

     /**
     * Get data to be displayed in DataTables.
     *
     * @return DataTables
     */
    public function getdata()
    {
        $rooms = Room::all();
        foreach($rooms as $room)
        {
            $response['data'][] = array(
                'id' => $room->id,
                'room_number' => $room->room_number,
                'price' => $room->price,
                'description' => $room->description,
                'action' => '<a href="rooms/'.$room->id.'" class="btn btn-primary edit" id="'.$room->id.'"><i class="fas fa-eye"></i></a>'
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
        return view('admin.rooms.create'); 
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
            'room_number' =>  'required',
            'price' =>  'required'
        ]);

        $room = new Room([
            'room_number' => $request->get('room_number'),
            'price' => $request->get('price'),
            'description' => $request->get('description')
        ]);

        $room->save();

        return redirect('/admin/rooms')->with('success', 'Room Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return view('admin.rooms.show')->with('room', $room);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('admin.rooms.edit')->with('room', $room);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $this->validate($request, [
            'room_number' =>  'required',
            'price' =>  'required|numeric'
        ]);

        $update_room = Room::find($room->id);
        $update_room->room_number = $request->get('room_number');
        $update_room->price = $request->get('price');
        $update_room->description = $request->get('description');

        $update_room->save();

        return redirect('/admin/rooms')->with('success', 'Room Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        // $room->delete();

        return redirect('/admin/rooms')->with('error', 'Room can not be removed at the moment');
    }
}
