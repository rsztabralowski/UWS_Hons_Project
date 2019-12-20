@extends('layouts.admin')

@section('content')

<button class="back_btn"><a href="{{ url('/admin/rooms/') }}"><i class="fas fa-arrow-alt-circle-left"></i> Back to Rooms</a></button>
    <div class="booking_info">
        <div class="booking_info_left">
            <div class="form-group">
                <label class="title">Room Number</label>
                <input readonly type="text" name="room_number" id="room_number" value="{{$room->room_number}}" class="form-control" required/>
            </div>
            <div class="form-group">
                <label class="title">Price</label>
                <input readonly type="text" name="price" id="price" value="{{$room->price}}" class="form-control" required/>
            </div>
        </div>
        <div class="booking_info_right">
                <div class="form-group">
                        <label class="title">Description</label>
                        <textarea readonly type="text" name="description" id="description" rows="9" value="" class="form-control">{{$room->description}}</textarea>
                </div>
            </div>
    </div>
<button class="edit_link"><a href="{{$room['id']}}/edit"><i class="fas fa-edit"></i> Edit</a></button>

@endsection