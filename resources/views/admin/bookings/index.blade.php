@extends('layouts.admin')

@section('content')
<br><br>
<div class="container">
    <div align='right'>
    <button type="button" name="add" id="add_data" class="btn btn-success btn-sm"><a href="{{route('bookings.create')}}"><i class="fas fa-plus-circle"></i> Add New Booking</a></button>
    </div>
    <p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="" id="current" data-get="">Current</a></li>|
            <li class="list-inline-item"><a href="" id='past' data-get="?show_past=1">Past</a></li>|
            <li class="list-inline-item"><a href="" id='past' data-get="?show_all=1">All</a></li>
        </ul>
    </p>
    <br>
        <table id="bookings_table" class="display responsive" style="witdt:100%">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Time From</th>
                    <th>Time To</th>
                    <th>Room</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
</div>
@endsection

