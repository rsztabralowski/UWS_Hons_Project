@extends('layouts.admin')

@section('content')

<button class="back_btn"><a href="{{ url('admin/customers') }}"><i class="fas fa-arrow-alt-circle-left"></i> Back to Customers</a></button>
<div class="booking_info">
        <div class="booking_info_left">
            <div class="form-group">
                <label class="title">First name</label>
                <input readonly type="text" name="first_name" id="first_name" value="{{$customer['first_name']}}" class="form-control" required/>
            </div>
            <div class="form-group">
                <label class="title">Last name</label>
                <input readonly type="text" name="last_name" id="last_name" value="{{$customer['last_name']}}" class="form-control" required/>
            </div>
            <div class="form-group">
                <label class="title">Email</label>
                <input readonly type="text" name="email" id="email" value="{{$customer['email']}}" class="form-control" required/>
            </div>
            <div class="form-group">
                <label class="title">Phone number</label>
                <input readonly type="text" name="phone" id="phone" value="{{$customer['phone']}}" class="form-control" required/>
            </div>
        </div>
        <div class="booking_info_right">
                <div class="form-group">
                        <label class="title">Address</label>
                        <textarea readonly type="text" name="address" id="address" rows="9" value="" class="form-control">{{$customer['address']}}</textarea>
                </div>
            </div>
    </div>
<button class="edit_link"><a href="{{$customer['id']}}/edit"><i class="fas fa-edit"></i> Edit</a></button>

@endsection