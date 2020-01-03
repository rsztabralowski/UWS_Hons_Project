@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Account</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(\Session::has('success'))
                        <div class="alert alert-success">
                            {{\Session::get('success')}}
                        </div>
                    @endif
                    @if(\Session::has('error'))
                        <div class="alert alert-danger">
                            {{\Session::get('error')}}
                        </div>
                    @endif

                    {!! Form::open(['action' => ['UserAccount\UserAccountController@update', $user->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                    <div class="booking_info user_info">
                            <div class="booking_info_left">
                                <div class="form-group">
                                    <label class="title">Username</label>
                                    <input type="text" name="username" id="username" value="{{$user['username']}}" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}"/>
                    
                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="title">First name</label>
                                    <input type="text" name="first_name" id="first_name" value="{{old('first_name', $user['first_name'])}}" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label class="title">Last name</label>
                                    <input type="text" name="last_name" id="last_name" value="{{old('last_name', $user['last_name'])}}" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label class="title">Email</label>
                                    <input type="text" name="email" id="email" value="{{old('email', $user['email'])}}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" />
                    
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="title">Phone number</label>
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
                                            <label class="title">Address</label>
                                            <textarea type="text" name="address" id="address" rows="9" value="" class="form-control">{{old('address', $user['address'])}}</textarea>
                                    </div>
                                </div>
                        </div>
                        <div class="buttons">
                            {{Form::button('<i class="fas fa-share-square"></i> Save', ['class'=>'btn btn-primary', 'type' => 'submit'])}}
                            {!! Form::close() !!}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection