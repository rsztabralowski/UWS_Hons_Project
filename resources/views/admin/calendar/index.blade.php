@extends('layouts.admin')

@section('content')

<style>

.days{
    display: flex;
    text-align: center;

}

.day{
    min-width: 40px;
    min-height: 40px;
    border: 1px solid black;
    display: flex;
    justify-content: center;

}

.calendar_overflow{
    overflow-x: scroll;
}

.container_calendar{
    margin: auto;
    max-width: 1400px;
    padding: 10px;
}

.start{
    background-image: url('https://icingprint.co.uk/bookings/img_bookings/start.jpg');
}

.end{
    background-image: url('https://icingprint.co.uk/bookings/img_bookings/end.jpg');
}

.available{
    background-image: url('https://icingprint.co.uk/bookings/img_bookings/available.jpg');
}

.full{
    background-image: url('https://icingprint.co.uk/bookings/img_bookings/full.jpg');
}

.changeover{
    background-image: url('https://icingprint.co.uk/bookings/img_bookings/changeover.jpg');
}

.select_container{
    display: flex;
    margin-bottom: 50px;
}

.select_year{
    padding: 10px;
}

.select_month{
    padding: 10px;
}

#selected_time{
    text-align: center;
}

</style>

    <div class="container_calendar">
        
        <h1 class="days">Calendar</h1>

        <div class="select_container">
            <div class="select_year">
                <label for="year">Select Year</label>
                <select name="year" class="form-control" id="year">
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                </select>
            </div>
            <div class="select_month">
                <label for="month">Select Month</label>
                <select name="month" class="form-control" id="month">
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
        </div>
        <div id="selected_time"></div>
        <div class="calendar_overflow">
                {{-- {!!$output!!} --}}
        </div>
    </div>  

    <script>
    
    $(document).ready(function(){

            let d = new Date();
            let month = d.getMonth() + 1;
            let year = d.getFullYear();

            $('[name=year]').val(year);
            $('[name=month]').val(month);

            $.ajax({
                url: '{{route('calendar.getallbookings')}}',
                data: {
                    year: year,
                    month: month
                },
                method: 'GET',
                success: function(result)
                {
                    $('#selected_time').html('<h2>'+$('#month option:selected').text()+ ' ' +$('#year option:selected').text()+'</h2>');
                    $('.calendar_overflow').html(result);
                }
            });

        $('#year,#month').on('change', function(){
            
            let year = $('#year').val();
            let month = $('#month').val();

            $.ajax({
                url: '{{route('calendar.getallbookings')}}',
                data: {
                    year: year,
                    month: month
                },
                method: 'GET',
                success: function(result)
                {
                    $('#selected_time').html('<h2>'+$('#month option:selected').text()+ ' ' +$('#year option:selected').text()+'</h2>');
                    $('.calendar_overflow').html(result);
                }
            });

        });


    });
    
    </script>
@endsection  