$(document).ready(function()
{
    var minDate = new Date();
    $("#time_from").attr('readonly', true).css('background-color', '#fff');
    $("#time_to").attr('readonly', true).css('background-color', '#fff');

    $("#time_from").datepicker({
        showAnim: 'drop',
        numberOfMonths: 1,
        dateFormat: 'yy-mm-dd',
        altField: '#time_from',
        altFormat: 'yy-mm-dd',
        minDate: minDate,
        maxDate: '+1Y -1D',
        // beforeShowDay: unavailable,
        onSelect: function() {
            $('#room_number').attr('disabled', true);
            $('#btn_save').attr('disabled', true);
            var add_1_day = new Date($('#time_from').datepicker('getDate'));
            add_1_day.setDate(add_1_day.getDate() + 1);

            $("#time_to").datepicker("option", "minDate", add_1_day);
        }
    });

    $("#time_to").datepicker({
        showAnim: 'drop',
        numberOfMonths: 1,
        dateFormat: 'yy-mm-dd',
        altField: '#time_to',
        altFormat: 'yy-mm-dd',
        minDate: minDate,
        maxDate: '+1Y',
        // beforeShowDay: unavailable,
        onSelect: function() {
            $('#room_number').attr('disabled', true);
            $('#btn_save').attr('disabled', true);
            var sub_1_day = new Date($('#time_to').datepicker('getDate'));
            sub_1_day.setDate(sub_1_day.getDate() - 1);

            $("#time_from").datepicker("option", "maxDate", sub_1_day);
        }

    });
    
    $('#room_number').attr('disabled', true);
    $('#btn_save').attr('disabled', true);

    $('#check').on('click', function(e)
    {
        e.preventDefault();

        if($('#time_from').val() == '' || $('#time_to').val() == '')
        {
            alert('Please select dates');
        }
        else
        {
            let time_from = $('#time_from').val() + ' 15:00:00';
            let time_to = $('#time_to').val() + ' 12:00:00';
            let booking_id = $('#booking_id').val();

            $.ajax({
                url: '../rooms/checkavail',
                data: {
                    time_from: time_from,
                    time_to: time_to,
                    booking_id: booking_id
                },
                dataType: 'JSON',
                method: 'GET',
                success: function(result)
                {
                    $('#room_number').attr('disabled', false);
                    $('#btn_save').attr('disabled', false);

                    $('#room_number').html(result);
                    console.log(result);
                }
            });  
        }
    })
    // var unavailableDates = ["2020-1-1", "2020-1-10", "2020-1-11"];

    // function unavailable(date) 
    // {
       
    //     noDate = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
    //      console.log(noDate);
    //     if ($.inArray(noDate, unavailableDates) == -1) 
    //     {
    //         return [true, ""];
    //     } 
    //     else 
    //     {
    //         return [false, "", "Unavailable"];
    //     }
    // }
});