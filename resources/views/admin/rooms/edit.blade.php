@extends('layouts.admin')

@section('content')

<button class="back_btn"><a href="{{ url('/admin/rooms') }}"><i class="fas fa-arrow-alt-circle-left"></i> Cancel Edit</a></button>

{!! Form::open(['action' => ['Admin\RoomController@update', $room->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
    <div class="booking_info">
        <div class="booking_info_left">
            <div class="form-group">
                <label class="title">Room Number</label>
                <input type="text" name="room_number" id="room_number" value="{{old('room_number', $room->room_number)}}" class="form-control {{ $errors->has('room_number') ? ' is-invalid' : '' }}"/>

                @if ($errors->has('room_number'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('room_number') }}</strong>
                </span>
            @endif
            </div>
            <div class="form-group">
                <label class="title">Price</label>
                <input type="text" name="price" id="price" value="{{old('price', $room->price)}}" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}"/>

                @if ($errors->has('price'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="booking_info_right">
                <div class="form-group">
                        <label class="title">Description</label>
                        <textarea type="text" name="description" id="description" rows="9" value="" class="form-control">{{old('description', $room->description)}}</textarea>
                </div>
            </div>
    </div>
    <div class="buttons">
        {{Form::button('<i class="fas fa-share-square"></i> Save', ['class'=>'btn btn-primary', 'type' => 'submit'])}}
        {!! Form::close() !!}

        {!!Form::open(['action' => ['Admin\RoomController@destroy', $room->id], 'method' => 'POST', 'onsubmit' => "return confirm('Are you sure you want to delete?')"])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::button('<i class="fas fa-trash-alt"></i> Delete', ['class'=>'btn btn-danger', 'type' => 'submit'])}}

        {!!Form::close()!!}
    </div>

@endsection