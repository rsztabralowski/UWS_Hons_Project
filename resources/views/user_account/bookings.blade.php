@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">My Bookings</div>
                <div class="card-body">
                   @include('admin.inc.messages')
                   @if (count($bookings) > 0)
                   <div class="table-responsive">
                        <table class="table table-striped bookings">
                            <tr>
                                <th>Booking ID</th>                           
                                <th>Time from</th>                           
                                <th>Time to</th>                           
                                <th>Room number</th>
                                <th>Nights</th>
                                <th>Price</th>
                                <th>Deposit</th>
                                <th>To pay</th>
                                <th>Status</th>
                            </tr>
                            @foreach ($bookings as $booking)
                            <tr>
                                <td>#{{$booking->id}}</td>                           
                                <td>{{$booking->time_from}}</td>                           
                                <td>{{$booking->time_to}}</td>                           
                                <td>{{$booking->room->room_number}}</td>
                                @php
                                    $booking_days = App\CustomClass\Calendar::
                                                    date_range($booking->time_from, $booking->time_to);
                                    $nights = count($booking_days) -1;
                                @endphp 
                                <td>{{$nights}}</td> 
                                <td>&pound;{{$booking->fullprice}}</td> 
                                @if (isset($booking->payment->id))
                                    <td>&pound;{{$booking->payment->price}}</td>
                                    <td>&pound;{{$booking->fullprice - $booking->payment->price}}</td>
                                    @if ($booking->payment->payment_status == 'Completed')
                                        <td><button class="btn btn-sm" style="background-color: lightgreen">{{$booking->payment->payment_status}}</button></td>    
                                    @elseif ($booking->payment->payment_status == 'Pending')
                                        <td><button class="btn btn-sm" style="background-color: orange">{{$booking->payment->payment_status}}</button></td>     
                                    @else
                                        <td>{{$booking->payment->payment_status}}</td>     
                                    @endif
                                @else
                                    <td>n/a</td>
                                    <td>&pound;{{$booking->fullprice}}</td>
                                    <td><button class="btn btn-sm" style="background-color: #ff7f7f">Not Paid</button></td>
                                @endif 
                            </tr>                      
                            @endforeach
                        </table>
                   </div>
                   @else
                       <p>You have no bookings yet</p>
                   @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection