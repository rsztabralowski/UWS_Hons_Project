@extends('layouts.admin')

@section('content')

<style>

     .booking_info{
         display: flex;
         
        padding: 20px;
    }

    .booking_info_left{
        padding: 20px;
        width: 50%;

    }

    .booking_info_right{
        padding: 20px;
        width: 50%;

    }

    .padding_20{
        padding: 20px;
    }

    .title{
        font-weight: bold;
    }

    .edit_link{
        margin-left: 10%;
    }

    @media (max-width: 660px){
        .booking_info{
         display: block;
        }

        .booking_info_left, .booking_info_right{
            width: 100%;
        }

        .booking_info_left{
            padding-bottom: 0;
        }

        .booking_info_right{
            padding-top: 0;
        }
    }

</style>

<div class="booking_info">
    <div class="booking_info_left">
        <div class="form-group">
                <label class="title">Customer name</label>
                <input readonly type="text" name="customer_name" id="customer_name" value="{{$booking->customer['first_name']. ' '. $booking->customer['last_name']}}" class="form-control" />
        </div>
        <div class="form-group">
                <label class="title">Time from</label>
                <input readonly type="text" name="time_from" id="time_from" value="{{$booking->time_from}}" class="form-control" />
        </div>
        <div class="form-group">
                <label class="title">Time to</label>
                <input readonly type="text" name="time_to" id="time_to" value="{{$booking->time_to}}" class="form-control" />
        </div>
        <div class="form-group">
                <label class="title">Room number</label>
                <input readonly type="text" name="room_number" id="room_number" value="{{$booking->room['room_number']}}" class="form-control" />
        </div>
    </div>
    <div class="booking_info_right">
            <div class="form-group">
                    <label class="title">More info</label>
                    <textarea readonly type="text" name="more_info" id="more_info" rows="9" value="" class="form-control">{{$booking->more_info}}</textarea>
            </div>
        </div>
</div>
<button class="edit_link"><a href="{{$booking['id']}}/edit">Edit</a></button>

@endsection