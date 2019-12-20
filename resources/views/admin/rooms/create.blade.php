@extends('layouts.admin')

@section('content')

<button class="back_btn"><a href="{{ url('/admin/rooms/') }}"><i class="fas fa-arrow-alt-circle-left"></i> Go back</a></button>

{!! Form::open(['action' => ['Admin\RoomController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="booking_info">
        <div class="booking_info_left">
            <div class="form-group">
                <label class="title">Room Number</label>
                <input type="text" name="room_number" id="room_number" value="{{old('room_number')}}" class="form-control" required/>
            </div>
            <div class="form-group">
                <label class="title">Price</label>
                <input type="text" name="price" id="price" value="{{old('price')}}" class="form-control" required/>
            </div>
        </div>
        <div class="booking_info_right">
                <div class="form-group">
                        <label class="title">Description</label>
                        <textarea type="text" name="description" id="description" rows="9" value="" class="form-control">{{old('description')}}</textarea>
                </div>
            </div>
    </div>
    <div class="buttons">
        {{Form::button('<i class="fas fa-share-square"></i> Save', ['class'=>'btn btn-primary', 'type' => 'submit'])}}
        {!! Form::close() !!}
    </div>

@endsection