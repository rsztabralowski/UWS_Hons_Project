@extends('layouts.admin')

@section('content')

<br><br><br>
<div class="container">
    <div class="start_end">
        <div class="starting">
        <h4>{{$bookings['count']['starting']}}
                        @php
                           echo ' booking'. ($bookings['count']['starting'] == 1 ? '' : 's') .' starting next week';
                        @endphp
        </h4>
            <ul>
                @foreach ($bookings['starting'] as $booking)
                   {!!$booking!!}  
                @endforeach
            </ul>
        </div>
        <div class="ending">
            <h4>{{$bookings['count']['ending']}}
                            @php
                                echo ' booking'. ($bookings['count']['ending'] == 1 ? '' : 's') .' ending next week';
                            @endphp
            </h4>
            <ul>
                @foreach ($bookings['ending'] as $booking)
                    {!!$booking!!}    
                @endforeach
            </ul>
        </div>
    </div>
    <hr>
</div>
@endsection