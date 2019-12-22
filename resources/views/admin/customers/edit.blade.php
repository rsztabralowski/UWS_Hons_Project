@extends('layouts.admin')

@section('content')

<button class="back_btn"><a href="{{ url('admin/customers/'. $customer->id) }}"><i class="fas fa-arrow-alt-circle-left"></i> Cancel edit</a></button>
{!! Form::open(['action' => ['Admin\UserController@update', $customer->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
<div class="booking_info">
        <div class="booking_info_left">
            <div class="form-group">
                <label class="title">First name</label>
                <input type="text" name="first_name" id="first_name" value="{{old('first_name', $customer['first_name'])}}" class="form-control" required/>
            </div>
            <div class="form-group">
                <label class="title">Last name</label>
                <input type="text" name="last_name" id="last_name" value="{{old('last_name', $customer['last_name'])}}" class="form-control" required/>
            </div>
            <div class="form-group">
                <label class="title">Email</label>
                <input type="text" name="email" id="email" value="{{old('email', $customer['email'])}}" class="form-control" required/>
            </div>
            <div class="form-group">
                <label class="title">Phone number</label>
                <input type="text" name="phone" id="phone" value="{{old('phone', $customer['phone'])}}" class="form-control" required/>
            </div>
        </div>
        <div class="booking_info_right">
                <div class="form-group">
                        <label class="title">Address</label>
                        <textarea type="text" name="address" id="address" rows="9" value="" class="form-control">{{old('address', $customer['address'])}}</textarea>
                </div>
            </div>
    </div>
    <div class="buttons">
        {{Form::button('<i class="fas fa-share-square"></i> Save', ['class'=>'btn btn-primary', 'type' => 'submit'])}}
        {!! Form::close() !!}

        {!!Form::open(['action' => ['Admin\UserController@destroy', $customer->id], 'method' => 'POST', 'onsubmit' => "return confirm('Are you sure you want to delete?')"])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::button('<i class="fas fa-trash-alt"></i> Delete', ['class'=>'btn btn-danger', 'type' => 'submit'])}}

        {!!Form::close()!!}
    </div>

@endsection