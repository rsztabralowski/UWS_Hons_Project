@extends('layouts.admin')

@section('content')

<button class="back_btn"><a href="{{ url('/admin/bookings') }}"><i class="fas fa-arrow-alt-circle-left"></i> {{ __('Go back') }}</a></button>

{!! Form::open(['action' => ['Admin\BookingController@update', $booking->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
    <div class="booking_info">
        <div class="booking_info_left">
            <div class="form-group">
                <label class="title">{{ __('First name') }}</label>
                <input type="text" name="first_name" id="first_name" value="{{$booking->user['first_name']}}" class="form-control" />
            </div>
            <div class="form-group">
                <label class="title">{{ __('Last name') }}</label>
                <input type="text" name="last_name" id="last_name" value="{{$booking->user['last_name']}}" class="form-control" />
            </div>
            <div class="form-group">
                    <label class="title">{{ __('Time from') }}</label>
                    <input type="date" name="time_from" id="time_from" value="{{$day_from}}" class="form-control" required/>
            </div>
            <div class="form-group">
                    <label class="title">{{ __('Time to') }}</label>
                    <input type="date" name="time_to" id="time_to" value="{{$day_to}}" class="form-control" required/>
            </div>

            <div class="form-group">
                <button name="check" id="check" >{{ __('Check rooms') }}</button>
            </div>

            <div class="form-group">
                <label class="title">{{ __('Room number') }}</label>
                <select class="form-control" name="room_number" id="room_number">
                <option value="" selected disabled hidden>{{ __('Click check button') }}</option>
                  @php echo $room_options @endphp
                </select>
            </div>
        </div>
        <div class="booking_info_right">
                <div class="form-group">
                        <label class="title">{{ __('More info') }}</label>
                        <textarea type="text" name="more_info" id="more_info" rows="9" value="" class="form-control">{{old('more_info', $booking->more_info)}}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="title">{{ __('Status') }}</label>
                        <select class="form-control" name="status" id="status">
                            <option value="null"></option>
                            <option value="Completed">Completed</option>
                            <option value="Pending">Pending</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Not Paid">Not Paid</option>
                        </select>
                    </div>
        </div>
    </div>
    <input type="hidden" name="booking_id" id="booking_id" value="{{$booking->id}}"/>
    <div class="buttons">
        {{Form::button('<i class="fas fa-share-square"></i> '. __('Save') .'', ['class'=>'btn btn-primary', 'id' => 'btn_save', 'type' => 'submit'])}}
        {!! Form::close() !!}

        {!!Form::open(['action' => ['Admin\BookingController@destroy', $booking->id], 'method' => 'POST', 'onsubmit' => "return confirm('Are you sure you want to delete?')"])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::button('<i class="fas fa-trash-alt"></i> '. __('Delete') .'', ['class'=>'btn btn-danger', 'type' => 'submit'])}}

        {!!Form::close()!!}
    </div>

@endsection

@section('script')
    <script src="{{ asset('js/edit_checkRooms.js') }}"></script>
@endsection