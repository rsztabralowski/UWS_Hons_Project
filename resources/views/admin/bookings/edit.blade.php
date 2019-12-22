@extends('layouts.admin')

@section('content')

<button class="back_btn"><a href="{{ url('/admin/bookings/'. $booking->id) }}"><i class="fas fa-arrow-alt-circle-left"></i> Cancel edit</a></button>

{!! Form::open(['action' => ['Admin\BookingController@update', $booking->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
    <div class="booking_info">
        <div class="booking_info_left">
            <div class="form-group">
                <label class="title">First name</label>
                <input type="text" name="first_name" id="first_name" value="{{$booking->user['first_name']}}" class="form-control" />
            </div>
            <div class="form-group">
                <label class="title">Last name</label>
                <input type="text" name="last_name" id="last_name" value="{{$booking->user['last_name']}}" class="form-control" />
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