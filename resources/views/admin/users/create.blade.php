@extends('layouts.admin')

@section('content')

<button class="back_btn"><a href="{{ url('/admin/users/') }}"><i class="fas fa-arrow-alt-circle-left"></i> Go back</a></button>

{!! Form::open(['action' => ['Admin\UserController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="booking_info">
        <div class="booking_info_left">
            <div class="form-group">
                <label class="title">Username</label>
                <input type="text" name="username" id="username" value="{{old('username')}}" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}"/>

                @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif

            </div>
            <div class="form-group">
                <label class="title">First name</label>
                <input type="text" name="first_name" id="first_name" value="{{old('first_name')}}" class="form-control"/>
            </div>
            <div class="form-group">
                <label class="title">Last name</label>
                <input type="text" name="last_name" id="last_name" value="{{old('last_name')}}" class="form-control"/>
            </div>
            <div class="form-group">
                <label class="title">Email</label>
                <input type="text" name="email" id="email" value="{{old('email')}}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"/>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

            </div>
            <div class="form-group">
                <label class="title">Phone number</label>
                <input type="text" name="phone" id="phone" value="{{old('phone')}}" class="form-control"/>
            </div>
        </div>
        <div class="booking_info_right">
                <div class="form-group">
                        <label class="title">Address</label>
                        <textarea type="text" name="address" id="address" rows="9" value="" class="form-control">{{old('address')}}</textarea>
                </div>
            </div>
    </div>
    <div class="buttons">
        {{Form::button('<i class="fas fa-share-square"></i> Save', ['class'=>'btn btn-primary', 'type' => 'submit'])}}
        {!! Form::close() !!}
    </div>

@endsection