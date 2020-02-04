<?php

namespace App\Http\Controllers\Admin;

use App\Room;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
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
                'action' => '<a href="rooms/'.$room->id.'/edit" class="btn btn-primary edit" id="'.$room->id.'"><i class="fas fa-edit"></i></a>'
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
            'price' =>  'required|numeric'
        ]);

        $room = new Room([
            'room_number' => $request->get('room_number'),
            'price' => $request->get('price'),
            'description' => $request->get('description')
        ]);

        $room->save();

        return redirect('/admin/rooms')->with('success', ''. __('Room Created') .'');
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
        $photos = Photo::where('room_id', $room->id)->get();

        return view('admin.rooms.edit')->with('room', $room)
                                       ->with('photos', $photos);
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

    public function photodestroy(Request $request)
    {
        $photo = Photo::find($request->photo_id);

        Storage::delete('public/room_photos/'. $photo->url);

        $photo->delete();
    }

    public function addphoto(Request $request, Room $room)
    {
        $this->validate($request, [
            'room_photo' => 'required|image|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('room_photo'))
        {
            // Get filename with the extension
            $filenameWithExt = $request->file('room_photo')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('room_photo')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('room_photo')->storeAs('public/room_photos', $fileNameToStore);
        } 

        $photo = new Photo;
        $photo->room_id = $request->room_id;
        $photo->url = $fileNameToStore;

        $photo->save();

        return redirect()->back()->with('success', 'Photo added');
    }
}
