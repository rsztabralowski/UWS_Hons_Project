@extends('layouts.admin')

@section('content')

<button class="back_btn"><a href="{{ url('admin/users') }}"><i class="fas fa-arrow-alt-circle-left"></i> Back to Users</a></button>
<div class="booking_info">
        <div class="booking_info_left">
            <div class="form-group">
                <label class="title">First name</label>
                <input readonly type="text" name="first_name" id="first_name" value="{{$user['first_name']}}" class="form-control" required/>
            </div>
            <div class="form-group">
                <label class="title">Last name</label>
                <input readonly type="text" name="last_name" id="last_name" value="{{$user['last_name']}}" class="form-control" required/>
            </div>
            <div class="form-group">
                <label class="title">Email</label>
                <input readonly type="text" name="email" id="email" value="{{$user['email']}}" class="form-control" required/>
            </div>
            <div class="form-group">
                <label class="title">Phone number</label>
                <input readonly type="text" name="phone" id="phone" value="{{$user['phone']}}" class="form-control" required/>
            </div>
        </div>
        <div class="booking_info_right">
                <div class="form-group">
                        <label class="title">Address</label>
                        <textarea readonly type="text" name="address" id="address" rows="9" value="" class="form-control">{{$user['address']}}</textarea>
                </div>
            </div>
    </div>
<button class="edit_link"><a href="{{$user['id']}}/edit"><i class="fas fa-edit"></i> Edit</a></button>

@endsection