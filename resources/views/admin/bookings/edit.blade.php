@extends('layouts.admin')

@section('content')

@php
use App\Room;

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

@endphp
<button class="back_btn"><a href="{{ url('/admin/bookings/'. $booking->id) }}"><i class="fas fa-arrow-alt-circle-left"></i> Cancel edit</a></button>

{!! Form::open(['action' => ['Admin\BookingController@update', $booking->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
    <div class="booking_info">
        <div class="booking_info_left">
            <div class="form-group">
                    <label class="title">Customer name</label>
                    <input type="text" name="customer_name" id="customer_name" value="{{$booking->customer['first_name']. ' '. $booking->customer['last_name']}}" class="form-control" />
            </div>
            <div class="form-group">
                    <label class="title">Time from</label>
                    <input type="date" name="time_from" id="time_from" value="{{$day_from[0][0]}}" class="form-control" required/>
            </div>
            <div class="form-group">
                    <label class="title">Time to</label>
                    <input type="date" name="time_to" id="time_to" value="{{$day_to[0][0]}}" class="form-control" required/>
            </div>

            <div class="form-group">
                <label class="title">Room number</label>
                <select class="form-control" name="room_number" id="room_number">
                  @php echo $room_options @endphp
                </select>
            </div>
        </div>
        <div class="booking_info_right">
                <div class="form-group">
                        <label class="title">More info</label>
                        <textarea type="text" name="more_info" id="more_info" rows="9" value="" class="form-control">{{old('more_info', $booking->more_info)}}</textarea>
                </div>
            </div>
    </div>
    <div class="buttons">
        {{Form::button('<i class="fas fa-share-square"></i> Save', ['class'=>'btn btn-primary', 'type' => 'submit'])}}
        {!! Form::close() !!}

        {!!Form::open(['action' => ['Admin\BookingController@destroy', $booking->id], 'method' => 'POST', 'onsubmit' => "return confirm('Are you sure you want to delete?')"])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::button('<i class="fas fa-trash-alt"></i> Delete', ['class'=>'btn btn-danger', 'type' => 'submit'])}}

        {!!Form::close()!!}
    </div>

@endsection