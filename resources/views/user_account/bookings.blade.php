@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Bookings</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(\Session::has('error'))
                        <div class="alert alert-danger">
                            {{\Session::get('error')}}
                        </div>
                    @endif

                   @if (count($bookings) > 0)
                   <div class="table-responsive">
                        <table class="table table-striped bookings">
                            <tr>
                                <th>Booking ID</th>                           
                                <th>Time from</th>                           
                                <th>Time to</th>                           
                                <th>Room number</th>
                                <th>Nights</th>
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
                                @if (isset($booking->payment->id))
                                    <td>&pound;{{$booking->payment->amount}}</td>     
                                @else
                                    <td>Not Paid</td>
                                @endif    
                            </tr>                      
                            @endforeach
                        </table>
                   </div>
                   @else
                       <p>There are no bookings yet</p>
                   @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection