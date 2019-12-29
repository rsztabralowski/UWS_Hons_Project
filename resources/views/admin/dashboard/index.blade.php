@extends('layouts.admin')

@section('content')

<br><br><br>
<div class="container">

    <div class="start_end">
        <div class="starting">
            <h4>Bookings starting this week</h4>
            <ul>
                @foreach ($bookings['starting'] as $date => $room_array)
                    @foreach ($room_array as $id => $room)
                        <li><a href="bookings/{{$id}}">@php echo date('D', strtotime($date)) @endphp - <strong>{{$date}}</strong> - {{$room}}</a></li>
                    @endforeach        
                @endforeach
            </ul>
        </div>
        <div class="ending">
            <h4>Bookings ending this week</h4>
            <ul>
                @foreach ($bookings['ending'] as $date => $room_array)
                    @foreach ($room_array as $id => $room)
                        <li><a href="bookings/{{$id}}">@php echo date('D', strtotime($date)) @endphp - <strong>{{$date}}</strong> - {{$room}}</a></li>
                    @endforeach        
                @endforeach
            </ul>
        </div>
    </div>
    <hr>
</div>
@endsection