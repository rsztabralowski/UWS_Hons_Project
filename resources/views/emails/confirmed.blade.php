<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            font-family: 'Didact Gothic', sans-serif;
            font-size: 18px;
        }
        div{
            padding: 10px;
        }
        .container{
            max-width: 1000px;
            margin: auto;
            text-align: center;
            background-color: white;
            padding: 5%;
            margin-bottom: 50px;
        }
        .dates{
            border: 1px solid black;
            font-size: 16px;
            margin: auto;
            margin-bottom: 20px;
            width: 80%;
        }
        span{
            font-weight: bold;
        }
        button{
            margin-top: 20px;
            padding: 20px;
            font-size: 20px;
            background-color: #4794ff;
            color: white;
        }
       
    </style>
</head>
<body>
    <div class="container">
        <h3>Booking confirmation</h3>
        
        <div>Reference Nr: #{{$booking->id}}</div>
        <div class="dates">
            <div><span>From:</span> {{date('d M Y', strtotime($booking->time_from))}}</div>
            <div><span>To:</span> {{date('d M Y', strtotime($booking->time_to))}}</div>
        </div>
        <div>Room number: {{$booking->room->room_number}}</div>
        <div>Nights: {{count(App\CustomClass\Calendar::date_range($booking->time_from, $booking->time_to)) -1}}</div>
        <div>Price: &pound;{{$booking->fullprice}}</div>
        <div>Deposit paid:  @if (isset($booking->payment->price))
                                &pound;{{$booking->payment->price}}
                                @php
                                    $deposit = $booking->payment->price;
                                @endphp
                            @else
                                none
                                @php
                                    $deposit = 0;
                                @endphp
                            @endif</div>
        <div><span>Final payment: &pound;{{$booking->fullprice - $deposit}}</span></div>
        <div>
            <a href="{{env('APP_URL')}}"><button>Visit our website</button></a>
        </div>
    </div>
</body>
</html>