@extends('layouts.app')

@section('content')
    <div class="container">
        @auth
            <h1>You are logged in</h1>
            @if (count($bookings) > 0)
                @foreach ($bookings as $booking)
                    <div class="well">
                    <h3>{{$booking->id}}</h3>    
                    </div>                
                @endforeach
            @else
                <p>No bookings</p>
            @endif
        @else 
            <h1>You are a guest</h1>
        @endauth
    </div>  
@endsection  