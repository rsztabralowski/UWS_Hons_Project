@extends('layouts.admin')

@section('content')
<div class="container">
    {{-- <div class="row"> --}}
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                    {{-- {{$bookings}} --}}
                    @php
                         $total = 0;
                    @endphp
                    @foreach ($bookings as $booking)

                    @php
                        $total += $booking->payment['amount'];
                    @endphp
                        <a href="{{ url ('/admin/booking/' .$booking['id']. '/edit')}}">
                        {{$booking->customer['id']}}<br>
                        {{$booking->customer['first_name']. ' ' . $booking->customer['last_name']}}<br>
                        {{$booking->customer['address']}}<br>
                        {{$booking->customer['email']}}<br>
                        <em>{{$booking->room['description']}}</em><br>
                        {{'£'. $booking->payment['amount']}}<br><hr>
                    </a>
                    @endforeach

            <span>Total amount is {{$total}}</span>
                <div class="panel-heading btn-primary">
                    WELCOME TO ADMIN PANEL
                </div>
            </div>
        </div>
    {{-- </div> --}}
</div>
@endsection