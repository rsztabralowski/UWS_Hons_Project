@extends('layouts.admin')

@section('content')

<button class="back_btn"><a href="{{ url('/admin/bookings/') }}"><i class="fas fa-arrow-alt-circle-left"></i> Go back</a></button>

{!! Form::open(['action' => ['Admin\BookingController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="booking_info">
        <div class="booking_info_left">
            <div class="form-group">
                <label class="title">User name</label>
                <select class="form-control" name="user_name" id="user_name">
                  @php echo $user_list @endphp
                </select>
            </div>

            <div class="form-group">
                    <label class="title">Time from</label>
                    <input name="time_from" id="time_from" value="{{old('time_from')}}" class="form-control" required autocomplete="off"/>
            </div>
            <div class="form-group">
                    <label class="title">Time to</label>
                    <input name="time_to" id="time_to" value="{{old('time_to')}}" class="form-control" required autocomplete="off"/>
            </div>

            <div class="form-group">
                <button name="check" id="check" >Check rooms</button>
            </div>

            <div class="form-group">
                <label class="title">Room number</label>
                <select class="form-control" name="room_number" id="room_number">
                <option value="" selected disabled hidden>Click check button</option>
                  @php echo $room_options @endphp
                </select>
            </div>
        </div>
        <div class="booking_info_right">
                <div class="form-group">
                        <label class="title">More info</label>
                        <textarea type="text" name="more_info" id="more_info" rows="9" value="" class="form-control">{{old('more_info')}}</textarea>
                </div>
            </div>
    </div>
    <div class="buttons">
        {{Form::button('<i class="fas fa-share-square"></i> Save', ['class'=>'btn btn-primary', 'id' => 'btn_save', 'type' => 'submit'])}}
        {!! Form::close() !!}
    </div>

@endsection

@section('script')
    <script src="{{ asset('js/checkRooms.js') }}"></script>
@endsection