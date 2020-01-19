<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @isset($booking->payment->title)
        @php
            $title = $booking->payment->title
        @endphp    
    @endisset
    @empty($booking->payment->title)
        @php
            $title = 'Manual Booking'
        @endphp    
    @endempty
    <title>{{$title}}</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }

        html, body{
            height: 100%;
        }
        body {
            
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: small;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            background-color: #99CCFF;
            color: #FFF;
            height: 210px;
        }
        .invoice{
            height: 790px;
        }
        .footer{
            background-color: #99CCFF;
            color: #FFF;
            height: 30px;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
        .container{
            max-width: 95%;
            /* border: 1px solid black; */
            margin: auto;
            margin-top: 20px;
        }
    </style>
</head>
@isset($booking->payment->payment_status)
    @php
        $status = $booking->payment->payment_status
    @endphp
@endisset
@empty($booking->payment->payment_status)
    @php
        $status = 'Not paid'
    @endphp
@endempty
@isset($booking->payment->price)
    @php
        $deposit = $booking->payment->price
    @endphp
@endisset
@empty($booking->payment->price)
    @php
        $deposit = 0
    @endphp    
@endempty
@php
    $difference = 0;

    if($booking->fullprice != $current_price)
        $difference = $current_price - $booking->fullprice;
@endphp
<body>
<div class="container">
    <div class="content">
        <div class="information">
            <table width="100%">
                <tr>
                    <td align="left" style="width: 40%;">
                        <h3>{{$booking->user->first_name}} {{$booking->user->last_name}}</h3>
                                {{$booking->user->email}}
                            <br /><br /><br />
                            Date: {{date('d/m/Y')}}<br />
                            Payment ID: #{{$booking->payment_id}}<br />
                            Status: {{$status}}<br />
                    </td>
                    <td align="center">
                        <img src="http://www.emartu.com/image/cache/catalog/Booking-Icon-750x750.png" alt="Logo" width="100" class="logo"/>
                    </td>
                    <td align="right" style="width: 40%;">
                        <h3>Company Name</h3>
                            https://company.com<br /><br />

                            Street 26<br />
                            G12 9PY<br />
                            GLASGOW<br />
                            United Kingdom<br />
                    </td>
                </tr>
            </table>
        </div>
        <br/>
        <div class="invoice">
            <h3>Booking #{{$booking->id}}</h3>
            <table width="100%">
                <thead>
                <tr>
                    <th>Description</th>
                    <th align="center">From - To</th>
                    <th align="center">Per night</th>
                    <th>Nights</th>
                    <th>{{$difference == 0 ? 'Price' : 'Previous'}}</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Room {{$booking->room->room_number}}</td>
                    <td align="center">{{date('d M Y', strtotime($booking->time_from))}} - {{date('d M Y', strtotime($booking->time_to))}}</td>
                    <td align="center">&pound;{{$booking->fullprice / $nights}}</td>
                    <td>{{$nights}}</td>
                    <td align="left">&pound;{{$booking->fullprice}}</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                @if ($difference != 0)
                <tr>
                    <td></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>Booking changes</td>
                    <td>&pound;{{$difference}}</td>
                </tr>
                @endif
            </tbody>
            
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td align="left">Deposit</td>
                    <td align="left" class="gray">&pound;{{$deposit}}</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="2"><hr></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td align="left">{{($booking->fullprice - $deposit + $difference) < 0 ? 'Refund' : 'To pay'}}</td>
                    <td align="left" class="gray">&pound;{{$booking->fullprice - $deposit + $difference}}</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <footer class="footer">
            <table width="100%">
                <tr>
                    <td align="center" style="width: 100%;">
                       Bookings -  &copy;{{ date('Y') }} - All rights reserved.
                    </td>
                </tr>
            </table>
    </footer>
</div>
</body>
</html>