@extends('layouts.admin')

@section('content')

<button class="back_btn"><a href="{{ url('admin/users') }}"><i class="fas fa-arrow-alt-circle-left"></i> {{ __('Go back') }}</a></button>
{!! Form::open(['action' => ['Admin\UserController@update', $user->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
<div class="booking_info">
        <div class="booking_info_left">
            <div class="form-group">
                <label class="title">{{ __('Username') }}</label>
                <input type="text" name="username" id="username" value="{{$user['username']}}" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}"/>

                @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label class="title">{{ __('First name') }}</label>
                <input type="text" name="first_name" id="first_name" value="{{old('first_name', $user['first_name'])}}" class="form-control"/>
            </div>
            <div class="form-group">
                <label class="title">{{ __('Last name') }}</label>
                <input type="text" name="last_name" id="last_name" value="{{old('last_name', $user['last_name'])}}" class="form-control"/>
            </div>
            <div class="form-group">
                <label class="title">{{ __('Email') }}</label>
                <input type="text" name="email" id="email" value="{{old('email', $user['email'])}}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" />

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label class="title">{{ __('Phone number') }}</label>
                <input type="text" name="phone" id="phone" value="{{old('phone', $user['phone'])}}" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"/>

                @if ($errors->has('phone'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="booking_info_right">
                <div class="form-group">
                        <label class="title">{{ __('Addres') }}s</label>
                        <textarea type="text" name="address" id="address" rows="9" value="" class="form-control">{{old('address', $user['address'])}}</textarea>
                </div>
            </div>
    </div>
    <div class="buttons">
        {{Form::button('<i class="fas fa-share-square"></i> '. __('Save') .'', ['class'=>'btn btn-primary', 'type' => 'submit'])}}
        {!! Form::close() !!}

        {!!Form::open(['action' => ['Admin\UserController@destroy', $user->id], 'method' => 'POST', 'onsubmit' => "return confirm('Are you sure you want to delete?')"])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::button('<i class="fas fa-trash-alt"></i> '. __('Delete') .'', ['class'=>'btn btn-danger', 'type' => 'submit'])}}

        {!!Form::close()!!}
    </div>

@endsection