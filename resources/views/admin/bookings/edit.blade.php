@extends('layouts.admin')

@section('content')
   
<div class="container">
    {{-- {{$booking}} --}}
    {{$booking->id}}<br>
    {{$booking->time_from. ' - '. $booking->time_to}}<br>
    {{$booking->more_info}}<br>
    {{$booking->customer['id']}}<br>
    {{$booking->customer['first_name']. ' '. $booking->customer['last_name']}}<br>
    <br><br>
    {{$booking->payment}}

</div>
@endsection