@extends('layouts.admin')

@section('content')

<button class="back_btn"><a href="{{ url('admin/bookings') }}"><i class="fas fa-arrow-alt-circle-left"></i> Back to bookings</a></button>
<div class="booking_info">
    <div class="booking_info_left">
        <div class="form-group">
                <label class="title">Customer name</label>
                <input readonly type="text" name="customer_name" id="customer_name" value="{{$booking->customer['first_name']. ' '. $booking->customer['last_name']}}" class="form-control" />
        </div>
        <div class="form-group">
                <label class="title">Time from</label>
                <input readonly type="text" name="time_from" id="time_from" value="{{$booking->time_from}}" class="form-control" />
        </div>
        <div class="form-group">
                <label class="title">Time to</label>
                <input readonly type="text" name="time_to" id="time_to" value="{{$booking->time_to}}" class="form-control" />
        </div>
        <div class="form-group">
                <label class="title">Room number</label>
                <input readonly type="text" name="room_number" id="room_number" value="{{$booking->room['room_number']}}" class="form-control" />
        </div>
    </div>
    <div class="booking_info_right">
            <div class="form-group">
                    <label class="title">More info</label>
                    <textarea readonly type="text" name="more_info" id="more_info" rows="9" value="" class="form-control">{{$booking->more_info}}</textarea>
            </div>
        </div>
</div>
<button class="edit_link"><a href="{{$booking['id']}}/edit"><i class="fas fa-edit"></i> Edit</a></button>

@endsection